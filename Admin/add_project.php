<?php
// add_project.php
include 'authorization.php';
include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['p_title']);
    $des = trim($_POST['p_des']);
    $tech = trim($_POST['p_tech']);
    $link = trim($_POST['p_link']);

    if (!empty($title) && !empty($des) && !empty($tech) && isset($_FILES['p_img_link'])) {
        $imageTmpPath = $_FILES['p_img_link']['tmp_name'];
        $imageName = basename($_FILES['p_img_link']['name']);
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageExt, $allowedExts)) {
            $newImageName = uniqid("project_", true) . "." . $imageExt;
            $destPath = "../images/" . $newImageName;

            if (move_uploaded_file($imageTmpPath, $destPath)) {
                $stmt = $conn->prepare("INSERT INTO projects (p_img_link, p_title, p_des, p_tech, p_link) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $newImageName, $title, $des, $tech, $link);

                if ($stmt->execute()) {
                    header("Location: admin.php?tab=projects&status=success");
                    exit();
                } else {
                    header("Location: admin.php?tab=projects&status=error&msg=db_failed");
                    exit();
                }
            } else {
                header("Location: admin.php?tab=projects&status=error&msg=upload_failed");
                exit();
            }
        } else {
            header("Location: admin.php?tab=projects&status=error&msg=invalid_type");
            exit();
        }
    } else {
        header("Location: admin.php?tab=projects&status=error&msg=invalid_input");
        exit();
    }
}
?>
