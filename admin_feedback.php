<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Customer Feedback Management | Chefify</title>
    <link rel="icon" href="img/chefify.jpg" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_feedback.css">
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

<div class="header">
  <h2><i class="fa-solid fa-comments"></i> Customer Feedback Management</h2>
  <a href="dashboard-admin.php">← Back to Dashboard</a>
</div>

<div class="dashboard-wrapper">

    <div class="stats-summary">
        <div class="stat-item">
            <span class="stat-label">Total Reviews</span>
            <span class="stat-value">45</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">Average Rating</span>
            <span class="stat-value">4.8 <i class="fa-solid fa-star" style="color: #f1c40f;"></i></span>
        </div>
    </div>

    <div class="admin-controls">
        <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search by name, email or comment..." onkeyup="filterFeedback()">
        </div>

        <div class="filter-group">
            <select id="ratingFilter" onchange="filterFeedback()">
                <option value="all">All Ratings</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
        </div>
    </div>

    <div id="reviewList" class="review-list">
        <div class="review-box" data-rating="5">
            <div class="review-header">
                <div class="review-name">Amna</div>
                <div class="review-rating">★★★★★</div>
            </div>
            <div class="review-comment">"The drinks are so good! I love the matcha mango so much."</div>
            <div class="review-footer">
                <small><i class="fa-solid fa-envelope"></i> amna@gmail.com</small>
                <small><i class="fa-solid fa-calendar"></i> 10 Jan 2026</small>
            </div>
        </div>

        <div class="review-box" data-rating="4">
            <div class="review-header">
                <div class="review-name">Aliffah</div>
                <div class="review-rating">★★★★</div>
            </div>
            <div class="review-comment">"Nice café, cute design. Chocolate milk a bit sweet for me."</div>
            <div class="review-footer">
                <small><i class="fa-solid fa-envelope"></i> alffh@gmail.com</small>
                <small><i class="fa-solid fa-calendar"></i> 09 Jan 2026</small>
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

<!-- ===== JAVASCRIPT (IMPORTANT: AT BOTTOM) ===== -->

<script>

    function filterFeedback() {
    const searchText = document.getElementById("searchInput").value.toLowerCase();
    const ratingFilter = document.getElementById("ratingFilter").value;
    const cards = document.querySelectorAll(".review-box");

    cards.forEach(card => {
        const comment = card.querySelector(".review-comment").innerText.toLowerCase();
        const name = card.querySelector(".review-name").innerText.toLowerCase();
        const email = card.querySelector("small").innerText.toLowerCase();
        const rating = card.getAttribute("data-rating");

        const matchesSearch = comment.includes(searchText) || name.includes(searchText) || email.includes(searchText);
        const matchesRating = (ratingFilter === "all" || rating === ratingFilter);

        if (matchesSearch && matchesRating) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}
document.getElementById("feedbackForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const name = document.getElementById("fbName").value;
    const email = document.getElementById("fbEmail").value;
    const rating = document.getElementById("fbRating").value;
    const comment = document.getElementById("fbComment").value;

    let stars = "★".repeat(rating);

    const reviewBox = document.createElement("div");
    reviewBox.classList.add("review-box");

    reviewBox.innerHTML = `
        <div class="review-name">${name}</div>
        <div class="review-rating">${stars}</div>
        <div class="review-comment">${comment}</div>
        <small>${email}</small>
    `;

    document.getElementById("reviewList").prepend(reviewBox);
    document.getElementById("feedbackForm").reset();
});

let selectedRating = 0;
const stars = document.querySelectorAll(".star-rating span");

stars.forEach(star => {
    star.addEventListener("click", () => {
        selectedRating = star.dataset.value;
        document.getElementById("fbRating").value = selectedRating;

        stars.forEach(s => s.classList.remove("active"));
        for (let i = 0; i < selectedRating; i++) {
            stars[i].classList.add("active");
        }
    });
});

</script>

</body>
</html>
