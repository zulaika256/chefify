<?php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server first (without database)
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to MySQL server successfully.<br>";
    
    // Read SQL file
    $sql = file_get_contents('chefify.sql');
    
    // Execute SQL commands
    // Note: This simplistic approach works for this specific SQL file but might fail 
    // if there are complex delimiters. For this file, it's fine.
    $pdo->exec($sql);
    
    echo "Database 'chefify' created/updated and tables setup successfully.<br>";
    echo "Menu items and default data inserted.<br>";
    echo "<br><b>Status: Ready to use!</b>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
