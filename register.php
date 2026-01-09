<?php
// --- PHP PROCESSOR ---
$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect data from form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];

    // 2. DATABASE LOGIC (Placeholder)
    // Here is where you would normally run: 
    // $conn->query("INSERT INTO users ...");
    
    // 3. Set success flag to true
    $registration_success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEFIFY - Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="register-container">
    <div class="logo-section">
        <img src="img/logo.png" alt="CHEFIFY Logo">
    </div>

    <h1>Sign Up</h1>
    <p class="subtitle">Join CHEFIFY and start earning rewards!</p>

    <div class="message" id="form-message">
        <?php if ($registration_success): ?>
            Registration Successful! Redirecting to login...
        <?php endif; ?>
    </div>

    <form id="register-form" method="post" action="">
        <div class="form-row">
            <div class="input-wrapper">
                <span class="input-icon">👤</span>
                <input type="text" name="fullname" placeholder="Full Name" required>
            </div>
            <div class="input-wrapper">
                <span class="input-icon">🔖</span>
                <input type="text" name="username" placeholder="Username" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-wrapper">
                <span class="input-icon">📧</span>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="input-wrapper">
                <span class="input-icon">📱</span>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-wrapper password-wrapper">
                <span class="input-icon">🔒</span>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password">👁️</span>
            </div>
            <div class="input-wrapper password-wrapper">
                <span class="input-icon">🔒</span>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <span class="toggle-password">👁️</span>
            </div>
        </div>

        <button type="submit" class="btn-register">Create Account</button>
    </form>

    <div class="form-footer">
        Already have an account? <a href="login.php">Login Here</a>
    </div>
</div>

<script>
// --- REDIRECT LOGIC ---
// If PHP set success to true, show the message and redirect
<?php if ($registration_success): ?>
    const msgBox = document.getElementById('form-message');
    msgBox.className = "message show success";
    
    setTimeout(() => {
        window.location.href = "login.php";
    }, 2500);
<?php endif; ?>

// --- UI LOGIC ---
// Toggle password visibility
const toggleButtons = document.querySelectorAll('.toggle-password');
toggleButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
});

// Password Validation (Client-side)
const registerForm = document.getElementById('register-form');
const messageBox = document.getElementById('form-message');

registerForm.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if(password !== confirmPassword) {
        e.preventDefault(); 
        messageBox.textContent = "Passwords do not match!";
        messageBox.className = "message show error";
    }
});
</script>

</body>
</html>

