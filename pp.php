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
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
.skills_grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
  gap: 2rem;
  margin-top: 3rem;
}

.skill_card {
  background-color: #262626;
  padding: 2rem;
  border-radius: 0.75rem;
  font-size: 1.25rem;
  font-weight: 300;
  transition: background 0.5s, transform 0.5s;
}

.skill_card h2 {
  font-size: 1.5rem;
  font-weight: 500;
  margin-bottom: 1rem;
}

.skill_card p {
  font-size: 1.1rem;
  line-height: 1.5;
  color: #ccc;
}

.skill_card:hover {
  background: linear-gradient(135deg, #6050dc, #3a0ca3);
  transform: translateY(-10px);
  cursor: pointer;
}


    </style>
</head>
<body>
<div class="skills_grid">
  <?php
  $sql = "SELECT skill_name, skill_des FROM skills";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo '<div class="skill_card">';
          echo '<h2>' . htmlspecialchars($row['skill_name']) . '</h2>';
          echo '<p>' . htmlspecialchars($row['skill_des']) . '</p>';
          echo '</div>';
      }
  } else {
      echo '<p>No skills found</p>';
  }
  ?>
</div>

</body>
</html>
