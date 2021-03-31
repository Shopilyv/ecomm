<?php
require '../database/db.php';
if(isset($_POST)){
    $suggestion=$_POST['suggestion'];
    $phone     =$_POST['phone'];
    $time=  strtotime("now");
    
   $sql="INSERT INTO cust_suggestions (suggestion,phone_number,date) VALUES ('$suggestion','$phone','$time')";
    $query=  mysqli_query($con, $sql) or die(mysqli_error($con));
    
    if($query){
        echo 'Submitted';
    }
    else{
        echo 'Not Submitted';
    }
}

