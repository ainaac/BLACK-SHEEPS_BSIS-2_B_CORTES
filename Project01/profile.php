<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}>

$user_id = $_SESSION['user_id']; // Get the user ID from session

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Adjust with your MySQL password
$dbname = "oclock"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc(); // Fetch the user's data
} else {
    echo "User data not found!";
}
?>
