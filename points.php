<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Points & Rewards - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />

  <style>
:root{
  --chef-brown:#4b2e19;
  --peach-1:#ffd6c8;
  --peach-2:#ffb7a1;
  --btn-peach:#ff9e85;
  --btn-peach-hover:#ff6f8a;
  --card-cream:rgba(255,230,225,0.9);
}

*{box-sizing:border-box;margin:0;padding:0}

body{
  font-family:Arial, Helvetica, sans-serif;
  background:url('img/wallpaper4.jpg') no-repeat center/cover fixed;
  min-height:100vh;
  color:var(--chef-brown);
}

body::before{
  content:"";
  position:fixed;
  inset:0;
  background:rgba(255,170,150,.45);
  z-index:-1;
}

/* ===== NAV ===== */
nav{
  position:sticky;
  top:0;
  z-index:999;
  background: transparent;
  padding: 1.25rem 0;
  backdrop-filter: blur(4px);
}

.nav-container{
  max-width:1200px;
  margin:0 auto;
  padding: 0 1rem;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:1rem;
}

.logo{
  display:flex;
  align-items:center;
  gap:18px;
  text-decoration:none;
}

.logo-img{
  height:60px;
  width:auto;
  border-radius:50%;
  border:2px solid #ffdde0;
  box-shadow:0 4px 12px rgba(100,40,20,0.35);
}

.logo-text{
  font-size:1.6rem;
  font-weight:800;
  color:var(--chef-brown);
  letter-spacing:0.5px;
}

.nav-links{
  display:flex;
  gap:0.35rem;
  align-items:center;
}

.nav-links a{
  color:var(--chef-brown);
  text-decoration:none;
  padding:0.45rem 0.9rem;
  border-radius:20px;
  font-weight:600;
  transition:all .22s ease;
}

.nav-links a:hover{
  color:white;
  background: linear-gradient(45deg,var(--peach-1),var(--peach-2));
  box-shadow: 0 6px 18px rgba(255,150,130,0.18);
  transform:translateY(-3px);
}

/* MAIN CONTAINER */
.points-container{
  max-width:1200px;
  margin:3rem auto;
  padding:0 1rem;
}

/* BACK BUTTON */
.back-btn{
  display:inline-flex;
  align-items:center;
  gap:0.5rem;
  padding:0.7rem 1.5rem;
  background:white;
  color:var(--chef-brown);
  text-decoration:none;
  border-radius:25px;
  font-weight:600;
  margin-bottom:2rem;
  box-shadow:0 4px 12px rgba(100,40,20,.15);
  transition:all .3s ease;
}

.back-btn:hover{
  transform:translateX(-5px);
  box-shadow:0 6px 16px rgba(100,40,20,.25);
}

/* HEADER */
.page-header{
  text-align:center;
  margin-bottom:3rem;
}

.page-header h1{
  font-size:2.8rem;
  color:var(--chef-brown);
  margin-bottom:0.8rem;
}

.page-header p{
  font-size:1.1rem;
  color:#666;
}

/* POINTS BALANCE CARD */
.points-balance{
  background:linear-gradient(135deg, #FF6B9D 0%, #FE88B1 100%);
  color:white;
  border-radius:25px;
  padding:2.5rem;
  margin-bottom:3rem;
  box-shadow:0 12px 32px rgba(255,107,157,.3);
  text-align:center;
}

.balance-label{
  font-size:1.1rem;
  opacity:0.9;
  margin-bottom:0.5rem;
}

.balance-value{
  font-size:4rem;
  font-weight:800;
  margin-bottom:1rem;
  text-shadow:0 4px 12px rgba(0,0,0,0.2);
}

.balance-subtitle{
  font-size:1rem;
  opacity:0.8;
}

/* HOW TO EARN SECTION */
.earn-section{
  background:white;
  border-radius:20px;
  padding:2.5rem;
  margin-bottom:3rem;
  box-shadow:0 8px 24px rgba(100,40,20,.15);
}

.earn-section h2{
  font-size:2rem;
  margin-bottom:2rem;
  color:var(--chef-brown);
  text-align:center;
}

.earn-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
  gap:1.5rem;
}

.earn-item{
  text-align:center;
  padding:1.5rem;
  background:#FFF5F7;
  border-radius:15px;
  transition:all .3s ease;
}

.earn-item:hover{
  transform:translateY(-5px);
  box-shadow:0 8px 20px rgba(100,40,20,.15);
}

.earn-icon{
  font-size:3rem;
  margin-bottom:1rem;
}

.earn-title{
  font-weight:700;
  color:var(--chef-brown);
  margin-bottom:0.5rem;
}

.earn-points{
  font-size:1.3rem;
  font-weight:700;
  color:#ff6f8a;
}

/* REWARDS SECTION */
.rewards-section{
  margin-bottom:3rem;
}

.rewards-section h2{
  font-size:2rem;
  margin-bottom:1rem;
  color:var(--chef-brown);
  text-align:center;
}

.rewards-section > p{
  text-align:center;
  color:#666;
  margin-bottom:2.5rem;
}

.rewards-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));
  gap:2rem;
}

.reward-card{
  background:white;
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 8px 24px rgba(100,40,20,.15);
  transition:all .3s ease;
  position:relative;
}

.reward-card:hover{
  transform:translateY(-8px);
  box-shadow:0 12px 32px rgba(100,40,20,.25);
}

.reward-card.locked{
  opacity:0.7;
}

.reward-card.locked::after{
  content:"🔒";
  position:absolute;
  top:15px;
  right:15px;
  font-size:2rem;
  background:rgba(255,255,255,0.9);
  width:50px;
  height:50px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.reward-card.unlocked::after{
  content:"✓";
  position:absolute;
  top:15px;
  right:15px;
  font-size:1.8rem;
  background:#28A745;
  color:white;
  width:50px;
  height:50px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:700;
  box-shadow:0 4px 12px rgba(40,167,69,0.3);
}

.reward-image{
  width:100%;
  height:180px;
  background:linear-gradient(135deg, var(--peach-1), var(--peach-2));
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:4rem;
}

.reward-image img{
  width:100%;
  height:100%;
  object-fit:cover;
}

.reward-body{
  padding:1.8rem;
}

.reward-header{
  display:flex;
  justify-content:space-between;
  align-items:start;
  margin-bottom:1rem;
}

.reward-title{
  font-size:1.4rem;
  font-weight:700;
  color:var(--chef-brown);
  flex:1;
}

.reward-cost{
  background:linear-gradient(45deg, #FF6B9D, #FE88B1);
  color:white;
  padding:0.4rem 1rem;
  border-radius:20px;
  font-weight:700;
  font-size:1rem;
  white-space:nowrap;
}

.reward-description{
  color:#666;
  line-height:1.6;
  margin-bottom:1.5rem;
}

.reward-progress{
  margin-bottom:1.5rem;
}

.progress-label{
  font-size:0.9rem;
  color:#666;
  margin-bottom:0.5rem;
}

.progress-bar-container{
  background:#f0f0f0;
  height:8px;
  border-radius:10px;
  overflow:hidden;
}

.progress-bar-fill{
  height:100%;
  background:linear-gradient(45deg, var(--btn-peach), var(--btn-peach-hover));
  transition:width .5s ease;
  border-radius:10px;
}

.reward-btn{
  width:100%;
  padding:0.9rem;
  border:none;
  border-radius:12px;
  font-weight:700;
  font-size:1rem;
  cursor:pointer;
  transition:all .3s ease;
}

.reward-btn.claim{
  background:linear-gradient(45deg, #28A745, #20C997);
  color:white;
}

.reward-btn.claim:hover{
  transform:translateY(-2px);
  box-shadow:0 6px 20px rgba(40,167,69,0.3);
}

.reward-btn.locked{
  background:#E0E0E0;
  color:#999;
  cursor:not-allowed;
}

.reward-btn.claimed{
  background:#6C757D;
  color:white;
  cursor:default;
}

/* SUCCESS MESSAGE */
.success-message{
  position:fixed;
  top:100px;
  left:50%;
  transform:translateX(-50%) translateY(-20px);
  background:#28A745;
  color:white;
  padding:1.2rem 2rem;
  border-radius:12px;
  box-shadow:0 8px 24px rgba(40,167,69,0.4);
  z-index:1000;
  opacity:0;
  pointer-events:none;
  transition:all .3s ease;
}

.success-message.show{
  opacity:1;
  transform:translateX(-50%) translateY(0);
}

/* FOOTER */
footer{
  background:var(--chef-brown);
  color:#ffdccf;
  padding:2.5rem 0;
  margin-top:4rem;
}

.footer-container{
  max-width:1200px;
  margin:auto;
  padding:0 1rem;
  display:flex;
  justify-content:space-between;
  flex-wrap:wrap;
  gap:1rem;
}

.social-links{
  display:flex;
  gap:1rem;
}

.social-links img{
  width:32px;
  height:32px;
  transition:transform .3s ease;
}

.social-links img:hover{
  transform:scale(1.1);
}

/* RESPONSIVE */
@media(max-width:768px){
  .nav-links{display:none}
  
  .page-header h1{font-size:2rem}
  
  .balance-value{font-size:3rem}
  
  .earn-grid{grid-template-columns:1fr}
  
  .rewards-grid{grid-template-columns:1fr}
}
  </style>
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
      <a href="dashboard.html">Dashboard</a>
      <a href="locations.html">Locations</a>
      <a href="aboutus.html">About</a>
      <a href="contactus.html">Contact Us</a>
      <a href="login.html">Logout</a>
    </div>
  </div>
</nav>

<!-- SUCCESS MESSAGE -->
<div class="success-message" id="successMessage">
  ✓ Reward claimed successfully!
</div>

<main class="points-container">
  
  <a href="dashboard.html" class="back-btn">← Back to Dashboard</a>

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
// Get user data
const userId = sessionStorage.getItem('userId');
let currentUser = null;
let userPoints = 0;

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
  // Get user
  if (userId) {
    const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
    currentUser = users.find(u => u.id === userId);
  } else {
    const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
    if (users.length > 0) {
      currentUser = users[0];
    }
  }
  
  if (currentUser) {
    userPoints = currentUser.points || 0;
    
    // Initialize claimed rewards if not exists
    if (!currentUser.claimedRewards) {
      currentUser.claimedRewards = [];
    }
  }
  
  // Display points
  document.getElementById('userPoints').textContent = userPoints;
  
  // Render rewards
  renderRewards();
}

// Render rewards grid
function renderRewards() {
  const rewardsGrid = document.getElementById('rewardsGrid');
  
  rewardsGrid.innerHTML = rewards.map(reward => {
    const isClaimed = currentUser && currentUser.claimedRewards && currentUser.claimedRewards.includes(reward.id);
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
function claimReward(rewardId, cost) {
  if (!currentUser) {
    alert('Please login to claim rewards.');
    return;
  }
  
  // Check if already claimed
  if (currentUser.claimedRewards && currentUser.claimedRewards.includes(rewardId)) {
    return;
  }
  
  // Check if enough points
  if (userPoints < cost) {
    alert(`You need ${cost - userPoints} more points to claim this reward.`);
    return;
  }
  
  // Deduct points
  userPoints -= cost;
  currentUser.points = userPoints;
  
  // Add to claimed rewards
  if (!currentUser.claimedRewards) {
    currentUser.claimedRewards = [];
  }
  currentUser.claimedRewards.push(rewardId);
  
  // Save to localStorage
  const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
  const userIndex = users.findIndex(u => u.id === currentUser.id);
  if (userIndex !== -1) {
    users[userIndex] = currentUser;
    localStorage.setItem('chefifyUsers', JSON.stringify(users));
  }
  
  // Update display
  document.getElementById('userPoints').textContent = userPoints;
  
  // Show success message
  showSuccessMessage();
  
  // Re-render rewards
  renderRewards();
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