<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Chefify</title>
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
      overflow-x: hidden;
    }

    /* Floating elements animation */
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }

    @keyframes float-reverse {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(20px) rotate(-5deg); }
    }

    .bg-decoration {
      position: fixed;
      pointer-events: none;
      opacity: 0.08;
      z-index: 0;
    }

    .bg-decoration.circle1 {
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, var(--peach-1), transparent);
      top: -100px;
      right: -100px;
      animation: float 6s ease-in-out infinite;
    }

    .bg-decoration.circle2 {
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, var(--peach-2), transparent);
      bottom: 100px;
      left: -50px;
      animation: float-reverse 8s ease-in-out infinite;
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

    /* ================= CONTACT PAGE ================= */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .contact-hero {
      text-align: center;
      padding: 5rem 1rem 3rem;
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .contact-hero h1 {
      font-size: 4.5rem;
      color: var(--chef-brown);
      margin-bottom: 1rem;
      font-weight: 900;
      letter-spacing: -2px;
      animation: fadeInUp 0.8s ease;
    }

    .contact-hero p {
      font-size: 1.3rem;
      color: #8b4c3a;
      max-width: 700px;
      margin: 0 auto;
      animation: fadeInUp 0.8s ease 0.2s both;
    }

    .contact-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem 4rem;
      position: relative;
      z-index: 1;
    }

    /* Main Contact Grid */
    .contact-main-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-bottom: 3rem;
      animation: fadeInUp 0.8s ease 0.3s both;
    }

    /* Contact Form */
    .contact-form-section {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(255, 245, 240, 0.98));
      border-radius: 32px;
      padding: 3rem;
      box-shadow: 0 20px 60px rgba(100, 40, 20, 0.15);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 221, 224, 0.5);
      transition: all 0.5s ease;
    }

    .contact-form-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 70px rgba(100, 40, 20, 0.2);
    }

    .section-title {
      font-size: 2.2rem;
      color: var(--chef-brown);
      margin-bottom: 1.5rem;
      font-weight: 800;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: var(--chef-brown);
      font-weight: 600;
      font-size: 0.95rem;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 1rem 1.2rem;
      border: 2px solid rgba(255, 150, 130, 0.2);
      border-radius: 16px;
      font-size: 1rem;
      font-family: inherit;
      transition: all 0.3s ease;
      background: white;
      color: var(--chef-brown);
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--peach-1);
      box-shadow: 0 0 0 4px rgba(255, 150, 130, 0.1);
      transform: translateY(-2px);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 150px;
    }

    .submit-btn {
      width: 100%;
      padding: 1.2rem;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      border: none;
      border-radius: 16px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(255, 150, 130, 0.3);
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(255, 150, 130, 0.4);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    /* Quick Contact Info */
    .quick-contact-section {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(255, 245, 240, 0.98));
      border-radius: 32px;
      padding: 3rem;
      box-shadow: 0 20px 60px rgba(100, 40, 20, 0.15);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 221, 224, 0.5);
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .quick-info-item {
      background: white;
      padding: 1.5rem;
      border-radius: 20px;
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }

    .quick-info-item:hover {
      border-color: var(--peach-1);
      transform: translateX(10px);
      box-shadow: 0 8px 25px rgba(255, 150, 130, 0.2);
    }

    .quick-info-item h4 {
      color: var(--peach-1);
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 0.8rem;
      font-weight: 700;
    }

    .quick-info-item p {
      color: var(--chef-brown);
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .quick-info-item a {
      color: var(--chef-brown);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .quick-info-item a:hover {
      color: var(--peach-1);
    }

    /* Social Media */
    .social-section {
      text-align: center;
    }

    .social-links {
      display: flex;
      gap: 1rem;
      justify-content: center;
      margin-top: 1rem;
    }

    .social-btn {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.8rem;
      text-decoration: none;
      transition: all 0.4s ease;
      box-shadow: 0 8px 20px rgba(255, 150, 130, 0.3);
    }

    .social-btn:hover {
      transform: translateY(-8px) scale(1.1);
      box-shadow: 0 15px 40px rgba(255, 150, 130, 0.5);
    }

    /* Branch Contact Cards */
    .branch-section {
      animation: fadeInUp 0.8s ease 0.4s both;
      margin-bottom: 3rem;
    }

    .branch-title {
      font-size: 2.5rem;
      color: var(--chef-brown);
      margin-bottom: 2rem;
      font-weight: 800;
      text-align: center;
    }

    .branch-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
    }

    .branch-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(255, 245, 240, 0.98));
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 15px 40px rgba(100, 40, 20, 0.12);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 221, 224, 0.5);
      transition: all 0.4s ease;
    }

    .branch-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 50px rgba(100, 40, 20, 0.2);
    }

    .branch-name {
      font-size: 1.5rem;
      color: var(--chef-brown);
      font-weight: 800;
      margin-bottom: 0.5rem;
    }

    .branch-tag {
      display: inline-block;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      padding: 0.4rem 1rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
    }

    .branch-info {
      margin-top: 1rem;
    }

    .branch-info-item {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin-bottom: 1rem;
      color: var(--chef-brown);
      transition: all 0.3s ease;
      padding: 0.5rem;
      border-radius: 10px;
    }

    .branch-info-item:hover {
      background: rgba(255, 150, 130, 0.1);
      transform: translateX(5px);
    }

    .branch-icon {
      font-size: 1.3rem;
    }

    .branch-info-item a {
      color: var(--chef-brown);
      text-decoration: none;
      font-weight: 600;
    }

    .branch-info-item a:hover {
      color: var(--peach-1);
    }

    /* Department Cards */
    .department-section {
      animation: fadeInUp 0.8s ease 0.5s both;
      margin-bottom: 3rem;
    }

    .department-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
    }

    .department-card {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      box-shadow: 0 15px 40px rgba(100, 40, 20, 0.12);
      border: 2px solid rgba(255, 221, 224, 0.5);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .department-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .department-card:hover::before {
      opacity: 0.05;
    }

    .department-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 50px rgba(100, 40, 20, 0.2);
      border-color: var(--peach-1);
    }

    .department-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      display: block;
      animation: float 3s ease-in-out infinite;
      position: relative;
      z-index: 1;
    }

    .department-name {
      font-size: 1.6rem;
      color: var(--chef-brown);
      font-weight: 800;
      margin-bottom: 0.8rem;
      position: relative;
      z-index: 1;
    }

    .department-desc {
      color: #8b4c3a;
      margin-bottom: 1.5rem;
      line-height: 1.6;
      position: relative;
      z-index: 1;
    }

    .department-contact {
      position: relative;
      z-index: 1;
    }

    .dept-contact-item {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin-bottom: 0.8rem;
      color: var(--chef-brown);
      font-size: 0.95rem;
      padding: 0.5rem;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .dept-contact-item:hover {
      background: rgba(255, 150, 130, 0.1);
    }

    .dept-contact-item a {
      color: var(--chef-brown);
      text-decoration: none;
      font-weight: 600;
    }

    .dept-contact-item a:hover {
      color: var(--peach-1);
    }

    /* Responsive Design */
    @media (max-width: 968px) {
      .contact-hero h1 {
        font-size: 3rem;
        letter-spacing: -1px;
      }

      .contact-main-grid,
      .branch-grid,
      .department-grid {
        grid-template-columns: 1fr;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
      }

      .contact-form-section,
      .quick-contact-section,
      .branch-card,
      .department-card {
        padding: 2rem;
      }
    }

    @media (max-width: 600px) {
      .contact-hero h1 {
        font-size: 2.5rem;
      }

      .contact-form-section,
      .quick-contact-section,
      .branch-card,
      .department-card {
        padding: 1.5rem;
        border-radius: 20px;
      }

      .social-btn {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- Background Decorations -->
  <div class="bg-decoration circle1"></div>
  <div class="bg-decoration circle2"></div>

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
      <a href="aboutus.php">About Us</a>
      <a href="contactus.php" class="active">Contact Us</a>
      <a href="feedback.php">Feedback</a>
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
            <a href="https://instagram.com/chefify" target="_blank" class="social-btn" title="Instagram">📷</a>
            <a href="https://tiktok.com/@chefify" target="_blank" class="social-btn" title="TikTok">🎵</a>
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
              <a href="tel:+60326881100">+603-2688 1100</a>
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
              <a href="tel:+60326881200">+603-2688 1200</a>
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

</body>
</html>