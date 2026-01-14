<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$moves = $input['moves'] ?? 0;
$timeTaken = $input['time_taken'] ?? 0;

$pointsAwarded = 50; // Base points for winning

try {
    $pdo->beginTransaction();

    // 1. Update points
    $stmt = $pdo->prepare("INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (:uid, :pts, :pts) ON DUPLICATE KEY UPDATE points = points + :pts, total_points_earned = total_points_earned + :pts");
    $stmt->execute([':uid' => $userId, ':pts' => $pointsAwarded]);

    // 2. Record history — use existing schema (game_type, score, reward_won)
    $stmtHist = $pdo->prepare("INSERT INTO game_history (user_id, game_type, score, reward_won) VALUES (:uid, :game_type, :score, :reward)");
    $stmtHist->execute([
        ':uid' => $userId,
        ':game_type' => 'Memory Game',
        ':score' => intval($moves),
        ':reward' => $pointsAwarded
    ]);

    // 3. Generate Voucher for Game Win
    // Logic from frontend was: <=12 moves = 20%, <=15 = 15%, else 10%
    $discountVal = 10;
    if ($moves <= 12) $discountVal = 20;
    elseif ($moves <= 15) $discountVal = 15;

    $code = 'GAME' . strtoupper(substr(md5(uniqid()), 0, 6));
    $stmtVoucher = $pdo->prepare("INSERT INTO user_vouchers (user_id, code, discount_type, discount_value, expiry_date) VALUES (:uid, :code, 'percentage', :val, DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY))");
    $stmtVoucher->execute([':uid' => $userId, ':code' => $code, ':val' => $discountVal]);

    $pdo->commit();
    echo json_encode(['success' => true, 'points' => $pointsAwarded, 'code' => $code, 'discount' => $discountVal]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error saving progress']);
}
?>
