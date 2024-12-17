<?php
session_start();

// Ensure the user is logged in
if (empty($_SESSION['user_id'])) {
    echo "<p>Your cart is empty. Please add some items to the cart.</p>";
    exit;
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Connect to the database
require 'db.php';

// Fetch cart items from the database
$stmt = $pdo->prepare("SELECT p.name, p.price, c.quantity, p.id as product_id FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id");
$stmt->execute([':user_id' => $userId]);
$cart = $stmt->fetchAll();

// Handle the checkout form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];  // New phone field

    // The payment method is automatically set to 'Cash on Delivery'
    $payment_method = 'Cash on Delivery';  // Fixed payment method

    // Calculate the total price from the cart
    $total_price = array_sum(array_map(function ($product) {
        return $product['price'] * $product['quantity'];
    }, $cart));

    // Calculate the total quantity of items and build a summary of the items
    $total_quantity = 0;
    $item_summary = [];

    foreach ($cart as $product) {
        $total_quantity += $product['quantity'];
        $item_summary[] = $product['name'] . ' (x' . $product['quantity'] . ')';  // e.g. "Clock (x2)"
    }

    $item_summary_string = implode(', ', $item_summary);  // Comma-separated list

    // Save order details into the database
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, name, address, email, phone, payment_method, total_price, items_summary, total_items) 
                           VALUES (:user_id, :name, :address, :email, :phone, :payment_method, :total_price, :items_summary, :total_items)");
    $stmt->execute([
        ':user_id' => $userId,
        ':name' => $name,
        ':address' => $address,
        ':email' => $email,
        ':phone' => $phone,
        ':payment_method' => $payment_method,
        ':total_price' => $total_price,
        ':items_summary' => $item_summary_string,   // Insert the item summary
        ':total_items' => $total_quantity          // Insert the total quantity
    ]);

    // Optionally, save the cart items for the order in the order_items table
    $orderId = $pdo->lastInsertId();
    foreach ($cart as $product) {
        // Insert order items
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                               VALUES (:order_id, :product_id, :quantity, :price)");
        $stmt->execute([
            ':order_id' => $orderId,
            ':product_id' => $product['product_id'],  // Change from 'id' to 'product_id'
            ':quantity' => $product['quantity'],
            ':price' => $product['price']
        ]);

        // Decrease stock after the order is placed
        $newStock = $product['quantity'];  // Get quantity purchased
        $updateStockStmt = $pdo->prepare("UPDATE products SET stock = stock - :quantity WHERE id = :product_id");
        $updateStockStmt->execute([
            ':quantity' => $newStock,
            ':product_id' => $product['product_id']
        ]);
    }

    // Clear the cart after successful checkout
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $userId]);

    // Redirect to the order confirmation page
    header("Location: order_confirmation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - O'Clocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('check.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Cambria', serif;
        }
        .checkout-form {
            background-color: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: center;
        }
        .cart-table th {
            background-color: #f8f9fa;
        }
        .btn-primary {
            background-color: #000;
            border-color: #000;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
        .btn-small {
            padding: 8px 16px;
            font-size: 14px;
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
        .checkout-header {
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
        <div class="checkout-header">
            <h2>Clock In Your Order</h2>
        </div>
    </div>

    <div class="checkout-form">
        <h4>Your Cart</h4>
        <table class="table table-bordered cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $product): ?>
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

    <div class="checkout-form">
        <h4>Billing Information</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <input type="text" class="form-control" id="payment_method" name="payment_method" value="Cash on Delivery" readonly>
            </div>

            <button type="submit" class="btn btn-primary btn-small btn-block">Place Order</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
