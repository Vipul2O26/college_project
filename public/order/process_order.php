<?php

session_start();

$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

// Database Connection
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique order ID
function generateOrderId() {
    $prefix = "ORD"; // Order prefix
    $timestamp = time(); // Current Unix timestamp
    $randomNumber = rand(1000, 9999); // Random 4-digit number
    return $prefix . $timestamp . $randomNumber;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        die("Error: User not logged in.");
    }

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
   
    $customer_name = trim($_POST['customer_name']);
    $item_name = trim($_POST['item_name']);
    $from_location = trim($_POST['from_location']);
    $to_location = trim($_POST['to_location']);
    $quantity = intval(trim($_POST['quantity'])); // Ensure quantity is an integer

    // Validate input fields
    if (empty($customer_name) || empty($item_name) || empty($from_location) || empty($to_location) || $quantity <= 0) {
        die("Error: All fields are required and quantity must be greater than zero.");
    }

    // Generate a new order ID
    $order_id = generateOrderId();

    // Insert into `orders` table
    $stmt_orders = $conn->prepare("INSERT INTO orders 
        (order_id, username, customer_name, item_name, from_location, to_location, quantity, order_date, user_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)");

    if (!$stmt_orders) {
        die("Error preparing statement for orders: " . $conn->error);
    }

    $stmt_orders->bind_param("ssssssii", $order_id, $username, $customer_name, $item_name, $from_location, $to_location, $quantity, $user_id);

    if ($stmt_orders->execute()) {
        // Insert into `shipment` table
        $stmt_shipments = $conn->prepare("INSERT INTO shipment 
            (order_id, username, customer_name, item_name, from_location, to_location, quantity, shipment_date, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'Pending')");

        if (!$stmt_shipments) {
            die("Error preparing statement for shipments: " . $conn->error);
        }

        $stmt_shipments->bind_param("ssssssi", $order_id, $username, $customer_name, $item_name, $from_location, $to_location, $quantity);

        if ($stmt_shipments->execute()) {
            // Success message
            echo "Order placed successfully. Your Order Number is: <strong>$order_id</strong>";
            header('Refresh: 3; url=../dashboard.php');
            exit();
        } else {
            // Log error for shipments table
            error_log("Error inserting into shipments: " . $stmt_shipments->error);
            echo "Error while placing shipment details: " . $stmt_shipments->error;
        }

        $stmt_shipments->close();
    } else {
        // Log error for orders table
        error_log("Error inserting into orders: " . $stmt_orders->error);
        echo "Error while placing order: " . $stmt_orders->error;
    }

    $stmt_orders->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
</head>
<body>
    
</body>
</html>