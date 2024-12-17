<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - Admin Dashboard</title>
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

        .chart-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .table th, .table td {
            text-align: center;
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
            <li><a href="orders.php">Orders</a></li>
            <li><a href="user_activity.php">User Activity</a></li>
            <li><a href="sales_report.php">Sales Reports</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="title">Sales Report</div>
            <div class="admin-menu">
                <span>Admin Name</span> | <a href="logout.php">Logout</a>
            </div>
        </div>

        <!-- Sales Overview -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">₱500,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">150 Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Average Order Value</h5>
                        <p class="card-text">₱3,300</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Sales Today</h5>
                        <p class="card-text">₱25,000</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Breakdown by Product -->
        <h4>Sales Breakdown by Product</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Units Sold</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Luxury Watch A</td>
                    <td>50</td>
                    <td>₱100,000</td>
                </tr>
                <tr>
                    <td>Luxury Watch B</td>
                    <td>75</td>
                    <td>₱150,000</td>
                </tr>
                <tr>
                    <td>Luxury Watch C</td>
                    <td>25</td>
                    <td>₱75,000</td>
                </tr>
            </tbody>
        </table>

        <!-- Sales Trends (Line Chart) -->
        <h4>Sales Trends (Weekly Overview)</h4>
        <div class="chart-container">
            <canvas id="salesTrendsChart"></canvas>
        </div>

        <!-- Recent Orders -->
        <h4>Recent Orders</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#00123</td>
                    <td>John Doe</td>
                    <td>2024-12-17</td>
                    <td>₱2,500</td>
                    <td>Shipped</td>
                </tr>
                <tr>
                    <td>#00124</td>
                    <td>Jane Smith</td>
                    <td>2024-12-16</td>
                    <td>₱3,200</td>
                    <td>Processing</td>
                </tr>
                <tr>
                    <td>#00125</td>
                    <td>Mark Lee</td>
                    <td>2024-12-15</td>
                    <td>₱1,800</td>
                    <td>Delivered</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesTrendsChart').getContext('2d');
        const salesTrendsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales (₱)',
                    data: [5000, 7000, 8000, 6500, 7500, 8500, 9000],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
