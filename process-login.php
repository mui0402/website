<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "website1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form input
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$user_role = $_POST['user_role'] ?? 'user';

// Check which table to use
$table = ($user_role === 'admin') ? 'staff' : 'customer';
$email_column = ($user_role === 'admin') ? 'staff_email' : 'email';
$password_column = ($user_role === 'admin') ? 'staff_password' : 'password';

$sql = "SELECT * FROM $table WHERE $email_column = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Plain-text password comparison (⚠️ not recommended for production)
    if ($password === $user[$password_column]) {
        // ✅ Set session variables
        $_SESSION['user_email'] = $user[$email_column];
        $_SESSION['user_role'] = $user_role;
        $_SESSION['logged_in'] = true;

        // ✅ Redirect based on role
        if ($user_role === 'admin') {
            header("Location: financial-tracking.php");
        } else {
            header("Location: user-dashboard.php");
        }
        exit();
    } else {
        // ❌ Wrong password
        echo "<script>alert('❌ Incorrect password.'); window.location.href='login.php';</script>";
        exit();
    }
} else {
    // ❌ Email not found
    echo "<script>alert('❌ Email not found.'); window.location.href='login.php';</script>";
    exit();
}
