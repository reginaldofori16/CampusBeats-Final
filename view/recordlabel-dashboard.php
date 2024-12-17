<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Beats - Recordable Dashboard</title>
    <link rel="stylesheet" href="../assets/css/recordlabel-dashboard.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo">
        </div>  
        <ul>
            <li><a href="recordlabel-profile.php">Profile</a></li>
            <li><a href="track-management.php">Tracks</a></li>
            <li><a href="artist-management.php">Artists</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Dashboard Overview -->
    <section class="dashboard-overview">
        <h2>Welcome to Your Dashboard</h2>
        <p>Manage your record label profile, tracks, and artists efficiently!</p>
    </section>

    <!-- Featured Tracks Section -->
    <section class="featured-tracks">
        <h2>Featured Tracks</h2>
        <div class="featured-container">
            <div class="featured-item">
                <img src="../assets/imgs/logos_and_backgrounds/CampusBeats.jpg" alt="Featured Track 1">
                <p>Track Name - Artist</p>
            </div>
            <div class="featured-item">
                <img src="../assets/imgs/logos_and_backgrounds/CampusBeats1.jpg" alt="Featured Track 2">
                <p>Track Name - Artist</p>
            </div>
            <div class="featured-item">
                <img src="../assets/imgs/logos_and_backgrounds/CampusBeats2.jpg" alt="Featured Track 3">
                <p>Track Name - Artist</p>
            </div>
        </div>
    </section>

    <!-- Manage Tracks and Artists -->
    <section class="manage-options">
        <div class="manage-item">
            <a href="track-management.php" class="manage-btn">Manage Tracks</a>
        </div>
        <div class="manage-item">
            <a href="artist-management.php" class="manage-btn">Manage Artists</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
    </footer>

</body>
</html>
