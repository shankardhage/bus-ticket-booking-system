<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bus Booking System</title>

    <!-- site icon -->
     <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/images/css/style.css">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   

    <!-- jQuery + jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <style></style>
</head>

<body style="background: linear-gradient(135deg, #e3f2fd, #ffffff);">


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


<!-- SLIDER -->
<div class="mb-1">
<div id="busSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#busSlider" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#busSlider" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#busSlider" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#busSlider" data-bs-slide-to="3"></button>
        <button type="button" data-bs-target="#busSlider" data-bs-slide-to="4"></button>
       
        
    </div>

    <!-- Slides -->
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="assets/images/image1.jpg" class="d-block w-100 slider-img">
            <div class="carousel-caption custom-caption">
                <h4>Travel Comfortably</h4>
                <p>Book your journey with ease</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="assets/images/image2.jpg" class="d-block w-100 slider-img">
            <div class="carousel-caption custom-caption">
                <h4>Explore New Places</h4>
                <p>Safe & secure booking</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="assets/images/image3.jpg" class="d-block w-100 slider-img">
            <div class="carousel-caption custom-caption">
                <h4>Book Anytime</h4>
                <p>24x7 online booking system</p>
            </div>
        </div>
         <!-- Slide 4 -->
        <div class="carousel-item">
            <img src="assets/images/image4.jpg" class="d-block w-100 slider-img">
            <div class="carousel-caption custom-caption">
                <h4>Book Anytime</h4>
                <p>24x7 online booking system</p>
            </div>
        </div>
         <!-- Slide 5 -->
        <div class="carousel-item">
            <img src="assets/images/image5.jpg" class="d-block w-100 slider-img">
            <div class="carousel-caption custom-caption">
                <h4>Book Anytime</h4>
                <p>24x7 online booking system</p>
            </div>
        </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#busSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#busSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>
</div>


<!-- SEARCH SECTION -->
<div class="container d-flex justify-content-center mb-5" style="margin-top: 10px;">

    <div class="card shadow-lg border-0 p-4 w-100" 
         style="max-width: 800px; border-radius: 15px; margin-top: -40px;">

        <!-- Title -->
        <h4 class="text-center mb-3 fw-bold">
            <i class="bi bi-bus-front-fill me-2"></i> Bus Ticket Booking
        </h4>

        <!-- Form -->
        <form action="search.php" method="GET" class="row g-3 align-items-end">

            <!-- Source -->
            <div class="col-md-5">
                <label class="form-label fw-semibold">From</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" id="source" name="source" 
                           class="form-control form-control-lg"
                           placeholder="Enter Source City" required>
                </div>
            </div>

            <!-- Swap -->
            <div class="col-md-2 text-center d-flex justify-content-center align-items-end">
                <button type="button"
                    onclick="swapCities()"
                    class="btn btn-light border rounded-circle shadow swap-btn">
                    <i class="bi bi-arrow-left-right"></i>
                </button>
            </div>

            <!-- Destination -->
            <div class="col-md-5">
                <label class="form-label fw-semibold">To</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" id="destination" name="destination"
                           class="form-control form-control-lg"
                           placeholder="Enter Destination City" required>
                </div>
            </div>

            <!-- Search -->
            <div class="col-12 mt-2">
                <button class="btn btn-primary w-100 py-2 shadow fw-semibold search-btn">
                    <i class="bi bi-search me-2"></i> Search Buses
                </button>
            </div>

        </form>

    </div>

</div>

<div class="container mb-5">

    <h4 class="fw-bold mb-4 text-center">🔥 Popular Routes</h4>

    <div class="row g-3">

        <!-- Route 1 -->
        <div class="col-md-3">
            <div class="card route-card shadow text-center p-3"
                 onclick="selectRoute('Mumbai','Pune')">
                <h5>Mumbai → Pune</h5>
            </div>
        </div>

        <!-- Route 2 -->
        <div class="col-md-3">
            <div class="card route-card shadow text-center p-3"
                 onclick="selectRoute('Mumbai','Nashik')">
                <h5>Mumbai → Nashik</h5>
            </div>
        </div>

        <!-- Route 3 -->
        <div class="col-md-3">
            <div class="card route-card shadow text-center p-3"
                 onclick="selectRoute('Pune','Nagpur')">
                <h5>Pune → Nagpur</h5>
            </div>
        </div>

        <!-- Route 4 -->
        <div class="col-md-3">
            <div class="card route-card shadow text-center p-3"
                 onclick="selectRoute('Mumbai','Goa')">
                <h5>Mumbai → Goa</h5>
            </div>
        </div>

    </div>

</div>


<!-- Why choose us section -->
<div class="container mb-5">

    <h4 class="fw-bold text-center mb-4">Why Choose Us</h4>

    <div class="row text-center g-4">

        <!-- Feature 1 -->
        <div class="col-md-3 d-flex fade-in">
            <div class="feature-box p-3 shadow w-100 text-center">
                <i class="bi bi-lightning-charge-fill fs-1 text-primary"></i>
                <h5 class="mt-3">Fast Booking</h5>
                <p class="text-muted">Book tickets in seconds with our easy system.</p>
            </div>
        </div>

        <!-- Feature 2 -->
        <div class="col-md-3 d-flex fade-in">
            <div class="feature-box p-3 shadow w-100 text-center">
                <i class="bi bi-shield-check fs-1 text-success"></i>
                <h5 class="mt-3">Secure Payment</h5>
                <p class="text-muted">Your transactions are 100% safe and secure.</p>
            </div>
        </div>

        <!-- Feature 3 -->
        <div class="col-md-3 d-flex fade-in">
            <div class="feature-box p-3 shadow w-100 text-center">
                <i class="bi bi-clock-history fs-1 text-warning"></i>
                <h5 class="mt-3">Real-Time Seats</h5>
                <p class="text-muted">Live seat availability with instant updates.</p>
            </div>
        </div>

        <!-- Feature 4 -->
        <div class="col-md-3 d-flex fade-in">
            <div class="feature-box p-3 shadow w-100 text-center">
                <i class="bi bi-headset fs-1 text-danger"></i>
                <h5 class="mt-3">24x7 Support</h5>
                <p class="text-muted">We are here to help you anytime.</p>
            </div>
        </div>

    </div>

</div>


<!-- Offer banner section -->
 <div class="container mb-5">

    <div class="card text-white text-center p-4 shadow-lg offer-banner">

        <h3 class="fw-bold">🎉 Get 10% OFF on First Booking</h3>
        <p class="mb-2">Use Code: <strong>FIRST10</strong></p>

        <button class="btn btn-light fw-semibold px-4"
        onclick="quickBook('Mumbai','Pune')">
    Book Mumbai → Pune Now
</button>

    </div>

</div>


<!-- Footer section -->
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

<!-- for navbar toggle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Autocomplete Script -->
<script>
$(function() {

    function fetchLocations(request, response) {
        $.ajax({
            url: "get_locations.php",
            dataType: "json",
            data: { term: request.term },
            success: function(data) {
                response(data);
            }
        });
    }

    $("#source").autocomplete({
        source: fetchLocations,
        minLength: 1
    });

    $("#destination").autocomplete({
        source: fetchLocations,
        minLength: 1
    });

});
</script>

<script>
function swapCities(){
    let source = document.getElementById("source").value;
    let destination = document.getElementById("destination").value;

    document.getElementById("source").value = destination;
    document.getElementById("destination").value = source;
}
</script>

<!-- Autofill function for popular routes -->
<script>
function selectRoute(source, destination){

    document.getElementById("source").value = source;
    document.getElementById("destination").value = destination;
    document.querySelector("form").submit();

    // Scroll to form smoothly
    window.scrollTo({
        top: 200,
        behavior: "smooth"
    });
}
</script>

<script>
function quickBook(source, destination){

    // Fill inputs
    document.getElementById("source").value = source;
    document.getElementById("destination").value = destination;

    // Scroll to search box
    document.querySelector("form").scrollIntoView({
        behavior: "smooth"
    });

}
</script>
</body>
</html>