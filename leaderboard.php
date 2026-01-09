<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leaderboard - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <style>
    :root {
      --chef-brown: #64281a;
      --peach-1: #ff9682;
      --peach-2: #ffb4a8;
      --cream: #fff5f0;
      --light-peach: #ffdde0;
      --gold: #ffd700;
      --silver: #c0c0c0;
      --bronze: #cd7f32;
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

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    @keyframes shine {
      0% { background-position: -200%; }
      100% { background-position: 200%; }
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

    /* ================= LEADERBOARD ================= */
    .leaderboard-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem 4rem;
    }

    .page-header {
      text-align: center;
      margin-bottom: 2rem;
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

    /* Timer Card */
    .timer-card {
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      border-radius: 20px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      text-align: center;
      color: white;
      box-shadow: 0 10px 30px rgba(255, 150, 130, 0.3);
    }

    .timer-card h3 {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
    }

    .timer-display {
      font-size: 2rem;
      font-weight: 800;
      letter-spacing: 2px;
    }

    /* Tabs */
    .tabs-container {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .tab-btn {
      background: white;
      border: 2px solid rgba(255, 150, 130, 0.3);
      padding: 0.8rem 1.5rem;
      border-radius: 20px;
      font-weight: 700;
      color: var(--chef-brown);
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1rem;
    }

    .tab-btn:hover {
      border-color: var(--peach-1);
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 150, 130, 0.2);
    }

    .tab-btn.active {
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      border-color: transparent;
      box-shadow: 0 8px 25px rgba(255, 150, 130, 0.3);
    }

    /* Top 3 Podium */
    .podium-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .podium-title {
      font-size: 2rem;
      color: var(--chef-brown);
      margin-bottom: 2rem;
      font-weight: 700;
      text-align: center;
    }

    .podium {
      display: flex;
      align-items: flex-end;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .podium-place {
      text-align: center;
      position: relative;
    }

    .podium-place.first {
      order: 2;
    }

    .podium-place.second {
      order: 1;
    }

    .podium-place.third {
      order: 3;
    }

    .podium-avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin: 0 auto 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      border: 5px solid;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .podium-place.first .podium-avatar {
      width: 120px;
      height: 120px;
      border-color: var(--gold);
      background: linear-gradient(135deg, #ffd700, #ffed4e);
      animation: float 3s ease-in-out infinite;
    }

    .podium-place.second .podium-avatar {
      border-color: var(--silver);
      background: linear-gradient(135deg, #c0c0c0, #e8e8e8);
    }

    .podium-place.third .podium-avatar {
      border-color: var(--bronze);
      background: linear-gradient(135deg, #cd7f32, #e8a87c);
    }

    .crown {
      position: absolute;
      top: -25px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 2rem;
      animation: float 2s ease-in-out infinite;
    }

    .podium-rank {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
    }

    .podium-place.first .podium-rank { color: var(--gold); }
    .podium-place.second .podium-rank { color: var(--silver); }
    .podium-place.third .podium-rank { color: var(--bronze); }

    .podium-name {
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--chef-brown);
      margin-bottom: 0.3rem;
    }

    .podium-level {
      font-size: 0.9rem;
      color: var(--peach-1);
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .podium-points {
      font-size: 1.1rem;
      font-weight: 700;
      color: #8b4c3a;
    }

    .podium-base {
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
      padding: 1.5rem 1rem;
      border-radius: 12px;
      margin-top: 1rem;
    }

    .podium-place.first .podium-base {
      padding: 2rem 1rem;
    }

    /* Your Position Card */
    .your-position-card {
      background: linear-gradient(135deg, rgba(255, 150, 130, 0.1), rgba(255, 180, 168, 0.1));
      border: 3px solid var(--peach-1);
      border-radius: 20px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .your-position-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .your-avatar {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      border: 3px solid white;
      box-shadow: 0 6px 20px rgba(255, 150, 130, 0.3);
    }

    .your-details h3 {
      font-size: 1.3rem;
      color: var(--chef-brown);
      margin-bottom: 0.3rem;
    }

    .your-details p {
      color: #8b4c3a;
      font-weight: 600;
    }

    .your-motivation {
      text-align: right;
      flex: 1;
      min-width: 200px;
    }

    .motivation-text {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--peach-1);
      margin-bottom: 0.3rem;
    }

    .points-needed {
      font-size: 0.95rem;
      color: #8b4c3a;
    }

    /* Leaderboard Table */
    .leaderboard-table-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .table-title {
      font-size: 2rem;
      color: var(--chef-brown);
      margin-bottom: 1.5rem;
      font-weight: 700;
    }

    .leaderboard-table {
      width: 100%;
    }

    .table-row {
      display: grid;
      grid-template-columns: 80px 80px 1fr 150px 120px 100px;
      gap: 1rem;
      align-items: center;
      padding: 1.2rem 1rem;
      border-radius: 16px;
      margin-bottom: 0.8rem;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
    }

    .table-row:hover {
      transform: translateX(10px);
      box-shadow: 0 6px 20px rgba(100, 40, 20, 0.1);
    }

    .table-row.current-user {
      background: linear-gradient(135deg, rgba(255, 150, 130, 0.2), rgba(255, 180, 168, 0.2));
      border: 2px solid var(--peach-1);
    }

    .rank-cell {
      font-size: 1.5rem;
      font-weight: 800;
      text-align: center;
    }

    .rank-movement {
      font-size: 0.9rem;
      margin-left: 0.3rem;
    }

    .rank-movement.up { color: #22c55e; }
    .rank-movement.down { color: #ef4444; }
    .rank-movement.same { color: #8b4c3a; opacity: 0.6; }

    .avatar-cell {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--light-peach), var(--peach-2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      border: 3px solid white;
      box-shadow: 0 4px 12px rgba(100, 40, 20, 0.2);
    }

    .user-info {
      display: flex;
      flex-direction: column;
      gap: 0.3rem;
    }

    .username {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--chef-brown);
    }

    .user-level {
      font-size: 0.85rem;
      color: var(--peach-1);
      font-weight: 600;
    }

    .level-cell {
      text-align: center;
      font-weight: 700;
      color: var(--chef-brown);
      font-size: 1rem;
    }

    .points-cell {
      text-align: center;
      font-size: 1.3rem;
      font-weight: 800;
      color: var(--peach-1);
    }

    .badges-cell {
      text-align: center;
      font-size: 1rem;
      color: #8b4c3a;
      font-weight: 600;
    }

    /* Rewards Section */
    .rewards-section {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      margin-top: 2rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
    }

    .rewards-title {
      font-size: 2rem;
      color: var(--chef-brown);
      margin-bottom: 1.5rem;
      font-weight: 700;
      text-align: center;
    }

    .rewards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
    }

    .reward-card {
      background: linear-gradient(135deg, #fff5f0, #ffe8e0);
      border-radius: 16px;
      padding: 1.5rem;
      text-align: center;
      border: 2px solid rgba(255, 150, 130, 0.3);
      transition: all 0.3s ease;
    }

    .reward-card:hover {
      transform: translateY(-5px);
      border-color: var(--peach-1);
      box-shadow: 0 8px 25px rgba(100, 40, 20, 0.15);
    }

    .reward-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .reward-rank {
      font-size: 1.3rem;
      font-weight: 800;
      color: var(--chef-brown);
      margin-bottom: 0.5rem;
    }

    .reward-prize {
      color: var(--peach-1);
      font-weight: 700;
      font-size: 1.1rem;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .page-header h1 {
        font-size: 2.5rem;
      }

      .podium {
        flex-direction: column;
        align-items: center;
      }

      .podium-place {
        width: 100%;
        max-width: 300px;
      }

      .podium-place.first,
      .podium-place.second,
      .podium-place.third {
        order: initial;
      }

      .table-row {
        grid-template-columns: 60px 60px 1fr 100px;
        gap: 0.5rem;
        font-size: 0.9rem;
      }

      .level-cell,
      .badges-cell {
        display: none;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
      }

      .your-position-card {
        flex-direction: column;
        text-align: center;
      }

      .your-motivation {
        text-align: center;
      }
    }

    @media (max-width: 600px) {
      .page-header h1 {
        font-size: 2rem;
      }

      .podium-section,
      .leaderboard-table-section,
      .rewards-section {
        padding: 1.5rem;
      }

      .table-row {
        grid-template-columns: 50px 50px 1fr 80px;
        padding: 1rem 0.5rem;
      }

      .tabs-container {
        gap: 0.3rem;
      }

      .tab-btn {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
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

  <!-- LEADERBOARD CONTAINER -->
  <div class="leaderboard-container">
    
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
        const pointsToTop10 = leaderboardData[9