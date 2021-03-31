<?php
include 'db.php';
include 'data.php';

$riderid = filter_input(INPUT_POST, 'id');

$i = 1;
$date = date('Y-m-d');
$lastWeek = date("Y-m-d", strtotime("-21 days"));
$sql = "SELECT * FROM deliveries WHERE rider_id={$riderid} AND (FROM_UNIXTIME(date_time+3600*10,'%Y-%m-%d'))>='$lastWeek' 
AND (FROM_UNIXTIME(date_time+3600*10,'%Y-%m-%d'))<='$date' AND status='1' ORDER BY date_time DESC";
$result =  mysqli_query($conn, $sql);
$myArray = array();
if(mysqli_num_rows($result) > 0){
    while ($orders =  mysqli_fetch_array($result)) {
        $d = $orders['date_time'];
        $dd = date('d-m-Y', $d);
        $ddd = date('d M Y H:i:s', $d);

        $billno =  get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'bill_no');
        $net = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'net_amount');
        $address = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_address');
        $phone = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_phone');
        $myArray[] = array('order_no' => $billno, 'address' => $address, 'phone' => $phone, 'amount' => $net, 'date' => $ddd, 'payment' => $orders['payment']);
        $i++;
    }
    echo json_encode(['orders'=>$myArray]);
} else {
    die('404');
}