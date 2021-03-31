<?php

include 'db.php';
include 'rando.php';
date_default_timezone_set("Africa/Nairobi");
$date = date("Y-m-d h:i:s");
$gen = new Gen();
$swap = filter_input(INPUT_POST, "rider_id");
$swappee = filter_input(INPUT_POST, 'swappee');
$order_no =  filter_input(INPUT_POST, "order_no");
$bill_id  = $gen->get_order_id($conn, $order_no);
$sql = "UPDATE deliveries SET rider_id = '$swap' WHERE bill_id = '$bill_id'";
//$query = mysqli_query($conn, "INSERT INTO swap(ordid, swapper_id, swappee, date_swapped) VALUES('$bill_id', '$swap', '$swappee', '$date')") or die(mysqli_error($conn));
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn) > 0){
    echo '201';
} else {
    die('500');
    exit();
}