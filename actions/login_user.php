<?php
session_start();
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../view/login.php?error=Email and password are required.");
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT u.*, COALESCE(a.stage_name, rl.company_name, l.bio) as profile_info 
                               FROM users u 
                               LEFT JOIN artists a ON u.user_id = a.artist_id 
                               LEFT JOIN record_labels rl ON u.user_id = rl.label_id 
                               LEFT JOIN listeners l ON u.user_id = l.listener_id 
                               WHERE u.email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                // Update last_login
                $updateStmt = $conn->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE user_id = ?");
                $updateStmt->bind_param("i", $user['user_id']);
                $updateStmt->execute();

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['profile_info'] = $user['profile_info'];
                $_SESSION['created_at'] = $user['created_at'];
                $_SESSION['last_login'] = $user['last_login'];

                // Role-based redirection
                // change the paths
                switch ($user['user_type']) {
                    case 'artist':
                        header("Location: ../view/artist-dashboard.php");
                        break;
                    case 'record_label':
                        header("Location: ../view/label-dashboard.php");
                        break;
                    case 'listener':
                        header("Location: ../view/listener-dashboard.php");
                        break;
                    case 'superadmin':
                        header("Location: ../view/admin-dashboard.php");
                        break;
                    default:
                        header("Location: ../view/dashboard.php"); // Fallback
                        break;
                }
                exit;
            } else {
                header("Location: ../views/login.php?error=Invalid password.");
                exit;
            }
        } else {
            header("Location: ../views/login.php?error=No user found with that email.");
            exit;
        }

        $stmt->close();
    } catch (Exception $e) {
        header("Location: ../views/login.php?error=An error occurred during login.");
        exit;
    }
} else {
    header("Location: ../views/login.php?error=Invalid request method.");
    exit;
}

$conn->close();