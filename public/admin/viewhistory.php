<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database configuration
$host = 'localhost';
$db = 'project';
$user = 'root';
$pass = '';

// Create a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch session details
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Display a welcome message
echo "<h1>Welcome, " . htmlspecialchars($username) . "! Dashboard</h1>";


$qry = "SELECT * FROM audit WHERE Id = ? ORDER BY date DESC";
$stmt = $conn->prepare($qry);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters (user_id is an integer)
$stmt->bind_param("i", $user_id);

// Execute the statement
if (!$stmt->execute()) {
    die("Execution failed: " . $stmt->error);
}

// Fetch results
$result = $stmt->get_result();

// Display data in a table
if ($result->num_rows > 0) {
    echo "<table class='table table-striped table-dark'>";
    echo "<thead>";
    echo "<tr><th class='table-primary'>Username</th><th class='table-primary'>Type</th><th class='table-primary'>Date</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='table-success'>" . htmlspecialchars($row["user_name"]) . "</td>";
        echo "<td class='table-success'>" . htmlspecialchars($row["type"]) . "</td>";
        echo "<td class='table-success'>" . htmlspecialchars($row["date"]) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
