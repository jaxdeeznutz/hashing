<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Successful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main class="auth-shell">
        <section class="auth-card">
            <div class="auth-panel">
                <h2>Welcome!</h2>
                <p>You’re signed in.</p>
                <div class="panel-actions">
                    <a class="btn btn-ghost" href="index.php">Back to Home</a>
                </div>
            </div>
            <div class="auth-form">
                <h1>Login Successful</h1>
                <p class="subtitle">Your credentials were verified using your stored salt and the app pepper.</p>
                <div class="feedback success">
                    <span class="feedback-icon">&#10003;</span>
                    <span>Success: you are now logged in.</span>
                </div>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php">Continue</a>
                    <a class="btn btn-ghost" href="login.php">Back to Login</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

