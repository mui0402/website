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

$registration_success = false;
$error_message = "";

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
        $error_message = "Passwords do not match.";
    } else {
        // OPTIONAL: check if email already exists
        $check_sql = "SELECT * FROM customer WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error_message = "Email already registered. Please use a different email address.";
        } else {
            // Insert into database
            $sql = "INSERT INTO customer (first_name, last_name, email, phone_number, password)
                    VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $password);

            if ($stmt->execute()) {
                $registration_success = true;
            } else {
                $error_message = "Registration failed. Please try again.";
            }

            $stmt->close();
        }
        $check_stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $registration_success ? 'Registration Successful' : 'Registration Error'; ?> - APAI Repair System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .register-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .register-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .error-icon {
            font-size: 4rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
        .success-message {
            color: #28a745;
            font-weight: 600;
        }
        .error-message {
            color: #dc3545;
            font-weight: 600;
        }
        .btn-custom {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }
        .btn-secondary-custom {
            background: #6c757d;
            color: white;
            border: none;
        }
        .btn-secondary-custom:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }
    </style>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-fluid register-container">
                    <div class="row justify-content-center align-items-center min-vh-100 py-4">
                        <div class="col-lg-6">
                            <div class="card register-card shadow-lg border-0">
                                <div class="card-body p-5 text-center">
                                    <?php if ($registration_success): ?>
                                        <!-- Success Message -->
                                        <div class="text-center mb-4">
                                            <i class="fas fa-check-circle success-icon"></i>
                                            <h2 class="fw-bold mt-3 success-message">Registration Successful!</h2>
                                            <p class="text-muted mt-3">
                                                Welcome to APAI Repair System! Your account has been created successfully.
                                            </p>
                                            <div class="alert alert-success" role="alert">
                                                <i class="fas fa-info-circle me-2"></i>
                                                You can now log in to your account and start booking repair services.
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <a href="login.html" class="btn btn-custom btn-primary-custom">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login to Your Account
                                            </a>
                                            <a href="index.php" class="btn btn-custom btn-secondary-custom">
                                                <i class="fas fa-home me-2"></i>Back to Home
                                            </a>
                                        </div>
                                        
                                    <?php else: ?>
                                        <!-- Error Message -->
                                        <div class="text-center mb-4">
                                            <i class="fas fa-exclamation-triangle error-icon"></i>
                                            <h2 class="fw-bold mt-3 error-message">Registration Failed</h2>
                                            <p class="text-muted mt-3">
                                                We encountered an issue while creating your account.
                                            </p>
                                            <div class="alert alert-danger" role="alert">
                                                <i class="fas fa-exclamation-circle me-2"></i>
                                                <?php echo htmlspecialchars($error_message); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <a href="register.html" class="btn btn-custom btn-primary-custom">
                                                <i class="fas fa-redo me-2"></i>Try Again
                                            </a>
                                            <a href="login.html" class="btn btn-custom btn-secondary-custom">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login Instead
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-footer text-center py-3">
                                    <div class="small text-muted">
                                        <i class="fas fa-mobile-alt me-2"></i>
                                        APAI - Professional Mobile Device Repair Services
                                    </div>
                                    <div class="small mt-2">
                                        <a href="index.php" class="text-decoration-none">
                                            <i class="fas fa-arrow-left me-1"></i>Back to Home
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
