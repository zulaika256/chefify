<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Chefify</title>
<link rel="icon" href="img/chefify.jpg" type="image/png" />
<style>
:root{
  --chef-brown:#4b2e19;
  --peach-1:#ffd6c8;
  --peach-2:#ffb7a1;
  --btn-peach:#ff9e85;
  --btn-peach-hover:#ff6f8a;
  --card-cream:rgba(255,230,225,0.85);
}

*{margin:0;padding:0;box-sizing:border-box}

body{
  font-family:Arial, Helvetica, sans-serif;
  background:url('img/wallpaper4.jpg') no-repeat center/cover fixed;
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

/* ================= HERO BANNER ================= */
.hero{
  height:85vh;
  background:url('img/homebanner.png') center/cover no-repeat;
  position:relative;
}

.hero-overlay{
  position:absolute;
  inset:0;
  background:linear-gradient(
    to right,
    rgba(255,255,255,0.55),
    rgba(255,255,255,0.15),
    rgba(255,255,255,0)
  );
  display:flex;
  align-items:center;
}

.hero-content{
  max-width:600px;
  margin-left:6%;
  color:white;
}

.hero-content h1{
  font-size:3.2rem;
  margin-bottom:1rem;
}

.hero-content p{
  font-size:1.2rem;
  margin-bottom:2rem;
}

.hero-btn{
  display:inline-block;
  background:var(--chef-brown);
  color:#fff;
  padding:1rem 2.6rem;
  font-size:1rem;
  font-weight:700;
  border-radius:30px;
  text-decoration:none;
  transition:.3s ease;
  box-shadow:0 10px 25px rgba(75,46,25,0.45);
  margin-top:10rem; 
}

.hero-btn:hover{
  background:#3a2213;
  transform:translateY(-2px);
}

/* ================= CENTER CAROUSEL ================= */
.center-carousel{
  max-width:1000px;
  margin:4rem auto;
  border-radius:26px;
  overflow:hidden;
  box-shadow:0 18px 40px rgba(100,40,20,.25);
}
.center-carousel img{
  width:100%;
  height:420px;
  object-fit:cover;
  display:none;
}
.center-carousel img.active{display:block}

/* ================= SECTIONS ================= */
.section{
  max-width:1200px;
  margin:4rem auto;
  padding:0 1rem;
}
.section h2{
  text-align:center;
  margin-bottom:2.5rem;
}

/* ================= OVERLAY CARD ================= */
.grid-3{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:2rem;
}
.card{
  position:relative;
  height:300px;
  border-radius:18px;
  overflow:hidden;
  cursor:pointer;
}
.card img{
  width:100%;
  height:100%;
  object-fit:cover;
}
.card .overlay{
  position:absolute;
  inset:0;
  background:rgba(0,0,0,0.6);
  color:white;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  opacity:0;
  transition:.35s;
  padding:1rem;
}

.signature-grid{
  max-width:1100px;
  margin:0 auto;
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:2rem;
}

.overlay-content h3{
  font-size:1.4rem;
  margin-bottom:.6rem;
  color:#ffd6c8;
}

.overlay-content p{
  font-size:.95rem;
  line-height:1.5;
  color:#fff;
  opacity:0.9;
}

.card:hover .overlay{opacity:1}

.white-box{
  background:white;
  border-radius:22px;
  padding:3.5rem;
  box-shadow:0 12px 30px rgba(0,0,0,0.1);
}

/* ================= BEST SELLER CARDS ================= */
.product{
  background:#fff;
  border-radius:18px;
  overflow:hidden;
  box-shadow:0 12px 28px rgba(75,46,25,0.18);
  transition:.3s ease;
}

.product:hover{
  transform:translateY(-6px);
  box-shadow:0 18px 40px rgba(75,46,25,0.28);
}

.product img{
  width:100%;
  height:220px;             
  object-fit:cover;
}

.product h3{
  margin:1rem 1.2rem .4rem;
  font-size:1.2rem;
}

.product p{
  margin:0 1.2rem 1.4rem;
  font-size:.95rem;
  color:#6b4a35;
}

/* ================= CUSTOMER FEEDBACK ================= */
.feedback-box{
  text-align:center;
}

.feedback-carousel{
  position:relative;
  max-width:700px;
  margin:0 auto;
}

.feedback-item{
  display:none;
  font-size:1.05rem;
  color:#5a3a26;
}

.feedback-item.active{
  display:block;
}

.feedback-item p{
  font-style:italic;
  margin:1.2rem 0;
}

.feedback-item span{
  font-weight:700;
}

.stars{
  color:#ff9e85;
  font-size:1.3rem;
  letter-spacing:2px;
}

.fb-arrow{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  background:none;
  border:none;
  font-size:2rem;
  cursor:pointer;
  color:var(--chef-brown);
}

.fb-arrow.left{ left:-40px; }
.fb-arrow.right{ right:-40px; }

.fb-arrow:hover{
  color:var(--btn-peach-hover);
}

/* Teasers */
.teasers{
  background: rgba(255,255,255,0.85); 
  padding:5.5rem 0; 
  z-index:1; 
  position:relative;
}

.teasers-grid{
  max-width:1200px;
  margin:0 auto;
  padding:0 1rem;
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:2.25rem;
}

.teaser-card{
  position:relative;
  height:360px;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 12px 30px rgba(0,0,0,0.08);
}

.teaser-card img{
  width:100%;
  height:100%;
  object-fit:cover;
  transition:transform .45s;
}

.teaser-card:hover img{
  transform:scale(1.04);
}

.teaser-content{
  position:absolute;
  bottom:0;
  left:0;
  right:0;
  padding:1.5rem;
  background:linear-gradient(transparent,rgba(0,0,0,0.6));
  color:white;
}

.teaser-content h3{
  font-size:1.6rem;
  margin-bottom:.5rem;
}

.teaser-content a{
  color:var(--btn-peach);
  font-weight:700;
  text-decoration:none;
}

.teaser-content a:hover{
  color:var(--btn-peach-hover);
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
  grid-template-columns:1fr 1fr 1fr;
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
  width:24px;
  height:24px;
  filter:brightness(0) invert(1);
  transition:filter .3s ease;
}

.social-icon:hover img{
  filter:none;
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
      <a href="homepage.php" class="active">Home</a>
      <a href="menu.php">Menu</a>
      <a href="cart.php">Cart</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About Us</a>
      <a href="contactus.php">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="login.php">Logout</a>
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
            <p>A classic favorite prepared fresh with Chefify's special touch.</p>
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

<!-- BEST SELLER -->
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
            <img src="img/tiktok.png" alt="TikTok" onerror="this.innerHTML='<span style=color:#fff>TT</span>'">
          </a>
          <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" rel="noopener" class="social-icon" title="Follow us on Instagram">
            <img src="img/instagram.webp" alt="Instagram" onerror="this.innerHTML='<span style=color:#fff>IG</span>'">
          </a>
        </div>
      </div>
      
      <!-- Quick Links -->
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul class="footer-links">
          <li><a href="homepage.php">Home</a></li>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="locations.php">Locations</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
        </ul>
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

/* auto slide */
setInterval(nextFeedback, 5000);
</script>

</body>
</html>