<?php
require_once 'db.php';

header('Content-Type: application/json');

// Check admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

$action = $_POST['action'] ?? '';

try {
    if ($action == 'add') {
        $name = sanitize($_POST['name']);
        $category = sanitize($_POST['category']);
        $price = (float)$_POST['price'];
        $image = 'img/placeholder.jpg'; // Default

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "img/";
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            }
        }

        $stmt = $pdo->prepare("INSERT INTO menu_items (name, category, price, image_path, description) VALUES (:name, :cat, :price, :img, :desc)");
        $stmt->execute([
            ':name' => $name,
            ':cat' => $category,
            ':price' => $price,
            ':img' => $image,
            ':desc' => 'Freshly prepared ' . $name
        ]);

        echo json_encode(['success' => true, 'message' => 'Menu item added successfully']);

    } elseif ($action == 'update') {
        $id = (int)$_POST['id'];
        $type = $_POST['type']; // 'price' or 'promo'
        $value = (float)$_POST['value'];
        
        if ($type == 'price') {
            $stmt = $pdo->prepare("UPDATE menu_items SET price = :val, promo_price = NULL WHERE item_id = :id");
            $stmt->execute([':val' => $value, ':id' => $id]);
        } elseif ($type == 'promo') {
            $date = $_POST['date'] ?? null;
            $stmt = $pdo->prepare("UPDATE menu_items SET promo_price = :val, promo_end_date = :date WHERE item_id = :id");
            $stmt->execute([':val' => $value, ':date' => $date, ':id' => $id]);
        }

        echo json_encode(['success' => true, 'message' => 'Menu item updated successfully']);

    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
