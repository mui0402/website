<?php
include('layout/user-header.php');

// Database connection (without config/db.php)
$conn = new mysqli("localhost", "root", "", "website1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's email
session_start();
$email = $_SESSION['user_email'] ?? '';

// Get customer ID
$customerQuery = $conn->prepare("SELECT customer_id FROM customer WHERE email = ?");
$customerQuery->bind_param("s", $email);
$customerQuery->execute();
$customerResult = $customerQuery->get_result();
$customer = $customerResult->fetch_assoc();
$customer_id = $customer['customer_id'] ?? 0;

// Fetch all bookings for this customer
$stmt = $conn->prepare("SELECT * FROM booking WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

date_default_timezone_set('Asia/Kuala_Lumpur');
$today = date('Y-m-d');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">My Repairs</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="user-dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">My Repairs</li>
            </ol>

            <?php if ($result->num_rows > 0): ?>
                <div class="accordion" id="bookingAccordion">
                    <?php $count = 1; while ($row = $result->fetch_assoc()): ?>
                        <?php
                            // Status logic
                            if ($row['status'] === 'Completed') {
                                $status = 'Completed';
                                $badge = 'success';
                            } elseif ($today >= $row['preferred_date']) {
                                $status = 'Processing';
                                $badge = 'warning';
                            } else {
                                $status = 'Pending';
                                $badge = 'info';
                            }
                        ?>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="heading<?= $count ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $count ?>" aria-expanded="false" aria-controls="collapse<?= $count ?>">
                                    <div class="d-flex justify-content-between w-100 me-3">
                                        <div>
                                            <strong><?= htmlspecialchars($row['device_model']) ?> - <?= htmlspecialchars($row['issue_description']) ?></strong>
                                            <small class="text-muted d-block">Booking ID: #<?= $row['booking_id'] ?></small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-<?= $badge ?>"><?= $status ?></span>
                                            <small class="text-muted d-block"><?= date("M j, Y", strtotime($row['preferred_date'])) ?></small>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $count ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $count ?>" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Device Information</h6>
                                            <p><strong>Device:</strong> <?= htmlspecialchars($row['device_brand']) ?><br>
                                            <strong>Model:</strong> <?= htmlspecialchars($row['device_model']) ?><br>
                                            <strong>Issue:</strong> <?= htmlspecialchars($row['issue_description']) ?><br>
                                            <strong>Intake Date:</strong> <?= htmlspecialchars($row['preferred_date']) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Status Info</h6>
                                            <p><strong>Current Status:</strong> <span class="badge bg-<?= $badge ?>"><?= $status ?></span></p>

                                            <h6 class="mt-3">Additional Services</h6>
                                            <ul class="mb-0">
                                                <?php if ($row['service_cleaning']): ?>
                                                    <li>✅ Port Cleaning Service (RM20)</li>
                                                <?php endif; ?>
                                                <?php if ($row['service_screen_protector']): ?>
                                                    <li>✅ Screen Protector Installation (RM20)</li>
                                                <?php endif; ?>
                                                <?php if (!$row['service_cleaning'] && !$row['service_screen_protector']): ?>
                                                    <li>No additional services selected.</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#staffContact<?= $count ?>" aria-expanded="false">Contact Staff</button>
                                        <div class="collapse mt-2" id="staffContact<?= $count ?>">
                                            <?php
                                                $staffResult = $conn->query("SELECT * FROM staff LIMIT 1");
                                                if ($staff = $staffResult->fetch_assoc()):
                                            ?>
                                                <div class="card card-body">
                                                    <strong>Name:</strong> <?= $staff['staff_name'] ?><br>
                                                    <strong>Email:</strong> <?= $staff['staff_email'] ?><br>
                                                    <strong>Phone:</strong> <?= $staff['staff_phone'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $count++; endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">No bookings found.</div>
            <?php endif; ?>
        </div>
    </main>
</div>
<?php include('layout/footer.php'); ?>
