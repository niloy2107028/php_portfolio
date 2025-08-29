<?php
// db_connect.php (or at the top of your HTML file)
$servername = "localhost"; 
$username = "root"; 
$password = "";     
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portfolio Website</title>
    <script
      src="https://kit.fontawesome.com/b59187c32e.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap"
      rel="stylesheet"
    />
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
            <li><a href="#contact">Download CV</a></li>
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

            // $conn->close();
            ?>
          </ol>
          <h1 class="location">based in Bangladesh</h1>
        </div>
      </div>
    </div>
    <!-- About section  -->
    <div id="about">
      <div class="container">
        <div class="row">
          <div class="about-col-1">
            <img src="images/formal.jpeg" alt="user photo" />
          </div>
          <div class="about-col-2">
            <h1 class="sub_title">About Me</h1>
            <?php
            // Fetch skills
            $result = $conn->query("SELECT bio FROM about"); 
                    echo '<p class="me">' . htmlspecialchars($result->fetch_assoc()['bio']) . '</p>';
            ?>
            <div class="tab_titles">
              <p class="tab_links active_link" onclick="opentab('skills')">
                Skills
              </p>
              <p class="tab_links" onclick="opentab('experience')">
                Experience
              </p>
              <p class="tab_links" onclick="opentab('education')">Education</p>
            </div>

            <div class="tab_contents active_tab" id="skills">
              <ul>
                <li><span>UI/UX</span><br />Designing Web/App interface</li>
                <li>
                  <span>Web Development</span><br />Web application Development
                </li>
                <li></li>
                <li>
                  <span>App Development</span><br />Building Android/ios apps
                </li>
              </ul>
            </div>

            <div class="tab_contents" id="experience">
              <ul>
                <li>
                  <span>2021 - Current</span><br />Full Stack MERN Developer
                </li>
                <li><span>2019-2021</span><br />Team Lead at StartApp LLC.</li>
                <li></li>
                <li>
                  <span>2017-2016</span><br />
                  UI/UX Design Executive at Coin Digital Ltd.
                </li>
                <li>
                  <span>2016-2017</span><br />
                  Internship at ekart eCommerce.
                </li>
              </ul>
            </div>

            <div class="tab_contents" id="education">
              <ul>
                <li>
                  <span>2027</span><br />B.Sc. in CSE, Khulna University of
                  Engineering & Technology (KUET)
                </li>
                <li>
                  <span>2021</span><br />HSC, Dr. Mahbubur Rahman Mollah
                  College(DMRC)
                </li>
                <li></li>
                <li>
                  <span>2019</span><br />
                  SSC, IET Govt. High School
                </li>
                <li>
                  <span>2016-2017</span><br />
                  Internship at ekart eCommerce.
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- services  -->

    <div id="services">
      <div class="container">
        <h1 class="sub_title">My Services</h1>
        <div class="services_list">
          <div>
            <i class="fa-solid fa-code"></i>
            <h2>Web Design</h2>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
              Dignissimos assumenda laudantium facere tempora hic dicta ea?
              Facere, quidem labore. Excepturi modi minima incidunt nemo dolore
              ullam possimus ipsum facere quia!
            </p>
            <a class="learn_more" href="#">Learn more</a>
          </div>

          <div>
            <i class="fa-brands fa-android"></i>
            <h2>App Design</h2>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
              Dignissimos assumenda laudantium facere tempora hic dicta ea?
              Facere, quidem labore. Excepturi modi minima incidunt nemo dolore
              ullam possimus ipsum facere quia!
            </p>
            <a class="learn_more" href="#">Learn more</a>
          </div>

          <div>
            <i class="fa-solid fa-crop-simple"></i>
            <h2>UI/UX Design</h2>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit.
              Dignissimos assumenda laudantium facere tempora hic dicta ea?
              Facere, quidem labore. Excepturi modi minima incidunt nemo dolore
              ullam possimus ipsum facere quia!
            </p>
            <a class="learn_more" href="#">Learn more</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio section  -->
    <div id="portfolio">
      <div class="container">
        <h1 class="sub_title">My Work</h1>
        <div class="work_list">
          <div class="work">
            <img src="images/work-1.png" alt="work picture 1" />
            <div class="layer">
              <h3>Social Media App</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta
                at repudiandae culpa iusto impedit obcaecati.
              </p>
              <a href="#"><i class="fa-solid fa-link"></i></a>
            </div>
          </div>
          <div class="work">
            <img src="images/work-2.png" alt="work picture 1" />
            <div class="layer">
              <h3>Music App</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta
                at repudiandae culpa iusto impedit obcaecati.
              </p>
              <a href="#"><i class="fa-solid fa-link"></i></a>
            </div>
          </div>
          <div class="work">
            <img src="images/work-3.png" alt="work picture 1" />
            <div class="layer">
              <h3>Online Shoping App</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta
                at repudiandae culpa iusto impedit obcaecati.
              </p>
              <a href="#"><i class="fa-solid fa-link"></i></a>
            </div>
          </div>
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
                <i class="fa-brands fa-square-github"></i
              ></a>
              <a href="#" class="l"> <i class="fa-brands fa-linkedin"></i> </a>
              <a href="#" class="w">
                <i class="fa-brands fa-square-whatsapp"></i>
              </a>
            </div>
            <a href="images/cv.pdf" download class="btn btn_more cv"
              >Download CV</a
            >
          </div>
          <div class="contact-right">
            <form action="#">
              <input type="text" name="name" placeholder="Your Name" required />
              <input
                type="email"
                name="email"
                placeholder="Your Email"
                required
              />
              <textarea
                name="message"
                rows="6"
                placeholder="Your Message"
              ></textarea>
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
