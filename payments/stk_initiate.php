<?php
session_start();
require '../database/db.php';
include '../datafunctions/ipaddress.php';
require '../headers/rando.php';
date_default_timezone_set('Africa/Nairobi');
if(isset($_COOKIE['awsqawa'])||isset($_SESSION['uid'])){
if(isset($_SESSION['uid'])){
     $uid=$_SESSION['uid'];   
}
 elseif(isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $uid=$contentss[0];
          }

if(isset($_POST["amount"])){
     
$phoneNumber = $_POST['payments'];
# access token
$consumerKey = '4tzAgbyJkpXkRlhktYRIPJB4GRR5Tv6M'; //Fill with your app Consumer Key
$consumerSecret = '3KR0FcI9iZTk4Q3U'; // Fill with your app Secret
# define the variales
# provide the following details, this part is found on your test credentials on the developer account
$BusinessShortCode = '814426';
$Passkey = 'c9f6f817928ab6bbed6cdc5c417f170c89bd2442bb61b378f30c4a2dd44dc5e2';

$countryCode = "254";
$PartyA = preg_replace('/^0?/', '' . $countryCode, $phoneNumber);
$PartyB = '498921';
$AccountReference = 'QueensCC';
$TransactionDesc = 'QUEENS';
$Amount = $_POST["amount"];

# Get the timestamp, format YYYYmmddhms -> 20181004151020
$Timestamp = date('YmdHis');

# Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
$Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

# header for access token
$headers = ['Content-Type:application/json; charset=utf8'];

# M-PESA endpoint urls
$access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

# callback url
$CallBackURL = 'https://queensclassycollections.com/payments/callback_url.php';

$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;
curl_close($curl);

# header for stk push
$stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

# initiating the transaction
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $initiate_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerBuyGoodsOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
$jsondata = json_decode($curl_response, true);

if ($curl_response) {
    $checkoutRequestID = $jsondata['CheckoutRequestID'];
    
         $name=$_POST['name'];
        if(!isset($name)||$name==''){
          $name= $phoneNumber;
        }
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
            
            $up_cust="UPDATE customers SET username='$name',location='$town' WHERE cust_id='$uid'";
            $update_cust=  mysqli_query($con, $up_cust) or die(mysqli_error($con));
          
          if($update_cust){
              if($checkoutRequestID != ''){
               $sql = "INSERT INTO `pre_order` (`user_id`,`CheckoutRequestID`,`landmark`)
                        SELECT cust_id, '$checkoutRequestID','$landmark' FROM customers WHERE cust_id='$uid'";
                        $run_query = mysqli_query($con, $sql) or die(mysqli_error($con));
        
                        if($run_query){
                            echo $checkoutRequestID;
                        }
                         else {
                            echo $checkoutRequestID." Error";
                        }
              }
              else{
                  echo 'empty';
              }
          }
 else {
              echo 'Empty data';
 }
}
 else {
    echo 'Data Empty';
}
}
    

elseif (isset($_POST["nompesa"])) {
  $routeID = $_POST['route'];
  $townID = $_POST['town'];  
  $lmark=$_POST['landmark']; 
  $date_saved=strtotime("now");
  $sql1 = "SELECT * FROM saved_location WHERE ip_address='$ip_add' AND user_id='$uid'";
  $query1 = mysqli_query($con, $sql1);
          
    $type="D";
    if(isset($_POST['type'])){
    $type=$_POST['type'];
    }
    

    if (mysqli_num_rows($query1) > 0) {
        $sql2 = "UPDATE saved_location SET ip_address='$ip_add',route_id = '$routeID', town_id = '$townID',type='$type',LandMark = '$lmark',saved_date='$date_saved' WHERE ip_address='$ip_add' OR user_id='$uid'";
        $query2 = mysqli_query($con, $sql2);
        
        if ($query2) {
            echo 'Location Updated';
        }
    } else {
         
       $sql = "INSERT INTO saved_location (ip_address,route_id, town_id,type, user_id,LandMark,saved_date) VALUES ('$ip_add','$routeID','$townID','$type','$uid','$lmark','$date_saved')";
       $query = mysqli_query($con, $sql) or die(mysqli_error($con));
        if ($query) {
            echo 'Location Saved';
        } 
    }
}

}
else{
    echo 'Logged Out';
}

?>

