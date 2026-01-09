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
/* ===================== MENU DATA ===================== */
const menuData = [
  { name:"Grilled Chicken Chop", cat:"western", price:18.90, img:"img/grilledchicken.jpg", desc:"Juicy grilled chicken thigh with black pepper sauce and fries." },
  { name:"Fish & Chips", cat:"western", price:21.00, img:"img/fishandchips.jpg", desc:"Crispy battered dory fillet served with tartar sauce." },
  { name:"Spaghetti Carbonara", cat:"western", price:19.50, img:"img/pasta.jpg", desc:"Creamy carbonara with beef bacon and parmesan cheese." },
  { name:"Spaghetti Bolognese", cat:"western", price:18.50, img:"img/bolognese.jpg", desc:"Slow-cooked beef sauce with herbs and tomato." },
  { name:"Seafood Aglio Olio", cat:"western", price:24.00, img:"img/seafood.jpg", desc:"Spaghetti tossed with shrimp, mussels and garlic oil." },
  { name:"Chicken Lasagna", cat:"western", price:20.00, img:"img/lasagna.jpg", desc:"Layered pasta with creamy cheese and minced chicken." },
  { name:"Beef Burger", cat:"western", price:22.50, img:"img/beefburger.jpg", desc:"Juicy beef patty with cheese, caramelised onions and brioche bun." },
  { name:"Avocado Toast", cat:"western", price:19.50, img:"img/avocadotoast.jpg", desc:"Sourdough bread with smashed avocado and poached egg." },

  { name:"Nasi Lemak Ayam Crispy", cat:"local", price:15.90, img:"img/nasilemak.jpg", desc:"Fragrant coconut rice with crispy chicken, sambal and egg." },
  { name:"Nasi Goreng Kampung", cat:"local", price:13.90, img:"img/nasigoreng.jpg", desc:"Traditional fried rice with anchovies and vegetables." },
  { name:"Mee Goreng Mamak", cat:"local", price:13.50, img:"img/meegoreng.jpg", desc:"Spicy stir-fried noodles with egg and tofu." },
  { name:"Chicken Rendang Rice", cat:"local", price:17.90, img:"img/rendang.jpg", desc:"Slow-cooked chicken in rich coconut gravy." },
  { name:"Laksa Lemak", cat:"local", price:16.50, img:"img/laksa.jpg", desc:"Creamy coconut noodle soup with fish cake." },

  { name:"Chocolate Lava Cake", cat:"dessert", price:12.50, img:"img/lava.jpg", desc:"Warm chocolate cake with molten centre." },
  { name:"Classic Cheesecake", cat:"dessert", price:13.50, img:"img/classiccheesecake.jpg", desc:"Creamy baked cheesecake with biscuit base." },
  { name:"Classic Tiramisu", cat:"dessert", price:14.00, img:"img/tiramisu.jpg", desc:"Coffee-soaked ladyfingers with mascarpone cream." },
  { name:"Matcha Tiramisu", cat:"dessert", price:14.50, img:"img/matchatiramisu.jpg", desc:"Japanese matcha twist on classic tiramisu." },
  { name:"Brownies with Ice Cream", cat:"dessert", price:11.90, img:"img/browniesice.jpg", desc:"Rich chocolate brownies served warm." },
  { name:"Red Velvet Cake", cat:"dessert", price:11.00, img:"img/redvelvet.jpg", desc:"Soft red velvet sponge with cream cheese frosting." },
  { name:"Crème Brûlée", cat:"dessert", price:13.00, img:"img/cremebrulee.jpg", desc:"Vanilla custard with caramelised sugar top." },

  { name:"Hot Latte", cat:"drinks", price:8.00, img:"img/latte.jpg", desc:"Smooth espresso with steamed milk." },
  { name:"Cappuccino", cat:"drinks", price:8.50, img:"img/cappuccino.jpg", desc:"Espresso with milk foam." },
  { name:"Iced Latte", cat:"drinks", price:9.00, img:"img/icedlatte.jpg", desc:"Chilled espresso with fresh milk." },
  { name:"Matcha Latte", cat:"drinks", price:9.00, img:"img/matcha.jpg", desc:"Earthy matcha blended with creamy milk." },
  { name:"Iced Mocha", cat:"drinks", price:9.50, img:"img/mocha.jpg", desc:"Chocolate espresso drink served cold." },
  { name:"Lemon Iced Tea", cat:"drinks", price:6.50, img:"img/lemon.jpg", desc:"Refreshing lemon tea with mint." },
  { name:"Peach Tea", cat:"drinks", price:7.00, img:"img/peachtea.jpg", desc:"Sweet peach-infused iced tea." },
  { name:"Strawberry Frappe", cat:"drinks", price:8.50, img:"img/strawberryfrappe.jpg", desc:"Blended strawberry drink with ice." },

  { name:"French Fries", cat:"snacks", price:6.90, img:"img/frenchfries.jpg", desc:"Golden crispy fries." },
  { name:"Cheesy Fries", cat:"snacks", price:8.50, img:"img/cheesyfries.jpg", desc:"Fries topped with melted cheese sauce." },
  { name:"Chicken Nuggets", cat:"snacks", price:8.50, img:"img/nuggets.jpg", desc:"Crunchy bite-sized chicken nuggets." },
  { name:"Onion Rings", cat:"snacks", price:7.50, img:"img/onionrings.jpg", desc:"Crispy battered onion rings." },
  { name:"Nachos with Cheese", cat:"snacks", price:9.90, img:"img/nachos.jpg", desc:"Corn chips served with cheese and salsa." }
];

/* ===================== DOM ===================== */
const grid = document.getElementById("menuGrid");
const cartItems = document.getElementById("cartItems");
const cartTotal = document.getElementById("cartTotal");

/* ===================== CART ===================== */
let cart = JSON.parse(localStorage.getItem("chefifyCart")) || [];

/* ===================== RENDER MENU ===================== */
function renderMenu(){
  grid.innerHTML = menuData.map((i,index)=>`
    <div class="menu-item" data-cat="${i.cat}">
      <img src="${i.img}" class="item-img">
      <div class="item-info">
        <span class="item-cat">${i.cat}</span>
        <h3 class="item-name">${i.name}</h3>
        <p class="item-desc">${i.desc}</p>
        <div class="item-footer">
          <span class="item-price">RM ${i.price.toFixed(2)}</span>
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
    total += i.price * i.qty;
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

  if(found){
    found.qty++;
  }else{
    cart.push({...item, qty:1});
  }
  renderCart();
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
