<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.3/dist/sweetalert2.all.min.js"></script>
</head>

<?php
require 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs from the login form
    $user_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    try {
        // Get user record from database by user_name
        $stmt = $pdo->prepare("SELECT * FROM user_account WHERE user_name = :user_name");
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check if password matches using password_verify
            if (password_verify($password, $user['password'])) { // Secure password validation
                // Start the session and store user info
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['user_name'];

                // Redirect to homepage
                header("Location: homepage.php");
                exit(); // Always call exit after redirect
            } else {
                echo "Incorrect password.";
            }
        } else {
            // User not found
            echo "No user found with that username.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
