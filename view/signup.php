<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/signup.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
    </header>

    <main>
        <section class="signup-form">
            <h2>Sign Up</h2>
            <form id="signupForm" method="POST" action="../actions/signup_user.php" >
                <!-- User Type Selection -->
                <label for="user_type">I am signing up as:</label>
                <select id="user_type" name="user_type" required>
                    <option value="">-- Select User Type --</option>
                    <option value="artist">Artist</option>
                    <option value="listener">Listener</option>
                    <option value="musicLabel">Music Label</option>
                </select>

                <!-- General Information -->
                <div class="general-info">
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Your full name" required>

                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="Your email address" required>
                    <small id="emailMessage"></small>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                    <div id="passwordRequirements">
                        <p>Password must contain:</p>
                        <ul>
                            <li id="lengthReq">At least 8 characters</li>
                            <li id="uppercaseReq">At least 1 uppercase letter</li>
                            <li id="numberReq">At least 1 number</li>
                            <li id="specialCharReq">At least 1 special character</li>
                        </ul>
                    </div>

                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    <small id="passwordMessage"></small>

                    <label for="phone_number">Phone Number:</label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="Optional">
                </div>

                <!-- Additional Information for Artist and Listener -->
                <div id="additionalInfo">
                    <!-- School Selection -->
                    <div id="schoolSection">
                        <label for="school">Select Your School:</label>
                        <select id="school" name="school">
                            <option value="">-- Select School --</option>
                            <option value="accraTechnicalUniversity">Accra Technical University</option>
                            <option value="ashesiUniversity">Ashesi University</option>
                            <option value="blueCrestCollege">Blue Crest College</option>
                            <option value="catholicUniversity">Catholic University of Ghana</option>
                            <option value="centralUniversity">Central University</option>
                            <option value="ghanaTechnologyUniversity">Ghana Technology University College</option>
                            <option value="gimpa">Ghana Institute of Management and Public Administration</option>
                            <option value="takoradiTechnicalUniversity">Takoradi Technical University</option>
                            <option value="knust">Kwame Nkrumah University of Science and Technology</option>
                            <option value="zenithUniversity">Zenith University College</option>
                            <option value="pentecostUniversity">Pentecost University</option>
                            <option value="upsa">University of Professional Studies Accra</option>
                            <option value="universityOfGhana">University of Ghana</option>
                        </select>
                    </div>

                <!-- Submit Button -->
                <button type="submit" class="btn" onclick="window.location.href='listener-profile-creation.php';">Continue Creating Profile</button>
            </form>



            <!-- Back Button -->
            <div class="back-button">
                <a href="index.php" class="btn">Back to Home</a>
            </div>

            <div class="log-in">
                <a href="login.php" class="btn">Already have an account?</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script src="../assets/js/signup.js"></script>
</body>
</html>
