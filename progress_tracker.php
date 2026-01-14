<?php
require_once __DIR__ . '/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
$user_id = $_SESSION['user_id'];

$payload = [];

// Ensure we have a logged-in user
// $user_id is set above
if ($user_id) {
  try {
    // Create minimal tables if they don't exist (safe no-op if they already exist)
    // Create reward_points with schema matching chefify.sql
    $pdo->exec("CREATE TABLE IF NOT EXISTS reward_points (
      points_id INT PRIMARY KEY AUTO_INCREMENT,
      user_id INT UNIQUE NOT NULL,
      points INT DEFAULT 0,
      total_points_earned INT DEFAULT 0,
      last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS challenges (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255) NOT NULL,
      description TEXT,
      target INT NOT NULL DEFAULT 0,
      reward_points INT NOT NULL DEFAULT 0,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS user_challenges (
      user_id INT NOT NULL,
      challenge_id INT NOT NULL,
      progress INT NOT NULL DEFAULT 0,
      completed_at DATETIME DEFAULT NULL,
      claimed TINYINT(1) NOT NULL DEFAULT 0,
      claimed_at DATETIME DEFAULT NULL,
      PRIMARY KEY (user_id, challenge_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

    // Ensure columns exist for older installs (silent ignore on failure)
    try {
      $pdo->exec("ALTER TABLE user_challenges ADD COLUMN IF NOT EXISTS claimed TINYINT(1) NOT NULL DEFAULT 0");
      $pdo->exec("ALTER TABLE user_challenges ADD COLUMN IF NOT EXISTS claimed_at DATETIME DEFAULT NULL");
    } catch (Exception $e) {
      // ignore - ALTER may fail on older MySQL without IF NOT EXISTS
      try {
        $pdo->exec("ALTER TABLE user_challenges ADD COLUMN claimed TINYINT(1) NOT NULL DEFAULT 0");
      } catch (Exception $e2) { /* ignore */ }
      try {
        $pdo->exec("ALTER TABLE user_challenges ADD COLUMN claimed_at DATETIME DEFAULT NULL");
      } catch (Exception $e3) { /* ignore */ }
    }

    // Fetch authoritative points
    $points = 0;
    try {
      $stmt = $pdo->prepare('SELECT points FROM reward_points WHERE user_id = ?');
      $stmt->execute([$user_id]);
      $col = $stmt->fetchColumn();
      if ($col !== false) {
        $points = (int)$col;
      } else {
        // fallback: sum points_earned from orders if reward_points row missing
        $stmt2 = $pdo->prepare('SELECT COALESCE(SUM(points_earned),0) FROM orders WHERE user_id = ?');
        $stmt2->execute([$user_id]);
        $points = (int)$stmt2->fetchColumn();
      }
    } catch (Exception $e) {
      error_log('Reward points fetch error: ' . $e->getMessage());
      $points = 0;
    }

    // Recent orders (limit 20)
    $stmt = $pdo->prepare('SELECT order_id, total_amount, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 20');
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll();

    // Total orders and weekly orders
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM orders WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $totalOrders = (int) $stmt->fetchColumn();

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM orders WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
    $stmt->execute([$user_id]);
    $weeklyOrders = (int) $stmt->fetchColumn();

    // Approximate total points earned from orders (if no points history table)
    $stmt = $pdo->prepare('SELECT COALESCE(SUM(FLOOR(total_amount)),0) as pts FROM orders WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $totalPointsEarned = (int) $stmt->fetchColumn();

    // Weekly points (approx from orders)
    $stmt = $pdo->prepare('SELECT COALESCE(SUM(FLOOR(total_amount)),0) as pts FROM orders WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
    $stmt->execute([$user_id]);
    $weeklyPoints = (int) $stmt->fetchColumn();

    // Last week's orders
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM orders WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 13 DAY) AND created_at < DATE_SUB(CURDATE(), INTERVAL 6 DAY)');
    $stmt->execute([$user_id]);
    $lastWeekOrders = (int) $stmt->fetchColumn();

    // Last week's points
    $stmt = $pdo->prepare('SELECT COALESCE(SUM(FLOOR(total_amount)),0) as pts FROM orders WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 13 DAY) AND created_at < DATE_SUB(CURDATE(), INTERVAL 6 DAY)');
    $stmt->execute([$user_id]);
    $lastWeekPoints = (int) $stmt->fetchColumn();

    // Challenges completed this week
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM user_challenges WHERE user_id = ? AND completed_at IS NOT NULL');
    $stmt->execute([$user_id]);
    $weeklyChallenges = (int) $stmt->fetchColumn();

    // Last week's challenges
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM user_challenges WHERE user_id = ? AND completed_at >= DATE_SUB(CURDATE(), INTERVAL 13 DAY) AND completed_at < DATE_SUB(CURDATE(), INTERVAL 6 DAY)');
    $stmt->execute([$user_id]);
    $lastWeekChallenges = (int) $stmt->fetchColumn();

    // User join date and member days
    $stmt = $pdo->prepare('SELECT created_at FROM users WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $joinDate = $stmt->fetchColumn();
    $memberDays = 0;
    if ($joinDate) {
      $created = new DateTime($joinDate);
      $now = new DateTime();
      $memberDays = (int)$created->diff($now)->days;
    }

    // Favorite item (best effort)
    try {
      $stmt = $pdo->prepare('SELECT mi.name, COUNT(*) as cnt FROM order_items oi JOIN orders o ON oi.order_id = o.order_id JOIN menu_items mi ON oi.item_id = mi.item_id WHERE o.user_id = ? GROUP BY mi.item_id ORDER BY cnt DESC LIMIT 1');
      $stmt->execute([$user_id]);
      $fav = $stmt->fetch();
      $favoriteItem = $fav['name'] ?? '-';
    } catch (Exception $e) {
      $favoriteItem = '-';
    }

    // Badges (if tables exist)
    $badges = [];
    try {
      $stmt = $pdo->prepare('SELECT ub.*, b.name FROM user_badges ub JOIN badges b ON ub.badge_id = b.id WHERE ub.user_id = ? ORDER BY ub.earned_at DESC');
      $stmt->execute([$user_id]);
      $badges = $stmt->fetchAll();
    } catch (Exception $e) {
      // ignore if badges tables don't exist
    }

    // Levels: either from a table or default set
    $levels = [
      ["name"=>"Food Beginner","icon"=>"🍽️","min"=>0,"max"=>200],
      ["name"=>"Food Enthusiast","icon"=>"🍔","min"=>200,"max"=>400],
      ["name"=>"Food Lover","icon"=>"❤️","min"=>400,"max"=>800],
      ["name"=>"Chef Explorer","icon"=>"👨‍🍳","min"=>800,"max"=>1000],
      ["name"=>"Food Master","icon"=>"🏆","min"=>1000,"max"=>1000000000]
    ];

    // Compute order streak (consecutive days with orders up to today)
    $stmt = $pdo->prepare('SELECT DISTINCT DATE(created_at) as d FROM orders WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) ORDER BY d DESC');
    $stmt->execute([$user_id]);
    $days = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    $streak = 0;
    $cur = new DateTime();
    foreach ($days as $day) {
      $d = new DateTime($day);
      $diff = (int)$d->diff($cur)->days;
      if ($diff === 0 || $diff === $streak) {
        $streak++;
        $cur->modify('-1 day');
      } else {
        break;
      }
    }

    // Ensure default challenges exist
    try {
      $stmt = $pdo->query('SELECT COUNT(*) FROM challenges');
      $cnt = (int)$stmt->fetchColumn();
      if ($cnt === 0) {
        $ins = $pdo->prepare('INSERT INTO challenges (name, description, target, reward_points) VALUES (?, ?, ?, ?)');
        $ins->execute(['Order Master','Complete 5 orders this month',5,100]);
        $ins->execute(['Point Collector','Earn 500 total points',500,50]);
        $ins->execute(['Game Champion','Play 3 mini-games',3,10]);
      }
    } catch (Exception $e) {
      // ignore
    }

    // Fetch challenges and compute user progress automatically
    $challenges = [];
    try {
      $stmt = $pdo->query('SELECT id, name, description, target, reward_points FROM challenges ORDER BY id');
      $all = $stmt->fetchAll();
      foreach ($all as $c) {
        $challenge_id = (int)$c['id'];
        $name = $c['name'];
        $target = (int)$c['target'];
        $reward = (int)$c['reward_points'];

        // Compute current progress based on challenge type
        $current = 0;
        if ($name === 'Order Master') {
          $stmtP = $pdo->prepare('SELECT COUNT(*) FROM orders WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)');
          $stmtP->execute([$user_id]);
          $current = (int)$stmtP->fetchColumn();
        } elseif ($name === 'Point Collector') {
          $stmtP = $pdo->prepare('SELECT COALESCE(points, 0) FROM reward_points WHERE user_id = ?');
          $stmtP->execute([$user_id]);
          $current = (int)$stmtP->fetchColumn();
        } elseif ($name === 'Game Champion') {
          $stmtP = $pdo->prepare('SELECT COUNT(*) FROM game_history WHERE user_id = ?');
          $stmtP->execute([$user_id]);
          $current = (int)$stmtP->fetchColumn();
        } else {
          // For other challenges, use stored progress if exists
          $stmtP = $pdo->prepare('SELECT progress FROM user_challenges WHERE user_id = ? AND challenge_id = ?');
          $stmtP->execute([$user_id, $challenge_id]);
          $current = (int)$stmtP->fetchColumn();
        }

        // Determine if completed
        $completed = $current >= $target;

        // Get claimed status
        $stmtUC = $pdo->prepare('SELECT claimed FROM user_challenges WHERE user_id = ? AND challenge_id = ?');
        $stmtUC->execute([$user_id, $challenge_id]);
        $uc = $stmtUC->fetch();
        $claimed = $uc && !empty($uc['claimed']) ? true : false;

        // If completed but not in user_challenges, insert it
        if ($completed && !$uc) {
          $stmtIns = $pdo->prepare('INSERT INTO user_challenges (user_id, challenge_id, progress, completed_at) VALUES (?, ?, ?, ?)');
          $stmtIns->execute([$user_id, $challenge_id, $current, date('Y-m-d H:i:s')]);
        } elseif ($completed && !$uc['completed_at']) {
          // Update if not marked completed
          $stmtUpd = $pdo->prepare('UPDATE user_challenges SET progress = ?, completed_at = ? WHERE user_id = ? AND challenge_id = ?');
          $stmtUpd->execute([$current, date('Y-m-d H:i:s'), $user_id, $challenge_id]);
        }

        $challenges[] = [
          'id' => $challenge_id,
          'name' => $name,
          'desc' => $c['description'],
          'target' => $target,
          'reward' => $reward,
          'current' => $current,
          'completed' => $completed,
          'claimed' => $claimed
        ];
      }
    } catch (Exception $e) {
      // ignore
    }

    // Build server-side activities (orders + badges) for timeline
    $activities = [];
    try {
      foreach ($orders as $o) {
        $activities[] = [
          'date' => $o['created_at'] ?? null,
          'title' => 'Order completed',
          'desc' => 'Order #' . ($o['order_id'] ?? '') . ' - RM ' . number_format($o['total_amount'] ?? 0, 2),
          'points' => '+' . (isset($o['points_earned']) ? (int)$o['points_earned'] : floor($o['total_amount'] ?? 0)) . ' pts'
        ];
      }
      foreach ($badges as $b) {
        $activities[] = [
          'date' => $b['earned_at'] ?? ($b['created_at'] ?? null),
          'title' => 'Badge Unlocked',
          'desc' => $b['name'] ?? 'Badge',
          'points' => '🏅'
        ];
      }
      // Add claimed challenges to activities
      $stmtCC = $pdo->prepare('SELECT uc.claimed_at, c.name, c.reward_points FROM user_challenges uc JOIN challenges c ON uc.challenge_id = c.id WHERE uc.user_id = ? AND uc.claimed = 1 ORDER BY uc.claimed_at DESC');
      $stmtCC->execute([$user_id]);
      $claimedChallenges = $stmtCC->fetchAll();
      foreach ($claimedChallenges as $cc) {
        $activities[] = [
          'date' => $cc['claimed_at'],
          'title' => 'Challenge Completed',
          'desc' => $cc['name'],
          'points' => '+' . (int)$cc['reward_points'] . ' pts'
        ];
      }
    } catch (Exception $e) {
      // ignore
    }

    // Default goals (server can override by adding a 'goals' key)
    $defaultGoals = [
      [ 'icon' => '🎯', 'title' => 'Weekly Target', 'target' => 'Order 5 times this week', 'desc' => 'Stay consistent and earn bonus points!' ],
      [ 'icon' => '🏅', 'title' => 'Badge Hunter', 'target' => 'Unlock 2 more badges', 'desc' => "You're so close to your next achievement!" ],
      [ 'icon' => '💎', 'title' => 'Point Milestone', 'target' => 'Reach 1000 total points', 'desc' => 'Become a Food Master and unlock exclusive perks!' ]
    ];

    // Build payload
    $payload = [
      'points' => $points,
      'orders' => $orders,
      'badges' => $badges,
      'levels' => $levels,
      'joinDate' => $joinDate,
      'memberDays' => $memberDays,
      'orderStreak' => $streak,
      'avgPoints' => $totalOrders > 0 ? (int) round($totalPointsEarned / $totalOrders) : 0,
      'favoriteItem' => $favoriteItem,
      'weeklyOrders' => $weeklyOrders,
      'weeklyPoints' => $weeklyPoints,
      'totalOrders' => $totalOrders,
      'totalPointsEarned' => $totalPointsEarned,
      'challenges' => $challenges,
      'activities' => $activities,
      'goals' => $defaultGoals,
      'lastWeekOrders' => $lastWeekOrders,
      'lastWeekPoints' => $lastWeekPoints,
      'weeklyChallenges' => $weeklyChallenges,
      'lastWeekChallenges' => $lastWeekChallenges
    ];

      // Diagnostic values for debugging (only shown when ?debug=1)
      try {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM reward_points WHERE user_id = ?');
        $stmt->execute([$user_id]);
        $haveRewardRow = (int)$stmt->fetchColumn();
        $stmt = $pdo->prepare('SELECT COALESCE(SUM(points_earned),0) FROM orders WHERE user_id = ?');
        $stmt->execute([$user_id]);
        $pointsFromOrders = (int)$stmt->fetchColumn();
      } catch (Exception $e) {
        $haveRewardRow = 0;
        $pointsFromOrders = 0;
      }

      // If no reward_points row exists but we computed points from orders, insert a row to keep DB authoritative
      try {
        if (empty($haveRewardRow) && !empty($pointsFromOrders) && $pointsFromOrders > 0) {
          $ins = $pdo->prepare('INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (?, ?, ?)');
          $ins->execute([$user_id, $pointsFromOrders, $pointsFromOrders]);
          $points = (int)$pointsFromOrders;
          $haveRewardRow = 1;
        }
      } catch (Exception $e) {
        // ignore insertion errors
      }

      // attach diagnostic values to payload for easier client-side inspection
      $payload['debug_haveRewardRow'] = $haveRewardRow;
      $payload['debug_pointsFromOrders'] = $pointsFromOrders;

  } catch (Exception $e) {
    // If anything goes wrong, expose a minimal payload
    $payload = [ 'points' => 0, 'orders' => [], 'badges' => [], 'levels' => [], 'memberDays' => 0 ];
  }
} else {
  $payload = [ 'points' => 0, 'orders' => [], 'badges' => [], 'levels' => [], 'memberDays' => 0 ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progress Tracker - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="progress_tracker.css">

</head>
<body>
<!-- NAV -->
<nav>
  <div class="nav-container">
    <a href="homepage.php" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>
    <div class="nav-links" role="menu" aria-label="Main links">
      <a href="homepage.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="cart.php">Cart</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About</a>
      <a href="contactus.php">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="profile.php">Profile</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

  <!-- PROGRESS TRACKER CONTAINER -->
  <div class="tracker-container">

  <main class="points-container">
  
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
    
    <!-- PAGE HEADER -->
    <div class="page-header">
      <h1>📊 Progress Tracker</h1>
      <p>Track your journey to becoming a Chefify Master!</p>
    </div>

    <!-- LEVEL PROGRESS CARD -->
    <div class="level-card">
      <div class="level-header">
        <div class="current-level">
          <div class="level-badge" id="levelBadge">🍽️</div>
          <div class="level-info">
            <h2 id="levelName">Food Beginner</h2>
            <p id="levelDesc">Keep ordering to level up!</p>
          </div>
        </div>

      </div>
      <div class="level-progress-bar">
        <div class="level-progress-fill" id="levelProgressFill">0%</div>
      </div>
    </div>

    <!-- MOTIVATION CARD -->
    <div class="motivation-card">
      <div class="motivation-icon">🌟</div>
      <div class="motivation-text" id="motivationText">Keep going! You're doing amazing!</div>
      <div class="motivation-subtext" id="motivationSubtext">Every order brings you closer to greatness</div>
    </div>

    <!-- STATISTICS GRID -->
    <div class="stats-grid">
      <div class="stat-card">
        <span class="stat-icon">📅</span>
        <div class="stat-value" id="memberDays">0</div>
        <div class="stat-label">Days as Member</div>
      </div>
      <div class="stat-card">
        <span class="stat-icon">🔥</span>
        <div class="stat-value" id="orderStreak">0</div>
        <div class="stat-label">Day Order Streak</div>
      </div>
      <div class="stat-card">
        <span class="stat-icon">⭐</span>
        <div class="stat-value" id="avgPoints">0</div>
        <div class="stat-label">Avg Points Per Order</div>
      </div>
      <div class="stat-card">
        <span class="stat-icon">🍕</span>
        <div class="stat-value" id="favoriteItem">-</div>
        <div class="stat-label">Most Ordered Item</div>
      </div>
    </div>

    <!-- ACTIVITY TIMELINE -->
    <div class="timeline-section">
      <h2 class="section-title">📜 Recent Activity</h2>
      <div class="timeline" id="activityTimeline">
        <!-- Timeline items will be generated here -->
      </div>
    </div>

    <!-- CHALLENGES -->
    <div class="challenges-section">
      <h2 class="section-title">🎯 Active Challenges</h2>
      <p style="margin-bottom:1.5rem;color:#8b4c3a;">Complete these challenges to earn extra rewards and boost your progress!</p>
      <div class="challenge-grid" id="challengeGrid">
        <!-- Challenge cards will be generated here -->
      </div>
    </div>

    <!-- WEEKLY SUMMARY -->
    <div class="summary-section">
      <h2 class="section-title">📊 This Week's Summary</h2>
      <div class="summary-grid">
        <div class="summary-item">
          <span class="summary-icon">🛒</span>
          <div class="summary-value" id="weeklyOrders">0</div>
          <div class="summary-label">Orders This Week</div>
          <div class="summary-change positive" id="ordersChange">↑ 0 from last week</div>
        </div>
        <div class="summary-item">
          <span class="summary-icon">⭐</span>
          <div class="summary-value" id="weeklyPoints">0</div>
          <div class="summary-label">Points Earned</div>
          <div class="summary-change positive" id="pointsChange">↑ 0 from last week</div>
        </div>
        <div class="summary-item">
          <span class="summary-icon">🎯</span>
          <div class="summary-value" id="weeklyChallenges">0</div>
          <div class="summary-label">Challenges Completed</div>
          <div class="summary-change positive" id="challengesChange">↑ 0 from last week</div>
        </div>
      </div>
    </div>

    <!-- GOALS -->
    <div class="goals-section">
      <h2 class="section-title">🎯 Your Goals</h2>
      <p style="margin-bottom:1rem;color:#8b4c3a;">Stay focused on your targets and watch your progress soar!</p>
      <div class="goals-grid" id="goalsGrid">
        <!-- Goal cards will be generated here -->
      </div>
    </div>

  </div>

<!-- FOOTER -->
<footer>
  <div class="footer-container">
    <!-- Footer Top -->
    <div class="footer-top">
      <div class="footer-logo-section">
        <div class="footer-logo">
          <img src="img/chefify.jpg" alt="Chefify Logo" onerror="this.src='https://via.placeholder.com/70/4b2e19/FFFFFF?text=C'">
          <span class="footer-logo-text">Chefify</span>
        </div>
        <p class="footer-tagline">Delicious moments, rewarding experiences. Order now and earn points with every meal!</p>
        <div class="footer-social">
          <a href="https://www.tiktok.com/@chefifyapp?_r=1&_t=ZS-92RNDS9aRWs" target="_blank" rel="noopener" class="social-icon" title="Follow us on TikTok">
            <img src="img/tiktok.png" alt="TikTok">
          </a>
          <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" rel="noopener" class="social-icon" title="Follow us on Instagram">
            <img src="img/instagram.webp" alt="Instagram">
          </a>
        </div>
      </div>
      <div class="footer-section">
        <h3>Get in Touch</h3>
        <div class="contact-item"><span class="contact-icon">📍</span><div class="contact-text">Kuala Lumpur, Malaysia</div></div>
        <div class="contact-item"><span class="contact-icon">📧</span><div class="contact-text"><a href="mailto:hello@chefify.com">hello@chefify.com</a></div></div>
        <div class="contact-item"><span class="contact-icon">📱</span><div class="contact-text"><a href="tel:+60123456789">+603-2688 8888</a></div></div>
      </div>
    </div>
    <div class="footer-bottom">
      <div>© 2025 Chefify. All rights reserved.</div>
      <ul class="footer-links-inline"><li><a href="privacy.php">Privacy Policy</a></li><li><a href="terms.php">Terms of Service</a></li><li><a href="cookies.php">Cookie Policy</a></li></ul>
    </div>
  </div>
</footer>

<script>
const serverData = <?php echo json_encode($payload, JSON_HEX_TAG); ?>;

const userData = {
  points: serverData.points || 0,
  orders: serverData.orders || [],
  joinDate: serverData.joinDate || new Date().toISOString(),
  badges: serverData.badges || []
};

// levels from server
const levels = serverData.levels || [
  { name: "Food Beginner", icon: "🍽️", min: 0, max: 200 },
  { name: "Food Enthusiast", icon: "🍔", min: 200, max: 400 },
  { name: "Food Lover", icon: "❤️", min: 400, max: 800 },
  { name: "Chef Explorer", icon: "👨‍🍳", min: 800, max: 1000 },
  { name: "Food Master", icon: "🏆", min: 1000, max: Infinity }
];

function getCurrentLevel() { return levels.find(l => userData.points >= l.min && userData.points < l.max) || levels[0]; }
function getNextLevel() { const idx = levels.findIndex(l => l === getCurrentLevel()); return levels[idx+1] || levels[levels.length-1]; }

const currentLevel = getCurrentLevel();
const nextLevel = getNextLevel();
// Cap displayed points at 1000 for progress UI
const displayPoints = Math.min(userData.points || 0, 1000);
document.getElementById('levelBadge').textContent = currentLevel.icon;
document.getElementById('levelName').textContent = currentLevel.name;

const progressPercent = ((displayPoints - currentLevel.min) / (currentLevel.max - currentLevel.min)) * 100;
document.getElementById('levelProgressFill').style.width = isFinite(progressPercent) ? Math.max(0,Math.min(100,progressPercent)) + '%' : '0%';
document.getElementById('levelProgressFill').textContent = isFinite(progressPercent) ? Math.round(Math.max(0,Math.min(100,progressPercent))) + '%' : '0%';

document.getElementById('memberDays').textContent = serverData.memberDays || 0;
document.getElementById('orderStreak').textContent = serverData.orderStreak || 0;
document.getElementById('avgPoints').textContent = serverData.avgPoints || 0;
document.getElementById('favoriteItem').textContent = serverData.favoriteItem || '-';
document.getElementById('weeklyOrders').textContent = serverData.weeklyOrders || 0;
document.getElementById('weeklyPoints').textContent = serverData.weeklyPoints || 0;
document.getElementById('weeklyChallenges').textContent = serverData.weeklyChallenges || 0;

// Calculate changes
const ordersChange = (serverData.weeklyOrders || 0) - (serverData.lastWeekOrders || 0);
const pointsChange = (serverData.weeklyPoints || 0) - (serverData.lastWeekPoints || 0);
const challengesChange = (serverData.weeklyChallenges || 0) - (serverData.lastWeekChallenges || 0);

function formatChange(change) {
  if (change > 0) return `↑ ${change} from last week`;
  if (change < 0) return `↓ ${Math.abs(change)} from last week`;
  return '0 from last week';
}

document.getElementById('ordersChange').textContent = formatChange(ordersChange);
document.getElementById('pointsChange').textContent = formatChange(pointsChange);
document.getElementById('challengesChange').textContent = formatChange(challengesChange);

// Update class for positive/negative
document.getElementById('ordersChange').className = `summary-change ${ordersChange >= 0 ? 'positive' : 'negative'}`;
document.getElementById('pointsChange').className = `summary-change ${pointsChange >= 0 ? 'positive' : 'negative'}`;
document.getElementById('challengesChange').className = `summary-change ${challengesChange >= 0 ? 'positive' : 'negative'}`;

// Use server-provided activities if available, otherwise build from orders/badges or show placeholder
const activities = (serverData.activities && serverData.activities.length) ? serverData.activities : [];
if (!activities.length) {
  (serverData.orders || []).forEach(o => activities.push({ date: o.created_at ? new Date(o.created_at).toLocaleDateString() : '—', title: 'Order completed', desc: `Order #${o.order_id || ''} - RM ${parseFloat(o.total_amount||0).toFixed(2)}`, points: `+${Math.floor(parseFloat(o.total_amount||0))} pts` }));
  (serverData.badges || []).forEach(b => activities.push({ date: b.earned_at ? new Date(b.earned_at).toLocaleDateString() : '—', title: 'Badge Unlocked', desc: b.name || 'Badge', points: '🏅' }));
}
if (activities.length === 0) activities.push({ date: '—', title: 'No activity yet', desc: 'Start ordering to see activity here', points: '' });
document.getElementById('activityTimeline').innerHTML = activities.map(a => `\n  <div class="timeline-item">\n    <div class="timeline-date">${a.date}</div>\n    <div class="timeline-content">\n      <h4>${a.title}</h4>\n      <p>${a.desc}</p>\n      <span class="timeline-points">${a.points}</span>\n    </div>\n  </div>`).join('');

const srvChallenges = serverData.challenges || [];
document.getElementById('challengeGrid').innerHTML = srvChallenges.map(ch => {
  const p = Math.min(100, Math.round((ch.current/ch.target)*100));
  let action = '';
  if (ch.completed && !ch.claimed) {
    action = `<button class="challenge-claim" data-id="${ch.id}">Claim ${ch.reward} pts</button>`;
  } else if (ch.claimed) {
    action = `<button class="challenge-claimed" disabled>Claimed</button>`;
  } else {
    action = `<span class="challenge-pending">In Progress</span>`;
  }
  return `
<div class="challenge-card">
  <div class="challenge-header">
    <span class="challenge-icon">🍔</span>
    <h3 class="challenge-title">${ch.name}</h3>
  </div>
  <p class="challenge-desc">${ch.desc}</p>
  <div class="challenge-progress">
    <div class="challenge-progress-bar">
      <div class="challenge-progress-fill" style="width:${p}%"></div>
    </div>
    <div class="challenge-status">
      <span>${ch.current} / ${ch.target}</span>
      <span>${p}%</span>
    </div>
  </div>
  <span class="challenge-reward">🎁 ${ch.reward} pts</span>
  ${action}
</div>`;
}).join('');

// Wire up challenge action buttons
// Wire up challenge claim buttons
document.querySelectorAll('.challenge-claim').forEach(btn => {
  btn.addEventListener('click', e => {
    const id = btn.getAttribute('data-id');
    if (!id) return;
    btn.disabled = true;
    btn.textContent = 'Claiming...';
    fetch('claim_challenge.php', { method: 'POST', body: new URLSearchParams({ challenge_id: id }) })
      .then(r => r.json())
      .then(res => {
        if (res && res.status === 'ok') {
          // Update points in UI
          const awarded = parseInt(res.awarded_points) || 0;
          serverData.points = (serverData.points || 0) + awarded;
          document.getElementById('levelDesc').textContent = `${Math.min(1000, serverData.points)} / ${currentLevel.max} points`;
          // Show success message
          alert(`Claimed ${awarded} points!`);
          // Reload to update challenge status and activities
          location.reload();
        } else if (res && res.status === 'already_claimed') {
          btn.textContent = 'Already claimed';
          alert('Already claimed.');
        } else {
          btn.disabled = false;
          btn.textContent = 'Try Again';
          console.error('Claim failed', res);
          alert('Claim failed. Check console for details.');
        }
      }).catch(err => { btn.disabled = false; btn.textContent = 'Try Again'; console.error(err); alert('Network error.'); });
  });
});

// Update challenges completed count
const completedCount = (serverData.challenges || []).filter(c => c.completed).length;
document.getElementById('weeklyChallenges').textContent = completedCount;

// Goals rendering (server-driven or default)
const goals = serverData.goals || [
  { icon: '🎯', title: 'Weekly Target', target: 'Order 5 times this week', desc: 'Stay consistent and earn bonus points!' },
  { icon: '🏅', title: 'Badge Hunter', target: 'Unlock 2 more badges', desc: 'You\'re so close to your next achievement!' },
  { icon: '💎', title: 'Point Milestone', target: 'Reach 1000 total points', desc: 'Become a Food Master and unlock exclusive perks!' }
];
document.getElementById('goalsGrid').innerHTML = goals.map(g => `\n<div class="goal-card">\n  <div class="goal-header">\n    <span class="goal-icon">${g.icon}</span>\n    <h3 class="goal-title">${g.title}</h3>\n  </div>\n  <div class="goal-target">${g.target}</div>\n  <p class="goal-desc">${g.desc}</p>\n</div>`).join('');

// Debug: print server payload when ?debug=1
try {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('debug') === '1') console.log('progress payload', serverData);
} catch (e) { /* ignore */ }
</script>
</body>
</html>
