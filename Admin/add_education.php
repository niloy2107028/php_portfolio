<?php
// add_education.php
include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = trim($_POST['year']);
    $degree = trim($_POST['degree']);

    if (!empty($year) && !empty($degree)) {
        $stmt = $conn->prepare("INSERT INTO education (year, degree) VALUES (?, ?)");
        $stmt->bind_param("ss", $year, $degree);

        if ($stmt->execute()) {
            header("Location: admin.php?tab=education&status=success");
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
