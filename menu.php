<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <link rel="stylesheet" href="menu.css">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<?php
require_once 'db.php';

// Fetch menu items from database
try {
    $stmt = $pdo->query("SELECT * FROM menu_items WHERE is_available = 1");
    $menuItems = $stmt->fetchAll();
    
    // Map database fields to frontend structure if needed, or just use as is
    // Frontend expects: name, cat, price, img, desc
    $menuData = [];
    foreach ($menuItems as $item) {
        $menuData[] = [
            'id' => $item['item_id'],
            'name' => $item['name'],
            'cat' => $item['category'], // Database uses 'category', frontend uses 'cat'
            'price' => (float)$item['price'],
            'img' => $item['image_path'],
            'desc' => $item['description'],
            'promo' => $item['promo_price'] ? (float)$item['promo_price'] : null,
            'promo_date' => $item['promo_end_date']
        ];
    }
} catch (PDOException $e) {
    echo "<!-- Error fetching menu: " . $e->getMessage() . " -->";
    $menuData = [];
}
?>

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

<header class="menu-header">
  <h1>Our Menu</h1>
  <p>Western classics, local favourites & sweet delights</p>
</header>

<div class="filters">
  <button class="filter-btn active" data-cat="all">All Items</button>
  <button class="filter-btn" data-cat="western">Western</button>
  <button class="filter-btn" data-cat="local">Local Dishes</button>
  <button class="filter-btn" data-cat="dessert">Desserts</button>
  <button class="filter-btn" data-cat="drinks">Drinks</button>
  <button class="filter-btn" data-cat="snacks">Snacks</button>
</div>

<main class="menu-container" id="menuGrid"></main>

<!-- CART -->
<aside class="cart-panel">
  <h3>🛒 Cart</h3>
  <div id="cartItems"></div>
  <div class="cart-total">
    <span>Total</span>
    <span id="cartTotal">RM 0.00</span>
  </div>
  <button class="checkout-btn" onclick="openCheckout()">Checkout</button>
</aside>

<!-- CHECKOUT MODAL -->
<div class="modal" id="checkoutModal">
  <div class="modal-content">
    <h3>Order Receipt</h3>
    <div id="receipt"></div>
    <div class="cart-total">
      <strong>Total</strong>
      <strong id="receiptTotal"></strong>
    </div>
    <button class="close-btn" onclick="closeCheckout()">Confirm Order</button>
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
            <a href="tel:+60123456789">+603-2688 8888</a>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
/* ===================== MENU DATA ===================== */
// Inject PHP data into JavaScript
const menuData = <?php echo json_encode($menuData); ?>;
const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

/* ===================== DOM ===================== */
const grid = document.getElementById("menuGrid");
const cartItems = document.getElementById("cartItems");
const cartTotal = document.getElementById("cartTotal");

// Initialize cart from localStorage so addToCart and renderCart work
let cart = JSON.parse(localStorage.getItem('chefifyCart')) || [];

/* ===================== RENDER MENU ===================== */
function renderMenu(){
  grid.innerHTML = menuData.map((i,index)=>`
    <div class="menu-item" data-cat="${i.cat}">
      <img src="${i.img}" class="item-img" onerror="this.src='https://via.placeholder.com/200?text=Food'">
      <div class="item-info">
        <span class="item-cat">${i.cat}</span>
        <h3 class="item-name">${i.name}</h3>
        <p class="item-desc">${i.desc}</p>
        <div class="item-footer">
          <div class="price-box">
             ${i.promo ? 
                `<span class="item-price promo">RM ${i.promo.toFixed(2)}</span>
                 <span class="item-price original">RM ${i.price.toFixed(2)}</span>` 
                : 
                `<span class="item-price">RM ${i.price.toFixed(2)}</span>`
             }
          </div>
          <button class="add-btn" onclick="addToCart(${index})">+</button>
        </div>
      </div>
    </div>
  `).join("");
}

document.querySelectorAll(".filter-btn").forEach(btn=>{
  btn.addEventListener("click", ()=>{

    // active button UI
    document.querySelectorAll(".filter-btn")
      .forEach(b=>b.classList.remove("active"));
    btn.classList.add("active");

    const category = btn.dataset.cat;

    document.querySelectorAll(".menu-item").forEach(item=>{
      if(category === "all" || item.dataset.cat === category){
        item.style.display = "flex";
      } else {
        item.style.display = "none";
      }
    });

  });
});


/* ===================== CART FUNCTIONS ===================== */
function renderCart(){
  let total = 0;

  cartItems.innerHTML = cart.map(i=>{
    // Use promo price if available
    const info = menuData.find(m => m.name === i.name) || i;
    const price = info.promo || info.price;
    
    total += price * i.qty;
    return `
      <div class="cart-item">
        <span>${i.name} (${i.qty})</span>
        <div class="cart-controls">
          <button onclick="updateQty('${i.name}',-1)">−</button>
          <button onclick="updateQty('${i.name}',1)">+</button>
        </div>
      </div>
    `;
  }).join("");

  cartTotal.innerText = "RM " + total.toFixed(2);
  localStorage.setItem("chefifyCart", JSON.stringify(cart));
}

function addToCart(index){
  const item = menuData[index];
  const found = cart.find(c => c.name === item.name);
  // Store basic info for cart
  const priceToUse = item.promo || item.price;

  if(found){
    found.qty++;
  }else{
    cart.push({...item, price: priceToUse, qty:1});
  }
  renderCart();
  
  // Optional: Visual feedback
  const btn = document.querySelectorAll('.add-btn')[index];
  const originalText = btn.innerText;
  btn.innerText = "✓";
  setTimeout(() => btn.innerText = originalText, 1000);
}

function updateQty(name, change){
  const item = cart.find(c => c.name === name);
  if(!item) return;

  item.qty += change;
  if(item.qty <= 0){
    cart = cart.filter(c => c.name !== name);
  }
  renderCart();
}

function openCheckout(){
  if(cart.length === 0){
    alert("Your cart is empty");
    return;
  }
  window.location.href = "cart.php";
}

/* ===================== INIT ===================== */
renderMenu();
renderCart();
</script>


</body>
</html>

