<?php
error_reporting(0);
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

$uid="";
$today=date('H:i:s');
if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){
if(isset($_SESSION['uid'])){
     $uid=$_SESSION['uid'];   
}
 elseif(isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $uid=$contentss[0];
          }
}
else{
    die("Kindly Enter Phone number");
}
if(isset($_POST)){

$amount=$_POST['amount'];
$delfee=$_POST['delfee'];

$pre_order="SELECT *,customers.phone as fon,customers.location as place FROM pre_order 
INNER JOIN customers ON (customers.cust_id=pre_order.user_id)
WHERE customers.cust_id='$uid' ORDER by pre_order.pre_order_id DESC LIMIT 1";
$select=  mysqli_query($con, $pre_order);
$row=  mysqli_fetch_array($select);

$view_sql="SELECT * FROM cart WHERE user_id='$uid'";
$view_shared=mysqli_query($con,$view_sql);
if(mysqli_num_rows($view_shared)>0){
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
$str =  $rand->trans_id_pay($con);

$invoice = $rand->invoice($con);
$receipt = $rand->receipt($con);

$billno=$str;
$customer=$row['username'];
$address=$row['place'];

$lmark='';
if($row['landmark']!='' && isset($row['landmark'])){
  $lmark=$row['landmark']; 
}

$phone=$row['fon'];
$cdate=  strtotime("now");
$net=$amount;
$location="5";
$user="27";
$paid_status='1';
$partial_amount=0;
$type="mpesa";

$refid='';
$refname='';
if(isset($_COOKIE['rfr']) && isset($_COOKIE['rfrid'])){ 
    $refname= $_COOKIE['rfr'];
    $refid=$_COOKIE['rfrid'];
 }
if($phone!=''||$address!=''){
$sql="INSERT INTO `orders` (`bill_no`,`customer_name`,`customer_address`,customer_phone,`date_time`,`gross_amount`,`net_amount`,`o_net`,`discount`,`free_delivery`,`delfee`,`paid_status`,`user_id`,`shared`,`location`,`landmark`,`type`,`partial_amount`,`invoice_no`,`reciept_no`,`referrer_id`,`referrer`)
                    VALUES ('$billno','$customer','$address','$phone','$cdate','$net','$net','$net','$discount','0','$delfee','$paid_status','$user','$shared','$location','$lmark','$type','$partial_amount','$invoice','$receipt','$refid','$refname')";

$query=  mysqli_query($con, $sql) or die(mysqli_error($con));

 if ($query){
        $order_id="SELECT * FROM orders WHERE bill_no='$billno'";
        $query3 = mysqli_query($con,$order_id) or die(mysqli_error($con));
        $row=mysqli_fetch_array($query3); 
        $id=$row['id'];
        $PhoneNumber=$row['customer_phone'];
        $countryCode = "254";
        $to= preg_replace('/^0?/', '' . $countryCode, $PhoneNumber);
        
       $store='G12';

        $transid=$_POST['checkid'];
        mysqli_query($con,"INSERT INTO used (order_id,transLoID) VALUES ('$id','$transid')");
        
     $insert_items="INSERT INTO `orders_item` (order_id,product_id,qty,rate,amount,store)
                  SELECT '$id',p_id,qty,price,(qty*price),shop_loc FROM cart WHERE user_id='$uid'";
      $insert_cart="INSERT INTO `cart_items` (order_no,p_id,p_name,bprice,price,qty,discount,color,size,sub_t,store,town,r_price,date_added)
                 SELECT '$billno',cart.p_id,products.name,products.cost,cart.price,cart.qty,cart.discount,products.colour,products.sizes,(cart.qty*cart.price),cart.shop_loc,'$address','$delfee','$cdate' FROM cart INNER JOIN products ON (cart.p_id=products.id) WHERE cart.user_id='$uid'";
      
      $cart_query=mysqli_query($con,$insert_cart) or die(mysqli_error($con));       
      $run_query = mysqli_query($con,$insert_items) or die(mysqli_error($con));
              if ($run_query) {
                
            $from ="QueensCC";
            $text ="Hello $customer, your  Order reference code is $billno. You will receive your package within 24hrs.";
            sendMessage($to, $from, $text);
            
         $selcartitems="SELECT cart.p_id,cart.qty,cart.shop_loc,products.sku WHERE cart.user_id='$uid'";
         $querycart=mysqli_query($con,$selcartitems);
         
            while($itemsrow=mysqli_fetch_array($querycart)){
               $proid= $itemsrow['p_id'];
               $qntty= $itemsrow['qty'];
               $shop = $itemsrow['shop_loc'];
               $psku = $itemsrow['sku'];
               $ractivity='Sales';
               
               $insactivitylog="INSERT INTO activity_log(p_id,sku,adjustment,activity,user_id,shop,time) VALUES 
                                                    ($proid,'$psku',$qntty,'$ractivity',$uid,'$shop','$cdate')";
                $queryins=mysqli_query($con,$insactivitylog);
            }
          $delete_cart="DELETE FROM cart WHERE ip_add='$ip_add' AND user_id='$uid';";
          $delete_preorder="DELETE FROM pre_order WHERE user_id='$uid';";
          $delete_sd="DELETE FROM saved_location WHERE user_id='$uid';";
          
          
                 $delete= mysqli_query($con,$delete_cart) or die(mysqli_error($con));
                 $delete1= mysqli_query($con,$delete_preorder) or die(mysqli_error($con));
                 $delete2= mysqli_query($con,$delete_sd) or die(mysqli_error($con));
                 if($delete && $delete1){
                     if(isset($_COOKIE['rfr']) && isset($_COOKIE['rfrid'])){ 
                        setcookie('rfr', $refername, time() - (86400 * 3), "/");
                        setcookie('rfrid', $referrer, time() - (86400 * 3), "/");
                     }
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
}
}