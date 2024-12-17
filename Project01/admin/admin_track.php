<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 15px 0;
            background-color: #212529;
            border-bottom: 1px solid #444;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #444;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            padding-left: 20px;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
            height: 100vh;
            overflow-y: auto;
        }

        .top-bar {
            background-color: #ffffff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .top-bar .admin-menu {
            font-size: 1rem;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">o'clocks</div>
        <ul>
            <li><a href="ad_board.php">Dashboard</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="#">Sales Reports</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="title">Admin Dashboard</div>
            <div class="admin-menu">
                <span>Admin Name</span> | <a href="logout.php">Logout</a>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">₱100,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">120 Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Active Users</h5>
                        <p class="card-text">25 Users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Section (Dynamic Content) -->
        <div class="card border-dark">
            <div class="card-body">
                <h5 class="card-title">Welcome to the Admin Dashboard</h5>
                <p class="card-text">Use the sidebar to navigate through the admin features.</p>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
