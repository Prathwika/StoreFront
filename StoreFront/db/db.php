<?php
$host = 'localhost'; // Your database host (usually localhost)
$dbname = 'performance_wear_store'; // Database name
$username = 'root'; // Your MySQL username
$password = '123456789'; // Your MySQL password (empty for XAMPP or default setup)

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // For testing the connection
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
