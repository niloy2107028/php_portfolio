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

// Fetch projects
$sql = "SELECT p_img_link, p_title, p_des, p_tech, p_link FROM projects";
$projects = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <style>
        /*------------------project Section------------------*/
        #projects {
            padding: 60px 0 100px;
            background-color: #01181c;
            color: #ffffff;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .project-card {
            background: #02252b;
            padding: 20px;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
            text-align: left;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 25px rgba(238, 1, 1, 0.818);
        }

        .project-card img {
            width: 100%;
            /* auto dile ration thik tahkbe crop hbe na , but i want crop and full width nibe */
            height: 250px;
            object-fit: cover;
            object-position: center;
            /* while cropping centered will be safe */
            border-radius: 10px;
            display: block;
            margin: 0 auto 15px;
        }

        .project-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #ff004f;
        }

        .project-card p {
            font-size: 14px;
            color: #ccc;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .project-card a {
            color: #7a02fa;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .repo-link {
            display: inline-block;
            padding: 6px 14px;
            margin-top: 6px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .repo-link:hover {
            background-color: #045e840a;
        }
    </style>
</head>

<body>

    <div id="projects">
        <div class="container">
            <h1 class="sub-title">Projects</h1>
            <div class="projects-grid">

                <?php if ($projects && $projects->num_rows > 0): ?>
                    <?php while ($p = $projects->fetch_assoc()): ?>
                        <div class="project-card">
                            <div class="work">
                                <img src="images/<?php echo htmlspecialchars($p['p_img_link']); ?>"
                                    alt="<?php echo htmlspecialchars($p['p_title']); ?> Preview"
                                    class="project-img">
                                <div class="layer">
                                    <h3>Social Media App</h3>
                                    <p>
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta
                                        at repudiandae culpa iusto impedit obcaecati.
                                    </p>
                                    <a href="#"><i class="fa-solid fa-link"></i></a>
                                </div>
                            </div>
                            <h3><?php echo htmlspecialchars($p['p_title']); ?></h3>
                            <p><?php echo htmlspecialchars($p['p_des']); ?></p>
                            <p><strong>Technologies:</strong> <?php echo htmlspecialchars($p['p_tech']); ?></p>
                            <?php if (!empty($p['p_link'])): ?>
                                <p>
                                    <a class="repo-link" href="<?php echo htmlspecialchars($p['p_link']); ?>" target="_blank">
                                        View Repository
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No projects found.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>

</body>

</html>