<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = 'localhost';
$db_username = 'root'; // Update with your DB username
$db_password = '';     // Update with your DB password
$database = 'oclock';  // Ensure this matches your database name

// Create connection
$pdo = new mysqli($host, $db_username, $db_password, $database);

// Check connection
if ($pdo->connect_error) {
    die("Database connection failed: " . $pdo->connect_error);
}

// Authentication logic
$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if POST data is being sent
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Use prepared statements to prevent SQL injection
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        if (!$stmt) {
            die("Prepare statement failed: " . $pdo->error); // Debug error
        }

        // Bind parameter and execute
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error); // Debug error
        }

        $result = $stmt->get_result();

        // Check if a record was found
        if ($result && $result->num_rows == 1) {
            $admin = $result->fetch_assoc();

            // Verify password (use plain text for now, replace with password_hash later)
            if ($password === $admin['password']) {
                // Store session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                // Redirect to admin dashboard
                header("Location: ad_board.php");
                exit();
            } else {
                $error_message = "Invalid username or password.";
            }
        } else {
            $error_message = "Invalid username or password.";
        }
        $stmt->close(); // Close statement
    } else {
        $error_message = "Please enter both username and password.";
    }
}
$pdo->close(); // Close database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .login-container button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
