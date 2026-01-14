<?php
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$challenge_id = isset($_POST['challenge_id']) ? (int)$_POST['challenge_id'] : null;
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
        try { $pdo->exec("ALTER TABLE user_challenges ADD COLUMN claimed TINYINT(1) NOT NULL DEFAULT 0"); } catch (Exception $e2) { }
        try { $pdo->exec("ALTER TABLE user_challenges ADD COLUMN claimed_at DATETIME DEFAULT NULL"); } catch (Exception $e3) { }
    }

    $pdo->beginTransaction();

    // Lock the user_challenges row
    $stmt = $pdo->prepare('SELECT progress, completed_at, claimed FROM user_challenges WHERE user_id = ? AND challenge_id = ? FOR UPDATE');
    $stmt->execute([$user_id, $challenge_id]);
    $uc = $stmt->fetch();
    if (!$uc || !$uc['completed_at']) {
        $pdo->rollBack();
        http_response_code(400);
        echo json_encode(['error' => 'Challenge not completed']);
        exit;
    }
    if (!empty($uc['claimed'])) {
        $pdo->commit();
        echo json_encode(['status' => 'already_claimed', 'awarded_points' => 0]);
        exit;
    }

    // Get reward points for the challenge
    $stmt = $pdo->prepare('SELECT reward_points FROM challenges WHERE id = ? FOR UPDATE');
    $stmt->execute([$challenge_id]);
    $c = $stmt->fetch();
    if (!$c) {
        $pdo->rollBack();
        http_response_code(404);
        echo json_encode(['error' => 'Challenge not found']);
        exit;
    }
    $reward = (int)$c['reward_points'];

    // Award points atomically to reward_points table
    if ($reward > 0) {
        $stmt = $pdo->prepare('SELECT points FROM reward_points WHERE user_id = ? FOR UPDATE');
        $stmt->execute([$user_id]);
        $rp = $stmt->fetchColumn();
        if ($rp === false) {
            $stmt = $pdo->prepare('INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (?, ?, ?)');
            $stmt->execute([$user_id, $reward, $reward]);
        } else {
            $newPoints = (int)$rp + $reward;
            $stmt = $pdo->prepare('UPDATE reward_points SET points = ?, total_points_earned = COALESCE(total_points_earned,0) + ? WHERE user_id = ?');
            $stmt->execute([$newPoints, $reward, $user_id]);
        }
    }

    // Mark as claimed
    $stmt = $pdo->prepare('UPDATE user_challenges SET claimed = 1, claimed_at = ? WHERE user_id = ? AND challenge_id = ?');
    $stmt->execute([date('Y-m-d H:i:s'), $user_id, $challenge_id]);

    $pdo->commit();
    echo json_encode(['status' => 'ok', 'awarded_points' => $reward]);
    exit;
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'server_error', 'message' => $e->getMessage()]);
    exit;
}

?>
