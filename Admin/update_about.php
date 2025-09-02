<?php
// update_about.php
include '../config/db.php'; // The path to your database connection file.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bio = trim($_POST['description']);

    // Handle new image upload if provided
    $newImageName = null;
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['new_image']['tmp_name'];
        $imageName = basename($_FILES['new_image']['name']);
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageExt, $allowedExts)) {
            $newImageName = uniqid("about_", true) . "." . $imageExt;
            $destPath = "../images/" . $newImageName;

            if (!move_uploaded_file($imageTmpPath, $destPath)) {
                //file moving to the image folder
                header("Location: admin.php?tab=about&status=error&msg=upload_failed");
                exit();
            }
        } else {
            header("Location: admin.php?tab=about&status=error&msg=invalid_type");
            exit();
        }
    }

    // Fetch current image if no new one is uploaded
    $sql = "SELECT img_url FROM about LIMIT 1";
    $result = $conn->query($sql);
    $oldData = $result->fetch_assoc();
    $finalImage = $newImageName ? $newImageName : $oldData['img_url'];

    // Update database
    $stmt = $conn->prepare("UPDATE about SET img_url = ?, bio = ? LIMIT 1");
    $stmt->bind_param("ss", $finalImage, $bio);

    if ($stmt->execute()) {
        header("Location: admin.php?tab=about&status=success");
        exit();
    } else {
        header("Location: admin.php?tab=about&status=error&msg=db_failed");
        exit();
    }
}
?>
