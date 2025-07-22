<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database configuration
$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

// Create a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch session details
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - <?= htmlspecialchars($username) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- ✅ Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Optional Styling -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .dashboard-container {
            margin-top: 50px;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1, h5 {
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="text-center mb-4">
            <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
            <h5>Your Audit Log</h5>
        </div>

        <div class="table-container">
            <?php
            // Prepare and execute audit query
            $qry = "SELECT * FROM audit WHERE Audit_id = ? ORDER BY date DESC";
            $stmt = $conn->prepare($qry);

            if (!$stmt) {
                echo "<div class='alert alert-danger'>Prepare failed: " . $conn->error . "</div>";
            } else {
                $stmt->bind_param("i", $user_id);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0): ?>
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Username</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row["user_name"]) ?></td>
                                        <td><?= htmlspecialchars($row["type"]) ?></td>
                                        <td><?= htmlspecialchars($row["date"]) ?></td>
                                    
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info">No audit records found.</div>
                    <?php endif;

                    $stmt->close();
                } else {
                    echo "<div class='alert alert-danger'>Execution failed: " . $stmt->error . "</div>";
                }
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- ✅ Bootstrap JS + dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
