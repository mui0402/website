<?php
include 'dbconnection.php';

header('Content-Type: application/json');

$month = $_GET['month'] ?? '';
$view = $_GET['view'] ?? 'monthly';

if (empty($month)) {
    echo json_encode(['success' => false, 'message' => 'Month is required']);
    exit;
}

$start_date = date('Y-m-01', strtotime($month));
$end_date = date('Y-m-t', strtotime($month));

if ($view === 'weekly') {
    // Limit to last 7 days of the month
    $start_date = date('Y-m-d', strtotime("$end_date -6 days"));
}

$sql = "SELECT * FROM transactions WHERE transaction_date BETWEEN ? AND ? ORDER BY transaction_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

echo json_encode(['success' => true, 'data' => $transactions]);
?>
