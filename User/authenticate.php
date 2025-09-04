<?php
// authenticate.php
session_start();
include '../config/db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($email) || empty($password)) {
        header("Location: login.php?status=error&msg=missing_fields");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            //  Store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            if ($remember) {
                // Generate token
                $token = bin2hex(random_bytes(32));
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);

                // Save hashed token in DB (make sure users table has `remember_token` column)
                $stmt = $conn->prepare("UPDATE users SET remember_token=? WHERE id=?");
                $stmt->bind_param("si", $hashedToken, $user['id']);
                $stmt->execute();

                // Store cookie (30 days)
                setcookie("remember_token", $user['id'] . ':' . $token, time() + (86400 * 30), "/", "", true, true);
            }

            header("Location: ../Admin/admin.php?tab=dashboard&status=login_success");
            exit();
        } else {
            header("Location: login.php?status=error&msg=invalid_password");
            exit();
        }
    } else {
        header("Location: login.php?status=error&msg=user_not_found");
        exit();
    }
}
