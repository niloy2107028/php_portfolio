<?php
// add_service.php
include 'authorization.php';

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    $title = trim($_POST['title']);

    // Validate table name
    $allowedTables = ['pl', 'wd', 'ad', 'tt', 'ot'];
    if (!in_array($table, $allowedTables)) {
        header("Location: admin.php?tab=service&status=error&msg=invalid_table");
        exit();
    }

    // Insert new service item
    $stmt = $conn->prepare("INSERT INTO $table (name) VALUES (?)");
    $stmt->bind_param("s", $title);

    if ($stmt->execute()) {
        header("Location: admin.php?tab=service&status=success");
        exit();
    } else {
        header("Location: admin.php?tab=service&status=error&msg=db_failed");
        exit();
    }
}
?>
