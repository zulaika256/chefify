<?php
session_start();
require_once 'config.php';

$registration_success = false;
$error_message = "";

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fullname = sanitize($_POST['fullname']);
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($fullname) || empty($username) || empty($email) || empty($phone) || empty($password)) {
        $error_message = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters!";
    } else {
        // Check if username already exists
        $check_username = "SELECT user_id FROM users WHERE username = '$username'";
        $result = executeQuery($check_username);
        
        if ($result && $result->num_rows > 0) {
            $error_message = "Username already exists!";
        } else {
            // Check if email already exists
            $check_email = "SELECT user_id FROM users WHERE email = '$email'";
            $result = executeQuery($check_email);
            
            if ($result && $result->num_rows > 0) {
                $error_message = "Email already registered!";
            } else {
                // Hash password using bcrypt
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert user
                $insert_user = "INSERT INTO users (fullname, username, email, phone, password, role, account_status) 
                                VALUES ('$fullname', '$username', '$email', '$phone', '$hashedPassword', 'customer', 'active')";
                
                if (executeUpdate($insert_user)) {
                    $user_id = getLastInsertID();
                    
                    // Create reward points entry for new user
                    $insert_points = "INSERT INTO reward_points (user_id, points, total_points_earned) 
                                      VALUES ($user_id, 0, 0)";
                    executeUpdate($insert_points);
                    
                    // Create progress entry for new user
                    $insert_progress = "INSERT INTO user_progress (user_id, current_level, total_orders, total_spent) 
                                        VALUES ($user_id, 1, 0, 0)";
                    executeUpdate($insert_progress);
                    
                    $registration_success = true;
                } else {
                    $error_message = "Registration failed! Please try again.";
                }
            }
        }
    }
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
        <?php 
        if ($registration_success): ?>
            ✓ Registration Successful! Redirecting to login...
        <?php 
        elseif ($error_message): ?>
            <span style="color: #DC143C;"><?php echo $error_message; ?></span>
        <?php 
        endif; 
        ?>
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

