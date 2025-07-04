<?php
include('dbconnection.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'] ?? '';
    $status = $_POST['status'] ?? '';
    $repair_cost = $_POST['repair_cost'] ?? null;
    
    if (empty($booking_id) || empty($status)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    
    try {
        // Build the SQL query based on whether repair_cost is provided
        if ($repair_cost !== null) {
            $sql = "UPDATE booking SET status = ?, repair_cost = ? WHERE booking_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdi", $status, $repair_cost, $booking_id);
        } else {
            $sql = "UPDATE booking SET status = ? WHERE booking_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $status, $booking_id);
        }
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Booking updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No booking found with that ID']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>
