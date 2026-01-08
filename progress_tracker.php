<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progress Tracker - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <style>
    :root {
      --chef-brown: #64281a;
      --peach-1: #ff9682;
      --peach-2: #ffb4a8;
      --cream: #fff5f0;
      --light-peach: #ffdde0;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #fff5f0 0%, #ffe8e0 100%);
      min-height: 100vh;
    }

    /* ================= NAV ================= */
    nav {
      position: sticky;
      top: 0;
      z-index: 999;
      background: transparent;
      padding: 1.25rem 0;
      backdrop-filter: blur(4px);
    }

    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      z-index: 2;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 18px;
      text-decoration: none;
    }

    .logo-img {
      height: 60px;
      width: auto;
      border-radius: 50%;
      border: 2px solid #ffdde0;
      box-shadow: 0 4px 12px rgba(100, 40, 20, 0.35);
    }

    .logo-text {
      font-size: 1.6rem;
      font-weight: 800;
      color: var(--chef-brown);
      letter-spacing: 0.5px;
    }

    .nav-links {
      display: flex;
      gap: 0.35rem;
      align-items: center;
    }

    .nav-links a {
      color: var(--chef-brown);
      text-decoration: none;
      padding: 0.45rem 0.9rem;
      border-radius: 20px;
      font-weight: 600;
      transition: all .22s ease;
    }

    .nav-links a:hover {
      color: white;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      box-shadow: 0 6px 18px rgba(255, 150, 130, 0.18);
      transform: translateY(-3px);
    }

    .nav-links a.active {
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
    }

    /* ================= PROGRESS TRACKER ================= */
    .tracker-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem 4rem;
    }

    .page-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .page-header h1 {
      font-size: 3.5rem;
      color: var(--chef-brown);
      margin-bottom: 0.5rem;
      font-weight: 800;
    }

    .page-header p {
      font-size: 1.2rem;
      color: #8b4c3a;
    }

    /* Level Progress Card */
    .level-card {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
      position: relative;
      overflow: hidden;
    }

    .level-card::before {
      content: '⭐';
      position: absolute;
      font-size: 15rem;
      opacity: 0.03;
      top: -50px;
      right: -50px;
    }

    .level-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .current-level {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .level-badge {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      box-shadow: 0 8px 25px rgba(255, 150, 130, 0.3);
    }

    .level-info h2 {
      font-size: 2rem;
      color: var(--chef-brown);
      margin-bottom: 0.3rem;
    }

    .level-info p {
      color: #8b4c3a;
      font-size: 1rem;
    }

    .next-level {
      text-align: right;
    }

    .next-level h3 {
      color: var(--peach-1);
      font-size: 1.2rem;
      margin-bottom: 0.3rem;
    }

    .next-level p {
      color: #8b4c3a;
      font-size: 0.95rem;
    }

    .level-progress-bar {
      background: #f0f0f0;
      height: 20px;
      border-radius: 10px;
      overflow: hidden;
      position: relative;
    }

    .level-progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--peach-1), var(--peach-2));
      border-radius: 10px;
      transition: width 1s ease;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding-right: 10px;
      color: white;
      font-size: 0.85rem;
      font-weight: 700;
    }

    /* Statistics Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 8px 25px rgba(100, 40, 20, 0.1);
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }

    .stat-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 35px rgba(100, 40, 20, 0.15);
      border-color: var(--peach-1);
    }

    .stat-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      display: block;
    }

    .stat-value {
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--chef-brown);
      margin-bottom: 0.5rem;
    }

    .stat-label {
      color: #8b4c3a;
      font-size: 1rem;
      font-weight: 600;
    }

    /* Activity Timeline */
    .timeline-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .section-title {
      font-size: 2rem;
      color: var(--chef-brown);
      margin-bottom: 2rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .timeline {
      position: relative;
      padding-left: 3rem;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 20px;
      top: 0;
      bottom: 0;
      width: 3px;
      background: linear-gradient(180deg, var(--peach-1), var(--peach-2));
    }

    .timeline-item {
      position: relative;
      margin-bottom: 2rem;
      padding-left: 2rem;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -3.1rem;
      top: 5px;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background: white;
      border: 3px solid var(--peach-1);
      box-shadow: 0 0 0 4px rgba(255, 150, 130, 0.2);
    }

    .timeline-date {
      color: var(--peach-1);
      font-size: 0.85rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
    }

    .timeline-content {
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
      padding: 1.5rem;
      border-radius: 16px;
      border-left: 4px solid var(--peach-1);
    }

    .timeline-content h4 {
      color: var(--chef-brown);
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .timeline-content p {
      color: #8b4c3a;
      font-size: 0.95rem;
      line-height: 1.6;
    }

    .timeline-points {
      display: inline-block;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 700;
      margin-top: 0.5rem;
    }

    /* Challenges Section */
    .challenges-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .challenge-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
    }

    .challenge-card {
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
      border-radius: 20px;
      padding: 2rem;
      border: 2px solid rgba(255, 150, 130, 0.2);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .challenge-card::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 150, 130, 0.1), transparent);
      animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.5; }
      50% { transform: scale(1.2); opacity: 0.8; }
    }

    .challenge-card:hover {
      transform: translateY(-5px);
      border-color: var(--peach-1);
      box-shadow: 0 10px 30px rgba(100, 40, 20, 0.15);
    }

    .challenge-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
      position: relative;
      z-index: 1;
    }

    .challenge-icon {
      font-size: 2rem;
    }

    .challenge-title {
      font-size: 1.3rem;
      color: var(--chef-brown);
      font-weight: 700;
    }

    .challenge-desc {
      color: #8b4c3a;
      margin-bottom: 1rem;
      line-height: 1.6;
      position: relative;
      z-index: 1;
    }

    .challenge-progress {
      position: relative;
      z-index: 1;
    }

    .challenge-progress-bar {
      background: white;
      height: 12px;
      border-radius: 6px;
      overflow: hidden;
      margin-bottom: 0.5rem;
    }

    .challenge-progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--peach-1), var(--peach-2));
      border-radius: 6px;
      transition: width 0.5s ease;
    }

    .challenge-status {
      display: flex;
      justify-content: space-between;
      font-size: 0.9rem;
      color: #8b4c3a;
      font-weight: 600;
    }

    .challenge-reward {
      display: inline-block;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 700;
      margin-top: 1rem;
    }

    /* Motivation Card */
    .motivation-card {
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      border-radius: 24px;
      padding: 3rem 2.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 15px 50px rgba(255, 150, 130, 0.4);
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .motivation-card::before {
      content: '✨';
      position: absolute;
      font-size: 20rem;
      opacity: 0.1;
      top: -80px;
      right: -50px;
      animation: float 6s ease-in-out infinite;
    }

    .motivation-icon {
      font-size: 4rem;
      margin-bottom: 1rem;
      animation: float 3s ease-in-out infinite;
    }

    .motivation-text {
      font-size: 1.8rem;
      font-weight: 700;
      line-height: 1.4;
      margin-bottom: 0.5rem;
      position: relative;
      z-index: 1;
    }

    .motivation-subtext {
      font-size: 1.1rem;
      opacity: 0.95;
      position: relative;
      z-index: 1;
    }

    /* Goals Section */
    .goals-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .goals-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    .goal-card {
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
      border-radius: 16px;
      padding: 1.8rem;
      border-left: 5px solid var(--peach-1);
      transition: all 0.3s ease;
    }

    .goal-card:hover {
      transform: translateX(10px);
      box-shadow: 0 8px 25px rgba(100, 40, 20, 0.12);
    }

    .goal-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .goal-icon {
      font-size: 2rem;
    }

    .goal-title {
      font-size: 1.2rem;
      color: var(--chef-brown);
      font-weight: 700;
    }

    .goal-target {
      color: var(--peach-1);
      font-weight: 700;
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .goal-desc {
      color: #8b4c3a;
      font-size: 0.95rem;
      line-height: 1.5;
    }

    /* Weekly Summary */
    .summary-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .summary-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-top: 1.5rem;
    }

    .summary-item {
      text-align: center;
      padding: 1.5rem;
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
      border-radius: 16px;
      transition: all 0.3s ease;
    }

    .summary-item:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(100, 40, 20, 0.12);
    }

    .summary-icon {
      font-size: 2.5rem;
      margin-bottom: 0.8rem;
      display: block;
    }

    .summary-value {
      font-size: 2rem;
      font-weight: 800;
      color: var(--chef-brown);
      margin-bottom: 0.3rem;
    }

    .summary-label {
      color: #8b4c3a;
      font-size: 0.95rem;
      font-weight: 600;
    }

    .summary-change {
      margin-top: 0.5rem;
      font-size: 0.85rem;
      font-weight: 700;
    }

    .summary-change.positive {
      color: #22c55e;
    }

    .summary-change.neutral {
      color: #8b4c3a;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .page-header h1 {
        font-size: 2.5rem;
      }

      .level-header {
        flex-direction: column;
        align-items: flex-start;
      }

      .next-level {
        text-align: left;
      }

      .milestone-path {
        flex-wrap: wrap;
        gap: 2rem;
      }

      .milestone-path::before {
        display: none;
      }

      .summary-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
      }
    }

    @media (max-width: 600px) {
      .page-header h1 {
        font-size: 2rem;
      }

      .level-card,
      .timeline-section,
      .challenges-section,
      .milestone-section {
        padding: 1.5rem;
      }

      .timeline {
        padding-left: 2rem;
      }

      .milestone-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- NAV -->
  <nav>
    <div class="nav-container">
      <a class="logo" href="home.html">
        <img src="img/chefify.jpg" class="logo-img" alt="Chefify Logo">
        <span class="logo-text">Chefify</span>
      </a>
      <div class="nav-links">
        <a href="home.html">Home</a>
        <a href="menu.html">Menu</a>
        <a href="cart.html">Cart</a>
        <a href="dashboard.html">Dashboard</a>
        <a href="locations.html">Locations</a>
        <a href="aboutus.html">About</a>
        <a href="contactus.html">Contact Us</a>
        <a href="index.html">Logout</a>
      </div>
    </div>
  </nav>

  <!-- PROGRESS TRACKER CONTAINER -->
  <div class="tracker-container">
    
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