<?php
// insertion.php
// Run this once after create_table.php to insert sample data

$servername = "localhost"; 
$username = "root"; 
$password = "";     
$dbname = "portfolio";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute query with error check
function executeQuery($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "✅ Query executed successfully\n";
    } else {
        echo "❌ Error: " . $conn->error . "\n";
    }
}

// Insert into skills
$sql = "INSERT INTO skills (skill_name, skill_des) VALUES
('Full-Stack Web Developer', 'Builds complete websites from frontend to backend'),
('MERN Stack Developer', 'Develops web apps using MongoDB, Express, React, Node'),
('PHP Developer', 'Creates dynamic server-side applications using PHP'),
('Application Developer', 'Designs and builds mobile or desktop applications'),
('Competitive Programmer', 'Solves algorithmic problems with efficient coding skills'),
('Java Developer', 'Develops robust applications using Java programming language')";
executeQuery($conn, $sql);

// Insert into about
$bio = "A proactive BSc in Computer Science and Engineering student at Khulna University of Engineering & Technology (KUET), with a strong academic foundation and hands-on experience in software and web development. I specialize in creating modern, responsive, and user-friendly web applications using HTML, CSS, JavaScript, PHP, and frameworks such as React.js, Laravel, Node.js, and Tailwind CSS.

Passionate about problem-solving, competitive programming, and building innovative applications, I continuously strive to learn new technologies and enhance my skills. I enjoy tackling challenging programming tasks and delivering efficient, high-quality solutions. I am seeking opportunities to apply my expertise in dynamic environments that foster growth, creativity, and innovation.";

$sql = "INSERT INTO about (img_url, bio) VALUES ('img1.jpg', '$bio')";
executeQuery($conn, $sql);

// Insert into education
$sql = "INSERT INTO education (year, degree) VALUES
('2019', 'SSC, IET Govt. High School'),
('2021', 'HSC, Dr. Mahbubur Rahman Mollah College (DMRC)'),
('2027', 'B.Sc. in CSE, Khulna University of Engineering & Technology (KUET)')";
executeQuery($conn, $sql);

// Insert into programming languages (pl)
$sql = "INSERT INTO pl (name) VALUES
('C'),
('C++'),
('Java'),
('Python'),
('JavaScript')";
executeQuery($conn, $sql);

// Insert into web_dev (wd)
$sql = "INSERT INTO wd (name) VALUES
('HTML5'),
('CSS3'),
('JavaScript (ES6+)'),
('Responsive Web Design'),
('React.js'),
('Node.js'),
('Express.js'),
('PHP')";
executeQuery($conn, $sql);

// Insert into app_dev (ad)
$sql = "INSERT INTO ad (name) VALUES
('Flutter'),
('React Native'),
('Java (Android)')";
executeQuery($conn, $sql);

// Insert into tool_tech (tt)
$sql = "INSERT INTO tt (name) VALUES
('Git & GitHub'),
('MySQL Database'),
('Oracle Database'),
('MongoDB Database'),
('Visual Studio Code'),
('Android Studio IDE'),
('IntelliJ IDEA IDE'),
('Logisim (Digital Logic Simulator)'),
('Arduino Platform')";
executeQuery($conn, $sql);

// Insert into others (ot)
$sql = "INSERT INTO ot (name) VALUES
('Competitive Programming (Codeforces – Rated)'),
('Teamwork'),
('Leadership'),
('Communication'),
('Time Management')";
executeQuery($conn, $sql);

// Insert into projects
$sql = "INSERT INTO projects (p_img_link, p_title, p_des, p_tech, p_link) VALUES
('p1.png', 'Police Management System', 'A console-based application to manage police operations efficiently. Handles officers, cases, and reporting using OOP concepts. Designed for learning object-oriented programming in C++. Includes structured data management for real-world scenarios.', 'C++', 'https://github.com/niloy2107028/Police-Management-Console-Based-OOP-Project'),

('p2.png', 'Numerical Methods Console App', 'A C++ console application implementing key numerical methods. Solves mathematical problems like roots of equations, integration, and interpolation. Provides step-by-step computation for learning purposes. Ideal for students and engineers exploring computational techniques.', 'C++', 'https://github.com/niloy2107028/Console-application-using-Numerical-Method'),

('p3.png', 'KUET Admin Android App', 'An Android application for administrative tasks at KUET. Manages student data, events, and notifications efficiently. Built using Java for mobile management purposes. Helps in learning mobile app development with practical functionality.', 'Java', 'https://github.com/niloy2107028/ADMIN_KUET_APP_-Android-Java-'),

('p4.png', 'Simon Says Game', 'A fun and interactive memory game built using HTML, CSS, and JavaScript. Players follow color and sound sequences that increase in complexity. Demonstrates DOM manipulation, event handling, and game logic. Perfect for learning front-end development concepts.', 'HTML, CSS, JavaScript', 'https://github.com/niloy2107028/Simon-Says-game-using-HTML-CSS-and-JavaScript'),

('p5.png', 'Spotify Frontend Clone', 'A web-based frontend clone of Spotify for music streaming experience. Implements playlists, search, and navigation using modern web technologies. Focused on responsive design and UI/UX. Helps in mastering HTML, CSS, and JavaScript for real-world app interfaces.', 'HTML, CSS, JavaScript', 'https://github.com/niloy2107028/Spotify_clone'),

('p6.png', 'Digital Clock Simulation', 'A digital clock design implemented in Logisim for circuit simulation learning. Displays hours, minutes, and seconds accurately. Helps understand combinational and sequential logic design. Ideal for electronics and computer architecture enthusiasts.', 'Logisim (Digital Circuit Simulation)', 'https://github.com/niloy2107028/Digital_Clock'),

('p7.png', '29-bit Microcomputer CPU Design', 'A complete 29-bit CPU design implemented in Logisim. Demonstrates instruction execution, registers, and ALU operations. Serves as a learning tool for computer architecture and digital design. Provides hands-on experience in CPU design and simulation.', 'Logisim (Digital Circuit Simulation)', 'https://github.com/niloy2107028/29-bit-Microcomputer-'),

('p8.png', 'Personal PHP Portfolio', 'A personal portfolio website built with HTML, CSS, JavaScript, PHP, and MySQL. Showcases projects, skills, and professional information. Implements dynamic content management and responsive design. Perfect for demonstrating full-stack web development skills.', 'HTML, CSS, JavaScript, PHP, MySQL', 'https://github.com/niloy2107028/php_portfolio')";
executeQuery($conn, $sql);

echo "✅ All sample data inserted successfully\n";

// Close connection
$conn->close();
?>
