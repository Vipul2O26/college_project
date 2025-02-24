<?php

$host = 'localhost';
$db = 'project';
$pass = '';
$user = 'root';


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "connected....";
?>
