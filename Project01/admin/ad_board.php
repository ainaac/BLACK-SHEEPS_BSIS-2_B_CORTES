<?php
// Include the database connection
include 'db.php';

try {
    // Fetch total orders
    $orderQuery = "SELECT COUNT(*) AS total_orders FROM orders";
    $orderResult = $pdo->query($orderQuery);
    $totalOrders = $orderResult->fetch(PDO::FETCH_ASSOC)['total_orders'];

    // Fetch total users
    $userQuery = "SELECT COUNT(*) AS users_active FROM user_account";
    $userResult = $pdo->query($userQuery);
    $usersActive = $userResult->fetch(PDO::FETCH_ASSOC)['users_active'];

    // Fetch today's sales
    $salesQuery = "SELECT SUM(total_price) AS todays_sales FROM orders WHERE DATE(created_at) = CURDATE()";
    $salesResult = $pdo->query($salesQuery);
    $todaysSales = $salesResult->fetch(PDO::FETCH_ASSOC)['todays_sales'] ?? 0;

    // Fetch monthly sales
    $monthlyQuery = "SELECT SUM(total_price) AS monthly_sales FROM orders WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
    $monthlyResult = $pdo->query($monthlyQuery);
    $monthlySales = $monthlyResult->fetch(PDO::FETCH_ASSOC)['monthly_sales'] ?? 0;

    // Fetch recent orders
    $recentOrdersQuery = "SELECT id, items_summary, name, created_at, total_price, status FROM orders ORDER BY created_at DESC LIMIT 5";
    $recentOrdersResult = $pdo->query($recentOrdersQuery);

    // Handle status update
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['status'])) {
        $orderId = $_POST['order_id'];
        $newStatus = $_POST['status'];
        $updateQuery = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([$newStatus, $orderId]);

        // Redirect to refresh the page
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cambria', serif;
        }
        .navbar {
            background-color: black;
        }

        .navbar .navbar-brand {
            color: white;
        }

        .navbar .navbar-nav .nav-item .nav-link {
            color: white;
        }

        .navbar .navbar-nav .nav-item .nav-link:hover {
            color: #ccc;
        }

        .btn-primary {
            background-color: black;
            border-color: black;
            color: white;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
            color: white;
        }
        .card-header.bg-primary {
            background-color: black !important;
            color: white !important;
        }
        .table thead {
            background-color: black;
            color: white;
        }
        .table td, .table th {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="inventory.php">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Metrics Section -->
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center p-3 mb-4 shadow">
                    <h3><?php echo $totalOrders; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3 mb-4 shadow">
                    <h3><?php echo $usersActive; ?></h3>
                    <p>Total Users</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3 mb-4 shadow">
                    <h3>₱<?php echo number_format($todaysSales, 2); ?></h3>
                    <p>Today's Sales</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3 mb-4 shadow">
                    <h3>₱<?php echo number_format($monthlySales, 2); ?></h3>
                    <p>Monthly Sales</p>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="card mt-4 shadow">
            <div class="card-header bg-primary text-white">
                <h4>Recent Orders</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Ordered Items</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $recentOrdersResult->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['items_summary']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                            <td>₱<?php echo number_format($row['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <!-- Form for updating status -->
                                <form method="POST" action="">
                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                    <select name="status" class="form-control form-control-sm d-inline w-75">
                                        <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="To Ship" <?php echo $row['status'] == 'To Ship' ? 'selected' : ''; ?>>To Ship</option>
                                        <option value="To Deliver" <?php echo $row['status'] == 'To Deliver' ? 'selected' : ''; ?>>To Deliver</option>
                                        <option value="Completed" <?php echo $row['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                        <option value="Cancelled" <?php echo $row['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <!-- Redirect Button -->
                <div class="text-right mt-3">
                    <a href="index.php" class="btn btn-success">Add New Products</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
