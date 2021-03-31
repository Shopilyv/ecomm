<?php
require '../database/db.php';
include '../datafunctions/headerfunc.php';
include '../headers/rando.php';
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../SMS/bulkSMS.php';

$lmark='';
$phoneNumber='';
if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){
if(isset($_SESSION['uid'])){
     $uid=$_SESSION['uid'];   
}
 elseif(isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $uid=$contentss[0];
          }
$pre_order="SELECT * FROM customers WHERE cust_id='$uid'";
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
            $lmark=$srow['LandMark'];
}
$amount=$_POST['amount'];
$delfee=$_POST['delfee'];


$select=  mysqli_query($con, $pre_order);
$row=  mysqli_fetch_array($select);

$view_sql="SELECT * FROM cart WHERE user_id='$uid'";
$view_shared=mysqli_query($con,$view_sql);

$m=0;
$discount=0;
while($shared_row=mysqli_fetch_array($view_shared)){
    
    $dis=$shared_row['discount'];
    
    $discount+=$dis;
    $store=$shared_row['shop_loc'];
    $qty=$shared_row['qty'];
    $pid=$shared_row['p_id'];
    if($store === "Online"||$store === "G12"){
      $upsql="UPDATE products SET quantity=quantity-$qty WHERE id=$pid";
      mysqli_query($con,$upsql);
    }
    else { 
         $m++; 
        $upsql="UPDATE products SET quantity1=quantity1-$qty WHERE id=$pid";
        mysqli_query($con,$upsql);
    }
}

$shared=NULL;
if($m>0){
    $shared=1;
}

$rand = new gen();
$str =  $rand->trans_id($con);

$invoice = $rand->invoice($con);
$receipt = $rand->receipt($con);

$billno=$str;
$customer=$row['username'];
if(isset($_POST['an']) && $_POST['an']!==''){
    $customer=$_POST['an'];
}
$address=$town;


$phone=$row['phone'];
$cdate=  strtotime("now");
$net=$amount;
$location="8";
$user="27";
$paid_status='0';
$partial_amount=0;
$type="cod";
if($phone!=''||$address!=''){
$sql="INSERT INTO `orders` (`bill_no`,`customer_name`,`customer_address`,customer_phone,`date_time`,`gross_amount`,`net_amount`,`o_net`,`discount`,`free_delivery`,`delfee`,`paid_status`,`user_id`,`shared`,`location`,`landmark`,`type`,`partial_amount`,`invoice_no`,`reciept_no`)
                    VALUES ('$billno','$customer','$address','$phone','$cdate','$net','$net','$net','$discount','0','$delfee','$paid_status','$user','$shared','$location','$lmark','$type','$partial_amount','$invoice','$receipt')";

$query=  mysqli_query($con, $sql) or die(mysqli_error($con));

 if ($query){
        $order_id="SELECT * FROM orders WHERE bill_no='$billno'";
        $query3 = mysqli_query($con,$order_id) or die(mysqli_error($con));
        $row=mysqli_fetch_array($query3); 
        $id=$row['id'];
        $PhoneNumber=$row['customer_phone'];
        $countryCode = "254";
        $to= preg_replace('/^0?/', '' . $countryCode, $PhoneNumber);
      $store='Online';

      

     $insert_items="INSERT INTO `orders_item` (order_id,product_id,qty,rate,amount,store)
                  SELECT '$id',p_id,qty,price,(qty*price),shop_loc FROM cart WHERE user_id='$uid'";
      $insert_cart="INSERT INTO `cart_items` (order_no,p_id,p_name,price,qty,discount,color,size,sub_t,store,town,r_price)
                 SELECT '$billno',cart.p_id,products.name,cart.price,cart.qty,cart.discount,products.colour,products.sizes,(cart.qty*cart.price),cart.shop_loc,'$address','$delfee' FROM cart INNER JOIN products ON (cart.p_id=products.id) WHERE cart.user_id='$uid'";
      
      $cart_query=mysqli_query($con,$insert_cart) or die(mysqli_error($con));       
      $run_query = mysqli_query($con,$insert_items) or die(mysqli_error($con));
              if ($run_query) {
                
            $from ="QueensCC";
            $text ="Hello $customer, your  Order reference code is $billno. You will receive your package within 24hrs.";
            sendMessage($to, $from, $text);
          $delete_cart="DELETE FROM cart WHERE ip_add='$ip_add' AND user_id='$uid';";
          $delete_preorder="DELETE FROM pre_order WHERE user_id='$uid';";
          $delete_sd="DELETE FROM saved_location WHERE user_id='$uid';";
          
          
                 $delete= mysqli_query($con,$delete_cart) or die(mysqli_error($con));
                 $delete1= mysqli_query($con,$delete_preorder) or die(mysqli_error($con));
                 $delete2= mysqli_query($con,$delete_sd) or die(mysqli_error($con));
                 if($delete && $delete1){
                     $_SESSION["phone"] = $phone;
                     $_SESSION["name"] = $customer;
                     echo 'Order Placed';
                 }
                 else {
                  echo 'items not deleted';
 }
                 
              }
 else {
                  echo 'items not inserted';
 }
     
 }
}
else{
    echo 'empty';
}