<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="dashboard.css"> 

</head>

<body>

<nav>
  <div class="nav-container">
    <a href="home.html" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify Logo">
      <span class="logo-text">Chefify</span>
    </a>
    <div class="nav-links">
      <a href="home.html">Home</a>
      <a href="menu.html">Menu</a>
      <a href="cart.html">Cart</a>
      <a href="dashboard.html" class="active">Dashboard</a>
      <a href="locations.html">Locations</a>
      <a href="aboutus.html">About</a>
      <a href="contactus.html">Contact Us</a>
      <a href="login.html">Logout</a>
    </div>
  </div>
</nav>

<main class="dashboard">

  <!-- DASHBOARD BANNER -->
  <div class="dashboard-banner fade-banner">
    <img src="img/bannerdashboard1.jpg" class="banner-slide active" alt="Chefify Promo">
    <img src="img/bannerdashboard2.png" class="banner-slide" alt="New Menu">
    <img src="img/bannerdashboard3.png" class="banner-slide" alt="Earn Points">
    <img src="img/bannerdashboard4.png" class="banner-slide" alt="Play & Win">
  </div>

  <!-- OVERVIEW -->
  <section class="section">
    <h2>📊 Overview</h2>
    <div class="cards">
      <div class="card overview-card">
        <h3>⭐ Total Points</h3>
        <div class="overview-value" id="totalPoints">0</div> 
        <small>Points earned</small>
      </div>
      <div class="card overview-card">
        <h3>🏅 Badges Earned</h3>
        <div class="overview-value" id="badgeCount">0</div>
        <small>Unlocked achievements</small>
      </div>
      <div class="card overview-card">
        <h3>🛒 Orders Made</h3>
        <div class="overview-value" id="orders">0</div>
        <small>Completed orders</small>
      </div>
    </div>
  </section>

  <!-- POINTS -->
  <section class="section">
    <h2>🎯 Points Progress</h2>
    <div class="card">
      <p>Next Level: <strong>Food Master</strong> (1000 pts)</p>
      <div class="progress-bar">
        <div class="progress" id="progressBar"></div>
      </div>
      <p style="margin-top:0.5rem;font-size:0.9rem;color:#666;">
        <span id="currentPoints">0</span> / 1000 points
      </p>
    </div>
  </section>

  <!-- BADGES -->
  <section class="section">
    <h2>🏆 Badges</h2>
    <div class="badge-grid" id="badgeGrid"></div>
  </section>

  <!-- PROGRESS TRACKER & LEADERBOARD -->
  <section class="section">
    <h2>📈 Track Your Journey</h2>
    <div class="tracker-grid">
      
      <!-- Progress Tracker -->
      <a href="progress_tracker.html" class="tracker-card">
        <div class="tracker-image-container">
          <img src="img/progress_tracker.jpg" alt="Progress Tracker" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="tracker-icon" style="display:none;">📊</div>
        </div>
        <div class="tracker-content">
          <h3 class="tracker-title">Progress Tracker</h3>
          <p class="tracker-description">View your complete journey, milestones, and achievements in detail.</p>
          <span class="tracker-badge">View Progress →</span>
        </div>
      </a>

      <!-- Leaderboard -->
      <a href="leaderboard.html" class="tracker-card">
        <div class="tracker-image-container">
          <img src="img/leaderboard.jpg" alt="Leaderboard" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="tracker-icon" style="display:none;">🏅</div>
        </div>
        <div class="tracker-content">
          <h3 class="tracker-title">Leaderboard</h3>
          <p class="tracker-description">See how you rank against other Chefify members and climb to the top!</p>
          <span class="tracker-badge">View Rankings →</span>
        </div>
      </a>

    </div>
  </section>

  <!-- REWARDS OVERVIEW -->
  <section class="section">
    <h2>🎁 Rewards Overview</h2>
    <p style="margin-bottom:2rem;color:#666;">Click on any reward to explore and claim your benefits!</p>
    
    <div class="rewards-grid">
      
      <!-- Reward 1: Points Per Order -->
      <a href="points.php" class="reward-card">
        <div class="reward-image-container">
          <img src="img/reward_points.jpg" alt="Points Per Order" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="reward-icon" style="display:none;">⭐</div>
        </div>
        <div class="reward-content">
          <h3 class="reward-title">Points Per Order</h3>
          <p class="reward-description">Earn points with every order you make. Accumulate points and unlock exclusive rewards!</p>
          <span class="reward-badge">View Details →</span>
        </div>
      </a>

      <!-- Reward 2: Discount via Mini Game -->
      <a href="reward_mini_game.html" class="reward-card">
        <div class="reward-image-container">
          <img src="img/reward_game.jpg" alt="Mini Game Discount" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="reward-icon" style="display:none;">🎮</div>
        </div>
        <div class="reward-content">
          <h3 class="reward-title">Discount via Mini Game</h3>
          <p class="reward-description">Play fun memory games and win instant discounts on your next order!</p>
          <span class="reward-badge">Play Now →</span>
        </div>
      </a>

      <!-- Reward 3: Random Spin -->
      <a href="reward_random_spin.html" class="reward-card">
        <div class="reward-image-container">
          <img src="img/reward_spin.jpg" alt="Random Spin" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="reward-icon" style="display:none;">🎡</div>
        </div>
        <div class="reward-content">
          <h3 class="reward-title">Lucky Spin Wheel</h3>
          <p class="reward-description">Spin the wheel daily for a chance to win amazing prizes and discounts!</p>
          <span class="reward-badge">Spin Now →</span>
        </div>
      </a>

    </div>
  </section>

</main>

<footer>
  <div class="footer-container">
    <div class="copyright">© 2025 Chefify. All rights reserved.</div>
    <div class="social-links" aria-label="Social links">
      <a href="https://www.tiktok.com/@chefifyapp?_r=1&_t=ZS-92RNDS9aRWs" target="_blank" rel="noopener">
        <img src="img/tiktoklogo.png" alt="TikTok">
      </a>
      <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" rel="noopener">
        <img src="img/iglogo.png" alt="Instagram">
      </a>
    </div>
  </div>
</footer>

<script>
/* ===== DASHBOARD BANNER FADE ===== */
const slides = document.querySelectorAll(".banner-slide");
let currentSlide = 0;

setInterval(() => {
  slides[currentSlide].classList.remove("active");
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].classList.add("active");
}, 3500);

/* ================= GAMIFICATION DATA ================= */
// Get user data from sessionStorage
const username = sessionStorage.getItem('username') || 'Guest';
const userId = sessionStorage.getItem('userId');

// Get or initialize user points and orders
let points = 0;
let orders = 0;

if (userId) {
  const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
  const currentUser = users.find(u => u.id === userId);
  
  if (currentUser) {
    points = currentUser.points || 0;
    orders = currentUser.orders ? currentUser.orders.length : 0;
  }
}

const badges = [
  { name:"First Order", icon:"🍽️", req:1 },
  { name:"Food Lover", icon:"❤️", req:200 },
  { name:"Chef Explorer", icon:"👨‍🍳", req:400 },
  { name:"Master Taster", icon:"🏆", req:800 }
];

/* ================= RENDER ================= */
document.getElementById("totalPoints").innerText = points;
document.getElementById("currentPoints").innerText = points;
document.getElementById("orders").innerText = orders;

const unlocked = badges.filter(b => points >= b.req);
document.getElementById("badgeCount").innerText = unlocked.length;

/* Progress */
const progressPercent = Math.min((points/1000)*100, 100);
document.getElementById("progressBar").style.width = progressPercent + "%";

/* Badges */
const badgeGrid = document.getElementById("badgeGrid");
badgeGrid.innerHTML = badges.map(b => `
  <div class="badge ${points >= b.req ? "unlocked" : ""}"
       title="${points >= b.req ? "Unlocked!" : `Earn ${b.req} points to unlock`}">
    <div class="badge-icon">${b.icon}</div>
    <strong>${b.name}</strong>
    <p>${b.req} pts</p>
  </div>
`).join("");
</script>

</body>
</html>