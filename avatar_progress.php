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

if ($action == 'update_avatar') {
    $avatar = sanitize($input['avatar']);
    
    // Validate avatar (should be one of the allowed)
    $allowedAvatars = ['img/avatar1.jpg', 'img/avatar2.jpg', 'img/avatar3.jpg', 'img/avatar4.jpg', 'img/avatar5.jpg', 'img/avatar6.jpg'];
    if (!in_array($avatar, $allowedAvatars)) {
        echo json_encode(['success' => false, 'message' => 'Invalid avatar']);
        exit();
    }
    
    // Update avatar
    $stmt = $pdo->prepare("UPDATE users SET avatar = :av WHERE user_id = :uid");
    try {
        $stmt->execute([':av' => $avatar, ':uid' => $userId]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'DB error: ' . $e->getMessage()]);
        exit();
    }
    
    echo json_encode(['success' => true, 'message' => 'Avatar updated!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>