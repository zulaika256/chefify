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
@media(max-width:968px){
  .profile-wrapper{
    grid-template-columns:1fr;
  }
  
  .profile-sidebar{
    position:relative;
    top:0;
  }
  
  .avatar-grid{
    grid-template-columns:repeat(6, 1fr);
  }
  
  .profile-header{
    flex-direction:column;
    text-align:center;
  }
  
  .profile-header-text{
    text-align:center;
  }
}

@media(max-width:768px){
  .nav-links{display:none}
  
  .profile-header h1{
    font-size:2rem;
  }
  
  .profile-card{
    padding:1.5rem;
  }
  
  .avatar-grid{
    grid-template-columns:repeat(3, 1fr);
  }
  
  .info-grid{
    grid-template-columns:1fr;
  }
  
  .button-group{
    flex-direction:column;
  }
  
  .btn{
    width:100%;
  }
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

<main class="profile-container">
  
  <div class="profile-header">
    <img src="img/avatar1.png" alt="Profile Avatar" class="profile-header-avatar" id="headerAvatar" onerror="this.src='https://via.placeholder.com/80/FF9E85/FFFFFF?text=Avatar'">
    <div class="profile-header-text">
      <h1 id="headerUsername">Loading...</h1>
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
          <img src="img/avatar1.png" alt="Current Avatar" class="current-avatar" id="currentAvatar" onerror="this.src='https://via.placeholder.com/150/FF9E85/FFFFFF?text=Avatar'">
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
          <div class="info-value" id="sidebarUsername">Loading...</div>
        </div>
        <div class="info-item">
          <span class="info-label">Email</span>
          <div class="info-value" id="sidebarEmail">Loading...</div>
        </div>
        <div class="info-item">
          <span class="info-label">Total Points</span>
          <div class="info-value" id="sidebarPoints">0 pts</div>
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
              <div class="info-value" id="displayFullname">Loading...</div>
            </div>
            <div class="info-item">
              <span class="info-label">Username</span>
              <div class="info-value" id="displayUsername">Loading...</div>
            </div>
            <div class="info-item">
              <span class="info-label">Email</span>
              <div class="info-value" id="displayEmail">Loading...</div>
            </div>
            <div class="info-item">
              <span class="info-label">Phone</span>
              <div class="info-value" id="displayPhone">Loading...</div>
            </div>
            <div class="info-item">
              <span class="info-label">Member Since</span>
              <div class="info-value" id="displayJoinDate">Loading...</div>
            </div>
            <div class="info-item">
              <span class="info-label">Total Points</span>
              <div class="info-value" id="displayPoints">0 pts</div>
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
// Get current user data
const userId = sessionStorage.getItem('userId');
const username = sessionStorage.getItem('username');

let currentUser = null;
let selectedAvatar = null;

// Avatar paths (6 avatars)
const avatars = [
  'img/avatar1.png',
  'img/avatar2.png',
  'img/avatar3.png',
  'img/avatar4.png',
  'img/avatar5.png',
  'img/avatar6.png'
];

// Initialize profile page
function initProfile() {
  // Get user data from localStorage
  const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
  
  // Try to get logged in user, otherwise use first user
  if (userId && username) {
    currentUser = users.find(u => u.id === userId);
  } else if (users.length > 0) {
    currentUser = users[0];
  }

  if (!currentUser) {
    document.querySelector('.profile-wrapper').innerHTML = `
      <div style="grid-column:1/-1; text-align:center; padding:3rem; background:white; border-radius:20px;">
        <h2 style="color:var(--chef-brown); margin-bottom:1rem;">No User Found</h2>
        <p style="color:#666; margin-bottom:2rem;">Please register an account first.</p>
        <a href="register.html" class="btn btn-primary" style="display:inline-block; text-decoration:none;">Go to Register</a>
      </div>
    `;
    return;
  }

  // Load user info
  loadUserInfo();
  
  // Generate avatar grid
  generateAvatarGrid();
  
  // Set selected avatar
  selectedAvatar = currentUser.avatar || avatars[0];
  updateCurrentAvatar(selectedAvatar);
  updateAvatarSelection();
}

// Load user information
function loadUserInfo() {
  // Header info
  document.getElementById('headerUsername').textContent = currentUser.username;
  document.getElementById('headerAvatar').src = currentUser.avatar || avatars[0];
  
  // Main info grid
  document.getElementById('displayFullname').textContent = currentUser.fullname || 'N/A';
  document.getElementById('displayUsername').textContent = currentUser.username;
  document.getElementById('displayEmail').textContent = currentUser.email;
  document.getElementById('displayPhone').textContent = currentUser.phone || 'N/A';
  document.getElementById('displayPoints').textContent = (currentUser.points || 0) + ' pts';
  
  // Sidebar info
  document.getElementById('sidebarUsername').textContent = currentUser.username;
  document.getElementById('sidebarEmail').textContent = currentUser.email;
  document.getElementById('sidebarPoints').textContent = (currentUser.points || 0) + ' pts';
  
  // Format join date
  const joinDate = new Date(currentUser.createdAt);
  document.getElementById('displayJoinDate').textContent = joinDate.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
}

// Generate avatar grid
function generateAvatarGrid() {
  const avatarGrid = document.getElementById('avatarGrid');
  avatarGrid.innerHTML = avatars.map((avatar, index) => `
    <div class="avatar-option" data-avatar="${avatar}" onclick="selectAvatar('${avatar}')">
      <img src="${avatar}" alt="Avatar ${index + 1}" onerror="this.src='https://via.placeholder.com/100/FF9E85/FFFFFF?text=${index + 1}'">
      <div class="avatar-checkmark">✓</div>
    </div>
  `).join('');
}

// Select avatar
function selectAvatar(avatar) {
  selectedAvatar = avatar;
  updateCurrentAvatar(avatar);
  updateAvatarSelection();
  saveAvatar(avatar);
}

// Update current avatar display
function updateCurrentAvatar(avatar) {
  document.getElementById('currentAvatar').src = avatar;
  document.getElementById('headerAvatar').src = avatar;
}

// Update avatar selection UI
function updateAvatarSelection() {
  document.querySelectorAll('.avatar-option').forEach(option => {
    if (option.dataset.avatar === selectedAvatar) {
      option.classList.add('selected');
    } else {
      option.classList.remove('selected');
    }
  });
}

// Save avatar to database
function saveAvatar(avatar) {
  if (!currentUser) return;
  
  const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
  const userIndex = users.findIndex(u => u.id === currentUser.id);
  
  if (userIndex !== -1) {
    users[userIndex].avatar = avatar;
    localStorage.setItem('chefifyUsers', JSON.stringify(users));
    currentUser = users[userIndex];
    showMessage('Avatar updated successfully!', 'success');
  }
}

// Update username
document.getElementById('usernameForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (!currentUser) {
    showMessage('No user loaded.', 'error');
    return;
  }
  
  const newUsername = document.getElementById('newUsername').value.trim();
  
  // Validate username
  if (newUsername.length < 3) {
    showMessage('Username must be at least 3 characters long.', 'error');
    return;
  }
  
  const usernameRegex = /^[a-zA-Z0-9_]+$/;
  if (!usernameRegex.test(newUsername)) {
    showMessage('Username can only contain letters, numbers, and underscores.', 'error');
    return;
  }
  
  // Check if username exists
  const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
  const usernameExists = users.some(u => u.username.toLowerCase() === newUsername.toLowerCase() && u.id !== currentUser.id);
  
  if (usernameExists) {
    showMessage('Username already taken. Please choose another one.', 'error');
    return;
  }
  
  // Update username
  const userIndex = users.findIndex(u => u.id === currentUser.id);
  if (userIndex !== -1) {
    users[userIndex].username = newUsername;
    localStorage.setItem('chefifyUsers', JSON.stringify(users));
    
    // Update session if logged in
    if (userId) {
      sessionStorage.setItem('username', newUsername);
    }
    
    currentUser = users[userIndex];
    
    // Update display
    document.getElementById('displayUsername').textContent = newUsername;
    document.getElementById('sidebarUsername').textContent = newUsername;
    document.getElementById('headerUsername').textContent = newUsername;
    document.getElementById('newUsername').value = '';
    
    showMessage('Username updated successfully!', 'success');
  }
});

// Change password
document.getElementById('passwordForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (!currentUser) {
    showMessage('No user loaded.', 'error');
    return;
  }
  
  const currentPassword = document.getElementById('currentPassword').value;
  const newPassword = document.getElementById('newPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  
  // Verify current password
  if (currentPassword !== currentUser.password) {
    showMessage('Current password is incorrect.', 'error');
    return;
  }
  
  // Validate new password
  if (newPassword.length < 6) {
    showMessage('New password must be at least 6 characters long.', 'error');
    return;
  }
  
  // Check password match
  if (newPassword !== confirmPassword) {
    showMessage('New passwords do not match.', 'error');
    return;
  }
  
  // Update password
  const users = JSON.parse(localStorage.getItem('chefifyUsers')) || [];
  const userIndex = users.findIndex(u => u.id === currentUser.id);
  
  if (userIndex !== -1) {
    users[userIndex].password = newPassword;
    localStorage.setItem('chefifyUsers', JSON.stringify(users));
    currentUser = users[userIndex];
    
    // Reset form
    resetPasswordForm();
    
    showMessage('Password changed successfully!', 'success');
  }
});

// Toggle password visibility
function togglePassword(fieldId) {
  const field = document.getElementById(fieldId);
  const btn = field.nextElementSibling;
  
  if (field.type === 'password') {
    field.type = 'text';
    btn.textContent = '🙈';
  } else {
    field.type = 'password';
    btn.textContent = '👁️';
  }
}

// Reset password form
function resetPasswordForm() {
  document.getElementById('passwordForm').reset();
}

// Show message
function showMessage(text, type) {
  const message = document.getElementById('message');
  message.textContent = text;
  message.className = `message ${type} show`;
  
  setTimeout(() => {
    message.classList.remove('show');
  }, 5000);
  
  // Scroll to top to see message
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Initialize on page load
initProfile();
</script>

</body>
</html>