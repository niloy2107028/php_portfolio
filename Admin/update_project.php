<?php
// update_project.php
include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = trim($_POST['p_title']);
    $des = trim($_POST['p_des']);
    $tech = trim($_POST['p_tech']);
    $link = trim($_POST['p_link']);

    if ($id > 0 && !empty($title) && !empty($des) && !empty($tech)) {
        $newImageName = null;

        // Handle new image upload
        if (isset($_FILES['p_img_link']) && $_FILES['p_img_link']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['p_img_link']['tmp_name'];
            $imageName = basename($_FILES['p_img_link']['name']);
            $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageExt, $allowedExts)) {
                $newImageName = uniqid("project_", true) . "." . $imageExt;
                $destPath = "../images/" . $newImageName;

                if (!move_uploaded_file($imageTmpPath, $destPath)) {
                    header("Location: admin.php?tab=projects&status=error&msg=upload_failed");
                    exit();
                }
            } else {
                header("Location: admin.php?tab=projects&status=error&msg=invalid_type");
                exit();
            }
        }

        // Fetch current image if no new one uploaded
        $sql = "SELECT p_img_link FROM projects WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $oldData = $result->fetch_assoc();
        $finalImage = $newImageName ? $newImageName : $oldData['p_img_link'];

        // Update DB
        $stmt = $conn->prepare("UPDATE projects SET p_img_link=?, p_title=?, p_des=?, p_tech=?, p_link=? WHERE id=?");
        $stmt->bind_param("sssssi", $finalImage, $title, $des, $tech, $link, $id);

        if ($stmt->execute()) {
            header("Location: admin.php?tab=projects&status=success");
            exit();
        } else {
            header("Location: admin.php?tab=projects&status=error&msg=db_failed");
            exit();
        }
    } else {
        header("Location: admin.php?tab=projects&status=error&msg=invalid_input");
        exit();
    }
}
?>
