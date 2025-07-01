<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "website1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = trim($_POST['email']);
$password = $_POST['password'];
$user_role = $_POST['user_role'];

// Choose table based on role
if ($user_role === 'user') {
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
} elseif ($user_role === 'admin') {
    $stmt = $conn->prepare("SELECT * FROM staff WHERE staff_email = ?");
} else {
    die("Invalid role selected.");
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Pick correct hashed password field
    $hashed_password = ($user_role === 'user') ? $user['password'] : $user['staff_password'];

    if (password_verify($password, $hashed_password)) {
        // Set session
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $user_role;

        // ✅ Redirect based on role
        if ($user_role === 'user') {
            header("Location: dashboard.php"); // for customers
        } else {
            header("Location: financial-tracking.php"); // for staff/admin
        }
        exit();
    } else {
        echo "<script>alert('❌ Incorrect password.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('❌ Account not found.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
