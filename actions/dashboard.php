<?php
error_reporting(E_ALL);
ini_set("",1);
require_once '../db/db.php'; // Include your database connection file

/** Fetch summary data for the admin dashboard */
if ($_GET['action'] === 'fetch_dashboard_summary') {
    $response = [];

    // Total Artists
    $query = "SELECT COUNT(*) as total_artists FROM artists";
    $result = $conn->query($query);
    $response['total_artists'] = $result->fetch_assoc()['total_artists'];

    // Total listeners
    $query = "SELECT COUNT(*) as total_listeners FROM listeners";
    $result = $conn->query($query);
    $response['total_listeners'] = $result->fetch_assoc()['total_listeners'];

    // Total tracks
    $query = "SELECT COUNT(*) as total_tracks FROM tracks";
    $result = $conn->query($query);
    $response['total_tracks'] = $result->fetch_assoc()['total_tracks'];

      // Total tracks
      $query = "SELECT COUNT(*) as total_record_labels FROM record_labels";
      $result = $conn->query($query);
      $response['total_record_labels'] = $result->fetch_assoc()['total_record_labels'];
  
      
    echo json_encode($response);
    exit;
}

/** Fetch all tracks with artist and genre information */
if ($_GET['action'] === 'fetch_tracks') {
    $query = "
        SELECT t.track_id, t.track_name, a.stage_name AS artist_name, g.genre_name 
        FROM tracks t
        JOIN artists a ON t.artist_id = a.artist_id
        JOIN artist_genres ag ON a.artist_id = ag.artist_id
        JOIN genres g ON ag.genre_id = g.genre_id
    ";

    $result = $conn->query($query);
    $tracks = [];

    while ($row = $result->fetch_assoc()) {
        $tracks[] = $row;
    }

    echo json_encode($tracks);
    exit;
}

/** Fetch all users for user management */
if ($_GET['action'] === 'fetch_users') {
    $query = "
        SELECT u.user_id as id, u.full_name, u.email, u.user_type
        FROM users u
    ";

    $result = $conn->query($query);
    $users = [];

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
    exit;
}

// edit or delete 
// Update User Details
if ($_POST['action'] === 'edit_user') {
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['type'];

    $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssis', $name, $email, $id, $type);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    exit;
}


if ($_POST['action'] === 'delete_user') {
    header('Content-Type: application/json'); // Correct Content-Type
    ob_clean(); // Clear any previous output to prevent invalid JSON
    $response = ['success' => false];

    $user_id = $_POST['id'];
    if ($user_id) {
        try {
            // Delete from dependent tables first
            $conn->query("DELETE FROM playlist_tracks WHERE playlist_id IN (SELECT playlist_id FROM playlists WHERE user_id = $user_id)");
            $conn->query("DELETE FROM favorites WHERE user_id = $user_id");
            $conn->query("DELETE FROM messages WHERE sender_id = $user_id OR receiver_id = $user_id");
            $conn->query("DELETE FROM artist_genres WHERE artist_id IN (SELECT artist_id FROM artists WHERE artist_id = $user_id)");
            $conn->query("DELETE FROM playlists WHERE user_id = $user_id");
            $conn->query("DELETE FROM tracks WHERE artist_id IN (SELECT artist_id FROM artists WHERE artist_id = $user_id)");
            $conn->query("DELETE FROM artist_label_relationships WHERE artist_id IN (SELECT artist_id FROM artists WHERE artist_id = $user_id)");
            
            // Delete user-specific records
            $conn->query("DELETE FROM artists WHERE artist_id = $user_id");
            $conn->query("DELETE FROM listeners WHERE listener_id = $user_id");
            $conn->query("DELETE FROM record_labels WHERE label_id = $user_id");

            // Delete user
            if ($conn->query("DELETE FROM users WHERE user_id = $user_id")) {
                $response['success'] = true;
            } else {
                $response['error'] = "Failed to delete user record.";
            }
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }
    } else {
        $response['error'] = "User ID is missing.";
    }

    echo json_encode($response);
    exit;
}






/** CRUD operations for tracks (create, update, delete) */
if ($_POST['action'] === 'manage_track') {
    $operation = $_POST['operation']; // e.g., 'create', 'update', 'delete'

    if ($operation === 'create') {
        $track_name = $_POST['track_name'];
        $artist_id = $_POST['artist_id'];

        $query = "INSERT INTO tracks (track_name, artist_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $track_name, $artist_id);
    } elseif ($operation === 'update') {
        $track_id = $_POST['track_id'];
        $track_name = $_POST['track_name'];
        $artist_id = $_POST['artist_id'];

        $query = "UPDATE tracks SET track_name = ?, artist_id = ? WHERE track_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sii', $track_name, $artist_id, $track_id);
    } elseif ($operation === 'delete') {
        $track_id = $_POST['track_id'];

        $query = "DELETE FROM tracks WHERE track_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $track_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    exit;
}
?>
