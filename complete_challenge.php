<?php
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$input = $_POST;
$challenge_id = isset($input['challenge_id']) ? (int)$input['challenge_id'] : null;
$progress_add = isset($input['progress_add']) ? (int)$input['progress_add'] : 0;
if (!$challenge_id) {
    http_response_code(400);
    echo json_encode(['error' => 'challenge_id required']);
    exit;
}

try {
    // Ensure claimed columns exist (best-effort; ignore failures)
    try {
        $pdo->exec("ALTER TABLE user_challenges ADD COLUMN IF NOT EXISTS claimed TINYINT(1) NOT NULL DEFAULT 0");
        $pdo->exec("ALTER TABLE user_challenges ADD COLUMN IF NOT EXISTS claimed_at DATETIME DEFAULT NULL");
    } catch (Exception $e_al) {
        try {
            $pdo->exec("ALTER TABLE user_challenges ADD COLUMN claimed TINYINT(1) NOT NULL DEFAULT 0");
        } catch (Exception $e2) { /* ignore */ }
        try {
            $pdo->exec("ALTER TABLE user_challenges ADD COLUMN claimed_at DATETIME DEFAULT NULL");
        } catch (Exception $e3) { /* ignore */ }
    }
    // Start transaction
    $pdo->beginTransaction();

    // Get challenge target and reward
    $stmt = $pdo->prepare('SELECT target, reward_points FROM challenges WHERE id = ? FOR UPDATE');
    $stmt->execute([$challenge_id]);
    $challenge = $stmt->fetch();
    if (!$challenge) {
        $pdo->rollBack();
        http_response_code(404);
        echo json_encode(['error' => 'Challenge not found']);
        exit;
    }
    $target = (int)$challenge['target'];
    $reward_points = (int)$challenge['reward_points'];

    // Upsert user_challenges
    $stmt = $pdo->prepare('SELECT progress, completed_at FROM user_challenges WHERE user_id = ? AND challenge_id = ? FOR UPDATE');
    $stmt->execute([$user_id, $challenge_id]);
    $row = $stmt->fetch();

    if ($row) {
        $current_progress = (int)$row['progress'];
        $completed_at = $row['completed_at'];
    } else {
        $current_progress = 0;
        $completed_at = null;
        $stmt = $pdo->prepare('INSERT INTO user_challenges (user_id, challenge_id, progress) VALUES (?, ?, 0)');
        $stmt->execute([$user_id, $challenge_id]);
    }

    if ($completed_at) {
        // already completed
        $pdo->commit();
        echo json_encode(['status' => 'already_completed']);
        exit;
    }

    $new_progress = $current_progress + $progress_add;
    $completed = false;
    if ($new_progress >= $target) {
        $new_progress = $target;
        $completed = true;
    }

    $stmt = $pdo->prepare('UPDATE user_challenges SET progress = ?, completed_at = ? WHERE user_id = ? AND challenge_id = ?');
    $stmt->execute([$new_progress, $completed ? date('Y-m-d H:i:s') : null, $user_id, $challenge_id]);

    if ($completed) {
        // Mark completed but do NOT auto-award points. Points must be claimed by the user.
        // This keeps the UX predictable: completed => claimable
        // Ensure claimed flag is false (it will be 0 by default on insert)
        $stmt = $pdo->prepare('UPDATE user_challenges SET progress = ?, completed_at = ?, claimed = 0, claimed_at = NULL WHERE user_id = ? AND challenge_id = ?');
        $stmt->execute([$new_progress, date('Y-m-d H:i:s'), $user_id, $challenge_id]);
    }

    $pdo->commit();
    echo json_encode(['status' => 'ok', 'completed' => $completed, 'new_progress' => $new_progress, 'awarded_points' => $completed ? $reward_points : 0]);
    exit;
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'server_error', 'message' => $e->getMessage()]);
    exit;
}

?>