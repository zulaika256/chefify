<?php
require_once 'db.php';
// Ensure user is logged in and fetch their points + claimed vouchers
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
$userId = $_SESSION['user_id'];
$userPoints = 0;
$claimedVouchers = [];
$totalPointsEarned = 0;
try {
  $stmt = $pdo->prepare("SELECT points, total_points_earned FROM reward_points WHERE user_id = :uid");
  $stmt->execute([':uid' => $userId]);
  $r = $stmt->fetch();
  $userPoints = $r ? (int)$r['points'] : 0;
  $totalPointsEarned = $r ? (int)$r['total_points_earned'] : 0;

  // claimed vouchers (codes)
  $stmt = $pdo->prepare("SELECT code FROM user_vouchers WHERE user_id = :uid");
  $stmt->execute([':uid' => $userId]);
  $claimedVouchers = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
  error_log('Reward page fetch error: '.$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Points & Rewards - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="reward_point.css">

</head>

<body>

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
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About Us</a>
      <a href="contactus.php">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="profile.php">Profile</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>


<!-- SUCCESS MESSAGE -->
<div class="success-message" id="successMessage">
  ✓ Reward claimed successfully!
</div>

<main class="points-container">
  
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

  <!-- HEADER -->
  <div class="page-header">
    <h1>⭐ Points & Rewards</h1>
    <p>Earn points with every order and unlock exclusive rewards!</p>
  </div>

  <!-- POINTS BALANCE -->
  <div class="points-balance">
    <div class="balance-label">Your Points Balance</div>
    <div class="balance-value" id="userPoints">0</div>
    <div class="balance-subtitle">Keep earning to unlock more rewards!</div>
  </div>

  <!-- HOW TO EARN POINTS -->
  <div class="earn-section">
    <h2>💰 How to Earn Points</h2>
    
    <div class="earn-grid">
      <div class="earn-item">
        <div class="earn-icon">🛒</div>
        <div class="earn-title">Small Orders</div>
        <div class="earn-points">+5 pts</div>
        <p style="margin-top:0.5rem;color:#666;font-size:0.9rem;">RM 10 - RM 29</p>
      </div>
      
      <div class="earn-item">
        <div class="earn-icon">🍱</div>
        <div class="earn-title">Medium Orders</div>
        <div class="earn-points">+10 pts</div>
        <p style="margin-top:0.5rem;color:#666;font-size:0.9rem;">RM 30 - RM 49</p>
      </div>
      
      <div class="earn-item">
        <div class="earn-icon">🍽️</div>
        <div class="earn-title">Large Orders</div>
        <div class="earn-points">+25 pts</div>
        <p style="margin-top:0.5rem;color:#666;font-size:0.9rem;">RM 50 - RM 99</p>
      </div>
      
      <div class="earn-item">
        <div class="earn-icon">👑</div>
        <div class="earn-title">Premium Orders</div>
        <div class="earn-points">+50 pts</div>
        <p style="margin-top:0.5rem;color:#666;font-size:0.9rem;">RM 100+</p>
      </div>
    </div>
  </div>

  <!-- AVAILABLE REWARDS -->
  <div class="rewards-section">
    <h2>🎁 Available Rewards</h2>
    <p>Redeem your points for amazing discounts and exclusive rewards!</p>
    
    <div class="rewards-grid" id="rewardsGrid">
      <!-- Rewards will be populated by JavaScript -->
    </div>
  </div>

</main>

<!-- FOOTER -->
<footer>
  <div class="footer-container">
    
    <!-- Footer Top -->
    <div class="footer-top">
      
      <!-- Logo & Social Section -->
      <div class="footer-logo-section">
        <div class="footer-logo">
          <img src="img/chefify.jpg" alt="Chefify Logo" onerror="this.src='https://via.placeholder.com/70/4b2e19/FFFFFF?text=C'">
          <span class="footer-logo-text">Chefify</span>
        </div>
        
        <p class="footer-tagline">
          Delicious moments, rewarding experiences. Order now and earn points with every meal!
        </p>
        
        <div class="footer-social">
          <a href="https://www.tiktok.com/@chefifyapp?_r=1&_t=ZS-92RNDS9aRWs" target="_blank" rel="noopener" class="social-icon" title="Follow us on TikTok">
            <img src="img/tiktok.png" alt="TikTok">
          </a>
          <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" rel="noopener" class="social-icon" title="Follow us on Instagram">
            <img src="img/instagram.webp" alt="Instagram">
          </a>
        </div>
      </div>
      
      <!-- Contact Info -->
      <div class="footer-section">
        <h3>Get in Touch</h3>
        
        <div class="contact-item">
          <span class="contact-icon">📍</span>
          <div class="contact-text">
            Kuala Lumpur, Malaysia
          </div>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">📧</span>
          <div class="contact-text">
            <a href="mailto:hello@chefify.com">hello@chefify.com</a>
          </div>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">📱</span>
          <div class="contact-text">
            <a href="tel:+60123456789">+603-2688 8888</a>
          </div>
        </div>
      </div>
      
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div>
        © 2025 Chefify. All rights reserved.
      </div>
      <ul class="footer-links-inline">
        <li><a href="privacy.php">Privacy Policy</a></li>
        <li><a href="terms.php">Terms of Service</a></li>
        <li><a href="cookies.php">Cookie Policy</a></li>
      </ul>
    </div>
    
  </div>
</footer>

</html>

<script>
// Server-provided user data (prepared at top of file)
const userId = <?php echo json_encode($userId); ?>;
let userPoints = <?php echo (int)$userPoints; ?>;
let totalPointsEarned = <?php echo (int)$totalPointsEarned; ?>;
const claimedVouchers = <?php echo json_encode($claimedVouchers); ?>;
let currentUser = null;

// Available rewards
const rewards = [
  {
    id: 'reward1',
    title: '5% OFF Voucher',
    description: 'Get 5% discount on your next order. Valid for 30 days.',
    cost: 50,
    icon: '🎫',
    image: 'img/reward_5percent.jpg'
  },
  {
    id: 'reward2',
    title: '10% OFF Voucher',
    description: 'Get 10% discount on your next order. Valid for 30 days.',
    cost: 100,
    icon: '🎟️',
    image: 'img/reward_10percent.jpg'
  },
  {
    id: 'reward3',
    title: 'Free Dessert',
    description: 'Get a free dessert of your choice with any order above RM 30.',
    cost: 150,
    icon: '🍰',
    image: 'img/reward_dessert.jpg'
  },
  {
    id: 'reward4',
    title: '15% OFF Voucher',
    description: 'Get 15% discount on your next order. Valid for 30 days.',
    cost: 200,
    icon: '🎉',
    image: 'img/reward_15percent.jpg'
  },
  {
    id: 'reward5',
    title: 'Free Delivery',
    description: 'Free delivery on your next 3 orders. No minimum purchase required.',
    cost: 250,
    icon: '🚗',
    image: 'img/reward_delivery.jpg'
  },
  {
    id: 'reward6',
    title: '20% OFF Voucher',
    description: 'Get 20% discount on your next order. Valid for 30 days.',
    cost: 300,
    icon: '💎',
    image: 'img/reward_20percent.jpg'
  },
  {
    id: 'reward7',
    title: 'Premium Meal Free',
    description: 'Get any premium meal free with purchase of RM 50 or more.',
    cost: 400,
    icon: '👑',
    image: 'img/reward_premium.jpg'
  },
  {
    id: 'reward8',
    title: 'VIP Member (1 Month)',
    description: 'Enjoy VIP perks: priority orders, exclusive discounts, and free delivery.',
    cost: 500,
    icon: '⭐',
    image: 'img/reward_vip.jpg'
  }
];

// Initialize page
function initPage() {
  // Try to load local user (fallback), but prefer server-provided points and claimed vouchers
  if (userId) {
    const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
    currentUser = users.find(u => u.id === userId) || null;
  }

  // Ensure userPoints (from server) is a number
  if (typeof userPoints !== 'number') {
    userPoints = currentUser ? (currentUser.points || 0) : 0;
  }

  document.getElementById('userPoints').textContent = userPoints;
  renderRewards();
}

// Render rewards grid
function renderRewards() {
  const rewardsGrid = document.getElementById('rewardsGrid');

  rewardsGrid.innerHTML = rewards.map(reward => {
    // Determine claimed status from server-provided claimedVouchers (codes may be like 'reward1-XXXX')
    const isClaimedFromServer = Array.isArray(claimedVouchers) && claimedVouchers.some(code => String(code).startsWith(reward.id));
    const isClaimedLocal = currentUser && currentUser.claimedRewards && currentUser.claimedRewards.includes(reward.id);
    const isClaimed = isClaimedFromServer || isClaimedLocal;

    const canClaim = userPoints >= reward.cost && !isClaimed;
    const progress = Math.min((userPoints / reward.cost) * 100, 100);

    let cardClass = 'reward-card';
    let buttonClass = 'reward-btn';
    let buttonText = 'Claim Reward';

    if (isClaimed) {
      cardClass += ' unlocked';
      buttonClass += ' claimed';
      buttonText = '✓ Claimed';
    } else if (!canClaim) {
      cardClass += ' locked';
      buttonClass += ' locked';
      buttonText = `Need ${reward.cost - userPoints} more pts`;
    } else {
      buttonClass += ' claim';
    }

    return `
      <div class="${cardClass}">
        <div class="reward-image">
          <img src="${reward.image}" alt="${reward.title}" 
               onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\\'font-size:4rem\\'>${reward.icon}</div>';">
        </div>
        <div class="reward-body">
          <div class="reward-header">
            <h3 class="reward-title">${reward.title}</h3>
            <span class="reward-cost">${reward.cost} pts</span>
          </div>
          <p class="reward-description">${reward.description}</p>

          ${!isClaimed ? `
            <div class="reward-progress">
              <div class="progress-label">${userPoints} / ${reward.cost} points</div>
              <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width:${progress}%"></div>
              </div>
            </div>
          ` : ''}

          <button class="${buttonClass}" 
                  onclick="claimReward('${reward.id}', ${reward.cost})"
                  ${!canClaim ? 'disabled' : ''}>
            ${buttonText}
          </button>
        </div>
      </div>
    `;
  }).join('');
}

// Claim reward
async function claimReward(rewardId, cost) {
  if (!userId) {
    alert('Please login to claim rewards.');
    return;
  }

  try {
    const res = await fetch('claim_reward.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ rewardId: rewardId, cost: cost })
    });
    const data = await res.json();
    if (!data.success) {
      alert(data.message || 'Unable to claim reward');
      return;
    }

    // Update UI with server response
    userPoints = data.newPoints;
    document.getElementById('userPoints').textContent = userPoints;
    showSuccessMessage();

    // Add voucher code to claimed list (server-side)
    if (data.code) {
      claimedVouchers.push(data.code);
      alert('Your voucher code: ' + data.code);
    }

    renderRewards();
  } catch (err) {
    console.error(err);
    alert('Error claiming reward.');
  }
}

// Show success message
function showSuccessMessage() {
  const message = document.getElementById('successMessage');
  message.classList.add('show');
  
  setTimeout(() => {
    message.classList.remove('show');
  }, 3000);
}

// Initialize page on load
initPage();
</script>

</body>
</html>