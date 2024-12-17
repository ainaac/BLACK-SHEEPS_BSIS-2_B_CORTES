<?php
session_start();

// Database connection
$host = 'localhost';
$db_username = 'root'; // Your DB username
$db_password = ''; // Your DB password
$database = 'oclock'; // Database name

// Create connection
$conn = new mysqli($host, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders and user details
$query = "SELECT orders.*, user_account.user_name, user_account.email
          FROM orders
          JOIN user_account ON orders.user_id = user_account.user_id"; // Corrected column names

$result = $conn->query($query);

// Check if query was successful
if ($result === false) {
    die("Error fetching orders: " . $conn->error);
}

// Handle status update if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    // Update order status
    $update_query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('si', $new_status, $order_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Order status updated successfully.";
    } else {
        echo "Failed to update order status.";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .order-status-form select {
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Admin Orders Page</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Items Ordered</th>
            <th>Status</th>
            <th>Update Status</th>
        </tr>

        <?php while ($order = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                <td><?php echo htmlspecialchars($order['user_name']); ?></td> <!-- Corrected column name -->
                <td><?php echo htmlspecialchars($order['email']); ?></td>
                <td><?php echo htmlspecialchars($order['items_ordered']); ?></td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
                <td>
                    <form action="" method="POST" class="order-status-form">
                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        <select name="status">
                            <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                            <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                            <option value="Paid" <?php if ($order['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
