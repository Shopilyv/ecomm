<?php

include 'db.php';

$id = filter_input(INPUT_POST, "id");

$sql = "DELETE FROM parcel WHERE bill_id = '$id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if(mysqli_affected_rows($conn) > 0){
    echo '201';
} else {
    die('500');
}