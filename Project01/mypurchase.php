<?php
// Start session to access user data
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';
// Fetch orders for the logged-in user
$userId = $_SESSION['user_id']; // Assuming user_id is stored in session

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute([':user_id' => $userId]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchase</title>
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
            padding: 5px; /* Increased padding to ensure space */
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex-wrap: nowrap; /* Ensures items stay on one line */
        }

        /* Logo */
        .navbar img {
            width: 120px;
            height: auto;
            border: none;
            outline: none;
        }

        /* Links in Navbar */
        .navbar div {
            display: flex;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: black;
            font-size: 16px;
            padding: 5px 15px; /* Increased padding for better visibility */
            margin-left: 20px;
            white-space: nowrap; /* Prevent text from wrapping */
        }

        /* Specific styles for About Us button */
        .about-us-button {
            border: 2px solid black;
            border-radius: 4px;
            position: relative;
            right: 50px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover effects for About Us button */
        .about-us-button:hover {
            background-color: black;
            color: white;
        }

        /* Container */
        .container {
            display: flex;
            margin-top: 70px; /* Ensure content is pushed below the fixed navbar */
            height: calc(100vh - 70px);
        }

        /* Sidebar */
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

        /* Content */
        .content {
            width: 75%;
            padding: 40px 20px;
        }

        .content h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Order Status Tabs */
        /* Order Status Tabs */
        .order-status-tabs {
            display: flex;
            justify-content: space-around;
            border-bottom: 2px solid #ddd;
            margin-bottom: 30px;
        }

        .order-status-tabs a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            padding: 10px 15px;
            transition: border-bottom 0.3s ease, color 0.3s ease;
        }

        .order-status-tabs a:hover {
            color: #333;
            border-bottom: 2px solid #333; /* Underline on hover */
        }

        .order-status-tabs .active {
            border-bottom: 2px solid #333; /* Underline for the active tab */
            color: #333;
        }


        /* Purchase details */
        .purchase-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .purchase-details .product-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .purchase-details .product-info img {
            width: 120px;
            height: auto;
            margin-right: 20px;
        }

        .purchase-details .product-info .details {
            display: flex;
            flex-direction: column;
        }

        .purchase-details .product-info .details h3 {
            margin: 0;
            font-size: 18px;
        }

        .purchase-details .product-info .details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .purchase-details .order-summary {
            margin-top: 20px;
        }

        .purchase-details .order-summary p {
            font-size: 16px;
            margin: 5px 0;
        }

        .btn-buy-again {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 15px;
        }

        .btn-buy-again:hover {
            background-color: #555;
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

        <!-- Main Content -->
        <div class="content">
            <h1>My Purchase</h1>

            <!-- Purchase Details -->
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="purchase-details">
                        <div class="details">
                            <h3>Order #<?= htmlspecialchars($order['id']); ?></h3>
                            <p><strong>Order Total:</strong> ₱<?= number_format($order['total_price'], 2); ?></p>
                            <p><strong>Status:</strong> <span style="color: green;"><?= htmlspecialchars($order['status']); ?></span></p>
                            <p><strong>Order Date:</strong> <?= (new DateTime($order['created_at']))->format('F j, Y'); ?></p>
                            <p><strong>Product Name:</strong> <?= htmlspecialchars($order['items_summary']); ?></p>
                            <p><strong>Quantity:</strong> <?= htmlspecialchars($order['total_items']); ?></p>
                        </div>
                        <h2>            ----------------------------------------------------------------------------------------------------------------</h2>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Get all the order status tabs (optional functionality)
        const tabs = document.querySelectorAll('.order-status-tabs a');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(tab => tab.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>