<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$rewardId = $input['rewardId'] ?? null;
$cost = (int)($input['cost'] ?? 0);
$userId = $_SESSION['user_id'];

if (!$rewardId || $cost <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

try {
    $pdo->beginTransaction();

    // Check current points
    $stmt = $pdo->prepare("SELECT points FROM reward_points WHERE user_id = :uid FOR UPDATE");
    $stmt->execute([':uid' => $userId]);
    $r = $stmt->fetch();
    $points = $r ? (int)$r['points'] : 0;

    if ($points < $cost) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Not enough points']);
        exit();
    }

    // Deduct points
    $stmt = $pdo->prepare("UPDATE reward_points SET points = points - :cost WHERE user_id = :uid");
    $stmt->execute([':cost' => $cost, ':uid' => $userId]);

    // Generate voucher code and insert a simple voucher record
    $code = strtoupper($rewardId . '-' . substr(md5(uniqid()),0,6));
    $stmt = $pdo->prepare("INSERT INTO user_vouchers (user_id, code, discount_type, discount_value, status, created_at) VALUES (:uid, :code, 'fixed', :value, 'active', NOW())");
    // Set a placeholder discount_value based on cost (e.g., cost/10)
    $discountValue = max(1, round($cost / 10, 2));
    $stmt->execute([':uid' => $userId, ':code' => $code, ':value' => $discountValue]);

    $pdo->commit();

    // Return updated points
    echo json_encode(['success' => true, 'newPoints' => $points - $cost, 'code' => $code]);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    error_log('Claim reward error: '.$e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}

?>
