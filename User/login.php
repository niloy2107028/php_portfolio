<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="login.css" />
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
</body>

</html>
