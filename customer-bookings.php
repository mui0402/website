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
                                                                <p class="mb-1"><strong>Estimated Cost:</strong> RM 450</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <label for="status1" class="form-label">Update Status:</label>
                                                                <select class="form-select form-select-sm" id="status1" style="width: auto; display: inline-block;">
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="In Progress" selected>In Progress</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <button class="btn btn-sm btn-success me-2">Update Status</button>
                                                                <button class="btn btn-sm btn-info">Send Notification</button>
                                                            </div>
                                                        </div>
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
                                                                <p class="mb-1"><strong>Estimated Cost:</strong> RM 280</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <label for="status2" class="form-label">Update Status:</label>
                                                                <select class="form-select form-select-sm" id="status2" style="width: auto; display: inline-block;">
                                                                    <option value="Pending" selected>Pending</option>
                                                                    <option value="In Progress">In Progress</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <button class="btn btn-sm btn-success me-2">Update Status</button>
                                                                <button class="btn btn-sm btn-info">Send Notification</button>
                                                            </div>
                                                        </div>
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
                                                                <p class="mb-1"><strong>Final Cost:</strong> RM 650</p>
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
<?php include ('layout/footer.php'); ?>
