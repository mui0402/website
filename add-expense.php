<?php
session_start();
include('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $desc = trim($_POST['description']);
    $amount = floatval($_POST['amount']);
    $status = $_POST['status'];

    if ($desc && $amount > 0 && in_array($status, ['Paid', 'Pending'])) {
        $stmt = $conn->prepare("INSERT INTO transactions (transaction_date, description, type, amount, status) VALUES (NOW(), ?, 'expense', ?, ?)");
        $stmt->bind_param("sds", $desc, $amount, $status);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: financial-tracking.php");
exit();
