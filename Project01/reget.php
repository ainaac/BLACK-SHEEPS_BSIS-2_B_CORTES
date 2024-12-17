<?php
// Include database connection
require 'db.php'; // Replace with your actual database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input
    $first_name = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $address = trim($_POST['address']);
    $zip_code = trim($_POST['zip_code']);
    
    // Validate password match
    if ($password !== $confirm_password) {
        die('Passwords do not match.');
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    try {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT * FROM user_account WHERE user_name = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            die('Username or email already exists. Please choose another.');
        }
        
        // Insert user data into database
        $stmt = $pdo->prepare("INSERT INTO user_account (first_name, middle_name, last_name, user_name, email, password, address, zip_code) 
                                VALUES (:first_name, :middle_name, :last_name, :username, :email, :password, :address, :zip_code)");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':zip_code', $zip_code);
        $stmt->execute();
        
        echo 'Registration successful. <a href="index.php">Login here</a>';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
