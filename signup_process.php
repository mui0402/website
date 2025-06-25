<?php
include 'database.php';

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = $_POST['address'];

$sql = "INSERT INTO customer (CUST_NAME, CUST_PHONENO, CUST_EMAIL, CUST_PASSWORD, CUST_ADDRESS)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $fullname, $phone, $email, $password, $address);

if ($stmt->execute()) {
  echo "<span class='text-success'>Registration successful!</span>";
} else {
  echo "<span class='text-danger'>Error: " . $stmt->error . "</span>";
}

$conn->close();
?>
