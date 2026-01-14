<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit();
}

$action = $input['action'] ?? '';

try {
    if ($action == 'update_info') {
        $fullname = sanitize($input['fullname']);
        $phone = sanitize($input['phone']);
        
        $stmt = $pdo->prepare("UPDATE users SET fullname = :fn, phone = :ph WHERE user_id = :uid");
        $stmt->execute([':fn' => $fullname, ':ph' => $phone, ':uid' => $userId]);
        
        // Update session
        $_SESSION['fullname'] = $fullname;
        
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);

    } elseif ($action == 'change_password') {
        $current = $input['currentPassword'];
        $new = $input['newPassword'];
        
        // Verify current password
        $stmt = $pdo->prepare("SELECT password FROM users WHERE user_id = :uid");
        $stmt->execute([':uid' => $userId]);
        $user = $stmt->fetch();
        
        if (!password_verify($current, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Current password incorrect']);
            exit();
        }
        
        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :pw WHERE user_id = :uid");
        if (!$stmt->execute([':pw' => $newHash, ':uid' => $userId])) {
            echo json_encode(['success' => false, 'message' => 'DB error']);
            exit();
        }
        
        echo json_encode(['success' => true, 'message' => 'Password changed!']);
    } elseif ($action == 'update_username') {
        $newUsername = sanitize($input['newUsername']);
        
        // Validate username
        if (strlen($newUsername) < 3) {
            echo json_encode(['success' => false, 'message' => 'Username must be at least 3 characters long']);
            exit();
        }
        
        $usernameRegex = '/^[a-zA-Z0-9_]+$/';
        if (!preg_match($usernameRegex, $newUsername)) {
            echo json_encode(['success' => false, 'message' => 'Username can only contain letters, numbers, and underscores']);
            exit();
        }
        
        // Check if username exists
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = :un AND user_id != :uid");
        $stmt->execute([':un' => $newUsername, ':uid' => $userId]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Username already taken']);
            exit();
        }
        
        // Update username
        $stmt = $pdo->prepare("UPDATE users SET username = :un WHERE user_id = :uid");
        if (!$stmt->execute([':un' => $newUsername, ':uid' => $userId])) {
            echo json_encode(['success' => false, 'message' => 'DB error']);
            exit();
        }
        
        // Update session
        $_SESSION['username'] = $newUsername;
        
        echo json_encode(['success' => true, 'message' => 'Username updated!']);

    } elseif ($action == 'update_avatar') {
        $avatar = sanitize($input['avatar']);
        
        // Validate avatar (should be one of the allowed)
        $allowedAvatars = ['img/avatar1.jpg', 'img/avatar2.jpg', 'img/avatar3.jpg', 'img/avatar4.jpg', 'img/avatar5.jpg', 'img/avatar6.jpg'];
        if (!in_array($avatar, $allowedAvatars)) {
            echo json_encode(['success' => false, 'message' => 'Invalid avatar']);
            exit();
        }
        
        // Update avatar
        $stmt = $pdo->prepare("UPDATE users SET avatar = :av WHERE user_id = :uid");
        if (!$stmt->execute([':av' => $avatar, ':uid' => $userId])) {
            echo json_encode(['success' => false, 'message' => 'DB error']);
            exit();
        }
        
        echo json_encode(['success' => true, 'message' => 'Avatar updated!']);

    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
