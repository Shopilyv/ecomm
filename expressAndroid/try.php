<?php
include 'db.php';
include 'data.php';
$riderid =  11;// filter_input(INPUT_POST, "id");
$i = 1;
$sql = "SELECT * FROM deliveries WHERE rider_id={$riderid} AND status=0 AND accept=1 AND priority IS NULL AND reasons IS NULL AND rejection IS
NULL AND exchange IS NULL AND returned IS NULL ORDER BY id DESC";
$result =  mysqli_query($conn, $sql);
$myArray = array();

if(mysqli_num_rows($result) > 0){
    while($orders = mysqli_fetch_array($result)){
        $billno =  get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'bill_no');
        $address = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_address');
        $phone = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_phone');
        $land = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'landmark');
        $myArray[] = array('id'=>$orders['id'],'order_no' => $billno, 'address' => $address, 'phone' => $phone, 'landmark'=>$land);
    }
    echo json_encode(['deliveries'=>$myArray]);
} else {
    die('404');
}