<?php
require_once 'db.php';

// Check if POST data exists
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];

    try {
        // Allow case-insensitive username lookup and login by email
        $stmt = $pdo->prepare("SELECT user_id, username, fullname, role, account_status, password FROM users WHERE LOWER(username) = LOWER(:username) OR email = :email LIMIT 1");
        $stmt->execute([':username' => $username, ':email' => $username]);
        $user = $stmt->fetch();

        if (!$user) {
            // On localhost provide a hint to help debugging
            if (stripos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                // list admin usernames (no sensitive data)
                try {
                    $admins = $pdo->query("SELECT username FROM users WHERE role='admin'")->fetchAll(PDO::FETCH_COLUMN);
                    $hint = $admins ? ' Available admin accounts: ' . implode(', ', $admins) : '';
                } catch (Exception $e) { $hint = ''; }
                $_SESSION['error'] = "Invalid username or password." . $hint;
            } else {
                $_SESSION['error'] = "Invalid username or password";
            }
            header("Location: login.php");
            exit();
        }

        if (!password_verify($password, $user['password'])) {
            // Allow developer fallback on localhost to recover admin access
            $isLocal = (stripos($_SERVER['HTTP_HOST'], 'localhost') !== false) || php_sapi_name() === 'cli';
            if ($isLocal && strtolower($user['username']) === 'admin' && $password === 'admin123') {
                // Update stored password to the expected hash and continue login
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                try {
                    $up = $pdo->prepare("UPDATE users SET password = :pw, account_status='active' WHERE user_id = :uid");
                    $up->execute([':pw' => $newHash, ':uid' => $user['user_id']]);
                    // proceed as authenticated
                } catch (Exception $e) {
                    $_SESSION['error'] = 'Failed to reset admin password. ' . $e->getMessage();
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Invalid username or password";
                header("Location: login.php");
                exit();
            }
        }

        if ($user['account_status'] != 'active') {
            $_SESSION['error'] = "Your account has been suspended. Please contact support.";
            header("Location: login.php");
            exit();
        }

        // Store session data safely
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        // Update last login
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :uid");
        $stmt->execute([':uid' => $user['user_id']]);

        // Redirect
        if ($user['role'] == 'customer') {
            header("Location: homepage.php");
            exit();
        } else {
            header("Location: admin_dashboard.php");
            exit();
        }
    } catch (Exception $e) {
        error_log('Login error: ' . $e->getMessage());
        $_SESSION['error'] = "Login failed. Please try again later.";
        header("Location: login.php");
        exit();
    }

} else {
    $_SESSION['error'] = "Please enter both username and password";
    header("Location: login.php");
    exit();
}
?>
