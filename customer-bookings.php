<?php
include('layout/admin-header.php');
include('dbconnection.php'); // <-- Correct file for DB connection

$result = mysqli_query($conn, "SELECT * FROM booking");
?>

<main class="container py-4">
    <h3 class="mb-4">Customer Bookings</h3>
    <div class="accordion" id="bookingsAccordion">
        <?php
        $query = "SELECT * FROM booking ORDER BY booking_date DESC";
        $result = mysqli_query($conn, $query);
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
                default => 'bg-secondary',
            };

            echo '
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="booking' . $i . '">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '">
                        <div class="d-flex justify-content-between w-100 me-3">
                            <div>
                                <strong>' . $fullName . ' - ' . $device . '</strong>
                                <br><small class="text-muted">Booking ID: #' . $bookingId . '</small>
                            </div>
                            <div class="text-end">
                                <span class="badge ' . $badgeClass . '">' . $status . '</span>
                                <br><small class="text-muted">' . $date . '</small>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapse' . $i . '" class="accordion-collapse collapse" data-bs-parent="#bookingsAccordion">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Customer Details:</h6>
                                <p class="mb-1"><strong>Name:</strong> ' . $fullName . '</p>
                                <p class="mb-1"><strong>Email:</strong> ' . $email . '</p>
                                <p class="mb-1"><strong>Phone:</strong> ' . $phone . '</p>
                                <p class="mb-1"><strong>Address:</strong> ' . $address . '</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Device Details:</h6>
                                <p class="mb-1"><strong>Device:</strong> ' . $device . '</p>
                                <p class="mb-1"><strong>Issue:</strong> ' . $issue . '</p>
                                <p class="mb-1"><strong>Urgency:</strong> ' . $urgency . '</p>
                                <p class="mb-1"><strong>Repair Cost:</strong> <span id="cost' . $bookingId . '">RM ' . $cost . '</span></p>
                            </div>
                        </div>
                        <hr>
                        <form class="booking-update-form" data-booking-id="' . $bookingId . '">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <label for="status' . $bookingId . '" class="form-label">Update Status:</label>
                                    <select class="form-select form-select-sm status-select" id="status' . $bookingId . '" name="status"
                                        style="width: auto; display: inline-block;" data-booking-id="' . $bookingId . '">
                                        <option value="Pending"' . ($status == 'Pending' ? ' selected' : '') . '>Pending</option>
                                        <option value="In Progress"' . ($status == 'In Progress' ? ' selected' : '') . '>In Progress</option>
                                        <option value="Completed"' . ($status == 'Completed' ? ' selected' : '') . '>Completed</option>
                                        <option value="Cancelled"' . ($status == 'Cancelled' ? ' selected' : '') . '>Cancelled</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-sm btn-success me-2">Update</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary">View Invoice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
            $i++;
        }
        ?>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
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
            const bookingElement = document.querySelector(`[data-booking-id="${bookingId}"]`).closest('.accordion-item');
            const badge = bookingElement.querySelector('.badge');
            badge.className = 'badge';

            switch(status) {
                case 'Pending': badge.classList.add('bg-info'); break;
                case 'In Progress': badge.classList.add('bg-warning'); break;
                case 'Completed': badge.classList.add('bg-success'); break;
                case 'Cancelled': badge.classList.add('bg-danger'); break;
            }
            badge.textContent = status;

            if (cost !== null) {
                const costElement = document.getElementById(`cost${bookingId}`);
                if (costElement) {
                    costElement.textContent = `RM ${parseFloat(cost).toFixed(2)}`;
                }
            }

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

<?php include('layout/footer.php'); ?>
