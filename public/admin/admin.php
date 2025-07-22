<?php
// Start session
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/../../assets/images/fav.png">
    
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap" 
          rel="stylesheet" 
         >
</head>
<body>
    <!-- Include the admin header -->
    <?php include 'adminheader.php'; ?>

    <!-- Main Content -->
    <div class="container mt-5">
        <!-- Greeting Section -->
        <div class="text-center">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p class="lead">Dashboard</p>
        </div>
        
        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="view_requests.php" class="btn btn-primary">View Reactivation Requests</a>
        </div>
    </div>

 
</body>
</html>
