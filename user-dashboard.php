<?php include ('layout/user-header.php'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">My Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Welcome to APAI Repair System</li>
            </ol>
            
            <!-- Quick Actions for Customers -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-bolt me-1"></i>
                            Quick Actions
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="booking.php" class="btn btn-primary w-100 py-3">
                                        <i class="fas fa-plus-circle me-2"></i>Book New Repair
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="my-bookings.php" class="btn btn-info w-100 py-3">
                                        <i class="fas fa-list me-2"></i>Track My Repairs
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="payment.php" class="btn btn-success w-100 py-3">
                                        <i class="fas fa-credit-card me-2"></i>Make Payment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Recent Repairs -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-history me-1"></i>
                            My Recent Repairs
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Device</th>
                                            <th>Issue</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>iPhone 13</td>
                                            <td>Screen Replacement</td>
                                            <td><span class="badge bg-warning">In Progress</span></td>
                                            <td>2024-01-15</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Samsung Galaxy S21</td>
                                            <td>Battery Replacement</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                            <td>2024-01-10</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-success">Receipt</a></td>
                                        </tr>
                                        <tr>
                                            <td>iPad Air</td>
                                            <td>Water Damage</td>
                                            <td><span class="badge bg-info">Assessment</span></td>
                                            <td>2024-01-12</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-info">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-bell me-1"></i>
                            Notifications
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <strong>iPhone 13 Update:</strong> Your device repair is 80% complete. Expected completion: Tomorrow
                            </div>
                            <div class="alert alert-warning" role="alert">
                                <strong>Payment Due:</strong> iPad Air assessment fee of RM 50 is pending
                            </div>
                            <div class="alert alert-success" role="alert">
                                <strong>Repair Complete:</strong> Your Samsung Galaxy S21 is ready for pickup!
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-phone me-1"></i>
                            Contact Support
                        </div>
                        <div class="card-body text-center">
                            <p class="mb-3">Need help with your repair?</p>
                            <div class="d-grid gap-2">
                                <a href="tel:+60123456789" class="btn btn-outline-primary">
                                    <i class="fas fa-phone me-2"></i>Call Us
                                </a>
                                <a href="mailto:support@apai.com" class="btn btn-outline-secondary">
                                    <i class="fas fa-envelope me-2"></i>Email Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include ('layout/footer.php'); ?>
