<?php

include 'db.php';
include 'data.php';

$riderid= filter_input(INPUT_POST, "id");
$i = 1;
$sql = "SELECT * FROM parcel WHERE rider_id={$riderid} AND accept='1' AND (reasons IS NULL AND receipt IS NULL) OR status = 0 ORDER BY id DESC";
$result =  mysqli_query($conn, $sql);
$myArray = array();
if(mysqli_num_rows($result) > 0){
    while ($orders =  mysqli_fetch_array($result)) {
        $billno =  get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'bill_no');
        $address = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_address');
        $phone = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_phone');
        $myArray[] = array('order_no' => $billno, 'address' => $address, 'phone' => $phone);
    }
    echo json_encode(['parcels' => $myArray]);
} else {
    die('404');
}