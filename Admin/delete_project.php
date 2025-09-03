<?php
// delete_project.php
include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: admin.php?tab=projects&status=success");
            exit();
        } else {
            header("Location: admin.php?tab=projects&status=error&msg=db_failed");
            exit();
        }
    } else {
        header("Location: admin.php?tab=projects&status=error&msg=invalid_id");
        exit();
    }
}
?>
