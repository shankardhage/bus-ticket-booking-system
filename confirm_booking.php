<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$bus_id = $_POST['bus_id'];
$seats = $_POST['seat'];
$names = $_POST['name'];
$ages = $_POST['age'];
$genders = $_POST['gender'];

$success = true;

foreach($seats as $index => $seat){

    // Check if seat is locked by this user
    $check = "SELECT * FROM seats 
              WHERE bus_id=$bus_id 
              AND seat_number='$seat' 
              AND locked_by=$user_id";

    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){

        // Confirm booking
        mysqli_query($conn, "UPDATE seats 
            SET status='booked', locked_by=NULL, lock_time=NULL 
            WHERE bus_id=$bus_id AND seat_number='$seat'");

        // Save booking
        mysqli_query($conn, "INSERT INTO bookings(user_id, bus_id, seat_number) 
            VALUES($user_id, $bus_id, '$seat')");

    } else {
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Booking Status - SD Travels</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f8f9fa;
}
</style>
</head>

<body>

<div class="container mt-5 text-center">

<?php if($success){ ?>

    <div class="card shadow p-5">

        <h2 class="text-success">
            <i class="bi bi-check-circle-fill"></i>
            Booking Confirmed
        </h2>

        <p class="mt-3">
            Seats: <strong><?php echo implode(", ", $seats); ?></strong>
        </p>

        <a href="my_bookings.php" class="btn btn-primary mt-3">
            <i class="bi bi-ticket-perforated me-1"></i>
            View My Bookings
        </a>

    </div>

<?php } else { ?>

    <div class="card shadow p-5">

        <h2 class="text-danger">
            <i class="bi bi-x-circle-fill"></i>
            Booking Failed
        </h2>

        <p class="mt-3">Some seats were already booked or expired.</p>

        <a href="index.php" class="btn btn-secondary mt-3">
            Try Again
        </a>

    </div>

<?php } ?>

</div>

</body>
</html>