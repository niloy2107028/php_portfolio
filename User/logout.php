<?php
session_start();

// 1. Clear all session data
$_SESSION = [];
session_unset();
session_destroy();
// wipes session data. 

// 2. Clear remember_token cookie
if (isset($_COOKIE['remember_token'])) {
    setcookie("remember_token", "", time() - 3600, "/", "", true, true);
    // expires the cookie immediately.
}

// 3. Redirect to homepage
header("Location: ../index.php?status=logged_out");
exit();
