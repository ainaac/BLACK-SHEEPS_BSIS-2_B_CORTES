<?php 
session_start();

// Ensure that the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
    exit(); // Always call exit after a redirect
}

$userId = $_SESSION['user_id']; // Initialize the user ID here, assuming the user is logged in

require 'db.php';

// Handle adding product to the cart
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch product details to calculate the price
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = :product_id");
    $stmt->execute([':product_id' => $productId]);
    $product = $stmt->fetch();

    if ($product) {
        $totalPrice = $product['price']; // Initial total price is product price

        // Check if the product is already in the cart
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute([':user_id' => $userId, ':product_id' => $productId]);
        $cartItem = $stmt->fetch();

        if ($cartItem) {
            // If the product already exists, increase the quantity and update total price
            $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1, total_price = total_price + :price WHERE id = :id");
            $stmt->execute([':price' => $product['price'], ':id' => $cartItem['id']]);
        } else {
            // If the product doesn't exist in the cart, insert a new record
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity, total_price) VALUES (:user_id, :product_id, 1, :total_price)");
            $stmt->execute([':user_id' => $userId, ':product_id' => $productId, ':total_price' => $totalPrice]);
        }
    }
}

// Handle quantity updates (increase and decrease)
if (isset($_GET['increase_quantity'])) {
    $productId = $_GET['increase_quantity'];

    // Fetch product details to calculate the price
    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = :product_id");
    $stmt->execute([':product_id' => $productId]);
    $product = $stmt->fetch();

    if ($product) {
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1, total_price = total_price + :price WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute([':price' => $product['price'], ':user_id' => $userId, ':product_id' => $productId]);
    }
}

if (isset($_GET['decrease_quantity'])) {
    $productId = $_GET['decrease_quantity'];

    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute([':user_id' => $userId, ':product_id' => $productId]);
    $cartItem = $stmt->fetch();

    if ($cartItem && $cartItem['quantity'] > 1) {
        // Fetch product details to calculate the price
        $stmt = $pdo->prepare("SELECT price FROM products WHERE id = :product_id");
        $stmt->execute([':product_id' => $productId]);
        $product = $stmt->fetch();

        if ($product) {
            $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity - 1, total_price = total_price - :price WHERE id = :id");
            $stmt->execute([':price' => $product['price'], ':id' => $cartItem['id']]);
        }
    } else {
        // Remove item from cart if quantity is 1 and the user clicks decrease
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute([':user_id' => $userId, ':product_id' => $productId]);
    }
}

// Get search query
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Filter products based on the search query
$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :search_query");
$stmt->execute([':search_query' => "%" . $searchQuery . "%"]);
$filteredProducts = $stmt->fetchAll();

// Get cart content from database
$stmt = $pdo->prepare("SELECT p.name, p.price, p.image, c.quantity, c.total_price, c.product_id FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id");
$stmt->execute([':user_id' => $userId]);
$cart = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My O'Clocks' Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Set a nice background */
        body {
            font-family: Cambria, serif;
            background: url('cartt.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .header {
            background: linear-gradient(to right, #f0f0f0, gray); /* Gradient from light gray to white */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 75px;
        }

        /* Logo and search bar section */
        .logo-and-search {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-grow: 1;
        }

        .search-bar {
            width: 350px;
            padding-left: 10px;
            background-color: white;
            color: black;
            border-radius: 300px;
        }

        .account-link {
            color: black;
            text-decoration: none;
            margin-left: auto; /* This will push it to the right */
        }

        /* Adjust the logo size */
        .logo-and-search img {
            height: 80px;
            width: auto;
        }

        .container {
            margin-top: 30px;
        }

        /* Custom styles for cart and product cards */
        .card {
            background-color: #f4f1e1;
            border: none;
            color: black;
            border-radius: 10px;
        }

        .table {
            background-color: transparent;
            color: black;
            border: none;
        }

        .btn-primary {
            background-color: black;
            border-color: black;
            color: white;
        }

        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
            color: white;
        }

        .total-price {
            color: black;
            font-weight: bold;
        }

        /* "You May Also Like" section */
        .you-may-like {
            text-align: center;
            font-size: 28px;
            color: black;
            font-weight: bold;
            margin-top: 30px;
        }

        .recommended-products {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        /* Adjust the images in "You May Also Like" */
        .recommended-products .card {
            background-color: #f4f1e1;
            border: none;
            color: black;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .recommended-products .card-img-top {
            width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center;
        }

        .recommended-products .card-body {
            padding: 10px;
        }

        /* Make "My O'Cart" heading black */
        .cart-heading {
            color: black;
            font-size: 2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo-and-search">
            <a href="homepage.php"><img src="oclocks.png" alt="O'Clocks Logo"></a>
            <form method="GET" action="">
                <input type="text" name="search_query" class="form-control search-bar" placeholder="Search for products..." value="<?= htmlspecialchars($searchQuery); ?>">
            </form>
        </div>
        <a href="myprofile.php" class="account-link">My Profile</a>
    </div>

    <div class="container">
        <h2 class="cart-heading">Clock's Running – Your Cart is Ready!</h2>

        <!-- Shopping Cart Table -->
        <?php if (!empty($cart)): ?>
            <form action="checkout.php">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['name']); ?></td>
                                <td><?= number_format($product['price'], 2); ?> PHP</td>
                                <td>
                                    <a href="?decrease_quantity=<?= $product['product_id']; ?>" class="btn btn-outline-secondary">-</a>
                                    <?= $product['quantity']; ?>
                                    <a href="?increase_quantity=<?= $product['product_id']; ?>" class="btn btn-outline-secondary">+</a>
                                </td>
                                <td><?= number_format($product['price'] * $product['quantity'], 2); ?> PHP</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Checkout Button -->
                <div class="d-flex justify-content-between">
                    <div class="total-price">
                        Total Price: <?= number_format(array_sum(array_map(function ($product) {
                            return $product['price'] * $product['quantity'];
                        }, $cart)), 2); ?> PHP
                    </div>
                    <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                </div>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

        <!-- "You May Also Like" Section -->
        <div class="you-may-like">Clocking in New Finds</div>
        <div class="recommended-products">
            <?php foreach ($filteredProducts as $product): ?>
                <div class="card">
                    <img src="<?= $product['image']; ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?= number_format($product['price']); ?> PHP</p>
                        <a href="?product_id=<?= $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
