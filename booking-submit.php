<?php
session_start();

// Check if customer is logged in
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    header("Location: login.php");
    exit();
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "website1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get customer ID from session
$email = $_SESSION['user_email'];
$getCustomer = $conn->prepare("SELECT customer_id FROM customer WHERE email = ?");
$getCustomer->bind_param("s", $email);
$getCustomer->execute();
$getResult = $getCustomer->get_result();

if ($getResult->num_rows !== 1) {
    echo "<script>alert('Customer not found.'); window.location.href = 'booking.php';</script>";
    exit();
}

$customer = $getResult->fetch_assoc();
$customer_id = $customer['customer_id'];

// Get form data
$full_name = $_POST['name'];
$email = $_POST['email'];
$phone_number = $_POST['phone'];
$address = $_POST['address'];
$device_type = $_POST['device_type'];
$device_brand = $_POST['device_brand'];
$device_model = $_POST['device_model'];
$preferred_date = $_POST['device_intake'];
$issue_description = $_POST['device_issue'];
$service_cleaning = isset($_POST['data_backup']) ? 1 : 0;
$service_screen_protector = isset($_POST['screen_protector']) ? 1 : 0;

// Insert booking into database
$stmt = $conn->prepare("INSERT INTO booking 
(customer_id, full_name, email, phone_number, address, device_type, device_brand, device_model, preferred_date, issue_description, service_cleaning, service_screen_protector) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("issssssssssi", $customer_id, $full_name, $email, $phone_number, $address, $device_type, $device_brand, $device_model, $preferred_date, $issue_description, $service_cleaning, $service_screen_protector);

if ($stmt->execute()) {
    echo "<script>alert('✅ Booking successful!'); window.location.href = 'user-dashboard.php';</script>";
} else {
    echo "<script>alert('❌ Booking failed: " . $conn->error . "'); window.location.href = 'booking.php';</script>";
}

$stmt->close();
$conn->close();
?>
