<?php include ('layout/header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Book Repair Service</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Book Service</li>
                        </ol>
                        
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-mobile-alt me-1"></i>
                                        Device Repair Booking Form
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="booking-confirmation.php">
                                            <!-- Customer Information -->
                                            <h5 class="mb-3 text-primary">Customer Information</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="customerName" name="customer_name" placeholder="Full Name" required>
                                                        <label for="customerName">Full Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="email" class="form-control" id="customerEmail" name="customer_email" placeholder="Email Address" required>
                                                        <label for="customerEmail">Email Address</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="tel" class="form-control" id="customerPhone" name="customer_phone" placeholder="Phone Number" required>
                                                        <label for="customerPhone">Phone Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="customerAddress" name="customer_address" placeholder="Address" required>
                                                        <label for="customerAddress">Address</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Device Information -->
                                            <h5 class="mb-3 text-primary">Device Information</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="deviceType" name="device_type" required>
                                                            <option value="">Select Device Type</option>
                                                            <option value="iPhone">iPhone</option>
                                                            <option value="Samsung">Samsung</option>
                                                            <option value="Huawei">Huawei</option>
                                                            <option value="Xiaomi">Xiaomi</option>
                                                            <option value="iPad">iPad</option>
                                                            <option value="Tablet">Android Tablet</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <label for="deviceType">Device Type</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="deviceModel" name="device_model" placeholder="Device Model" required>
                                                        <label for="deviceModel">Device Model (e.g., iPhone 13, Galaxy S21)</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="issueDescription" class="form-label">Issue Description</label>
                                                <textarea class="form-control" id="issueDescription" name="issue_description" rows="4" placeholder="Please describe the problem with your device in detail..." required></textarea>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="issueType" name="issue_type" required>
                                                            <option value="">Select Issue Type</option>
                                                            <option value="Screen Damage">Screen Damage</option>
                                                            <option value="Battery Issues">Battery Issues</option>
                                                            <option value="Water Damage">Water Damage</option>
                                                            <option value="Charging Problems">Charging Problems</option>
                                                            <option value="Audio Issues">Audio Issues</option>
                                                            <option value="Camera Problems">Camera Problems</option>
                                                            <option value="Software Issues">Software Issues</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <label for="issueType">Issue Type</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="urgency" name="urgency" required>
                                                            <option value="">Select Urgency</option>
                                                            <option value="Low">Low - Within a week</option>
                                                            <option value="Medium">Medium - Within 3 days</option>
                                                            <option value="High">High - Within 24 hours</option>
                                                            <option value="Emergency">Emergency - Same day</option>
                                                        </select>
                                                        <label for="urgency">Urgency Level</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="preferredDate" name="preferred_date" required>
                                                        <label for="preferredDate">Preferred Intake Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="preferredTime" name="preferred_time" required>
                                                            <option value="">Select Time Slot</option>
                                                            <option value="09:00-11:00">9:00 AM - 11:00 AM</option>
                                                            <option value="11:00-13:00">11:00 AM - 1:00 PM</option>
                                                            <option value="13:00-15:00">1:00 PM - 3:00 PM</option>
                                                            <option value="15:00-17:00">3:00 PM - 5:00 PM</option>
                                                            <option value="17:00-19:00">5:00 PM - 7:00 PM</option>
                                                        </select>
                                                        <label for="preferredTime">Preferred Time</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check mb-4">
                                                <input class="form-check-input" type="checkbox" id="termsAgreement" required>
                                                <label class="form-check-label" for="termsAgreement">
                                                    I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a> and understand that a diagnostic fee may apply.
                                                </label>
                                            </div>

                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <a href="dashboard.php" class="btn btn-secondary me-md-2">Cancel</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane me-2"></i>Submit Booking
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php include ('layout/footer.php'); ?>
