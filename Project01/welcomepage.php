<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'clock Shop</title>

    <style>
        /* General Styles */
        body {
            font-family: 'Cambria', serif; /* Set Cambria font for the body */
            margin: 0;
            padding: 0;
            background: url('bg2png.png') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            color: #333;
        }

        /* Semi-transparent overlay for background image */
        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Header with gradient black background */
        header {
            background: linear-gradient(to right, #000000, #434343);
            color: #fff;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Styling the O'Clock text and making it a button */
        .header-left {
            font-size: 2.2em;
            font-weight: bold;
            color: white;
            cursor: pointer;
            font-family: 'Cambria', serif; /* Cambria font */
        }

        .header-left:hover {
            color: #f1c40f;
        }

        /* Top buttons (Home, Log In / Sign In) */
        .top-buttons {
            display: flex;
            gap: 15px;
            margin-left: -10px; /* Move buttons to the left */
        }

        .top-buttons button {
            padding: 8px 15px;  /* Smaller padding */
            font-size: 0.9em;  /* Smaller font size */
            border: none;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-family: 'Cambria', serif; /* Cambria font */
            transition: background-color 0.3s ease;
        }

        .top-buttons button:hover {
            background-color: #f1c40f;
        }

        /* Featured Section */
        .banner {
            background: url('luxury-watch-banner.jpg') no-repeat center center/cover;
            height: 300px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .banner h2 {
            font-size: 3.5em;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        /* Adjusted position of the featured section with smaller and more transparent beige background */
        .featured {
            padding: 20px 20px;  /* Reduced padding to make it smaller */
            text-align: center;
            background-color: rgba(255, 255, 255, 0.6); /* Transparent white background */
            margin: -110px auto 50px auto; /* Moved the section -135px */
            border-radius: 10px;
            width: 50%; /* Made the featured section smaller */
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        }

        .featured h3 {
            margin-bottom: 20px;
            font-size: 2.5em;
            color: white; /* White color for the text */
            font-family: 'Cambria', serif; /* Cambria font */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7), -2px -2px 4px rgba(0, 0, 0, 0.7); /* Black outline effect */
        }

        .product-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* Smaller product container */
        .product {
            border: 1px solid #fff;
            border-radius: 10px;
            padding: 15px;
            width: 200px; /* Reduced width of product */
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Smaller images within the product container */
        .product img {
            max-width: 80%; /* Make image smaller */
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product img:hover {
            transform: scale(1.05);
        }

        .product h4 {
            margin: 15px 0;
            font-size: 1.2em;
            color: #333;
        }

        .product p {
            font-size: 1.1em;
            color: #e67e22;
        }

        footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 15px 0;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

<!-- Semi-transparent overlay for background image -->
<div class="background-overlay"></div>

<header>
    <!-- O'Clock text as a button on the left -->
    <div class="header-left" onclick="window.location.href= 'welcomepage.php'">O'Clock</div>

    <!-- Top buttons (Home, Log In / Sign In) -->
    <div class="top-buttons">
        <button onclick="window.location.href='index.php'">Log In / Sign Up</button>
    </div>
</header>

<div class="banner">
    <h2>Timeless Luxury, Just for You</h2>
</div>

<section class="featured">
    <h3>O'clocks Bestsellers</h3>
    <div class="product-grid">
        <!-- Product 1 -->
        <div class="product">
            <img src="prod7.jpg" alt="Luxury Watch 1">
            <h4>Elegant Timepiece</h4>
            <p>PHP 100,000.00</p>
        </div>
        <!-- Product 2 -->
        <div class="product">
            <img src="prod8.jpg" alt="Luxury Watch 2">
            <h4>Rolex Milgauss</h4>
            <p>PHP 150,000.00</p>
        </div>
         <!-- Product 3 -->
         <div class="product">
            <img src="prod4.jpg" alt="Luxury Watch 3">
            <h4>Casio Vintage</h4>
            <p>PHP 1,080.00</p>
        </div>

         <!-- Product 4 -->
         <div class="product">
            <img src="prod6.jpg" alt="Luxury Watch 4">
            <h4>Rolex Day-Date 40</h4>
            <p>PHP 120,280.00</p>
        </div>

         <!-- Product 5 -->
         <div class="product">
            <img src="prod10.jpg" alt="Luxury Watch 4">
            <h4>Cartier Ronde Louis Cartier</h4>
            <p>PHP 175,290.00</p>
        </div>

          <!-- Product 6 -->
          <div class="product">
            <img src="prod9.jpg" alt="Luxury Watch 4">
            <h4>Rolex Oyster Perpetual</h4>
            <p>PHP 210,350.00</p>
        </div>

    </div>
</section>

<footer>
    <p>&copy; 2024 O'clock Shop. All Rights Reserved.</p>
</footer>

</body>
</html>