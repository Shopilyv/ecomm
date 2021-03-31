<?php

include 'db.php';

$order = filter_input(INPUT_POST, "order_no");

$sql = "SELECT * FROM cart_items INNER JOIN orders ON (cart_items.order_no = orders.bill_no) INNER JOIN products ON(products.id = cart_items.p_id) WHERE order_no = '$order'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$myArrays = array();
$url = "https://store.queensclassy.com/";
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $qty = $row['qty'];
        $price = $row['price'];
        $total = $qty * $price;
        $myArrays[] = array('p_name'=>$row['p_name'], 'size'=>$row['sizes'], 'image'=>$url.$row['image'], 'amount'=>$row['price']);
    }
    echo json_encode(['products'=>$myArrays]);
} else {
    die('404');
    exit();
}