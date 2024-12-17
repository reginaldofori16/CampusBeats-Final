<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
    </header>

    <main>
        <section class="login-form">
            <h2>Login</h2>
            <form id="loginForm" method="POST" action="../actions/login_user.php">
                <!-- User Type Selection -->
                <!-- <label for="userType">I am logging in as:</label>
                <select id="userType" name="userType" required>
                    <option value="">-- Select User Type --</option>
                    <option value="superadmin">Administrator</option>
                    <option value="artist">Artist</option>
                    <option value="listener">Listener</option>
                    <option value="musicLabel">Music Label</option>
                </select> -->

                <!-- Email and Password -->
                <div class="login-info">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="Your email address" required>
                    <small id="emailMessage"></small>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Your password" required>
                    <small id="passwordMessage"></small>

                    <!-- Remember Me -->
                    <div class="remember-me">
                        <input type="checkbox" id="rememberMe" name="rememberMe">
                        <label for="rememberMe">Remember Me</label>
                    </div>
                </div>

                <!-- Forgot Password Link -->
                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn">Login</button>
            </form>

            <!-- Back Button -->
            <div class="back-button">
                <a href="index.php" class="btn">Back to Home</a>
            </div>

            <div class="sign-up">
                <a href="signup.php" class="btn">Don't Have an account?</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script src="../assets/js/login.js"></script>
</body>
</html>
