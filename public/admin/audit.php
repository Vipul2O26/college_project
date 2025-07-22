<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit History</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .dashboard-title {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<?php include 'adminheader.php'; ?>

<div class="container">
    <h2 class="dashboard-title text-center text-primary">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! Audit History</h2>

    <?php
    $host = 'localhost';
    $db = 'project';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
    }

    $qry = "SELECT * FROM audit ORDER BY Audit_id";
    $rs = mysqli_query($conn, $qry);

    if ($rs && mysqli_num_rows($rs) > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-hover table-striped'>";
        echo "<thead class='table-dark'><tr>
                <th>Audit ID</th>
                <th>Username</th>
                <th>Type</th>
                <th>Date</th>
              </tr></thead><tbody>";
        while ($val = mysqli_fetch_assoc($rs)) {
            echo "<tr>
                    <td>" . htmlspecialchars($val["Audit_id"]) . "</td>
                    <td>" . htmlspecialchars($val["user_name"]) . "</td>
                    <td>" . htmlspecialchars($val["type"]) . "</td>
                    <td>" . htmlspecialchars($val["date"]) . "</td>
                  </tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<div class='alert alert-info'>No audit records found.</div>";
    }

    $conn->close();
    ?>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
