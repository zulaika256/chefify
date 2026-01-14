<?php
require_once 'db.php';
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
  header('Location: login.php');
  exit();
}

try {
  // Active promos
  $stmt = $pdo->query("SELECT COUNT(*) FROM menu_items WHERE promo_price IS NOT NULL AND (promo_end_date IS NULL OR promo_end_date >= CURDATE())");
  $activePromos = (int)$stmt->fetchColumn();

  // Feedback count
  $stmt = $pdo->query("SELECT COUNT(*) FROM feedback");
  $feedbackCount = (int)$stmt->fetchColumn();

  // New orders today
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE DATE(created_at) = CURDATE()");
  $stmt->execute();
  $newOrders = (int)$stmt->fetchColumn();

  // Total customers
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE role = 'customer'");
  $stmt->execute();
  $totalCustomers = (int)$stmt->fetchColumn();

  // Today's revenue
  $stmt = $pdo->prepare("SELECT COALESCE(SUM(total_amount),0) FROM orders WHERE DATE(created_at) = CURDATE()");
  $stmt->execute();
  $revenueToday = (float)$stmt->fetchColumn();

  // Pending / Completed counts
  $stmt = $pdo->query("SELECT SUM(order_status='pending') as pending, SUM(order_status='completed') as completed, COUNT(*) as total_orders FROM orders");
  $counts = $stmt->fetch();
  $pendingOrders = (int)($counts['pending'] ?? 0);
  $completedOrders = (int)($counts['completed'] ?? 0);

  // Recent orders
  $stmt = $pdo->prepare("SELECT o.order_id, o.total_amount, o.order_status, u.fullname FROM orders o LEFT JOIN users u ON o.user_id=u.user_id ORDER BY o.created_at DESC LIMIT 6");
  $stmt->execute();
  $recentOrders = $stmt->fetchAll();
} catch (Exception $e) {
  $activePromos = $feedbackCount = $newOrders = $totalCustomers = $pendingOrders = $completedOrders = 0;
  $revenueToday = 0.00;
  $recentOrders = [];
}

?>

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
            <a href="admin_profile.php">Profile</a>
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
        <div class="number"><?php echo intval($newOrders); ?></div>
        <p style="color: green; font-size: 0.8rem; font-weight: 700;">Today's orders</p>
      </div>
      <div class="stat-card" style="border-left-color: var(--chef-brown);">
        <i class="fa-solid fa-users"></i>
        <h3>Total Customers</h3>
        <div class="number"><?php echo intval($totalCustomers); ?></div>
        <p style="color: #888; font-size: 0.8rem; font-weight: 700;">Active users</p>
      </div>
      <div class="stat-card" style="border-left-color: var(--btn-peach-hover);">
        <i class="fa-solid fa-tags"></i>
        <h3>Active Promos</h3>
        <div class="number"><?php echo intval($activePromos); ?></div>
        <p style="color: var(--btn-peach-hover); font-size: 0.8rem; font-weight: 700;">Items on sale</p>
      </div>
    </div>

    <div class="stats-grid" style="margin-top:1rem;">
      <div class="stat-card">
        <i class="fa-solid fa-money-bill-wave"></i>
        <h3>Revenue Today</h3>
        <div class="number">RM <?php echo number_format($revenueToday,2); ?></div>
        <p style="color: #088; font-size: 0.8rem; font-weight: 700;">Today's sales</p>
      </div>
      <div class="stat-card" style="border-left-color: #f0ad4e;">
        <i class="fa-solid fa-hourglass-half"></i>
        <h3>Pending Orders</h3>
        <div class="number"><?php echo intval($pendingOrders); ?></div>
        <p style="color: #f0ad4e; font-size: 0.8rem; font-weight: 700;">Awaiting fulfillment</p>
      </div>
      <div class="stat-card" style="border-left-color: #28a745;">
        <i class="fa-solid fa-check-circle"></i>
        <h3>Completed Orders</h3>
        <div class="number"><?php echo intval($completedOrders); ?></div>
        <p style="color: #28a745; font-size: 0.8rem; font-weight: 700;">Total completed</p>
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
                  <?php if (!empty($recentOrders)): ?>
                    <?php foreach ($recentOrders as $order): ?>
                      <tr>
                        <td>#<?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['fullname'] ?: 'Guest'); ?></td>
                        <td>RM <?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><span class="status-tag <?php echo htmlspecialchars($order['order_status']); ?>"><?php echo ucfirst($order['order_status']); ?></span></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr><td colspan="4">No recent orders</td></tr>
                  <?php endif; ?>
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
                <a href="admin_customers.php" class="link-item">
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