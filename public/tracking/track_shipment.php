<?php
// Start session
session_start();

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

// Check if the `order_id` is passed
if (isset($_GET['order_id'])) {
    $order_id = trim($_GET['order_id']);

    // Prepare and execute the query to fetch the order details
    $query = "SELECT * FROM shipment WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the order exists
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        $error_message = "No shipment found with the provided Order Number.";
    }

    $stmt->close();
} else {
    $error_message = "Please provide a valid Order Number.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Shipment</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
        }
        h2 {
            margin-top: 20px;
        }
        .shipment-details {
            display: inline-block;
            margin-top: 20px;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include'trachheader.php'; ?>
    <h2>Shipment Details</h2>
    <?php if (isset($error_message)): ?>
        <p class="error"><?= htmlspecialchars($error_message); ?></p>
    <?php else: ?>
        <div class="shipment-details">
            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']); ?></p>
            <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['customer_name']); ?></p>
            <p><strong>Item Name:</strong> <?= htmlspecialchars($order['item_name']); ?></p>
            <p><strong>From:</strong> <?= htmlspecialchars($order['from_location']); ?></p>
            <p><strong>To:</strong> <?= htmlspecialchars($order['to_location']); ?></p>
            <p><strong>Quantity:</strong> <?= htmlspecialchars($order['quantity']); ?></p>
            <p><strong>Order Date:</strong> <?= htmlspecialchars($order['shipment_date']); ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($order['status']); ?></p>
            <p><strong>Dealer Name:</strong> <?= htmlspecialchars($order['dealer_name']); ?></p>          
            <?php if (!empty($order['tracking_details'])): ?>
                <p><strong>Tracking Details:</strong> <?= nl2br(htmlspecialchars($order['tracking_details'])); ?></p>
            <?php else: ?>
                <p><strong>Tracking Details:</strong> Not available.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
