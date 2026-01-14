<?php
require_once 'db.php';
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit();
}

// Render the user `profile.php` content but replace the navigation with an admin-only nav
ob_start();
include __DIR__ . '/profile.php';
$html = ob_get_clean();

$adminNav = <<<HTML
<nav>
    <div class="nav-container">
        <a href="homepage.php" class="logo">
            <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
            <span class="logo-text">Chefify</span>
        </a>
        <div class="nav-links">
            <div class="nav-dropdown">
                <a class="active" href="admin_dashboard.php">Dashboard ▾</a>
                <div class="dropdown-menu">
                    <a href="admin_order.php">Manage Orders</a>
                    <a href="admin_menu.php">Menu Inventory</a>
                    <a href="admin_customers.php">Customers</a>
                </div>
            </div>
            <a href="admin_feedback.php">Feedback</a>
            <a href="admin_profile.php" class="active">Profile</a>
            <a href="login.php">Logout</a>
        </div>
    </div>
</nav>
HTML;

$adminStyles = <<<CSS
<style>
/* Injected Admin Nav Styles */
body {
    background: url('img/wallpaper1.jpg') no-repeat center/cover fixed !important;
}
.nav-dropdown {
  position: relative;
}
.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background: white;
  min-width: 180px;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  display: none;
  z-index: 1000;
}
.nav-dropdown:hover .dropdown-menu {
  display: block;
}
.dropdown-menu a {
  display: block;
  padding: 0.8rem 1.2rem;
  border-radius: 0;
  color: #4b2e19; /* var(--chef-brown) */
  font-weight: 600;
  text-decoration: none;
}
.dropdown-menu a:hover {
  background: #ffd6c8; /* var(--peach-1) */
  color: #4b2e19 !important; /* override hover white */
  box-shadow: none !important;
  transform: none !important;
}
/* Ensure active state matches admin dashboard */
.nav-links a.active {
  color: white !important;
  background: linear-gradient(45deg, #ffd6c8, #ffb7a1) !important;
  box-shadow: 0 6px 18px rgba(255, 150, 130, 0.18) !important;
  transform: translateY(-3px) !important;
}
/* Remove "Dashboard" active state since we are on Profile */
.nav-dropdown > a.active {
    background: none !important;
    color: #4b2e19 !important;
    box-shadow: none !important;
    transform: none !important;
}
.nav-dropdown:hover > a {
    color: #ff6f8a !important; /* var(--btn-peach-hover) */
}
</style>
CSS;

// 1. Inject CSS before </head>
$html = str_replace('</head>', $adminStyles . '</head>', $html);

// 2. Replace the USER nav with ADMIN nav
// Using regex to match the <nav>...</nav> block
$newHtml = preg_replace('/<nav[\s\S]*?<\/nav>/', $adminNav, $html, 1);

// 3. Remove "Total Points" section for Admin (Sidebar and Main Content)
// Matches the specific div structure for "Total Points" including the inner value div and outer closing div
$newHtml = preg_replace('/<div class="info-item">\s*<span class="info-label">Total Points<\/span>[\s\S]*?class="info-value"[\s\S]*?<\/div>\s*<\/div>/', '', $newHtml);

echo $newHtml;
exit;
?>
