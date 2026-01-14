<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chefify's Free Spin</title>

    <link rel="icon" href="img/chefify.jpg" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="reward_spin.css">
</head>
<body>

<?php
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Get current points
$stmt = $pdo->prepare("SELECT points FROM reward_points WHERE user_id = :uid");
$stmt->execute([':uid' => $_SESSION['user_id']]);
$res = $stmt->fetch();
$points = $res ? (int)$res['points'] : 0;
?>

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
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="locations.php" >Locations</a>
        <a href="aboutus.php" >About Us</a>
        <a href="contactus.php" >Contact Us</a>
        <a href="feedback.php" >Feedback</a>
        <a href="profile.php" >Profile</a>
        <a href="login.php">Logout</a>
      </div>
  </div>
</nav>

<!-- HEADER -->
<div class="header">
    <h2><i class="fa-solid fa-gift"></i> Free Spin Rewards</h2>
    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

<!-- MAIN -->
<div class="container">
    <div class="wheel-wrapper">
        <div class="pointer"></div>
        <canvas id="wheel" width="450" height="450"></canvas>
    </div>

    <button id="spinBtn">
        <i class="fa-solid fa-play"></i> SPIN NOW
    </button>

    <p id="pointText" style="margin-top:15px;font-weight:700;">
        Your Points: <span id="pointValue"><?php echo $points; ?></span>
    </p>
</div>

<!-- POPUP -->
<div id="popup" class="popup">
    <div class="popup-content">
        <i class="fa-solid fa-circle-check"
           style="font-size:4rem;color:#2ecc71;margin-bottom:15px;"></i>
        <h2>Congratulations!</h2>
        <p id="resultText"></p>
        <button id="closePopup">Redeem Now</button>
    </div>
</div>

<!-- AUDIO -->
<audio id="spinSound" src="audio/spin.mp3"></audio>
<audio id="winSound" src="audio/yeayy.mp3"></audio>

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
            <a href="tel:+60123456789">+60 12-345 6789</a>
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

<!-- JAVASCRIPT -->
<script>
const canvas = document.getElementById('wheel');
const ctx = canvas.getContext('2d');
const spinBtn = document.getElementById('spinBtn');
const popup = document.getElementById('popup');
const resultText = document.getElementById('resultText');
const closePopup = document.getElementById('closePopup');
const spinSound = document.getElementById('spinSound');
const winSound = document.getElementById('winSound');
const pointValue = document.getElementById('pointValue');

const spinCost = 30;
let userPoints = parseInt(pointValue.textContent || '0', 10);

const segments = [
  'Free Voucher 50%',
  'Free Tiramisu',
  'Free Matcha Latte',
  'Free Cookies',
  'Free Voucher 20%',
  'Mystery Gift'
];
const colors = ['#f8a1b3','#f28fa5','#ec7f98','#e66f8b','#df5f7d','#d85072'];
const size = canvas.width;
const center = size/2;
const radius = center;
let startAngle = 0;
let spinning = false;

function drawWheel(){
  const angle = (2*Math.PI)/segments.length;
  ctx.clearRect(0,0,size,size);
  for(let i=0;i<segments.length;i++){
    const s = startAngle + i*angle;
    const e = s + angle;
    ctx.beginPath(); ctx.moveTo(center,center);
    ctx.arc(center,center,radius,s,e);
    ctx.fillStyle = colors[i]; ctx.fill();
    ctx.strokeStyle = 'rgba(255,255,255,0.2)'; ctx.stroke();
    ctx.save(); ctx.translate(center,center); ctx.rotate(s+angle/2);
    ctx.textAlign = 'right'; ctx.fillStyle = '#fff'; ctx.font = 'bold 14px Arial';
    ctx.fillText(segments[i], radius-30, 8); ctx.restore();
  }
  ctx.beginPath(); ctx.arc(center,center,40,0,2*Math.PI); ctx.fillStyle='white'; ctx.fill(); ctx.stroke();
}

function updateUI(){
  pointValue.textContent = userPoints;
  if(userPoints < spinCost){ spinBtn.disabled = true; spinBtn.innerHTML = '❌ Not enough points'; }
  else { spinBtn.disabled = false; spinBtn.innerHTML = '<i class="fa-solid fa-play"></i> SPIN NOW'; }
}

function startSpin(){
  if(spinning) return;
  // ask server to deduct cost
  fetch('process_spin.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({action:'deduct'})})
  .then(r=>r.json())
  .then(res=>{
    if(!res.success){ alert(res.message || 'Unable to spin'); return; }
    userPoints = res.points;
    updateUI();
    doSpinAnimation();
  }).catch(()=> alert('Network error'));
}

function doSpinAnimation(){
  spinning = true; spinSound.currentTime=0; spinSound.play();
  const spinAngle = Math.random()*3000 + 3000;
  const duration = 5000; const start = performance.now();
  function animate(time){
    const progress = Math.min((time-start)/duration,1);
    const ease = 1 - Math.pow(1-progress,3);
    startAngle = (ease * spinAngle * Math.PI/180) % (2*Math.PI);
    drawWheel();
    if(progress<1) requestAnimationFrame(animate);
    else finishSpin();
  }
  requestAnimationFrame(animate);
}

function finishSpin(){
  const segAngle = 2*Math.PI/segments.length;
  const pointerAngle = (3*Math.PI/2);
  const index = Math.floor(((pointerAngle - startAngle + 2*Math.PI) % (2*Math.PI)) / segAngle);
  const prize = segments[index];
  // notify server about award
  fetch('process_spin.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({action:'award', prize})})
  .then(r=>r.json()).then(res=>{
    spinning=false;
    if(res.success){
      userPoints = res.points;
      updateUI();
      let msg = prize;
      if(res.voucher) msg += '\nCode: '+res.voucher;
      if(res.awardPoints) msg += '\nYou earned '+res.awardPoints+' points!';
      resultText.textContent = msg;
      popup.style.display = 'flex'; winSound.currentTime=0; winSound.play();
    } else {
      alert('Error awarding prize');
    }
  }).catch(()=> alert('Network error'));
}

drawWheel(); updateUI();

spinBtn.addEventListener('click', startSpin);
closePopup.addEventListener('click', ()=>{ popup.style.display='none'; });
</script>

</body>
</html>





