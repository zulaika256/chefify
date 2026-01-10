<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Management | Chefify Admin</title>
<link rel="icon" href="img/chefify.jpg" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/admin_menu.css">

<nav>
    <div class="nav-container">
        <a href="homepage.php" class="logo">
            <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
            <span class="logo-text">Chefify</span>
        </a>
        <div class="nav-links">
            <div class="nav-dropdown">
                <a class="active">Dashboard ▾</a>
                <div class="dropdown-menu">
                    <a href="admin_order.php">Manage Orders</a>
                    <a href="admin_menu.php">Menu Inventory</a>
                    <a href="admin_customers.php">Customers</a>
                </div>
            </div>
            <a href="admin_feedback.php">Feedback</a>
            <a href="profile.php">Profile</a>
            <a href="login.php">Logout</a>
        </div>
    </div>
</nav>

<div class="header">
  <h2><i class="fa-solid fa-truck-fast"></i> Menu Inventory</h2>
  <div class="header-right">
    <a href="admin_dashboard.php" class="back-btn">← Back to Dashboard</a>
    <button class="add-btn-main" onclick="showModal('addModal')">+ Add New Item</button>
  </div>
</div>

<div id="toast">Successful!</div>

<div class="filters">
  <button class="filter-btn active" onclick="filterCat('all', this)">All Items</button>
  <button class="filter-btn" onclick="filterCat('western', this)">Western</button>
  <button class="filter-btn" onclick="filterCat('local', this)">Local Dishes</button>
  <button class="filter-btn" onclick="filterCat('dessert', this)">Desserts</button>
  <button class="filter-btn" onclick="filterCat('drinks', this)">Drinks</button>
  <button class="filter-btn" onclick="filterCat('snacks', this)">Snacks</button>
</div>

<div class="container" id="menuGrid"></div>

<div class="modal-overlay" id="addModal">
  <div class="modal-box">
    <h3 style="margin-bottom:15px;">Add New Menu</h3>
    <div class="form-group">
      <label>Food Photo</label>
      <input type="file" id="newImg" accept="image/*">
    </div>
    <div class="form-group">
      <label>Item Name</label>
      <input type="text" id="newName">
    </div>
    <div class="form-group">
      <label>Category</label>
      <select id="newCat">
        <option value="western">Western</option>
        <option value="local">Local Dishes</option>
        <option value="dessert">Dessert</option>
        <option value="drinks">Drinks</option>
        <option value="snacks">Snacks</option>
      </select>
    </div>
    <div class="form-group">
      <label>Price (RM)</label>
      <input type="number" id="newPrice" step="0.01">
    </div>
    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:15px;">
      <button onclick="hideModal('addModal')" style="background:none; border:none; cursor:pointer; font-weight:600;">Cancel</button>
      <button class="add-btn-main" onclick="saveNewItem()">Save Menu</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="editModal">
  <div class="modal-box">
    <h3 id="modalTitle" style="margin-bottom:15px;">Edit</h3>
    <input type="hidden" id="editId">
    <input type="hidden" id="editType">
    <div class="form-group">
      <label id="inputLabel">Price (RM)</label>
      <input type="number" id="modalInput" step="0.01">
    </div>
    <div id="dateGroup" style="display:none" class="form-group">
      <label>End Date</label>
      <input type="date" id="promoDate">
    </div>
    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:15px;">
      <button onclick="hideModal('editModal')" style="background:none; border:none; cursor:pointer; font-weight:600;">Back</button>
      <button class="add-btn-main" onclick="updateItem()">Update Now</button>
    </div>
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
let menuData = [
  // WESTERN
  { id: 1, name: "Grilled Chicken Chop", cat: "western", price: 18.90, promo: null, date: "", img: "img/grilledchicken.jpg" },
  { id: 2, name: "Fish & Chips", cat: "western", price: 21.00, promo: null, date: "", img: "img/fishandchips.jpg" },
  { id: 3, name: "Spaghetti Carbonara", cat: "western", price: 19.50, promo: null, date: "", img: "img/pasta.jpg" },
  { id: 4, name: "Spaghetti Bolognese", cat: "western", price: 18.50, promo: null, date: "", img: "img/bolognese.jpg" },
  { id: 5, name: "Seafood Aglio Olio", cat: "western", price: 24.00, promo: null, date: "", img: "img/seafood.jpg" },
  { id: 6, name: "Chicken Lasagna", cat: "western", price: 20.00, promo: null, date: "", img: "img/lasagna.jpg" },
  { id: 7, name: "Beef Burger", cat: "western", price: 22.50, promo: null, date: "", img: "img/beefburger.jpg" },
  { id: 8, name: "Avocado Toast", cat: "western", price: 19.50, promo: null, date: "", img: "img/avocadotoast.jpg" },

  // LOCAL DISHES
  { id: 9, name: "Nasi Lemak Ayam Crispy", cat: "local", price: 15.90, promo: null, date: "", img: "img/nasilemak.jpg" },
  { id: 10, name: "Nasi Goreng Kampung", cat: "local", price: 13.90, promo: null, date: "", img: "img/nasigoreng.jpg" },
  { id: 11, name: "Mee Goreng Mamak", cat: "local", price: 13.50, promo: null, date: "", img: "img/meegoreng.jpg" },
  { id: 12, name: "Chicken Rendang Rice", cat: "local", price: 17.90, promo: null, date: "", img: "img/rendang.jpg" },
  { id: 13, name: "Laksa Lemak", cat: "local", price: 16.50, promo: null, date: "", img: "img/laksa.jpg" },

  // DESSERTS
  { id: 14, name: "Chocolate Lava Cake", cat: "dessert", price: 12.50, promo: null, date: "", img: "img/lava.jpg" },
  { id: 15, name: "Classic Cheesecake", cat: "dessert", price: 13.50, promo: null, date: "", img: "img/classiccheesecake.jpg" },
  { id: 16, name: "Classic Tiramisu", cat: "dessert", price: 14.00, promo: null, date: "", img: "img/tiramisu.jpg" },
  { id: 17, name: "Matcha Tiramisu", cat: "dessert", price: 14.50, promo: null, date: "", img: "img/matchatiramisu.jpg" },
  { id: 18, name: "Brownies with Ice Cream", cat: "dessert", price: 11.90, promo: null, date: "", img: "img/browniesice.jpg" },
  { id: 19, name: "Red Velvet Cake", cat: "dessert", price: 11.00, promo: null, date: "", img: "img/redvelvet.jpg" },
  { id: 20, name: "Crème Brûlée", cat: "dessert", price: 13.00, promo: null, date: "", img: "img/cremebrulee.jpg" },

  // DRINKS
  { id: 21, name: "Hot Latte", cat: "drinks", price: 8.00, promo: null, date: "", img: "img/latte.jpg" },
  { id: 22, name: "Cappuccino", cat: "drinks", price: 8.50, promo: null, date: "", img: "img/cappuccino.jpg" },
  { id: 23, name: "Iced Latte", cat: "drinks", price: 9.00, promo: null, date: "", img: "img/icedlatte.jpg" },
  { id: 24, name: "Matcha Latte", cat: "drinks", price: 9.00, promo: null, date: "", img: "img/matcha.jpg" },
  { id: 25, name: "Iced Mocha", cat: "drinks", price: 9.50, promo: null, date: "", img: "img/mocha.jpg" },
  { id: 26, name: "Lemon Iced Tea", cat: "drinks", price: 6.50, promo: null, date: "", img: "img/lemon.jpg" },
  { id: 27, name: "Peach Tea", cat: "drinks", price: 7.00, promo: null, date: "", img: "img/peachtea.jpg" },
  { id: 28, name: "Strawberry Frappe", cat: "drinks", price: 8.50, promo: null, date: "", img: "img/strawberryfrappe.jpg" },

  // SNACKS
  { id: 29, name: "French Fries", cat: "snacks", price: 6.90, promo: null, date: "", img: "img/frenchfries.jpg" },
  { id: 30, name: "Cheesy Fries", cat: "snacks", price: 8.50, promo: null, date: "", img: "img/cheesyfries.jpg" },
  { id: 31, name: "Chicken Nuggets", cat: "snacks", price: 8.50, promo: null, date: "", img: "img/nuggets.jpg" },
  { id: 32, name: "Onion Rings", cat: "snacks", price: 7.50, promo: null, date: "", img: "img/onionrings.jpg" },
  { id: 33, name: "Nachos with Cheese", cat: "snacks", price: 9.90, promo: null, date: "", img: "img/nachos.jpg" }
];

function triggerToast(msg) {
  const t = document.getElementById("toast");
  t.innerText = msg;
  t.className = "show";
  setTimeout(() => { t.className = ""; }, 3000);
}

function renderMenu(data = menuData) {
  const grid = document.getElementById('menuGrid');
  grid.innerHTML = "";
  data.forEach(item => {
    grid.innerHTML += `
      <div class="menu-card">
        <img src="${item.img}" class="item-img"> 
        <div class="item-content">
          <h3 style="font-size:1.1rem">${item.name}</h3>
          <p style="font-weight:800; font-size:1.1rem; margin:8px 0;">
            RM ${item.promo ? item.promo.toFixed(2) : item.price.toFixed(2)}
            ${item.promo ? `<span style="text-decoration:line-through; color:#aaa; font-size:0.75rem; margin-left:5px">RM ${item.price.toFixed(2)}</span>` : ''}
          </p>
          ${item.date ? `<small style="color:red">Ends: ${item.date}</small>` : ''}
          <div class="admin-actions">
            <button class="action-box edit-btn" onclick="openEdit(${item.id}, 'price')">Edit</button>
            <button class="action-box promo-btn" onclick="openEdit(${item.id}, 'promo')">Promo</button>
          </div>
        </div>
      </div>`;
  });
}

function showModal(id) { document.getElementById(id).style.display = 'flex'; }
function hideModal(id) { document.getElementById(id).style.display = 'none'; }

function saveNewItem() {
  const name = document.getElementById('newName').value;
  const price = parseFloat(document.getElementById('newPrice').value);
  const cat = document.getElementById('newCat').value;
  const imgFile = document.getElementById('newImg').files[0];
  if(!name || !price) return;
  if(imgFile) imgSrc = URL.createObjectURL(imgFile);
  menuData.push({ id: Date.now(), name, price, promo:null, date:"", cat, img: imgSrc });
  renderMenu();
  hideModal('addModal');
  triggerToast("Successful Added Item!");
}

function openEdit(id, type) {
  const item = menuData.find(i => i.id == id);
  document.getElementById('editId').value = id;
  document.getElementById('editType').value = type;
  document.getElementById('modalTitle').innerText = (type === 'price') ? "Edit Price" : "Set Promo";
  document.getElementById('dateGroup').style.display = (type === 'promo') ? "block" : "none";
  document.getElementById('modalInput').value = (type === 'price') ? item.price : (item.promo || item.price);
  showModal('editModal');
}

function updateItem() {
  const id = document.getElementById('editId').value;
  const type = document.getElementById('editType').value;
  const val = parseFloat(document.getElementById('modalInput').value);
  const date = document.getElementById('promoDate').value;
  const idx = menuData.findIndex(i => i.id == id);
  if(type === 'price') {
    menuData[idx].price = val;
    menuData[idx].promo = null;
  } else {
    menuData[idx].promo = val;
    menuData[idx].date = date;
  }
  renderMenu();
  hideModal('editModal');
  triggerToast("Successful Updated!");
}

function filterCat(cat, btn) {
  document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  
  const filtered = (cat === 'all') ? menuData : menuData.filter(i => i.cat === cat);
  renderMenu(filtered);
}

renderMenu();
</script>
</body>
</html>

