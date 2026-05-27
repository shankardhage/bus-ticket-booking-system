<?php
session_start();
include 'db.php';

$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // You can later store this in DB
    $success = "Your message has been sent successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Us - SD Travels</title>
<link rel="icon" type="image/png" href="assets/images/logo.png">
<link rel="stylesheet" href="assets/images/css/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f8f9fa;
}

</style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
    <img src="assets/images/logo.png" alt="SD Travels" style="height:40px;" class="me-2">
    <span class="fw-bold">SD Travels</span>
</a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-2">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item me-2">
                   <a class="nav-link" href="my_bookings.php">My Bookings</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <?php if(isset($_SESSION['user_id'])) { ?>

                    <!-- USER LOGGED IN -->
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle btn btn-outline-light px-3 py-1"
                           href="#" role="button" data-bs-toggle="dropdown">
                           <i class="bi bi-person-circle me-1"></i>
                           <?php echo $_SESSION['user_name']; ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-ticket-perforated me-2"></i> My Bookings
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger" href="logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </li>

                        </ul>

                    </li>

                <?php } else { ?>

                    <!-- NOT LOGGED IN -->
                    <li class="nav-item d-flex">

                        <a href="login.php" class="btn btn-outline-light me-2 px-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>

                        <a href="register.php" class="btn btn-warning fw-semibold px-3">
                            <i class="bi bi-person-plus me-1"></i> Register
                        </a>

                    </li>

                <?php } ?>

            </ul>

        </div>
    </div>
</nav>

<div class="container mt-5 mb-5">

    <div class="row g-4">

        <!-- LEFT: CONTACT FORM -->
        <div class="col-md-7">

            <div class="card shadow contact-card p-4">

                <h3 class="mb-4">
                    <i class="bi bi-envelope-fill me-2"></i> Contact Us
                </h3>

                <?php if($success){ ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php } ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" rows="4" class="form-control" required></textarea>
                    </div>

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-send-fill me-2"></i> Send Message
                    </button>

                </form>

            </div>

        </div>

        <!-- RIGHT: CONTACT INFO -->
        <div class="col-md-5">

            <div class="card shadow contact-card p-4">

                <h4 class="mb-3">Get in Touch</h4>

                <p>
                    <i class="bi bi-geo-alt contact-icon"></i>
                    Pune, Maharashtra
                </p>

                <p>
                    <i class="bi bi-envelope contact-icon"></i>
                    support@sdtravels.com
                </p>

                <p>
                    <i class="bi bi-telephone contact-icon"></i>
                    +91 9876543210
                </p>

                <hr>

                <h6 class="mb-2">Follow Us</h6>

                <div class="d-flex gap-2">
                    <i class="bi bi-facebook fs-4 text-primary"></i>
                    <i class="bi bi-instagram fs-4 text-danger"></i>
                    <i class="bi bi-twitter-x fs-4"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- OPTIONAL MAP -->
    <div class="mt-4">
        <iframe 
            src="https://maps.google.com/maps?q=Pune&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="250" style="border:0; border-radius:10px;">
        </iframe>
    </div>

</div>

<footer class="bg-dark text-light pt-5 pb-3 mt-5">

    <div class="container">

        <div class="row">

            <!-- LOGO + ABOUT -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img src="assets/images/logo.png" style="height:40px;" class="me-2">
                    <h5 class="mb-0">SD Travels</h5>
                    
                </div>

                <p class="text-light small">
                    Book bus tickets easily with SD Travels. 
                    Safe, fast, and reliable journey experience.
                </p>
                <div class="mt-3 social-icons">
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- QUICK LINKS -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">My Bookings</a></li>
                    <li><a href="#" class="footer-link">Contact</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold mb-3">Contact Us</h6>
                <p class="small mb-1"><i class="bi bi-geo-alt"></i> Pune, India</p>
                <p class="small mb-1"><i class="bi bi-envelope"></i> support@sdtravels.com</p>
                <p class="small"><i class="bi bi-telephone"></i> +91 9876543210</p>
            </div>

           

        </div>

       <hr style="border-color: rgba(255,255,255,0.2);">

        <!-- COPYRIGHT -->
        <div class="text-center small" style="color:#bbb;">
            © <?php echo date("Y"); ?> SD Travels. All rights reserved.
        </div>

    </div>

</footer>

</body>
</html>