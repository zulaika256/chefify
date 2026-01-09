<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEFIFY - Login</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="login.css">   
</head>
<body>

<!-- Top Logo -->
<div class="top-logo">
    <img src="img/logo.png" alt="CHEFIFY Logo">
</div>

<div class="login-wrapper">
    <!-- Left side - Visual with Video -->
    <div class="visual-section">
        <video src="video/opening.MOV" autoplay loop muted playsinline></video>
    </div>

    <!-- Right side - Form -->
    <div class="form-section">
        <div class="form-container">
            <!-- Logo -->
            <div class="logo-section">
                <img src="img/logo.png" alt="CHEFIFY Logo">
            </div>

            <h1>Login</h1>
            <p class="subtitle" id="welcome-text">Welcome back to CHEFIFY</p>

            <!-- Error message -->
            <?php
            if(isset($_SESSION['error'])){
                echo '<div class="error-message show">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }
            ?>

            <!-- Login form -->
            <form class="login-form" name="login" method="post" action="login_process.php">
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>

                <div class="input-wrapper password-wrapper">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="toggle-password" id="toggle-password">👁️</span>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <!-- Footer -->
            <div class="form-footer">
                <a href="homepage.php">Login as guest</a><br> 
                Don't have an account? <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
const togglePassword = document.getElementById('toggle-password');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
});
</script>

</body>
</html>
