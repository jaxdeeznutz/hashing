<?php

require_once "functions.php";

$message = "";
$isSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $message = register_user($email, $password);
    $isSuccess = ($message === "Registration successful.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="auth-shell">
        <section class="auth-card panel-side-right">
            <div class="auth-panel">
                <h2>Welcome Back!</h2>
                <p>Already have an account? Sign in with your email.</p>
                <div class="panel-actions">
                    <a class="btn btn-ghost" href="login.php">Sign in</a>
                </div>
            </div>

            <div class="auth-form">
                <h1>Registration</h1>
                <p class="subtitle">Create an account with your email address.</p>

                <form method="post" action="register.php" novalidate>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" inputmode="email" autocomplete="email" placeholder="you@example.com" required>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Create a password" required>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Create Account</button>
                    </div>
                </form>

                <?php if ($message !== ""): ?>
                    <div class="feedback <?php echo $isSuccess ? "success" : "error"; ?>">
                        <span class="feedback-icon"><?php echo $isSuccess ? "&#10003;" : "&#10005;"; ?></span>
                        <span><?php echo htmlspecialchars($message); ?></span>
                    </div>
                <?php endif; ?>

                <div class="tiny-link">
                    Already have an account? <a href="login.php">Login</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

