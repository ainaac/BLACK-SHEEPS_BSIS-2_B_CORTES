<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartier Ronde Louis Cartier</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Cambria', serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #fff; /* White background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 30px; /* Added padding for spacing */
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .navbar a img {
            width: 120px;
            height: auto;
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            text-decoration: none;
            margin-right: 30px; /* Added space between elements */
        }

        .dropdown-menu {
            min-width: 200px;
        }

        .profile-icon {
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
        }

        .dropdown-item {
            font-size: 1rem;
            color: #333;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Product Section Styling */
        .product-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 30px;
            margin-top: 70px; /* Adjust for navbar */
        }

        .product-image {
            max-width: 500px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .product-details {
            max-width: 500px;
            width: 100%;
            padding-left: 30px;
        }

        .product-details h2 {
            font-size: 2rem;
            color: #000;
        }

        .product-details p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d9534f;
            margin-bottom: 20px;
        }

        /* Other Products Section Styling */
        .other-products {
            padding: 50px 0;
            background-color: #fff;
        }

        .other-products h3 {
            text-align: center;
            margin-bottom: 30px;
        }

        .other-products .product-card {
            margin-bottom: 20px;
        }

        /* Ensuring uniform size for product images */
        .other-products .product-card img {
            width: 100%;
            height: 200px; /* Set a fixed height */
            object-fit: cover; /* Ensures the image covers the space without distortion */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .other-products .product-card .product-name {
            font-weight: bold;
            text-align: center;
        }

        /* Link Styling (Black and No Underline) */
        a {
            color: #333 !important;
            text-decoration: none !important;
        }

        a:hover {
            color: #333 !important;
            text-decoration: none !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                text-align: center;
            }

            .product-details {
                padding-left: 0;
                padding-top: 20px;
            }

            .product-image {
                max-width: 80%;
            }

            .navbar-content {
                flex-direction: column;
                align-items: flex-start;
            }
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
        
         <!-- Cart Icon (Keep only one instance) -->
<div class="cart-icon-container">
    <a href="cart.php" class="cart-link">
        <i class="fas fa-shopping-cart cart-icon"></i>
        <span id="cart-count" class="cart-count">0</span>
    </a>
</div>
        
       
    </div>
</nav>

         <!-- Product Section -->
 <div class="container">
    <div class="product-container">
        <!-- Product Image -->
        <div>
            <img src="prod10.jpg" alt="Product Image" class="product-image">
        </div>


        <!-- Product Details -->
        <div class="product-details">
            <h2>Cartier Ronde Louis Cartier</h2>
            <p class="product-description">The Cartier Ronde Louis Cartier is a luxury watch featuring a rose gold case paired with a striking green-accented clock face, exuding sophistication and elegance.</p>
            <p class="product-price">PHP 175,290.00</p>
        </div>
    </div>
</div>

       
    </div>

        
    </div>
</nav>

<!-- Other Products Section -->
<div class="other-products">
    <h3>Other Products You May Like</h3>
    <div class="container">
        <div class="row">
            <!-- Product 1 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product12.php"><img src="prod1.jpg" alt="Product 1" class="img-fluid"></a>
                <div class="product-name">Cartier Baignoire</div>
            </div>

            <!-- Product 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product13.php"><img src="prod2.jpg" alt="Product 2" class="img-fluid"></a>
                <div class="product-name">Cartier Drive de Cartier</div>
            </div>

            <!-- Product 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product14.php"><img src="prod3.jpg" alt="Product 3" class="img-fluid"></a>
                <div class="product-name">Cartier Silver Delux Vintage</div>
            </div>

            <!-- Product 4-->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product15.php"><img src="prod4.jpg" alt="Product 4" class="img-fluid"></a>
                <div class="product-name">Casio Vintage</div>
            </div>

            <!-- Product 5 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product16.php"><img src="prod5.jpg" alt="Product 5" class="img-fluid"></a>
                <div class="product-name">Rolex Day-Date 40</div>
            </div>

            <!-- Product 6 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product17.php"><img src="prod6.jpg" alt="Product 6" class="img-fluid"></a>
                <div class="product-name">Rolex Milgauss</div>
            </div>

            <!-- Product 7 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product18.php"><img src="prod7.jpg" alt="Product 7" class="img-fluid"></a>
                <div class="product-name">Rolex Lady-Datejust</div>
            </div>

            <!-- Product 8-->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product19.php"><img src="prod8.jpg" alt="Product 8" class="img-fluid"></a>
                <div class="product-name">Rolex Oyster Perpetual</div>
            </div>

            <!-- Product 9 -->
            <div class="col-lg-3 col-md-4 col-sm-6 product-card">
                <a href="product20.php"><img src="prod9.jpg" alt="Product 9" class="img-fluid"></a>
                <div class="product-name">Cartier Ronde Louis Cartier</div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
