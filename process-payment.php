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

    // Now fetch booking info to insert into transactions
    $fetch_sql = "SELECT booking_id, repair_cost, service_cleaning, service_screen_protector, device_brand, device_model FROM booking WHERE booking_id IN ($booking_ids_str)";
    $result = $conn->query($fetch_sql);

    while ($row = $result->fetch_assoc()) {
        $booking_id = $row['booking_id'];
        $base_cost = floatval($row['repair_cost']);
        $additional = 0;

        if ($row['service_cleaning']) $additional += 20;
        if ($row['service_screen_protector']) $additional += 20;

        $total_amount = $base_cost + $additional;
        $device = $row['device_brand'] . ' ' . $row['device_model'];
        $description = "$device - Repair Payment";

        // Insert into transactions
        $insert_sql = "INSERT INTO transactions (booking_id, user_email, amount, payment_method, description, type, status)
                       VALUES (?, ?, ?, ?, ?, 'income', 'Completed')";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("isdss", $booking_id, $user_email, $total_amount, $payment_method, $description);
        $insert_stmt->execute();
    }

    echo json_encode([
        'success' => true,
        'message' => "Payment successful and transactions recorded.",
        'updated_bookings' => $affected_rows
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
mysqli_close($conn);
