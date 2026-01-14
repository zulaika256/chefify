<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    if ($action == 'add') {
        $itemId = (int)$_POST['menu_id'];
        $qty = (int)$_POST['quantity'];
        
        // Check if exists
        $stmt = $pdo->prepare("SELECT cart_id, quantity FROM cart WHERE user_id = :uid AND menu_id = :mid");
        $stmt->execute([':uid' => $userId, ':mid' => $itemId]);
        $existing = $stmt->fetch();

        if ($existing) {
            $newQty = $existing['quantity'] + $qty;
            $stmt = $pdo->prepare("UPDATE cart SET quantity = :qty WHERE cart_id = :cid");
            $stmt->execute([':qty' => $newQty, ':cid' => $existing['cart_id']]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, menu_id, quantity) VALUES (:uid, :mid, :qty)");
            $stmt->execute([':uid' => $userId, ':mid' => $itemId, ':qty' => $qty]);
        }
        echo json_encode(['success' => true, 'message' => 'Item added to cart']);

    } elseif ($action == 'get') {
        $stmt = $pdo->prepare("
            SELECT c.*, m.name, m.price, m.image_path, m.promo_price 
            FROM cart c 
            JOIN menu_items m ON c.menu_id = m.item_id 
            WHERE c.user_id = :uid
        ");
        $stmt->execute([':uid' => $userId]);
        $items = $stmt->fetchAll();
        echo json_encode(['success' => true, 'cart' => $items]);

    } elseif ($action == 'update_qty') {
        $cartId = (int)$_POST['cart_id'];
        $qty = (int)$_POST['quantity'];
        if ($qty <= 0) {
            $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = :cid AND user_id = :uid");
            $stmt->execute([':cid' => $cartId, ':uid' => $userId]);
        } else {
            $stmt = $pdo->prepare("UPDATE cart SET quantity = :qty WHERE cart_id = :cid AND user_id = :uid");
            $stmt->execute([':qty' => $qty, ':cid' => $cartId, ':uid' => $userId]);
        }
        echo json_encode(['success' => true]);

    } elseif ($action == 'remove') {
        $cartId = (int)$_POST['cart_id'];
        $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = :cid AND user_id = :uid");
        $stmt->execute([':cid' => $cartId, ':uid' => $userId]);
        echo json_encode(['success' => true]);
        
    } elseif ($action == 'clear') {
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :uid");
        $stmt->execute([':uid' => $userId]);
        echo json_encode(['success' => true]);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
