<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['bus_id']) || !isset($_GET['seat'])){
    header("Location: index.php");
    exit();
}

$bus_id = $_GET['bus_id'];
$seat = $_GET['seat']; // comma separated seats
?>

<!DOCTYPE html>
<html>
<head>
<title>Seat Locked - SD Travels</title>

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

<div class="container mt-5">

    <div class="card shadow-lg p-5 text-center">

        <h2 class="text-success">
            <i class="bi bi-check-circle-fill"></i>
            Seats Locked Successfully
        </h2>

        <h4 class="mt-3">
            Seats: <?php echo $seat; ?>
        </h4>

        <p class="mt-3 text-muted">
            Complete your booking within:
        </p>

        <h1 id="timer" class="text-danger fw-bold">300 sec</h1>

        <!-- NEXT STEP -->
        <a href="passenger_details.php?bus_id=<?php echo $bus_id; ?>&seat=<?php echo $seat; ?>" 
           class="btn btn-primary mt-4 px-4">

            <i class="bi bi-person-lines-fill me-2"></i>
            Enter Passenger Details
        </a>

    </div>

</div>

<script>
let time = 300;

let timer = setInterval(function(){
    time--;
    document.getElementById("timer").innerText = time + " sec";

    if(time <= 0){
        clearInterval(timer);
        alert("Session expired! Please select seats again.");
        window.location.href = "seat.php?bus_id=<?php echo $bus_id; ?>";
    }
}, 1000);
</script>

</body>
</html>