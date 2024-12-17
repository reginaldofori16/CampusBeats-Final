<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
        <div class="auth-buttons">
            <a href="../view/login.php" class="btn">Login</a>
            <a href="../view/signup.php" class="btn">Sign Up</a>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Discover, Stream, and Collaborate</h2>
                <p>Campus Beats: The ultimate platform for university musicians. Promote your music, collaborate with peers, and get discovered by music labels!</p>
            </div>
        </section>

        <section class="about">
            <h2>Why Campus Beats?</h2>
            <p>
                Campus Beats empowers university musicians to showcase their talent. From streaming original tracks to enabling collaborations, we bridge the gap between creativity and opportunity.
                Connect with peers and music labels, and let the world hear your beats!
            </p>
        </section>
    </main>

    <!-- Featured Schools Section -->
    <section class="featured-schools">
        <h2>Featured Schools</h2>
        <div class="school-slider">
            <div class="school-logos">
                <img src="../assets/imgs/client_schools/sch1.png" alt="Accra Technical University">
                <img src="../assets/imgs/client_schools/sch2.webp" alt="Ashesi University">
                <img src="../assets/imgs/client_schools/sch3.png" alt="Blue Crest College">
                <img src="../assets/imgs/client_schools/sch4.jpeg" alt="Catholic University of Ghana">
                <img src="../assets/imgs/client_schools/sch5.png" alt="Central University">
                <img src="../assets/imgs/client_schools/sch6.png" alt="Ghana Technology University College">
                <img src="../assets/imgs/client_schools/sch7.jpg" alt="Ghana Institute of Management and Public Administration">
                <img src="../assets/imgs/client_schools/sch8.jpg" alt="Takoradi Technical University">
                <img src="../assets/imgs/client_schools/sch9.jpg.webp" alt="Kwame Nkrumah University of Science and Technology">
                <img src="../assets/imgs/client_schools/sch10.png" alt="Zenith University College">
                <img src="../assets/imgs/client_schools/sch11.png" alt="Pentecost University">
                <img src="../assets/imgs/client_schools/sch12.png" alt="University of Professional Studies Accra">
                <img src="../assets/imgs/client_schools/sch13.png" alt="University of Ghana">
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Campus Beats. All rights reserved.</p>
    </footer>

    <script>
        // Auto-scroll for featured schools
        const schoolSlider = document.querySelector('.school-logos');
        let scrollPosition = 0;

        setInterval(() => {
            scrollPosition += 1;
            if (scrollPosition >= schoolSlider.scrollWidth / 2) {
                scrollPosition = 0;
            }
            schoolSlider.scrollLeft = scrollPosition;
        }, 3000);
    </script>
</body>
</html>
