<?php
require_once 'db.php';

// Require login to access cart
if (!isset($_SESSION['user_id'])) {
    header("Location: logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart - Chefify</title>
        <link rel="icon" href="img/chefify.jpg" type="image/png">
        <link rel="stylesheet" href="cart.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

<!-- Navigation (original design) -->
<nav>
        <div class="nav-container">
                <a href="homepage.php" class="logo">
                        <img src="img/chefify.jpg" class="logo-img" alt="Chefify">
                        <span class="logo-text">Chefify</span>
                </a>
                <div class="nav-links" role="menu" aria-label="Main links">
                        <a href="homepage.php">Home</a>
                        <a href="menu.php">Menu</a>
                        <a href="cart.php" class="active">Cart</a>
                        <a href="dashboard.php">Dashboard</a>
                        <a href="locations.php">Locations</a>
                        <a href="aboutus.php">About Us</a>
                        <a href="contactus.php">Contact Us</a>
                        <a href="feedback.php">Feedback</a>
                        <a href="profile.php">Profile</a>
                        <a href="login.php">Logout</a>
                </div>
        </div>
</nav>

<!-- CART CONTENT -->
<section class="cart-page">
    <h1>Your Cart</h1>

    <div id="cartItems"></div>

    <div class="cart-summary">
        <span>Total</span>
        <span id="cartTotal">RM 0.00</span>
    </div>

    <div class="payment-section">
        <h3>Payment Method</h3>
        <label class="pay-option">
            <input type="radio" name="payment" value="Cash"> Cash
        </label>
        <label class="pay-option">
            <input type="radio" name="payment" value="Card"> Credit / Debit Card
        </label>
        <label class="pay-option">
            <input type="radio" name="payment" value="E-Wallet"> E-Wallet
        </label>
    </div>

    <button class="checkout-btn" id="checkoutBtn">Place Order</button>
</section>

<!-- MODAL RECEIPT (original simple design) -->
<div class="modal" id="receiptModal">
    <div class="modal-content">
        <h3>Order Receipt</h3>
        <pre id="receiptText"></pre>
        <button class="close-btn" onclick="closeModal()">Close</button>
    </div>
</div>

<!-- FOOTER (unchanged) -->
<footer>
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-logo-section">
                <div class="footer-logo">
                    <img src="img/chefify.jpg" alt="Chefify Logo" onerror="this.src='https://via.placeholder.com/70/4b2e19/FFFFFF?text=C'">
                    <span class="footer-logo-text">Chefify</span>
                </div>
                <p class="footer-tagline">Delicious moments, rewarding experiences. Order now and earn points with every meal!</p>
                <div class="footer-social">
                    <a href="#" class="social-icon"><img src="img/tiktok.png" alt="TikTok"></a>
                    <a href="#" class="social-icon"><img src="img/instagram.webp" alt="Instagram"></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Get in Touch</h3>
                <div class="contact-item"><span class="contact-icon">📍</span><div class="contact-text">Kuala Lumpur, Malaysia</div></div>
                <div class="contact-item"><span class="contact-icon">📧</span><div class="contact-text"><a href="mailto:hello@chefify.com">hello@chefify.com</a></div></div>
                <div class="contact-item"><span class="contact-icon">📱</span><div class="contact-text"><a href="tel:+60123456789">+603-2688 8888</a></div></div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© 2025 Chefify. All rights reserved.</div>
            <ul class="footer-links-inline"><li><a href="privacy.php">Privacy Policy</a></li><li><a href="terms.php">Terms of Service</a></li><li><a href="cookies.php">Cookie Policy</a></li></ul>
        </div>
    </div>
</footer>

<script>
const cartItemsDiv = document.getElementById("cartItems");
const cartTotal = document.getElementById("cartTotal");
const receiptModal = document.getElementById("receiptModal");
const receiptItems = document.getElementById("receiptItems");
const receiptTotal = document.getElementById("receiptTotal");
const receiptPoints = document.getElementById("receiptPoints");
const receiptMethod = document.getElementById("receiptMethod");
const checkoutBtn = document.getElementById('checkoutBtn');

let cart = JSON.parse(localStorage.getItem("chefifyCart")) || [];

function renderCart(){
    if(cart.length === 0){
        cartItemsDiv.innerHTML = `<div class="empty">Your cart is empty. <a href="menu.php">Go to Menu</a></div>`;
        cartTotal.innerText = "RM 0.00";
        return;
    }

    let total = 0;

    cartItemsDiv.innerHTML = cart.map(item=>{
        const price = item.price || item.promo_price || 0;
        const qty = item.qty || item.quantity || 1;
        total += price * qty;
        return `
            <div class="cart-item">
                <strong>${item.name}</strong>
                <div class="cart-controls">
                    <button onclick="updateQty('${item.name}',-1)">−</button>
                    <span>${qty}</span>
                    <button onclick="updateQty('${item.name}',1)">+</button>
                </div>
            </div>
        `;
    }).join("");

    cartTotal.innerText = "RM " + total.toFixed(2);
    localStorage.setItem("chefifyCart", JSON.stringify(cart));
}

function updateQty(name, change){
    const item = cart.find(c=>c.name===name);
    if(!item) return;

    item.qty = (item.qty || item.quantity || 1) + change;
    if(item.qty <= 0){
        cart = cart.filter(c=>c.name!==name);
    }
    renderCart();
}

async function placeOrder(){
    if(cart.length === 0){
        Swal.fire('Empty Cart', 'Add items first!', 'warning');
        return;
    }

    /* 
    if (false) { // Guest check removed
        Swal.fire('Please Login', 'You need to login to place an order', 'warning').then(()=>{ window.location='login.php'; });
        return;
    }
    */

    const payment = document.querySelector('input[name="payment"]:checked');
    if(!payment){
        Swal.fire('Select Payment', 'Please select a payment method', 'info');
        return;
    }

    const items = cart.map(it => ({
        id: it.id || it.menu_id || null,
        quantity: it.qty || it.quantity || 1,
        price: it.price || it.promo_price || 0
    }));

    if (items.some(i => !i.id)) {
        Swal.fire('Invalid Item', 'Some cart items are missing an ID. Add items from the menu page.', 'error');
        return;
    }

    try {
        const res = await fetch('save_order.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ items: items, paymentMethod: payment.value })
        });
        const data = await res.json();

        if (data.success) {
            const sound = document.getElementById("orderSound");
            if (sound) { sound.currentTime = 0; sound.play(); }

            // Build receipt text (keeps original pre-style appearance)
            let receipt = "🧾 Order Receipt\n\n";
            cart.forEach(item => {
                const qty = item.qty || item.quantity || 1;
                const price = (item.promo_price || item.price || 0) * qty;
                receipt += `${qty}x ${item.name} — RM ${price.toFixed(2)}\n`;
            });
            receipt += `\nTotal: RM ${data.totalAmount}\n`;
            receipt += `Payment: ${payment.value}\n`;
            receipt += `Points Earned: ${data.pointsEarned || 0}\n\n`;
            receipt += "Thank you for ordering with Chefify ❤️";

            document.getElementById('receiptText').innerText = receipt;
            receiptModal.style.display = 'flex';

            // Clear cart
            localStorage.removeItem("chefifyCart");
            cart = [];
            renderCart();
        } else {
            Swal.fire('Error', data.message || 'Failed to place order', 'error');
        }
    } catch (err) {
        console.error(err);
        Swal.fire('Error', 'Error placing order. Please try again.', 'error');
    }
}

function closeModal(){
    receiptModal.style.display = "none";
}

renderCart();

checkoutBtn.addEventListener('click', placeOrder);
</script>

<audio id="orderSound" src="img/Ding - Sound Effect (HD).mp3" preload="auto"></audio>

</body>
</html>
