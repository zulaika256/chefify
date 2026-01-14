<?php
require_once 'db.php';

$tables = ['cart', 'user_vouchers'];
$missing = [];

foreach ($tables as $table) {
    try {
        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
        echo "$table exists.\n";
    } catch (Exception $e) {
        echo "$table DOES NOT EXIST.\n";
        $missing[] = $table;
    }
}
?>
