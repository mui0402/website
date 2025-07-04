<?php
session_start();
include('dbconnection.php');

// Set content type to JSON
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['bookings']) || empty($input['bookings'])) {
    echo json_encode(['success' => false, 'message' => 'No bookings selected']);
    exit();
}

$bookings = $input['bookings'];
$payment_method = $input['payment_method'] ?? 'online_banking';

// Validate booking IDs (ensure they are integers)
$booking_ids = array_map('intval', $bookings);
$booking_ids_str = implode(',', $booking_ids);

// Get customer ID from session
$user_email = $_SESSION['user_email'];
$customer_query = "SELECT customer_id FROM customer WHERE email = '$user_email'";
$customer_result = mysqli_query($conn, $customer_query);

if (!$customer_result || mysqli_num_rows($customer_result) === 0) {
    echo json_encode(['success' => false, 'message' => 'Customer not found']);
    exit();
}

$customer_data = mysqli_fetch_assoc($customer_result);
$customer_id = $customer_data['customer_id'];

// Update booking status to 'Paid' for selected bookings
$update_sql = "UPDATE booking SET status = 'Paid' WHERE booking_id IN ($booking_ids_str) AND customer_id = $customer_id";
$update_result = mysqli_query($conn, $update_sql);

if ($update_result) {
    $affected_rows = mysqli_affected_rows($conn);
    if ($affected_rows > 0) {
        echo json_encode([
            'success' => true, 
            'message' => "Payment successful for $affected_rows booking(s)",
            'updated_bookings' => $affected_rows
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No bookings were updated']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>