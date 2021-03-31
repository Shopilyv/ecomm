<?php
include 'db.php';
$billid = filter_input(INPUT_POST, "bill_id");
$riderid = filter_input(INPUT_POST, "rider_id");
$status = 0;
$accept = 1;
$assigned_date = time();

$sql = "INSERT INTO deliveries(bill_id, rider_id, status, accept, assigned_dt) VALUES('$billid', '$riderid', '$status', '$accept', '$assigned_date')";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn) > 0){
    echo '201';
} else {
    die('500');
    exit();
}