<?php
// db.php - Database connection file

$servername = "localhost";
$username   = "root";   // default in XAMPP
$password   = "";       // default in XAMPP
$dbname     = "portfolio"; // the database you created in creation.php

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>

<!-- When your PHP script finishes running, PHP automatically closes the database connection and frees resources.  -->
