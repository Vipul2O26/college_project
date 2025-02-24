<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure that the 'id' GET parameter is set
if (!isset($_GET['id'])) {
    echo "Invalid request!";
    exit();
}

// Get the request ID from the URL
$request_id = intval($_GET['id']);

// Database connection
$host = 'localhost';
$db = 'project';
$pass = '';
$user = 'root';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the status of the reactivation request to 'approved'
$stmt = $conn->prepare("UPDATE reactivation_requests SET status = 'approved' WHERE id = ?");
$stmt->bind_param("i", $request_id);

if ($stmt->execute()) {
    // After successfully updating the reactivation request, fetch the user_id
    $stmt2 = $conn->prepare("SELECT user_id FROM reactivation_requests WHERE id = ?");
    $stmt2->bind_param("i", $request_id);
    $stmt2->execute();
    $result = $stmt2->get_result();

    if ($result->num_rows > 0) {
        // Get the user_id associated with the reactivation request
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        // Now update the 'active' column in the 'login' table to 1
        $stmt3 = $conn->prepare("UPDATE login SET active = 1 WHERE Id = ?");
        $stmt3->bind_param("i", $user_id);

        if ($stmt3->execute()) {
            // Reactivation successful; log the user in and redirect to the dashboard
            $_SESSION['user_id'] = $user_id;

            // Fetch username for session (optional, depending on your logic)
            $stmt4 = $conn->prepare("SELECT u_name FROM login WHERE Id = ?");
            $stmt4->bind_param("i", $user_id);
            $stmt4->execute();
            $result4 = $stmt4->get_result();
            if ($result4->num_rows > 0) {
                $user_data = $result4->fetch_assoc();
                $_SESSION['username'] = $user_data['u_name'];
            }

            // Redirect to the user dashboard
            header("Location: admin.php?message=Reactivation successful. Welcome back!");
            exit(); // Ensure the script stops after the redirect
        } else {
            // Error updating the login table
            header("Location: userrequest.php?message=Error updating user status.");
            exit();
        }
        $stmt3->close();
    } else {
        // Error: No user found for the given reactivation request
        header("Location: userrequest.php?message=User not found for the reactivation request.");
        exit();
    }

    $stmt2->close();
} else {
    // Error updating the reactivation request status
    header("Location: userrequest.php?message=Error updating request.");
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
