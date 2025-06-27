<?php
session_start();

// Get form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user_role = $_POST['user_role'] ?? 'user';

// Basic validation (in real implementation, you'd validate against database)
if (!empty($email) && !empty($password)) {
    // Set session variables
    $_SESSION['user_email'] = $email;
    $_SESSION['user_role'] = $user_role;
    $_SESSION['logged_in'] = true;
    
    // Redirect based on role
    if ($user_role === 'admin') {
        header('Location: admin-dashboard.php');
    } else {
        header('Location: user-dashboard.php');
    }
    exit();
} else {
    // Redirect back to login with error
    header('Location: login.php?error=invalid_credentials');
    exit();
}
?>
