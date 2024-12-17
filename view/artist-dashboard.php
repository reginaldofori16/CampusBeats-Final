<?php
session_start();
require_once '../db/db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php?error=Please login to access the dashboard");
    exit();
}

$artist_id = $_SESSION['user_id'];

// Get artist stats
$stats_query = $conn->prepare("
    SELECT 
        (SELECT COUNT(*) FROM favorites WHERE track_id IN (SELECT track_id FROM tracks WHERE artist_id = ?)) AS followers,
        (SELECT SUM(plays) FROM tracks WHERE artist_id = ?) AS total_plays,
        (SELECT COUNT(*) FROM tracks WHERE artist_id = ? AND release_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)) AS new_releases
");
$stats_query->bind_param("iii", $artist_id, $artist_id, $artist_id);
$stats_query->execute();
$stats_result = $stats_query->get_result();
$stats = $stats_result->fetch_assoc();

// Get artist's tracks
$tracks_query = $conn->prepare("
    SELECT track_id, title, file_url, cover_art_url, plays, release_date 
    FROM tracks 
    WHERE artist_id = ? 
    ORDER BY release_date DESC
");
$tracks_query->bind_param("i", $artist_id);
$tracks_query->execute();
$tracks_result = $tracks_query->get_result();
$tracks = $tracks_result->fetch_all(MYSQLI_ASSOC);

// Get notifications
$notifications_query = $conn->prepare("
    SELECT message_text, sent_at 
    FROM messages 
    WHERE receiver_id = ? 
    ORDER BY sent_at DESC 
    LIMIT 5
");
$notifications_query->bind_param("i", $artist_id);
$notifications_query->execute();
$notifications_result = $notifications_query->get_result();
$notifications = $notifications_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard | Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/artist-dashboard.css">
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h1>Campus Beats</h1>
        </div>
        <nav>
            <a href="artist-chat.php">Chat</a>
            <a href="artist-dashboard.php" class="active">Dashboard</a>
            <a href="artist-profile.php">Profile</a>
            <a href="../actions/logout.php">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section class="dashboard-overview">
            <h2>Artist Dashboard</h2>
            <div class="stats">
                <div class="stat-item">
                    <p>Followers</p>
                    <p><?php echo number_format($stats['followers'] ?? 0); ?></p>
                </div>
                <div class="stat-item">
                    <p>Total Plays</p>
                    <p><?php echo number_format($stats['total_plays'] ?? 0); ?></p>
                </div>
                <div class="stat-item">
                    <p>New Releases</p>
                    <p><?php echo $stats['new_releases'] ?? 0; ?></p>
                </div>
            </div>
        </section>

        <!-- Music Management Section -->
        <section class="music-management">
            <h3>Your Music</h3>
            <button class="upload-button" id="uploadMusicBtn">Upload New Music</button>

            <!-- Upload Modal -->
            <div id="uploadModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Upload New Track</h2>
                    <form id="uploadMusicForm" enctype="multipart/form-data" method="POST"
                        action="../actions/artist_action.php">
                        <input type="hidden" name="action" value="upload_music">
                        <input type="text" name="title" placeholder="Track Title new" required>
                        <input type="file" name="music_file" accept=".mp3,.wav" required>
                        <input type="file" name="cover_art" accept="image/*">
                        <button type="submit">Upload</button>
                    </form>


                </div>
            </div>

            <div class="music-list">
                <?php foreach ($tracks as $track): ?>
                    <div class="music-item" data-track-id="<?php echo $track['track_id']; ?>">
                        <img src="<?php echo $track['cover_art_url'] ?? '../assets/imgs/default-album-art.jpg'; ?>"
                            alt="<?php echo htmlspecialchars($track['title']); ?>">
                        <p class="track-title"><?php echo htmlspecialchars($track['title']); ?></p>
                        <p class="track-plays"><?php echo number_format($track['plays']); ?> plays</p>
                        <button class="delete-button">Delete</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Notifications Section -->
        <section class="notifications">
            <h3>Notifications</h3>
            <?php foreach ($notifications as $notification): ?>
                <div class="notification-item">
                    <p><?php echo htmlspecialchars($notification['message_text']); ?></p>
                    <small><?php echo date('M d, Y', strtotime($notification['sent_at'])); ?></small>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
    </footer>

    <script src="../assets/js/artist-dashboard.js"></script>
    <script src="../assets/js/logout.js"></script>

</body>

</html>