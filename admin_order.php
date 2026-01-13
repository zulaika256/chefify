<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Orders | Chefify Admin</title>
<link rel="icon" href="img/chefify.jpg" type="image/png">
<script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_order.css">
</head>

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
  <h2><i class="fa-solid fa-bars-progress header-icon"></i> Manage Orders</h2>
  <a href="dashboard-admin.php">← Back to Dashboard</a>
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
        
</footer>

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
