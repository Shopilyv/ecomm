<?php
 class gen{
     function trans_id($dbconn, $param='PODW-') {
        $dataMax = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT MAX( CAST(invoice_no AS UNSIGNED) ) AS ID, MAX( CAST(reciept_no AS UNSIGNED) ) AS RC  FROM orders")); // capture maximum data from id transaction
        if($dataMax['ID']=='') { // if data empty
            $ID = $param."01";

        }else {
            $MaksID = intval($dataMax['ID']);
            $MaksID++;
            $recID = intval($dataMax['RC']);
            $recID++;

            $ID =$param.$recID; 
        }
        return $ID;
    }

    function trans_id_pay($dbconn, $param='PMW-') {
        $dataMax = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT MAX( CAST(invoice_no AS UNSIGNED) ) AS ID, MAX( CAST(reciept_no AS UNSIGNED) ) AS RC  FROM orders")); // capture maximum data from id transaction
        if($dataMax['ID']=='') { // if data empty
            $ID = $param."01";

        }else {
            $MaksID = intval($dataMax['ID']);
            $MaksID++;
            $recID = intval($dataMax['RC']);
            $recID++;

            $ID =$param.$recID; 
        }
        return $ID;
    }

    function trans_id_cash($dbconn, $param='PCW-') {
        $dataMax = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT MAX( CAST(invoice_no AS UNSIGNED) ) AS ID, MAX( CAST(reciept_no AS UNSIGNED) ) AS RC  FROM orders")); // capture maximum data from id transaction
        if($dataMax['ID']=='') { // if data empty
            $ID = $param."01";

        }else {
            $MaksID = intval($dataMax['ID']);
            $MaksID++;
            $recID = intval($dataMax['RC']);
            $recID++;

            $ID =$param.$recID; 
        }
        return $ID;
    }

    function trans_id_eq($dbconn, $param='PEW-') {
        $dataMax = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT MAX( CAST(invoice_no AS UNSIGNED) ) AS ID, MAX( CAST(reciept_no AS UNSIGNED) ) AS RC  FROM orders")); // capture maximum data from id transaction
        if($dataMax['ID']=='') { // if data empty
            $ID = $param."01";

        }else {
            $MaksID = intval($dataMax['ID']);
            $MaksID++;
            $recID = intval($dataMax['RC']);
            $recID++;

            $ID =$param.$recID; 
        }
        return $ID;
    }

    function invoice($dbconn){
        $dataInvoice = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT MAX( CAST(invoice_no AS UNSIGNED) ) AS inv FROM orders"));
        if($dataInvoice['inv'] == ''){$inv = "00001";}
        else{
            $Minv = intval($dataInvoice['inv']);
            $Minv++;
            if($Minv<10) {$inv="0000".$Minv;}
            elseif($Minv<100) {$inv="000".$Minv;}
            elseif($Minv<1000) {$inv="00".$Minv;}
            else {$inv=$Minv;}
        }
        return $inv;
    }

    function receipt($dbconn){
        $dataReceipt = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT MAX( CAST(reciept_no AS UNSIGNED) ) AS rec FROM orders"));
        if($dataReceipt['rec']==''){$rec= "00001";}
        else{
            $Mrec = intval($dataReceipt['rec']);
            $Mrec++;
            if($Mrec<10) {$rec="0000".$Mrec;}
            elseif($Mrec<100) {$rec="000".$Mrec;}
            elseif($Mrec<1000) {$rec="00".$Mrec;}
            else{ $rec=$Mrec;}
        }
        return $rec;
    }
 }

?>