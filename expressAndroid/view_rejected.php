<?php

include 'db.php';
include 'data.php';;

$riderid =  filter_input(INPUT_POST, "id");
$i = 1;
$sql = "SELECT * FROM deliveries WHERE rejection IS NOT NULL AND rider_id={$riderid} ORDER BY date DESC";
$result =  mysqli_query($conn, $sql);
$myArray = array();
if(mysqli_num_rows($result) > 0){
    while ($orders =  mysqli_fetch_array($result)) {
        $billno =  get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'bill_no');
        $net = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'net_amount');
        $address = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_address');
        $phone = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_phone');
        $myArray[] = array('order_no' => $billno, 'address' => $address, 'phone' => $phone, 'amount' => $net, 'date' => $orders['date'], 'rejection' => $orders['rejection']);
    }
    echo json_encode(['rejected' => $myArray]);
} else {
    die('404');
}