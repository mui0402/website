<?php
include('layout/user-header.php');
include('dbconnection.php');
session_start();

// Get user email
$email = $_SESSION['user_email'] ?? '';
if (empty($email)) {
    header("Location: login.php");
    exit();
}

// Get selected status filter from URL
$statusFilter = $_GET['status'] ?? 'all';

// Count bookings per status
$statusCounts = [
    'all' => 0,
    'Pending' => 0,
    'In Progress' => 0,
    'Completed' => 0,
    'Cancelled' => 0,
    'Paid' => 0,
];

$countQuery = $conn->prepare("SELECT status, COUNT(*) as count FROM booking WHERE email = ? GROUP BY status");
$countQuery->bind_param("s", $email);
$countQuery->execute();
$countResult = $countQuery->get_result();

while ($row = $countResult->fetch_assoc()) {
    $statusCounts[$row['status']] = $row['count'];
}
$statusCounts['all'] = array_sum($statusCounts);

// Query bookings based on filter
if ($statusFilter === 'all') {
    $stmt = $conn->prepare("SELECT * FROM booking WHERE email = ? ORDER BY booking_date DESC");
    $stmt->bind_param("s", $email);
} else {
    $stmt = $conn->prepare("SELECT * FROM booking WHERE email = ? AND status = ? ORDER BY booking_date DESC");
    $stmt->bind_param("ss", $email, $statusFilter);
}
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

            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-filter me-1"></i>
                            Filter Bookings
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group" role="group" aria-label="Status Filter">
                                        <?php
                                        $statuses = ['all', 'Pending', 'In Progress', 'Completed', 'Cancelled', 'Paid'];
                                        $colors = [
                                            'all' => 'primary',
                                            'Pending' => 'info',
                                            'In Progress' => 'warning',
                                            'Completed' => 'success',
                                            'Cancelled' => 'danger',
                                            'Paid' => 'secondary'
                                        ];
                                        foreach ($statuses as $status) {
                                            $isActive = ($statusFilter === $status) ? "btn-{$colors[$status]}" : "btn-outline-{$colors[$status]}";
                                            echo "<a href='my-bookings.php?status=" . urlencode($status) . "' class='btn $isActive'>";
                                            echo ucfirst($status) . " <span class='badge bg-light text-dark ms-1'>{$statusCounts[$status]}</span></a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Filter -->

            <?php if ($result->num_rows > 0): ?>
                <div class="accordion" id="bookingAccordion">
                    <?php $count = 1; while ($row = $result->fetch_assoc()): ?>
                        <?php
                            $status = $row['status'] ?? 'Unknown';
                            $badge = match ($status) {
                                'Pending' => 'info',
                                'In Progress' => 'warning',
                                'Completed' => 'success',
                                'Cancelled' => 'danger',
                                'Paid' => 'primary',
                                default => 'secondary',
                            };
                        ?>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="heading<?= $count ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $count ?>" aria-expanded="false" aria-controls="collapse<?= $count ?>">
                                    <div class="d-flex justify-content-between w-100 me-3">
                                        <div>
                                            <strong><?= htmlspecialchars($row['device_brand'] ?? 'Unknown') ?> <?= htmlspecialchars($row['device_model'] ?? '') ?> - <?= htmlspecialchars($row['issue_description'] ?? '') ?></strong>
                                            <small class="text-muted d-block">Booking ID: #<?= htmlspecialchars($row['booking_id']) ?></small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-<?= $badge ?>"><?= htmlspecialchars($status) ?></span>
                                            <small class="text-muted d-block"><?= date("M j, Y", strtotime($row['booking_date'] ?? $today)) ?></small>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $count ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $count ?>" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Device Information</h6>
                                            <p>
                                                <strong>Device:</strong> <?= htmlspecialchars($row['device_brand'] ?? 'N/A') ?><br>
                                                <strong>Model:</strong> <?= htmlspecialchars($row['device_model'] ?? 'N/A') ?><br>
                                                <strong>Issue:</strong> <?= htmlspecialchars($row['issue_description'] ?? 'N/A') ?><br>
                                                <strong>Repair Type:</strong> <?= htmlspecialchars($row['repair_type'] ?? 'General Repair') ?><br>
                                                <strong>Booking Date:</strong> <?= date("M j, Y", strtotime($row['booking_date'] ?? $today)) ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Status & Cost Info</h6>
                                            <p>
                                                <strong>Current Status:</strong> <span class="badge bg-<?= $badge ?>"><?= htmlspecialchars($status) ?></span><br>
                                                <strong>Repair Cost:</strong>
                                                <?php if (!empty($row['repair_cost']) && $row['repair_cost'] > 0): ?>
                                                    RM <?= number_format($row['repair_cost'], 2) ?>
                                                <?php else: ?>
                                                    <span class="text-muted">To be determined</span>
                                                <?php endif; ?>
                                            </p>

                                            <h6 class="mt-3">Additional Services</h6>
                                            <ul class="mb-0">
                                                <?php if (!empty($row['service_cleaning'])): ?>
                                                    <li>✅ Port Cleaning Service (RM20)</li>
                                                <?php endif; ?>
                                                <?php if (!empty($row['service_screen_protector'])): ?>
                                                    <li>✅ Screen Protector Installation (RM20)</li>
                                                <?php endif; ?>
                                                <?php if (empty($row['service_cleaning']) && empty($row['service_screen_protector'])): ?>
                                                    <li>No additional services selected.</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php if ($status === 'Completed' && !empty($row['repair_cost']) && $row['repair_cost'] > 0): ?>
                                        <div class="mt-3">
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                Your repair is completed! Please proceed to payment to collect your device.
                                            </div>
                                            <a href="payment.php" class="btn btn-success">
                                                <i class="fas fa-credit-card me-2"></i>Proceed to Payment
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mt-3">
                                        <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#staffContact<?= $count ?>" aria-expanded="false">Contact Staff</button>
                                        <div class="collapse mt-2" id="staffContact<?= $count ?>">
                                            <div class="card card-body">
                                                <strong>APAI Repair Service</strong><br>
                                                <strong>Email:</strong> support@apairepair.com<br>
                                                <strong>Phone:</strong> +60 12-345 6789<br>
                                                <strong>Address:</strong> 123 Tech Street, Kuala Lumpur
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $count++; endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    No bookings found for the selected status. Please try a different filter.
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include('layout/footer.php'); ?>
