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

include 'adminheader.php'; 

echo "<h1>Welcome, " . ($_SESSION['username']) . "! Dashboard</h1>";

$qry = "SELECT * FROM login WHERE active = 1 ORDER BY Id";
$rs = mysqli_query($conn, $qry);

if ($rs) {
    echo "<table class='table table-striped table-dark'>";
    echo "<tr><th class='table-primary'>Id</th><th class='table-primary'>Username</th><th class='table-primary'>Type</th><th class='table-primary'>Actions</th></tr>";
    
    while ($val = mysqli_fetch_assoc($rs)) {
        $userId = $val['Id'];
        $username = $val['u_name'];
        $userType = $val['type'];

        echo "<tr>";
        echo "<td class='table-success'>" . $userId . "</td>";
        echo "<td class='table-success'>" . $username . "</td>";
        echo "<td class='table-success'>" . $userType . "</td>";

        // Adding action buttons (View History & Delete)
        echo "<td class='table-success'>";
        echo "<a href='viewhistory.php?user_id=$userId' class='btn btn-info'>View History</a> ";
        echo "<a href='delete_user.php?user_id=$userId' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Block user</a>";
        echo "</td>";

        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}

$conn->close();
?>
