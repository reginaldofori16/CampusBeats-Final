<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bio = trim($_POST['bio']);
    $stage_name = trim($_POST['stage_name']);
    $profile_picture = isset($_FILES['profile-picture']) ? $_FILES['profile-picture'] : null;

    // Validate inputs
    if (empty($bio) && empty($genres) && !$profile_picture) {
        header("Location: ../view/artist-profile-creation.php?error=Please provide some profile information.");
        exit;
    }

    // Handle file upload (if any)
    $uploaded_file_path = null;
    if ($profile_picture && $profile_picture['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/profile_pictures/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $uploaded_file_path = $upload_dir . uniqid() . '_' . basename($profile_picture['name']);
        if (!move_uploaded_file($profile_picture['tmp_name'], $uploaded_file_path)) {
            header("Location: ../view/artist-profile-creation.php?error=Failed to upload profile picture.");
            exit;
        }
    }

    try {
        // Update the profile_picture in the users table
        if ($uploaded_file_path) {
            $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE user_id = ?");
            $stmt->bind_param("si", $uploaded_file_path, $_SESSION['user_id']);
            if (!$stmt->execute()) {
                throw new Exception("Failed to update profile picture in users table: " . $stmt->error);
            }
        }

        // Insert artist-specific data into artists table
        $stmt = $conn->prepare("INSERT INTO artists (artist_id, stage_name, bio) VALUES ( ?, ?,?)");
        $stmt->bind_param("iss", $_SESSION['user_id'], $stage_name, $bio);
        if (!$stmt->execute()) {
            throw new Exception("Failed to insert data into artists table: " . $stmt->error);
        }

        // Redirect to login page on success
        header("Location: ../view/login.php?message=Profile created successfully.");
        $conn->close();
        exit;
    } catch (Exception $e) {
        header("Location: ../view/artist-profile-creation.php?error=" . urlencode("Error: " . $e->getMessage()));
        exit;
    }
} else {
    header("Location: ../view/artist-profile-creation.php?error=Invalid request method.");
    exit;
}

