<?php
session_start();
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $full_name = trim($_POST['full_name']);
    $phone_number = trim($_POST['phone_number']);
    if (empty($_POST['user_type'])){
        $user_type = 'superadmin';
    } else{ 
        $user_type = trim($_POST['user_type']);
    }

    if (empty($email) || empty($password) || empty($full_name) ) {
        header("Location: ../views/signup.php?error=All fields are required.");
        exit;
    }
   

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/signup.php?error=Invalid email format.");
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (email, password_hash, full_name, phone_number, user_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $password_hash, $full_name, $phone_number, $user_type);
        $stmt->execute();

        // Store user_id in session for subsequent steps
        $_SESSION['user_id'] = $conn->insert_id;

        // Role-based redirection after successful registration
        switch ($user_type) {
            case 'artist':
                header("Location: ../view/artist-profile-creation.php");
                break;
            case 'musicLabel':
                header("Location: ../view/recordlabel-profile-creation.php");
                break;
            case 'listener':
                header("Location: ../view/listener-profile-creation.php");
                break;
            case 'superadmin':
                header("Location: ../view/admin_dashboard.php");
                break;
            default:
                header("Location: ../view/dashboard.php"); // Fallback
                break;
        }
        exit;
    } catch (Exception $e) {
        if ($conn->errno == 1062) { // Duplicate email error
            header("Location: ../view/signup.php?error=Email already registered.");
        } else {
            header("Location: ../view/signup.php?error=An error occurred.");
        }
        exit;
    }
} else {
    header("Location: ../view/signup.php?error=Invalid request method.");
    exit;
}
