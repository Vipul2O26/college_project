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
    <title>Histroy</title>
    <link rel="icon" type="image/x-icon" href="fav.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>
<body>

</body>
</html>


<?php

$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


include 'adminheader.php'; 


echo "<h1>Welcome, " .($_SESSION['username']) . "! Dashboard</h1>";



$qry = "SELECT * FROM audit ORDER BY Audit_id";
$rs = mysqli_query($conn, $qry);


if ($rs) {
    //echo "<br>Total Records: " . mysqli_num_rows($rs);
 

      echo"<table class='table table-striped table-dark'>";
      echo"<tr><th class='table-primary'>Audit id</th><th class='table-primary'>username</th><th class='table-primary'>Type</th><th class='table-primary'>Date</th></tr>";
    
    while ($val = mysqli_fetch_assoc($rs)) {
        echo "<tr>";
        echo "<td class='table-success'>" . ($val["Audit_id"]) . "</td>";
        echo "<td class='table-success'>" . ($val["user_name"]) . "</td>";
        echo "<td class='table-success'>" . ($val["type"]) . "</td>";
        echo "<td class='table-success'>" . ($val["date"]) . "</td>";
        
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}


$conn->close();
?>