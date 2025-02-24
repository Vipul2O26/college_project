<?php
session_start();

if (!isset($_SESSION['user_id'])) {
   
    header("Location: ../public/login.html");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Contact page</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    <link href="../assets/css/contact.css" rel="stylesheet">
 </head>
<body>


<?php include'header.php'; ?>
    <div class="bg-background"></div>
    <div class="container py-5">
        <div class="row py-5 g-3">

            <div class="col-md-6 first_col">
                <h1 class="text-center mt-3">Contact Us</h1>
                <form class="p-4 mt-5">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter your Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email ID</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Enter your message</label>
                        <textarea  type="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Send Now</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 sec_col">
                <img src="../assets/images/contact.jpg"
                    class="img-fluid">
            </div>
        </div>
        <div class="row-last">
            <div class="row row-cols-1 row-cols-md-3  p-3 text-white">
                <div class="col">
                    <h4>CALL US</h4>
                    <p>+91 6589-565-543</p>
                </div>
                <div class="col">
                    <h4>LOCATION</h4>
                    <p>Anand</p>
                </div>
                <div class="col">
                    <h4>Email</h4>
                    <p>vipulkj608@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
<br>
    <?php include'footer.php';  ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

   
</body>

</html>