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

?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    <link rel="stylesheet" href="../assets/css/bootstrap">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Update Password</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="edit.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" 
                               placeholder="<?php echo $_SESSION['username']; ?>" 
                               name="username" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" placeholder="Enter new password" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="cnfpass">Confirm Password</label>
                        <input type="password" class="form-control" id="cnfpass" placeholder="Confirm new password" name="cnfpass" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
