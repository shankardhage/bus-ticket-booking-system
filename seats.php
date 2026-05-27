<?php include 'db.php'; include 'auth.php'; $bus_id = $_GET['bus_id']; ?>

<?php
function renderSeat($seat, $bus_id, $conn){

    $query = "SELECT * FROM seats WHERE bus_id=$bus_id AND seat_number='$seat'";
    $result = mysqli_query($conn, $query);

    if($row = mysqli_fetch_assoc($result)){

        $isUpper = (strpos($seat, 'U') === 0) ? 'upper-seat' : 'lower-seat';
        $isSingle = (substr($seat, -1) == '1') ? 'single-seat' : '';

        // AVAILABLE
        if($row['status']=='available' && $row['locked_by']==NULL){

            echo "<div class='seat available $isUpper $isSingle' data-seat='$seat'
                  onclick='selectSeat(\"$seat\", this)'>
                    
                    <div class='seat-inner'></div>
                    <span class='seat-number'>$seat</span>

                  </div>";
        
        } 
        // LOCKED
        elseif($row['locked_by']!=NULL){

            echo "<div class='seat locked $isUpper $isSingle'>
                    
                    <div class='seat-inner'></div>
                    <span class='seat-number'>$seat</span>

                  </div>";
        
        } 
        // BOOKED
        else {

            echo "<div class='seat booked $isUpper $isSingle'>
                    
                    <div class='seat-inner'></div>
                    <span class='seat-number'>$seat</span>

                  </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Seats</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
}

p {
    font-weight: 400;
}

button {
    font-weight: 500;
}
/* Seat container */
.seat {
    width: 50px;
    height: 60px;
    margin: 6px;
    border-radius: 8px 8px 4px 4px;
    position: relative;
    cursor: pointer;
    transition: 0.3s;
}

/* Inner cushion */
.seat-inner {
    width: 80%;
    height: 70%;
    margin: auto;
    margin-top: 5px;
    border-radius: 6px;
}

/* Seat number */
.seat-number {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
    font-size: 11px;
    font-weight: bold;
    color: white;
    pointer-events: none;
}

/* AVAILABLE */
.available {
    background-color: #28a745;
}
.available .seat-inner {
    background-color: #5cd65c;
}

/* BOOKED */
.booked {
    background-color: #dc3545;
    cursor: not-allowed;
}
.booked .seat-inner {
    background-color: #ff6b6b;
}

/* LOCKED */
.locked {
    background-color: orange;
    cursor: not-allowed;
}
.locked .seat-inner {
    background-color: #ffc107;
}

/* SELECTED */
.selected {
    border: 3px solid #000;
    transform: scale(1.1);
}

/* Hover effect */
.available:hover {
    transform: scale(1.08);
}

/* Driver */
.driver {
    text-align: center;
    margin-bottom: 10px;
    font-weight: bold;
}

.seat.window {
    border-left: 4px solid #333;
}



/* Bus front container */
.bus-front {
    border-bottom: 2px dashed #ccc;
    padding-bottom: 10px;
}

/* Driver box */
.driver-box {
    text-align: center;
    font-size: 12px;
    color: #555;
}

.driver-box i {
    font-size: 22px;
    color: #000;
}

/* Steering wheel */
.steering {
    width: 40px;
    height: 40px;
    border: 3px solid #333;
    border-radius: 50%;
    position: relative;
}

/* Steering inner lines */
.steering::before,
.steering::after {
    content: '';
    position: absolute;
    background: #333;
}

.steering::before {
    width: 2px;
    height: 100%;
    left: 50%;
    transform: translateX(-50%);
}

.steering::after {
    height: 2px;
    width: 100%;
    top: 50%;
    transform: translateY(-50%);
}




</style>
</head>

<body>

<div class="container mt-5">

<div class="card shadow-lg p-4">

    <h3 class="text-center mb-4">
    <i class="bi bi-bus-front-fill me-2"></i> Select Your Seat
</h3>

    <!-- BUS LAYOUT BOX -->
    <div id="seatContainer" class="bus-layout p-3 rounded">

        <!-- DRIVER SECTION -->
        <div class="bus-front d-flex justify-content-between align-items-center mb-4 px-3">

            <!-- Driver -->
            <div class="driver-box text-center">
                <i class="bi bi-person-fill fs-4"></i>
                <div class="driver-text small">Driver</div>
            </div>

            <!-- Steering -->
            <div class="steering"></div>

        </div>

        <!-- LOWER DECK -->
        <h6 class="text-center fw-bold text-success mb-3">⬇ Lower Deck</h6>

        <?php
        $rows = ['A','B','C'];

        foreach($rows as $rowLetter){

            echo "<div class='d-flex justify-content-center mb-2'>";

            // LEFT (1 seat)
            renderSeat($rowLetter."1", $bus_id, $conn);

            // AISLE
            echo "<div class='aisle-space'></div>";

            // RIGHT (2 seats)
            for($i=2; $i<=3; $i++){
                renderSeat($rowLetter.$i, $bus_id, $conn);
            }

            echo "</div>";
        }
        ?>

        <!-- UPPER DECK -->
        <h6 class="text-center fw-bold text-primary mt-4 mb-3">⬆ Upper Deck</h6>

        <?php
        for($r=1; $r<=3; $r++){

            echo "<div class='d-flex justify-content-center mb-2'>";

            // LEFT (1 seat)
            renderSeat("U".(($r-1)*3 + 1), $bus_id, $conn);

            // AISLE
            echo "<div class='aisle-space'></div>";

            // RIGHT (2 seats)
            for($i=2; $i<=3; $i++){
                renderSeat("U".(($r-1)*3 + $i), $bus_id, $conn);
            }

            echo "</div>";
        }
        ?>

    </div>

    <!-- BOOKING SUMMARY -->
    <div class="card mt-4 p-3 shadow-sm border-0">
        <h5 class="mb-2">Booking Summary</h5>
        <p class="mb-1">Seats: <span id="selectedSeats">None</span></p>
        <p>Total Price: ₹<span id="totalPrice">0</span></p>

        <button class="btn btn-primary w-100 mt-2" onclick="proceedBooking()">
            Proceed
        </button>
    </div>

    <!-- LEGEND -->
    <div class="mt-4 text-center d-flex justify-content-center gap-3 flex-wrap">
        <span class="badge bg-success">Available</span>
        <span class="badge bg-warning text-dark">Locked</span>
        <span class="badge bg-danger">Booked</span>
        <span class="badge bg-primary">Upper</span>
    </div>

</div>
</div>

<script>
let selectedSeats = [];
let pricePerSeat = 500;

// Live update
setInterval(function() {
    fetch('seat_status.php?bus_id=<?php echo $bus_id; ?>')
    .then(res => res.json())
    .then(data => {

        data.forEach(seat => {
            let el = document.querySelector(`[data-seat='${seat.seat_number}']`);
            if(!el) return;

            el.classList.remove("available","locked","booked");

            if(seat.status === "booked"){
                el.classList.add("booked");
            } 
            else if(seat.locked_by !== null){
                el.classList.add("locked");
            } 
            else {
                el.classList.add("available");
            }
        });

    });
}, 5000);


// Selection
function selectSeat(seat, element){

    let index = selectedSeats.indexOf(seat);

    if(index === -1){
        selectedSeats.push(seat);
        element.classList.add("selected");
    } else {
        selectedSeats.splice(index, 1);
        element.classList.remove("selected");
    }

    updateSummary();
}


// Summary
function updateSummary(){
    document.getElementById("selectedSeats").innerText = selectedSeats.join(", ") || "None";
    document.getElementById("totalPrice").innerText = selectedSeats.length * pricePerSeat;
}


// Proceed
function proceedBooking(){

    if(selectedSeats.length === 0){
        alert("Please select at least one seat");
        return;
    }

    let seats = selectedSeats.join(",");
    window.location.href = "lock_seat.php?bus_id=<?php echo $bus_id; ?>&seat=" + seats;
}
</script>

</body>
</html>