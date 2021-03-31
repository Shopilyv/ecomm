<?php

include 'db.php';

$order_no = filter_input(INPUT_POST, "code");

if (!empty($transLoID)) {
    $sql = "SELECT * FROM mobile_payments WHERE TransID LIKE '%$transLoID%'";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $transid = "";
    $usedTransLoID = "";
    $used = false;
    $exists = false;
    $non_existing = false;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $tranid = $row['transLoID'];
            $query = mysqli_query($conn, "SELECT * FROM used WHERE transLoID = '$tranid'");
            if (mysqli_num_rows($query) > 0) {
                $used = true;
            } else {
                $exists = true;
            }
        }
    } else {
        $non_existing = true;
    }
    if ($exists) {
        echo '201';
    } else if ($used) {
        echo '403';
    } else if ($non_existing) {
        echo '500';
    }
}