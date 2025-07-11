<?php include ('layout/admin-header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Staff Dashboard - APAI Repair System Overview</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="height: 120px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="h4 mb-0">24</div>
                                            <div>Active Repairs</div>
                                        </div>
                                        <i class="fas fa-tools fa-2x ms-auto"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4" style="height: 120px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="h4 mb-0">8</div>
                                            <div>Pending Bookings</div>
                                        </div>
                                        <i class="fas fa-clock fa-2x ms-auto"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4" style="height: 120px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="h4 mb-0">156</div>
                                            <div>Completed Repairs</div>
                                        </div>
                                        <i class="fas fa-check-circle fa-2x ms-auto"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4" style="height: 120px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div>
                                            <div class="h4 mb-0">RM 12,450</div>
                                            <div>Monthly Revenue</div>
                                        </div>
                                        <i class="fas fa-chart-line fa-2x ms-auto"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-history me-1"></i>
                                        Recent Repair Activities
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline">
                                            <div class="timeline-item mb-3">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <span class="badge bg-success rounded-pill">Completed</span>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">iPhone 13 Screen Replacement</h6>
                                                        <p class="text-muted mb-1">Customer: John Doe</p>
                                                        <small class="text-muted">2 hours ago</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item mb-3">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <span class="badge bg-warning rounded-pill">In Progress</span>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">Samsung Galaxy Battery Replacement</h6>
                                                        <p class="text-muted mb-1">Customer: Jane Smith</p>
                                                        <small class="text-muted">4 hours ago</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item mb-3">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <span class="badge bg-info rounded-pill">New</span>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1">iPad Water Damage Assessment</h6>
                                                        <p class="text-muted mb-1">Customer: Mike Johnson</p>
                                                        <small class="text-muted">6 hours ago</small>
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
