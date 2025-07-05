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

// Get user email from session
$user_email = $_SESSION['user_email'];

// Update booking status to 'Paid' for selected bookings belonging to this user
$update_sql = "UPDATE booking SET status = 'Paid' WHERE booking_id IN ($booking_ids_str) AND email = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("s", $user_email);
$update_result = $stmt->execute();

if ($update_result) {
    $affected_rows = $stmt->affected_rows;
    if ($affected_rows > 0) {
        echo json_encode([
            'success' => true, 
            'message' => "Payment successful for $affected_rows booking(s)",
            'updated_bookings' => $affected_rows
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No bookings were updated. Please check if the bookings belong to your account.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
mysqli_close($conn);
?>
