<?php
require_once 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    if ($action === 'add_item') {
        $name = trim($_POST['name'] ?? '');
        $cat = trim($_POST['cat'] ?? '');
        $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
        $imgPath = '';

        if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fn = uniqid('menu_', true) . '.' . $ext;
            $dest = __DIR__ . '/img/' . $fn;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $dest)) throw new Exception('Failed to save image');
            $imgPath = 'img/' . $fn;
        } else {
            $imgPath = trim($_POST['img'] ?? 'img/default.jpg');
        }

        $stmt = $pdo->prepare("INSERT INTO menu_items (name, category, price, image_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $cat, $price, $imgPath]);
        $id = $pdo->lastInsertId();
        echo json_encode(['success' => true, 'item' => ['id' => (int)$id, 'name'=>$name, 'cat'=>$cat, 'price'=>$price, 'promo'=>null, 'date'=>'', 'img'=>$imgPath]]);
        exit;
    }

    if ($action === 'update_item') {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $price = isset($_POST['price']) ? (float)$_POST['price'] : null;
        if (!$id || $price === null) throw new Exception('Invalid input');
        $stmt = $pdo->prepare("UPDATE menu_items SET price = ?, promo_price = NULL, promo_end_date = NULL WHERE item_id = ?");
        $stmt->execute([$price, $id]);
        echo json_encode(['success'=>true, 'message'=>'Item updated']);
        exit;
    }

    if ($action === 'set_promo') {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $promo = isset($_POST['promo']) ? (float)$_POST['promo'] : null;
        $date = trim($_POST['date'] ?? '');
        if (!$id || $promo === null) throw new Exception('Invalid input');
        $stmt = $pdo->prepare("UPDATE menu_items SET promo_price = ?, promo_end_date = ? WHERE item_id = ?");
        $stmt->execute([$promo, $date ?: null, $id]);
        echo json_encode(['success'=>true, 'message'=>'Promo set']);
        exit;
    }

    echo json_encode(['success'=>false, 'message'=>'Unknown action']);
} catch (Exception $e) {
    echo json_encode(['success'=>false, 'message'=>$e->getMessage()]);
}

?>
