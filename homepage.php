<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Chefify</title>
<link rel="icon" href="img/chefify.jpg" type="image/png" />
<link rel="stylesheet" href="homepage.css"> 
</head>

<body>

<!-- NAV -->
<nav>
  <div class="nav-container">
    <a class="logo" href="home.html">
      <img src="img/chefify.jpg" class="logo-img">
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
      <a href="index.html">Logout</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-overlay">
    <div class="hero-content">

      <a href="menu.php" class="hero-btn">Order Now</a>
    </div>
  </div>
</section>



<!-- CENTER CAROUSEL -->
<div class="center-carousel">
  <img src="img/.jpg" class="active" alt="zula punya poster">
  <img src="img/.jpg">
  <img src="img/.jpg">
</div>

<!-- OUR SIGNATURE -->
<section class="section">
  <div class="container">
    <h2>Our Signature</h2>

    <div class="signature-grid">
      <div class="card">
        <img src="img/redvelvet.jpg">
        <div class="overlay">
          <div class="overlay-content">
            <h3>Signature Dish</h3>
            <p>Our most loved creation, crafted with premium ingredients.</p>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="img/cremebrulee.jpg">
        <div class="overlay">
          <div class="overlay-content">
            <h3>House Special</h3>
            <p>A classic favorite prepared fresh with Chefify’s special touch.</p>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="img/matchatiramisu.jpg">
        <div class="overlay">
          <div class="overlay-content">
            <h3>Chef's Pick</h3>
            <p>Handpicked by our chef for its exceptional flavor.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>



<!-- BEST SELLER (ORGANIZED) -->
<section class="section">
  <div class="container white-box">
    <h2>Best Seller</h2>
    <div class="grid-3">
      <div class="product">
        <img src="img/nasilemak.jpg">
        <h3>Nasi Lemak</h3>
        <p>Fragrant coconut rice with crispy chicken, sambal and egg.</p>
      </div>
      <div class="product">
        <img src="img/laksa.jpg">
        <h3>Laksa</h3>
        <p>Creamy coconut noodle soup with fish cake.</p>
      </div>
      <div class="product">
        <img src="img/pasta.jpg">
        <h3>Spaghetti Carbonara</h3>
        <p>Creamy carbonara with beef bacon and parmesan cheese.</p>
      </div>
    </div>
  </div>
</section>

<!-- CUSTOMER FEEDBACK -->
<section class="section">
  <div class="container white-box feedback-box">

    <h2>What Our Customers Say</h2>

    <div class="feedback-carousel">
      <button class="fb-arrow left" onclick="prevFeedback()">&#10094;</button>

      <div class="feedback-item active">
        <div class="stars">★★★★★</div>
        <p>"The Nasi Lemak is absolutely amazing! Best I've had in years."</p>
        <span>- Aisyah R.</span>
      </div>

      <div class="feedback-item">
        <div class="stars">★★★★★</div>
        <p>"Fast delivery and the food arrived hot and delicious."</p>
        <span>- Daniel K.</span>
      </div>

      <div class="feedback-item">
        <div class="stars">★★★★☆</div>
        <p>"Love the Carbonara! Creamy and very filling."</p>
        <span>- Nur Izzati</span>
      </div>

      <button class="fb-arrow right" onclick="nextFeedback()">&#10095;</button>
    </div>

  </div>
</section>

<!-- Teasers -->
  <section class="teasers" aria-label="Highlights">
    <div class="teasers-grid">
      <article class="teaser-card">
        <img src="img/dashboard.jpg" alt="Chefify Dashboard">
        <div class="teaser-content">
          <h3>Our Dashboard</h3>
          <p>Peek into our gamification to earn your rewards!.</p>
          <a href="dashboard.php">View Dashboard →</a>
        </div>
      </article>

      <article class="teaser-card">
        <img src="img/contact.jpg" alt="Contact us">
        <div class="teaser-content">
          <h3>Get in Touch</h3>
          <p>Questions, catering requests, or feedback — we'd love to hear from you.</p>
          <a href="contactus.php">Contact Us →</a>
        </div>
      </article>
    </div>
  </section>

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
/* center carousel */
const imgs=document.querySelectorAll('.center-carousel img');
let c=0;
setInterval(()=>{
  imgs[c].classList.remove('active');
  c=(c+1)%imgs.length;
  imgs[c].classList.add('active');
},4000);


/* feedback carousel */
const feedbacks = document.querySelectorAll('.feedback-item');
let fIndex = 0;

function showFeedback(index){
  feedbacks.forEach(f => f.classList.remove('active'));
  feedbacks[index].classList.add('active');
}

function nextFeedback(){
  fIndex = (fIndex + 1) % feedbacks.length;
  showFeedback(fIndex);
}

function prevFeedback(){
  fIndex = (fIndex - 1 + feedbacks.length) % feedbacks.length;
  showFeedback(fIndex);
}

/* auto slide (optional) */
setInterval(nextFeedback, 5000);


</script>

</body>
</html>
