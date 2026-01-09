<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Customers | Chefify Admin</title>
<link rel="icon" href="img/chefify.jpg" type="image/png">
<style>
/* KEKAL THEME ASAL AWAK */
:root{
  --chef-brown:#4b2e19;
  --peach-1:#ffd6c8;
  --peach-2:#ffb7a1;
  --btn-peach:#ff9e85;
  --btn-peach-hover:#ff6f8a;
  --card-cream:rgba(255,230,225,0.85);
}

*{margin:0;padding:0;box-sizing:border-box;}

body{
  font-family:'Arial', Helvetica, sans-serif;
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

/* ================= NAV (IKUT FORMAT ASAL) ================= */
nav{
  position:sticky;
  top:0;
  z-index:999;
  background: transparent;
  padding: 1rem 0;
  backdrop-filter: blur(4px);
}

.nav-container{
  max-width:1200px;
  margin:0 auto;
  padding: 0 1rem;
  display:flex;
  align-items:center;
  justify-content:space-between;
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

.nav-links a:hover,
.nav-links a.active{
  color:white;
  background: linear-gradient(45deg,var(--peach-1),var(--peach-2));
  box-shadow: 0 6px 18px rgba(255,150,130,0.18);
  transform:translateY(-3px);
}

/* Dropdown Dashboard */
.nav-dropdown{ position:relative; }
.nav-dropdown > a{ cursor:pointer; }
.dropdown-menu{
  position:absolute;
  top:100%;
  left:0;
  background:white;
  min-width:180px;
  border-radius:12px;
  box-shadow:0 10px 25px rgba(0,0,0,0.2);
  display:none;
  z-index:999;
}
.nav-dropdown:hover .dropdown-menu{ display:block; }
.dropdown-menu a{ display:block; padding:0.8rem 1.2rem; color:var(--chef-brown); text-decoration:none; font-weight:600; }
.dropdown-menu a:hover{ background:linear-gradient(45deg,var(--peach-1),var(--peach-2)); color:white; }

/* ===== PAGE HEADER (IKUT FORMAT ASAL) ===== */
.header{
  max-width:1200px;
  margin:4rem auto 2rem;
  padding:1rem 1.5rem;
  background:#F4F4F4; /* UPDATED COLOR */
  border-radius:20px;
  box-shadow:0 10px 25px rgba(75,46,25,0.2);
  display:flex;
  justify-content:space-between;
  align-items:center;
}

/* ===== TABLE & ACTIONS ===== */
.container{ max-width:1200px; margin:2rem auto; padding:0 1.5rem; }
table{ width:100%; background:white; border-radius:14px; border-collapse:collapse; overflow:hidden; box-shadow:0 12px 28px rgba(0,0,0,0.1); }
th, td{ padding:1rem; text-align:left; }
th{ background:#fff1ec; font-size:.9rem; }
tr:not(:last-child){ border-bottom:1px solid #eee; }

.status{ padding:.35rem .9rem; border-radius:20px; font-weight:700; font-size:.8rem; }
.Membership{ background:#d4f7dc; color:#1b7a3a; }
.Regular{ background:#fff0c2; color:#9c6a00; }
.VIP{ background:#ffe3dc; color:#b44b2a; }

.action-btn { border: none; padding: 8px 14px; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 0.8rem; transition: 0.2s; margin-right: 5px; }
.btn-edit { background: #e2e8f0; color: #475569; }
.btn-gift { background: var(--btn-peach); color: white; }
.btn-gift:hover { background: var(--btn-peach-hover); transform: scale(1.05); }

/* ===== LEADERBOARD (WIDE VERSION) ===== */
.leaderboard-section {
  max-width: 800px; 
  margin: 3rem auto; 
  background: rgba(255, 255, 255, 0.6); 
  padding: 35px 30px; 
  border-radius: 30px;
  box-shadow: 0 15px 35px rgba(75, 46, 25, 0.1); 
  border: 1px solid rgba(255, 255, 255, 0.8); 
  backdrop-filter: blur(10px);
}
.leaderboard-section h2 { text-align: center; margin-bottom: 30px; font-weight: 800; color: var(--chef-brown); }
.leaderboard-container { display: flex; flex-direction: column; gap: 12px; max-height: 400px; overflow-y: auto; padding-right: 12px; }
.leaderboard-row { display: grid; grid-template-columns: 60px 70px 1fr 150px; align-items: center; background: rgba(255, 255, 255, 0.55); padding: 15px 25px; border-radius: 20px; transition: 0.3s; }
.leaderboard-row:hover { background: white; transform: scale(1.01); }

/* ===== MODAL STYLE (BEAUTIFUL POPUP) ===== */
.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: none;
  align-items: center; justify-content: center; z-index: 1000; backdrop-filter: blur(4px);
}
.modal-content {
  background: white; padding: 30px; border-radius: 25px; width: 400px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.2); animation: popIn 0.3s ease;
}
@keyframes popIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.quick-gift-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin: 15px 0; }
.quick-btn { background: #fff1ec; border: 1.5px solid var(--peach-2); padding: 10px; border-radius: 12px; cursor: pointer; font-weight: 700; transition: 0.2s; }
.quick-btn:hover { background: var(--peach-2); color: white; }
.modal-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 10px; }
.modal-btn { padding: 12px 24px; border-radius: 12px; border: none; cursor: pointer; font-weight: 600; }
.save-btn { background: var(--btn-peach); color: white; }
.cancel-btn { background: #eee; }

/* ===== TOAST NOTIFICATION STYLE ===== */
#toast {
  visibility: hidden;
  min-width: 250px;
  background-color: var(--chef-brown);
  color: #fff;
  text-align: center;
  border-radius: 15px;
  padding: 16px;
  position: fixed;
  z-index: 1100;
  left: 50%;
  bottom: 30px;
  transform: translateX(-50%);
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  font-weight: 600;
  border: 2px solid var(--peach-2);
}

#toast.show {
  visibility: visible;
  animation: slideUp 0.5s, fadeOut 0.5s 2.5s;
}

@keyframes slideUp {
  from { bottom: 0; opacity: 0; }
  to { bottom: 30px; opacity: 1; }
}

@keyframes fadeOut {
  from { bottom: 30px; opacity: 1; }
  to { bottom: 0; opacity: 0; }
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
    <div class="nav-links">
      <a href="homepage.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="cart.php">Cart</a>

      <div class="nav-dropdown">
        <a class="active">Dashboard ▾</a>
        <div class="dropdown-menu">
          <a href="admin_order.php">Manage Orders</a>
          <a href="admin_menu.php">Menu Inventory</a>
          <a href="admin_customers.php">Customers</a>
        </div>
      </div>

      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About Us</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

<div class="header"> 
  <h2>Manage Customers</h2>  
   <a href="admin_dashboard.php" 
   style="text-decoration:none; color:var(--chef-brown);
    font-weight:600; background:var(--peach-1); padding:.5rem 1rem; 
    border-radius:20px;">← Back to dashboard</a> </div>


<div class="container">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Customer Info</th>
        <th>Membership</th>
        <th>Points</th>
        <th>Quick Actions</th>
      </tr>
    </thead>
    <tbody id="customerTable"></tbody>
  </table>
</div>

<div class="container">
  <div class="leaderboard-section">
    <h2>🏆 Top Chefifiers</h2>
    <div class="leaderboard-container" id="leaderboardContent"></div>
  </div>
</div>

<div id="toast">Action Successful!</div>

<div class="modal-overlay" id="editModal">
  <div class="modal-content">
    <h3>📝 Edit Customer</h3>
    <input type="hidden" id="editIdx">
    <label style="display:block; margin-top:15px;">Full Name</label>
    <input type="text" id="editName" style="width:100%; padding:10px; margin-bottom:15px; border-radius:8px; border:1px solid #ddd;">
    <label style="display:block;">Membership</label>
    <select id="editMembership" style="width:100%; padding:10px; margin-bottom:15px; border-radius:8px; border:1px solid #ddd;">
      <option value="Regular">Regular</option>
      <option value="VIP">VIP</option>
    </select>
    <div class="modal-footer">
      <button class="modal-btn cancel-btn" onclick="closeModals()">Cancel</button>
      <button class="modal-btn save-btn" onclick="saveEdit()">Update</button>
    </div>
  </div>
</div>

<div class="modal-overlay" id="giftModal">
  <div class="modal-content">
    <h3>🎁 Gift Points: <span id="giftTargetName"></span></h3>
    <input type="hidden" id="giftTargetId">
    <div class="quick-gift-grid">
      <button class="quick-btn" onclick="setGiftAmount(50)">+50</button>
      <button class="quick-btn" onclick="setGiftAmount(100)">+100</button>
      <button class="quick-btn" onclick="setGiftAmount(500)">+500</button>
    </div>
    <input type="number" id="customGiftAmount" placeholder="Enter custom amount" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd;">
    <div class="modal-footer">
      <button class="modal-btn cancel-btn" onclick="closeModals()">Back</button>
      <button class="modal-btn save-btn" onclick="saveGift()">Confirm</button>
    </div>
  </div>
</div>

<script>
let customers = [
  {id:1, name:"Aina", email:"aina@mail.com", membership:"VIP", points:12500, avatar:"https://i.pravatar.cc/100?img=1"},
  {id:2, name:"Hafiz", email:"hafiz@mail.com", membership:"Regular", points:11200, avatar:"https://i.pravatar.cc/100?img=2"},
  {id:3, name:"Sofia", email:"sofia@mail.com", membership:"VIP", points:9800, avatar:"https://i.pravatar.cc/100?img=3"},
  {id:4, name:"Zara", email:"zara@mail.com", membership:"Regular", points:8670, avatar:"https://i.pravatar.cc/100?img=4"},
  {id:5, name:"Imran", email:"imran@mail.com", membership:"VIP", points:7100, avatar:"https://i.pravatar.cc/100?img=5"},
  {id:6, name:"Nina", email:"nina@mail.com", membership:"Regular", points:6720, avatar:"https://i.pravatar.cc/100?img=6"}
];

// FUNCTION TO SHOW TOAST
function showToast(message) {
  const toast = document.getElementById("toast");
  toast.innerText = message;
  toast.className = "show";
  setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}

function openEdit(id) {
  const c = customers.find(x => x.id === id);
  document.getElementById('editIdx').value = id;
  document.getElementById('editName').value = c.name;
  document.getElementById('editMembership').value = c.membership;
  document.getElementById('editModal').style.display = 'flex';
}

function openGift(id) {
  const c = customers.find(x => x.id === id);
  document.getElementById('giftTargetId').value = id;
  document.getElementById('giftTargetName').innerText = c.name;
  document.getElementById('giftModal').style.display = 'flex';
}

function setGiftAmount(v) { document.getElementById('customGiftAmount').value = v; }

function closeModals() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('giftModal').style.display = 'none';
}

function saveEdit() {
  const id = parseInt(document.getElementById('editIdx').value);
  const c = customers.find(x => x.id === id);
  c.name = document.getElementById('editName').value;
  c.membership = document.getElementById('editMembership').value;
  closeModals(); 
  renderAll();
  showToast("Customer profile updated! ✅");
}

function saveGift() {
  const id = parseInt(document.getElementById('giftTargetId').value);
  const amt = parseInt(document.getElementById('customGiftAmount').value);
  if(!isNaN(amt) && amt > 0) {
    const c = customers.find(x => x.id === id);
    c.points += amt;
    closeModals(); 
    renderAll();
    showToast(`Gifted ${amt} points to ${c.name}! 🎁`);
  }
}

function renderAll(){
  const table = document.getElementById("customerTable");
  table.innerHTML = "";
  customers.forEach(c=>{
    table.innerHTML += `<tr>
      <td>#${c.id}</td>
      <td><img src="${c.avatar}" style="width:40px;height:40px;border-radius:50%;"></td>
      <td><strong>${c.name}</strong><br><small>${c.email}</small></td>
      <td><span class="status ${c.membership}">${c.membership}</span></td>
      <td>${c.points.toLocaleString()}</td>
      <td>
        <button class="action-btn btn-edit" onclick="openEdit(${c.id})">Edit</button>
        <button class="action-btn btn-gift" onclick="openGift(${c.id})">Gift 🎁</button>
      </td>
    </tr>`;
  });

  const sorted = [...customers].sort((a,b)=>b.points - a.points);
  const container = document.getElementById("leaderboardContent");
  container.innerHTML = "";
  sorted.forEach((c, i) => {
    let rCls = (i === 0) ? "gold" : (i === 1) ? "silver" : (i === 2) ? "bronze" : "";
    container.innerHTML += `<div class="leaderboard-row">
      <div class="lb-rank ${rCls}">${i + 1}</div>
      <img src="${c.avatar}" style="width:45px;height:45px;border-radius:50%;border:2px solid #fff;">
      <div style="padding-left:20px;"><span style="font-weight:800;display:block;">${c.name}</span><small>${c.membership}</small></div>
      <div style="font-weight:900;text-align:right;font-size:1.2rem;">${c.points.toLocaleString()}</div>
    </div>`;
  });
}

renderAll();
</script>
</body>
</html>









