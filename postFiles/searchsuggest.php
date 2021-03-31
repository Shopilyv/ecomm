<?php
session_start();
require "../database/db.php";
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_COOKIE['cstln'])){
  $ip= $_COOKIE['cstln'];
}
elseif(!isset($_COOKIE['cstln'])){
    $cookie_name = "cstln";
    $cookie_value = $ip;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30*60), "/");
}
$user_id="-1";
$today=strtotime("now");
if (isset($_COOKIE['awsqawa'])) {
     $string=$_COOKIE['awsqawa'];
     $contentss=  explode("_", $string);
     $user_id=$contentss[0];
 }
$searchText = $_POST['search'];
$insql="INSERT INTO keywords (keyword,ip,user_id,date) VALUES ('$searchText','$ip','$user_id','$today')";
mysqli_query($con,$insql);

$sql = "SELECT sku,name FROM products where name like '%".$searchText."%'  GROUP BY sku order by name asc limit 5";
$result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0):

        echo 'success';
    $_SESSION['search']=$searchText;
    
    else:
    echo 'No Such items';
    
    endif;
