<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Locations - Chefify</title>
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
    }

    /* ================= NAV ================= */
    nav {
      position: sticky;
      top: 0;
      z-index: 999;
      background: transparent;
      padding: 1.25rem 0;
      backdrop-filter: blur(4px);
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
    }

    .logo-img {
      height: 60px;
      width: auto;
      border-radius: 50%;
      border: 2px solid #ffdde0;
      box-shadow: 0 4px 12px rgba(100, 40, 20, 0.35);
    }

    .logo-text {
      font-size: 1.6rem;
      font-weight: 800;
      color: var(--chef-brown);
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
      transition: all .22s ease;
    }

    .nav-links a:hover {
      color: white;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      box-shadow: 0 6px 18px rgba(255, 150, 130, 0.18);
      transform: translateY(-3px);
    }

    .nav-links a.active {
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
    }

    /* ================= LOCATIONS PAGE ================= */
    .locations-hero {
      text-align: center;
      padding: 4rem 1rem 3rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .locations-hero h1 {
      font-size: 3.5rem;
      color: var(--chef-brown);
      margin-bottom: 1rem;
      font-weight: 800;
    }

    .locations-hero p {
      font-size: 1.2rem;
      color: #8b4c3a;
      max-width: 600px;
      margin: 0 auto;
    }

    .locations-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem 4rem;
    }

    .location-card {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      margin-bottom: 3rem;
      box-shadow: 0 10px 40px rgba(100, 40, 20, 0.12);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .location-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 50px rgba(100, 40, 20, 0.18);
    }

    .location-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
    }

    .location-image {
      background: linear-gradient(135deg, var(--light-peach), var(--peach-2));
      min-height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    .location-image::before {
      content: '📸';
      font-size: 4rem;
      opacity: 0.3;
    }

    .location-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
    }

    .location-details {
      padding: 2.5rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .location-header {
      margin-bottom: 1.5rem;
    }

    .location-header h2 {
      font-size: 2rem;
      color: var(--chef-brown);
      margin-bottom: 0.5rem;
      font-weight: 700;
    }

    .location-tag {
      display: inline-block;
      background: linear-gradient(45deg, var(--peach-1), var(--peach-2));
      color: white;
      padding: 0.4rem 1rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
    }

    .location-info {
      margin: 1.5rem 0;
    }

    .info-item {
      display: flex;
      align-items: flex-start;
      gap: 0.8rem;
      margin-bottom: 1rem;
      color: #64281a;
    }

    .info-icon {
      font-size: 1.3rem;
      margin-top: 0.1rem;
    }

    .info-text {
      flex: 1;
      line-height: 1.6;
    }

    .info-text strong {
      display: block;
      margin-bottom: 0.2rem;
      color: var(--chef-brown);
    }

    .location-map {
      width: 100%;
      height: 300px;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .location-map iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    /* Responsive Design */
    @media (max-width: 968px) {
      .location-content {
        grid-template-columns: 1fr;
      }

      .location-image {
        min-height: 300px;
      }

      .locations-hero h1 {
        font-size: 2.5rem;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
      }
    }

    @media (max-width: 600px) {
      .locations-hero h1 {
        font-size: 2rem;
      }

      .location-header h2 {
        font-size: 1.6rem;
      }

      .location-details {
        padding: 1.5rem;
      }
    }
  </style>
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
      <a href="menu.php">Menu</a>
      <a href="cart.php">Cart</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="locations.php" class="active">Locations</a>
      <a href="aboutus.php">About Us</a>
      <a href="contactus.php">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <!-- HERO SECTION -->
  <div class="locations-hero">
    <h1>Our Locations</h1>
    <p>Visit any of our branches across Malaysia and experience the best of Chefify</p>
  </div>

  <!-- LOCATIONS CONTAINER -->
  <div class="locations-container">
    
    <!-- PASAR SENI, KL -->
    <div class="location-card">
      <div class="location-content">
        <div class="location-image">
          <img src="img/chefifykl.png" alt="Pasar Seni Branch">
        </div>
        <div class="location-details">
          <div>
            <div class="location-header">
              <h2>Pasar Seni, Kuala Lumpur</h2>
              <span class="location-tag">Flagship Store</span>
            </div>
            
            <div class="location-info">
              <div class="info-item">
                <span class="info-icon">📍</span>
                <div class="info-text">
                  <strong>Address</strong>
                  Jalan Hang Kasturi, 50050 Kuala Lumpur, Wilayah Persekutuan
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">📞</span>
                <div class="info-text">
                  <strong>Phone</strong>
                  +603-2026 8888
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">🕐</span>
                <div class="info-text">
                  <strong>Opening Hours</strong>
                  Mon-Sun: 10:00 AM - 10:00 PM
                </div>
              </div>
            </div>
          </div>
          
          <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.8661867894654!2d101.69373267585803!3d3.1459598968436594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc49c66c7e5a3b%3A0x933b0d2a9e6ef0c8!2sPasar%20Seni%20Station!5e0!3m2!1sen!2smy!4v1735631234567!5m2!1sen!2smy" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- GELUGOR, PENANG -->
    <div class="location-card">
      <div class="location-content">
        <div class="location-image">
          <img src="img/chefifypenang.png" alt="Gelugor Branch">
        </div>
        <div class="location-details">
          <div>
            <div class="location-header">
              <h2>Gelugor, Penang</h2>
              <span class="location-tag">Northern Branch</span>
            </div>
            
            <div class="location-info">
              <div class="info-item">
                <span class="info-icon">📍</span>
                <div class="info-text">
                  <strong>Address</strong>
                  Jalan Gelugor, 11700 Gelugor, Pulau Pinang
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">📞</span>
                <div class="info-text">
                  <strong>Phone</strong>
                  +604-657 7777
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">🕐</span>
                <div class="info-text">
                  <strong>Opening Hours</strong>
                  Mon-Sun: 9:00 AM - 9:00 PM
                </div>
              </div>
            </div>
          </div>
          
          <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15888.746234567891!2d100.29471!3d5.34895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304ac048a161f277%3A0x881c5255ce3fed33!2sGelugor%2C%20Penang!5e0!3m2!1sen!2smy!4v1735631345678!5m2!1sen!2smy" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- KOTA BHARU, KELANTAN -->
    <div class="location-card">
      <div class="location-content">
        <div class="location-image">
          <img src="img/chefifykelantan.png" alt="Kota Bharu Branch">
        </div>
        <div class="location-details">
          <div>
            <div class="location-header">
              <h2>Kota Bharu, Kelantan</h2>
              <span class="location-tag">East Coast Branch</span>
            </div>
            
            <div class="location-info">
              <div class="info-item">
                <span class="info-icon">📍</span>
                <div class="info-text">
                  <strong>Address</strong>
                  Jalan Sultanah Zainab, 15050 Kota Bharu, Kelantan
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">📞</span>
                <div class="info-text">
                  <strong>Phone</strong>
                  +609-747 6666
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">🕐</span>
                <div class="info-text">
                  <strong>Opening Hours</strong>
                  Mon-Sun: 9:00 AM - 9:30 PM
                </div>
              </div>
            </div>
          </div>
          
          <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31716.891234567891!2d102.238!3d6.1248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31b6715e9c3e1ef5%3A0x3039d80b220e0c0!2sKota%20Bharu%2C%20Kelantan!5e0!3m2!1sen!2smy!4v1735631456789!5m2!1sen!2smy" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- SABAH -->
    <div class="location-card">
      <div class="location-content">
        <div class="location-image">
          <img src="img/chefifysabah.png" alt="Sabah Branch">
        </div>
        <div class="location-details">
          <div>
            <div class="location-header">
              <h2>Kota Kinabalu, Sabah</h2>
              <span class="location-tag">East Malaysia Branch</span>
            </div>
            
            <div class="location-info">
              <div class="info-item">
                <span class="info-icon">📍</span>
                <div class="info-text">
                  <strong>Address</strong>
                  Jalan Gaya, 88000 Kota Kinabalu, Sabah
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">📞</span>
                <div class="info-text">
                  <strong>Phone</strong>
                  +6088-232 5555
                </div>
              </div>
              
              <div class="info-item">
                <span class="info-icon">🕐</span>
                <div class="info-text">
                  <strong>Opening Hours</strong>
                  Mon-Sun: 9:30 AM - 9:30 PM
                </div>
              </div>
            </div>
          </div>
          
          <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63703.891234567891!2d116.074!3d5.9804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x323b69852b31d983%3A0x3039d80b220e7c0!2sKota%20Kinabalu%2C%20Sabah!5e0!3m2!1sen!2smy!4v1735631567890!5m2!1sen!2smy" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>
</html>