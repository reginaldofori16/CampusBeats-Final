<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listener Profile - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/listener-profile.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
        <nav>
            <a href="listener-dashboard.php" class="home-btn">Home</a>
            <a href="listener-library.php">Library</a>
            <a href="index.php" class="logout-btn">Log Out</a>
        </nav>
    </header>

    <!-- Profile Section -->
    <main>
        <section class="profile-header">
            <div class="profile-info">
                <div class="profile-picture">
                    <img src="profile-picture.jpg" alt="Profile Picture">
                </div>
                <div class="user-details">
                    <h2>Welcome, <span class="username">John Doe</span></h2>
                    <p><strong>Email:</strong> johndoe@example.com</p>
                    <p><strong>Favorite Genres:</strong> Pop, Rock, Hip Hop</p>
                    <p><strong>Location:</strong> Accra, Ghana</p>
                </div>
            </div>
        </section>

        <!-- School Information -->
        <section class="school-info">
            <h3>Your School</h3>
            <div class="school-logo-container">
                <img src="../assets/imgs/client_schools/sch1.png" alt="School Logo" class="school-logo"> <!-- Adjust the source to the right logo image -->
                <p>School Name: <strong>University of Ashesi</strong></p>
            </div>
        </section>

        <!-- Music Suggestions Section -->
        <section class="music-suggestions">
            <h2>Discover New Music</h2>
            <div class="suggested-tracks">
                <!-- Track 1 -->
                <div class="track">
                    <img src="music1.jpg" alt="Music 1">
                    <p>Song Title 1</p>
                </div>
                <!-- Track 2 -->
                <div class="track">
                    <img src="music2.jpg" alt="Music 2">
                    <p>Song Title 2</p>
                </div>
                <!-- Track 3 -->
                <div class="track">
                    <img src="music3.jpg" alt="Music 3">
                    <p>Song Title 3</p>
                </div>
            </div>
        </section>
    </main>

    
    <!-- Edit Profile Button -->
    <section class="edit-profile-section">
        <a href="listener-profile-creation.php" class="edit-profile-btn">Edit Profile</a>
    </section>
    

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script src="../assets/js/listener-profile.js"></script>
</body>
</html>
