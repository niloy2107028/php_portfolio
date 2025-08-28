<?php




//run this file once in vs code terminal for creating database and tables





// Database connection info
$servername = "localhost"; 
$username = "root"; // default for XAMPP
$password = "";     // default for XAMPP

//Connect to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Create database
$sql = "CREATE DATABASE IF NOT EXISTS portfolio";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("portfolio");

// Create table skills
$sql = "CREATE TABLE IF NOT EXISTS skills (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(50) NOT NULL,
    skill_des VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "skills table created successfully\n";
} else {
    echo "Error creating table skills: " . $conn->error;
}

//  Create table about
$sql = "CREATE TABLE IF NOT EXISTS about (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    img_url VARCHAR(50) NOT NULL,
    bio VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "about table created successfully\n";
} else {
    echo "Error creating table about: " . $conn->error;
}

//  Create table education
$sql = "CREATE TABLE IF NOT EXISTS education (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(50) NOT NULL,
    degree VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "education table created successfully\n";
} else {
    echo "Error creating table educations: " . $conn->error;
}

//  Create table programming_language
$sql = "CREATE TABLE IF NOT EXISTS pl (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "PL table created successfully\n";
} else {
    echo "Error creating table PL: " . $conn->error;
}


//  Create table web_dev
$sql = "CREATE TABLE IF NOT EXISTS wd (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "WD table created successfully\n";
} else {
    echo "Error creating table WD: " . $conn->error;
}

//  Create table app_dev
$sql = "CREATE TABLE IF NOT EXISTS ad (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "AD table created successfully\n";
} else {
    echo "Error creating table AD: " . $conn->error;
}

//  Create table tool_tech
$sql = "CREATE TABLE IF NOT EXISTS tt (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "TT table created successfully\n";
} else {
    echo "Error creating table TT: " . $conn->error;
}

//  Create table others
$sql = "CREATE TABLE IF NOT EXISTS ot (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "OT table created successfully\n";
} else {
    echo "Error creating table OT: " . $conn->error;
}


// Create table projects
$sql = "CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    p_img_link VARCHAR(255) NOT NULL,
    p_title VARCHAR(100) NOT NULL,
    p_des TEXT NOT NULL,
    p_tech VARCHAR(100) NOT NULL,
    p_link VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "projects table created successfully\n";
} else {
    echo "projects creating table skills: " . $conn->error;
}



// Close connection
$conn->close();
?>
