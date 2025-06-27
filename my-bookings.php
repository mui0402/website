<?php include ('layout/user-header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Repairs</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="user-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">My Repairs</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-mobile-alt me-1"></i>
                                My Device Repairs
                            </div>
                            <div class="card-body">
                                <!-- Booking 1 -->
                                <div class="accordion" id="bookingAccordion">
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="booking1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                <div class="d-flex justify-content-between w-100 me-3">
                                                    <div>
                                                        <strong>iPhone 13 - Screen Replacement</strong>
                                                        <small class="text-muted d-block">Booking ID: #APR001</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-warning">In Progress</span>
                                                        <small class="text-muted d-block">Jan 15, 2024</small>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="booking1" data-bs-parent="#bookingAccordion">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Device Information</h6>
                                                        <p><strong>Device:</strong> iPhone 13<br>
                                                        <strong>Model:</strong> A2482<br>
                                                        <strong>Issue:</strong> Cracked screen, touch not responsive<br>
                                                        <strong>Urgency:</strong> Normal</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Repair Progress</h6>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                                        </div>
                                                        <p><strong>Status:</strong> Screen replacement in progress<br>
                                                        <strong>Estimated Completion:</strong> Tomorrow<br>
                                                        <strong>Cost:</strong> RM 280</p>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-primary btn-sm me-2">Contact Technician</button>
                                                    <button class="btn btn-outline-info btn-sm">View Receipt</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking 2 -->
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="booking2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                <div class="d-flex justify-content-between w-100 me-3">
                                                    <div>
                                                        <strong>Samsung Galaxy S21 - Battery Replacement</strong>
                                                        <small class="text-muted d-block">Booking ID: #APR002</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-success">Completed</span>
                                                        <small class="text-muted d-block">Jan 10, 2024</small>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="booking2" data-bs-parent="#bookingAccordion">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Device Information</h6>
                                                        <p><strong>Device:</strong> Samsung Galaxy S21<br>
                                                        <strong>Model:</strong> SM-G991B<br>
                                                        <strong>Issue:</strong> Battery draining quickly, overheating<br>
                                                        <strong>Urgency:</strong> High</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Repair Details</h6>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                                        </div>
                                                        <p><strong>Status:</strong> Repair completed successfully<br>
                                                        <strong>Completed:</strong> Jan 12, 2024<br>
                                                        <strong>Cost:</strong> RM 150</p>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-success btn-sm me-2">Download Receipt</button>
                                                    <button class="btn btn-outline-primary btn-sm">Leave Review</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking 3 -->
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="booking3">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                                <div class="d-flex justify-content-between w-100 me-3">
                                                    <div>
                                                        <strong>iPad Air - Water Damage Assessment</strong>
                                                        <small class="text-muted d-block">Booking ID: #APR003</small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-info">Assessment</span>
                                                        <small class="text-muted d-block">Jan 12, 2024</small>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="booking3" data-bs-parent="#bookingAccordion">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Device Information</h6>
                                                        <p><strong>Device:</strong> iPad Air<br>
                                                        <strong>Model:</strong> A2316<br>
                                                        <strong>Issue:</strong> Water damage, won't turn on<br>
                                                        <strong>Urgency:</strong> Normal</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Assessment Status</h6>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                        </div>
                                                        <p><strong>Status:</strong> Initial assessment in progress<br>
                                                        <strong>Assessment Fee:</strong> RM 50<br>
                                                        <strong>Payment Status:</strong> <span class="text-warning">Pending</span></p>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-warning btn-sm me-2">Pay Assessment Fee</button>
                                                    <button class="btn btn-outline-info btn-sm">Contact Support</button>
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
