<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
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

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT u_name, active FROM login WHERE Id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows == 1) {
    $user = $user_result->fetch_assoc();
    $username = $user['u_name'];
    $is_active = $user['active']; // Check if the user is active
} else {
    echo "User not found.";
    exit();
}

// Check for reactivation request status (example logic)
$request_status = 'none'; // Default
$request_stmt = $conn->prepare("SELECT status FROM reactivation_requests WHERE user_id = ?");
$request_stmt->bind_param("i", $user_id);
$request_stmt->execute();
$request_result = $request_stmt->get_result();

if ($request_result->num_rows == 1) {
    $request_row = $request_result->fetch_assoc();
    $request_status = $request_row['status'];
}

// Fetch unread notifications
$notif_query = "SELECT message, created_at FROM notifications WHERE user_id = ? AND is_read = FALSE ORDER BY created_at DESC";
$notif_stmt = $conn->prepare($notif_query);
$notif_stmt->bind_param("i", $user_id);
$notif_stmt->execute();
$notif_result = $notif_stmt->get_result();

// Mark notifications as read
$mark_read_query = "UPDATE notifications SET is_read = TRUE WHERE user_id = ?";
$mark_read_stmt = $conn->prepare($mark_read_query);
$mark_read_stmt->bind_param("i", $user_id);
$mark_read_stmt->execute();

// Close database resources
$notif_stmt->close();
$mark_read_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics Management System</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8i6K+Knujsz6Qj9E4eRczUbsmiJd4v0uwu9FqUq5VsDhPUUOw7vF5eBgg5" crossorigin="anonymous">
</head>
<body>
<!-- Header -->
<?php include 'header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Welcome, <?php echo ($username); ?>!</h1>
        <!-- Logout Button - Display only if the account is inactive -->
        <?php if ($is_active == 0): ?>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        <?php endif; ?>
    </div>
</div>

    <!-- Account Status Messages -->
    <?php if ($is_active == 0): ?>
        <div class="alert alert-warning">
            Your account is has been block due to some reason. Please wait for reactivation approval.
            <br>
            <strong>Status of your reactivation request:</strong>
            <?php 
                echo ($request_status === 'pending') ? 'Pending Approval' : 
                     ($request_status === 'approved' ? 'Approved' : 'No Request Submitted');
            ?>
        </div>
  
    <?php endif; ?>

    <!-- User Dashboard -->
    <?php if ($is_active == 1): ?>
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Place a New Order</h5>
                        <p class="card-text">Easily place a new shipment order for your goods.</p>
                        <a href="../public/order/order_form.php" class="btn btn-primary">Place Order</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Track Shipments</h5>
                        <p class="card-text">View the real-time status of your shipments.</p>
                        <a href="../public/tracking/track.php" class="btn btn-primary">Track Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Order History</h5>
                        <p class="card-text">Review your previous orders and shipment details.</p>
                        <a href="../public/user_dashboard.php" class="btn btn-primary">View History</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Account Settings -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Account Settings</h5>
                        <p class="card-text">Update your profile and account preferences.</p>
                        <a href="update.php" class="btn btn-primary">Manage Account</a>
                    </div>
                </div>
            </div>
         <!-- Help & Support -->
         <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Help & Support</h5>
                        <p class="card-text">Get assistance with your queries and issues.</p>
                        <a href="faqs.php" class="btn btn-primary">Get Help</a>
                    </div>
                </div>
            </div>

            <!-- Logout -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Sign out of your account securely.</p>
                        <a href="../public/logout.php" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <a href="request.php" class="btn btn-primary btn-lg mt-3">Request Reactivation</a>
    <?php endif; ?>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>


<script>
        // Function to hide the alert after 3 seconds
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000); 
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-GLhlTQ8i6K+Knujsz6Qj9E4eRczUbsmiJd4v0uwu9FqUq5VsDhPUUOw7vF5eBgg5" crossorigin="anonymous"></script>
</body>
</html>
