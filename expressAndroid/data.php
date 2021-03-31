<?php

function get_specific_data($dbconn, $table, $col, $param, $title){
    $all = array();
    $q = mysqli_query($dbconn, "SELECT * FROM $table WHERE $col = '$param'");
    $result = mysqli_fetch_assoc($q);
    return $result[$title];
}

function get_reason($dbconn, $reasonid){
    switch(intval($reasonid)){
        case 1:
            $reason="Wrong Item";
            break;
        case 2:
            $reason="Wrong Size";
            break;
        case 3:
            $reason="Wrong Colour";
            break;
        case 4:
            $reason="Damaged Item";
            break;
        case 5:
            $reason="Customer Cancelled Order";
            break;
        default:
            $reason="Undefined!!";
            break;
    }
    return $reason;
}