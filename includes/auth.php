<?php
session_start();

// Database Configuration
$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

// Database Connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $U_name = trim($_POST['username']);
    $Pass = trim($_POST['password']);
    $Type = trim($_POST['type']);
    $date = date('Y-m-d H:i:s');

    // Validate user credentials
    $stmt = $conn->prepare("SELECT Id, u_name, type, u_pass, active FROM login WHERE u_name = ? AND type = ?");
    $stmt->bind_param("ss", $U_name, $Type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['Id'];
        $_SESSION['username'] = $user['u_name'];
        $_SESSION['type'] = $user['type'];

       $user=$_SESSION['user_id'];
       
       
        // $stmt = $conn->prepare("INSERT INTO audit (Audit_id, user_name, type, date) VALUES (?, ?, ?, ?)");
        // $stmt->bind_param("isss", $user,$U_name, $Type, $date);
    
        // if ($stmt->execute()) {
        //     echo "<br>Successfully Inserted into audit table";
        // } else {
        //     echo "<br>Error: " . $stmt->error;
        // }
    
        $stmt->close();

        // Redirect based on user type
        if ($Type === 'user') {
            header("Location: ../public/dashboard.php");
        } elseif ($Type === 'client') {
            header("Location: ../public/client/clientdash.php");
        } else {
            header("Location: ../public/admin/admin.php");
        }
        exit();
    } else {
        // Redirect to login page on failure
        header("Location: ../public/login.html");
        exit();
    }
}

$conn->close();
?>
