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
  <link rel="stylesheet" href="style.css" />

</head>

<body>
  <div id="header">
    <div class="container">
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
          <li><a href="#contact">CV</a></li>
          <li><a href="./User/login.php">Login</a></li>
          <i class="fa-solid fa-xmark" onclick="close_menu()"></i>
        </ul>
        <i class="fa-solid fa-bars" onclick="open_menu()"></i>
      </nav>
      <div class="header_text">
        <h1>
          Hi, I'm
          <span> Niloy</span>
        </h1>
        <ol>
          <?php
          // Fetch skills
          $result = $conn->query("SELECT skill_name FROM skills");
          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<li><span>' . htmlspecialchars($row['skill_name']) . '</span></li>';

              // Using htmlspecialchars($row['skill_name']) ensures that if someone accidentally or maliciously adds HTML or JS in the skill_name, it will display as plain text and not break your page or run scripts.
            }
          } else {
            echo '<li>No skills found</li>';
          }


          ?>
        </ol>
        <h1 class="location">based in Bangladesh</h1>
      </div>
    </div>
  </div>



  <!-- About section  -->

  <?php
  // Fetch about info from DB
  $sql = "SELECT img_url, bio FROM about LIMIT 1";
  $result = $conn->query($sql);
  $about = $result->fetch_assoc();
  ?>


  <div id="about">
    <div class="container">
      <div class="row">
        <div class="about-col-1">
          <img src="./images/<?php echo htmlspecialchars($about['img_url']); ?>" alt="user photo" />
        </div>
        <div class="about-col-2">
          <h1 class="sub_title ab">About Me</h1>

          <p class="me"><?php echo htmlspecialchars($about['bio']); ?> </p>


          <div class="tab_titles">
            <p class="tab_links   active_link" onclick="opentab('skills')">
              Skills
            </p>
            <p class="tab_links" onclick="opentab('education')">Education</p>
            <p class="tab_links" onclick="opentab('experience')">
              Experience
            </p>

          </div>


          <!-- fetch data from table called skills  -->
          <div class="tab_contents  active_tab" id="skills">
            <ul>
              <?php
              $sql = "SELECT skill_name, skill_des FROM skills";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<li><span>" . htmlspecialchars($row['skill_name']) . "</span><br />"
                    . htmlspecialchars($row['skill_des']) . "</li>";
                }
              } else {
                echo "<li>No skills found</li>";
              }
              ?>
            </ul>
          </div>


          <!-- fetch data from table called education  -->
          <!-- ORDER BY year ASC will display records from earliest to latest  -->
          <div class="tab_contents" id="education">
            <ul>
              <?php
              $sql = "SELECT year, degree FROM education ORDER BY year DESC";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<li><span>' . htmlspecialchars($row['year']) . '</span><br />'
                    . htmlspecialchars($row['degree']) . '</li>';
                }
              } else {
                echo '<li>No education records found</li>';
              }
              ?>
            </ul>
          </div>


          <div class="tab_contents" id="experience">
            <ul>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- services  -->

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
          echo '<div>';
          echo '<h3>' . htmlspecialchars($title) . '</h3>';
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

  <!-- Portfolio section  -->


  <?php
  // Fetch projects
  $sql = "SELECT p_img_link, p_title, p_des, p_tech, p_link FROM projects";
  $projects = $conn->query($sql);
  ?>



  <div id="portfolio">
    <div class="container">
      <h1 class="sub_title">My Work</h1>
      <div class="work_list">


        <?php if ($projects && $projects->num_rows > 0): ?>
          <?php while ($p = $projects->fetch_assoc()): ?>
            <div class="project-card">
              <div class="image_div">
                <img src="images/<?php echo htmlspecialchars($p['p_img_link']); ?>"
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
                $techs = explode(',', $p['p_tech']); // split by comma
                foreach ($techs as $tech) {
                  echo '<span class="tech">' . htmlspecialchars(trim($tech)) . '</span> ';
                }
                ?>
              </p>

            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No projects found.</p>
        <?php endif; ?>


      </div>
      <a href="#" class="btn">See more</a>
    </div>
  </div>

  <!-- -----------contact-------------- -->

  <div id="contact">
    <div class="container">
      <div class="row">
        <div class="contact-left">
          <h1 class="sub_title">Contact Me</h1>
          <p><i class="fa-solid fa-paper-plane"></i>contact@gmail.com</p>
          <p><i class="fa-solid fa-phone"></i>0123456789</p>
          <div class="social_icons">
            <a href="#" class="f">
              <i class="fa-brands fa-square-facebook"></i>
            </a>
            <a href="#" class="t">
              <i class="fa-brands fa-square-twitter"></i>
            </a>
            <a href="#" class="g">
              <i class="fa-brands fa-square-github"></i></a>
            <a href="#" class="l"> <i class="fa-brands fa-linkedin"></i> </a>
            <a href="#" class="w">
              <i class="fa-brands fa-square-whatsapp"></i>
            </a>
          </div>
          <a href="images/cv.pdf" download class="btn btn_more cv">Download CV</a>
        </div>
        <div class="contact-right">
          <form action="#">
            <input type="text" name="name" placeholder="Your Name" required />
            <input
              type="email"
              name="email"
              placeholder="Your Email"
              required />
            <textarea
              name="message"
              rows="6"
              placeholder="Your Message"></textarea>
            <button type="submit" class="btn btn_more">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="copyright">
      <p>
        Copyright &copy; Niloy. Made with <i class="fa-solid fa-heart"></i> by
        Sohaib Hasan Niloy
      </p>
    </div>
  </div>

  <script src="index.js"></script>
</body>

</html>

<?php
$conn->close();
?>