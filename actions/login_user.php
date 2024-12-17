<?php
session_start();
require_once '../db/db.php'; // Ensure this file works correctly

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: ../view/login.php?error=Email and password are required.");
        exit();
    }

    // Check database connection
    if (!$conn) {
        die("Database connection failed!");
    }

    $stmt = $conn->prepare("
        SELECT u.*, COALESCE(a.stage_name, rl.company_name, l.bio) AS profile_info 
        FROM users u 
        LEFT JOIN artists a ON u.user_id = a.artist_id 
        LEFT JOIN record_labels rl ON u.user_id = rl.label_id 
        LEFT JOIN listeners l ON u.user_id = l.listener_id 
        WHERE u.email = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect based on role
            if ($user['user_type'] === 'artist') {
                header("Location: ../view/artist-dashboard.php");
                exit;
            } elseif ($user['user_type'] === 'listener') {
                header("Location: ../view/listener-dashboard.php");
                exit;
            } else {
                header("Location: ../view/admin-dashboard.php");
                exit;
            }
            
            exit();
        } else {
            header("Location: ../view/login.php?error=Invalid password.");
            exit();
        }
    } else {
        header("Location: ../view/login.php?error=No user found with that email.");
        exit();
    }
}
$conn->close();
?>
