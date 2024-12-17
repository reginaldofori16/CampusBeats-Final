<?php
session_start();
require_once '../db/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'upload_music') {
        uploadMusic($conn);
    }
}

function uploadMusic($conn) {
    $artist_id = $_SESSION['user_id'] ?? '';
    $title = $_POST['title'] ?? 'Untitled';
    $music_file = $_FILES['music_file'] ?? null;

    if (!$artist_id || !$music_file) {
        die(json_encode(['success' => false, 'message' => 'Artist ID and music file are required']));
    }

$upload_dir = __DIR__ . '/../uploads/music/'; // Use '..' to navigate one level up
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0775, true);
    }

    $file_tmp = $music_file['tmp_name'];
    $file_name = time() . '_' . basename($music_file['name']);
    $file_target = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp, $file_target)) {
        $file_url = '/uploads/music/' . $file_name;

        // Save file to database
        $stmt = $conn->prepare("INSERT INTO tracks (artist_id, title, file_url, release_date) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $artist_id, $title, $file_url);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Music uploaded successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save to database']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload file']);
    }
}
?>
