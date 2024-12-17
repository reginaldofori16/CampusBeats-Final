<?php
// actions/artist_actions.php

// Database connection configuration
$host = 'localhost';
$db_name = 'webtech_fall2024_reginald_ofori'; // Change to your database name
$db_user = 'root'; // Change if needed
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Helper function for JSON responses
function sendResponse($success, $data = null, $message = '') {
    echo json_encode(['success' => $success, 'data' => $data, 'message' => $message]);
    exit();
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'update_artist':
            updateArtist($pdo);
            break;
        case 'send_message':
            sendMessage($pdo);
            break;
        case 'fetch_chat':
            fetchChatMessages($pdo);
            break;
        case 'add_genre':
            addArtistGenre($pdo);
            break;
        case 'get_artists':
            getArtists($pdo);
            break;
        case 'upload_music':
            uploadMusic($pdo);
            break;
        case 'delete_track':
            deleteTrack($pdo);
            break;
        default:
            sendResponse(false, null, 'Invalid action');
    }
}

/**
 * Update Artist Details
 */
function updateArtist($pdo) {
    $artist_id = $_POST['artist_id'] ?? '';
    $stage_name = $_POST['stage_name'] ?? '';
    $bio = $_POST['bio'] ?? '';

    if (!$artist_id || !$stage_name || !$bio) {
        sendResponse(false, null, 'All fields are required');
    }

    try {
        $stmt = $pdo->prepare("UPDATE artists SET stage_name = ?, bio = ? WHERE artist_id = ?");
        $stmt->execute([$stage_name, $bio, $artist_id]);
        sendResponse(true, null, 'Artist updated successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}

/**
 * Send Message
 */
function sendMessage($pdo) {
    $sender_id = $_POST['sender_id'] ?? '';
    $receiver_id = $_POST['receiver_id'] ?? '';
    $message_text = $_POST['message_text'] ?? '';

    if (!$sender_id || !$receiver_id || !$message_text) {
        sendResponse(false, null, 'All fields are required');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message_text, sent_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$sender_id, $receiver_id, $message_text]);
        sendResponse(true, null, 'Message sent successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}

/**
 * Fetch Chat Messages Between Two Artists
 */
function fetchChatMessages($pdo) {
    $artist1_id = $_POST['artist1_id'] ?? '';
    $artist2_id = $_POST['artist2_id'] ?? '';

    if (!$artist1_id || !$artist2_id) {
        sendResponse(false, null, 'Both artist IDs are required');
    }

    try {
        $stmt = $pdo->prepare(
            "SELECT sender_id, receiver_id, message_text, sent_at 
             FROM messages 
             WHERE (sender_id = ? AND receiver_id = ?) 
                OR (sender_id = ? AND receiver_id = ?) 
             ORDER BY sent_at ASC"
        );
        $stmt->execute([$artist1_id, $artist2_id, $artist2_id, $artist1_id]);
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse(true, $messages, 'Chat messages fetched successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}

/**
 * Upload Music File
 */
function uploadMusic($pdo) {
    $artist_id = $_POST['artist_id'] ?? '';
    if (!$artist_id || !isset($_FILES['music_file'])) {
        sendResponse(false, null, 'Artist ID and music file are required');
    }

    $file = $_FILES['music_file'];
    $upload_dir = __DIR__ . '/../uploads/music/';
    $allowed_types = ['audio/mpeg', 'audio/mp3', 'audio/wav'];

    if (!in_array($file['type'], $allowed_types)) {
        sendResponse(false, null, 'Invalid file type');
    }

    $file_name = time() . '_' . basename($file['name']);
    $target_file = $upload_dir . $file_name;

    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        sendResponse(false, null, 'File upload failed');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO tracks (artist_id, title, file_url, release_date) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$artist_id, $_POST['title'] ?? 'Untitled', '/uploads/music/' . $file_name]);
        sendResponse(true, null, 'Music uploaded successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}

/**
 * Add Artist Genre
 */
function addArtistGenre($pdo) {
    $artist_id = $_POST['artist_id'] ?? '';
    $genre_id = $_POST['genre_id'] ?? '';

    if (!$artist_id || !$genre_id) {
        sendResponse(false, null, 'Both artist ID and genre ID are required');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO artist_genres (artist_id, genre_id) VALUES (?, ?)");
        $stmt->execute([$artist_id, $genre_id]);
        sendResponse(true, null, 'Genre added successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}

/**
 * Get All Artists
 */
function getArtists($pdo) {
    try {
        $stmt = $pdo->query("SELECT artist_id, stage_name FROM artists ORDER BY stage_name ASC");
        $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse(true, $artists, 'Artists fetched successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}

/**
 * Delete Track
 */
function deleteTrack($pdo) {
    $track_id = $_POST['track_id'] ?? '';
    $artist_id = $_SESSION['user_id'] ?? '';

    if (!$track_id || !$artist_id) {
        sendResponse(false, null, 'Track ID and artist ID are required');
    }

    try {
        // Verify the track belongs to the artist
        $stmt = $pdo->prepare("SELECT file_url FROM tracks WHERE track_id = ? AND artist_id = ?");
        $stmt->execute([$track_id, $artist_id]);
        $track = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$track) {
            sendResponse(false, null, 'Track not found or unauthorized');
        }

        // Delete the physical file
        if ($track['file_url']) {
            $file_path = __DIR__ . '/..' . $track['file_url'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM tracks WHERE track_id = ? AND artist_id = ?");
        $stmt->execute([$track_id, $artist_id]);
        
        sendResponse(true, null, 'Track deleted successfully');
    } catch (PDOException $e) {
        sendResponse(false, null, 'Error: ' . $e->getMessage());
    }
}
?>
