<?php
include 'db.php';
include 'rando.php';
$swap = filter_input(INPUT_POST, "rider_id");
$order_no = filter_input(INPUT_POST, "order_no");
$bill_id  = $gen->get_order_id($conn, $order_no);
$sql = "UPDATE parcel SET rider_id = '$swap' WHERE bill_id = '$bill_id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn) > 0){
    echo '201';
} else {
    die('500');
    exit();
}