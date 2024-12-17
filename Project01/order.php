<?php
session_start();

// Check if the cart is empty or if the order has not been placed
if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty. Please add some items to the cart.</p>";
    exit;
}

// Check if the order has been placed, if not, redirect to checkout
if (!isset($_SESSION['order_details'])) {
    header("Location: checkout.php");
    exit;
}

// Retrieve order details
$order_details = $_SESSION['order_details']; // This array will contain the user's data and the order details

// Get cart details
$cart = $_SESSION['cart'];

// Clear the cart and order details after the order is placed (optional)
unset($_SESSION['cart']);
unset($_SESSION['order_details']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - O'Clocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('check.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Cambria', serif;
        }
        .confirmation-container {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo {
            width: 150px;
            height: auto;
            margin-top: 20px;
        }
        .header-container {
            text-align: center;
        }
        .order-summary {
            margin-top: 20px;
        }
        .order-summary th, .order-summary td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header with Logo and Order Confirmation Text -->
    <div class="header-container">
        <img src="oclocks.png" alt="O'Clocks Logo" class="logo">
        <h2>Order Confirmation</h2>
    </div>

    <!-- Order Summary -->
    <div class="confirmation-container">
        <h4>Order Details</h4>
        <table class="table table-bordered order-summary">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $productId => $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']); ?></td>
                        <td><?= number_format($product['price'], 2); ?> PHP</td>
                        <td><?= $product['quantity']; ?></td>
                        <td><?= number_format($product['price'] * $product['quantity'], 2); ?> PHP</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total Price:</strong></td>
                    <td><strong><?= number_format(array_sum(array_map(function ($product) {
                        return $product['price'] * $product['quantity'];
                    }, $cart)), 2); ?> PHP</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- User Billing Information -->
    <div class="confirmation-container">
        <h4>Billing Information</h4>
        <p><strong>Name:</strong> <?= htmlspecialchars($order_details['name']); ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($order_details['address']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($order_details['email']); ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($order_details['phone']); ?></p>
        <p><strong>Payment Method:</strong> <?= htmlspecialchars($order_details['payment_method']); ?></p>
    </div>

    <div class="confirmation-container">
        <p>Thank you for your order! Your order will be processed and delivered to you soon.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
