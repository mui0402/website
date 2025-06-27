<?php include ('layout/user-header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Payment</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
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
                                                <div class="form-check border rounded p-3 mb-3">
                                                    <input class="form-check-input" type="checkbox" value="APR001" id="booking1" checked>
                                                    <label class="form-check-label w-100" for="booking1">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <strong>iPhone 13 Screen Replacement</strong>
                                                                <br><small class="text-muted">Booking ID: #APR001</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <strong>RM 450.00</strong>
                                                                <br><span class="badge bg-warning">Pending Payment</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check border rounded p-3 mb-3">
                                                    <input class="form-check-input" type="checkbox" value="APR002" id="booking2">
                                                    <label class="form-check-label w-100" for="booking2">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <strong>Samsung Galaxy Battery Replacement</strong>
                                                                <br><small class="text-muted">Booking ID: #APR002</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <strong>RM 280.00</strong>
                                                                <br><span class="badge bg-warning">Pending Payment</span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

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
                                                    <span id="subtotal">RM 450.00</span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Service Tax (6%):</span>
                                                    <span id="tax">RM 27.00</span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <strong>Total Amount:</strong>
                                                    <strong id="totalAmount">RM 477.00</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                            <a href="customer-bookings.php" class="btn btn-secondary me-md-2">Back to Bookings</a>
                                            <button type="button" class="btn btn-success" onclick="processPayment()">
                                                <i class="fas fa-lock me-2"></i>Pay Now
                                            </button>
                                        </div>
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
                                        <div class="col-6">TXN123456789</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6"><strong>Date & Time:</strong></div>
                                        <div class="col-6">Jan 17, 2025 - 2:30 PM</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6"><strong>Amount Paid:</strong></div>
                                        <div class="col-6">RM 477.00</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6"><strong>Payment Method:</strong></div>
                                        <div class="col-6">Online Banking</div>
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
                        } else {
                            cardDetails.classList.add('d-none');
                        }
                    });
                });

                // Update total when bookings are selected/deselected
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.addEventListener('change', updateTotal);
                });

                function updateTotal() {
                    let subtotal = 0;
                    document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                        if (checkbox.value === 'APR001') subtotal += 450;
                        if (checkbox.value === 'APR002') subtotal += 280;
                    });
                    
                    const tax = subtotal * 0.06;
                    const total = subtotal + tax;
                    
                    document.getElementById('subtotal').textContent = `RM ${subtotal.toFixed(2)}`;
                    document.getElementById('tax').textContent = `RM ${tax.toFixed(2)}`;
                    document.getElementById('totalAmount').textContent = `RM ${total.toFixed(2)}`;
                }

                function processPayment() {
                    // Simulate payment processing
                    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
                    modal.show();
                }

                function downloadPDF() {
                    alert('PDF receipt downloaded successfully!');
                }
            </script>

<?php include ('layout/footer.php'); ?>
