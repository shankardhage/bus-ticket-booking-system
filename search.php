<?php include 'db.php';
include 'auth.php';
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Buses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Available Buses</h2>

<?php
$source = $_GET['source'];
$destination = $_GET['destination'];

$query = "SELECT * FROM buses WHERE source='$source' AND destination='$destination'";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
?>

    <div class="card mb-3 shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5><?php echo $row['bus_name']; ?></h5>
                <p><?php echo $row['source']; ?> → <?php echo $row['destination']; ?></p>
            </div>

            <a href="seats.php?bus_id=<?php echo $row['id']; ?>" class="btn btn-success">
                Select Seats
            </a>
        </div>
    </div>

<?php } ?>

</div>

</body>
</html>