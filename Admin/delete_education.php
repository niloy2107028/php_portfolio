<?php
// delete_education.php
include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM education WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: admin.php?tab=education&status=success");
            exit();
        } else {
            header("Location: admin.php?tab=education&status=error&msg=db_failed");
            exit();
        }
    } else {
        header("Location: admin.php?tab=education&status=error&msg=invalid_id");
        exit();
    }
}
?>
