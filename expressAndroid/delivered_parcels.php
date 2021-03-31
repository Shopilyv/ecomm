<?php
include 'db.php';
include 'data.php';

$url = "https://express.queensclassy.com/userfiles/receipts/";
$riderid =  filter_input(INPUT_POST, "id");
$i = 1;
$sql = "SELECT * FROM parcel WHERE rider_id={$riderid} AND accept=1 AND receipt IS NOT NULL AND reasons IS NULL ORDER BY date DESC LIMIT 100";
$result =  mysqli_query($conn, $sql);
$myArrays = array();
if(mysqli_num_rows($result) > 0){
    while ($orders =  mysqli_fetch_array($result)) {
        $billno =  get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'bill_no');
        $net = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'net_amount');
        $address = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_address');
        $phone = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_phone');
        $myArrays[] = array('order_no' => $billno, 'address' => $address, 'phone' => $phone, 'image' => $url . $orders['receipt']);
    }
    echo json_encode(['parcels'=>$myArrays]);
} else {
    die('404');
}