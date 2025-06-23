<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "website";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form input
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hashed
$address = $_POST['address'];

// Insert using your actual column names
$sql = "INSERT INTO customer (CUST_NAME, CUST_PHONENO, CUST_EMAIL, CUST_PASSWORD, CUST_ADDRESS)
        VALUES ('$fullname', '$phone', '$email', '$password', '$address')";

if ($conn->query($sql) === TRUE) {
  echo "Registration successful! <a href='login.html'>Login here</a>";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
