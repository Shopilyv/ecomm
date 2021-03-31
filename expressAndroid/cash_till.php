<?php

include 'db.php';

include 'data.php';

$riderid= filter_input(INPUT_POST, "id");
$dtt = date("Y-m-d");
$cashTotal = 0;

$sql = "SELECT  DATE(FROM_UNIXTIME(date_time+3600*10,'%Y-%m-%d')) AS ddate, rider_id, cash_received, cash, SUM(cash)
AS cashin FROM deliveries WHERE rider_id={$riderid} AND status='1' AND cash IS NOT NULL AND date_time IS NOT NULL GROUP BY ddate ORDER BY ddate DESC LIMIT 7";
$result = mysqli_query($conn, $sql);
$myArray = array();
if (mysqli_num_rows($result) > 0) {
    while ($orders = mysqli_fetch_array($result)) {
        $dt =  strtotime($orders["ddate"]);
        //echo date('d M Y', $dt);
        $orders['cashin'];
        $myArray[] = array('date'=>date('d M Y', $dt), 'cash'=>$orders['cashin']);
    }
    echo json_encode(['cash'=>$myArray]);
} else {
    die('404');
}