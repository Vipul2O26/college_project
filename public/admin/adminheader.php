<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="fav.png">

    <link href="../../assets/css/bootstrap" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
</head>


<body>

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Centered buttons -->
            <div class="mx-auto d-flex">
                <a class="btn btn-light me-2" href="admin.php" role="button">Home</a>
                <a class="btn btn-success me-2" href="audit.php" role="button">Audit</a>
                <a class="btn btn-success me-2" href="manageuser.php" role="button">See All User</a>
            </div>

            <!-- Profile Dropdown -->
            <div class="dropdown dropstart ms-auto">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <hr>
                    <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
