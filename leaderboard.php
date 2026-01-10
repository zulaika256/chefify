<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leaderboard - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="css/leaderboard.css">

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

  <!-- LEADERBOARD CONTAINER -->
  <div class="leaderboard-container">

  <main class="points-container">
  
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
    
    <!-- PAGE HEADER -->
    <div class="page-header">
      <h1>🏆 Leaderboard</h1>
      <p>Compete with fellow food lovers and climb to the top!</p>
    </div>

    <!-- TIMER CARD -->
    <div class="timer-card">
      <h3>⏰ Weekly Leaderboard Resets In</h3>
      <div class="timer-display" id="countdown">2d 15h 32m</div>
    </div>

    <!-- TABS -->
    <div class="tabs-container">
      <button class="tab-btn active" onclick="switchTab('overall')">🏆 Overall</button>
      <button class="tab-btn" onclick="switchTab('weekly')">📅 This Week</button>
      <button class="tab-btn" onclick="switchTab('monthly')">📊 This Month</button>
      <button class="tab-btn" onclick="switchTab('newcomers')">🌟 Newcomers</button>
      <button class="tab-btn" onclick="switchTab('minigame')">🎮 Mini-Game Stars</button>
    </div>

    <!-- TOP 3 PODIUM -->
    <div class="podium-section">
      <h2 class="podium-title">🏅 Top 3 Champions</h2>
      <div class="podium" id="podium">
        <!-- Podium will be generated here -->
      </div>
    </div>

    <!-- YOUR POSITION -->
    <div class="your-position-card">
      <div class="your-position-info">
        <div class="your-avatar">👤</div>
        <div class="your-details">
          <h3>Your Rank: <span id="yourRank">#25</span></h3>
          <p id="yourPoints">450 points</p>
        </div>
      </div>
      <div class="your-motivation">
        <div class="motivation-text" id="motivationMsg">Keep climbing! 🚀</div>
        <div class="points-needed" id="pointsNeeded">Only 50 points to reach Top 20!</div>
      </div>
    </div>

    <!-- LEADERBOARD TABLE -->
    <div class="leaderboard-table-section">
      <h2 class="table-title">📊 Full Rankings</h2>
      <div class="leaderboard-table" id="leaderboardTable">
        <!-- Table rows will be generated here -->
      </div>
    </div>

    <!-- REWARDS -->
    <div class="rewards-section">
      <h2 class="rewards-title">🎁 Leaderboard Rewards</h2>
      <div class="rewards-grid">
        <div class="reward-card">
          <div class="reward-icon">🥇</div>
          <div class="reward-rank">1st Place</div>
          <div class="reward-prize">500 Bonus Points + RM50 Voucher</div>
        </div>
        <div class="reward-card">
          <div class="reward-icon">🥈</div>
          <div class="reward-rank">2nd Place</div>
          <div class="reward-prize">300 Bonus Points + RM30 Voucher</div>
        </div>
        <div class="reward-card">
          <div class="reward-icon">🥉</div>
          <div class="reward-rank">3rd Place</div>
          <div class="reward-prize">200 Bonus Points + RM20 Voucher</div>
        </div>
        <div class="reward-card">
          <div class="reward-icon">🏅</div>
          <div class="reward-rank">Top 10</div>
          <div class="reward-prize">Exclusive "Elite" Badge</div>
        </div>
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
    // Get current user data
    const userId = sessionStorage.getItem('userId');
    let currentUserPoints = 0;

    if (userId) {
      const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
      const currentUser = users.find(u => u.id === userId);
      if (currentUser) {
        currentUserPoints = currentUser.points || 0;
      }
    }

    // Sample leaderboard data (in real app, fetch from backend)
    let leaderboardData = [
      { id: '1', username: 'FoodMaster_88', points: 1250, level: 'Food Master', badges: 8, avatar: '👑', movement: 'same' },
      { id: '2', username: 'ChefLover_42', points: 1100, level: 'Chef Explorer', badges: 7, avatar: '🍕', movement: 'up' },
      { id: '3', username: 'TastyHunter', points: 980, level: 'Chef Explorer', badges: 6, avatar: '🍔', movement: 'down' },
      { id: '4', username: 'NomNomQueen', points: 850, level: 'Food Lover', badges: 5, avatar: '👸', movement: 'up' },
      { id: '5', username: 'SpicyKing_99', points: 720, level: 'Food Lover', badges: 5, avatar: '🌶️', movement: 'same' },
      { id: '6', username: 'CurryAddict', points: 650, level: 'Food Enthusiast', badges: 4, avatar: '🍛', movement: 'up' },
      { id: '7', username: 'SushiSamurai', points: 580, level: 'Food Enthusiast', badges: 4, avatar: '🍣', movement: 'down' },
      { id: '8', username: 'BubbleTeaBae', points: 520, level: 'Food Enthusiast', badges: 3, avatar: '🧋', movement: 'up' },
      { id: '9', username: 'RamenRider', points: 490, level: 'Food Enthusiast', badges: 3, avatar: '🍜', movement: 'same' },
      { id: '10', username: 'DessertDiva', points: 460, level: 'Food Enthusiast', badges: 3, avatar: '🍰', movement: 'up' }
    ];

    // Add current user if not in top 10
    const currentUserIndex = leaderboardData.findIndex(u => u.id === userId);
    if (currentUserIndex === -1 && userId) {
      leaderboardData.push({
        id: userId,
        username: sessionStorage.getItem('username') || 'You',
        points: currentUserPoints,
        level: 'Food Beginner',
        badges: 2,
        avatar: '👤',
        movement: 'up'
      });
    }

    // Sort by points
    leaderboardData.sort((a, b) => b.points - a.points);

    // Render Top 3 Podium
    function renderPodium() {
      const podium = document.getElementById('podium');
      const top3 = leaderboardData.slice(0, 3);
      
      const medals = ['🥇', '🥈', '🥉'];
      const positions = ['first', 'second', 'third'];
      
      podium.innerHTML = top3.map((user, index) => `
        <div class="podium-place ${positions[index]}">
          <div class="podium-avatar">
            ${index === 0 ? '<div class="crown">👑</div>' : ''}
            ${user.avatar}
          </div>
          <div class="podium-base">
            <div class="podium-rank">${medals[index]}</div>
            <div class="podium-name">${user.username}</div>
            <div class="podium-level">${user.level}</div>
            <div class="podium-points">${user.points} pts</div>
          </div>
        </div>
      `).join('');
    }

    // Render Leaderboard Table
    function renderTable() {
      const table = document.getElementById('leaderboardTable');
      
      const tableHTML = leaderboardData.map((user, index) => {
        const rank = index + 1;
        const isCurrentUser = user.id === userId;
        const movementIcon = user.movement === 'up' ? '↑' : user.movement === 'down' ? '↓' : '→';
        const movementClass = user.movement === 'up' ? 'up' : user.movement === 'down' ? 'down' : 'same';
        
        return `
          <div class="table-row ${isCurrentUser ? 'current-user' : ''}">
            <div class="rank-cell">
              #${rank}
              <span class="rank-movement ${movementClass}">${movementIcon}</span>
            </div>
            <div class="avatar-cell">${user.avatar}</div>
            <div class="user-info">
              <div class="username">${user.username} ${isCurrentUser ? '(You)' : ''}</div>
              <div class="user-level">${user.level}</div>
            </div>
            <div class="level-cell">${user.level}</div>
            <div class="points-cell">${user.points}</div>
            <div class="badges-cell">${user.badges} 🏅</div>
          </div>
        `;
      }).join('');
      
      table.innerHTML = tableHTML;
    }

    // Update Your Position Card
    function updateYourPosition() {
      const userIndex = leaderboardData.findIndex(u => u.id === userId);
      const rank = userIndex + 1;
      
      document.getElementById('yourRank').textContent = `#${rank}`;
      document.getElementById('yourPoints').textContent = `${currentUserPoints} points`;
      
      // Motivational messages
      if (rank <= 3) {
        document.getElementById('motivationMsg').textContent = "You're a champion! 🏆";
        document.getElementById('pointsNeeded').textContent = "Keep defending your position!";
      } else if (rank <= 10) {
        document.getElementById('motivationMsg').textContent = "You're in the Top 10! 🌟";
        const pointsToNext = leaderboardData[userIndex - 1].points - currentUserPoints + 1;
        document.getElementById('pointsNeeded').textContent = `${pointsToNext} points to overtake #${rank - 1}`;
      } else {
        document.getElementById('motivationMsg').textContent = "Keep climbing! 🚀";
        const pointsToTop10 = leaderboardData[9].points - currentUserPoints + 1;
        document.getElementById('pointsNeeded').textContent = `Only ${pointsToTop10} points to reach Top 10!`;
      }
    }

    // Countdown Timer
    function updateCountdown() {
      const now = new Date();
      const nextMonday = new Date();
      nextMonday.setDate(now.getDate() + ((1 + 7 - now.getDay()) % 7 || 7));
      nextMonday.setHours(0, 0, 0, 0);
      
      const diff = nextMonday - now;
      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      
      document.getElementById('countdown').textContent = `${days}d ${hours}h ${minutes}m`;
    }

    // Switch Tabs
    function switchTab(tab) {
      const tabs = document.querySelectorAll('.tab-btn');
      tabs.forEach(t => t.classList.remove('active'));
      event.target.classList.add('active');
      
      // In a real app, you'd fetch different data based on the tab
      console.log('Switched to:', tab);
    }

    // Initialize
    renderPodium();
    renderTable();
    updateYourPosition();
    updateCountdown();
    setInterval(updateCountdown, 60000); // Update every minute
  </script>
</body>
</html>
