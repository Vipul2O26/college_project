<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'project';
$pass = '';
$user = 'root';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $reason = trim($_POST['reason']);
    
    // Insert reactivation request into the database
    $stmt = $conn->prepare("INSERT INTO reactivation_requests (user_id, reason, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("is", $user_id, $reason);
    
    if ($stmt->execute()) {
        // Redirect to the dashboard after successful request submission
        header("Location: dashboard.php");
        exit();
    } else {
        // If there's an error while inserting the reactivation request
        echo "<div class='alert alert-danger'>There was an error submitting your request. Please try again later.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reactivation Request</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h3 class="mb-4">Account Deactivated</h3>
            <p>Your account has been deactivated. If you would like to reactivate your account, please submit a reactivation request below.</p>

            <!-- Reactivation Request Form -->
            <form method="POST" action="request.php">
                <div class="mb-3">
                    <label for="reason" class="form-label">Reason for Reactivation Request</label>
                    <input class="form-control" id="reason" name="reason" rows="3" required></input>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS & Popper.js (for Bootstrap components like modals, tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybG3t1KJXz6Vo4/9As62wS5ES8aJHA73tBVGyL2SnhBbD3/3M" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0AYgFz6fn9k4vVtY6jQF6MCw/5Q1TYX4e7nT9oJ7DvhqZXWx" crossorigin="anonymous"></script>
</body>
</html>
