<?php

include 'db.php';

date_default_timezone_set("Africa/Nairobi");
$today =  date('Y-m-d');
$juzi = date('Y-m-d', strtotime("-7 days"));
$riderid = filter_input(INPUT_POST, "id");
$myArrays = array();

$sql = "SELECT * FROM `orders` WHERE customer_address != '' AND customer_address 
                                NOT LIKE '%RNG%' AND customer_address NOT LIKE '%G12%' 
                                AND assigned=0 AND packed IS NOT NULL AND (FROM_UNIXTIME(date_time+3600*10,'%Y-%m-%d'))>='$juzi' AND
                                (FROM_UNIXTIME(date_time+3600*10,'%Y-%m-%d'))<='$today' ORDER BY id ASC LIMIT 100";
$result = mysqli_query($conn, $sql);
while ($orders = mysqli_fetch_array($result)) {
    $t = date('m/d h:i A', $orders['date_time']);
    $fon = $orders["customer_phone"];
    $address = $orders["customer_address"];

    $sql1 = "SELECT * FROM speftown WHERE town='$address' LIMIT 1";
    $query_t = mysqli_query($conn, $sql1);



    if (mysqli_num_rows($query_t) > 0) {
        while ($dels = mysqli_fetch_array($query_t)) {
            $orders["bill_no"];
            $t;
            $fon;
            $orders["customer_address"];
            //$dels["del_id"];
            $myArrays[] = array('id' => $orders['id'], 'bill_no' => $orders['bill_no'], 'address' => $orders['customer_address'], 'date' => $t, 'delivery_id' => $dels['id'], 'phone' => $fon);
        }
    }
}

echo json_encode(['parcels' => $myArrays]);
