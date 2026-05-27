<?php
include 'auth.php';
include 'db.php';

$bus_id = $_GET['bus_id'];
$seats = $_GET['seat']; // multiple seats
?>

<!DOCTYPE html>
<html>
<head>
<title>Passenger Details</title>

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

    <div class="card shadow p-4">

        <h3 class="mb-4">
            <i class="bi bi-person-lines-fill me-2"></i>
            Enter Passenger Details
        </h3>

        <form action="confirm_booking.php" method="POST">

            <?php
            $seatArray = explode(",", $seats);

            foreach($seatArray as $index => $seat){
            ?>

            <div class="border p-3 mb-3 rounded">

                <h5>Seat: <?php echo $seat; ?></h5>

                <input type="hidden" name="seat[]" value="<?php echo $seat; ?>">

                <div class="row g-2">

                    <div class="col-md-4">
                        <input type="text" name="name[]" class="form-control" placeholder="Name" required>
                    </div>

                    <div class="col-md-3">
                        <input type="number" name="age[]" class="form-control" placeholder="Age" required>
                    </div>

                    <div class="col-md-3">
                        <select name="gender[]" class="form-control" required>
                            <option value="">Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

                </div>

            </div>

            <?php } ?>

            <input type="hidden" name="bus_id" value="<?php echo $bus_id; ?>">

            <button class="btn btn-primary w-100 mt-3">
                Confirm Booking
            </button>

        </form>

    </div>

</div>

</body>
</html>