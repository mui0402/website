<?php include ('layout/admin-header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Financial Tracking</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Financial Tracking</li>
                        </ol>
                        
                        <!-- Filter Controls -->
                        <div class="row mb-4">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-end">
                                            <div class="col-md-3">
                                                <label for="monthFilter" class="form-label">Select Month</label>
                                                <select class="form-select" id="monthFilter">
                                                    <option value="2025-01" selected>January 2025</option>
                                                    <option value="2024-12">December 2024</option>
                                                    <option value="2024-11">November 2024</option>
                                                    <option value="2024-10">October 2024</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="viewFilter" class="form-label">View Type</label>
                                                <select class="form-select" id="viewFilter">
                                                    <option value="daily" selected>Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-primary" onclick="updateReport()">
                                                    <i class="fas fa-sync me-1"></i>Update Report
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-success" onclick="exportReport()">
                                                    <i class="fas fa-download me-1"></i>Export PDF
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="card-title">Net Profit (January)</h6>
                                                <h3 class="mb-0">RM 8,750.00</h3>
                                            </div>
                                            <i class="fas fa-chart-line fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Cards -->
                        <div class="row mb-4">
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Total Income</h6>
                                                <h4 class="mb-0">RM 12,450.00</h4>
                                                <small>+15% from last month</small>
                                            </div>
                                            <i class="fas fa-arrow-up fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Total Expenses</h6>
                                                <h4 class="mb-0">RM 3,700.00</h4>
                                                <small>+8% from last month</small>
                                            </div>
                                            <i class="fas fa-arrow-down fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6>Total Balance</h6>
                                                <h4 class="mb-0">RM 8,750.00</h4>
                                                <small>Net profit this month</small>
                                            </div>
                                            <i class="fas fa-balance-scale fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Financial History Table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-history me-1"></i>
                                        Financial History - January 2025
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Description</th>
                                                        <th>Type</th>
                                                        <th>Money In (RM)</th>
                                                        <th>Money Out (RM)</th>
                                                        <th>Balance (RM)</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Jan 17, 2025</td>
                                                        <td>iPhone 13 Screen Replacement - John Doe</td>
                                                        <td><span class="badge bg-success">Income</span></td>
                                                        <td class="text-success fw-bold">+477.00</td>
                                                        <td>-</td>
                                                        <td>8,750.00</td>
                                                        <td><span class="badge bg-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 17, 2025</td>
                                                        <td>iPhone 13 Screen Purchase - Parts Supplier</td>
                                                        <td><span class="badge bg-danger">Expense</span></td>
                                                        <td>-</td>
                                                        <td class="text-danger fw-bold">-450.00</td>
                                                        <td>8,273.00</td>
                                                        <td><span class="badge bg-info">Paid</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 16, 2025</td>
                                                        <td>Samsung Galaxy Battery Replacement - Jane Smith</td>
                                                        <td><span class="badge bg-success">Income</span></td>
                                                        <td class="text-success fw-bold">+296.80</td>
                                                        <td>-</td>
                                                        <td>8,723.00</td>
                                                        <td><span class="badge bg-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 16, 2025</td>
                                                        <td>Samsung Battery Purchase - Parts Supplier</td>
                                                        <td><span class="badge bg-danger">Expense</span></td>
                                                        <td>-</td>
                                                        <td class="text-danger fw-bold">-150.00</td>
                                                        <td>8,426.20</td>
                                                        <td><span class="badge bg-info">Paid</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 15, 2025</td>
                                                        <td>iPad Water Damage Repair - Mike Johnson</td>
                                                        <td><span class="badge bg-success">Income</span></td>
                                                        <td class="text-success fw-bold">+689.00</td>
                                                        <td>-</td>
                                                        <td>8,576.20</td>
                                                        <td><span class="badge bg-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 15, 2025</td>
                                                        <td>Monthly Rent Payment</td>
                                                        <td><span class="badge bg-danger">Expense</span></td>
                                                        <td>-</td>
                                                        <td class="text-danger fw-bold">-2,500.00</td>
                                                        <td>7,887.20</td>
                                                        <td><span class="badge bg-info">Paid</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 14, 2025</td>
                                                        <td>Huawei Screen Replacement - Sarah Lee</td>
                                                        <td><span class="badge bg-success">Income</span></td>
                                                        <td class="text-success fw-bold">+318.00</td>
                                                        <td>-</td>
                                                        <td>10,387.20</td>
                                                        <td><span class="badge bg-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 13, 2025</td>
                                                        <td>Utility Bills Payment</td>
                                                        <td><span class="badge bg-danger">Expense</span></td>
                                                        <td>-</td>
                                                        <td class="text-danger fw-bold">-350.00</td>
                                                        <td>10,069.20</td>
                                                        <td><span class="badge bg-info">Paid</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 12, 2025</td>
                                                        <td>iPhone 12 Battery Replacement - David Wong</td>
                                                        <td><span class="badge bg-success">Income</span></td>
                                                        <td class="text-success fw-bold">+212.00</td>
                                                        <td>-</td>
                                                        <td>10,419.20</td>
                                                        <td><span class="badge bg-success">Completed</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jan 11, 2025</td>
                                                        <td>Bulk Parts Purchase - Various Components</td>
                                                        <td><span class="badge bg-danger">Expense</span></td>
                                                        <td>-</td>
                                                        <td class="text-danger fw-bold">-1,200.00</td>
                                                        <td>10,207.20</td>
                                                        <td><span class="badge bg-info">Paid</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Pagination -->
                                        <nav aria-label="Financial history pagination">
                                            <ul class="pagination justify-content-center mt-3">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a class="page-link" href="#">1</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <script>
                function updateReport() {
                    const month = document.getElementById('monthFilter').value;
                    const view = document.getElementById('viewFilter').value;
                    
                    // Simulate loading
                    const btn = event.target;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';
                    btn.disabled = true;
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        alert(`Report updated for ${month} (${view} view)`);
                    }, 1500);
                }

                function exportReport() {
                    const month = document.getElementById('monthFilter').value;
                    alert(`Financial report for ${month} exported successfully!`);
                }

                // Auto-update balance calculations
                function calculateRunningBalance() {
                    const rows = document.querySelectorAll('tbody tr');
                    let balance = 8750.00; // Starting balance
                    
                    rows.forEach((row, index) => {
                        const balanceCell = row.cells[5];
                        balanceCell.textContent = balance.toFixed(2);
                        
                        // This is just for display purposes
                        // In a real application, this would be calculated from the database
                    });
                }

                // Initialize on page load
                document.addEventListener('DOMContentLoaded', function() {
                    // Add any initialization code here
                });
            </script>

<?php include ('layout/footer.php'); ?>
