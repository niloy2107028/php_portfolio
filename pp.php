<?php
// db_connect.php
$servername = "localhost"; 
$username = "root"; 
$password = "";     
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch all rows from a table
function fetchRows($conn, $table) {
    $rows = [];
    $sql = "SELECT name FROM $table";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row['name'];
        }
    }
    return $rows;
}
?>

<div id="services">
    <div class="container">
        <h1 class="sub_title">My Services</h1>
        <div class="services_list">

            <?php
            $tables = [
                "pl" => "Programming Languages",
                "wd" => "Web Development",
                "ad" => "App Development",
                "tt" => "Tools & Technologies",
                "ot" => "Other Skills"
            ];

            // A PHP associative array where i am string the names of the table index as a db table name 

            foreach ($tables as $table => $title) {
                $items = fetchRows($conn, $table);
                echo '<div>';
                echo '<h2>' . htmlspecialchars($title) . '</h2>';
                if (!empty($items)) {
                    echo '<ul>';
                    foreach ($items as $item) {
                        echo '<li>' . htmlspecialchars($item) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No items found</p>';
                }
                echo '</div>';
            }
            ?>

        </div>
    </div>
</div>

<style>
/* Add UL/LI styles without changing existing card style */
.services_list div ul {
    list-style: disc;
    padding-left: 20px;
    margin-top: 10px;
}

.services_list div ul li {
    margin-bottom: 8px;
    font-size: 1.1rem;
    color: #ffffff;
}
</style>
