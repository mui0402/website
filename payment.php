<?php 
session_start();
include ('layout/user-header.php');
include ('dbconnection.php');

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Get user email from session
$user_email = $_SESSION['user_email'];

// Fetch completed but unpaid bookings for this customer using email
$sql = "SELECT * FROM booking WHERE email = ? AND status = 'Completed' AND repair_cost > 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Payment</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="user-dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Payment</li>
            </ol>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-credit-card me-1"></i>
                            Payment Processing
                        </div>
                        <div class="card-body">
                            <!-- Booking Selection -->
                            <h5 class="mb-3 text-primary">Select Booking to Pay</h5>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <?php if(empty($bookings)): ?>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            You don't have any completed repairs ready for payment.
                                            <br><small class="text-muted">Completed repairs with determined costs will appear here.</small>
                                        </div>
                                        <div class="text-center mt-4">
                                            <a href="my-bookings.php" class="btn btn-primary">
                                                <i class="fas fa-list me-2"></i>View My Bookings
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Booking ID</th>
                                                        <th>Device</th>
                                                        <th>Issue</th>
                                                        <th>Services</th>
                                                        <th>Repair Cost</th>
                                                        <th>Additional Services</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($bookings as $booking): 
                                                        $services = [];
                                                        $additional_cost = 0;
                                                        
                                                        if($booking['service_cleaning']) {
                                                            $services[] = "Port Cleaning";
                                                            $additional_cost += 20;
                                                        }
                                                        if($booking['service_screen_protector']) {
                                                            $services[] = "Screen Protector";
                                                            $additional_cost += 20;
                                                        }
                                                        
                                                        $repair_cost = floatval($booking['repair_cost']);
                                                        $total_amount = $repair_cost + $additional_cost;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" class="form-check-input booking-checkbox" 
                                                                   value="<?php echo $booking['booking_id']; ?>" 
                                                                   data-amount="<?php echo $total_amount; ?>">
                                                        </td>
                                                        <td>BK<?php echo str_pad($booking['booking_id'], 4, '0', STR_PAD_LEFT); ?></td>
                                                        <td>
                                                            <?php echo htmlspecialchars($booking['device_brand']) . ' ' . 
                                                                  htmlspecialchars($booking['device_model']); ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($booking['issue_description']); ?></td>
                                                        <td><?php echo empty($services) ? 'None' : implode(', ', $services); ?></td>
                                                        <td>RM <?php echo number_format($repair_cost, 2); ?></td>
                                                        <td>RM <?php echo number_format($additional_cost, 2); ?></td>
                                                        <td><strong>RM <?php echo number_format($total_amount, 2); ?></strong></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if(!empty($bookings)): ?>
                            <hr>

                            <!-- Payment Method -->
                            <h5 class="mb-3 text-primary">Payment Method</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-check border rounded p-3 mb-3">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="onlineBanking" value="online_banking" checked>
                                        <label class="form-check-label w-100" for="onlineBanking">
                                            <i class="fas fa-university text-primary me-2"></i>
                                            <strong>Online Banking</strong>
                                            <br><small class="text-muted">Secure bank transfer</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check border rounded p-3 mb-3">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="credit_card">
                                        <label class="form-check-label w-100" for="creditCard">
                                            <i class="fas fa-credit-card text-success me-2"></i>
                                            <strong>Credit/Debit Card</strong>
                                            <br><small class="text-muted">Visa, Mastercard accepted</small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Details (Hidden by default) -->
                            <div id="cardDetails" class="d-none">
                                <h6 class="mb-3">Card Details</h6>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cardNumber" placeholder="Card Number">
                                            <label for="cardNumber">Card Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cvv" placeholder="CVV">
                                            <label for="cvv">CVV</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                            <label for="expiryDate">Expiry Date (MM/YY)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cardName" placeholder="Cardholder Name">
                                            <label for="cardName">Cardholder Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="billingAddress" placeholder="Billing Address" style="height: 80px"></textarea>
                                        <label for="billingAddress">Billing Address</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Summary -->
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Payment Summary</h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span id="subtotal">RM 0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Service Tax (6%):</span>
                                        <span id="tax">RM 0.00</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong>Total Amount:</strong>
                                        <strong id="totalAmount">RM 0.00</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="my-bookings.php" class="btn btn-secondary me-md-2">Back to Bookings</a>
                                <button type="button" class="btn btn-success" id="payNowBtn" disabled onclick="processPayment()">
                                    <i class="fas fa-lock me-2"></i>Pay Now
                                </button>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Payment Success Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle me-2"></i>Payment Successful
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Payment Completed!</h4>
                    <p class="text-muted">Your payment has been processed successfully.</p>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <strong>Payment Receipt</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6"><strong>Transaction ID:</strong></div>
                            <div class="col-6">TXN<?php echo strtoupper(uniqid()); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><strong>Date & Time:</strong></div>
                            <div class="col-6"><?php echo date('M j, Y - g:i A'); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><strong>Amount Paid:</strong></div>
                            <div class="col-6" id="receiptAmount">RM 0.00</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><strong>Payment Method:</strong></div>
                            <div class="col-6" id="receiptMethod">Online Banking</div>
                        </div>
                        <div class="row">
                            <div class="col-6"><strong>Status:</strong></div>
                            <div class="col-6"><span class="badge bg-success">Paid</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="downloadPDF()">
                    <i class="fas fa-download me-2"></i>Download PDF
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Show/hide card details based on payment method
    document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const cardDetails = document.getElementById('cardDetails');
            if (this.value === 'credit_card') {
                cardDetails.classList.remove('d-none');
                document.getElementById('receiptMethod').textContent = 'Credit Card';
            } else {
                cardDetails.classList.add('d-none');
                document.getElementById('receiptMethod').textContent = 'Online Banking';
            }
        });
    });

    // Update total when bookings are selected/deselected
    document.querySelectorAll('.booking-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateTotal);
    });

    function updateTotal() {
        let subtotal = 0;
        const selectedBookings = [];
        
        document.querySelectorAll('.booking-checkbox:checked').forEach(checkbox => {
            subtotal += parseFloat(checkbox.dataset.amount);
            selectedBookings.push(checkbox.value);
        });
        
        const tax = subtotal * 0.06;
        const total = subtotal + tax;
        
        document.getElementById('subtotal').textContent = `RM ${subtotal.toFixed(2)}`;
        document.getElementById('tax').textContent = `RM ${tax.toFixed(2)}`;
        document.getElementById('totalAmount').textContent = `RM ${total.toFixed(2)}`;
        document.getElementById('receiptAmount').textContent = `RM ${total.toFixed(2)}`;
        
        // Enable/disable Pay Now button
        document.getElementById('payNowBtn').disabled = selectedBookings.length === 0;
    }

    function processPayment() {
        // Get selected booking IDs
        const selectedBookings = [];
        document.querySelectorAll('.booking-checkbox:checked').forEach(checkbox => {
            selectedBookings.push(checkbox.value);
        });
        
        // Get payment method
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
        
        // Send AJAX request to update booking status
        fetch('process-payment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                bookings: selectedBookings,
                payment_method: paymentMethod
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success modal
                const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
                modal.show();
                
                // Refresh page after modal is closed
                document.getElementById('paymentModal').addEventListener('hidden.bs.modal', function () {
                    location.reload();
                });
            } else {
                alert('Payment failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Payment processing failed. Please try again.');
        });
    }

    function downloadPDF() {
        alert('PDF receipt downloaded successfully!');
    }
</script>

<?php include ('layout/footer.php'); ?>
