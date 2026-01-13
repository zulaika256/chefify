<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="contactus.css">

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
      <a href="contactus.php" class="active">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="profile.php">Profile</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>


  <!-- HERO SECTION -->
  <div class="contact-hero">
    <h1>Get In Touch</h1>
    <p>We'd love to hear from you! Reach out to us for any questions, feedback, or inquiries</p>
  </div>

  <!-- CONTACT CONTAINER -->
  <div class="contact-container">
    
    <!-- MAIN CONTACT GRID -->
    <div class="contact-main-grid">
      <!-- CONTACT FORM -->
      <div class="contact-form-section">
        <h2 class="section-title">Send Us A Message</h2>
        <form action="#" method="POST">
          <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">
          </div>
          
          <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required placeholder="your.email@example.com">
          </div>
          
          <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required placeholder="+60 12-345 6789">
          </div>
          
          <div class="form-group">
            <label for="message">Your Message *</label>
            <textarea id="message" name="message" required placeholder="Tell us how we can help you..."></textarea>
          </div>
          
          <button type="submit" class="submit-btn">Send Message</button>
        </form>
      </div>

      <!-- QUICK CONTACT INFO -->
      <div class="quick-contact-section">
        <h2 class="section-title">Quick Contact</h2>
        
        <div class="quick-info-item">
          <h4>📞 General Inquiries</h4>
          <p><a href="tel:+60326888888">+603-2688 8888</a></p>
        </div>

        <div class="quick-info-item">
          <h4>✉️ Email Us</h4>
          <p><a href="mailto:hello@chefify.com">hello@chefify.com</a></p>
        </div>

        <div class="quick-info-item">
          <h4>🕐 Operating Hours</h4>
          <p>Monday - Friday: 9:00 AM - 10:00 PM</p>
          <p>Saturday - Sunday: 9:00 AM - 11:00 PM</p>
        </div>

        <div class="quick-info-item social-section">
          <h4>Follow Us</h4>
          <div class="social-links">
            <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" class="social-btn" title="Instagram">📷</a>
            <a href="https://www.tiktok.com/@chefifyapp?_r=1&_t=ZS-92RNDS9aRWs" target="_blank" class="social-btn" title="TikTok">🎵</a>
          </div>
        </div>
      </div>
    </div>

    <!-- BRANCH CONTACTS -->
    <div class="branch-section">
      <h2 class="branch-title">Contact Our Branches</h2>
      <div class="branch-grid">
        
        <!-- Pasar Seni Branch -->
        <div class="branch-card">
          <h3 class="branch-name">Pasar Seni, KL</h3>
          <span class="branch-tag">Flagship Store</span>
          <div class="branch-info">
            <div class="branch-info-item">
              <span class="branch-icon">📞</span>
              <a href="tel:+60320268888">+603-2026 8888</a>
            </div>
            <div class="branch-info-item">
              <span class="branch-icon">✉️</span>
              <a href="mailto:pasarseni@chefify.com">pasarseni@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Gelugor Branch -->
        <div class="branch-card">
          <h3 class="branch-name">Gelugor, Penang</h3>
          <span class="branch-tag">Northern Branch</span>
          <div class="branch-info">
            <div class="branch-info-item">
              <span class="branch-icon">📞</span>
              <a href="tel:+6046577777">+604-657 7777</a>
            </div>
            <div class="branch-info-item">
              <span class="branch-icon">✉️</span>
              <a href="mailto:penang@chefify.com">penang@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Kota Bharu Branch -->
        <div class="branch-card">
          <h3 class="branch-name">Kota Bharu, Kelantan</h3>
          <span class="branch-tag">East Coast Branch</span>
          <div class="branch-info">
            <div class="branch-info-item">
              <span class="branch-icon">📞</span>
              <a href="tel:+6097476666">+609-747 6666</a>
            </div>
            <div class="branch-info-item">
              <span class="branch-icon">✉️</span>
              <a href="mailto:kelantan@chefify.com">kelantan@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Sabah Branch -->
        <div class="branch-card">
          <h3 class="branch-name">Kota Kinabalu, Sabah</h3>
          <span class="branch-tag">East Malaysia Branch</span>
          <div class="branch-info">
            <div class="branch-info-item">
              <span class="branch-icon">📞</span>
              <a href="tel:+60882325555">+6088-232 5555</a>
            </div>
            <div class="branch-info-item">
              <span class="branch-icon">✉️</span>
              <a href="mailto:sabah@chefify.com">sabah@chefify.com</a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- DEPARTMENTS -->
    <div class="department-section">
      <h2 class="branch-title">Specialized Inquiries</h2>
      <div class="department-grid">
        
        <!-- Partnership -->
        <div class="department-card">
          <span class="department-icon">🤝</span>
          <h3 class="department-name">Partnership & Enterprise</h3>
          <p class="department-desc">Interested in collaborating with us? Let's explore business opportunities together.</p>
          <div class="department-contact">
            <div class="dept-contact-item">
              <span class="branch-icon">📞</span>
              <a href="tel:+60326881100">+60 18-2505 922</a>
            </div>
            <div class="dept-contact-item">
              <span class="branch-icon">✉️</span>
              <a href="mailto:partnership@chefify.com">partnership@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Membership -->
        <div class="department-card">
          <span class="department-icon">⭐</span>
          <h3 class="department-name">Membership Team</h3>
          <p class="department-desc">Questions about your rewards, points, or membership benefits? We're here to help!</p>
          <div class="department-contact">
            <div class="dept-contact-item">
              <span class="branch-icon">📞</span>
              <a href="tel:+60326881200">+60 19-990 4573</a>
            </div>
            <div class="dept-contact-item">
              <span class="branch-icon">✉️</span>
              <a href="mailto:membership@chefify.com">membership@chefify.com</a>
            </div>
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

</body>
</html>

  </div>

</body>

</html>
