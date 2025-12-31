<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu - Chefify</title>
  <link rel="icon" href="img/chefify.jpg" type="image/png" />
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    :root{
      --chef-brown:#4b2e19;
      --peach-1:#ffd6c8;
      --peach-2:#ffb7a1;
      --btn-peach:#ff9e85;
      --btn-peach-hover:#ff6f8a;
      --card-cream:rgba(255,230,225,0.9);
      --card-border:#ffdccf;
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


    .menu-header{
      text-align:center;
      padding:4rem 1rem 2rem;
      position:relative;
      z-index:1;
    }

    .menu-header h1{
      font-size:3rem;
      margin-bottom:0.6rem;
    }

    .filters{
      display:flex;
      justify-content:center;
      flex-wrap:wrap;
      gap:1rem;
      margin-bottom:3rem;
      position:relative;
      z-index:1;
    }

    .filter-btn{
      padding:0.6rem 1.8rem;
      border-radius:25px;
      border:2px solid var(--peach-2);
      background:var(--card-cream);
      cursor:pointer;
      font-weight:700;
    }

    .filter-btn.active,
    .filter-btn:hover{
      background:var(--btn-peach);
      color:white;
    }

    .menu-container{
      max-width:1400px;
      margin:auto;
      padding:0 1.5rem 5rem;
      display:grid;
      grid-template-columns:repeat(auto-fill, minmax(320px,1fr));
      gap:2.5rem;
      position:relative;
      z-index:1;
    }

    .menu-item{
      background:var(--card-cream);
      border-radius:20px;
      overflow:hidden;
      box-shadow:0 10px 25px rgba(100,40,20,0.15);
      display:flex;
      flex-direction:column;
    }

    .item-img{
      width:100%;
      height:280px;
      object-fit:cover;
    }

    .item-info{
      padding:1.6rem;
      display:flex;
      flex-direction:column;
      flex-grow:1;
    }

    .item-cat{
      font-size:0.8rem;
      text-transform:uppercase;
      font-weight:700;
      color:var(--btn-peach-hover);
      margin-bottom:0.5rem;
    }

    .item-name{
      font-size:1.5rem;
      font-weight:800;
      margin-bottom:0.6rem;
    }

    .item-desc{
      font-size:0.95rem;
      margin-bottom:1.4rem;
      line-height:1.5;
      color:#5a3f2f;
    }

    .item-footer{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-top:auto;
    }

    .item-price{
      font-size:1.4rem;
      font-weight:800;
    }

    .add-btn{
      width:46px;
      height:46px;
      border-radius:50%;
      background:var(--chef-brown);
      color:white;
      border:none;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
    }

          /* CART PANEL */
      .cart-panel{
        position:fixed;
        top:120px;
        right:30px;
        width:320px;
        background:var(--card-cream);
        border-radius:18px;
        padding:20px;
        box-shadow:0 10px 30px rgba(100,40,20,0.25);
        z-index:5;
      }
      .cart-item{display:flex;justify-content:space-between;align-items:center;margin-bottom:10px}
      .cart-controls button{width:26px;height:26px;border:none;border-radius:50%;background:var(--btn-peach);color:white;cursor:pointer}
      .cart-total{display:flex;justify-content:space-between;font-weight:800;margin-top:10px}
      .checkout-btn{width:100%;margin-top:12px;padding:10px;border:none;border-radius:12px;background:var(--chef-brown);color:white;font-weight:700}

      /* ===== MODAL ===== */
.modal{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.4);
  display:none;
  justify-content:center;
  align-items:center;
  z-index:300;
}
.modal-content{
  background:white;
  padding:25px;
  border-radius:20px;
  width:380px;
}
.modal h3{text-align:center;margin-bottom:15px}
.payment-option{
  margin:10px 0;
}
.confirm-btn{
  width:100%;
  margin-top:15px;
  padding:10px;
  border:none;
  border-radius:12px;
  background:var(--btn-peach);
  color:white;
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

<nav>
  <div class="nav-container">
    <a href="home.html" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>
      <div class="nav-links" role="menu" aria-label="Main links">
        <a href="home.html">Home</a>
        <a href="menu.html" class="active">Menu</a>
        <a href="cart.html">Cart</a>
        <a href="dashboard.html">Dashboard</a>
        <a href="locations.html" >Locations</a>
        <a href="aboutus.html" >About</a>
        <a href="contactus.html" >Contact Us</a>
        <a href="login.html">Logout</a>
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
  window.location.href = "cart.html";
}

/* ===================== INIT ===================== */
renderMenu();
renderCart();
</script>


</body>
</html>
