<?php

require_once "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if (verify_login($email, $password)) {
        header("Location: success.php");
        exit;
    } else {
        $message = "Invalid email or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="auth-shell">
        <section class="auth-card">
            <div class="auth-panel">
                <h2>Hello, Welcome!</h2>
                <p>Sign in with your email and password to continue.</p>
                <div class="panel-actions">
                    <a class="btn btn-ghost" href="register.php">Create an account</a>
                </div>
            </div>

            <div class="auth-form">
                <h1>Login</h1>
                <p class="subtitle">Use your email address to sign in.</p>

                <form method="post" action="login.php" novalidate>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" inputmode="email" autocomplete="email" placeholder="you@example.com" required>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" placeholder="••••••••" required>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Sign In</button>
                    </div>
                </form>

                <?php if ($message !== ""): ?>
                    <div class="feedback error">
                        <span class="feedback-icon">&#10005;</span>
                        <span><?php echo htmlspecialchars($message); ?></span>
                    </div>
                <?php endif; ?>

                <div class="tiny-link">
                    Need an account? <a href="register.php">Register</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

