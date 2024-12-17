<?php
// Include the database connection
include 'db.php';

try {
    // Fetch products for inventory
    $inventoryQuery = "SELECT * FROM products";
    $inventoryResult = $pdo->query($inventoryQuery);

    // Handle product updates (name, price, stock)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_stock'])) {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productStock = $_POST['product_stock'];

        $updateProductQuery = "UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?";
        $stmt = $pdo->prepare($updateProductQuery);
        $stmt->execute([$productName, $productPrice, $productStock, $productId]);

        // Redirect to refresh the page
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    // Handle product deletion
    if (isset($_GET['delete_product_id'])) {
        $productId = $_GET['delete_product_id'];
        $deleteProductQuery = "DELETE FROM products WHERE id = ?";
        $stmt = $pdo->prepare($deleteProductQuery);
        $stmt->execute([$productId]);

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
    <title>Product Inventory</title>
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
                <a class="nav-link" href="ad_board.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Product Inventory</h1>

        <!-- Inventory Management Table -->
        <div class="card mt-4 shadow">
            <div class="card-header bg-primary text-white">
                <h4>Product Inventory</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = $inventoryResult->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td>#<?php echo $product['id']; ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>₱<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>
                                <!-- Form for updating product details -->
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" class="form-control form-control-sm mb-2" required>
                                    <input type="number" name="product_price" value="<?php echo $product['price']; ?>" class="form-control form-control-sm mb-2" required step="0.01">
                                    <input type="number" name="product_stock" value="<?php echo $product['stock']; ?>" class="form-control form-control-sm mb-2" required>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                                <!-- Delete product -->
                                <a href="?delete_product_id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
