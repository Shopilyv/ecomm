<?php

class Gen{
    function get_payment_method($conn, $bill){
        $sql = "SELECT * FROM orders WHERE bill_no = '$bill'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $payment = "";
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if (strstr($row['bill_no'], "PC")) {
                $payment = "cash";
            } else if (strstr($row['bill_no'], "PM")) {
                $payment = "mpesa";
            } else if (strstr($row['bill_no'], "PCOD")) {
                $payment = "cod";
            } else if (strstr($row['bill_no'], "PEQ")) {
                $payment = "equity";
            }

            return $payment;
        }
    }
    
    function get_order_id($conn, $bill_no){
        $query = mysqli_query($conn, "SELECT * FROM orders WHERE bill_no = '$bill_no'") or die(mysqli_error($conn));
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_array($query);
            $id = $row['id'];
            return $id;
        }
    }
    
    function get_specific_data($conn, $table, $col, $param, $title){
        $all = array();
        $q = mysqli_query($conn, "SELECT * FROM $table WHERE $col = '$param'");
        $result = mysqli_fetch_assoc($q);
        return $result[$title];
    }
    
    function insert_receipt($conn, $bill_id, $pic, $status){
        $sql = "UPDATE parcel SET status = '$status', receipt = '$pic' WHERE bill_id = '$bill_id'";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($res){
            echo '201';
        } else { 
            die('500');
        }
    }
    
    function base64_to_image($base64_string, $outputfile){
        $file = fopen($outputfile, "wb");
        $data = explode(',', $base64_string);
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        return $outputfile;
    }
}