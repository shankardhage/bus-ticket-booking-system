<?php
include 'db.php';
include 'auth.php';

$bus_id = $_GET['bus_id'];
$seats = explode(",", $_GET['seat']); // 🔥 multiple seats
session_start();
$user_id = $_SESSION['user_id'];

$allBooked = true;
$bookedSeats = [];
$failedSeats = [];

foreach($seats as $seat){

    $seat = trim($seat);

    // Check if seat is locked by this user
    $check = "SELECT * FROM seats 
    WHERE bus_id=$bus_id 
    AND seat_number='$seat' 
    AND locked_by=$user_id";

    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){

        // ✅ Confirm booking
        mysqli_query($conn, "UPDATE seats 
        SET status='booked', locked_by=NULL, lock_time=NULL 
        WHERE bus_id=$bus_id AND seat_number='$seat'");

        mysqli_query($conn, "INSERT INTO bookings(user_id, bus_id, seat_number) 
        VALUES($user_id, $bus_id, '$seat')");

        $bookedSeats[] = $seat;

    } else {
        $allBooked = false;
        $failedSeats[] = $seat;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<?php if($allBooked){ ?>

    <!-- ✅ SUCCESS -->
    <div class="card shadow p-4 text-center">
        <h2 class="text-success">Booking Successful 🎉</h2>

        <p class="mt-3">
            Seats booked: 
            <strong><?php echo implode(", ", $bookedSeats); ?></strong>
        </p>

        <a href="index.php" class="btn btn-primary mt-3">
            Book Another Ticket
        </a>
    </div>

<?php } else { ?>

    <!-- ⚠️ PARTIAL / FAILED -->
    <div class="card shadow p-4 text-center">
        <h2 class="text-danger">Booking Issue ❌</h2>

        <p class="mt-3">
            <strong>Booked:</strong> <?php echo implode(", ", $bookedSeats) ?: "None"; ?>
        </p>

        <p>
            <strong>Failed:</strong> <?php echo implode(", ", $failedSeats); ?>
        </p>

        <p class="text-muted">
            Some seats were not locked or time expired.
        </p>

        <a href="index.php" class="btn btn-secondary mt-3">
            Try Again
        </a>
    </div>

<?php } ?>

</div>

</body>
</html>