<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progress Tracker - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="css/progress_tracker.css">

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
        <div class="next-level">
          <h3>Next Level</h3>
          <p id="nextLevelName">Food Enthusiast (200 pts)</p>
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
          <div class="summary-value" id="weeklyOrders">3</div>
          <div class="summary-label">Orders This Week</div>
          <div class="summary-change positive">↑ 2 from last week</div>
        </div>
        <div class="summary-item">
          <span class="summary-icon">⭐</span>
          <div class="summary-value" id="weeklyPoints">150</div>
          <div class="summary-label">Points Earned</div>
          <div class="summary-change positive">↑ 50 from last week</div>
        </div>
        <div class="summary-item">
          <span class="summary-icon">🎯</span>
          <div class="summary-value" id="weeklyChallenges">2</div>
          <div class="summary-label">Challenges Completed</div>
          <div class="summary-change positive">↑ 1 from last week</div>
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

  <script>
    // Get user data
    const userId = sessionStorage.getItem('userId');
    let userData = {
      points: 0,
      orders: [],
      joinDate: new Date().toISOString(),
      badges: []
    };

    if (userId) {
      const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
      const currentUser = users.find(u => u.id === userId);
      if (currentUser) {
        userData = {
          points: currentUser.points || 0,
          orders: currentUser.orders || [],
          joinDate: currentUser.joinDate || new Date().toISOString(),
          badges: currentUser.badges || []
        };
      }
    }

    // Level system
    const levels = [
      { name: "Food Beginner", icon: "🍽️", min: 0, max: 200 },
      { name: "Food Enthusiast", icon: "🍔", min: 200, max: 400 },
      { name: "Food Lover", icon: "❤️", min: 400, max: 800 },
      { name: "Chef Explorer", icon: "👨‍🍳", min: 800, max: 1000 },
      { name: "Food Master", icon: "🏆", min: 1000, max: Infinity }
    ];

    function getCurrentLevel() {
      return levels.find(l => userData.points >= l.min && userData.points < l.max) || levels[0];
    }

    function getNextLevel() {
      const currentIdx = levels.findIndex(l => l === getCurrentLevel());
      return levels[currentIdx + 1] || levels[levels.length - 1];
    }

    // Update level display
    const currentLevel = getCurrentLevel();
    const nextLevel = getNextLevel();
    
    document.getElementById('levelBadge').textContent = currentLevel.icon;
    document.getElementById('levelName').textContent = currentLevel.name;
    document.getElementById('levelDesc').textContent = `${userData.points} / ${currentLevel.max} points`;
    document.getElementById('nextLevelName').textContent = `${nextLevel.name} (${nextLevel.min} pts)`;
    
    const progressPercent = ((userData.points - currentLevel.min) / (currentLevel.max - currentLevel.min)) * 100;
    document.getElementById('levelProgressFill').style.width = progressPercent + '%';
    document.getElementById('levelProgressFill').textContent = Math.round(progressPercent) + '%';

    // Calculate statistics
    const joinDate = new Date(userData.joinDate);
    const today = new Date();
    const daysSinceMember = Math.floor((today - joinDate) / (1000 * 60 * 60 * 24));
    
    document.getElementById('memberDays').textContent = daysSinceMember;
    document.getElementById('orderStreak').textContent = Math.min(userData.orders.length, 7);
    document.getElementById('avgPoints').textContent = userData.orders.length > 0 
      ? Math.round(userData.points / userData.orders.length) 
      : 0;
    document.getElementById('favoriteItem').textContent = 'Nasi Lemak';

    // Generate timeline
    const activities = [
      { date: 'Today', title: 'Earned 50 Points', desc: 'Order completed: Nasi Lemak Special', points: '+50 pts' },
      { date: '2 Days Ago', title: 'Badge Unlocked', desc: 'Achieved "Food Lover" badge!', points: '🏅' },
      { date: '1 Week Ago', title: 'Level Up!', desc: 'Reached Food Enthusiast level', points: '⬆️' },
      { date: '2 Weeks Ago', title: 'Joined Chefify', desc: 'Welcome to the Chefify family!', points: '🎉' }
    ];

    const timelineHTML = activities.map(activity => `
      <div class="timeline-item">
        <div class="timeline-date">${activity.date}</div>
        <div class="timeline-content">
          <h4>${activity.title}</h4>
          <p>${activity.desc}</p>
          <span class="timeline-points">${activity.points}</span>
        </div>
      </div>
    `).join('');
    
    document.getElementById('activityTimeline').innerHTML = timelineHTML;

    // Generate challenges
    const challenges = [
      { icon: '🍔', title: 'Order Master', desc: 'Complete 5 orders this month', current: userData.orders.length, target: 5, reward: '100 pts' },
      { icon: '⭐', title: 'Point Collector', desc: 'Earn 500 total points', current: userData.points, target: 500, reward: '50 pts bonus' },
      { icon: '🎮', title: 'Game Champion', desc: 'Play 3 mini-games', current: 0, target: 3, reward: '10% discount' },
      { icon: '🌟', title: 'Review Hero', desc: 'Leave 5 reviews', current: 0, target: 5, reward: 'Free drink' }
    ];

    const challengeHTML = challenges.map(challenge => {
      const progress = Math.min((challenge.current / challenge.target) * 100, 100);
      return `
        <div class="challenge-card">
          <div class="challenge-header">
            <span class="challenge-icon">${challenge.icon}</span>
            <h3 class="challenge-title">${challenge.title}</h3>
          </div>
          <p class="challenge-desc">${challenge.desc}</p>
          <div class="challenge-progress">
            <div class="challenge-progress-bar">
              <div class="challenge-progress-fill" style="width: ${progress}%"></div>
            </div>
            <div class="challenge-status">
              <span>${challenge.current} / ${challenge.target}</span>
              <span>${Math.round(progress)}%</span>
            </div>
          </div>
          <span class="challenge-reward">🎁 ${challenge.reward}</span>
        </div>
      `;
    }).join('');
    
    document.getElementById('challengeGrid').innerHTML = challengeHTML;

    // Dynamic motivation messages
    const motivations = [
      { text: "You're on fire! Keep up the amazing work!", subtext: "Your dedication is truly inspiring", icon: "🔥" },
      { text: "Every order is a step towards greatness!", subtext: "You're building something special", icon: "🌟" },
      { text: "Amazing progress! You're a true food champion!", subtext: "Keep climbing to the top", icon: "🏆" },
      { text: "You're doing incredible! Stay hungry for success!", subtext: "Great things are coming your way", icon: "⭐" },
      { text: "Unstoppable! You're crushing your goals!", subtext: "Nothing can hold you back now", icon: "💪" }
    ];

    const randomMotivation = motivations[Math.floor(Math.random() * motivations.length)];
    document.querySelector('.motivation-icon').textContent = randomMotivation.icon;
    document.getElementById('motivationText').textContent = randomMotivation.text;
    document.getElementById('motivationSubtext').textContent = randomMotivation.subtext;

    // Generate goals
    const goals = [
      { icon: '🎯', title: 'Weekly Target', target: 'Order 5 times this week', desc: 'Stay consistent and earn bonus points!' },
      { icon: '🏅', title: 'Badge Hunter', target: 'Unlock 2 more badges', desc: 'You\'re so close to your next achievement!' },
      { icon: '💎', title: 'Point Milestone', target: 'Reach 1000 total points', desc: 'Become a Food Master and unlock exclusive perks!' },
      { icon: '🎁', title: 'Reward Seeker', target: 'Claim 3 rewards', desc: 'Don\'t forget to use your hard-earned rewards!' }
    ];

    const goalsHTML = goals.map(goal => `
      <div class="goal-card">
        <div class="goal-header">
          <span class="goal-icon">${goal.icon}</span>
          <h3 class="goal-title">${goal.title}</h3>
        </div>
        <div class="goal-target">${goal.target}</div>
        <p class="goal-desc">${goal.desc}</p>
      </div>
    `).join('');
    
    document.getElementById('goalsGrid').innerHTML = goalsHTML;
  </script>
</body>
</html>
