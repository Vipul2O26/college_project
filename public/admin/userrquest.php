<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$db = 'task';
$pass = '';
$user = 'root';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all requests with 'pending' status
$stmt = $conn->prepare("SELECT * FROM reactivation_requests WHERE status = 'pending'");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reactivation Requests</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Reactivation Requests</h1>

    <?php
    // Display all pending requests
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card p-3 my-3'>
                <div class='card-body'>
                    <p><strong>User ID:</strong> " . $row['user_id'] . "</p>
                    <p><strong>Reason:</strong> " . $row['reason'] . "</p>
                    <a href='approve.php?id=" . $row['id'] . "' class='btn btn-success'>Approve</a>
                    <a href='approve.php?id=" . $row['id'] . "' class='btn btn-danger'>Reject</a>
                </div>
              </div>";
    }


    if ($result->num_rows == 0) {
        echo "<p class='text-center'>No pending requests.</p>";
    }
    ?>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>
