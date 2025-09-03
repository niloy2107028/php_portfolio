<?php
// delete_service.php
include 'authorization.php';

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $table = $_POST['table'];

    // Validate table name
    $allowedTables = ['pl', 'wd', 'ad', 'tt', 'ot'];
    if (!in_array($table, $allowedTables)) {
        header("Location: admin.php?tab=service&status=error&msg=invalid_table");
        exit();
    }

    // Delete service item
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin.php?tab=service&status=success");
        exit();
    } else {
        header("Location: admin.php?tab=service&status=error&msg=db_failed");
        exit();
    }
}
?>
