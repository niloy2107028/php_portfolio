<?php
// authorization.php
session_start();
include '../config/db.php'; // adjust path if needed

// Check session first
if (!isset($_SESSION['user_id'])) {

    // If no session, check remember-me cookie
    if (isset($_COOKIE['remember_me'])) {
        $token = $_COOKIE['remember_me'];

        // Lookup in database
        $stmt = $conn->prepare("SELECT id, email, remember_token FROM users WHERE remember_token IS NOT NULL");
        $stmt->execute();
        $result = $stmt->get_result();

        $userFound = false;
        while ($row = $result->fetch_assoc()) {
            if (password_verify($token, $row['remember_token'])) {
                // Restore session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $userFound = true;
                break;
            }
        }

        if (!$userFound) {
            header("Location: ../User/login.php?status=error&msg=unauthorized");
            exit();
        }
    } else {
        // No session, no cookie → not authorized
        header("Location: ../User/login.php?status=error&msg=unauthorized");
        exit();
    }
}
?>
