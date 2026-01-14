<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$code = $input['code'] ?? '';

if (!$code) {
    echo json_encode(['success' => false, 'message' => 'No code provided']);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM user_vouchers WHERE code = :code AND user_id = :uid");
    $stmt->execute([':code' => $code, ':uid' => $userId]);
    $voucher = $stmt->fetch();

    if (!$voucher) {
        echo json_encode(['success' => false, 'message' => 'Invalid voucher code']);
        exit();
    }

    if ($voucher['status'] == 'used') {
        echo json_encode(['success' => false, 'message' => 'Voucher already used']);
        exit();
    }

    if ($voucher['status'] == 'expired' || strtotime($voucher['expiry_date']) < time()) {
        echo json_encode(['success' => false, 'message' => 'Voucher expired']);
        exit();
    }

    echo json_encode([
        'success' => true,
        'type' => $voucher['discount_type'],
        'value' => (float)$voucher['discount_value']
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error validating']);
}
?>
