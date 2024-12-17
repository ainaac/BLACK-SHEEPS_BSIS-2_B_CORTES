<?php
session_start();

// Ensure the user is logged in
if (empty($_SESSION['user_id'])) {
    echo "<p>You must be logged in to view your orders.</p>";
    exit;
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Connect to the database
require 'db.php';

// Fetch order details from the database
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute([':user_id' => $userId]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders - O'Clocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('check.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Cambria', serif;
        }
        .order-table th, .order-table td {
            padding: 10px;
            text-align: center;
        }
        .order-table th {
            background-color: #f8f9fa;
        }
        .order-summary {
            background-color: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #000;
            border-color: #000;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
        .logo {
            width: 150px;
            height: auto;
            margin-top: 20px;
        }
        .header-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .orders-header {
            font-size: 2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-container">
        <div>
            <a href="homepage.php">
                <img src="oclocks.png" alt="O'Clocks Logo" class="logo">
            </a>
        </div>
        <div class="orders-header">
            <h2>Your Orders</h2>
        </div>
    </div>

    <?php foreach ($orders as $order): ?>
        <div class="order-summary">
            <h4>Order #<?= htmlspecialchars($order['id']); ?></h4>
            <p><strong>Date:</strong> <?= (new DateTime($order['created_at']))->format('F j, Y'); ?></p>

            <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order['address']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($order['email']); ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']); ?></p>
            <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']); ?></p>
            <p><strong>Total Price:</strong> <?= number_format($order['total_price'], 2); ?> PHP</p>
            <p><strong>Total Items:</strong> <?= htmlspecialchars($order['total_items']); ?></p>

            <h5>Items:</h5>
            <table class="table table-bordered order-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch the order items from the order_items table
                    $stmt = $pdo->prepare("SELECT oi.product_id, oi.quantity, oi.price, p.name 
                                           FROM order_items oi 
                                           JOIN products p ON oi.product_id = p.id 
                                           WHERE oi.order_id = :order_id");
                    $stmt->execute([':order_id' => $order['id']]);
                    $orderItems = $stmt->fetchAll();

                    foreach ($orderItems as $item):
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']); ?></td>
                            <td><?= number_format($item['price'], 2); ?> PHP</td>
                            <td><?= $item['quantity']; ?></td>
                            <td><?= number_format($item['price'] * $item['quantity'], 2); ?> PHP</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
      <!-- Return to Home Button -->
      <div class="text-center mt-4">
        <a href="homepage.php" class="btn btn-secondary btn-small">Return to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
