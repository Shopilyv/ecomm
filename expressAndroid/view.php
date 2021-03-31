<?php
include 'db.php';
$url = "https://store.queensclassy.com/";

$bill_no = filter_input(INPUT_POST, "bill_no");

$sql = "SELECT * FROM cart_items INNER JOIN orders ON (orders.bill_no = cart_items.order_no) INNER JOIN products ON (cart_items.p_id = products.id) WHERE order_no = '$bill_no'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$myArrays = array();
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $myArrays[] = array('id'=>$row['p_id'], 'name'=>$row['p_name'], 'image'=>$url.$row['image']);
    }
    echo json_encode(['products'=>$myArrays]);
} else {
    die('404');
    exit();
}



// echo json_encode(['products'=>$myArrays]);