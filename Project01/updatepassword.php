<?php
// Include database connection
require 'db.php';  // Make sure this file includes proper PDO connection

// Start session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo 'Error: User not logged in.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Get the logged-in username from session
    $userId = $_SESSION['username']; // assuming the session contains the username

    try {
        // Fetch the current hashed password from the database
        $stmt = $pdo->prepare('SELECT password FROM user_account WHERE id = :user_name');
        $stmt->bindParam(':user_name', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('User not found.');
        }

        // Verify the current password
        if (!password_verify($currentPassword, $user['password'])) {
            throw new Exception('Current password is incorrect.');
        }

        // Validate new password and confirmation
        if ($newPassword !== $confirmPassword) {
            throw new Exception('New password and confirmation do not match.');
        }

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the password in the database
        $updateStmt = $pdo->prepare('UPDATE user_account SET password = :password WHERE user_name = :user_name');
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':user_name', $userId, PDO::PARAM_STR);

        if ($updateStmt->execute()) {
            echo 'Password updated successfully.';
        } else {
            throw new Exception('Failed to update password.');
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
