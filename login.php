<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "website";

// Connect
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Query by your real column names
$sql = "SELECT * FROM customer WHERE CUST_EMAIL = '$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();

  if (password_verify($password, $row['CUST_PASSWORD'])) {
    echo "<h2>Welcome, " . htmlspecialchars($row['CUST_NAME']) . "!</h2>";
  } else {
    echo "Invalid password. <a href='login.html'>Try again</a>";
  }
} else {
  echo "Email not found. <a href='login.html'>Try again</a>";
}

$conn->close();
?>
