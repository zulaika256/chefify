<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Orders | Chefify Admin</title>
<link rel="icon" href="img/chefify.jpg" type="image/png">
<script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>

<style>
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

/* ================= NAV (KEKAL FORMAT ASAL) ================= */
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
  gap:1rem;
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
  overflow:visible;
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

.nav-dropdown{
  position:relative;
}

.nav-dropdown > a{
  cursor:pointer;
}

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

.nav-dropdown:hover .dropdown-menu{
  display:block;
}

.dropdown-menu a{
  display:block;
  padding:0.8rem 1.2rem;
  color:var(--chef-brown);
  text-decoration:none;
  font-weight:600;
}

.dropdown-menu a:hover{
  background:linear-gradient(45deg,var(--peach-1),var(--peach-2));
  color:white;
}

/* ===== HEADER (KEKAL FORMAT ASAL) ===== */
.header{
  max-width:1200px;
  margin:4rem auto 2rem;
  padding:1rem 1.5rem;
  background:#F4F4F4;
  border-radius:20px;
  box-shadow:0 10px 25px rgba(75,46,25,0.2);
  display:flex;
  justify-content:space-between;
  align-items:center;
  flex-wrap:wrap;
  gap:1rem;
}

.header h2{
  font-size:1.8rem;
  display:flex;
  align-items:center;
  gap:0.8rem;
}

.header-icon {
  font-size:1.6rem;
  color:var(--chef-brown);
}

.header a{
  text-decoration:none;
  color:var(--chef-brown);
  font-weight:600;
  background:var(--peach-1);
  padding:.5rem 1rem;
  border-radius:20px;
  transition:all .3s ease;
}

.header a:hover{
  background:var(--peach-2);
  color:white;
}

/* ===== FILTERS (KEKAL FORMAT ASAL) ===== */
.filters{
  max-width:1200px;
  margin:1rem auto;
  padding:0 1.5rem;
  display:flex;
  gap:1rem;
  flex-wrap:wrap;
  align-items:center;
}

.filters input, .filters select{
  padding:.5rem 1rem;
  border-radius:12px;
  border:1px solid #ddd;
  font-size:.95rem;
}

/* ===== TABLE (KEKAL FORMAT ASAL) ===== */
.container{
  max-width:1200px;
  margin:1rem auto 4rem;
  padding:0 1.5rem;
}

table{
  width:100%;
  background:white;
  border-radius:14px;
  border-collapse:collapse;
  overflow:hidden;
  box-shadow:0 12px 28px rgba(0,0,0,0.1);
}

th, td{
  padding:1rem;
  text-align:left;
}

th{
  background:#fff1ec;
  font-size:.9rem;
}

tr:not(:last-child){
  border-bottom:1px solid #eee;
}

/* STATUS LABELS */
.status{
  padding:.35rem .9rem;
  border-radius:20px;
  font-weight:700;
  font-size:.8rem;
}

.Pending{ background:#fff0c2; color:#9c6a00; }
.Cancelled{ background:#ffe3dc; color:#b44b2a; }
.Completed{ background:#d4f7dc; color:#1b7a3a; }

/* ===== CSS BUTANG ACTION BARU ===== */
.btn-action-group {
  display: flex;
  gap: 8px;
}

.action-btn {
  border: none;
  padding: 8px 14px;
  border-radius: 10px;
  font-weight: 700;
  cursor: pointer;
  font-size: 0.8rem;
  transition: 0.3s;
  color: white;
}

.btn-complete { background: #2ecc71; }
.btn-complete:hover { background: #27ae60; transform: translateY(-2px); }

.btn-cancel { background: #e74c3c; }
.btn-cancel:hover { background: #c0392b; transform: translateY(-2px); }

/* ===== MODAL STYLE UNTUK CANCEL ===== */
.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,0.5); 
  display: none; align-items: center; justify-content: center; z-index: 1000;
  backdrop-filter: blur(4px);
}
.modal-content {
  background: white; padding: 25px; border-radius: 20px; width: 350px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}
.modal-content h3 { margin-bottom: 15px; color: var(--chef-brown); }
.reason-opt { display: block; margin-bottom: 10px; cursor: pointer; }
.reason-opt input { margin-right: 10px; }
#otherBox { width: 100%; margin-top: 5px; padding: 8px; border-radius: 8px; border: 1px solid #ddd; display: none; }
.modal-ft { margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px; }
.m-btn { padding: 8px 16px; border-radius: 10px; border: none; cursor: pointer; font-weight: 600; }
.btn-save { background: var(--btn-peach); color: white; }

@media(max-width:900px){
  .header{flex-direction:column; gap:1rem;}
  th, td{font-size:.85rem;}
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
          <a href="customers.php">Customers</a>
        </div>
      </div>

      <a href="locations.php">Locations</a>
      <a href="aboutus.php">About Us</a>
      <a href="login.php">Logout</a>
    </div>
  </div>
</nav>

<div class="header">
  <h2><i class="fa-solid fa-bars-progress header-icon"></i> Manage Orders</h2>
  <a href="admin_dashboard.php">← Back to Dashboard</a>
</div>

<div class="filters">
  <input type="text" id="searchInput" placeholder="Search by customer or ID" onkeyup="applyFilters()">
  <select id="statusFilter" onchange="applyFilters()">
    <option value="All">All Status</option>
    <option value="Pending">Pending</option>
    <option value="Cancelled">Cancelled</option>
    <option value="Completed">Completed</option>
  </select>
</div>

<div class="container">
<table>
<thead>
<tr>
  <th>ID</th>
  <th>Customer</th>
  <th>Items</th>
  <th>Total (RM)</th>
  <th>Status</th>
  <th>Action</th>
</tr>
</thead>
<tbody id="orderTable"></tbody>
</table>
</div>

<div class="modal-overlay" id="cancelModal">
  <div class="modal-content">
    <h3>Cancel Reason</h3>
    <input type="hidden" id="targetOrderId">
    <label class="reason-opt"><input type="radio" name="reason" value="Out of stock"> Out of stock</label>
    <label class="reason-opt"><input type="radio" name="reason" value="Customer request"> Customer request</label>
    <label class="reason-opt"><input type="radio" name="reason" value="Payment failed"> Payment failed</label>
    <label class="reason-opt"><input type="radio" name="reason" value="Delivery issue"> Delivery issue</label>
    <label class="reason-opt"><input type="radio" name="reason" value="Other" onclick="document.getElementById('otherBox').style.display='block'"> Other:</label>
    <input type="text" id="otherBox" placeholder="State reason...">
    <div class="modal-ft">
      <button class="m-btn" onclick="document.getElementById('cancelModal').style.display='none'">Back</button>
      <button class="m-btn btn-save" onclick="confirmCancel()">Confirm</button>
    </div>
  </div>
</div>

<script>
// Data asal (Auto-Pending)
const orders = [
  {id:1001, customer:"Aina", items:["Spaghetti x1","Lemon Tea x2"], total:32.5, status:"Pending", note:""},
  {id:1002, customer:"Hafiz", items:["Chicken Chop x2"], total:29.0, status:"Pending", note:""},
  {id:1003, customer:"Sofia", items:["Beef Burger x1","Fries x1"], total:18.9, status:"Completed", note:""}
];

function renderOrders(filteredOrders){
  const table = document.getElementById("orderTable");
  table.innerHTML = "";
  filteredOrders.forEach(order => {
    let actionCell = '-';
    
    // Jika Pending, tunjuk 2 butang cantik
    if(order.status === "Pending") {
      actionCell = `
        <div class="btn-action-group">
          <button class="action-btn btn-complete" onclick="updateStatus(${order.id}, 'Completed')">Complete</button>
          <button class="action-btn btn-cancel" onclick="openCancelModal(${order.id})">Cancel</button>
        </div>
      `;
    } else if(order.status === "Cancelled") {
      actionCell = `<small style="color:red">Reason: ${order.note}</small>`;
    }

    table.innerHTML += `
      <tr>
        <td>#${order.id}</td>
        <td>${order.customer}</td>
        <td>${order.items.join("<br>")}</td>
        <td>${order.total.toFixed(2)}</td>
        <td><span class="status ${order.status}">${order.status}</span></td>
        <td>${actionCell}</td>
      </tr>
    `;
  });
}

function updateStatus(id, newStatus){
  const order = orders.find(o => o.id === id);
  order.status = newStatus;
  applyFilters();
}

function openCancelModal(id){
  document.getElementById('targetOrderId').value = id;
  document.getElementById('cancelModal').style.display = 'flex';
}

function confirmCancel(){
  const id = parseInt(document.getElementById('targetOrderId').value);
  const selected = document.querySelector('input[name="reason"]:checked');
  if(!selected) return alert("Please select a reason");
  
  let reason = selected.value;
  if(reason === "Other") reason = document.getElementById('otherBox').value;

  const order = orders.find(o => o.id === id);
  order.status = "Cancelled";
  order.note = reason;
  document.getElementById('cancelModal').style.display = 'none';
  applyFilters();
}

function applyFilters(){
  const searchText = document.getElementById("searchInput").value.toLowerCase();
  const statusValue = document.getElementById("statusFilter").value;
  const filtered = orders.filter(order=>{
    const matchSearch = order.customer.toLowerCase().includes(searchText) || order.id.toString().includes(searchText);
    const matchStatus = (statusValue === "All") ? true : order.status === statusValue;
    return matchSearch && matchStatus;
  });
  renderOrders(filtered);
}

applyFilters();
</script>
</body>
</html>





