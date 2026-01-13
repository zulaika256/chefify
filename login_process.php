<?php
session_start();
require_once 'config.php';

// Check if POST data exists
if (isset($_POST['username']) && isset($_POST['password'])) {
    
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    
    // Query to get user from database (including password for verification)
    $query = "SELECT user_id, username, fullname, role, account_status, password FROM users 
              WHERE username = '$username'";
    
    $result = executeQuery($query);
    
    if (!$result || $result->num_rows == 0) {
        $_SESSION['error'] = "Invalid username or password";
        header("Location: login.php");
        exit();
    } else {
        $user = $result->fetch_assoc();
        
        // Verify password using password_verify()
        if (!password_verify($password, $user['password'])) {
            $_SESSION['error'] = "Invalid username or password";
            header("Location: login.php");
            exit();
        }
        
        // Check if account is active
        if ($user['account_status'] != 'active') {
            $_SESSION['error'] = "Your account has been suspended. Please contact support.";
            header("Location: login.php");
            exit();
        }
        
        // Store session data
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];
        
        // Update last login time
        $update_query = "UPDATE users SET last_login = NOW() WHERE user_id = " . $user['user_id'];
        executeUpdate($update_query);
        
        // Redirect based on role
        if ($user['role'] == 'customer') {
            header("Location: homepage.php");
            exit();
        } elseif ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        }
    }
} else {
    $_SESSION['error'] = "Please enter both username and password";
    header("Location: login.php");
    exit();
}
?>
