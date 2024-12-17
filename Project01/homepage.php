<?php
session_start();

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
    exit(); // Always call exit after a redirect
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - o'clock</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
       
        body {
            font-family: 'Cambria', serif;
            background-color: #f4f4f4;
        }

        /* Navbar Styling */
          .navbar {
        background-color: transparent;
        padding: 10px 20px;
    }

    .navbar .search-bar {
        width: 50%;
        padding: 8px;
        border-radius: 25px;
        border: 1px solid #fff;
        background-color: rgba(255, 255, 255, 0.7); /* Slightly transparent background */
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
        position:relative;
        right:50px;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 4px px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        color: #000;
        padding: 10px 10px;
        font-size: 1rem;
    }

    .dropdown-item:hover {
        background-color: #333;
        color: #fff;
    }
        .carousel img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .product-images-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .product-image {
            width: 300px;
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
        
         /* Background image for navbar */
        .navbar {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.5)); /* White gradient */
            background-size: cover;
            background-position: center;
        }

        
        .carousel-item video {
    width: auto; /* Automatically adjusts based on height */
    height: 700px; /* Set the height for portrait orientation */
    object-fit: cover; /* Ensures the video fills the area proportionally */
    border-radius: 12px; /* Optional: Rounds the corners */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Optional: Adds a shadow */
}
        .carousel-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    z-index: 0;
}

.carousel-item {
    position: relative;
    z-index: 1; /* Ensures slides stay above the overlay */
}



        
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="homepage.php">
                <img src="oclocks.png" alt="o'clocks Logo">
            </a>
            <span class="brand-name">o'clock</span>
           
            
            <!-- Profile Dropdown -->
           <!-- <div class="dropdown">
                <a class="profile-icon dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i> <!-- Profile icon -->
             <!--   </a>
                
                
                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="myprofile.php" >My Profile</a></li>
                    <li><a class="dropdown-item" href="#">My Orders</a></li>
                    <li><a class="dropdown-item" href="#">My Messages</a></li>
                    <li><a class="dropdown-item" href="#">Switch Accounts</a></li>
                    <li><a class="dropdown-item" href="#">Sign Out</a></li>
                    <li><a class="dropdown-item" href="aboutus.php" >About Us</a></li>
                </ul>
                
                
            </div>-->
            
            <div class="dropdown-center">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="items.php">All Items</a></li>
            <li><a class="dropdown-item" href="mypurchase.php">My Orders</a></li>
            <li><a class="dropdown-item" href="cart.php">My Cart</a></li>
            <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
            <li><a class="dropdown-item" href="aboutus.php">About Us</a></li>
          </ul>
        </div>
                </div>
            </nav>
    
    <!-- Carousel -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner" style="position: relative; background-image: url('hp2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Video Slide 1 -->
        <div class="carousel-item active">
            <video class="d-block mx-auto" autoplay loop muted>
                <source src="vid1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="carousel-caption d-none d-md-block">
                <h5>Santos de Cartier Medium Watch</h5>
                <p>$456,774.95</p>
            </div>
        </div>
        <!-- Video Slide 2 -->
        <div class="carousel-item">
            <video class="d-block mx-auto" autoplay loop muted>
                <source src="vid2.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="carousel-caption d-none d-md-block">
                <h5>Cartier Baignoire</h5>
                <p>$368,366</p>
            </div>
        </div>
        <!-- Video Slide 3 -->
        <div class="carousel-item">
            <video class="d-block mx-auto" autoplay loop muted>
                <source src="vid3.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="carousel-caption d-none d-md-block">
                <h5>Rolex Day-Date 40</h5>
                <p>$120,280</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

    <!-- Clickable Product Images Section -->
    
    <div class="container mt-5">
        <h2 class="text-center mb-4">Explore Our Collection</h2>
        <div class="product-images-container">
            <div class="product-image" onclick="location.href='product1.php';" href="product1">
                <img src="prod1.jpg" alt="Product 1">
            </div>
            <div class="product-image" onclick="location.href='product2.php';">
                <img src="prod2.jpg" alt="Product 2">
            </div>
            <div class="product-image" onclick="location.href='product3.php';">
                <img src="prod3.jpg" alt="Product 3">
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
