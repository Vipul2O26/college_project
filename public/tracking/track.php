<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Shipment</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/fav.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include'trachheader.php'; ?>

    <div class="container text-center">
        <h2 class="my-4">Track Your Shipment</h2>

        <div class="form-container">
            <form action="track_shipment.php" method="get" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="tracking_number" class="form-label">Order Number:</label>
                    <input 
                        type="text" 
                        id="tracking_number" 
                        name="order_id" 
                        class="form-control" 
                        required 
                        placeholder="Enter tracking number"
                    >
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Track</button>
            </form>
            <!-- Back to Dashboard Button -->
            <a href="../dashboard.php" class="btn btn-secondary w-100">Back to Dashboard</a>
            <p class="text-danger mt-2" id="error-message"></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm() {
            const trackingNumber = document.getElementById("tracking_number").value.trim();
            const errorMessage = document.getElementById("error-message");

            if (!trackingNumber) {
                errorMessage.textContent = "Tracking number cannot be empty.";
                return false;
            }

            if (trackingNumber.length < 5) {
                errorMessage.textContent = "Tracking number must be at least 5 characters long.";
                return false;
            }

            errorMessage.textContent = ""; 
            return true;
        }
    </script>
</body>
</html>
