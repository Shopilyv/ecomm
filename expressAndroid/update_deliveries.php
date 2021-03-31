<?php

include 'db.php';
include 'rando.php';

$gen = new Gen();
$rider = filter_input(INPUT_POST, "id");
$order_no = filter_input(INPUT_POST, "order_no");
$payment = $gen->get_payment_method($conn, $order_no);
$cash = isset($_POST['cash']) ? $_POST['cash'] : 0;
$cod = isset($_POST['cod']) ? $_POST['cod'] : 0;
$mpesa = 0;
$status = 1;
$date = time();
$reason = "NULL";

$sql = "UPDATE deliveries SET payment = '$payment', cash = '$cash', cod = '$cod', status = '$status', 
mpesa = '$mpesa', reasons = '$reason', date_time = '$date' WHERE rider_id = '$rider'";
$result = mysqli_query($conn, $sql) or  die("Error: ".mysqli_error($conn));

if(mysqli_affected_rows($conn) > 0){
    echo '201';
} else {
    die('500');
    
}