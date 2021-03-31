<?php

include 'db.php';
include 'data.php';

$riderid =  filter_input(INPUT_POST, "id");
$username = get_specific_data($conn, 'users', 'id', $riderid, 'username');
$i = 1;
$sql = "SELECT * FROM returns WHERE (stocked=0 OR stocked IS NULL) AND username='" . $username . "' ORDER BY id DESC LIMIT 50";
$result =  mysqli_query($conn, $sql);
$myArray= array();

if(mysqli_num_rows($result) > 0){
    while ($returns =  mysqli_fetch_array($result)) {
        $myArray[] = array('order' => $returns["bill_no"], 'name' => $returns["name"], 'color' => $returns["colour"], 'size' => $returns["size"], 'contacts' => $returns["customer_contacts"], 'delivery' => $returns["delivery"], 'reason' => get_reason($conn, $returns["reason"]));
    }
    echo json_encode(['returns' => $myArray]);
} else {
    die('404');
}