<?php
include 'database.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Check customer table
$sql = "SELECT * FROM customer WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && password_verify($password, $row['password'])) {
    echo "customer";
    exit;
}

// Check staff table
$sql = "SELECT * FROM staff WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && password_verify($password, $row['password'])) {
    echo "staff";
} else {
    echo "invalid";
}
?>