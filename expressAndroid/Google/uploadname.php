<?php
include '../db.php';
include '../rando.php';
$gen = new Gen();
$bill_no = filter_input(INPUT_POST, "order_no");
$bill_id = $gen->get_order_id($conn, $bill_no);
$status = 1;
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $sql = "UPDATE parcel SET receipt = '$name', status = '$status' WHERE bill_id = '$bill_id'";
    $res = mysqli_query($conn, $sql);
}