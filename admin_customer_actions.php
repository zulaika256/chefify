<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    if ($action === 'update_customer') {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $name = trim($_POST['name'] ?? '');
        $role = trim($_POST['role'] ?? '');
        
        if (!$id || $name === '') throw new Exception('Invalid input');
        
        // Validate role if provided
        $allowedDetails = [];
        $sql = "UPDATE users SET fullname = ?";
        $params = [$name];

        if ($role === 'admin' || $role === 'customer') {
            $sql .= ", role = ?";
            $params[] = $role;
        }

        $sql .= " WHERE user_id = ?";
        $params[] = $id;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        echo json_encode(['success' => true, 'message' => 'Customer updated']);
        exit;
    }

    if ($action === 'gift_points') {
        $id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
        $amt = isset($_POST['amount']) ? (int)$_POST['amount'] : 0;
        if (!$id || $amt <= 0) throw new Exception('Invalid input');

        // Optional: log gift - moved BEFORE transaction to avoid implicit commit
        $pdo->exec("CREATE TABLE IF NOT EXISTS admin_point_gifts (
            id INT PRIMARY KEY AUTO_INCREMENT,
            admin_id INT NULL,
            user_id INT NOT NULL,
            amount INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $pdo->beginTransaction();
        // Ensure reward_points row exists
        $stmt = $pdo->prepare("SELECT points, total_points_earned FROM reward_points WHERE user_id = ? FOR UPDATE");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            $newPoints = (int)$row['points'] + $amt;
            $newTotal = (int)$row['total_points_earned'] + $amt;
            $upd = $pdo->prepare("UPDATE reward_points SET points = ?, total_points_earned = ? WHERE user_id = ?");
            $upd->execute([$newPoints, $newTotal, $id]);
        } else {
            $ins = $pdo->prepare("INSERT INTO reward_points (user_id, points, total_points_earned) VALUES (?, ?, ?)");
            $ins->execute([$id, $amt, $amt]);
            $newPoints = $amt;
            $newTotal = $amt;
        }

        $admin_id = $_SESSION['user_id'] ?? null;
        $log = $pdo->prepare("INSERT INTO admin_point_gifts (admin_id, user_id, amount) VALUES (?, ?, ?)");
        $log->execute([$admin_id, $id, $amt]);

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Points gifted', 'points' => $newPoints]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

?>
