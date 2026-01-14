<?php
// Database configuration
$host = 'localhost';
$dbname = 'chefify';
$username = 'root'; // Default XAMPP username
$password = '';     // Default XAMPP password (empty)

try {
    // Try to connect to the named database first
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // If the database doesn't exist, attempt to create it from chefify.sql
    $msg = $e->getMessage();
    if (stripos($msg, 'Unknown database') !== false || stripos($msg, "1049") !== false) {
        try {
            // Connect without database
            $pdo = new PDO("mysql:host=$host", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Load and execute SQL file to create database and tables
            $sqlFile = __DIR__ . '/chefify.sql';
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                // Execute the full SQL script
                $pdo->exec($sql);
            } else {
                die("Database '" . $dbname . "' does not exist and chefify.sql not found.");
            }

            // Reconnect to the newly created database
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e2) {
            die("Failed to create or connect to database: " . $e2->getMessage());
        }
    } else {
        die("Connection failed: " . $e->getMessage());
    }
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Sanitize input data
 * @param string $data
 * @return string
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
