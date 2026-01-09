<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cart - Chefify</title>

<link rel="icon" href="img/chefify.jpg" type="image/png">
<script src="https://unpkg.com/lucide@latest"></script>
<link rel="stylesheet" href="cart.css">
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

// Play confirmation sound
const sound = document.getElementById("orderSound");
sound.currentTime = 0;
sound.play();

// Show receipt
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

<audio id="orderSound" src="img/Ding - Sound Effect (HD).mp3" preload="auto"></audio>

</body>
</html>

