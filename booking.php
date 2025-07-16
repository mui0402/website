<?php 
// Include user header
include ('layout/user-header.php'); 
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Repair Booking</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="user-dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Repair Booking</li>
            </ol>
        <div class="container-fluid px-4">
            <!-- Main Booking Form Section -->
            <div class="row justify-content-center mt-2 mb-4" style="margin-top: -30px;">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-mobile-alt me-2"></i>
                            Device Repair Booking Form
                        </div>
                        <div class="card-body p-5">
                            <!-- Booking Form -->
                            <form id="repairBookingForm" action="booking-submit.php" method="POST">
                                <!-- Personal Information Section -->
                                <div class="mb-4">
                                    <h5 class="text-primary mb-3"><i class="fas fa-user-circle me-2"></i>Personal Information</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="012-3456789" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Your complete address" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Device Information Section -->
                                <div class="mb-4">
                                    <h5 class="text-primary mb-3"><i class="fas fa-laptop me-2"></i>Device Information</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="device_type" class="form-label">Device Type</label>
                                            <select class="form-select" id="device_type" name="device_type" required>
                                                <option value="" selected disabled>Select device type</option>
                                                <option value="Mobile">Android</option>
                                                <option value="Tablet">Tablet</option>
                                                <option value="Laptop">Iphone</option>
                                                <option value="Desktop">Ipad</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="device_brand" class="form-label">Device Brand</label>
                                            <select class="form-select" id="device_brand" name="device_brand" required>
                                                <option value="" selected disabled>Select brand</option>
                                                <option value="Apple">Apple</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="Huawei">Huawei</option>
                                                <option value="Xiaomi">Xiaomi</option>
                                                <option value="Other">Other Brand</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="device_model" class="form-label">Device Model</label>
                                            <input type="text" class="form-control" id="device_model" name="device_model" placeholder="e.g. iPhone 13, Galaxy S21" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="device_intake" class="form-label">Preferred Intake Date</label>
                                            <input type="date" class="form-control" id="device_intake" name="device_intake" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Repair Details Section -->
                                <div class="mb-4">
                                    <h5 class="text-primary mb-3"><i class="fas fa-tools me-2"></i>Repair Details</h5>
                                    <div class="mb-3">
                                        <label for="device_issue" class="form-label">Describe the Issue</label>
                                        <textarea class="form-control" id="device_issue" name="device_issue" rows="3" placeholder="Please describe the problem in detail..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Additional Services</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="data_backup" name="data_backup" value="1">
                                            <label class="form-check-label" for="data_backup">Port Cleaning Service-Full Cleaning (RM20)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="screen_protector" name="screen_protector" value="1">
                                            <label class="form-check-label" for="screen_protector">Screen Protector Installation (RM20)</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Submission -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <button type="reset" class="btn btn-outline-secondary me-md-2">
                                        <i class="fas fa-undo me-2"></i>Reset Form
                                    </button>
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

<?php 
// Include footer
include ('layout/footer.php'); 
?>