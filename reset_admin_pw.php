<?php
// Local helper: reset admin password to 'admin123'.
// ONLY use on local/dev. Delete this file after use.
require_once 'db.php';
if (php_sapi_name() !== 'cli' && stripos($_SERVER['HTTP_HOST'], 'localhost') === false) {
    die('This script can only be run on localhost for safety.');
}
$new = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE users SET password = :pw, account_status='active' WHERE username = 'admin'");
$stmt->execute([':pw' => $new]);
echo "Admin password reset to 'admin123'.\n";
?>
