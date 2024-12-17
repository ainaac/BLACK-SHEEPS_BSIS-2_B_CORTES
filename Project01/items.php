<?php
// Database connection settings
require 'db.php'; // Include the database connection file


// Query to fetch products
$sql = "SELECT id, name, price, image FROM products"; // Modify based on your database table structure

// Execute the query and fetch the results
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - o'clocks</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Cambria', serif;
            background-color: #f4f4f4;
        }

        /* Navbar with background image */
        .navbar {
            background-color: transparent;
            padding: 10px 20px;
        }

        .navbar .btn-profile {
            background-color: #fff;
            color: #000;
            border-radius: 25px;
            border: 1px solid #000;
            padding: 8px 20px;
        }

        .navbar .btn-profile:hover {
            background-color: #000;
            color: #fff;
        }

        /* Search Button Styling */
        .navbar .btn-search {
            background-color: #000;
            color: #fff;
            border-radius: 25px;
            border: 1px solid #000;
            padding: 8px 20px;
            margin-left: 10px;
        }

        .navbar .btn-search:hover {
            background-color: #fff;
            color: #000;
            border: 1px solid #000;
        }

        /* Navbar Logo and brand name */
        .navbar img {
            height: 90px; /* Increased logo size */
        }

        .navbar .brand-name {
            font-size: 2rem;
            font-weight: bold;
            color: #000; /* Changed font color to black */
            margin-left: 5px; /* Reduced margin to bring logo and text closer */
            letter-spacing: 2px;
            text-transform: lowercase;
        }

        .navbar .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        /* Profile Icon */
        .navbar .profile-icon {
            font-size: 30px; /* Increased icon size */
            color: #000;
            margin-left: 20px;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #000;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
            color:rgb(4, 15, 27);
        }

        .product-card {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa; /* Light background behind product card */
        }

        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover; /* Ensures all images are the same size */
            background-color: #000; /* Background color for images */
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 10px;
            color: #333;
        }

        .product-price {
            font-size: 1rem;
            margin: 10px;
            color:rgb(0, 1, 1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
        }

        .product-card .btn {
            width: 100%;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 12px;
            font-weight: bold;
            font-size: 1rem;
            border-radius: 8px;
            margin-top: 10Spx;
        }

        .product-card .btn:hover {
            background-color: #fff;
            color: #000;
            border: 1px solid #000;
        }

        /* Background image for navbar */
        .container {
            background-image: url('itempagebg.jpg');
            background-size: cover;
            background-position: center;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); /* Shadow effect */
            padding: 20px;
        }

        .banner {
            font-size: 2rem; /* Increase font size for better visibility */
            font-weight: normal; /* Makes the text thicker */
            text-align: center;
            color: #000;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3); /* Adds shadow to the text */
            margin-top: 50px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="homepage.php">
                <img src="oclocks.png" alt="o'clocks Logo">
            </a>
            <span class="brand-name">o'clocks</span>
           

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a class="profile-icon dropdown-toggle\" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="mypurchase.php">My Orders</a></li>
                    <li><a class="dropdown-item" href="cart.php">My Cart</a></li>
                    <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="banner">Time to meet our products - where every second counts!</h2>
        <div class="product-container">
            <?php
            // Check if there are any products
            if ($products) {
                // Loop through and output each product
                foreach ($products as $product) {
                    echo '<div class="product-card col-md-3 col-sm-6">
                            <img src="' . $product['image'] . '" class="product-img" onclick="location.href=\'product' . $product['id'] . '.php\';" alt="' . $product['name'] . '">
                            <div class="product-name">' . $product['name'] . '</div>
                            <div class="product-price">PHP ' . number_format($product['price'], 2) . '</div>
                            <a href="cart.php?product_id=' . $product['id'] . '">
                                <button class="btn">Add to Cart</button>
                            </a>
                          </div>';
                }
            } else {
                echo "No products found!";
            }
            ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the PDO connection
$conn = null;
?>
