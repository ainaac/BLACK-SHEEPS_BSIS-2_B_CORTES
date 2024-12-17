<?php
// Database connection settings
try {
    $host = 'localhost'; // Replace with your database host
    $dbname = 'oclock'; // Replace with your database name
    $username = 'root'; // Replace with your database username
    $password = ''; // Replace with your database password

    // Initialize PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
