<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 CDN -->
    <link href="../../assets/css/bootstrap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            margin-top: 30px;
        }
        .table-wrapper {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<?php include 'adminheader.php'; ?>

<div class="container">
    <h1 class="text-center text-primary">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! Dashboard</h1>

    <div class="table-wrapper">
        <?php
        $qry = "SELECT * FROM login WHERE active = 1 ORDER BY Id";
        $rs = mysqli_query($conn, $qry);

        if ($rs) {
            echo "<table class='table table-bordered table-hover table-striped'>";
            echo "<thead class='table-dark'>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                  </thead>";
            echo "<tbody>";

            while ($val = mysqli_fetch_assoc($rs)) {
                $userId = $val['Id'];
                $username = $val['u_name'];
                $userType = $val['type'];

                echo "<tr>";
                echo "<td>" . $userId . "</td>";
                echo "<td>" . htmlspecialchars($username) . "</td>";
                echo "<td>" . $userType . "</td>";
                echo "<td>
                        <a href='viewhistory.php?user_id=$userId' class='btn btn-sm btn-info me-2'>View History</a>
                        <a href='delete_user.php?user_id=$userId' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Block User</a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }

        $conn->close();
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
