<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cambria', serif;
            background: url('bg.png') no-repeat center center fixed;
            background-size: cover;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .form-container {
            width: 90%;
            max-width: 400px;
            max-height: 90vh;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #000;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            overflow-y: auto;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-control {
            border-color: #000;
            background-color: #fff;
            color: #000;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
        }

        .btn-outline-dark {
            border-color: #000;
            color: #000;
            background-color: #fff;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-outline-dark:hover {
            background-color: #000;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .form-label {
            font-weight: bold;
            font-size: 1rem;
        }

        a.text-decoration-none {
            color: #000;
            font-weight: bold;
            font-size: 0.9rem;
        }

        a.text-decoration-none:hover {
            color: #555;
        }

        @media (max-height: 700px) {
            .form-container {
                padding: 15px;
                max-height: 80vh;
            }

            .btn-outline-dark {
                font-size: 0.9rem;
                padding: 8px 10px;
            }
        }

        @media (max-width: 768px) {
            .form-container {
                max-width: 90%;
            }

            .logo-container {
                width: 60px;
                height: 60px;
            }

            .form-control, .btn-outline-dark {
                font-size: 0.9rem;
            }

            .btn-outline-dark {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="logo-container">
            <img src="oclocks.png" alt="Logo">
        </div>
        <form method="POST" action="reget.php">
            <h2 class="text-center mb-3">Sign Up</h2>
            
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control" required>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-dark" href="homepage.php" >Register</button>
            </div>
        </form>
        <p class="mt-3 text-center">Already have an account? <a href="index.php" class="text-decoration-none">Login</a></p>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
