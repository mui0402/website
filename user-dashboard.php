<?php 
// Include user header with sidebar and navbar
include ('layout/user-header.php'); 
?>

<div id="layoutSidenav_content">
    <main>
        <!-- Hero Section (from index) -->
        <section class="hero-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 80vh; display: flex; align-items: center; color: white;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Professional Mobile Device Repair Services</h1>
                        <p class="lead mb-4">Fast, reliable, and affordable repair solutions for all your mobile devices. Track your repair status in real-time and enjoy seamless service experience.</p>
                        <div class="d-flex gap-3">
                            <a href="booking.php" class="btn btn-light btn-lg">Book Repair Service</a>
                            <a href="my-bookings.php" class="btn btn-outline-light btn-lg">Track My Device</a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <i class="fas fa-mobile-alt" style="font-size: 15rem; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section (from index) -->
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

        <!-- Services Section (from index) -->
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
    </main>
</div>

<?php include ('layout/footer.php'); ?>
