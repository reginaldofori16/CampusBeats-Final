<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
    </header>

    <main>
        <section class="forgot-password-form">
            <h2>Forgot Password</h2>
            <form id="forgotPasswordForm">
                <label for="email">Enter your email address:</label>
                <input type="email" id="email" name="email" placeholder="Your email address" required>
                <small id="emailMessage"></small>

                <button type="submit" class="btn">Send Reset Link</button>
            </form>

            <div class="back-button">
                <a href="login.php" class="btn">Back to Login</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script src="../assets/js/forgot-password.js"></script>
</body>
</html>
