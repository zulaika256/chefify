<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mew & Brew Feedback</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav>
  <div class="nav-container">
    <a class="logo" href="home.html">
      <img src="img/chefify.jpg" class="logo-img">
      <span class="logo-text">Chefify</span>
    </a>
    <div class="nav-links">
      <a href="home.html">Home</a>
      <a href="menu.html">Menu</a>
      <a href="cart.html">Cart</a>
      <a href="dashboard.html">Dashboard</a>
      <a href="locations.html">Locations</a>
      <a href="aboutus.html">About</a>
      <a href="contactus.html">Contact Us</a>
      <a href="feedback.php"> Feedback</a>
      <a href="index.html">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">

<!-- ===== FEEDBACK FORM ===== -->
<div class="feedback-container">
    <h2>Leave Your Feedback</h2>

    <form id="feedbackForm">
        <label>Name</label>
        <input type="text" id="fbName" required>

        <label>Email</label>
        <input type="email" id="fbEmail" required>

       <label>Rating</label>
       <div class="star-rating" id="starRating">
       <span data-value="1">★</span>
       <span data-value="2">★</span>
       <span data-value="3">★</span>
       <span data-value="4">★</span>
       <span data-value="5">★</span>
       </div>
       <input type="hidden" id="fbRating" required>


        <label>Comment</label>
        <textarea id="fbComment" rows="3" required></textarea>

        <button type="submit" class="btn btn-primary w-100">
            Submit Feedback
        </button>
    </form>
</div>

<hr class="mt-4">

<!-- ===== CUSTOMER REVIEWS ===== -->
<h2 class="text-center mt-4">Customer Reviews</h2>

<div id="reviewList" class="review-list">

    <div class="review-box">
        <div class="review-name">Amna</div>
        <div class="review-rating">★★★★★</div>
        <div class="review-comment">
            The drinks are so good! I love the matcha mango so much.
        </div>
        <small>amna@gmail.com</small>
    </div>

    <div class="review-box">
        <div class="review-name">Aliffah</div>
        <div class="review-rating">★★★★</div>
        <div class="review-comment">
            Nice café, cute design. Chocolate milk a bit sweet for me.
        </div>
        <small>alffh@gmail.com</small>
    </div>

    <div class="review-box">
        <div class="review-name">Amalin</div>
        <div class="review-rating">★★★★★</div>
        <div class="review-comment">
            The drinks were delicious and the vibes were very cozy.
        </div>
        <small>amalin@gmail.com</small>
    </div>

    <div class="review-box">
        <div class="review-name">Zulaika</div>
        <div class="review-rating">★★★★</div>
        <div class="review-comment">
            Great service, but the menu could include more drink options.
        </div>
        <small>zula@gmail.com</small>
    </div>

</div>
</div>

<footer class="site-footer">
    © 2025 Mew & Brew | All Rights Reserved
</footer>

<!-- ===== JAVASCRIPT (IMPORTANT: AT BOTTOM) ===== -->
<script>
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
