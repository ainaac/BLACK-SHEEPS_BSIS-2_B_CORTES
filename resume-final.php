<?php
// Personal Information
$name = "Aina Shanell C. Cortes";
$profile = "I am a proactive and adaptable individual with strong leadership and multitasking abilities. I actively engage in class discussions and projects, remaining open to feedback and new ideas. My skills in managing tasks and leading others continue to shape my academic and personal growth.";
$phone = "09618084089";
$email = "cortesshan@gmail.com";
$address = "Brgy. Kinamligan, Masbate City";
$image_path = "picq.jpg"; // Ensure the image file is in the same directory
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: linear-gradient(to right,rgb(221, 215, 226),rgb(147, 127, 165)); /* Purple gradient for both columns */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 0;
            overflow: hidden;
            height: 100vh; /* Ensure the gradient takes the full height of the page */
        }
        .left, .right {
            padding: 20px;
            color: white; /* White text color */
        }

        /* Left section specific styles */
        .left {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        .left h2 {
            font-size: 1.1em;
            margin-bottom: 10px;
            border-bottom: 1px solid #fff;
            padding-bottom: 5px;
            text-transform: uppercase;
        }

        .left p {
            margin: 8px 0;
            line-height: 1.5;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .left .icon {
            margin-right: 8px;
            font-weight: bold;
        }
        .profile-section {
            margin-bottom: 20px;
        }

        /* Image framework styles */
        .image-framework {
            width: 180px;  /* Increased width */
            height: 180px; /* Increased height */
            border-radius: 50%; /* Circular image */
            margin: 0 auto;
            border: 5px solid #fff; /* White border around the image */
            overflow: hidden;
            margin-bottom: 5px; /* Reduced the bottom margin */
        }
        .image-framework img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure image fits well inside the circle */
        }

        /* Name Section - White text */
        .name {
            text-align: center;
            font-size: 1.3em;
            margin-top: 0px; /* Space above the name */
            margin-bottom: 0px; /* Space below the name */
            font-weight: bold;
            color: white; /* White text color */
            padding-top: 0px; /* Internal space above the name */
            padding-bottom: 0px; /* Internal space below the name */
        }

        /* Right section specific styles */
        .right {
            padding: 20px;
            color: white; /* White text color */
        }

        h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: white;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left">
            <!-- Image Framework -->
            <div class="image-framework">
                <img src="<?php echo $image_path; ?>" alt="Profile Image">
            </div>

            <!-- Name Section -->
            <div class="name">
                <p><?php echo $name; ?></p>
            </div>

            <!-- Profile Section -->
            <section class="profile-section">
                <h2>Profile</h2>
                <p><?php echo $profile; ?></p>
            </section>

            <!-- Contact Information -->
            <section class="contact-info">
                <h2>Contact Me</h2>
                <p>Phone: <?php echo $phone; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <p>Address: <?php echo $address; ?></p>
            </section>
        </div>

        <!-- Right Section -->
        <div class="right">
            <!-- Objective Section -->
            <section>
                <h2>Objective</h2>
                <p>To embrace emerging challenges, absorb knowledge from every encounter, and apply what I've learned to advance my technical proficiency in order to continuously progress as a proficient developer. In order to effectively contribute to upcoming initiatives and attain both professional and personal progress, I am committed to honing my skills and adjusting to new technology.</p>
            </section>

            <!-- Educational Attainment -->
            <section>
                <h2>Educational Attainment</h2>
                <ul>
                    <li><strong>Amancio Aguilar Elementary School</strong> - 2011-2017</li>
                    <li><strong>Masbate National Comprehensive High School</strong> - 2017-2023</li>
                    <li><strong>Bicol University Polangui</strong> - 2023-2027</li>
                </ul>
            </section>

            <section>
                <h2>Skills</h2>
                <ul>
                    <li>Leadership</li>
                    <li>Problem-Solving</li>
                    <li>Work Ethic</li>
                    <li>Interpersonal Skills</li>
                </ul>
            </section>

            <section>
                <h2>Hobbies</h2>
                <ul>
                    <li>Reading</li>
                    <li>Cooking</li>
                    <li>Cycling</li>
                    <li>Boardgames</li>
                </ul>
            </section>
        </div>
    </div>
</body>
</html>
