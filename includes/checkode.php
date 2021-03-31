<?php
session_start();
require '../database/db.php';
include '../datafunctions/ipaddress.php';
require '../headers/rando.php';

if(isset($_COOKIE['awsqawa'])||isset($_SESSION['uid'])){
if(isset($_SESSION['uid'])){
     $uid=$_SESSION['uid'];   
}
 elseif(isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $uid=$contentss[0];
          }
   
if (isset($_POST['phone']) && isset($_POST['code']) && isset($_POST['name'])) {
       $name=$_POST['name'];
       $code=$_POST['code'];
       $phone=$_POST['phone'];
       $orderamount=$_POST['ocost'];
       $countryCode = "254";
       $contact = preg_replace('/^0?/', '' .$countryCode, $phone);
       
       $checkpesa="SELECT * FROM mobile_payments WHERE TransID='$code' AND MSISDN='$contact' ORDER BY transLoID DESC LIMIT 1";
       $checkquery=  mysqli_query($con, $checkpesa) or die(mysqli_error($con));
       
       if(mysqli_num_rows($checkquery)>0){
           $mps=  mysqli_fetch_array($checkquery);
           $transid=$mps['transLoID'];
           $amount=$mps['TransAmount'];
           if($amount>=$orderamount){
           $cu="SELECT * FROM used WHERE transLoID='$transid' LIMIT 1";
           $cuquery=  mysqli_query($con, $cu);
           
          if(mysqli_num_rows($cuquery)<1){
           
           
          $savedql="SELECT * FROM saved_location  WHERE user_id='$uid' ORDER BY saved_location.id DESC LIMIT 1";
           $query_saved=  mysqli_query($con, $savedql) or die(mysqli_error($con));
           $srow=  mysqli_fetch_array($query_saved);
              
             
              $tid=$srow['town_id'];
              $type=$srow['type'];
              
              if($type=="D"){
              $location="SELECT * FROM speftown INNER JOIN towns ON (speftown.town_id=towns.id) WHERE speftown.id=$tid";
              }
              elseif($type=="P"){
                $location="SELECT * FROM county_towns INNER JOIN counties ON (county_towns.county_id=counties.id) WHERE county_towns.id=$tid";  
              }
              
              $loc_query=  mysqli_query($con, $location);  
              $drop = mysqli_fetch_array($loc_query);
              
            $town=$drop['town'];
            $landmark=$srow['LandMark'];
            $custname=str_replace("'","",$name);
            $custphone=str_replace("'","",$phone);
            $up_cust="UPDATE customers SET username='$custname',location='$town' WHERE phone='$custphone'";
            $update_cust=  mysqli_query($con, $up_cust) or die(mysqli_error($con));
          
          if($update_cust){
             
               $sql = "INSERT INTO `pre_order` (`user_id`,`landmark`)
                        SELECT cust_id,'$landmark' FROM customers WHERE cust_id='$uid'";
                        $run_query = mysqli_query($con, $sql) or die(mysqli_error($con));
        
                        if($run_query){
                            echo 'Payment Successful_'.$transid;
                        }
                         else {
                            echo 'Not Inserted';
                        }
             
          }
 else {
              echo 'Not Updated';
 }
       }
       else {
         echo 'Already Used';  
       }
       }
       else{
           echo 'Less Amount';
       }
}
else {
    echo 'Non existent code';
}
}
 else {
    echo 'Empty Data';
}



}
else{
    echo 'Logged Out';
}

?>

