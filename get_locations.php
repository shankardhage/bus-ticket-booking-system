<?php
include 'db.php';
include 'auth.php';

$term = $_GET['term'];

$query = "SELECT DISTINCT source AS location FROM buses WHERE source LIKE '%$term%'
          UNION
          SELECT DISTINCT destination AS location FROM buses WHERE destination LIKE '%$term%'";

$result = mysqli_query($conn, $query);

$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row['location'];
}

echo json_encode($data);
?>