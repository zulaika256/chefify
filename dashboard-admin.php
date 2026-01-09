<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Admin Dashboard | Chefify</title>
<link rel="icon" href="img/chefify.jpg" type="image/png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
:root{
  --chef-brown:#4b2e19;
  --peach-1:#ffd6c8;
  --peach-2:#ffb7a1;
  --btn-peach:#ff9e85;
  --btn-peach-hover:#ff6f8a;
  --card-cream:rgba(255,255,255,0.9);
}

*{margin:0;padding:0;box-sizing:border-box}

body{
  font-family:Arial, Helvetica, sans-serif;
  background:url('img/wallpaper4.jpg') no-repeat center/cover fixed;
  color:var(--chef-brown);
}

body::before{
  content:""; position:fixed; inset:0;
  background:rgba(255,170,150,.45); z-index:-1;
}

/* ================= NAV ================= */
nav{ position:sticky; top:0; z-index:999; background: transparent; padding: 1.25rem 0; backdrop-filter: blur(4px); }
.nav-container{ max-width:1200px; margin:0 auto; padding: 0 1rem; display:flex; align-items:center; justify-content:space-between; }
.logo{ display:flex; align-items:center; gap:18px; text-decoration:none; }
.logo-img{ height:60px; width:auto; border-radius:50%; border:2px solid #ffdde0; box-shadow:0 4px 12px rgba(100,40,20,0.35); }
.logo-text{ font-size:1.6rem; font-weight:800; color:var(--chef-brown); letter-spacing:0.5px; }

.nav-links{ display:flex; gap:0.35rem; align-items:center; }
.nav-links a{ color:var(--chef-brown); text-decoration:none; padding:0.45rem 0.9rem; border-radius:20px; font-weight:600; transition:0.3s; }
.nav-links a:hover, .nav-links a.active{ color:white; background: linear-gradient(45deg,var(--peach-1),var(--peach-2)); box-shadow: 0 6px 18px rgba(255,150,130,0.18); transform:translateY(-3px); }

.nav-dropdown { position: relative; }
.dropdown-menu {
  position: absolute; top: 100%; left: 0; background: white; min-width: 180px; 
  border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); display: none; z-index: 1000;
}
.nav-dropdown:hover .dropdown-menu { display: block; }
.dropdown-menu a { display: block; padding: 0.8rem 1.2rem; border-radius: 0; color: var(--chef-brown); font-weight: 600; text-decoration: none;}
.dropdown-menu a:hover { background: var(--peach-1); }

/* ================= HEADER ================= */
.header{
  max-width:1200px; margin:2rem auto 1rem; padding:1rem 1.5rem; background:#F4F4F4;
  border-radius:20px; box-shadow:0 10px 25px rgba(75,46,25,0.2);
  display:flex; justify-content:space-between; align-items:center; gap:1rem;
}
.header h2{ font-size:1.6rem; display:flex; align-items:center; gap:0.8rem; }
.header-icon { font-size:1.4rem; color:var(--chef-brown); }

.header a.back-btn{
  text-decoration:none; color:var(--chef-brown); font-weight:600; background:var(--peach-1);
  padding:.5rem 1.2rem; border-radius:20px; transition:all .3s ease; font-size: 0.9rem;
}
.header a.back-btn:hover{ background:var(--peach-2); color:white; transform: translateX(-5px); }

/* ================= DASHBOARD CONTENT ================= */
.dashboard-wrapper { max-width:1200px; margin: 2rem auto 4rem; padding: 0 1rem; }

.welcome-box {
    background: var(--card-cream); padding: 2rem; border-radius: 25px;
    margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex; justify-content: space-between; align-items: center;
}

.stats-grid {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;
}
.stat-card {
    background: white; padding: 1.5rem; border-radius: 20px; border-left: 8px solid var(--btn-peach);
    box-shadow: 0 8px 20px rgba(0,0,0,0.05); transition: 0.3s;
}
.stat-card:hover { transform: translateY(-5px); }
.stat-card i { font-size: 2rem; color: var(--btn-peach); margin-bottom: 10px; }
.stat-card h3 { font-size: 0.9rem; opacity: 0.7; text-transform: uppercase; }
.stat-card .number { font-size: 2.2rem; font-weight: 800; margin: 5px 0; }

.main-content {
    display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;
}
.box {
    background: white; padding: 1.5rem; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}
.box h2 { margin-bottom: 1.5rem; font-size: 1.3rem; display: flex; align-items: center; gap: 10px; }

/* Table Styling */
table { width: 100%; border-collapse: collapse; }
th { text-align: left; padding: 12px; background: var(--peach-1); border-radius: 5px; font-weight: 700; }
td { padding: 12px; border-bottom: 1px solid #eee; }

.status-tag { padding: 4px 10px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; }
.pending { background: #fff4e5; color: #ff9800; }
.completed { background: #e6fcf5; color: #087f5b; }

.quick-links { display: flex; flex-direction: column; gap: 10px; }
.link-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 15px; background: var(--peach-1); border-radius: 15px;
    text-decoration: none; color: var(--chef-brown); font-weight: 700; transition: 0.3s;
}
.link-item:hover { background: var(--peach-2); color: white; padding-left: 20px; }

@media (max-width: 900px) { .main-content { grid-template-columns: 1fr; } .welcome-box { flex-direction: column; text-align: center; gap: 1rem; } .welcome-box div { text-align: center !important; } }
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
          <a href="orders.php">Manage Orders</a>
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

<div class="dashboard-wrapper">
    
    <div class="welcome-box">
        <div>
            <h1>Hello, Admin!</h1>
            <p>Welcome back! Here's the performance of Chefify today.</p>
        </div>
        <div style="text-align: right;">
            <h2 id="clock" style="font-size: 2rem;">00:00:00</h2>
            <p style="font-weight: 700; color: var(--btn-peach-hover);"><?php echo date('l, d M Y'); ?></p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <i class="fa-solid fa-bag-shopping"></i>
            <h3>New Orders</h3>
            <div class="number">12</div>
            <p style="color: green; font-size: 0.8rem; font-weight: 700;">+4 since yesterday</p>
        </div>
        <div class="stat-card" style="border-left-color: var(--chef-brown);">
            <i class="fa-solid fa-users"></i>
            <h3>Total Customers</h3>
            <div class="number">1,245</div>
            <p style="color: #888; font-size: 0.8rem; font-weight: 700;">Active users</p>
        </div>
        <div class="stat-card" style="border-left-color: var(--btn-peach-hover);">
            <i class="fa-solid fa-tags"></i>
            <h3>Active Promos</h3>
            <div class="number">5</div>
            <p style="color: var(--btn-peach-hover); font-size: 0.8rem; font-weight: 700;">Items on sale</p>
        </div>
    </div>

    <div class="main-content">
        <div class="box">
            <h2><i class="fa-solid fa-clock-rotate-left"></i> Recent Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#8841</td>
                        <td>Ahmad Fauzi</td>
                        <td>RM 35.00</td>
                        <td><span class="status-tag pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>#8840</td>
                        <td>Sarah Tan</td>
                        <td>RM 12.50</td>
                        <td><span class="status-tag completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>#8839</td>
                        <td>John Doe</td>
                        <td>RM 45.00</td>
                        <td><span class="status-tag completed">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="box">
            <h2><i class="fa-solid fa-bolt"></i> Quick Actions</h2>
            <div class="quick-links">
                <a href="admin_menu.php" class="link-item">
                    <span>Menu Inventory</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <a href="orders.php" class="link-item">
                    <span>Manage Orders</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <a href="customers.php" class="link-item">
                    <span>Manage Customers</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function updateTime() {
    const now = new Date();
    document.getElementById('clock').innerText = now.toLocaleTimeString();
}
setInterval(updateTime, 1000);
updateTime();
</script>

</body>
</html>