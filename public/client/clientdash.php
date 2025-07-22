<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   
    <link rel="icon" type="image/x-icon" href="fav.png">

    <link href="../../assets/css/bootstrap" rel="stylesheet">
    
   
</head>
<body>
    <?php include 'client_header.php'; ?>

    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>

    <div class="container mt-5">
        <h2 class="section-title">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>, to the Logistics Dashboard</h2>

        <div class="row">
            <!-- Get Shipment Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="../../assets/images/ship.jpg" class="card-img-top" alt="Get Shipment">
                    <div class="card-body">
                        <h5 class="card-title">Get Shipment</h5>
                        <p class="card-text">View and manage all your shipment details.</p>
                        <a href="shippment.php" class="btn btn-custom w-100">View Shipments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="../../assets/images/ship.jpg" class="card-img-top" alt="Get Shipment">
                    <div class="card-body">
                        <h5 class="card-title">My Shippment</h5>
                        <p class="card-text">View and manage all your shipment details.</p>
                        <a href="client_account.php" class="btn btn-custom w-100">View Shipments</a>
                    </div>
                </div>
            </div>

         

            <!-- Reports Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="../../assets/images/report.png" class="card-img-top" alt="Reports">
                    <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">Generate and download detailed performance reports.</p>
                        <a href="../csv.php" class="btn btn-custom w-100">Generate Reports</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>


    <?php include 'footer.php'; ?>
</body>
</html>
