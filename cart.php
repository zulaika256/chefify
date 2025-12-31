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

footer{
  background:var(--chef-brown);
  color:#ffdccf;
  padding:2.5rem 0;
  position:relative;
  z-index:1;
}

.footer-container{
      max-width:1200px;
      margin:auto;
      padding:0 1rem;
      display:flex;
      justify-content:space-between;
      flex-wrap:wrap;
    }

 @media(max-width:600px){
      .nav-links{display:none}
      .menu-header h1{font-size:2.2rem}
    }
</style>
</head>

<body>

<!-- NAV -->
<nav>
  <div class="nav-container">
    <a href="home.html" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>

    <div class="nav-links">
      <a href="home.html">Home</a>
      <a href="menu.html">Menu</a>
      <a href="cart.html" class="active">Cart</a>
      <a href="dashboard.html">Dashboard</a>
      <a href="locations.html">Locations</a>
      <a href="aboutus.html">About</a>
      <a href="contactus.html">Contact Us</a>
      <a href="login.html">Logout</a>
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
