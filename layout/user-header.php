<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Customer Dashboard - APAI Repair System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand dengan Image sebagai Button -->
            <a class="navbar-brand ps-3" href="user-dashboard.php">
                <i class="fas fa-mobile-alt me-2"></i>
                <img src="assets/img/apai.png" class="navbar-logo" style="height: 40px;">
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar -->
             <!-- Menu Kanan -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="about-us.php" class="nav-link">
                        <i class="fas fa-info-circle me-1"></i> About Us
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Customer Portal</div>
                            
                            <a class="nav-link" href="booking.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                                Book Repair
                            </a>
                            <a class="nav-link" href="my-bookings.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                My Repairs
                            </a>
                            <a class="nav-link" href="payment.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                                Payments
                            </a>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Customer
                    </div>
                </nav>
            </div>
