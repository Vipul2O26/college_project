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

// Get the logged-in user's ID
$client_id = intval($_SESSION['user_id']);

// Query to fetch shipments assigned to the user or unassigned orders
$query = "
    SELECT 
        s.order_id, s.customer_name, s.item_name, s.from_location, s.to_location, 
        s.quantity, s.shipment_date, s.status, o.username, s.dealer_id
    FROM shipment s
    LEFT JOIN orders o ON s.order_id = o.order_id
    WHERE s.dealer_id IS NULL OR s.dealer_id = ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param('i', $client_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Shipments</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'client_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4 text-primary">All Shipments</h2>

        <!-- Display success message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success text-center">
                <?= htmlspecialchars($_SESSION['message']); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (count($orders) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Sr No</th>
                            <th>Order Id</th>
                            <th>UserName</th>
                            <th>Customer Name</th>
                            <th>Item Name</th>
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $index => $order): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($order['order_id']); ?></td>
                                <td><?= htmlspecialchars($order['username'] ?? 'N/A'); ?></td>
                                <td><?= htmlspecialchars($order['customer_name']); ?></td>
                                <td><?= htmlspecialchars($order['item_name']); ?></td>
                                <td><?= htmlspecialchars($order['from_location']); ?></td>
                                <td><?= htmlspecialchars($order['to_location']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($order['quantity']); ?></td>
                                <td class="text-center"><?= date('d-m-Y H:i', strtotime($order['shipment_date'])); ?></td>
                                <td class="text-center">
                                    <?php if (empty($order['dealer_id'])): ?>
                                        <!-- Show "Available" for unassigned orders -->
                                        <form method="GET" action="take_shipment.php" class="d-inline">
                                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']); ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Take</button>
                                        </form>
                                    <?php elseif ($order['dealer_id'] == $client_id): ?>
                                        <!-- Show "Assigned to You" for orders assigned to the current user -->
                                        <span class="badge bg-success">Assigned to You</span>
                                    <?php else: ?>
                                        <!-- Hide action for orders assigned to other dealers -->
                                        <span class="badge bg-secondary">Assigned</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="alert alert-warning text-center">No shipments found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
