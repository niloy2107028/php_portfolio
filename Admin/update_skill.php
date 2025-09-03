<?php
// update_skill.php
include 'authorization.php';

include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $skill_name = trim($_POST['skill_name']);
    $skill_des = trim($_POST['skill_des']);

    if ($id > 0 && !empty($skill_name) && !empty($skill_des)) {
        $stmt = $conn->prepare("UPDATE skills SET skill_name = ?, skill_des = ? WHERE id = ?");
        $stmt->bind_param("ssi", $skill_name, $skill_des, $id);

        if ($stmt->execute()) {
            header("Location: admin.php?tab=skill&status=success");
            exit();
        } else {
            header("Location: admin.php?tab=skill&status=error&msg=db_failed");
            exit();
        }
    } else {
        header("Location: admin.php?tab=skill&status=error&msg=invalid_input");
        exit();
    }
}
?>
