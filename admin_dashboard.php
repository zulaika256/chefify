<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Admin Dashboard | Chefify</title>
    <link rel="icon" href="img/chefify.jpg" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
</head>

<body>

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

<div class="dashboard-wrapper">
    
    <div class="welcome-box">
        <div>
            <h1>Hello, Admin!</h1>
            <p>Welcome back! Here's the performance of Chefify today.</p>
        </div>
        <div style="text-align: right;">
            <h2 id="clock" style="font-size: 2rem;">00:00:00</h2>
            <p style="font-weight: 700; color: var(--btn-peach-hover);">
                <?php echo date('l, d M Y'); ?>
            </p>
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
                <a href="admin_order.php" class="link-item">
                    <span>Manage Orders</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                    <a href="admin_customrs.php" class="link-item">
                    <span>Manage Customers</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
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
    function updateTime() {
        const clockElement = document.getElementById('clock');
        if (clockElement) {
            const now = new Date();
            clockElement.innerText = now.toLocaleTimeString();
        }
    }

    setInterval(updateTime, 1000);

    updateTime();
</script>

</body>
</html>
