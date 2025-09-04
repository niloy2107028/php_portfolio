<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="../flash.css" />
</head>

<body>
    <div class="login-container">
        <h1>Log In</h1>
        <form method="post" action="authenticate.php">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" required />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Enter Password" class="form-control" id="password" required />
            </div>

            <!-- Remember Me -->
            <div class="mb-3">
                <label class="form-label" for="remember">
                    <input type="checkbox" name="remember" id="remember"> Remember me
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-login">Log In</button>
        </form>
    </div>



    <?php
    // Flash message handler
    $status = $_GET['status'] ?? null;
    $msg = $_GET['msg'] ?? null;

    if ($status) {
        $messageText = '';
        $messageType = '';

        switch ($status) {
            case 'success':
                $messageText = $msg ? ucfirst(str_replace("_", " ", $msg)) : "Operation successful!";
                $messageType = 'success';
                break;

            case 'error':
                // Customize error messages
                if ($msg === "invalid_password") {
                    $messageText = "Invalid password. Please try again.";
                } elseif ($msg === "user_not_found") {
                    $messageText = "User not found. Please check your email.";
                } else {
                    $messageText = $msg ? ucfirst(str_replace("_", " ", $msg)) : "Something went wrong!";
                }
                $messageType = 'error';
                break;

            case 'logged_out':
                $messageText = "You have logged out successfully.";
                $messageType = 'success';
                break;

            case 'login_success':
                $messageText = "You have logged in successfully.";
                $messageType = 'success';
                break;

            default:
                $messageText = ucfirst(str_replace("_", " ", $status));
                $messageType = 'success';
                break;
        }
    }
    ?>

    <?php if (!empty($messageText)): ?>
        <div id="flash-message" class="flash-toast <?= $messageType ?>">
            <?= htmlspecialchars($messageText) ?>
            <div class="flash-bar"></div>
        </div>
    <?php endif; ?>

  <script src="../flash.js"></script>
</body>

</html>