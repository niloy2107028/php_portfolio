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

  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      background-color: #01181c;
      color: #fff;
    }

    :root {
      /* --primary-color: #ff004f; */
      --tag-color: #6050dc;
      --primary-color: #8e2de2;

      /* background: linear-gradient(135deg, #8e2de2, #4a00e0); */

      /* --secondary-color: #8c7dff; */
      --secondary-color: #8e2de2;
      /* best for text  */
    }

    .container {
      padding: 0 10%;
      margin: 1rem 0 2rem;

      /* background-color: red; */
    }

    /* ------------------navbar-------------------- */

    nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      padding: 0 10%;
      background: #262626;
      position: sticky;
      top: 0;
      /* 👈 required */
      z-index: 10;
    }

    .logo_p p {
      font-size: 2rem;
      font-weight: 600;
      font-family: "Poppins", sans-serif;
    }

    .logo_p p:hover {
      cursor: pointer;
    }

    .logo_p span {
      color: var(--primary-color);
    }

    nav ul li {
      display: inline-block;
      list-style: none;
      /* li default styling remove */
      margin: 0.75rem 1.25rem;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-size: 1.25rem;
      position: relative;
    }

    nav ul li a::after {
      content: "";
      width: 0;
      height: 4px;
      background: var(--primary-color);
      /* background: #003bfc; */

      position: absolute;
      left: 0;
      bottom: -6px;
      transition: 0.5s;
    }

    nav ul li a:hover::after {
      width: 100%;
    }

    nav .fa-solid {
      display: none;
    }

    /* -----------------skill section --------------- */

    .section {
      background: #1c1c1c;
      padding: 1rem 2.5%;
      border-radius: 1.5rem;
      border: 1px solid var(--primary-color);
      /* background-color: #262626; */
    }

    .section_title {
      text-align: center;
      font-size: 1.5rem;
      font-weight: 400;
      margin-bottom: 1rem;
    }

    .from_title {
      text-align: center;
      font-size: 1.5rem;
      font-weight: 400;
      margin-bottom: 1rem;
    }

    /* ----------------------table--------------------- */

    table {
      width: 100%;
      margin-bottom: 2rem;
      background: #363636;
      border-collapse: collapse;
      border-spacing: 0;
      /* Remove gaps */
      overflow: hidden;
    }

    table thead {
      background: linear-gradient(135deg,
          #8e2de2,
          #4a00e0);
      /* purple gradient header */
      color: #fff;
    }

    table th,
    table td {
      padding: 0.75rem;
      font-size: 1rem;
      font-weight: 300;
      text-align: left;
      border: 1px solid white;
      /* Row border */
    }

    table td {
      font-size: 1rem;
    }

    .actions button {
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      cursor: pointer;
      margin-right: 0.5rem;
    }

    .btn-edit {
      background: var(--primary-color);
      border: 2px solid transparent;
      color: #fff;
      transition: border 0.2s ease;
    }

    .btn-edit:hover {
      border: 2px solid white;
    }

    .btn-delete {
      color: #fff;
      background: #ff004f;
      transition: border 0.2s ease;
      border: 2px solid transparent;
      border-radius: 0.5rem;
      padding: 0.7rem 1.5rem;
      cursor: pointer;
    }

    .btn-delete:hover {
      border: 2px solid white;
    }

    /* ---------------------------form--------------------- */

    .form-container {
      background: #363636;
      padding: 1.5rem;
      border-radius: 12px;
      border: 1px solid white;
      max-width: 100%;
      margin: auto;
    }

    .form-container h3 {
      margin-bottom: 1rem;
      text-align: center;
      font-size: 1.5rem;
      font-weight: 400;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.3rem;
      font-size: 1rem;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 0.7rem;
      border: 2px solid #374151;
      outline: none;
      border-radius: 8px;
      background: #1c1c1c;
      color: #fff;
    }

    .form-input:focus {
      border-color: white;
      /* background: rgba(17, 24, 39, 1); */
    }

    .form-input::placeholder {
      color: #9ca3af;
      font-weight: 400;
      font-size: 0.85rem;
    }

    .form-group textarea {
      resize: none;
    }

    .btn-submit {
      display: block;
      width: 60%;
      margin: 1.5rem auto 0;
      padding: 0.75rem;
      border: 2px solid transparent;
      border-radius: 8px;
      background: linear-gradient(135deg, #8e2de2, #4a00e0);
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
    }

    .btn-submit:hover {
      border: 2px solid white;
    }

    /* --------about---------- */

    #about {
      width: 100%;
      /* background-color: red; */
    }

    .image-edit-preview {
      max-width: 180px;
      border-radius: 0.5rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
      /* margin-top: 0.5rem; */
    }

    input[type="file"] {
      width: 100%;
      border: 1px solid transparent;
      outline: none;
      background: #1c1c1c;
      padding: 0.9rem 1rem;
      color: #fff;
      font-size: 1rem;
      border-radius: 0.5rem;
      box-sizing: border-box;
      transition: border 0.2s ease, box-shadow 0.2s ease;
    }

    input[type="file"]:focus {
      border: 1px solid var(--primary-color);
      box-shadow: 0 0 0 2px var(--primary-color);
    }

    /* ----------------------service-------------------  */

    #services {
      padding: 2rem 0;
    }

    .services_list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
      /* Makes a responsive grid where
    Each column is at least 15rem wide.
    Columns can grow to fill space (1fr).
    The grid auto-fits as many columns as possible in the container. */
      grid-gap: 2.5rem;
      margin-top: 3rem;
    }


    .services_list div {
      background-color: #262626;
      padding: 1rem;
      font-size: 0.75rem;
      max-width: 45rem;
      /* max width of the card  */
      /* font-weight: 300; */
      border-radius: 0.75rem;
      transition: background-color 0.5s;
    }

    .services-card {
      border: 1px solid var(--primary-color);
    }

    .services_list div h3 {
      font-size: 1rem;
      margin-bottom: 1rem;
      font-weight: 300;
      text-align: center;
    }







    .services_list table th,
    .services_list table td {
      padding: 0.25rem 0.75rem;
      font-size: 0.75rem;
      font-weight: 300;
      text-align: left;
      border: 1px solid white;
      /* Row border */
    }

    .service_action i {
      cursor: pointer;
      margin-right: 0.75rem;
    }

    .service_action i:hover {
      color: var(--primary-color);
    }


    @media only screen and (max-width: 768px) {
      .container {
        padding: 0.5rem 5% 0.5rem;
        /* background-color: red; */
      }

      nav .fa-solid {
        display: block;
        font-size: 1.25rem;
      }

      nav ul {
        background: var(--primary-color);
        position: fixed;
        /* fixed on the screen make a scroll to understand pos realted to initial block body */
        top: 0;
        right: 0;
        width: 12.5rem;
        right: -12.5rem;
        /* better transition after using the same width */
        height: 100vh;
        padding-top: 3rem;
        z-index: 2;
        /* safety */
        transition: right 0.3s;
      }

      nav ul li {
        display: block;
        /* take full width */
        margin: 1.5rem;
      }

      nav ul .fa-solid {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
      }
    }
  </style>
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

  <!-- ----------------skill section--------------- -->
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
          <tr>
            <td>Web Development</td>
            <td>HTML, CSS, JavaScript, React.js</td>
            <td class="actions">
              <button class="btn-edit">
                <i class="fa fa-edit"></i> Edit
              </button>
              <button class="btn-delete">
                <i class="fa fa-trash"></i> Delete
              </button>
            </td>
          </tr>
          <tr>
            <td>App Development</td>
            <td>Flutter, React Native, Java (Android)</td>
            <td class="actions">
              <button class="btn-edit">
                <i class="fa fa-edit"></i> Edit
              </button>
              <button class="btn-delete">
                <i class="fa fa-trash"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Add Skill Form -->
      <div class="form-container">
        <h3 class="form_title">Add New Skill</h3>
        <form>
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

  <!-- ----------------skill section--------------- -->
  <div class="container">
    <div class="section" id="skill">
      <h2 class="section_title">Manage Education</h2>

      <!-- Skill Table -->
      <table>
        <thead>
          <tr>
            <th>Graduation Year</th>
            <th>Academic Degree</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Web Development</td>
            <td>HTML, CSS, JavaScript, React.js</td>
            <td class="actions">
              <button class="btn-edit">
                <i class="fa fa-edit"></i> Edit
              </button>
              <button class="btn-delete">
                <i class="fa fa-trash"></i> Delete
              </button>
            </td>
          </tr>
          <tr>
            <td>App Development</td>
            <td>Flutter, React Native, Java (Android)</td>
            <td class="actions">
              <button class="btn-edit">
                <i class="fa fa-edit"></i> Edit
              </button>
              <button class="btn-delete">
                <i class="fa fa-trash"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Add Skill Form -->
      <div class="form-container">
        <h3 class="form_title">Education Section</h3>
        <form>
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
          echo '<form>
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
          <button type="submit" class="btn-submit">Add Skill</button>
        </form>';
          echo '</div>';
        }
        ?>
      </div>

    </div>
  </div>




</body>

</html>

<?php
$conn->close();
?>