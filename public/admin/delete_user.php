<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is provided in the URL
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    // Soft delete: Mark the user as inactive
    $delete_query = "UPDATE login SET active = 0 WHERE Id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect to the dashboard after successful deletion
        header("Location: admin.php?message=user_deleted");
        exit();
    } else {
        echo "<br>Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "<br>Error: No user ID provided.";
}

$conn->close();

?>
