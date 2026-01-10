<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Customers | Chefify Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="icon" href="img/chefify.jpg" type="image/png">

<link rel="stylesheet" href="css/admin_customers.css">

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
  <h2><i class="fa-solid fa-users"></i> Manage Customers</h2>  
  <a href="admin_dashboard.php" class="back-btn">
    <i class="fa-solid fa-arrow-left"></i> Back to dashboard
  </a> 
</div>


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









