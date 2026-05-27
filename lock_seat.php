<?php
include 'db.php';
include 'auth.php';

$bus_id = $_GET['bus_id'];
$seats = explode(",", $_GET['seat']);
session_start();
$user_id = $_SESSION['user_id'];

$allLocked = true;

foreach($seats as $seat){

    $seat = trim($seat);

    $query = "UPDATE seats 
    SET locked_by=$user_id, lock_time=NOW()
    WHERE bus_id=$bus_id 
    AND seat_number='$seat'
    AND (locked_by IS NULL OR lock_time < NOW() - INTERVAL 5 MINUTE)";

    mysqli_query($conn, $query);

    // Check if this seat was locked
    if(mysqli_affected_rows($conn) == 0){
        $allLocked = false;
    }
}

if($allLocked){
    $seatList = implode(",", $seats);
   header("Location: confirm.php?bus_id=$bus_id&seat=$seat");
    exit();
} else {
    echo "Some seats are already locked or booked!";
}
?>