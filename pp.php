<!-- services  -->
<?php


// db_connect.php (or at the top of your HTML file)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Function to fetch all rows from a table
function fetchRows($conn, $table)
{
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .service-card {
            background-color: #262626;
            padding: 1.5rem;
            font-size: 1rem;
            max-width: 25rem;
            border: 1px solid var(--primary-color);
            border-radius: 0.75rem;
            transition: background-color 0.5s;
        }

        .service-card:hover {
            background: linear-gradient(135deg, #8e2de2, #4a00e0);
            cursor: pointer;
        }

        .service-card h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .service-table {
            width: 100%;
            border-collapse: collapse;
        }

        .service-table th,
        .service-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #444;
            color: #fff;
        }

        .service-table th {
            color: var(--tag-color);
            font-weight: 600;
        }

        .service-table td.actions {
            text-align: right;
        }

        .edit-btn,
        .delete-btn,
        .add-btn {
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
            margin-left: 0.5rem;
            transition: transform 0.2s;
        }

        .edit-btn:hover {
            color: #4cafef;
            transform: scale(1.1);
        }

        .delete-btn:hover {
            color: #ff4b5c;
            transform: scale(1.1);
        }

        .add-btn {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
            border-radius: 0.5rem;
            border: 1px dashed var(--tag-color);
        }

        .add-btn:hover {
            background-color: rgba(142, 45, 226, 0.2);
            transform: scale(1.02);
        }
    </style>
</head>

<body>
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

                foreach ($tables as $table => $title) {
                    $items = fetchRows($conn, $table);
                    echo '<div class="service-card">';
                    echo '<h3>' . htmlspecialchars($title) . '</h3>';
                    echo '<table class="service-table">';
                    echo '<thead><tr><th>Item</th><th>Action</th></tr></thead>';
                    echo '<tbody>';
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($item) . '</td>';
                            echo '<td class="actions">
                    <button class="edit-btn">✏️</button>
                    <button class="delete-btn">🗑</button>
                  </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="2">No items found</td></tr>';
                    }
                    // Add new item form row
                    echo '<tr class="add-row">
        <td colspan="2">
          <form method="POST" action="add_skill.php" class="add-skill-form">
            <div class="form-group-inline">
              <input 
                type="text" 
                name="skill_name" 
                class="form-input" 
                placeholder="Enter new skill" 
                required 
              />
              <input type="hidden" name="table" value="' . htmlspecialchars($table) . '" />
              <button type="submit" class="btn-submit add-btn">➕ Add</button>
            </div>
          </form>
        </td>
      </tr>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>