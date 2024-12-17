<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Beats - Listener Dashboard</title>
    <link rel="stylesheet" href="../assets/css/listener-dashboard.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo">
        </div>
        <ul>
            <li><a href="listener-profile.php">Profile</a></li>
            <li><a href="listener-library.php">Library</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Search Bar Section -->
    <!-- <section class="search-section">
        <input type="text" class="search-bar" placeholder="Search for music, artists, or albums...">
        <button class="search-btn">Search</button>
    </section> -->

    <!-- Featured Music Section -->
    <section class="featured-music">
        <h2>Featured Music</h2>
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

    <!-- Recently Played Section -->
    <section class="recently-played">
        <h2>Recently Played</h2>
        <div class="recent-cards">
            <div class="card">
                <img src="../assets/imgs/logos_and_backgrounds/CampusBeats3.jpg" alt="Recently Played 1">
                <p>Track Name - Artist</p>
            </div>
            <div class="card">
                <img src="../assets/imgs/logos_and_backgrounds/CampusBeats2.jpg" alt="Recently Played 2">
                <p>Track Name - Artist</p>
            </div>
            <div class="card">
                <img src="../assets/imgs/logos_and_backgrounds/CampusBeats1.jpg" alt="Recently Played 3">
                <p>Track Name - Artist</p>
            </div>
        </div>
    </section>
    <section class="search-section">
        <input type="text" id="searchInput" class="search-bar" placeholder="Search for music, artists, or albums...">
        <button id="searchBtn" class="search-btn">Search</button>
    </section>

    <!-- Display Search Results -->
    <!-- <section id="searchResults" class="search-results">
        <h2>Search Results</h2>
        <div id="resultsContainer"></div>
    </section> -->

    <section class="search-results">
        <h3>Search Results</h3>
        <div class="results-container"></div>
    </section>

    


    <script src="../assets/js/logout.js"></script>
    <script src="../assets/js/search.js"></script>



    <!-- Footer -->
    <div class="footer-gap"></div> <!-- Creates space between the main content and footer -->
    <footer class="footer">
        <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
    </footer>

</body>
</html>
