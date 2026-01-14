<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: logout.php");
    exit();
}

$user_fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
$user_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

try {
    $stmt = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC LIMIT 5");
    $reviews = $stmt->fetchAll();
} catch (PDOException $e) {
    $reviews = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Share Your Feedback | Chefify</title>
    <link rel="stylesheet" href="feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
/* ================= ROOT VARIABLES ================= */
:root {
    --chef-brown: #4b2e19;
    --peach-1: #ffd6c8;
    --peach-2: #ffb7a1;
    --btn-peach: #ff9e85;
    --btn-peach-hover: #ff6f8a;
    --card-cream: rgba(255, 255, 255, 0.95);
    --gold: #f1c40f;
}

/* ================= RESET & BODY ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: url('img/wallpaper1.jpg') no-repeat center/cover fixed;
    color: var(--chef-brown);
    min-height: 100vh;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(255, 170, 150, .3);
    z-index: -1;
}

/* ================= NAVIGATION ================= */
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

/* ===== HEADER ===== */
.header {
    max-width: 1200px;
    margin: 2rem auto 1rem;
    padding: 1rem 1.5rem;
    background: #F4F4F4;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(75, 46, 25, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h2 {
    font-size: 1.6rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.back-link {
    text-decoration: none;
    color: var(--chef-brown);
    font-weight: 700;
    background: var(--peach-1);
    padding: 8px 18px;
    border-radius: 20px;
    transition: 0.3s;
    font-size: 0.9rem;
}

.back-link:hover {
    background: var(--peach-2);
    color: white;
    transform: translateX(-5px);
}

/* ================= FEEDBACK CARD ================= */
.feedback-wrapper {
    display: flex;
    justify-content: center;
    padding: 40px 20px;
}

.feedback-card {
    background: var(--card-cream);
    width: 100%;
    max-width: 600px;
    padding: 30px;
    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(75, 46, 25, 0.2);
}

.feedback-header {
    text-align: center;
    margin-bottom: 25px;
}

.feedback-header h2 {
    font-size: 1.8rem;
    margin-bottom: 5px;
}

/* ================= POINTS BOX ================= */
.points-box {
    background: #fff3cd;
    color: #856404;
    padding: 12px;
    border-radius: 12px;
    text-align: center;
    font-weight: bold;
    border: 1px dashed #ffeeba;
    margin-bottom: 25px;
}

/* ================= FORM ELEMENTS ================= */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid var(--peach-1);
    border-radius: 10px;
    outline: none;
}

.form-group input:focus {
    border-color: var(--btn-peach);
}

/* STAR RATING */
.star-container {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 10px 0;
}

.star-container i {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: 0.2s;
}

.star-container i.active {
    color: var(--gold);
}

.btn-submit {
    width: 100%;
    background: var(--btn-peach);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 12px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s;
}

.btn-submit:hover {
    background: var(--btn-peach-hover);
}

/* ================= OTHERS FEEDBACK SECTION ================= */
.others-section {
    margin-top: 40px;
    border-top: 2px solid #eee;
    padding-top: 25px;
}

.review-item {
    background: white;
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.review-item strong {
    color: var(--chef-brown);
}

.review-item .rating-display {
    color: var(--gold);
    float: right;
    font-size: 0.9rem;
}

.review-item p {
    margin-top: 8px;
    font-style: italic;
    color: #555;
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

/* ================= PAGE ENTER TRANSITION ================= */
.page-enter {
    opacity: 0;
    transform: translateY(20px);
    animation: pageFadeUp 0.6s ease forwards;
}

@keyframes pageFadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

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
        <a href="locations.php" >Locations</a>
        <a href="aboutus.php" >About Us</a>
        <a href="contactus.php" >Contact Us</a>
        <a href="feedback.php" class="active">Feedback</a>
        <a href="profile.php" >Profile</a>
        <a href="login.php">Logout</a>
      </div>
  </div>
</nav>

<!-- HEADER -->
<div class="header">
    <h2><i class="fa-solid fa-gift"></i> Feedback</h2>
    <a href="homepage.php" class="back-link">← Back to Dashboard</a>
</div>

<body class="page-enter">
<div class="feedback-wrapper">
    <div class="feedback-card">
        
        <div class="feedback-header">
            <h2><i class="fa-solid fa-comment-dots"></i> We Value Your Voice!</h2>
            <p>Your feedback helps us cook better.</p>
        </div>

        <div class="points-box">
            <i class="fa-solid fa-gift"></i> Give feedback and earn <b>5 Points!</b>
        </div>

        <form id="userFeedbackForm">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="userName" value="<?php echo htmlspecialchars($user_fullname); ?>" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="userEmail" value="<?php echo htmlspecialchars($user_email); ?>" placeholder="Enter your email" required>
            </div>

            <div class="form-group" style="text-align: center;">
                <label>Rate your experience</label>
                <div class="star-container" id="starGroup">
                    <i class="fa-solid fa-star" data-value="1"></i>
                    <i class="fa-solid fa-star" data-value="2"></i>
                    <i class="fa-solid fa-star" data-value="3"></i>
                    <i class="fa-solid fa-star" data-value="4"></i>
                    <i class="fa-solid fa-star" data-value="5"></i>
                </div>
                <input type="hidden" id="userRating" value="0">
            </div>

            <div class="form-group">
                <label>Your Comments</label>
                <textarea id="userComment" rows="4" placeholder="How was your meal?" required></textarea>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Submit & Earn Points
            </button>
        </form>

        <div class="others-section">
            <h3 style="margin-bottom: 20px;"><i class="fa-solid fa-users"></i> Recent Reviews</h3>
            <div id="othersReviewList">
                <?php
                foreach ($reviews as $rev) {
                    $stars = str_repeat("★", $rev['rating']);
                    echo '<div class="review-item">';
                    echo '<strong>' . htmlspecialchars($rev['name']) . '</strong> <span class="rating-display">' . $stars . '</span>';
                    echo '<p>"' . htmlspecialchars($rev['comment']) . '"</p>';
                    echo '</div>';
                }
                ?>
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
    // 1. LOGIC RATING BINTANG
    const stars = document.querySelectorAll('#starGroup i');
    const ratingInput = document.getElementById('userRating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = star.getAttribute('data-value');
            ratingInput.value = val;

            // Reset dan aktifkan bintang
            stars.forEach(s => {
                s.classList.toggle('active', s.getAttribute('data-value') <= val);
            });
        });
    });

    // 2. LOGIC SUBMIT FORM
    document.getElementById('userFeedbackForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah Page Not Found (mencegah reload paksa)

        const name = document.getElementById('userName').value;
        const email = document.getElementById('userEmail').value;
        const rating = ratingInput.value;
        const comment = document.getElementById('userComment').value;

        if (rating === "0") {
            Swal.fire('Wait!', 'Please provide a star rating.', 'warning');
            return;
        }

        // Send to server
        fetch('save_feedback.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                name: name,
                email: email,
                rating: rating,
                comment: comment
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // TAMPILKAN FEEDBACK BARU SECARA INSTAN DI BAWAH
                const reviewList = document.getElementById('othersReviewList');
                const newEntry = document.createElement('div');
                newEntry.className = 'review-item';
                newEntry.innerHTML = `
                    <strong>${name} (You)</strong> <span class="rating-display">${"★".repeat(rating)}</span>
                    <p>"${comment}"</p>
                `;
                reviewList.prepend(newEntry); // Tambahkan ke paling atas daftar

                // POPUP SUKSES POIN
                Swal.fire({
                    title: 'Thank you!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonColor: '#ff9e85'
                }).then(() => {
                    // Reset form
                    document.getElementById('userFeedbackForm').reset();
                    stars.forEach(s => s.classList.remove('active'));
                    ratingInput.value = "0";
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error', 'Something went wrong', 'error');
        });
    });
</script>

</body>
</html>
