<?php
session_start();

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

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch shipments assigned to the user
$client_id = intval($_SESSION['user_id']);
$query = "SELECT * FROM shipment WHERE dealer_id = ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error); // Debugging line
}

$stmt->bind_param('i', $client_id);
$stmt->execute();
$result = $stmt->get_result();
$client_shipments = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Account</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'client_header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Shipments</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info text-center">
                <?= htmlspecialchars($_SESSION['message']); ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (count($client_shipments) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Item Name</th>
                            <th>Status</th>
                            <th>Actions</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($client_shipments as $shipment): ?>
                            <tr>
                                <td><?= htmlspecialchars($shipment['order_id']); ?></td>
                                <td><?= htmlspecialchars($shipment['customer_name']); ?></td>
                                <td><?= htmlspecialchars($shipment['item_name']); ?></td>
                                <td><?= htmlspecialchars($shipment['status']); ?></td>
                                <td>
                                    <!-- Update button -->
                                    <form method="GET" action="update_order.php" class="d-inline">
                                        <input type="hidden" name="shipment_id" value="<?= htmlspecialchars($shipment['shipment_id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-warning">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="alert alert-warning text-center">No shipments assigned to you.</p>
        <?php endif; ?>
    </div>

    <?php include'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
