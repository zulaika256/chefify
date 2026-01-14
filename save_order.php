<?php
require_once 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$items = $input['items'];
$paymentMethod = $input['paymentMethod'];
$voucherCode = $input['voucherCode'] ?? null;
$userId = $_SESSION['user_id'];

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit();
}

try {
    $pdo->beginTransaction();

    // 1. Calculate Total
    $totalAmount = 0;
    foreach ($items as $item) {
        // Fetch price from DB to be safe
        $stmt = $pdo->prepare("SELECT price, promo_price FROM menu_items WHERE item_id = :id");
        $stmt->execute([':id' => $item['id']]);
        $dbItem = $stmt->fetch();
        
        if ($dbItem) {
            $price = $dbItem['promo_price'] ? $dbItem['promo_price'] : $dbItem['price'];
            $totalAmount += $price * $item['quantity'];
        }
    }

    // 2. Add Tax (6%)
    $tax = $totalAmount * 0.06;
    $grandTotal = $totalAmount + $tax;

    // 3. Apply Voucher if exists
    if ($voucherCode) {
        $stmtV = $pdo->prepare("SELECT * FROM user_vouchers WHERE code = :code AND user_id = :uid AND status = 'active'");
        $stmtV->execute([':code' => $voucherCode, ':uid' => $userId]);
        $voucher = $stmtV->fetch();

        if ($voucher) {
            if ($voucher['expiry_date'] >= date('Y-m-d')) {
                $discount = 0;
                if ($voucher['discount_type'] == 'percentage') {
                    $discount = $grandTotal * ($voucher['discount_value'] / 100);
                } else {
                    $discount = $voucher['discount_value'];
                }
                
                $grandTotal -= $discount;
                if ($grandTotal < 0) $grandTotal = 0;

                // Mark voucher as used
                $stmtUpdateV = $pdo->prepare("UPDATE user_vouchers SET status = 'used' WHERE voucher_id = :vid");
                $stmtUpdateV->execute([':vid' => $voucher['voucher_id']]);
            }
        }
    }

    // 4. Insert Order
    $stmtOrder = $pdo->prepare("INSERT INTO orders (user_id, total_amount, payment_method, order_status) VALUES (:uid, :total, :pay, 'pending')");
    $stmtOrder->execute([
        ':uid' => $userId,
        ':total' => $grandTotal,
        ':pay' => $paymentMethod
    ]);
    $orderId = $pdo->lastInsertId();

    // 5. Insert Order Items
    $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, item_id, quantity, price_at_purchase) VALUES (:oid, :iid, :qty, :price)");
    foreach ($items as $item) {
         // Fetch price again or use from loop (should be safe to reuse logic if optimized, but for now just basic)
         // For simplicity, we trust the ID passed exists as we checked above.
         // We need the specific price again.
         $stmtPrice = $pdo->prepare("SELECT price, promo_price FROM menu_items WHERE item_id = :id");
         $stmtPrice->execute([':id' => $item['id']]);
         $pItem = $stmtPrice->fetch();
         $finalPrice = $pItem['promo_price'] ? $pItem['promo_price'] : $pItem['price'];

         $stmtItem->execute([
             ':oid' => $orderId,
             ':iid' => $item['id'],
             ':qty' => $item['quantity'],
             ':price' => $finalPrice
         ]);
    }

    // 6. Award Points (based on floor of grand total)
    $pointsEarned = floor($grandTotal);
    if ($pointsEarned > 0) {
        $stmtPoint = $pdo->prepare("INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (:uid, :pts, :pts) ON DUPLICATE KEY UPDATE points = points + :pts, total_points_earned = total_points_earned + :pts");
        $stmtPoint->execute([':uid' => $userId, ':pts' => $pointsEarned]);
    }

    // 7. Update User Progress
    $stmtProg = $pdo->prepare("INSERT INTO user_progress (user_id, total_orders, total_spent) VALUES (:uid, 1, :spent) ON DUPLICATE KEY UPDATE total_orders = total_orders + 1, total_spent = total_spent + :spent");
    $stmtProg->execute([':uid' => $userId, ':spent' => $grandTotal]);

    $pdo->commit();

    echo json_encode([
        'success' => true, 
        'message' => 'Order placed successfully!',
        'orderId' => $orderId,
        'totalAmount' => number_format($grandTotal, 2),
        'pointsEarned' => $pointsEarned
    ]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error processing order: ' . $e->getMessage()]);
}
?>
