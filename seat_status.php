<?php
include 'db.php';
include 'auth.php';

$bus_id = $_GET['bus_id'];

// 🔥 Step 1: Auto release expired locks (VERY IMPORTANT)
mysqli_query($conn, "UPDATE seats 
SET locked_by=NULL, lock_time=NULL 
WHERE bus_id=$bus_id 
AND lock_time IS NOT NULL 
AND lock_time < NOW() - INTERVAL 5 MINUTE");

// 🔥 Step 2: Fetch latest seat data
$query = "SELECT seat_number, status, locked_by FROM seats WHERE bus_id=$bus_id";
$result = mysqli_query($conn, $query);

$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

// 🔥 Step 3: Return JSON
header('Content-Type: application/json');
echo json_encode($data);
?>