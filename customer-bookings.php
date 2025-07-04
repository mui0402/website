<?php include ('layout/admin-header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Customer Bookings</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer Bookings</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-list me-1"></i>
                                            All Customer Bookings
                                        </div>
                                        <a href="booking.php" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus me-1"></i>New Booking
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <!-- Booking Items -->
                                        <div class="accordion" id="bookingsAccordion">
                                            <!-- Booking 1 -->
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="booking1">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                                        <div class="d-flex justify-content-between w-100 me-3">
                                                            <div>
                                                                <strong>John Doe - iPhone 13 Screen Replacement</strong>
                                                                <br><small class="text-muted">Booking ID: #APR001</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <span class="badge bg-warning">In Progress</span>
                                                                <br><small class="text-muted">Jan 15, 2025</small>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#bookingsAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Customer Details:</h6>
                                                                <p class="mb-1"><strong>Name:</strong> John Doe</p>
                                                                <p class="mb-1"><strong>Email:</strong> john.doe@email.com</p>
                                                                <p class="mb-1"><strong>Phone:</strong> +60123456789</p>
                                                                <p class="mb-1"><strong>Address:</strong> Kuala Lumpur, Malaysia</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Device Details:</h6>
                                                                <p class="mb-1"><strong>Device:</strong> iPhone 13</p>
                                                                <p class="mb-1"><strong>Issue:</strong> Cracked screen, touch not responsive</p>
                                                                <p class="mb-1"><strong>Urgency:</strong> Medium</p>
                                                                <p class="mb-1"><strong>Repair Cost:</strong> <span id="cost1">RM 450</span></p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <form class="booking-update-form" data-booking-id="1">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <label for="status1" class="form-label">Update Status:</label>
                                                                    <select class="form-select form-select-sm status-select" id="status1" name="status" style="width: auto; display: inline-block;" data-booking-id="1">
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="In Progress" selected>In Progress</option>
                                                                        <option value="Completed">Completed</option>
                                                                        <option value="Cancelled">Cancelled</option>
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                    <button type="submit" class="btn btn-sm btn-success me-2">Update Status</button>
                                                                    <button type="button" class="btn btn-sm btn-info">Send Notification</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Booking 2 -->
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="booking2">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                                        <div class="d-flex justify-content-between w-100 me-3">
                                                            <div>
                                                                <strong>Jane Smith - Samsung Galaxy Battery</strong>
                                                                <br><small class="text-muted">Booking ID: #APR002</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <span class="badge bg-info">Pending</span>
                                                                <br><small class="text-muted">Jan 16, 2025</small>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#bookingsAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Customer Details:</h6>
                                                                <p class="mb-1"><strong>Name:</strong> Jane Smith</p>
                                                                <p class="mb-1"><strong>Email:</strong> jane.smith@email.com</p>
                                                                <p class="mb-1"><strong>Phone:</strong> +60123456790</p>
                                                                <p class="mb-1"><strong>Address:</strong> Petaling Jaya, Malaysia</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Device Details:</h6>
                                                                <p class="mb-1"><strong>Device:</strong> Samsung Galaxy S21</p>
                                                                <p class="mb-1"><strong>Issue:</strong> Battery drains quickly, won't hold charge</p>
                                                                <p class="mb-1"><strong>Urgency:</strong> Low</p>
                                                                <p class="mb-1"><strong>Repair Cost:</strong> <span id="cost2">RM 280</span></p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <form class="booking-update-form" data-booking-id="2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <label for="status2" class="form-label">Update Status:</label>
                                                                    <select class="form-select form-select-sm status-select" id="status2" name="status" style="width: auto; display: inline-block;" data-booking-id="2">
                                                                        <option value="Pending" selected>Pending</option>
                                                                        <option value="In Progress">In Progress</option>
                                                                        <option value="Completed">Completed</option>
                                                                        <option value="Cancelled">Cancelled</option>
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                    <button type="submit" class="btn btn-sm btn-success me-2">Update Status</button>
                                                                    <button type="button" class="btn btn-sm btn-info">Send Notification</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Booking 3 -->
                                            <div class="accordion-item mb-3">
                                                <h2 class="accordion-header" id="booking3">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                                        <div class="d-flex justify-content-between w-100 me-3">
                                                            <div>
                                                                <strong>Mike Johnson - iPad Water Damage</strong>
                                                                <br><small class="text-muted">Booking ID: #APR003</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <span class="badge bg-success">Completed</span>
                                                                <br><small class="text-muted">Jan 14, 2025</small>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#bookingsAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Customer Details:</h6>
                                                                <p class="mb-1"><strong>Name:</strong> Mike Johnson</p>
                                                                <p class="mb-1"><strong>Email:</strong> mike.johnson@email.com</p>
                                                                <p class="mb-1"><strong>Phone:</strong> +60123456791</p>
                                                                <p class="mb-1"><strong>Address:</strong> Shah Alam, Malaysia</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6>Device Details:</h6>
                                                                <p class="mb-1"><strong>Device:</strong> iPad Pro 11"</p>
                                                                <p class="mb-1"><strong>Issue:</strong> Water damage, screen flickering</p>
                                                                <p class="mb-1"><strong>Urgency:</strong> High</p>
                                                                <p class="mb-1"><strong>Final Cost:</strong> <span id="cost3">RM 650</span></p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <span class="badge bg-success">Repair Completed</span>
                                                                <span class="badge bg-info ms-2">Payment Received</span>
                                                            </div>
                                                            <div>
                                                                <button class="btn btn-sm btn-outline-primary">View Invoice</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status change
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const bookingId = this.getAttribute('data-booking-id');
            const newStatus = this.value;
            
            if (newStatus === 'Completed') {
                // Show price modal
                document.getElementById('modalBookingId').value = bookingId;
                document.getElementById('modalStatus').value = newStatus;
                document.getElementById('repairCost').value = '';
                
                const modal = new bootstrap.Modal(document.getElementById('priceModal'));
                modal.show();
            }
        });
    });
    
    // Handle form submissions
    document.querySelectorAll('.booking-update-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const bookingId = this.getAttribute('data-booking-id');
            const status = this.querySelector('.status-select').value;
            
            if (status !== 'Completed') {
                // Update status only
                updateBookingStatus(bookingId, status, null);
            }
        });
    });
    
    // Handle price modal confirmation
    document.getElementById('confirmUpdate').addEventListener('click', function() {
        const bookingId = document.getElementById('modalBookingId').value;
        const status = document.getElementById('modalStatus').value;
        const cost = document.getElementById('repairCost').value;
        
        if (cost && parseFloat(cost) >= 0) {
            updateBookingStatus(bookingId, status, cost);
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('priceModal'));
            modal.hide();
        } else {
            alert('Please enter a valid repair cost.');
        }
    });
});

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
            // Update the badge
            const bookingElement = document.querySelector(`[data-booking-id="${bookingId}"]`).closest('.accordion-item');
            const badge = bookingElement.querySelector('.badge');
            
            // Update badge based on status
            badge.className = 'badge';
            switch(status) {
                case 'Pending':
                    badge.classList.add('bg-info');
                    break;
                case 'In Progress':
                    badge.classList.add('bg-warning');
                    break;
                case 'Completed':
                    badge.classList.add('bg-success');
                    break;
                case 'Cancelled':
                    badge.classList.add('bg-danger');
                    break;
            }
            badge.textContent = status;
            
            // Update cost if provided
            if (cost !== null) {
                const costElement = document.getElementById(`cost${bookingId}`);
                if (costElement) {
                    costElement.textContent = `RM ${parseFloat(cost).toFixed(2)}`;
                }
            }
            
            // Show success message
            alert('Booking updated successfully!');
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

<?php include ('layout/footer.php'); ?>
