<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cart - Chefify</title>

<link rel="icon" href="img/chefify.jpg" type="image/png">
<script src="https://unpkg.com/lucide@latest"></script>

<style>
:root{
  --chef-brown:#4b2e19;
  --peach-1:#ffd6c8;
  --peach-2:#ffb7a1;
  --btn-peach:#ff9e85;
  --card-cream:rgba(255,230,225,0.95);
}

*{box-sizing:border-box;margin:0;padding:0}

body{
  font-family:Arial, Helvetica, sans-serif;
  color:var(--chef-brown);
  background:url('img/wallpaper4.jpg') no-repeat center center fixed;
  background-size:cover;
  min-height:100vh;
}

body::before{
  content:"";
  position:fixed;
  inset:0;
  background:rgba(255,170,150,0.45);
  z-index:0;
  pointer-events:none; 
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

@media(max-width:600px){
  .nav-links{display:none}
}

/* ===== CART PAGE ===== */
.cart-page{
  max-width:900px;
  margin:4rem auto;
  background:var(--card-cream);
  padding:2rem;
  border-radius:25px;
  position:relative;
  z-index:1;
  box-shadow:0 10px 30px rgba(100,40,20,.25);
}

.cart-page h1{
  text-align:center;
  margin-bottom:2rem;
}

.cart-item{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:1rem 0;
  border-bottom:1px solid #f1cfc4;
}

.cart-controls{
  display:flex;
  gap:8px;
  align-items:center;
}

.cart-controls button{
  width:28px;
  height:28px;
  border:none;
  border-radius:50%;
  background:var(--btn-peach);
  color:white;
  font-weight:700;
  cursor:pointer;
}

.cart-summary{
  margin-top:2rem;
  display:flex;
  justify-content:space-between;
  font-size:1.3rem;
  font-weight:800;
}

.payment-section{
  margin-top:2rem;
}

.payment-section h3{
  margin-bottom:1rem;
}

.pay-option{
  display:block;
  margin-bottom:.6rem;
  font-weight:600;
}

.pay-option input{
  margin-right:8px;
}

.checkout-btn{
  width:100%;
  margin-top:1.5rem;
  padding:14px;
  border:none;
  border-radius:14px;
  background:var(--chef-brown);
  color:white;
  font-size:1.1rem;
  font-weight:700;
  cursor:pointer;
}

.empty{
  text-align:center;
  font-size:1.1rem;
  opacity:.7;
  padding:2rem 0;
}

/* ===== RECEIPT MODAL ===== */
.modal{
  position:fixed;
  inset:0;
  display:none;
  justify-content:center;
  align-items:center;
  background:rgba(0,0,0,0.5);
  z-index:500;
}

.modal-content{
  background:white;
  padding:25px;
  border-radius:20px;
  width:400px;
}

.modal-content h3{
  text-align:center;
  margin-bottom:15px;
}

.close-btn{
  width:100%;
  margin-top:15px;
  padding:10px;
  border:none;
  border-radius:12px;
  background:var(--btn-peach);
  color:white;
  cursor:pointer;
}

 @media(max-width:600px){
      .nav-links{display:none}
      .menu-header h1{font-size:2.2rem}
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

<nav>
  <div class="nav-container">
    <a href="homepage.php" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>
      <div class="nav-links" role="menu" aria-label="Main links">
        <a href="homepage.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="cart.php" class="active">Cart</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="locations.php" >Locations</a>
        <a href="aboutus.php" >About Us</a>
        <a href="contactus.php" >Contact Us</a>
        <a href="feedback.php" >Feedback</a>
        <a href="login.php">Logout</a>
      </div>
  </div>
</nav>

<!-- CART CONTENT -->
<section class="cart-page">
  <h1>Your Cart</h1>

  <div id="cartItems"></div>

  <div class="cart-summary">
    <span>Total</span>
    <span id="cartTotal">RM 0.00</span>
  </div>

  <div class="payment-section">
    <h3>Payment Method</h3>
    <label class="pay-option">
      <input type="radio" name="payment" value="Cash"> Cash
    </label>
    <label class="pay-option">
      <input type="radio" name="payment" value="Card"> Credit / Debit Card
    </label>
    <label class="pay-option">
      <input type="radio" name="payment" value="E-Wallet"> E-Wallet
    </label>
  </div>

  <button class="checkout-btn" onclick="placeOrder()">Place Order</button>
</section>

<!-- MODAL RECEIPT -->
<div class="modal" id="receiptModal">
  <div class="modal-content">
    <h3>Order Receipt</h3>
    <pre id="receiptText"></pre>
    <button class="close-btn" onclick="closeModal()">Close</button>
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
            <img src="img/tiktoklogo.png" alt="TikTok" onerror="this.innerHTML='<span style=color:#fff>TT</span>'">
          </a>
          <a href="https://www.instagram.com/chefifyapp?igsh=Z3RhMW43dndoN281&utm_source=qr" target="_blank" rel="noopener" class="social-icon" title="Follow us on Instagram">
            <img src="img/iglogo.png" alt="Instagram" onerror="this.innerHTML='<span style=color:#fff>IG</span>'">
          </a>
          <a href="https://facebook.com/chefify" target="_blank" rel="noopener" class="social-icon" title="Like us on Facebook">
            <span style="font-size:1.5rem;">📘</span>
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
const cartItemsDiv = document.getElementById("cartItems");
const cartTotal = document.getElementById("cartTotal");
const receiptModal = document.getElementById("receiptModal");
const receiptText = document.getElementById("receiptText");

let cart = JSON.parse(localStorage.getItem("chefifyCart")) || [];

function renderCart(){
  if(cart.length === 0){
    cartItemsDiv.innerHTML = `<div class="empty">Your cart is empty. <a href="menu.html">Go to Menu</a></div>`;
    cartTotal.innerText = "RM 0.00";
    return;
  }

  let total = 0;

  cartItemsDiv.innerHTML = cart.map(item=>{
    total += item.price * item.qty;
    return `
      <div class="cart-item">
        <strong>${item.name}</strong>
        <div class="cart-controls">
          <button onclick="updateQty('${item.name}',-1)">−</button>
          <span>${item.qty}</span>
          <button onclick="updateQty('${item.name}',1)">+</button>
        </div>
      </div>
    `;
  }).join("");

  cartTotal.innerText = "RM " + total.toFixed(2);
  localStorage.setItem("chefifyCart", JSON.stringify(cart));
}

function updateQty(name, change){
  const item = cart.find(c=>c.name===name);
  if(!item) return;

  item.qty += change;
  if(item.qty <= 0){
    cart = cart.filter(c=>c.name!==name);
  }
  renderCart();
}

function placeOrder(){
  if(cart.length === 0){
    alert("Your cart is empty!");
    return;
  }

  const payment = document.querySelector('input[name="payment"]:checked');
  if(!payment){
    alert("Please select a payment method!");
    return;
  }

  let total = 0;
  let receipt = "🧾 Order Receipt\n\n";

  cart.forEach(item=>{
    receipt += `${item.name} x${item.qty} — RM ${(item.price*item.qty).toFixed(2)}\n`;
    total += item.price * item.qty;
  });

  receipt += `\nTotal: RM ${total.toFixed(2)}\n`;
  receipt += `Payment: ${payment.value}\n\n`;
  receipt += "Thank you for ordering with Chefify ❤️";

  receiptText.innerText = receipt;
  receiptModal.style.display = "flex";

  // Clear cart
  localStorage.removeItem("chefifyCart");
  cart = [];
  renderCart();
}

function closeModal(){
  receiptModal.style.display = "none";
}

renderCart();
</script>
</body>
</html>
