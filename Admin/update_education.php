<?php
// update_education.php
include '../config/db.php'; // same as update_about.php, adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $year = trim($_POST['year']);
    $degree = trim($_POST['degree']);

    if ($id > 0 && !empty($year) && !empty($degree)) {
        // Update database
        $stmt = $conn->prepare("UPDATE education SET year = ?, degree = ? WHERE id = ?");
        $stmt->bind_param("ssi", $year, $degree, $id);

        if ($stmt->execute()) {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: admin.php?tab=education&status=error&msg=db_failed");
            exit();
        }
    } else {
        header("Location: admin.php?tab=education&status=error&msg=invalid_input");
        exit();
    }
}
?>
