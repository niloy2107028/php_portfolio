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
      <li><a onclick="opentab('about')" class="link active_link">About</a></li>
      <!-- id will take us to the specific section -->
      <li><a onclick="opentab('education')" class="link">Education</a></li>
      <li><a onclick="opentab('skill')" class="link">Skills</a></li>

      <li><a onclick="opentab('service')" class="link">Services</a></li>

      <li><a onclick="opentab('admin-projects')" class="link">Projects</a></li>


      <i class="fa-solid fa-xmark" onclick="close_menu()"></i>
    </ul>
    <i class="fa-solid fa-bars" onclick="open_menu()"></i>
  </nav>

  <!-- ------------about section-----------------------  -->


  <?php
  // Fetch about info from DB
  $sql = "SELECT img_url, bio FROM about LIMIT 1";
  $result = $conn->query($sql);
  $about = $result->fetch_assoc();
  ?>

  <div class="container">
    <div class="section active_tab" id="about">
      <h2 class="section_title">Manage About Section</h2>

      <!-- About Form -->
      <div class="form-container">
        <form method="POST" action="update_about.php" enctype="multipart/form-data">

          <!-- Current Image -->
          <div class="form-group">
            <p>Current Image</p>
            <img
              src="../images/<?php echo htmlspecialchars($about['img_url']); ?>"
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
              rows="8"
              class="form-input"
              placeholder="Enter skill description"
              required><?php echo htmlspecialchars($about['bio']); ?></textarea>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn-submit btn_about">Update</button>
        </form>
      </div>
    </div>


    <!-- ------------------new skill section ------------------------   -->

    <?php
    // Fetch skills from DB
    $sql = "SELECT id, skill_name, skill_des FROM skills";
    $skills = $conn->query($sql);
    ?>

    <!-- <div class="container"> -->
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
    <!-- </div> -->



    <!-- ------------------new Education section ------------------------   -->

    <?php
    // Fetch Educations from DB
    $sql = "SELECT id, year, degree FROM education";
    $educations = $conn->query($sql);
    ?>

    <!-- <div class="container"> -->
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

      <!-- Add Education Form -->
      <div class="form-container">
        <h3 class="form_title">Add New Degree</h3>


        <form action="add_education.php" method="POST">
          <div class="form-group">
            <label for="year">Graduation Year</label>
            <input
              type="number"
              id="year"
              name="year"
              class="form-input"
              placeholder="Enter graduation year (e.g., 2025)"
              min="1900"
              max="2099"
              step="1"
              required />
          </div>

          <!-- Degree Title -->
          <div class="form-group">
            <label for="degree">Academic Degree</label>
            <input
              type="text"
              id="degree"
              name="degree"
              class="form-input"
              placeholder="Enter your degree (e.g., BSc in Computer Science)"
              required />
          </div>


          <button type="submit" class="btn-submit">Add Skill</button>
        </form>
      </div>
    </div>
    <!-- </div> -->



    <!-- -------------------------new service section-------------  -->

    <!-- ----------------service section--------------- -->

    <?php
    // Fetch service items (with id) instead of only name
    function fetchRows($conn, $table)
    {
      $rows = [];
      $sql = "SELECT id, name FROM $table";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $rows[] = $row;
        }
      }
      return $rows;
    }
    ?>

    <!-- <div class="container"> -->
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

        foreach ($tables as $table => $title):
          $items = fetchRows($conn, $table);
        ?>
          <div class="service-card">
            <h3><?php echo htmlspecialchars($title); ?></h3>
            <table class="service-table">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($items)): ?>
                  <?php foreach ($items as $item): ?>
                    <tr>
                      <!-- Update form inside row -->
                      <td>
                        <form action="update_service.php" method="POST" class="table_inner_form">
                          <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                          <input type="hidden" name="table" value="<?php echo $table; ?>">
                          <input type="text" name="name"
                            value="<?php echo htmlspecialchars($item['name']); ?>"
                            class="table_input" required>
                      </td>
                      <td class="table_action">
                        <button type="submit">
                          <i class="fa fa-save"></i>
                        </button>
                        </form>

                        <!-- Delete form -->
                        <form action="delete_service.php" method="POST" style="display:inline;"
                          onsubmit="return confirm('Are you sure you want to delete this service?');">
                          <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                          <input type="hidden" name="table" value="<?php echo $table; ?>">
                          <button type="submit">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="2">No items found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>

            <!-- Add new item form row -->
            <form action="add_service.php" method="POST" class="service_form">
              <input type="hidden" name="table" value="<?php echo $table; ?>">
              <div class="service_group">
                <label for="title_<?php echo $table; ?>">Add New</label>
                <input
                  type="text"
                  id="title_<?php echo $table; ?>"
                  name="title"
                  class="form-input"
                  placeholder="Enter Name"
                  required />
              </div>
              <button type="submit" class="service_button">Add Skill</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- </div> -->


    <!-- ------------------new project section---------------  -->


    <?php
    // Fetch projects
    $sql = "SELECT id, p_img_link, p_title, p_des, p_tech, p_link FROM projects";
    $projects = $conn->query($sql);
    ?>

    <!-- <div class="container"> -->
    <div class="section" id="admin-projects">
      <h2 class="section_title">Manage Projects</h2>
      <div class="work_list">

        <?php if ($projects && $projects->num_rows > 0): ?>
          <?php while ($p = $projects->fetch_assoc()): ?>
            <div class="project-card">

              <!-- Update Project Form -->
              <form action="update_project.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">

                <!-- Current Image -->
                <div class="form-group">
                  <p>Current Image</p>
                  <br />
                  <img
                    src="../images/<?php echo htmlspecialchars($p['p_img_link']); ?>"
                    class="image-edit-preview"
                    alt="Project Image" />
                </div>

                <!-- Upload New Image -->
                <div class="form-group">
                  <label for="p_img_link_<?php echo $p['id']; ?>">Upload New Image</label>
                  <input
                    type="file"
                    id="p_img_link_<?php echo $p['id']; ?>"
                    name="p_img_link"
                    class="form-input"
                    accept="image/*" />
                </div>

                <!-- Project Title -->
                <div class="form-group">
                  <label for="p_title_<?php echo $p['id']; ?>">Project Title</label>
                  <input
                    type="text"
                    id="p_title_<?php echo $p['id']; ?>"
                    name="p_title"
                    class="form-input"
                    value="<?php echo htmlspecialchars($p['p_title']); ?>"
                    required />
                </div>

                <!-- Description -->
                <div class="form-group">
                  <label for="p_des_<?php echo $p['id']; ?>">Description</label>
                  <textarea
                    id="p_des_<?php echo $p['id']; ?>"
                    name="p_des"
                    rows="7"
                    class="form-input"
                    required><?php echo htmlspecialchars($p['p_des']); ?></textarea>
                </div>

                <!-- Technologies -->
                <div class="form-group">
                  <label for="p_tech_<?php echo $p['id']; ?>">Technologies (comma separated)</label>
                  <input
                    type="text"
                    id="p_tech_<?php echo $p['id']; ?>"
                    name="p_tech"
                    class="form-input"
                    value="<?php echo htmlspecialchars($p['p_tech']); ?>"
                    required />
                </div>

                <!-- Repository Link -->
                <div class="form-group">
                  <label for="p_link_<?php echo $p['id']; ?>">Repository Link</label>
                  <input
                    type="url"
                    id="p_link_<?php echo $p['id']; ?>"
                    name="p_link"
                    class="form-input"
                    value="<?php echo htmlspecialchars($p['p_link']); ?>" />
                </div>

                <!-- Actions -->
                <div class="service_action">
                  <button type="submit" class="btn-edit pb">
                    <i class="fa fa-save"></i> Save
                  </button>
                </div>
              </form>

              <!-- Delete Form -->
              <form action="delete_project.php" method="POST" style="display:inline;"
                onsubmit="return confirm('Are you sure you want to delete this project?');">
                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                <button type="submit" class="btn-delete pb">
                  <i class="fa fa-trash"></i> Delete
                </button>
              </form>
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

          <div class="form-group">
            <label for="p_img_link">Upload Image</label>
            <input type="file" id="p_img_link" name="p_img_link" class="form-input" accept="image/*" required />
          </div>

          <button type="submit" class="btn-submit">Add Project</button>
        </form>
      </div>
    </div>



  </div>


  <script src="admin.js"></script>
</body>

</html>

<?php
$conn->close();
?>