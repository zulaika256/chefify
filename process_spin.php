<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true) ?: [];
$action = $data['action'] ?? $_POST['action'] ?? '';
$spinCost = 30;

try {
    if ($action === 'deduct') {
        // Fetch current points
        $stmt = $pdo->prepare('SELECT points FROM reward_points WHERE user_id = :uid FOR UPDATE');
        $pdo->beginTransaction();
        $stmt->execute([':uid' => $userId]);
        $row = $stmt->fetch();
        $current = $row ? (int)$row['points'] : 0;
        if ($current < $spinCost) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Insufficient points']);
            exit();
        }
        $new = $current - $spinCost;
        $stmt = $pdo->prepare('UPDATE reward_points SET points = :new WHERE user_id = :uid');
        $stmt->execute([':new' => $new, ':uid' => $userId]);
        $pdo->commit();
        echo json_encode(['success' => true, 'points' => $new]);
        exit();
    }

    if ($action === 'award') {
        $prize = $data['prize'] ?? '';
        // Default response
        $awardPoints = 0;
        $voucherCode = null;

        if (stripos($prize, 'Voucher 50%') !== false) {
            $voucher = 50;
        } elseif (stripos($prize, 'Voucher 20%') !== false) {
            $voucher = 20;
        } else {
            $voucher = 0;
        }

        // Some prizes give points
        if (stripos($prize, 'Mystery') !== false) {
            $awardPoints = 100;
        }

        $pdo->beginTransaction();

        if ($awardPoints > 0) {
            // add points
            $stmt = $pdo->prepare("INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (:uid, :pts, :pts) ON DUPLICATE KEY UPDATE points = points + :pts, total_points_earned = total_points_earned + :pts");
            $stmt->execute([':uid' => $userId, ':pts' => $awardPoints]);
        }

        if ($voucher > 0) {
            $code = 'SPIN' . strtoupper(substr(md5(uniqid()), 0, 6));
            $stmt = $pdo->prepare("INSERT INTO user_vouchers (user_id, code, discount_type, discount_value, expiry_date) VALUES (:uid, :code, 'percentage', :val, DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY))");
            $stmt->execute([':uid' => $userId, ':code' => $code, ':val' => $voucher]);
            $voucherCode = $code;
        }

        // Record spin history
        $stmt = $pdo->prepare('INSERT INTO spin_history (user_id, reward_won, points_spent) VALUES (:uid, :reward, :spent)');
        $stmt->execute([':uid' => $userId, ':reward' => $prize, ':spent' => $spinCost]);

        $pdo->commit();

        // Return updated points
        $stmt = $pdo->prepare('SELECT points FROM reward_points WHERE user_id = :uid');
        $stmt->execute([':uid' => $userId]);
        $row = $stmt->fetch();
        $newPoints = $row ? (int)$row['points'] : 0;

        echo json_encode(['success' => true, 'points' => $newPoints, 'awardPoints' => $awardPoints, 'voucher' => $voucherCode]);
        exit();
    }

    echo json_encode(['success' => false, 'message' => 'Invalid action']);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    error_log('process_spin error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}

?>
<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$cost = 30; // Cost per spin

try {
    // 1. Check points
    $stmt = $pdo->prepare("SELECT points FROM reward_points WHERE user_id = :uid");
    $stmt->execute([':uid' => $userId]);
    $res = $stmt->fetch();
    $currentPoints = $res ? $res['points'] : 0;

    if ($currentPoints < $cost) {
        echo json_encode(['success' => false, 'message' => 'Not enough points!']);
        exit();
    }

    // 2. Perform spin logic (Server-side to prevent cheating)
    // Weighted probability could be added here, for now random
    $prizes = [
        "Free Voucher 50%", 
        "Free Tiramisu", 
        "100 Points", 
        "No Luck",
        "Free Drink",
        "Try Again"
    ];
    // Simple random index
    $index = rand(0, count($prizes) - 1);
    $reward = $prizes[$index];
    
    // Calculate final points
    // Deduct cost first
    $newPoints = $currentPoints - $cost;
    
    // If reward is points, add them
    if ($reward == "100 Points") {
        $newPoints += 100;
    }
    
    $pdo->beginTransaction();

    // Update points
    $stmtUpdate = $pdo->prepare("UPDATE reward_points SET points = :p WHERE user_id = :uid");
    $stmtUpdate->execute([':p' => $newPoints, ':uid' => $userId]);

    // Record history
    $stmtHist = $pdo->prepare("INSERT INTO spin_history (user_id, reward_won, points_spent) VALUES (:uid, :rew, :cost)");
    $stmtHist->execute([':uid' => $userId, ':rew' => $reward, ':cost' => $cost]);

    // If reward is a voucher/item
    if (strpos($reward, 'Voucher') !== false || strpos($reward, 'Free') !== false) {
        // Generate code
        $code = 'SPIN' . strtoupper(substr(md5(uniqid()), 0, 6));
        $val = 0; 
        $type = 'fixed'; // Default
        
        if (strpos($reward, '50%') !== false) {
            $type = 'percentage';
            $val = 50.00;
        } else {
            // Free item -> maybe treated as 100% off specific item or fixed value voucher?
            // For simplicity, let's say "Free Drink" is a RM10 voucher
            $type = 'fixed';
            $val = 10.00;
        }

        $stmtVoucher = $pdo->prepare("INSERT INTO user_vouchers (user_id, code, discount_type, discount_value, expiry_date) VALUES (:uid, :mid, :type, :val, DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY))");
        $stmtVoucher->execute([':uid' => $userId, ':mid' => $code, ':type' => $type, ':val' => $val]);
        
        // Append code to reward name for display
        $reward .= " (Code: $code)";
    }

    $pdo->commit();
    
    // Return the result so frontend can animate to it
    // We pass the index so frontend knows where to stop the wheel
    echo json_encode([
        'success' => true, 
        'rewardIndex' => $index, 
        'rewardName' => $reward,
        'newPoints' => $newPoints
    ]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error processing spin']);
}
?>
