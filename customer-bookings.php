<?php
include('layout/admin-header.php');
include('dbconnection.php');

// Get filter parameter
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Build query based on filter
if ($statusFilter === 'all') {
    $query = "SELECT * FROM booking ORDER BY booking_date DESC";
} else {
    $query = "SELECT * FROM booking WHERE status = '" . mysqli_real_escape_string($conn, $statusFilter) . "' ORDER BY booking_date DESC";
}

$result = mysqli_query($conn, $query);

// Get counts for each status
$statusCounts = [];
$countQueries = [
    'all' => "SELECT COUNT(*) as count FROM booking",
    'Pending' => "SELECT COUNT(*) as count FROM booking WHERE status = 'Pending'",
    'In Progress' => "SELECT COUNT(*) as count FROM booking WHERE status = 'In Progress'",
    'Completed' => "SELECT COUNT(*) as count FROM booking WHERE status = 'Completed'",
    'Cancelled' => "SELECT COUNT(*) as count FROM booking WHERE status = 'Cancelled'",
    'Paid' => "SELECT COUNT(*) as count FROM booking WHERE status = 'Paid'",
    'Approved' => "SELECT COUNT(*) as count FROM booking WHERE status = 'Approved'",
    'Rejected' => "SELECT COUNT(*) as count FROM booking WHERE status = 'Rejected'"
];

foreach ($countQueries as $status => $countQuery) {
    $countResult = mysqli_query($conn, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $statusCounts[$status] = $countRow['count'];
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Customer Bookings</h1>
            
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
                                <div class="col-md-8">
                                    <div class="btn-group" role="group" aria-label="Status Filter">
                                        <a href="customer-bookings.php?status=all" 
                                           class="btn <?php echo ($statusFilter === 'all') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                                            All Bookings
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['all']; ?></span>
                                        </a>
                                        <a href="customer-bookings.php?status=Pending" 
                                           class="btn <?php echo ($statusFilter === 'Pending') ? 'btn-info' : 'btn-outline-info'; ?>">
                                            Pending
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['Pending']; ?></span>
                                        </a>
                                        <a href="customer-bookings.php?status=In Progress" 
                                           class="btn <?php echo ($statusFilter === 'In Progress') ? 'btn-warning' : 'btn-outline-warning'; ?>">
                                            In Progress
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['In Progress']; ?></span>
                                        </a>
                                        <a href="customer-bookings.php?status=Completed" 
                                           class="btn <?php echo ($statusFilter === 'Completed') ? 'btn-success' : 'btn-outline-success'; ?>">
                                            Completed
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['Completed']; ?></span>
                                        </a>
                                        <a href="customer-bookings.php?status=Cancelled" 
                                           class="btn <?php echo ($statusFilter === 'Cancelled') ? 'btn-danger' : 'btn-outline-danger'; ?>">
                                            Cancelled
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['Cancelled']; ?></span>
                                        </a>
                                        </a>
                                        <a href="customer-bookings.php?status=Paid" 
                                           class="btn <?php echo ($statusFilter === 'Paid') ? 'btn-secondary' : 'btn-outline-secondary'; ?>">
                                            Paid
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['Paid']; ?></span>
                                        </a>
                                        <a href="customer-bookings.php?status=Approved" 
                                           class="btn <?php echo ($statusFilter === 'Approved') ? 'btn-success' : 'btn-outline-success'; ?>">
                                            Approved
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['Approved']; ?></span>
                                        </a>
                                        <a href="customer-bookings.php?status=Rejected" 
                                           class="btn <?php echo ($statusFilter === 'Rejected') ? 'btn-danger' : 'btn-outline-danger'; ?>">
                                            Rejected
                                            <span class="badge bg-light text-dark ms-1"><?php echo $statusCounts['Rejected']; ?></span>
                                        </a>

                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Search by name, email, or device...">
                                        <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-list me-1"></i>
                                <?php 
                                if ($statusFilter === 'all') {
                                    echo "All Customer Bookings";
                                } else {
                                    echo ucfirst($statusFilter) . " Bookings";
                                }
                                ?>
                                <span class="badge bg-secondary ms-2"><?php echo mysqli_num_rows($result); ?> results</span>
                            </div>
                            <?php if ($statusFilter !== 'all'): ?>
                            <div>
                                <a href="customer-bookings.php?status=all" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Clear Filter
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if (mysqli_num_rows($result) === 0): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No bookings found</h5>
                                    <p class="text-muted">
                                        <?php 
                                        if ($statusFilter === 'all') {
                                            echo "There are no bookings in the system yet.";
                                        } else {
                                            echo "There are no bookings with status: " . htmlspecialchars($statusFilter);
                                        }
                                        ?>
                                    </p>
                                </div>
                            <?php else: ?>
                            <!-- Booking Items -->
                            <div class="accordion" id="bookingsAccordion">
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $bookingId = $row['booking_id'];
                                    $fullName = htmlspecialchars($row['full_name']);
                                    $email = htmlspecialchars($row['email']);
                                    $phone = htmlspecialchars($row['phone_number']);
                                    $address = htmlspecialchars($row['address']);
                                    $device = htmlspecialchars($row['device_brand'] . ' ' . $row['device_model']);
                                    $issue = htmlspecialchars($row['issue_description']);
                                    $urgency = htmlspecialchars($row['repair_type']);
                                    $status = $row['status'];
                                    $cost = number_format($row['repair_cost'], 2);
                                    $date = date("M d, Y", strtotime($row['booking_date']));

                                    $badgeClass = match ($status) {
                                        'Pending' => 'bg-info',
                                        'In Progress' => 'bg-warning',
                                        'Completed' => 'bg-success',
                                        'Cancelled' => 'bg-danger',
                                        'Approved' => 'bg-success',
                                        'Rejected' => 'bg-danger',
                                        'Paid' => 'bg-secondary',
                                        default => 'bg-secondary',
                                    };
                                ?>
                                    <div class="accordion-item mb-3 booking-item" 
                                         data-name="<?php echo strtolower($fullName); ?>" 
                                         data-email="<?php echo strtolower($email); ?>" 
                                         data-device="<?php echo strtolower($device); ?>">
                                        <h2 class="accordion-header" id="booking<?php echo $i; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>">
                                                <div class="d-flex justify-content-between w-100 me-3">
                                                    <div>
                                                        <strong><?php echo $fullName; ?> - <?php echo $device; ?></strong>
                                                        <br><small class="text-muted">Booking ID: #<?php echo $bookingId; ?></small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                                                        <br><small class="text-muted"><?php echo $date; ?></small>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#bookingsAccordion">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Customer Details:</h6>
                                                        <p class="mb-1"><strong>Name:</strong> <?php echo $fullName; ?></p>
                                                        <p class="mb-1"><strong>Email:</strong> <?php echo $email; ?></p>
                                                        <p class="mb-1"><strong>Phone:</strong> <?php echo $phone; ?></p>
                                                        <p class="mb-1"><strong>Address:</strong> <?php echo $address; ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Device Details:</h6>
                                                        <p class="mb-1"><strong>Device:</strong> <?php echo $device; ?></p>
                                                        <p class="mb-1"><strong>Issue:</strong> <?php echo $issue; ?></p>
                                                        <p class="mb-1"><strong>Urgency:</strong> <?php echo $urgency; ?></p>
                                                        <p class="mb-1"><strong>Repair Cost:</strong> <span id="cost<?php echo $bookingId; ?>">RM <?php echo $cost; ?></span></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <form class="booking-update-form" data-booking-id="<?php echo $bookingId; ?>">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6">
                                                            <label for="status<?php echo $bookingId; ?>" class="form-label">Update Status:</label>
                                                            <select class="form-select status-select" id="status<?php echo $bookingId; ?>" name="status" data-booking-id="<?php echo $bookingId; ?>">
                                                                <option value="Pending"<?php echo ($status == 'Pending' ? ' selected' : ''); ?>>Pending</option>
                                                                <option value="In Progress"<?php echo ($status == 'In Progress' ? ' selected' : ''); ?>>In Progress</option>
                                                                <option value="Completed"<?php echo ($status == 'Completed' ? ' selected' : ''); ?>>Completed</option>
                                                                <option value="Cancelled"<?php echo ($status == 'Cancelled' ? ' selected' : ''); ?>>Cancelled</option>
                                                                <option value="Approved"<?php echo ($status == 'Approved' ? ' selected' : ''); ?>>Approved</option>
                                                                <option value="Rejected"<?php echo ($status == 'Rejected' ? ' selected' : ''); ?>>Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <button type="submit" class="btn btn-sm btn-success me-2">Update</button>
                                                            <button type="button" class="btn btn-sm btn-outline-info send-notification-btn" data-booking-id="<?php echo $bookingId; ?>" data-customer-email="<?php echo $email; ?>" data-customer-name="<?php echo $fullName; ?>" data-device="<?php echo $device; ?>" data-status="<?php echo $status; ?>">
                                                                <i class="fas fa-bell me-1"></i>Send Notification
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
                                }
                                ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Price Input Modal -->
    <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModalLabel">Enter Repair Cost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="priceForm">
                        <div class="mb-3">
                            <label for="repairCost" class="form-label">Repair Cost (RM)</label>
                            <input type="number" class="form-control" id="repairCost" name="repairCost" step="0.01" min="0" placeholder="0.00" required>
                        </div>
                        <input type="hidden" id="modalBookingId" name="bookingId">
                        <input type="hidden" id="modalStatus" name="status">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmUpdate">Update Status & Cost</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Send Status Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="notificationForm">
                        <div class="mb-3">
                            <label for="customerEmail" class="form-label">Customer Email</label>
                            <input type="email" class="form-control" id="customerEmail" name="customerEmail" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="notificationMessage" class="form-label">Notification Message</label>
                            <textarea class="form-control" id="notificationMessage" name="notificationMessage" rows="4" placeholder="Enter your message to the customer..."></textarea>
                        </div>
                        <input type="hidden" id="notificationBookingId" name="bookingId">
                        <input type="hidden" id="notificationCustomerName" name="customerName">
                        <input type="hidden" id="notificationDevice" name="device">
                        <input type="hidden" id="notificationStatus" name="status">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info" id="sendNotification">
                        <i class="fas fa-paper-plane me-1"></i>Send Notification
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const clearSearchBtn = document.getElementById('clearSearch');
        const bookingItems = document.querySelectorAll('.booking-item');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            bookingItems.forEach(function(item) {
                const name = item.getAttribute('data-name');
                const email = item.getAttribute('data-email');
                const device = item.getAttribute('data-device');
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || device.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            bookingItems.forEach(function(item) {
                item.style.display = 'block';
            });
        });

        // Status select change handler
        document.querySelectorAll('.status-select').forEach(function(select) {
            select.addEventListener('change', function() {
                const bookingId = this.getAttribute('data-booking-id');
                const newStatus = this.value;

                if (newStatus === 'Completed') {
                    document.getElementById('modalBookingId').value = bookingId;
                    document.getElementById('modalStatus').value = newStatus;
                    document.getElementById('repairCost').value = '';

                    const modal = new bootstrap.Modal(document.getElementById('priceModal'));
                    modal.show();
                }
            });
        });

        // Booking update form handler
        document.querySelectorAll('.booking-update-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const bookingId = this.getAttribute('data-booking-id');
                const status = this.querySelector('.status-select').value;

                if (status !== 'Completed') {
                    updateBookingStatus(bookingId, status, null);
                }
            });
        });

        // Price modal confirm button
        document.getElementById('confirmUpdate').addEventListener('click', function() {
            const bookingId = document.getElementById('modalBookingId').value;
            const status = document.getElementById('modalStatus').value;
            const cost = document.getElementById('repairCost').value;

            if (cost && parseFloat(cost) >= 0) {
                updateBookingStatus(bookingId, status, cost);
                const modal = bootstrap.Modal.getInstance(document.getElementById('priceModal'));
                modal.hide();
            } else {
                alert('Please enter a valid repair cost.');
            }
        });

        // Send notification button handler
        document.querySelectorAll('.send-notification-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                const customerEmail = this.getAttribute('data-customer-email');
                const customerName = this.getAttribute('data-customer-name');
                const device = this.getAttribute('data-device');
                const status = this.getAttribute('data-status');

                // Populate notification modal
                document.getElementById('notificationBookingId').value = bookingId;
                document.getElementById('customerEmail').value = customerEmail;
                document.getElementById('notificationCustomerName').value = customerName;
                document.getElementById('notificationDevice').value = device;
                document.getElementById('notificationStatus').value = status;

                // Generate default message
                const defaultMessage = `Dear ${customerName},\n\nWe wanted to update you on the status of your device repair.\n\nDevice: ${device}\nBooking ID: #${bookingId}\nCurrent Status: ${status}\n\n${getStatusMessage(status)}\n\nIf you have any questions, please don't hesitate to contact us.\n\nBest regards,\nAPAI Repair Service Team`;
                
                document.getElementById('notificationMessage').value = defaultMessage;

                const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                modal.show();
            });
        });

        // Send notification confirm button
        document.getElementById('sendNotification').addEventListener('click', function() {
            const formData = new FormData();
            formData.append('booking_id', document.getElementById('notificationBookingId').value);
            formData.append('customer_email', document.getElementById('customerEmail').value);
            formData.append('customer_name', document.getElementById('notificationCustomerName').value);
            formData.append('device', document.getElementById('notificationDevice').value);
            formData.append('status', document.getElementById('notificationStatus').value);
            formData.append('message', document.getElementById('notificationMessage').value);

            // Here you would typically send to a PHP file that handles email sending
            // For now, we'll just show a success message
            alert('Notification sent successfully to customer!');
            
            const modal = bootstrap.Modal.getInstance(document.getElementById('notificationModal'));
            modal.hide();

            // In a real implementation, you would do:
            /*
            fetch('send-notification.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Notification sent successfully!');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('notificationModal'));
                    modal.hide();
                } else {
                    alert('Error sending notification: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending the notification.');
            });
            */
        });
    });

    function getStatusMessage(status) {
        switch(status) {
            case 'Pending':
                return 'Your repair request has been received and is currently pending review. We will begin working on your device shortly.';
            case 'In Progress':
                return 'Great news! Our technicians have started working on your device. We will keep you updated on the progress.';
            case 'Completed':
                return 'Excellent! Your device repair has been completed successfully. You can now collect your device from our service center.';
            case 'Cancelled':
                return 'Unfortunately, your repair request has been cancelled. Please contact us if you have any questions about this decision.';
            case 'Approved':
                return 'Good news! Your repair request has been approved. We will begin working on your device soon.';
            case 'Rejected':
                return 'We regret to inform you that your repair request has been rejected. Please contact us for more information about this decision.';
            default:
                return 'Thank you for choosing our repair service. We will keep you updated on any changes to your repair status.';
        }
    }

    function updateBookingStatus(bookingId, status, cost) {
        const formData = new FormData();
        formData.append('booking_id', bookingId);
        formData.append('status', status);
        if (cost !== null) {
            formData.append('repair_cost', cost);
        }

        fetch('update-booking-status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const bookingElement = document.querySelector(`[data-booking-id="${bookingId}"]`).closest('.accordion-item');
                const badge = bookingElement.querySelector('.badge');
                badge.className = 'badge';

                switch(status) {
                    case 'Pending': badge.classList.add('bg-info'); break;
                    case 'In Progress': badge.classList.add('bg-warning'); break;
                    case 'Completed': badge.classList.add('bg-success'); break;
                    case 'Cancelled': badge.classList.add('bg-danger'); break;
                    case 'Approved': badge.classList.add('bg-success'); break;
                    case 'Rejected': badge.classList.add('bg-danger'); break;
                }
                badge.textContent = status;

                if (cost !== null) {
                    const costElement = document.getElementById(`cost${bookingId}`);
                    if (costElement) {
                        costElement.textContent = `RM ${parseFloat(cost).toFixed(2)}`;
                    }
                }

                // Update the notification button's data attributes
                const notificationBtn = bookingElement.querySelector('.send-notification-btn');
                if (notificationBtn) {
                    notificationBtn.setAttribute('data-status', status);
                }

                alert('Booking updated successfully!');
                
                // Refresh page to update counts if status changed
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alert('Error updating booking: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the booking.');
        });
    }
    </script>
</div>

<?php include('layout/footer.php'); ?>
