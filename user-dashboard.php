<?php 
// Include user header
include ('layout/user-header.php'); 
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <h1 class="mt-4">My Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Welcome to APAI Repair System</li>
            </ol>
            
            <!-- Summary Cards Section -->
            <div class="row">
                <!-- Active Repairs -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4" style="height: 120px;">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div class="h4 mb-0">
                                    <?php 
                                    // echo getActiveRepairsCount($user_id); 
                                    ?>
                                </div>
                                <div>Active Repairs</div>
                            </div>
                            <i class="fas fa-mobile-alt fa-2x ms-auto"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Payment -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4" style="height: 120px;">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div class="h4 mb-0">
                                    <?php 
                                    // echo getPendingPaymentCount($user_id); 
                                    ?>
                                </div>
                                <div>Pending Payment</div>
                            </div>
                            <i class="fas fa-credit-card fa-2x ms-auto"></i>
                        </div>
                    </div>
                </div>

                <!-- Completed Repairs -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4" style="height: 120px;">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div class="h4 mb-0">
                                    <?php 
                                    // echo getCompletedRepairsCount($user_id); 
                                    ?>
                                </div>
                                <div>Completed Repairs</div>
                            </div>
                            <i class="fas fa-check-circle fa-2x ms-auto"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Spent -->
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4" style="height: 120px;">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div class="h4 mb-0">
                                    <?php 
                                    // echo "RM " . getTotalSpent($user_id); 
                                    ?>
                                </div>
                                <div>Total Spent</div>
                            </div>
                            <i class="fas fa-chart-line fa-2x ms-auto"></i>
                        </div>
                    </div>
                </div>
            </div>

            </div>

        </div>
    </main>
</div>

<?php include ('layout/footer.php'); ?>
