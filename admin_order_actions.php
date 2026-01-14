<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    if ($action === 'update_status') {
        $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
        $status = isset($_POST['status']) ? strtolower($_POST['status']) : '';
        if (!$order_id || !in_array($status, ['pending','completed','cancelled'])) throw new Exception('Invalid input');
        $stmt = $pdo->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->execute([$status, $order_id]);
        echo json_encode(['success' => true, 'message' => 'Order status updated']);
        exit;
    }

    if ($action === 'cancel') {
        $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
        $reason = trim($_POST['reason'] ?? '');
        if (!$order_id) throw new Exception('Invalid order id');

        if (!$order_id) throw new Exception('Invalid order id');

        // create table for cancellation reasons if missing (moved outside transaction)
        $pdo->exec("CREATE TABLE IF NOT EXISTS order_cancellations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            order_id INT NOT NULL,
            admin_id INT NULL,
            reason TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $pdo->beginTransaction();
        $stmt = $pdo->prepare("UPDATE orders SET order_status = 'cancelled' WHERE order_id = ?");
        $stmt->execute([$order_id]);

        $admin_id = $_SESSION['user_id'] ?? null;
        $stmt = $pdo->prepare("INSERT INTO order_cancellations (order_id, admin_id, reason) VALUES (?, ?, ?)");
        $stmt->execute([$order_id, $admin_id, $reason]);
        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Order cancelled']);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

?>
