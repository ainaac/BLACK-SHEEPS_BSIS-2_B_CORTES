<?php
// Define company information
$company_name = "o'clock";
$logo = "oclocks.png"; // Ensure this image is in the correct folder
$banner_image = "abs.png"; // Ensure this image is in the correct folder
$mission = "At O'clock, our mission is to bring affordability to every moment. We aim to provide cost-effective solutions without compromising on quality, ensuring everyone can enjoy the best without overspending.";
$vision = "Our vision is to create a world where timekeeping and style are accessible to everyone, fostering innovation and inclusivity in every product and service we offer.";
$contact_email = "contact@oclock.com";
$contact_phone = "+123 456 7890";

// HTML output starts here
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>About Us - $company_name</title>
    <!-- Link to Font Awesome for icons -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Navbar Styles */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            color: #333;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        nav img {
            height: 40px;
            margin-right: 10px;
        }
        nav .brand {
            display: flex;
            align-items: center;
        }
        nav a {
            color: #333;
            text-decoration: none;
            margin-left: 15px;
            font-size: 16px;
        }
        nav a:hover {
            text-decoration: underline;
        }

        /* Hero Section Styles */
        .hero {
            width: 100%;
            height: 400px;
            background: url('$banner_image') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main Content */
        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Mission and Vision Section */
        .mission-vision {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        .mission-vision section {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .mission-vision h2 {
            color: #333;
            margin-bottom: 15px;
        }

        .mission-vision p {
            line-height: 1.8;
        }

        /* Social Media Section */
        .social-media {
            margin-top: 30px;
            text-align: center;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icons a {
            text-decoration: none;
            font-size: 24px;
            color: #333;
        }

        .social-icons a:hover {
            opacity: 0.8;
        }

        /* Contact Section */
        .contact {
            margin-top: 40px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .contact h2 {
            margin-bottom: 15px;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class='brand'>
        <a href='homepage.php'>
            <img src='$logo' alt='$company_name Logo'>
            </a>
            <h1>$company_name</h1>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class='hero'></section>

    <!-- Main Content -->
    <main>
        <div class='mission-vision'>
            <section>
                <h2>Our Mission</h2>
                <p>$mission</p>
            </section>
            <section>
                <h2>Our Vision</h2>
                <p>$vision</p>
            </section>
        </div>

        <!-- Social Media Section -->
        <div class='social-media'>
            <h2>Follow Us</h2>
            <div class='social-icons'>
                <a href='#' class='fab fa-linkedin'></a>
                <a href='#' class='fab fa-facebook'></a>
                <a href='#' class='fab fa-instagram'></a>
                <a href='#' class='fab fa-twitter'></a>
                <a href='#' class='fab fa-youtube'></a>
            </div>
        </div>

        <!-- Contact Section -->
        <div class='contact'>
            <h2>Contact Us</h2>
            <p><a href='mailto:$contact_email'><i class='fas fa-envelope'></i> Email Us</a></p>
            <p><i class='fas fa-phone-alt'></i> $contact_phone</p>
        </div>
    </main>

    <footer>
        &copy; " . date('Y') . " $company_name. All rights reserved.
    </footer>

</body>
</html>
";
?>
