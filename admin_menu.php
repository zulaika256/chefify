<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Management | Chefify Admin</title>
<link rel="icon" href="img/chefify.jpg" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
:root{
  --chef-brown:#4b2e19;
  --peach-1:#ffd6c8;
  --peach-2:#ffb7a1;
  --btn-peach:#ff9e85;
  --btn-peach-hover:#ff6f8a;
}

*{margin:0;padding:0;box-sizing:border-box;}

body{
  font-family:'Arial', Helvetica, sans-serif;
  background:url('img/wallpaper4.jpg') no-repeat center/cover fixed;
  color:var(--chef-brown);
}

body::before{
  content:""; position:fixed; inset:0;
  background:rgba(255,170,150,.45); z-index:-1;
}

/* ================= NAV (KEKAL FORMAT ASAL) ================= */
nav{
  position:sticky; top:0; z-index:999; background: transparent; padding: 1rem 0; backdrop-filter: blur(4px);
}
.nav-container{
  max-width:1200px; margin:0 auto; padding: 0 1rem; display:flex; align-items:center; justify-content:space-between; gap:1rem;
}
.logo{ display:flex; align-items:center; gap:18px; text-decoration:none; }
.logo-img{ height:60px; width:auto; border-radius:50%; border:2px solid #ffdde0; box-shadow:0 4px 12px rgba(100,40,20,0.35); }
.logo-text{ font-size:1.6rem; font-weight:800; color:var(--chef-brown); letter-spacing:0.5px; }

.nav-links{ display:flex; gap:0.35rem; align-items:center; }
.nav-links a{ color:var(--chef-brown); text-decoration:none; padding:0.45rem 0.9rem; border-radius:20px; font-weight:600; transition:all .22s ease; }
.nav-links a:hover, .nav-links a.active{ color:white; background: linear-gradient(45deg,var(--peach-1),var(--peach-2)); box-shadow: 0 6px 18px rgba(255,150,130,0.18); transform:translateY(-3px); }

.nav-dropdown{ position:relative; }
.dropdown-menu{
  position:absolute; top:100%; left:0; background:white; min-width:180px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.2); display:none; z-index:999;
}
.nav-dropdown:hover .dropdown-menu{ display:block; }
.dropdown-menu a{ display:block; padding:0.8rem 1.2rem; color:var(--chef-brown); text-decoration:none; font-weight:600; }
.dropdown-menu a:hover{ background:linear-gradient(45deg,var(--peach-1),var(--peach-2)); color:white; }

/* ================= HEADER (DIPERKECILKAN IKUT PAGE ORDER) ================= */
.header{
  max-width:1200px;
  margin:4rem auto 2rem;
  padding:1rem 1.5rem; /* Saiz padding yang sama mcm Manage Order */
  background:#F4F4F4;
  border-radius:20px;
  box-shadow:0 10px 25px rgba(75,46,25,0.2);
  display:flex;
  justify-content:space-between;
  align-items:center;
  flex-wrap:wrap;
  gap:1rem;
}
.header h2{ font-size:1.8rem; display:flex; align-items:center; gap:0.8rem; }
.header-icon { font-size:1.6rem; color:var(--chef-brown); }

.header-right { display: flex; align-items: center; gap: 0.8rem; }

/* Back Link Style */
.header a.back-btn{
  text-decoration:none; color:var(--chef-brown); font-weight:600; background:var(--peach-1);
  padding:.5rem 1rem; border-radius:20px; transition:all .3s ease; font-size: 0.9rem;
}
.header a.back-btn:hover{ background:var(--peach-2); color:white; }

/* Add Button Style */
.add-btn-main { 
  background:var(--btn-peach); color:white; font-weight:800; 
  padding:.5rem 1.2rem; /* Saiz diselaraskan supaya seimbang */
  border-radius:20px; cursor:pointer; border:none; transition: 0.3s; font-size: 0.9rem;
}
.add-btn-main:hover { background: var(--btn-peach-hover); transform: translateY(-2px); }

/* ================= FILTERS & GRID ================= */
.filters{ max-width:1200px; margin:1rem auto; padding:0 1.5rem; display:flex; gap:0.8rem; flex-wrap:wrap; }
.filter-btn { 
  padding: 6px 15px; border-radius: 12px; border: 1.5px solid var(--peach-2); background: white; cursor: pointer; font-weight: 700; transition: 0.3s; font-size: 0.85rem;
}
.filter-btn.active, .filter-btn:hover { background: var(--peach-2); color: white; }

.container{ 
  max-width:1200px; margin:1rem auto 4rem; padding:0 1.5rem; 
  display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; 
}
.menu-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: 0.3s; }
.item-img { width: 100%; height: 180px; object-fit: cover; }
.item-content { padding: 1.2rem; }

/* ADMIN ACTIONS */
.admin-actions { display: flex; gap: 8px; margin-top: 12px; }
.action-box { 
  flex: 1; border: none; padding: 8px; border-radius: 10px; font-weight: 700; cursor: pointer; transition: 0.3s; font-size: 0.8rem;
}
.edit-btn { background: #f2f2f2; color: #555; }
.promo-btn { background: var(--peach-1); color: var(--chef-brown); }

/* TOAST & MODAL */
#toast { visibility: hidden; min-width: 200px; background-color: var(--chef-brown); color: #fff; text-align: center; border-radius: 50px; padding: 12px; position: fixed; z-index: 2000; left: 50%; bottom: 30px; transform: translateX(-50%); font-weight: 600; }
#toast.show { visibility: visible; animation: fadein 0.5s, fadeout 0.5s 2.5s; }
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); display: none; align-items: center; justify-content: center; z-index: 1000; backdrop-filter: blur(5px); }
.modal-box { background: white; width: 380px; padding: 25px; border-radius: 20px; }
.form-group { margin-bottom: 12px; }
.form-group label { display: block; font-weight: 700; margin-bottom: 5px; font-size: 0.9rem; }
.form-group input, .form-group select { width: 100%; padding: 8px; border-radius: 8px; border: 1px solid #ddd; }

@keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} }
@keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} }
</style>
</head>
<body>

<div id="toast">Successful!</div>

<nav>
  <div class="nav-container">
    <a href="homepage.php" class="logo">
      <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
      <span class="logo-text">Chefify</span>
    </a>
    <div class="nav-links">
      <a href="homepage.php">Home</a>
      <a href="menu.php" class="active">Menu</a>
      <a href="cart.php">Cart</a>
      <div class="nav-dropdown">
        <a>Dashboard ▾</a>
        <div class="dropdown-menu">
          <a href="orders.php">Orders</a>
          <a href="admin_menu.php">Menu</a>
          <a href="customers.php">Customers</a>
        </div>
      </div>
      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About Us</a>
      <a href="contactus.php">Contact Us</a>
      <a href="feedback.php">Feedback</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

<div class="header">
  <h2><i class="fa-solid fa-bars-progress header-icon"></i> Menu Inventory</h2>
  <div class="header-right">
    <a href="homepage.php" class="back-btn">← Back to Dashboard</a>
    <button class="add-btn-main" onclick="showModal('addModal')">+ Add New Item</button>
  </div>
</div>

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

<script>
let menuData = [
  {id:1, name:"Chicken Chop", price:18.00, promo:null, date:"", cat:"western", img:"img/chefify.jpg"}
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
        <img src="${item.img}" class="item-img" onerror="this.src='img/chefify.jpg'">
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
  let imgSrc = "img/chefify.jpg";
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