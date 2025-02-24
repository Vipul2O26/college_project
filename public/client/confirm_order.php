<?php
session_start();

// Ensure the client is logged in
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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Confirm the order
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Update the order status
    $update_query = "UPDATE orders SET status = 'Confirmed' WHERE order_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("s", $order_id);

    if ($stmt->execute()) {
       
        $select_user_query = "SELECT user_id FROM orders WHERE order_id = ?";
        $user_stmt = $conn->prepare($select_user_query);
        $user_stmt->bind_param("s", $order_id);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();

        if ($user_result->num_rows > 0) {
            $user = $user_result->fetch_assoc();
            $user_id = $user['user_id'];

            // Insert a notification for the user
            $notification_query = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
            $notif_stmt = $conn->prepare($notification_query);
            $message = "Your order with ID $order_id has been confirmed.";
            $notif_stmt->bind_param("is", $user_id, $message);
            $notif_stmt->execute();
            $notif_stmt->close();
        }

        $_SESSION['message'] = "Order confirmed and user notified.";
    } else {
        $_SESSION['message'] = "Failed to confirm order.";
    }

    $stmt->close();
    $user_stmt->close();
}

$conn->close();

// Redirect back to shipments page
header("Location: clientdash.php");
exit();
?>
