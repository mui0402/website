<?php
// === DB connection ===
$host = "localhost";       // usually localhost
$user = "root";            // XAMPP default user
$pass = "";                // XAMPP default password is blank
$db   = "website1";         // your database name

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// === Handle form data ===
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize form inputs
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone_number"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // OPTIONAL: check if email already exists
    $check_sql = "SELECT * FROM customer WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        die("Email already registered.");
    }

    // Insert into database
    $sql = "INSERT INTO customer (first_name, last_name, email, phone_number, password)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
        // OR: redirect to login/dashboard
        // header("Location: login.php");
        // exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
