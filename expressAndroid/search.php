<?php
include 'db.php';

$order_no = filter_input(INPUT_POST, "search");
if(!empty($order_no)){
    date_default_timezone_set("Africa/Nairobi");
    $today =  date('Y-m-d');
    $juzi = date('Y-m-d', strtotime("-70 days"));

    $sql = "SELECT * FROM orders WHERE (customer_address != '' AND customer_address 
                                NOT LIKE '%RNG%' AND customer_address NOT LIKE '%G12%' 
                                AND assigned=0 AND packed IS NOT NULL) AND (bill_no LIKE '%$order_no%' OR customer_address LIKE '%$order_no%')";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $myArrays = array();
    if(mysqli_num_rows($result) > 0){
        while($orders = mysqli_fetch_array($result)){
            $t = date('m/d h:i A', $orders['date_time']);
            $fon = $orders["customer_phone"];
            $address = $orders["customer_address"];

            $sql1 = "SELECT * FROM speftown WHERE town='$address' LIMIT 1";
            $query_t = mysqli_query($conn, $sql1);
            while ($dels = mysqli_fetch_array($query_t)) {
                $orders["bill_no"];
                $t;
                $fon;
                $orders["customer_address"];
                //$dels["del_id"];
                $myArrays[] = array('id' => $orders['id'], 'bill_no' => $orders['bill_no'], 'address' => $orders['customer_address'], 'date' => $t, 'delivery_id' => $dels['id'], 'phone' => $fon);
            }
        }

        if($myArrays != null){
            echo json_encode(['search' => $myArrays]);
        } else {
            echo '404';
        }
    } else {
        die('404');
    }
} else {
    die('403');
}
// date_default_timezone_set("Africa/Nairobi");
// $today =  date('Y-m-d');
// $juzi = date('Y-m-d', strtotime("-70 days"));
// if(empty($order_no)){
//     die('403');
// } else {
//     //$sql = "SELECT * FROM orders WHERE bill_no LIKE '%$order_no%' OR customer_address LIKE '%$order_no%'";
//     $sql = "SELECT * FROM orders WHERE (customer_address != '' AND customer_address 
//                                 NOT LIKE '%RNG%' AND customer_address NOT LIKE '%G12%' 
//                                 AND assigned=0 AND packed IS NOT NULL AND 
//                                 (FROM_UNIXTIME(date_time+3600*10,'%Y-%m-%d'))>='$juzi' OR 
//                                 (FROM_UNIXTIME(date_time,'%Y-%m-%d'))<='$today') AND (bill_no LIKE '%$order_no%' OR customer_address LIKE '%$order_no%')";
//     $sql1 = "SELECT * FROM orders WHERE (customer_address != '' AND customer_address != 'RNG' AND customer_address != 'G12'
//     AND assigned=0 AND packed != '') AND (bill_no LIKE '%$order_no%' OR customer_address LIKE '%$order_no%')";
                                
//     $result = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

//     $myArrays = array();
//     if(mysqli_num_rows($result) > 0){
//         while($orders = mysqli_fetch_array($result)){
//             $t = date('m/d h:i A', $orders['date_time']);
//             $fon = $orders["customer_phone"];
//             $address = $orders["customer_address"];

//             $sql1 = "SELECT * FROM speftown WHERE town='$address' LIMIT 1";
//             $query_t = mysqli_query($conn, $sql1);

//             if(mysqli_num_rows($query_t) > 0){
//                 while ($dels = mysqli_fetch_array($query_t)) {
//                     $orders["bill_no"];
//                     $t;
//                     $fon;
//                     $orders["customer_address"];
//                     //$dels["del_id"];
//                     $myArrays[] = array('id' => $orders['id'], 'bill_no' => $orders['bill_no'], 'address' => $orders['customer_address'], 'date' => $t, 'delivery_id' => $dels['id'], 'phone' => $fon);
//                 }
//             }
//         }
//       if(count($myArray) > 0){
//             echo json_encode(['search' => $myArrays]);
//       } else {
//           echo '404';
//       }
//     } else {
//         die('404');
//     }
// }