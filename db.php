<?php
$conn = mysqli_connect("localhost", "root", "", "bus_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>