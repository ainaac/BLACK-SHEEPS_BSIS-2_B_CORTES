<?php 
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for the admin panel */
        body {
            font-family: 'Cambria', serif;
            background-color: #f4f4f4;
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

        .form-container {
            margin: 150px;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: black;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-submit {
            background-color: black;
            color: white;
        }

        .btn-submit:hover {
            background-color: #333;
            color: white;
        }

        .alert {
            padding: 15px;
            margin-top: 20px;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
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
                <a class="nav-link" href="inventory.php">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container form-container">
        <h2>Add New Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" id="price" name="price" required step="0.01">
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" name="submit" class="btn btn-submit">Add Product</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        // Get data from the form
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];

        // Define the target directory for the image upload
        $targetDir = 'uploads/';
        $targetFile = $targetDir . basename($image);

        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            try {
                // Insert product data into the database
                $stmt = $pdo->prepare("INSERT INTO products (name, price, image) VALUES (:name, :price, :image)");
                $stmt->execute([ 
                    ':name' => $name,
                    ':price' => $price,
                    ':image' => $image
                ]);
                echo '<div class="alert alert-success mt-3">Product added successfully!</div>';
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger mt-3">Error: ' . $e->getMessage() . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-3">Failed to upload image.</div>';
        }
    }
    ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
