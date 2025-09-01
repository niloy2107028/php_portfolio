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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio Website</title>
  <script
    src="https://kit.fontawesome.com/b59187c32e.js"
    crossorigin="anonymous"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="admin.css" />

</head>

<body>
  <nav>
    <div class="logo_p">
      <p><span>N</span>iloy.</p>
    </div>
    <ul id="sidemenu">
      <li><a href="#header">Home</a></li>
      <!-- id will take us to the specific section -->
      <li><a href="#about">About</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#portfolio">Portfolio</a></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="#contact">Download CV</a></li>
      <i class="fa-solid fa-xmark" onclick="close_menu()"></i>
    </ul>
    <i class="fa-solid fa-bars" onclick="open_menu()"></i>
  </nav>

  <!-- ------------about section-----------------------  -->

  <div class="container">
    <div class="section" id="about">
      <h2 class="section_title">Manage About Section</h2>

      <!-- Add Skill Form -->
      <div class="form-container">
        <form>
          <!-- Original Image -->
          <div class="form-group">
            <p>Current Image</p>
            <br />
            <img
              src="../images/formal.jpeg"
              class="image-edit-preview"
              id="old_image"
              alt="Old Image" />
          </div>

          <!-- New Image Upload -->
          <div class="form-group">
            <label for="image">Upload New Image</label>
            <input
              type="file"
              name="new_image"
              id="image"
              class="form-input" />
          </div>

          <!-- Description -->
          <div class="form-group">
            <label for="description">Skill Description</label>
            <textarea
              id="description"
              name="description"
              rows="4"
              class="form-input"
              placeholder="Enter skill description"
              required></textarea>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn-submit btn_about">Update</button>
        </form>
      </div>
    </div>
  </div>


  <!-- ------------------new skill section ------------------------   -->

  <?php
  // Fetch skills from DB
  $sql = "SELECT id, skill_name, skill_des FROM skills";
  $skills = $conn->query($sql);
  ?>

  <div class="container">
    <div class="section" id="skill">
      <h2 class="section_title">Manage Skills</h2>

      <!-- Skill Table -->
      <table>
        <thead>
          <tr>
            <th>Skill Title</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($skills && $skills->num_rows > 0): ?>
            <?php while ($s = $skills->fetch_assoc()): ?>
              <tr>
                <td>
                  <form action="update_skill.php" method="POST" class="table_inner_form">
                    <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                    <input type="text" name="skill_name"
                      value="<?php echo htmlspecialchars($s['skill_name']); ?>"
                      class="table_input" required>
                </td>
                <td>
                  <textarea name="skill_des" rows="5" class="table_input" required><?php echo htmlspecialchars($s['skill_des']); ?></textarea>
                </td>
                <td class="actions">
                  <button type="submit" class="btn-edit">
                    <i class="fa fa-save"></i> Save
                  </button>
                  </form>

                  <form action="delete_skill.php" method="POST" style="display:inline;"
                    onsubmit="return confirm('Are you sure you want to delete this skill?');">
                    <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                    <button type="submit" class="btn-delete">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No skills found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Add Skill Form -->
      <div class="form-container">
        <h3 class="form_title">Add New Skill</h3>
        <form action="add_skill.php" method="POST">
          <div class="form-group">
            <label for="title">Skill Title</label>
            <input
              type="text"
              id="title"
              name="title"
              class="form-input"
              placeholder="Enter skill title"
              required />
          </div>
          <div class="form-group">
            <label for="description">Skill Description</label>
            <textarea
              id="description"
              name="description"
              rows="4"
              class="form-input"
              placeholder="Enter skill description"
              required></textarea>
          </div>
          <button type="submit" class="btn-submit">Add Skill</button>
        </form>
      </div>
    </div>
  </div>



  <!-- ------------------new Education section ------------------------   -->

  <?php
  // Fetch skills from DB
  $sql = "SELECT id, year, degree FROM education";
  $educations = $conn->query($sql);
  ?>

  <div class="container">
    <div class="section" id="education">
      <h2 class="section_title">Manage Education</h2>

      <!-- Education Table -->
      <table>
        <thead>
          <tr>
            <th>Graduation Year</th>
            <th>Academic Degree</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($educations && $educations->num_rows > 0): ?>
            <?php while ($s = $educations->fetch_assoc()): ?>
              <tr>
                <td>
                  <form action="update_education.php" method="POST" class="table_inner_form">
                    <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                    <input type="number" name="year"
                      value="<?php echo htmlspecialchars($s['year']); ?>"
                      min="1900"
                      max="2099"
                      step="1"
                      class="table_input" required>
                </td>
                <td>
                  <input type="text" name="degree" class="table_input" required value="<?php echo htmlspecialchars($s['degree']); ?>">
                </td>
                <td class="actions">
                  <button type="submit" class="btn-edit">
                    <i class="fa fa-save"></i> Save
                  </button>
                  </form>

                  <form action="delete_skill.php" method="POST" style="display:inline;"
                    onsubmit="return confirm('Are you sure you want to delete this degree?');">
                    <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                    <button type="submit" class="btn-delete">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No Degree found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Add Skill Form -->
      <div class="form-container">
        <h3 class="form_title">Add New Skill</h3>
        <form action="add_skill.php" method="POST">
          <div class="form-group">
            <label for="title">Skill Title</label>
            <input
              type="text"
              id="title"
              name="title"
              class="form-input"
              placeholder="Enter skill title"
              required />
          </div>
          <div class="form-group">
            <label for="description">Skill Description</label>
            <textarea
              id="description"
              name="description"
              rows="4"
              class="form-input"
              placeholder="Enter skill description"
              required></textarea>
          </div>
          <button type="submit" class="btn-submit">Add Skill</button>
        </form>
      </div>
    </div>
  </div>



  <!-- ----------------service section--------------- -->




  <?php
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

  <div class="container">
    <div class="section" id="service">
      <h2 class="section_title">Manage Services</h2>
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
              echo '<td class="service_action">
                                    <i class="fa-solid fa-square-pen"></i>
                                    <i class="fa-solid fa-trash"></i>
                                  </td>';
              echo '</tr>';
            }
          } else {
            echo '<tr><td colspan="2">No items found</td></tr>';
          }

          echo '</tbody>';
          echo '</table>';

          // Add new item form row
          echo '<form class="service_form">
          <div class="service_group">
            <label for="title">Add New</label>
            <input
              type="text"
              id="title"
              name="title"
              class="form-input"
              placeholder="Enter Name"
              required />
          </div>
          <button type="submit" class="service_button">Add Skill</button>
        </form>';
          echo '</div>';
        }
        ?>
      </div>

    </div>
  </div>

  <!-- --------------------------projects-------------------------------->

  <?php
  // Fetch projects
  $sql = "SELECT id, p_img_link, p_title, p_des, p_tech, p_link FROM projects";
  $projects = $conn->query($sql);
  ?>

  <div class="container">
    <div class="section" id="admin-projects">
      <h2 class="section_title">Manage Projects</h2>
      <div class="work_list">

        <?php if ($projects && $projects->num_rows > 0): ?>
          <?php while ($p = $projects->fetch_assoc()): ?>
            <div class="project-card">
              <div class="image_div">
                <img src="../images/<?php echo htmlspecialchars($p['p_img_link']); ?>"
                  alt="<?php echo htmlspecialchars($p['p_title']); ?> Preview"
                  class="project-img">

                <div class="layer">
                  <?php if (!empty($p['p_link'])): ?>
                    <p>View Repository</p>
                    <a href="<?php echo htmlspecialchars($p['p_link']); ?>" target="_blank">
                      <i class="fa-solid fa-link"></i>
                    </a>
                  <?php endif; ?>
                </div>
              </div>

              <h3><?php echo htmlspecialchars($p['p_title']); ?></h3>
              <p><?php echo htmlspecialchars($p['p_des']); ?></p>

              <p>Technologies :</p>
              <p class="card-tech">
                <?php
                $techs = explode(',', $p['p_tech']);
                foreach ($techs as $tech) {
                  echo '<span class="tech">' . htmlspecialchars(trim($tech)) . '</span> ';
                }
                ?>
              </p>

              <!-- Action buttons -->
              <div class="service_action">
                <button class="btn-edit pb"> <i class="fa fa-edit"></i> Edit </button> <button class="btn-delete pb"> <i class="fa fa-trash"></i> Delete </button>
              </div>

            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No projects found.</p>
        <?php endif; ?>

      </div>

      <!-- Add new project form -->
      <div class="form-container">
        <h2 class="section_title">Add a New Project</h2>
        <form action="add_project.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="p_title">Project Title</label>
            <input type="text" id="p_title" name="p_title" class="form-input" placeholder="Enter project title" required />
          </div>

          <div class="form-group">
            <label for="p_des">Description</label>
            <textarea id="p_des" name="p_des" class="form-input" placeholder="Enter project description" required></textarea>
          </div>

          <div class="form-group">
            <label for="p_tech">Technologies (comma separated)</label>
            <input type="text" id="p_tech" name="p_tech" class="form-input" placeholder="e.g. PHP, MySQL, JavaScript" required />
          </div>

          <div class="form-group">
            <label for="p_link">Repository Link</label>
            <input type="url" id="p_link" name="p_link" class="form-input" placeholder="https://github.com/..." />
          </div>

          <div class="service_group">
            <label for="p_img_link">Upload Image</label>
            <input type="file" id="p_img_link" name="p_img_link" class="form-input" accept="image/*" required />
          </div>

          <button type="submit" class="btn-submit">Add Project</button>
        </form>

      </div>

    </div>
  </div>



</body>

</html>

<?php
$conn->close();
?>