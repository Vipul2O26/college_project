<?php
session_start();

// Database configuration
$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the session variable `type` is set
if (!isset($_SESSION['type'])) {
    echo "<script>alert('User type not set. Please log in again.'); window.location.href = 'login.php';</script>";
    exit;
}

$userType = htmlspecialchars($_SESSION['type']); // Fetch the user type from session securely

// Handle password change request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('You must be logged in to change your password.'); window.location.href = 'login.php';</script>";
        exit;
    }

    $currentUsername = $_SESSION['username']; // Ensure username is set in the session
    $Pass = trim($_POST['pass']);
    $cnfPass = trim($_POST['cnfpass']);

    // Check if passwords match
    if ($Pass !== $cnfPass) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit;
    }

    // Update password query
    $updateQuery = "UPDATE `login` SET `u_pass` = ? WHERE `u_name` = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt) {
        // Bind parameters (plain text password and username)
        $stmt->bind_param("ss", $Pass, $currentUsername);
        if ($stmt->execute()) {
            echo "<script>alert('Password updated successfully!');</script>";
            // Redirect based on user type
            if ($userType === 'client') {
                header('Location: ../public/client/clientdash.php');
            } else {
                header('Location: dashboard.php');
            }
            exit; // Ensure the script ends after the header call
        } else {
            echo "<script>alert('Error updating password: " . htmlspecialchars($stmt->error) . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . htmlspecialchars($conn->error) . "'); window.history.back();</script>";
    }
}

$conn->close();
?>
