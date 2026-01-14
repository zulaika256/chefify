<?php
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: logout.php");
  exit();
}

$userId = $_SESSION['user_id'];

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :uid");
$stmt->execute([':uid' => $userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "User data not found. Please log in.";
    exit();
}

// Fetch points
$stmt = $pdo->prepare("SELECT points FROM reward_points WHERE user_id = :uid");
$stmt->execute([':uid' => $userId]);
$pts = $stmt->fetch();
$points = $pts ? $pts['points'] : 0;

// Avatar paths
$avatars = [
    'img/avatar1.jpg',
    'img/avatar2.jpg',
    'img/avatar3.jpg',
    'img/avatar4.jpg',
    'img/avatar5.jpg',
    'img/avatar6.jpg'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profile - Chefify</title>
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
  background:url('img/wallpaper1.jpg') no-repeat center/cover fixed;
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
/* ================= NAV ================= */
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
  z-index:2;
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

.nav-links a.active{
  background: linear-gradient(45deg,var(--peach-1),var(--peach-2));
  color:white;
}

/* PROFILE CONTAINER */
.profile-container{
  max-width:1200px;
  margin:3rem auto;
  padding:0 1rem;
}

.profile-header{
  text-align:center;
  margin-bottom:3rem;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:1.5rem;
}

.profile-header-avatar{
  width:80px;
  height:80px;
  border-radius:50%;
  border:4px solid var(--peach-2);
  object-fit:cover;
  box-shadow:0 6px 16px rgba(100,40,20,.2);
}

.profile-header-text{
  text-align:left;
}

.profile-header h1{
  font-size:2.5rem;
  color:var(--chef-brown);
  margin-bottom:0.3rem;
}

.profile-header p{
  color:#666;
  font-size:1rem;
}

/* LANDSCAPE LAYOUT */
.profile-wrapper{
  display:grid;
  grid-template-columns:350px 1fr;
  gap:2rem;
  align-items:start;
}

/* LEFT SIDEBAR - Avatar & Info */
.profile-sidebar{
  background:white;
  border-radius:20px;
  padding:2rem;
  box-shadow:0 10px 30px rgba(100,40,20,.15);
  position:sticky;
  top:100px;
}

/* AVATAR SECTION */
.avatar-section{
  text-align:center;
  margin-bottom:2rem;
  padding-bottom:2rem;
  border-bottom:2px solid #f5f5f5;
}

.current-avatar-container{
  position:relative;
  width:150px;
  height:150px;
  margin:0 auto 1.5rem;
}

.current-avatar{
  width:100%;
  height:100%;
  border-radius:50%;
  border:5px solid var(--peach-2);
  object-fit:cover;
  box-shadow:0 8px 20px rgba(100,40,20,.2);
}

.avatar-section h3{
  font-size:1.3rem;
  margin-bottom:1.2rem;
  color:var(--chef-brown);
}

.avatar-grid{
  display:grid;
  grid-template-columns:repeat(3, 1fr);
  gap:0.8rem;
}

.avatar-option{
  position:relative;
  cursor:pointer;
  border-radius:12px;
  overflow:hidden;
  transition:all .3s ease;
  border:3px solid transparent;
}

.avatar-option:hover{
  transform:scale(1.05);
  border-color:var(--peach-1);
}

.avatar-option.selected{
  border-color:var(--btn-peach);
  box-shadow:0 4px 15px rgba(255,158,133,.4);
}

.avatar-option img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
  aspect-ratio:1;
}

.avatar-checkmark{
  position:absolute;
  top:3px;
  right:3px;
  background:var(--btn-peach);
  color:white;
  width:24px;
  height:24px;
  border-radius:50%;
  display:none;
  align-items:center;
  justify-content:center;
  font-weight:bold;
  font-size:1rem;
}

.avatar-option.selected .avatar-checkmark{
  display:flex;
}

/* USER INFO COMPACT */
.user-info-compact{
  text-align:center;
}

.user-info-compact .info-item{
  margin-bottom:1rem;
}

.user-info-compact .info-label{
  font-size:0.85rem;
  color:#999;
  margin-bottom:0.3rem;
  display:block;
}

.user-info-compact .info-value{
  font-size:1rem;
  font-weight:600;
  color:var(--chef-brown);
}

/* RIGHT CONTENT - Main Content */
.profile-content{
  display:flex;
  flex-direction:column;
  gap:2rem;
}

.profile-card{
  background:white;
  border-radius:20px;
  padding:2rem;
  box-shadow:0 10px 30px rgba(100,40,20,.15);
}

/* USER INFO SECTION */
.user-info-section{
  margin-bottom:0;
}

.user-info-section h3{
  font-size:1.5rem;
  margin-bottom:1.5rem;
  color:var(--chef-brown);
}

.info-grid{
  display:grid;
  grid-template-columns:repeat(2, 1fr);
  gap:1.2rem;
}

.info-item{
  display:flex;
  flex-direction:column;
}

.info-label{
  font-weight:600;
  color:#666;
  margin-bottom:0.5rem;
  font-size:0.9rem;
}

.info-value{
  padding:0.8rem 1rem;
  background:#f8f8f8;
  border-radius:10px;
  color:var(--chef-brown);
  font-size:1rem;
  font-weight:500;
}

/* EDIT SECTION */
.edit-section{
  margin-bottom:2rem;
}

.edit-section h3{
  font-size:1.5rem;
  margin-bottom:1.5rem;
  color:var(--chef-brown);
}

.form-group{
  margin-bottom:1.5rem;
}

.form-group label{
  display:block;
  font-weight:600;
  margin-bottom:0.5rem;
  color:#666;
}

.form-group input{
  width:100%;
  padding:0.9rem 1rem;
  border:2px solid #E8E8E8;
  border-radius:12px;
  font-size:1rem;
  transition:all .3s ease;
  background:#FAFAFA;
}

.form-group input:focus{
  outline:none;
  border-color:var(--btn-peach);
  background:white;
  box-shadow:0 4px 12px rgba(255,158,133,.15);
}

.password-toggle{
  position:relative;
}

.password-toggle input{
  padding-right:45px;
}

.toggle-password-btn{
  position:absolute;
  right:12px;
  top:50%;
  transform:translateY(-50%);
  background:none;
  border:none;
  cursor:pointer;
  font-size:1.3rem;
  color:#999;
  transition:color .3s;
}

.toggle-password-btn:hover{
  color:var(--btn-peach);
}

/* BUTTONS */
.button-group{
  display:flex;
  gap:1rem;
  margin-top:2rem;
  flex-wrap:wrap;
}

.btn{
  padding:0.9rem 2rem;
  border:none;
  border-radius:12px;
  font-size:1rem;
  font-weight:600;
  cursor:pointer;
  transition:all .3s ease;
}

.btn-primary{
  background:linear-gradient(45deg, var(--btn-peach), var(--btn-peach-hover));
  color:white;
  flex:1;
  min-width:150px;
}

.btn-primary:hover{
  transform:translateY(-3px);
  box-shadow:0 6px 20px rgba(255,158,133,.4);
}

.btn-secondary{
  background:#f5f5f5;
  color:var(--chef-brown);
  flex:1;
  min-width:150px;
}

.btn-secondary:hover{
  background:#e8e8e8;
}

/* MESSAGE */
.message{
  padding:1rem 1.2rem;
  border-radius:10px;
  margin-bottom:1.5rem;
  display:none;
  animation:slideDown .3s ease;
}

@keyframes slideDown{
  from{opacity:0; transform:translateY(-10px)}
  to{opacity:1; transform:translateY(0)}
}

.message.show{
  display:block;
}

.message.success{
  background:#d4edda;
  color:#155724;
  border-left:4px solid #28a745;
}

.message.error{
  background:#f8d7da;
  color:#721c24;
  border-left:4px solid #dc3545;
}

/* ============== FOOTER ============== */
footer{
  background:linear-gradient(135deg, var(--chef-brown) 0%, #5d3a23 100%);
  color:#ffdccf;
  padding:3rem 0 0;
  position:relative;
  overflow:hidden;
  margin-top:4rem;
}

footer::before{
  content:'';
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:80px;
  background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 80'%3E%3Cpath fill='%23f5f5f5' d='M0,40 C360,80 720,0 1440,40 L1440,0 L0,0 Z'%3E%3C/path%3E%3C/svg%3E") no-repeat;
  background-size:cover;
}

.footer-container{
  max-width:1200px;
  margin:0 auto;
  padding:0 1.5rem;
  position:relative;
  z-index:1;
}

.footer-top{
  display:grid;
  grid-template-columns:1.5fr 1fr;
  gap:3rem;
  padding:2rem 0 3rem;
  border-bottom:1px solid rgba(255,220,207,0.2);
}

.footer-logo-section{
  display:flex;
  flex-direction:column;
  gap:1.2rem;
}

.footer-logo{
  display:flex;
  align-items:center;
  gap:1rem;
}

.footer-logo img{
  width:70px;
  height:70px;
  border-radius:50%;
  border:3px solid rgba(255,220,207,0.3);
  box-shadow:0 4px 12px rgba(0,0,0,0.3);
}

.footer-logo-text{
  font-size:2rem;
  font-weight:800;
  color:#ffdccf;
  letter-spacing:0.5px;
}

.footer-tagline{
  font-size:1rem;
  line-height:1.6;
  color:rgba(255,220,207,0.8);
  max-width:350px;
}

.footer-social{
  display:flex;
  gap:1rem;
  margin-top:0.5rem;
}

.social-icon{
  width:45px;
  height:45px;
  background:rgba(255,220,207,0.1);
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  transition:all .3s ease;
  border:2px solid transparent;
}

.social-icon:hover{
  background:var(--peach-2);
  border-color:#fff;
  transform:translateY(-5px);
  box-shadow:0 8px 20px rgba(255,183,161,0.4);
}

.social-icon img{
  width:28px;
  height:28px;
  object-fit:contain;
}

.social-icon:hover img{
  transform:scale(1.1);
}

.footer-section h3{
  font-size:1.3rem;
  margin-bottom:1.2rem;
  color:#fff;
  font-weight:700;
}

.footer-links{
  list-style:none;
  display:flex;
  flex-direction:column;
  gap:0.7rem;
}

.footer-links a{
  color:rgba(255,220,207,0.8);
  text-decoration:none;
  transition:all .3s ease;
  display:inline-block;
}

.footer-links a:hover{
  color:#fff;
  transform:translateX(5px);
}

.contact-item{
  display:flex;
  align-items:start;
  gap:0.8rem;
  margin-bottom:1rem;
  color:rgba(255,220,207,0.8);
}

.contact-icon{
  font-size:1.3rem;
  margin-top:0.2rem;
}

.contact-text{
  flex:1;
  line-height:1.5;
}

.contact-text a{
  color:rgba(255,220,207,0.8);
  text-decoration:none;
  transition:color .3s ease;
}

.contact-text a:hover{
  color:#fff;
}

.footer-bottom{
  padding:1.5rem 0;
  display:flex;
  justify-content:space-between;
  align-items:center;
  color:rgba(255,220,207,0.6);
  font-size:0.9rem;
}

.footer-links-inline{
  display:flex;
  gap:1.5rem;
  list-style:none;
}

.footer-links-inline a{
  color:rgba(255,220,207,0.6);
  text-decoration:none;
  transition:color .3s ease;
}

.footer-links-inline a:hover{
  color:#fff;
}

/* ================= RESPONSIVE ================= */
@media(max-width:968px){
  .hero{
    height:70vh;
  }

  .hero-content{
    margin:0 auto;
    padding:0 1.5rem;
    text-align:center;
  }
  
  .nav-links{
    display:none;
  }
  
  .footer-top{
    grid-template-columns:1fr;
    gap:2.5rem;
  }
}

@media(max-width:900px){
  .signature-grid{
    grid-template-columns:1fr;
  }
  
  .teasers-grid{
    grid-template-columns:1fr;
  }
}

@media(max-width:640px){
  .footer-bottom{
    flex-direction:column;
    gap:1rem;
    text-align:center;
  }
  
  .footer-links-inline{
    flex-wrap:wrap;
    justify-content:center;
  }
}
  </style>
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
      <a href="profile.php" class="active">Profile</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

<main class="profile-container">
  
  <div class="profile-header">
    <img src="<?php echo htmlspecialchars($user['avatar'] ?: $avatars[0]); ?>" alt="Profile Avatar" class="profile-header-avatar" id="headerAvatar" onerror="this.src='https://via.placeholder.com/80/FF9E85/FFFFFF?text=Avatar'">
    <div class="profile-header-text">
      <h1 id="headerUsername"><?php echo htmlspecialchars($user['username']); ?></h1>
      <p>Manage your account settings</p>
    </div>
  </div>

  <!-- LANDSCAPE LAYOUT -->
  <div class="profile-wrapper">
    
    <!-- LEFT SIDEBAR -->
    <div class="profile-sidebar">
      
      <!-- AVATAR SELECTION -->
      <div class="avatar-section">
        <div class="current-avatar-container">
          <img src="<?php echo htmlspecialchars($user['avatar'] ?: $avatars[0]); ?>" alt="Current Avatar" class="current-avatar" id="currentAvatar" onerror="this.src='https://via.placeholder.com/150/FF9E85/FFFFFF?text=Avatar'">
        </div>
        
        <h3>Choose Avatar</h3>
        <div class="avatar-grid" id="avatarGrid">
          <!-- Avatars will be generated by JavaScript -->
        </div>
      </div>

      <!-- USER INFO COMPACT -->
      <div class="user-info-compact">
        <div class="info-item">
          <span class="info-label">Username</span>
          <div class="info-value" id="sidebarUsername"><?php echo htmlspecialchars($user['username']); ?></div>
        </div>
        <div class="info-item">
          <span class="info-label">Email</span>
          <div class="info-value" id="sidebarEmail"><?php echo htmlspecialchars($user['email']); ?></div>
        </div>
        <div class="info-item">
          <span class="info-label">Total Points</span>
          <div class="info-value" id="sidebarPoints"><?php echo intval($points); ?> pts</div>
        </div>
      </div>

    </div>

    <!-- RIGHT CONTENT -->
    <div class="profile-content">
      
      <!-- MESSAGE -->
      <div class="message" id="message"></div>

      <!-- ACCOUNT INFORMATION -->
      <div class="profile-card">
        <div class="user-info-section">
          <h3>📋 Account Information</h3>
          <div class="info-grid">
            <div class="info-item">
              <span class="info-label">Full Name</span>
              <div class="info-value" id="displayFullname"><?php echo htmlspecialchars($user['fullname']); ?></div>
            </div>
            <div class="info-item">
              <span class="info-label">Username</span>
              <div class="info-value" id="displayUsername"><?php echo htmlspecialchars($user['username']); ?></div>
            </div>
            <div class="info-item">
              <span class="info-label">Email</span>
              <div class="info-value" id="displayEmail"><?php echo htmlspecialchars($user['email']); ?></div>
            </div>
            <div class="info-item">
              <span class="info-label">Phone</span>
              <div class="info-value" id="displayPhone"><?php echo htmlspecialchars($user['phone']); ?></div>
            </div>
            <div class="info-item">
              <span class="info-label">Member Since</span>
              <div class="info-value" id="displayJoinDate"><?php echo htmlspecialchars(date('M j, Y', strtotime($user['created_at']))); ?></div>
            </div>
            <div class="info-item">
              <span class="info-label">Total Points</span>
              <div class="info-value" id="displayPoints"><?php echo intval($points); ?> pts</div>
            </div>
          </div>
        </div>
      </div>

      <!-- EDIT USERNAME -->
      <div class="profile-card">
        <div class="edit-section">
          <h3>✏️ Edit Username</h3>
          <form id="usernameForm">
            <div class="form-group">
              <label for="newUsername">New Username</label>
              <input type="text" id="newUsername" placeholder="Enter new username" required>
            </div>
            <div class="button-group">
              <button type="submit" class="btn btn-primary">Update Username</button>
            </div>
          </form>
        </div>
      </div>

      <!-- CHANGE PASSWORD -->
      <div class="profile-card">
        <div class="edit-section">
          <h3>🔒 Change Password</h3>
          <form id="passwordForm">
            <div class="form-group">
              <label for="currentPassword">Current Password</label>
              <div class="password-toggle">
                <input type="password" id="currentPassword" placeholder="Enter current password" required>
                <button type="button" class="toggle-password-btn" onclick="togglePassword('currentPassword')">👁️</button>
              </div>
            </div>
            
            <div class="form-group">
              <label for="newPassword">New Password</label>
              <div class="password-toggle">
                <input type="password" id="newPassword" placeholder="Enter new password (min. 6 characters)" required>
                <button type="button" class="toggle-password-btn" onclick="togglePassword('newPassword')">👁️</button>
              </div>
            </div>
            
            <div class="form-group">
              <label for="confirmPassword">Confirm New Password</label>
              <div class="password-toggle">
                <input type="password" id="confirmPassword" placeholder="Confirm new password" required>
                <button type="button" class="toggle-password-btn" onclick="togglePassword('confirmPassword')">👁️</button>
              </div>
            </div>
            
            <div class="button-group">
              <button type="submit" class="btn btn-primary">Change Password</button>
              <button type="button" class="btn btn-secondary" onclick="resetPasswordForm()">Cancel</button>
            </div>
          </form>
        </div>
      </div>

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
            <a href="tel:+60326888888">+603-2688 8888</a>
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
// Server-provided user data
const currentUser = <?php echo json_encode($user); ?>;
const points = <?php echo json_encode($points); ?>;
const avatars = <?php echo json_encode($avatars); ?>;
let selectedAvatar = currentUser.avatar || avatars[0];

function generateAvatarGrid() {
    const avatarGrid = document.getElementById('avatarGrid');
    avatarGrid.innerHTML = avatars.map((avatar, i) => `
        <div class="avatar-option" data-avatar="${avatar}">
            <img src="${avatar}" alt="Avatar ${i+1}">
            <div class="avatar-checkmark">✓</div>
        </div>
    `).join('');

    // Attach click handlers
    document.querySelectorAll('.avatar-option').forEach(opt => {
        opt.addEventListener('click', () => {
            selectAvatar(opt.dataset.avatar);
        });
    });
}

function selectAvatar(avatar) {
    selectedAvatar = avatar;
    updateCurrentAvatar(avatar);
    updateAvatarSelection();
    saveAvatar();
}

function updateCurrentAvatar(avatar) {
    const cur = document.getElementById('currentAvatar');
    const head = document.getElementById('headerAvatar');
    if (cur) cur.src = avatar;
    if (head) head.src = avatar;
}

function updateAvatarSelection() {
    document.querySelectorAll('.avatar-option').forEach(opt => {
        if (opt.dataset.avatar === selectedAvatar) opt.classList.add('selected');
        else opt.classList.remove('selected');
    });
}

function saveAvatar() {
    fetch('update_profile.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'update_avatar', avatar: selectedAvatar })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
            // ensure other elements update
            updateCurrentAvatar(selectedAvatar);
        } else {
            showMessage(data.message || 'Error saving avatar', 'error');
        }
    })
    .catch(() => showMessage('Network error', 'error'));
}

// Update profile info (fullname, phone)
function updateProfile(e) {
    e.preventDefault();
    const fullname = document.getElementById('fullname').value.trim();
    const phone = document.getElementById('phone').value.trim();

    fetch('update_profile.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'update_info', fullname, phone })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('displayFullname').textContent = fullname;
            showMessage(data.message, 'success');
        } else {
            showMessage(data.message || 'Error updating profile', 'error');
        }
    })
    .catch(() => showMessage('Network error', 'error'));
}

// Username change
document.getElementById('usernameForm').addEventListener('submit', function(e){
    e.preventDefault();
    const newUsername = document.getElementById('newUsername').value.trim();
    if (newUsername.length < 3) { showMessage('Username too short', 'error'); return; }

    fetch('update_profile.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'update_username', newUsername })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById('displayUsername').textContent = newUsername;
            document.getElementById('sidebarUsername').textContent = newUsername;
            document.getElementById('headerUsername').textContent = newUsername;
            document.getElementById('newUsername').value = '';
            showMessage(data.message, 'success');
        } else showMessage(data.message || 'Error', 'error');
    })
    .catch(() => showMessage('Network error', 'error'));
});

// Password change
document.getElementById('passwordForm').addEventListener('submit', function(e){
    e.preventDefault();
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    if (newPassword !== confirmPassword) { showMessage('New passwords do not match.', 'error'); return; }

    fetch('update_profile.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ action: 'change_password', currentPassword, newPassword })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { resetPasswordForm(); showMessage(data.message, 'success'); }
        else showMessage(data.message || 'Error', 'error');
    })
    .catch(() => showMessage('Network error', 'error'));
});

function resetPasswordForm(){ document.getElementById('passwordForm').reset(); }

function showMessage(text, type){
    const message = document.getElementById('message');
    message.textContent = text;
    message.className = `message ${type} show`;
    setTimeout(()=> message.classList.remove('show'), 5000);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// initialize
document.addEventListener('DOMContentLoaded', function(){
  // Use server-rendered values where possible; set selected avatar
  selectedAvatar = currentUser.avatar || avatars[0];
  // ensure avatar images reflect current selection
  if (document.getElementById('headerAvatar')) document.getElementById('headerAvatar').src = selectedAvatar;
  if (document.getElementById('currentAvatar')) document.getElementById('currentAvatar').src = selectedAvatar;
  if (document.getElementById('displayPoints')) document.getElementById('displayPoints').textContent = (points || 0) + ' pts';

  generateAvatarGrid();
  updateAvatarSelection();
});
</script>

</body>
</html>