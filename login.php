<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "website1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user_role = $_POST['user_role'] ?? 'user';

// Choose table and fields
$table = ($user_role === 'admin') ? 'staff' : 'customer';
$email_col = ($user_role === 'admin') ? 'staff_email' : 'email';
$pass_col = ($user_role === 'admin') ? 'staff_password' : 'password';

// Fetch from database
$sql = "SELECT * FROM $table WHERE $email_col = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $db_password = $user[$pass_col];

    if ($password === $db_password) {
        // Success
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['logged_in'] = true;

        if ($user_role === 'admin') {
            header("Location: financial-tracking.php");
        } else {
            header("Location: user-dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('❌ Incorrect password'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('❌ Email not found'); window.location.href='login.html';</script>";
}

$stmt->close();
$conn->close();
?>
