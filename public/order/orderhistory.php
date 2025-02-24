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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>
<body>

</body>
</html>

<?php

$host = 'localhost';
$db = 'project';
$pass = '';
$user = 'root';


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

<?php include'orderheader.php';?>


<?php
echo "<h1>Welcome, " .($_SESSION['username']) . "! Dashboard</h1>";


$user=$_SESSION['username'];


$qry = "SELECT * FROM orders where customer_name like '%".$user."%' order by order_id";
$rs = mysqli_query($conn, $qry);


if ($rs) {
   
 

      echo"<table class='table table-striped table-dark'>";
      echo"<tr><th class='table-primary'>Name</th><th class='table-primary'>Order Id</th><th class='table-primary'>Item Name</th><th class='table-primary'>Arrival point</th><th class='table-primary'>Destination point</th><th class='table-primary'>Date</th><th class='table-primary'>Status</th></tr></tr>";
    
    while ($val = mysqli_fetch_assoc($rs)) {
        echo "<tr>";
        echo "<td class='table-success'>" . ($val["customer_name"]) . "</td>";
        echo "<td class='table-success'>" . ($val["order_id"]) . "</td>";
        echo "<td class='table-success'>" . ($val["item_name"]) . "</td>";
        echo "<td class='table-success'>" . ($val["from_location"]) . "</td>";
        echo "<td class='table-success'>" . ($val["to_location"]) . "</td>";
        echo "<td class='table-success'>" . ($val["order_date"]) . "</td>";
        echo "<td class='table-success'>" . ($val["status"]) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}


$conn->close();
?>