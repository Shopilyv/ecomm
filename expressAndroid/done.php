<?php

include 'db.php';
include 'rando.php';
$riderid = filter_input(INPUT_POST, "id");

$check_id = mysqli_query($conn, "SELECT id FROM users WHERE id = '$riderid'") or die(mysqli_error($conn));

if(mysqli_num_rows($check_id) > 0 && !empty($riderid)){
    $sql = "SELECT *, deliveries.id as del_id FROM deliveries INNER JOIN orders ON (deliveries.bill_id = orders.id) 
    INNER JOIN users ON (users.id = orders.user_id) WHERE rider_id = '$riderid' AND (status = 0)";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $myArrays = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $myArrays[] = array(
                'del_id' => $row['del_id'],
                'order_no' => $row['bill_no'],
                'address' => $row['customer_address'],
                'seller' => $row['username'],
                'phone' => $row['customer_phone'],

            );
        }
        echo json_encode(['deliveries' => $myArrays]);
    } else {
        die('404');
        exit();
    }
} else {
    die('403');
}

// include 'db.php';
// include 'rando.php';
// $riderid = filter_input(INPUT_POST, "id");

// if(!empty($riderid)){
//     $sql = "SELECT *, deliveries.id as del_id FROM deliveries INNER JOIN orders ON (deliveries.bill_id = orders.id) 
//     INNER JOIN users ON (users.id = orders.user_id) WHERE rider_id = '$riderid' AND (status = 0)";
//     $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//     $myArrays = array();
//     if (mysqli_num_rows($result) > 0) {
//         while ($row = mysqli_fetch_array($result)) {
            
//             $myArrays[] = array(
//                 'del_id' => $row['del_id'],
//                 'order_no' => $row['bill_no'],
//                 'address' => $row['customer_address'],
//                 'seller' => $row['username'],
//                 'phone' => $row['customer_phone'],
               
//             );
//         }
//         echo json_encode(['deliveries' => $myArrays]);
//     } else {
//         die('404');
//         exit();
//     }
// }
