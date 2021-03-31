<?php

include 'db.php';
include 'data.php';

$riderid = filter_input(INPUT_POST, "id");

$i = 1;
$sql = "SELECT * FROM deliveries WHERE accept=0 AND reasons != '' ORDER BY date DESC";
$result =  mysqli_query($conn, $sql);
$myArray = array();
if (mysqli_num_rows($result) > 0) {
    while ($orders =  mysqli_fetch_array($result)) {
        $billno =  get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'bill_no');
        $address = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_address');
        $phone = get_specific_data($conn, 'orders', 'id', $orders["bill_id"], 'customer_phone');
        $myArray[] = array('id' => $orders['id'], 'bill_no' => $billno, 'address' => $address, 'date' => $orders['date'], 'phone' => $phone, 'reason' => $orders['reasons']);
    }
    echo json_encode(['orders' => $myArray]);
} else {
    die('404');
}

