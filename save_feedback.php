<?php
require_once 'db.php';
header('Content-Type: application/json');

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $rating = (int)$_POST['rating'];
    $comment = sanitize($_POST['comment']);

    if (!$name || !$email || !$comment || $rating < 1 || $rating > 5) {
        echo json_encode(['success' => false, 'message' => 'Please fill all fields correctly']);
        exit();
    }

    try {
        $pdo->beginTransaction();

        // 1. Save feedback
        $stmt = $pdo->prepare("INSERT INTO feedback (user_id, name, email, rating, comment) VALUES (:uid, :nm, :em, :rt, :cm)");
        $stmt->execute([
            ':uid' => $userId,
            ':nm' => $name,
            ':em' => $email,
            ':rt' => $rating,
            ':cm' => $comment
        ]);

        // 2. Award points if user is logged in
        if ($userId) {
            $pointsAwarded = 5;
            $stmtPts = $pdo->prepare("INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (:uid, :pts, :pts) ON DUPLICATE KEY UPDATE points = points + :pts, total_points_earned = total_points_earned + :pts");
            $stmtPts->execute([':uid' => $userId, ':pts' => $pointsAwarded]);
        }

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Feedback submitted! You earned 5 points.']);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
