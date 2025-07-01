<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="APAI - Mobile Device Repair System" />
    <meta name="author" content="" />
    <title>APAI - Mobile Device Repair System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .feature-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-mobile-alt me-2"></i>APAI Repair System
            </a>
            <div class="ms-auto">
                <a href="login.html" class="btn btn-outline-primary me-2">Login</a>
                <a href="register.html" class="btn btn-primary">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Professional Mobile Device Repair Services</h1>
                    <p class="lead mb-4">Fast, reliable, and affordable repair solutions for all your mobile devices. Track your repair status in real-time and enjoy seamless service experience.</p>
                    <div class="d-flex gap-3">
                        <a href="register.html" class="btn btn-light btn-lg">Book Repair Service</a>
                        <a href="login.html" class="btn btn-outline-light btn-lg">Track My Device</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-mobile-alt" style="font-size: 15rem; opacity: 0.8;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold">Why Choose APAI?</h2>
                    <p class="lead text-muted">We provide comprehensive repair solutions with transparency and convenience</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-clock text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Real-time Tracking</h5>
                            <p class="card-text">Monitor your device repair status in real-time from booking to completion.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-shield-alt text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Secure Payments</h5>
                            <p class="card-text">Safe and secure online payment processing with multiple payment options.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="card-body">
                            <i class="fas fa-tools text-warning mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Expert Technicians</h5>
                            <p class="card-text">Certified professionals with years of experience in mobile device repairs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold">Our Services</h2>
                    <p class="lead text-muted">We repair all types of mobile devices with quality parts and warranty</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <i class="fas fa-mobile-alt text-primary mb-3" style="font-size: 2.5rem;"></i>
                    <h5>Screen Replacement</h5>
                    <p class="text-muted">Cracked or damaged screens replaced with original quality parts</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-battery-half text-success mb-3" style="font-size: 2.5rem;"></i>
                    <h5>Battery Replacement</h5>
                    <p class="text-muted">Restore your device's battery life with genuine replacement batteries</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-volume-up text-info mb-3" style="font-size: 2.5rem;"></i>
                    <h5>Audio Issues</h5>
                    <p class="text-muted">Speaker, microphone, and headphone jack repair services</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-water text-primary mb-3" style="font-size: 2.5rem;"></i>
                    <h5>Water Damage</h5>
                    <p class="text-muted">Professional water damage assessment and repair services</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-mobile-alt me-2"></i>APAI Repair System</h5>
                    <p class="text-muted">Professional mobile device repair services with real-time tracking and secure payments.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; 2025 APAI Repair System. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
