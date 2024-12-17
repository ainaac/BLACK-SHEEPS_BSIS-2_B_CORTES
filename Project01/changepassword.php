<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Include the database connection
include 'db.php';

$username = $_SESSION['username'];
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $message = 'All fields are required.';
    } elseif ($new_password !== $confirm_password) {
        $message = 'New password and confirmation password do not match.';
    } else {
        // Fetch the current password hash from the database
        $query = "SELECT password FROM user_account WHERE user_name = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the current password
            if (password_verify($current_password, $user['password'])) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_query = "UPDATE user_account SET password = :password WHERE user_name = :username";
                $update_stmt = $pdo->prepare($update_query);
                $update_stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                $update_stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $update_stmt->execute();

                $message = 'Password successfully updated.';
            } else {
                $message = 'Current password is incorrect.';
            }
        } else {
            $message = 'User not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        /* General Styles */
        body {
            font-family: Cambria, serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Navigation Bar */
        .navbar {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex-wrap: nowrap;
        }

        .navbar img {
            width: 120px;
            height: auto;
            border: none;
            outline: none;
        }

        .navbar div {
            display: flex;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: black;
            font-size: 16px;
            padding: 5px 15px;
            margin-left: 20px;
            white-space: nowrap;
        }

        .about-us-button {
            border: 2px solid black;
            border-radius: 4px;
            position: relative;
            right: 50px;
            transition: background-color 0.3s, color 0.3s;
        }

        .about-us-button:hover {
            background-color: black;
            color: white;
        }

        /* Main Container */
        .container {
            display: flex;
            margin-top: 70px;
            height: calc(100vh - 70px);
        }

        .sidebar {
            width: 25%;
            background-color: white;
            padding: 20px;
            border-right: 1px solid #ddd;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            font-size: 16px;
            display: block;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #333;
            color: white;
        }

        .content {
            width: 75%;
            padding: 40px 20px;
        }

        .content h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            max-width: 600px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-save {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-save:hover {
            background-color: #555;
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="homepage.php">
            <img src="oclocks.png" alt="O'Clocks Logo">
        </a>
        <div>
            <a href="aboutus.php" class="about-us-button">About Us</a>
        </div>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="myprofile.php">Profile</a></li>
                <li><a href="mypurchase.php">My Purchases</a></li>
                <li><a href="changepassword.php">Change Password</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Change Password</h1>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn-save">Update Password</button>
            </form>
            <?php if ($message): ?>
                <div class="message"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
