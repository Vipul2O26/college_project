<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's ID, username, and order ID from the request
$client_id = intval($_SESSION['user_id']);
$client_name = $_SESSION['username']; // Assuming 'username' is stored in session

$order_id = ($_GET['order_id']);

// Debugging - Output client and order information (can be removed later)
echo "$client_id  $client_name  $order_id";

// Update the shipment record to assign it to the current user
$query = "UPDATE shipment SET dealer_id = ?, dealer_name = ? WHERE order_id = ? AND dealer_id IS NULL";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param('isi', $client_id, $client_name, $order_id); // Updated to bind dealer_name as string
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $_SESSION['message'] = "Order #{$order_id} has been successfully assigned to you.";
} else {
    $_SESSION['message'] = "Failed to assign Order #{$order_id}. It may already be taken.";
}

$stmt->close();
$conn->close();

// Redirect back to the shipments page
header("Location: clientdash.php");
exit();
?>
