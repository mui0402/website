<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>APAI - Mobile Repair</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 4.6 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Inline CSS -->
  <style>
    .hero {
      height: 100vh;
      background: url('img/back.jpg') no-repeat center center/cover;
      position: relative;
    }
    .hero::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.6); /* overlay gelap */
    }
    .hero .container {
      position: relative;
      z-index: 1;
    }
    .hero h1, .hero p {
      color: #fff;
    }
  </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand font-weight-bold" href="#">APAI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        <!--  Link Register/Log in yang buka modal -->
        <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#authModal">Register/Log in</a></li>
        <li class="nav-item">
          <a class="btn btn-outline-light ml-2" href="#">Book service</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section (gambar background) -->
<header class="hero d-flex align-items-center">
  <div class="container text-center">
    <h1 class="display-4">We Provide Fast Mobile Repair Service</h1>
    <p class="lead">Quick, reliable and affordable repair services for all major devices.</p>
  </div>
</header>

<!-- Modal (Register/Log in) -->
<div class="modal fade" id="authModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalTitle">Log In</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs mb-3" id="authTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#loginForm">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signupForm">Sign Up</a>
          </li>
        </ul>

        <div class="tab-content">
          <!-- Login Form -->
          <div class="tab-pane fade show active" id="loginForm">
            <form id="login" method="POST">
              <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
              <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </form>
          </div>

          <!-- Sign Up Form (lengkap) -->
          <div class="tab-pane fade" id="signupForm">
            <form id="signup" method="POST">
              <input type="text" name="fullname" class="form-control mb-2" placeholder="Full Name" required>
              <input type="text" name="phone" class="form-control mb-2" placeholder="Phone Number" required>
              <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
              <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
              <input type="text" name="address" class="form-control mb-2" placeholder="Address" required>
              <button type="submit" class="btn btn-success btn-block">Sign Up</button>
            </form>
          </div>
        </div>

        <div id="authMessage" class="mt-2 text-center"></div>
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
