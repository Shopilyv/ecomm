<?php 
session_start();
require '../database/db.php';
if(isset($_POST['logged'])){
    if(isset($_COOKIE['awsqawa'])){
        $ckie=$_COOKIE['awsqawa'];
        $ckdta=explode("_",$ckie);
        $custid=$ckdta[0];
        $now=strtotime("now");
        $sql="UPDATE customers SET logged='$now' WHERE cust_id=$custid";
        $query=mysqli_query($con,$sql);
        if($query){
            echo 'dara';
        }
        else{
           echo 'ndara';
        }
    }
    else{
        echo 'nckie';
    }
    
}
else{
    echo 'npst';
}