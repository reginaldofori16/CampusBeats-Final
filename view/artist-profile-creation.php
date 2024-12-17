<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listener Profile Creation</title>
    <link rel="stylesheet" href="../assets/css/listener-profile-creation.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <!-- Ensure logo path is correct -->
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
        <nav>
            <a href="index.php" class="home-btn">Back</a>
        </nav>
    </header>

    <!-- Main Profile Creation Form -->
    <div class="container">
        <form action="../actions/artistprofilecreation.php" method="POST" class="profile-form">
            <h2>Create Your Listener Profile</h2>

            <!-- stage name &bio Section -->
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself..."></textarea>
            <label for="stage_name">Stage Name:</label>
            <textarea id="stage_name" name="stage_name" rows="4" placeholder="What is your stage name"></textarea>


            <!-- Genre Selection
            <label for="favorite-genres">Favorite Genres:</label>
            <div class="genre-options">
                <input type="checkbox" id="pop" name="genres" value="Pop"> Pop
                <input type="checkbox" id="hiphop" name="genres" value="Hip Hop"> Hip Hop
                <input type="checkbox" id="rock" name="genres" value="Rock"> Rock
                <input type="checkbox" id="jazz" name="genres" value="Jazz"> Jazz
                <input type="checkbox" id="classical" name="genres" value="Classical"> Classical
                <input type="checkbox" id="electronic" name="genres" value="Electronic"> Electronic
            </div> -->

            <!-- Profile Picture Upload (Optional) -->
            <label for="profile-picture">Upload Profile Picture (Optional):</label>
            <input type="file" id="profile-picture" name="profile-picture">

            <!-- Save Profile Button -->
            <button type="submit" class="save-btn">Save Profile</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script src="../assets/js/artist-profile-creation.js"></script>
</body>
</html>
