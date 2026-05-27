<?php
include 'auth.php'; // ensures user is logged in
include 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch bookings with bus info
$query = "SELECT b.*, bus.bus_name, bus.source, bus.destination
          FROM bookings b
          JOIN buses bus ON b.bus_id = bus.id
          WHERE b.user_id = $user_id
          ORDER BY b.booking_time DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Bookings - SD Travels</title>
<link rel="icon" type="image/png" href="assets/images/logo.png">
<link rel="stylesheet" href="assets/images/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f8f9fa;
}

.booking-card {
    border-radius: 12px;
    transition: 0.3s;
}

.booking-card:hover {
    transform: translateY(-5px);
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

<div class="container mt-5">

  <h3 class="mb-4 text-center fw-bold border-bottom pb-2">
    <i class="bi bi-ticket-perforated-fill me-2 text-primary"></i> My Bookings
</h3>

    <?php if(mysqli_num_rows($result) > 0){ ?>

        <div class="row g-4">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

           <div class="col-md-6">

    <div class="card shadow-sm p-3 h-100">

        <h5 class="fw-bold mb-2"><?php echo $row['bus_name']; ?></h5>

        <p class="mb-1">
            <i class="bi bi-geo-alt"></i>
            <?php echo $row['source']; ?> → <?php echo $row['destination']; ?>
        </p>

        <p class="mb-1">
            <i class="bi bi-chair"></i>
            Seat: <strong><?php echo $row['seat_number']; ?></strong>
        </p>

        <p class="mb-2 text-muted small">
            <i class="bi bi-clock"></i>
            <?php echo $row['booking_time']; ?>
        </p>

        <span class="badge bg-success">Confirmed</span>

    </div>

</div>

        <?php } ?>

        </div>

    <?php } else { ?>

        <div class="text-center mt-5">
            <i class="bi bi-ticket fs-1 text-muted"></i>
            <h5 class="mt-3">No Bookings Yet</h5>
            <p class="text-muted">Start booking your journey now</p>

            <a href="index.php" class="btn btn-primary mt-2">
                Book Now
            </a>
        </div>

    <?php } ?>

</div>



</body>
</html>