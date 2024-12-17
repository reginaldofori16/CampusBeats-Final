<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordable Profile</title>
    <link rel="stylesheet" href="../assets/css/recordlabel-profile-creation.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo">
        </div>
        <ul>
            <li><a href="recordlabel-dashboard.php">Dashboard</a></li>
            <li><a href="track-management.php">Tracks</a></li>
            <li><a href="artist-management.php">Artists</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Profile Management Section -->
    <section class="profile-management">
        <h2>Edit Your Profile</h2>
        <form action="../actions/recordlabelprofilecreation.php" method="POST">
            <label for="label-name">Label Name:</label>
            <input type="text" id="label-name" name="label-name" placeholder="Enter label name">
            
            <label for="label-email">Email:</label>
            <input type="email" id="label-email" name="label-email" placeholder="Enter email address">
            
            <label for="label-phone">Phone:</label>
            <input type="tel" id="label-phone" name="label-phone" placeholder="Enter phone number">
            
            <label for="label-description">Description:</label>
            <textarea id="label-description" name="label-description" placeholder="Write about your label..."></textarea>
            
            
            <label for="label-website">Website:</label>
            <input type="text" id="label-website" name="label-website">
            
            <label for="label-address">Address:</label>
            <input type="text" id="label-address" name="label-address">
            
            <label for="label-image">Profile Image:</label>
            <input type="file" id="label-image" name="label-image">
            
            <button type="submit">Save Changes</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
    </footer>

</body>
</html>
