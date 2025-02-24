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
    <title>Create Order</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/fav.png">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: You can also add your own CSS file here -->
    <style>
        body {
            padding-top: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Create a New Order</h2>
        <form action="process_order.php" method="POST" id="orderForm">
            <!-- Customer Name -->
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" required>
            </div>

            <!-- Item Name -->
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name:</label>
                <input type="text" id="item_name" name="item_name" class="form-control" required>
            </div>

            <!-- From Location -->
            <div class="mb-3">
                <label for="from_location" class="form-label">From Location:</label>
                <input type="text" id="from_location" name="from_location" class="form-control" required>
            </div>

            <!-- To Location -->
            <div class="mb-3">
                <label for="to_location" class="form-label">To Location:</label>
                <input type="text" id="to_location" name="to_location" class="form-control" required>
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Place Order</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript Validation (Optional) -->
    <script>
        document.getElementById("orderForm").addEventListener("submit", function(event) {
            var customerName = document.getElementById("customer_name").value;
            var itemName = document.getElementById("item_name").value;
            var fromLocation = document.getElementById("from_location").value;
            var toLocation = document.getElementById("to_location").value;
            var quantity = document.getElementById("quantity").value;

            if (!customerName || !itemName || !fromLocation || !toLocation || !quantity) {
                alert("Please fill in all fields.");
                event.preventDefault(); // Prevent form submission if fields are missing
            }
        });
    </script>
</body>
</html>
