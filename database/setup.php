<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "project";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($database);

// SQL script
$sqlScript = file_get_contents('project.sql');

// Execute SQL script
if ($conn->multi_query($sqlScript)) {
    echo "Database setup completed successfully.";
} else {
    echo "Error setting up database: " . $conn->error;
}

// Close connection
$conn->close();
?>
