<?php
session_start();
require '../database/db.php';
date_default_timezone_set("Africa/Nairobi");

if(isset($_POST)){
    $times=$_POST['timesrun'];
    if($times==10){
        $countryCode = "254";
        $phon=$_POST['phone'];
        $phone = preg_replace('/^0?/', '' . $countryCode, $phon);
        
        $view_sql="SELECT * FROM mobile_payments WHERE MSISDN='$phone' ORDER BY transLoID DESC LIMIT 1";
        $view_query=mysqli_query($con,$view_sql);
        if(mysqli_num_rows($view_query)>0){
            while ($row = mysqli_fetch_array($view_query)) {
               $str=  strtotime($row['TransTime']);
               $date=date('Y-m-d',$str);
               $today=date('Y-m-d');
               $transid=$row['transLoID'];
               
               if($date==$today){
                  $usedql="SELECT * FROM used WHERE transLoID='$transid' ORDER BY id DESC LIMIT 1";
                  $used_query=  mysqli_query($con, $usedql);
                  if(mysqli_num_rows($used_query)>0){
                   echo 'Not Received';
                   $_SESSION['unpaid']="(Payment Not Received)";   
                  }
                else {
                        echo 'Payment Successful_'.$transid;
               }
                  
                  
               }
            else {
                    echo 'Not Received';
                   $_SESSION['unpaid']="(Payment Not Received)"; 
           }
               
               
            }
        }
        else{
        
        
        echo 'Not Received';
        $_SESSION['unpaid']="(Payment Not Received)";
        }
    }
    else{
    $mpesa=$_POST['mpesa'];
    $sql="SELECT * FROM payments_table INNER JOIN mobile_payments ON(payments_table.MpesaReceipt=mobile_payments.TransID) WHERE CheckoutRequestID='$mpesa'";
    
    $query=  mysqli_query($con, $sql) or die(mysqli_error($con));
    if(mysqli_num_rows($query)>0){
    while($row=  mysqli_fetch_array($query)){
    $checkoutRequestID=$row['CheckoutRequestID'];
    if($checkoutRequestID==$mpesa){
        echo 'Payment Successful_'.$row['transLoID'];
        if(isset($_SESSION['unpaid'])){
            unset($_SESSION['unpaid']); 
        }
    }
 else {
       echo 'Checking..'; 
    }
    }
    }
    else {
       echo 'Checking..'; 
    }
    }
}
 else {
    echo 'Please Pay';
}
