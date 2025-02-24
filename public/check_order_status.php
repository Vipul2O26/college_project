<?php
// Database connection
$host = 'localhost';
$db = 'project';
$pass = '';
$user = 'root';
$conn = new mysqli($host, $user, $pass, $db);

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the order ID from the query parameter
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // Make sure the order_id is valid

    // Prepare the SQL query to fetch the order status
    $query = "SELECT status FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($query);

    // Check if the prepare statement was successful
    if ($stmt === false) {
        // Output the error message if prepare fails
        die("SQL Error: " . $conn->error);
    }

    // Bind the parameters and execute the query
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        $stmt->store_result(); // Store the result to check the query
        $stmt->bind_result($status);
        $stmt->fetch(); // Fetch the status

        // Return the status as a JSON response
        echo json_encode(['status' => $status]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error executing query']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Order ID not provided']);
}

$conn->close();
?>
