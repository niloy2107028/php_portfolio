<?php
// Run this file once in VS Code terminal for creating database and tables

// Database connection info
$servername = "localhost"; 
$username = "root"; // default for XAMPP
$password = "";     // default for XAMPP

// Connect to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// First, drop the database if it already exists
$sql = "DROP DATABASE IF EXISTS portfolio";
if ($conn->query($sql) === TRUE) {
    echo "Old database dropped successfully\n";
} else {
    echo "Error dropping database: " . $conn->error;
}

// Create database
$sql = "CREATE DATABASE portfolio";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("portfolio");

// Create table skills
$sql = "CREATE TABLE skills (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(255) NOT NULL,
    skill_des VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "skills table created successfully\n";
} else {
    echo "Error creating table skills: " . $conn->error;
}

// Create table about
$sql = "CREATE TABLE about (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    img_url VARCHAR(255) NOT NULL,
    bio VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "about table created successfully\n";
} else {
    echo "Error creating table about: " . $conn->error;
}

// Create table education
$sql = "CREATE TABLE education (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(255) NOT NULL,
    degree VARCHAR(100) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "education table created successfully\n";
} else {
    echo "Error creating table education: " . $conn->error;
}

// Create table programming_language
$sql = "CREATE TABLE pl (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "PL table created successfully\n";
} else {
    echo "Error creating table PL: " . $conn->error;
}

// Create table web_dev
$sql = "CREATE TABLE wd (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "WD table created successfully\n";
} else {
    echo "Error creating table WD: " . $conn->error;
}

// Create table app_dev
$sql = "CREATE TABLE ad (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "AD table created successfully\n";
} else {
    echo "Error creating table AD: " . $conn->error;
}

// Create table tool_tech
$sql = "CREATE TABLE tt (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "TT table created successfully\n";
} else {
    echo "Error creating table TT: " . $conn->error;
}

// Create table others
$sql = "CREATE TABLE ot (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "OT table created successfully\n";
} else {
    echo "Error creating table OT: " . $conn->error;
}

// Create table projects
$sql = "CREATE TABLE projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    p_img_link VARCHAR(255) NOT NULL,
    p_title VARCHAR(255) NOT NULL,
    p_des TEXT NOT NULL,
    p_tech VARCHAR(255) NOT NULL,
    p_link VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "projects table created successfully\n";
} else {
    echo "Error creating table projects: " . $conn->error;
}

// Close connection
$conn->close();
?>
