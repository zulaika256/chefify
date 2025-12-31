<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Chefify</title>
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

    .bg-decoration.circle3 {
      width: 150px;
      height: 150px;
      background: radial-gradient(circle, var(--light-peach), transparent);
      top: 50%;
      right: 10%;
      animation: float 7s ease-in-out infinite;
    }

    /* ================= NAV ================= */
    nav {
      position: sticky;
      top: 0;
      z-index: 999;
      background: rgba(255, 245, 240, 0.95);
      padding: 1.25rem 0;
      backdrop-filter: blur(20px);
      box-shadow: 0 4px 20px rgba(100, 40, 20, 0.08);
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
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .logo-img {
      height: 60px;
      width: auto;
      border-radius: 50%;
      border: 3px solid #ffdde0;
      box-shadow: 0 6px 20px rgba(100, 40, 20, 0.35);
    }

    .logo-text {
      font-size: 1.6rem;
      font-weight: 800;
      background: linear-gradient(45deg, var(--chef-brown), var(--peach-1));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
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
      transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }

    .nav-links a::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .nav-links a:hover::before {
      width: 80%;
    }

    .nav-links a:hover {
      color: white;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      box-shadow: 0 8px 25px rgba(255, 150, 130, 0.3);
      transform: translateY(-3px);
    }

    .nav-links a.active {
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      box-shadow: 0 8px 25px rgba(255, 150, 130, 0.3);
    }

    /* ================= ABOUT PAGE ================= */
    .about-hero {
      text-align: center;
      padding: 5rem 1rem 3rem;
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .about-hero h1 {
      font-size: 4.5rem;
      background: linear-gradient(135deg, var(--chef-brown) 0%, var(--peach-1) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      font-weight: 900;
      letter-spacing: -2px;
      animation: fadeInUp 0.8s ease;
    }

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

    .about-hero p {
      font-size: 1.3rem;
      color: #8b4c3a;
      max-width: 700px;
      margin: 0 auto;
      animation: fadeInUp 0.8s ease 0.2s both;
    }

    .about-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem 4rem;
      position: relative;
      z-index: 1;
    }

    /* History Section with parallax effect */
    .history-section {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 245, 240, 0.95));
      border-radius: 32px;
      padding: 4rem 3rem;
      margin-bottom: 3rem;
      box-shadow: 0 20px 60px rgba(100, 40, 20, 0.15);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 221, 224, 0.5);
      position: relative;
      overflow: hidden;
      animation: fadeInUp 0.8s ease 0.3s both;
    }

    .history-section::before {
      content: '🍳';
      position: absolute;
      font-size: 15rem;
      opacity: 0.05;
      top: -50px;
      right: -50px;
      animation: float 10s ease-in-out infinite;
    }

    .section-title {
      font-size: 3rem;
      background: linear-gradient(135deg, var(--chef-brown), var(--peach-1));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 2rem;
      font-weight: 800;
      text-align: center;
      position: relative;
      display: inline-block;
      width: 100%;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background: linear-gradient(90deg, transparent, var(--peach-1), transparent);
      border-radius: 2px;
    }

    .history-content {
      font-size: 1.2rem;
      line-height: 2;
      color: #64281a;
      text-align: center;
      max-width: 900px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .tagline {
      font-style: italic;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
      font-size: 1.5rem;
      margin-top: 1.5rem;
      display: block;
      position: relative;
    }

    .tagline::before, .tagline::after {
      content: '"';
      font-size: 2rem;
      opacity: 0.3;
    }

    /* Vision & Mission with 3D effect */
    .vision-mission-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-bottom: 3rem;
      animation: fadeInUp 0.8s ease 0.4s both;
    }

    .vision-card, .mission-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(255, 245, 240, 0.98));
      border-radius: 32px;
      padding: 3rem;
      box-shadow: 0 20px 60px rgba(100, 40, 20, 0.15);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 221, 224, 0.5);
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .vision-card::before, .mission-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .vision-card:hover::before, .mission-card:hover::before {
      opacity: 0.05;
    }

    .vision-card:hover, .mission-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 30px 80px rgba(100, 40, 20, 0.25);
    }

    .card-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      display: block;
      animation: float 3s ease-in-out infinite;
      filter: drop-shadow(0 4px 8px rgba(255, 150, 130, 0.3));
    }

    .card-title {
      font-size: 2.2rem;
      background: linear-gradient(135deg, var(--chef-brown), var(--peach-1));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1.5rem;
      font-weight: 800;
      position: relative;
      z-index: 1;
    }

    .card-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #64281a;
      position: relative;
      z-index: 1;
    }

    .mission-list {
      list-style: none;
      padding: 0;
      position: relative;
      z-index: 1;
    }

    .mission-list li {
      padding-left: 2rem;
      margin-bottom: 1rem;
      position: relative;
      line-height: 1.8;
      transition: transform 0.3s ease;
    }

    .mission-list li:hover {
      transform: translateX(10px);
    }

    .mission-list li::before {
      content: "✓";
      position: absolute;
      left: 0;
      width: 30px;
      height: 30px;
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1rem;
      box-shadow: 0 4px 12px rgba(255, 150, 130, 0.4);
    }

    /* Team Section with cards */
    .team-section {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 245, 240, 0.95));
      border-radius: 32px;
      padding: 4rem 3rem;
      box-shadow: 0 20px 60px rgba(100, 40, 20, 0.15);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 221, 224, 0.5);
      animation: fadeInUp 0.8s ease 0.5s both;
      position: relative;
      overflow: hidden;
    }

    .team-section::before {
      content: '👨‍🍳';
      position: absolute;
      font-size: 20rem;
      opacity: 0.03;
      bottom: -80px;
      left: -50px;
      animation: float-reverse 15s ease-in-out infinite;
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2.5rem;
      margin-top: 3rem;
      position: relative;
      z-index: 1;
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
    }

    .team-member {
      background: white;
      border-radius: 24px;
      padding: 2.5rem 2rem;
      text-align: center;
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 10px 30px rgba(100, 40, 20, 0.1);
      border: 2px solid transparent;
      position: relative;
      overflow: hidden;
    }

    .team-member::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--peach-1), var(--peach-2));
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .team-member:hover::before {
      opacity: 0.05;
    }

    .team-member:hover {
      transform: translateY(-20px) scale(1.05);
      box-shadow: 0 25px 60px rgba(100, 40, 20, 0.25);
      border-color: var(--peach-1);
    }

    .member-image {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      margin: 0 auto 2rem;
      background: linear-gradient(135deg, var(--light-peach), var(--peach-2));
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 5px solid white;
      box-shadow: 0 15px 40px rgba(100, 40, 20, 0.2);
      transition: all 0.5s ease;
      position: relative;
      z-index: 1;
    }

    .team-member:hover .member-image {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 20px 50px rgba(255, 150, 130, 0.4);
    }

    .member-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .member-image::before {
      content: '👤';
      font-size: 5rem;
      opacity: 0.4;
    }

    .member-role {
      font-size: 0.85rem;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      padding: 0.5rem 1.2rem;
      border-radius: 20px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      margin-bottom: 1rem;
      display: inline-block;
      box-shadow: 0 6px 20px rgba(255, 150, 130, 0.3);
      position: relative;
      z-index: 1;
    }

    .member-name {
      font-size: 1.6rem;
      color: var(--chef-brown);
      font-weight: 800;
      margin-bottom: 1.5rem;
      position: relative;
      z-index: 1;
    }

    .member-contact {
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 2px solid rgba(255, 150, 130, 0.2);
      position: relative;
      z-index: 1;
    }

    .contact-item {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.8rem;
      margin-bottom: 0.8rem;
      color: #64281a;
      font-size: 1rem;
      transition: all 0.3s ease;
      padding: 0.5rem;
      border-radius: 10px;
    }

    .contact-item:hover {
      background: rgba(255, 150, 130, 0.1);
      transform: scale(1.05);
    }

    .contact-icon {
      font-size: 1.3rem;
      filter: drop-shadow(0 2px 4px rgba(255, 150, 130, 0.3));
    }

    .contact-item a {
      color: #64281a;
      text-decoration: none;
      transition: all 0.3s ease;
      font-weight: 600;
    }

    .contact-item:hover a {
      color: var(--peach-1);
    }

    /* Responsive Design */
    @media (max-width: 968px) {
      .vision-mission-section {
        grid-template-columns: 1fr;
      }

      .about-hero h1 {
        font-size: 3rem;
        letter-spacing: -1px;
      }

      .section-title {
        font-size: 2.2rem;
      }

      .history-section, .team-section {
        padding: 2.5rem 2rem;
      }

      .team-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
      }
    }

    @media (max-width: 600px) {
      .about-hero h1 {
        font-size: 2.5rem;
      }

      .history-section, .vision-card, .mission-card, .team-section {
        padding: 2rem 1.5rem;
        border-radius: 24px;
      }

      .team-grid {
        grid-template-columns: 1fr;
      }

      .card-icon {
        font-size: 3rem;
      }

      .member-image {
        width: 150px;
        height: 150px;
      }
    }
  </style>
</head>
<body>
  <!-- Background Decorations -->
  <div class="bg-decoration circle1"></div>
  <div class="bg-decoration circle2"></div>
  <div class="bg-decoration circle3"></div>

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
        <a href="aboutus.html" class="active">About</a>
        <a href="contactus.html">Contact Us</a>
        <a href="index.html">Logout</a>
      </div>
    </div>
  </nav>

  <!-- HERO SECTION -->
  <div class="about-hero">
    <h1>About Chefify</h1>
    <p>Discover our story, values, and the passionate team behind your comfort food experience</p>
  </div>

  <!-- ABOUT CONTAINER -->
  <div class="about-container">
    
    <!-- HISTORY SECTION -->
    <div class="history-section">
      <h2 class="section-title">Our History</h2>
      <div class="history-content">
        <p>Chefify was established with the aim of serving comforting food inspired by familiar and homely flavours. Built on the belief that good food brings comfort, Chefify focuses on simple, well-prepared dishes that create a warm and welcoming dining experience. This philosophy is reflected in its tagline,</p>
        <span class="tagline">Serving comfort in every bites.</span>
      </div>
    </div>

    <!-- VISION & MISSION SECTION -->
    <div class="vision-mission-section">
      <!-- VISION -->
      <div class="vision-card">
        <span class="card-icon">🌟</span>
        <h3 class="card-title">Our Vision</h3>
        <p class="card-content">
          To be a café where every meal brings comfort, warmth, and a sense of home to everyone who walks through our doors.
        </p>
      </div>

      <!-- MISSION -->
      <div class="mission-card">
        <span class="card-icon">🎯</span>
        <h3 class="card-title">Our Mission</h3>
        <ul class="mission-list">
          <li>To prepare dishes using fresh ingredients and well-balanced flavours</li>
          <li>To maintain high standards in food quality, cleanliness, and service</li>
          <li>To continuously improve our menu while staying true to comforting café classics</li>
        </ul>
      </div>
    </div>

    <!-- TEAM SECTION -->
    <div class="team-section">
      <h2 class="section-title">Meet Our Team</h2>
      <div class="team-grid">
        
        <!-- General Manager -->
        <div class="team-member">
          <div class="member-image">
            <!-- Replace with: <img src="img/gm-photo.jpg" alt="General Manager"> -->
          </div>
          <div class="member-role">General Manager</div>
          <div class="member-name">Name Here</div>
          <div class="member-contact">
            <div class="contact-item">
              <span class="contact-icon">📞</span>
              <a href="tel:+60123456789">+60 12-345 6789</a>
            </div>
            <div class="contact-item">
              <span class="contact-icon">✉️</span>
              <a href="mailto:gm@chefify.com">gm@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Administration Manager -->
        <div class="team-member">
          <div class="member-image">
            <!-- Replace with: <img src="img/admin-photo.jpg" alt="Administration Manager"> -->
          </div>
          <div class="member-role">Administration Manager</div>
          <div class="member-name">Name Here</div>
          <div class="member-contact">
            <div class="contact-item">
              <span class="contact-icon">📞</span>
              <a href="tel:+60123456790">+60 12-345 6790</a>
            </div>
            <div class="contact-item">
              <span class="contact-icon">✉️</span>
              <a href="mailto:admin@chefify.com">admin@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Marketing Manager -->
        <div class="team-member">
          <div class="member-image">
            <!-- Replace with: <img src="img/marketing-photo.jpg" alt="Marketing Manager"> -->
          </div>
          <div class="member-role">Marketing Manager</div>
          <div class="member-name">Name Here</div>
          <div class="member-contact">
            <div class="contact-item">
              <span class="contact-icon">📞</span>
              <a href="tel:+60123456791">+60 12-345 6791</a>
            </div>
            <div class="contact-item">
              <span class="contact-icon">✉️</span>
              <a href="mailto:marketing@chefify.com">marketing@chefify.com</a>
            </div>
          </div>
        </div>

        <!-- Operational Manager -->
        <div class="team-member">
          <div class="member-image">
            <!-- Replace with: <img src="img/operations-photo.jpg" alt="Operational Manager"> -->
          </div>
          <div class="member-role">Operational Manager</div>
          <div class="member-name">Name Here</div>
          <div class="member-contact">
            <div class="contact-item">
              <span class="contact-icon">📞</span>
              <a href="tel:+60123456792">+60 12-345 6792</a>
            </div>
            <div class="contact-item">
              <span class="contact-icon">✉️</span>
              <a href="mailto:operations@chefify.com">operations@chefify.com</a>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

</body>
</html>