<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Share Your Feedback | Chefify</title>
    
    <link rel="stylesheet" href="css/feedback.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<nav>
  <div class="nav-container">
    <a href="homepage.php" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>
      <div class="nav-links" role="menu" aria-label="Main links">
        <a href="homepage.php">Home</a>
        <a href="menu.php" class="active">Menu</a>
        <a href="cart.php">Cart</a>
        <a href="dashboard.php">Dashboard</a>
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
    <h2><i class="fa-solid fa-gift"></i> Feedback</h2>
    <a href="homepage.php" class="back-link">← Back to Dashboard</a>
</div>

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
                <input type="text" id="userName" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="userEmail" placeholder="Enter your email" required>
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
                <div class="review-item">
                    <strong>Amna</strong> <span class="rating-display">★★★★★</span>
                    <p>"The drinks are so good! I love the matcha mango so much."</p>
                </div>
                <div class="review-item">
                    <strong>Aliffah</strong> <span class="rating-display">★★★★</span>
                    <p>"Nice café, cute design. Chocolate milk a bit sweet for me."</p>
                </div>
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
            text: 'You earned 5 Chefify Points!',
            icon: 'success',
            confirmButtonColor: '#ff9e85'
        }).then(() => {
            // Reset form
            document.getElementById('userFeedbackForm').reset();
            stars.forEach(s => s.classList.remove('active'));
            ratingInput.value = "0";
        });
    });
</script>

</body>
</html>


