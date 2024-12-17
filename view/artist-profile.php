<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Profile</title>
    <link rel="stylesheet" href="../assets/css/artist-profile.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <!-- Check if the image path is correct -->
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
        <nav>
            <a href="artist-dashboard.php" class="home-btn">Dashboard</a>
        </nav>
    </header>

    <!-- Artist Profile Content -->
    <div class="container">
        <h2>Artist Profile</h2>
        <div class="profile-details">
            <div class="profile-picture">
                <!-- Placeholder image for the artist's profile picture -->
                <img src="path_to_artist_profile_picture.jpg" alt="Artist Profile Picture">
            </div>
            <div class="profile-info">
                <h3>Bio:</h3>
                <p id="bio">This is where the artist's bio will be displayed.</p>
                
                <h3>Favorite Genres:</h3>
                <p id="genres">Pop, Hip Hop, Jazz</p>
            </div>
        </div>
        <button class="edit-btn">Edit Profile</button>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script src="../assets/css/artist-profile.js"></script>
</body>
</html>
