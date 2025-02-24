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

// Get user-specific orders (for the logged-in user)
$user_name = $_SESSION['username'];


$query = "SELECT * FROM orders WHERE username = ?";

$stmt = $conn->prepare($query);

// Check if the prepare statement was successful
if ($stmt === false) {
    die("SQL Error: " . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("s", $user_name);

if (!$stmt->execute()) {
    die("Execution Error: " . $stmt->error);
}

$result = $stmt->get_result();
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" type="image/x-icon" href="fav.png">

    <?php include'header.php'; ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
    
        .status-pending {
            color: red;
            font-weight: bold;
        }
        .status-confirmed {
            color: green;
            font-weight: bold;
        }
        .table-primary {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Orders</h2>

        <?php if (count($orders) > 0): ?>
            <div class="table-responsive">
                <table class="table table-light table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>Sr No</th>
                            <th>Item Name</th>
                            <th>User Name</th>
                            <th>Order Id</th>
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $index => $order): ?>
                            <tr id="order-<?= $order['order_id']; ?>">
                                <td class="text-center"><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($order['item_name']); ?></td>
                                <td><?= htmlspecialchars($order['username']); ?></td>
                                <td><?= htmlspecialchars($order['order_id']); ?></td>
                                <td><?= htmlspecialchars($order['from_location']); ?></td>
                                <td><?= htmlspecialchars($order['to_location']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($order['quantity']); ?></td>
                                <td class="text-center"><?= date('d-m-Y H:i', strtotime($order['order_date'])); ?></td>
                              
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="alert alert-warning text-center">No orders found.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

