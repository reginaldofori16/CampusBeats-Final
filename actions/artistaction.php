<?php
// actions/artist_actions.php

// Database connection configuration
$host = 'localhost';
$db_name = 'webtech_fall2024_reginald_ofori';
$db_user = 'root';
$db_password = '';

// MySQLi Connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
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
            updateArtist($conn);
            break;
        case 'send_message':
            sendMessage($conn);
            break;
        case 'fetch_chat':
            fetchChatMessages($conn);
            break;
        case 'add_genre':
            addArtistGenre($conn);
            break;
        case 'get_artists':
            getArtists($conn);
            break;
        case 'upload_music':
            uploadMusic($conn);
            break;
        case 'delete_track':
            deleteTrack($conn);
            break;
        default:
            sendResponse(false, null, 'Invalid action');
    }
}

/**
 * Update Artist Details
 */
function updateArtist($conn) {
    $artist_id = $_POST['artist_id'] ?? '';
    $stage_name = $_POST['stage_name'] ?? '';
    $bio = $_POST['bio'] ?? '';

    if (!$artist_id || !$stage_name || !$bio) {
        sendResponse(false, null, 'All fields are required');
    }

    $stmt = $conn->prepare("UPDATE artists SET stage_name = ?, bio = ? WHERE artist_id = ?");
    $stmt->bind_param("ssi", $stage_name, $bio, $artist_id);

    if ($stmt->execute()) {
        sendResponse(true, null, 'Artist updated successfully');
    } else {
        sendResponse(false, null, 'Error: ' . $stmt->error);
    }
}

/**
 * Send Message
 */
function sendMessage($conn) {
    $sender_id = $_POST['sender_id'] ?? '';
    $receiver_id = $_POST['receiver_id'] ?? '';
    $message_text = $_POST['message_text'] ?? '';

    if (!$sender_id || !$receiver_id || !$message_text) {
        sendResponse(false, null, 'All fields are required');
    }

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message_text, sent_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message_text);

    if ($stmt->execute()) {
        sendResponse(true, null, 'Message sent successfully');
    } else {
        sendResponse(false, null, 'Error: ' . $stmt->error);
    }
}

/**
 * Fetch Chat Messages Between Two Artists
 */
function fetchChatMessages($conn) {
    $artist1_id = $_POST['artist1_id'] ?? '';
    $artist2_id = $_POST['artist2_id'] ?? '';

    if (!$artist1_id || !$artist2_id) {
        sendResponse(false, null, 'Both artist IDs are required');
    }

    $stmt = $conn->prepare(
        "SELECT sender_id, receiver_id, message_text, sent_at 
         FROM messages 
         WHERE (sender_id = ? AND receiver_id = ?) 
            OR (sender_id = ? AND receiver_id = ?) 
         ORDER BY sent_at ASC"
    );
    $stmt->bind_param("iiii", $artist1_id, $artist2_id, $artist2_id, $artist1_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $messages = $result->fetch_all(MYSQLI_ASSOC);

    sendResponse(true, $messages, 'Chat messages fetched successfully');
}

/**
 * Upload Music File
 */
function uploadMusic($conn) {
    session_start();

    // Validate artist ID and file upload
    $artist_id = $_SESSION['user_id'] ?? '';
    $title = $_POST['title'] ?? 'Untitled';
    $music_file = $_FILES['music_file'] ?? null;
    $cover_art = $_FILES['cover_art'] ?? null;

    if (!$artist_id || empty($music_file)) {
        sendResponse(false, null, 'Artist ID and music file are required.');
    }

    // Define upload directories
    $upload_base_dir = realpath(__DIR__ . '/../../uploads'); // Base uploads directory
    $music_upload_dir = $upload_base_dir . '/music/';
    $cover_upload_dir = $upload_base_dir . '/cover_art/';

    // Create directories if they don't exist
    if (!is_dir($music_upload_dir)) mkdir($music_upload_dir, 0775, true);
    if (!is_dir($cover_upload_dir)) mkdir($cover_upload_dir, 0775, true);

    // Allowed file types
    $allowed_music_types = ['audio/mpeg', 'audio/mp3', 'audio/wav'];
    $allowed_cover_types = ['image/jpeg', 'image/png', 'image/webp'];

    // Process music file upload
    $music_tmp = $music_file['tmp_name'];
    $music_type = $music_file['type'];
    $music_name = time() . '_' . basename($music_file['name']);
    $music_target = $music_upload_dir . $music_name;

    if (!in_array($music_type, $allowed_music_types)) {
        sendResponse(false, null, 'Invalid music file type. Allowed: mp3, wav.');
    }
    if (!move_uploaded_file($music_tmp, $music_target)) {
        sendResponse(false, null, 'Failed to upload music file.');
    }

    // Music file URL
    $music_url = '/uploads/music/' . $music_name;

    // Process cover art upload (optional)
    $cover_url = null;
    if (!empty($cover_art['tmp_name'])) {
        $cover_tmp = $cover_art['tmp_name'];
        $cover_type = $cover_art['type'];
        $cover_name = time() . '_' . basename($cover_art['name']);
        $cover_target = $cover_upload_dir . $cover_name;

        if (!in_array($cover_type, $allowed_cover_types)) {
            sendResponse(false, null, 'Invalid cover art file type. Allowed: jpg, png, webp.');
        }
        if (!move_uploaded_file($cover_tmp, $cover_target)) {
            sendResponse(false, null, 'Failed to upload cover art.');
        }
        $cover_url = '/uploads/cover_art/' . $cover_name;
    }

    // Save to database
    $stmt = $conn->prepare("INSERT INTO tracks (artist_id, title, file_url, cover_art_url, release_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $artist_id, $title, $music_url, $cover_url);

    if ($stmt->execute()) {
        sendResponse(true, null, 'Track uploaded successfully!');
    } else {
        sendResponse(false, null, 'Database error: ' . $stmt->error);
    }
}




/**
 * Add Artist Genre
 */
function addArtistGenre($conn) {
    $artist_id = $_POST['artist_id'] ?? '';
    $genre_id = $_POST['genre_id'] ?? '';

    if (!$artist_id || !$genre_id) {
        sendResponse(false, null, 'Both artist ID and genre ID are required');
    }

    $stmt = $conn->prepare("INSERT INTO artist_genres (artist_id, genre_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $artist_id, $genre_id);

    if ($stmt->execute()) {
        sendResponse(true, null, 'Genre added successfully');
    } else {
        sendResponse(false, null, 'Error: ' . $stmt->error);
    }
}

/**
 * Get All Artists
 */
function getArtists($conn) {
    $result = $conn->query("SELECT artist_id, stage_name FROM artists ORDER BY stage_name ASC");

    if ($result) {
        $artists = $result->fetch_all(MYSQLI_ASSOC);
        sendResponse(true, $artists, 'Artists fetched successfully');
    } else {
        sendResponse(false, null, 'Error: ' . $conn->error);
    }
}

/**
 * Delete Track
 */
function deleteTrack($conn) {
    $track_id = $_POST['track_id'] ?? '';
    $artist_id = $_SESSION['user_id'] ?? '';

    if (!$track_id || !$artist_id) {
        sendResponse(false, null, 'Track ID and artist ID are required');
    }

    $stmt = $conn->prepare("DELETE FROM tracks WHERE track_id = ? AND artist_id = ?");
    $stmt->bind_param("ii", $track_id, $artist_id);

    if ($stmt->execute()) {
        sendResponse(true, null, 'Track deleted successfully');
    } else {
        sendResponse(false, null, 'Error: ' . $stmt->error);
    }
}
?>
