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

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure shipment_id is provided
if (!isset($_GET['shipment_id']) || empty($_GET['shipment_id'])) {
    echo "Invalid request!";
    exit();
}

$shipment_id = (int) $_GET['shipment_id']; // Explicitly cast to integer

// Check if the shipment ID is valid
if ($shipment_id <= 0) {
    die("Invalid shipment ID.");
}

// Fetch shipment details
$query = "SELECT * FROM shipment WHERE shipment_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error preparing the query: " . $conn->error);
}

$stmt->bind_param('i', $shipment_id);  // Ensure $shipment_id is passed as an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Shipment not found!";
    exit();
}

$shipment = $result->fetch_assoc();
$stmt->close();

// Handle form submission to update the shipment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $from_location = htmlspecialchars(trim($_POST['from_location']));
    $status = htmlspecialchars(trim($_POST['status']));
    $valid_statuses = ['Pending', 'Shipped', 'Delivered'];

    // Validate the status
    if (!in_array($status, $valid_statuses)) {
        echo "Invalid status!";
        exit();
    }

    // Update query for shipment table
    $update_shipment_query = "UPDATE shipment SET from_location = ?, status = ? WHERE shipment_id = ?";
    
    $update_shipment_stmt = $conn->prepare($update_shipment_query);

    if (!$update_shipment_stmt) {
        die("Error preparing the shipment update query: " . $conn->error);
    }

    // Ensure correct data types (string, string, integer)
    $update_shipment_stmt->bind_param("ssi", $from_location, $status, $shipment_id); 

    // Execute the update query for shipment table
    if ($update_shipment_stmt->execute()) {
        $_SESSION['message'] = "Shipment status updated successfully.";
        header("Location: clientdash.php");
        exit();
    } else {
        echo "Error updating shipment status.";
    }

    $update_shipment_stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Shipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="fav.png">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Shipment</h2>
        <form method="POST">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" value="<?= htmlspecialchars($shipment['customer_name']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" class="form-control" id="item_name" value="<?= htmlspecialchars($shipment['item_name']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="from_location">From Location</label>
                <input type="text" class="form-control" id="from_location" name="from_location" value="<?= htmlspecialchars($shipment['from_location']); ?>" required>
            </div>

            <div class="form-group">
                <label for="to_location">To Location</label>
                <input type="text" class="form-control" id="to_location" value="<?= htmlspecialchars($shipment['to_location']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Pending" <?= ($shipment['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="Shipped" <?= ($shipment['status'] == 'Shipped') ? 'selected' : '' ?>>Shipped</option>
                    <option value="Delivered" <?= ($shipment['status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
