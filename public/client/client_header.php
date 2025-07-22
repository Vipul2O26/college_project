<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Header</title>
    <link rel="icon" type="image/x-icon" href="fav.png">

    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logistic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link btn btn-dark me-2" href="clientdash.php">Home</a>
                  
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="../update.php">Edit</a></li>
                    <li><a class="dropdown-item" href="clienthistroy.php">History</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap 5 JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
