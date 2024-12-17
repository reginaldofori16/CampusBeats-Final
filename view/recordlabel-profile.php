<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Label Profile</title>
    <link rel="stylesheet" href="../assets/css/recordlabel-profile.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo">
        </div>
        <ul>
            <li><a href="recordlabel-dashboard.php">Dashboard</a></li>
            <li><a href="track-management.php">Manage Tracks</a></li>
            <li><a href="artist-management.php">Manage Artists</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Profile Section -->
    <section class="profile-section">
        <h2>Record Label Profile</h2>

        <!-- Profile Information Display -->
        <div class="profile-info">
            <div class="info-group">
                <label for="label-name">Label Name:</label>
                <p id="label-name">Universal Music</p>
            </div>

            <div class="info-group">
                <label for="label-email">Email:</label>
                <p id="label-email">contact@universal.com</p>
            </div>

            <div class="info-group">
                <label for="label-phone">Phone Number:</label>
                <p id="label-phone">+1234567890</p>
            </div>

            <div class="info-group">
                <label for="label-address">Address:</label>
                <p id="label-address">123 Music Lane, New York</p>
            </div>

            <div class="info-group">
                <label for="label-website">Website:</label>
                <p id="label-website">https://www.universalmusic.com</p>
            </div>

            <div class="info-group">
                <label for="label-description">Description:</label>
                <p id="label-description">We are a leading record label...</p>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <a href="recordlabel-profile-creation.php">
            <button class="edit-btn">Edit Profile</button>
        </a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
    </footer>

</body>
</html>
