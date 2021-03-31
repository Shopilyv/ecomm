<?php
require '../database/db.php';
session_start();
if(!isset($_COOKIE['awsqawa']) && !isset($_SESSION['uid'])){
    header("location:../index");
}
 if(isset($_SESSION['uid'])){
     $user_id=$_SESSION['uid'];
  $phone = $_SESSION["phone"];
  $customer =$_SESSION["name"];   
}
 elseif (isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $user_id=$contentss[0];
              $phone=$contentss[2];
          }

date_default_timezone_set("Africa/Nairobi");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST["discount"]) && !empty($_POST["discount"])){
     $code=$_POST["discount"];
     $amount=$_POST['amount'];
     $items=$_POST['items'];
     
     $sql="SELECT * FROM discounts WHERE discount_code='$code' ORDER BY Code_id DESC LIMIT 1";
     $run_query = mysqli_query($con,$sql);
     
     $count = mysqli_num_rows($run_query);
  if($count == 1){
      $row=  mysqli_fetch_array($run_query);
      
      $now=date('Y-m-d H:i:s');
      $t=$row['startdate']; $start=date('Y-m-d H:i:s',$t);
      $ad=$row['enddate'];  $end=date('Y-m-d H:i:s',$ad);
      
      if($now>=$start && $now<=$end){
      $lower_lim=$row['Min_quantity_req'];
      $limtype=$row['min_type'];
      
      $minattained=0;
      if($limtype=="items"){
        $minattained  = $items;
      }
      elseif($limtype=="amount"){
         $minattained  = $amount; 
      }
      
      $limit=$row['Usage_limits'];
      
      
          $times=0;
          if($minattained>=$lower_lim){
              
      $sql="SELECT * FROM discounts_used WHERE discount_code='$code' AND user_id='$user_id'";
     $used_query = mysqli_query($con,$sql);
     $count = mysqli_num_rows($used_query);
     if($count < 1){
        $sql1 = "INSERT INTO `discounts_used` (`user_id`, `discount_code`,times) VALUES ('$user_id', '$code','1')";
    }
     else if($count >0){
         $drows=  mysqli_fetch_array($used_query);
         $times=$drows['times'];
         if($times<$limit||$limit<1){
        $sql1="UPDATE discounts_used SET times=times+1 WHERE discount_code='$code' AND user_id='$user_id'";
         }
         else{
             echo 'Limit Exceeded';
         }
     }
     
     if($times<$limit||$count < 1||$limit<1){
     $d_query = mysqli_query($con,$sql1);
        if($d_query){
            $type=$row['Type'];
            if($type=='2'){
                $percent=(int)$row['value'];
                if($percent==''||is_null($percent)){
                   $percent=0; 
                }
                
                $update_c="UPDATE cart
                        INNER JOIN products ON cart.p_id = products.id
                        SET cart.price = products.price-(($percent/100)*products.price)
                        WHERE user_id='$user_id'";
                $query= mysqli_query($con,$update_c) or die(mysqli_error($con));
                if($query){
                    echo 'Success';
                }
                else{
                    echo 'Not Now';
                }
                
            }
            elseif($type=='1'){
            echo 'free';
            }
        }
        else {
            echo 'Fail';
            
        }
          }
      }
      else{
          $echo="Less Amount";
          if($limtype=="items"){
        $echo="Less Items";
      }
       echo $echo;   
      }

  }
  else{
      echo 'Expired';
  }
        }
  else{
      $sql="SELECT * FROM products WHERE discode='$code' GROUP BY sku";
      $query=  mysqli_query($con, $sql);
      if(mysqli_num_rows($query)>0){
          $n=0;
         while ($row = mysqli_fetch_array($query)) {
             $per=$row['per']; 
             $sku=$row['sku'];
             $discprice=$row['dprice'];
             $cart="SELECT *,SUM(cart.qty) AS citems FROM cart INNER JOIN products ON (cart.p_id=products.id) WHERE products.sku='$sku' AND cart.user_id='$user_id' GROUP BY sku";
             $cartq=  mysqli_query($con, $cart);
            while ($row1 = mysqli_fetch_array($cartq)) {
            $pid=$row1['p_id'];
            $citems=$row1['citems'];
            if($citems>=$per){
               
                 $upca="UPDATE cart
                        INNER JOIN products ON cart.p_id = products.id
                        SET cart.price = products.dprice
                        WHERE sku='$sku' AND user_id='$user_id'";
                 $updatenow=mysqli_query($con, $upca) or die(mysqli_error($con));
                 if($updatenow){
                     $n=1; 
                 }
            }
                 }
                 
             
             
          }
          if($n==1){
                 echo 'Success';
             }
             else{
                 echo 'Not Applied';
             }
      }
        else {
      echo 'Incorrect';
            }
  }
 }
 

