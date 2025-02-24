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
    <title>About us</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>
<body>
   <?php include 'header.php'; ?>
    
   
   <div class="flex justify-end p-4">
      
    </div>
    <div class="flex flex-col items-center justify-center h-screen text-center text-dark">
        <h1 class="text-4xl font-bold mb-4">Logistics Solutions</h1>
        <p class="text-lg mb-8 max-w-2xl">From the farm to your refrigerator, or the factory to your wardrobe, Logistc company is developing solutions that meet customer needs from one end of the supply chain to the other.</p>
        <div class="flex space-x-12">
            <div class="flex flex-col items-center">
                
                <span>Transportation Services</span>
            </div>
            <div class="flex flex-col items-center">
                
                <span>Digital Solutions</span>
            </div>
            <div class="flex flex-col items-center">
                
                <span>Supply Chain and Logistics</span>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>
</body>
</html>