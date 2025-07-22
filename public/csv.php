<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to generate the report.");
}

// Database connection
$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


$query = "SELECT order_id, item_name, from_location, to_location, quantity, order_date FROM orders";
$result = $conn->query($query);

if ($result->num_rows === 0) {
    die("No orders found.");
}

// Set the filename
$fileName = "orders_report_" . date('Ymd_His') . ".csv";

// Set headers to force download
header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Open output stream
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Sr No', 'Order ID', 'Item Name', 'From Location', 'To Location', 'Quantity', 'Order Date']);

// Write data to CSV
$srNo = 1;
while ($order = $result->fetch_assoc()) {
    fputcsv($output, [
        $srNo,
        $order['order_id'],
        $order['item_name'],
        $order['from_location'],
        $order['to_location'],
        $order['quantity'],
        date('d-m-Y H:i', strtotime($order['order_date']))
    ]);
    $srNo++;
}

// Close the output stream
fclose($output);

// Close the database connection
$conn->close();
exit();

header('Location: ../clientdash.php')
?>
