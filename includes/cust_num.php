<?php
session_start();
require '../database/db.php';
include '../datafunctions/ipaddress.php';

$phoneNumber=$_POST['phone'];

if(isset($phoneNumber)){
    $customer="SELECT * FROM customers WHERE phone='$phoneNumber'";
    $cus_query=  mysqli_query($con, $customer);
    if(mysqli_num_rows($cus_query)>0){
        while ($row = mysqli_fetch_array($cus_query)) {
            $cookie_name = "awsqawa";
            $cookie_value = $row['cust_id']."_".$row["username"]."_".$row["phone"];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            
          $_SESSION["uid"]=$row['cust_id']; 
          $_SESSION["name"] = $row["username"];
          $_SESSION['phone']=$row["phone"];
          
          $update_cart = "UPDATE cart SET   user_id = '".$row['cust_id']."'  WHERE ip_add = '$ip_add'";
          $upcart=  mysqli_query($con, $update_cart);
          
          $update_key = "UPDATE keywords SET user_id = '".$row['cust_id']."'  WHERE ip = '$ip_add'";
          mysqli_query($con, $update_key);
          
          if($upcart){
              echo 'success';  
          }
       
        }
    }
    else{
        
        $name= $phoneNumber;
        
        
        $ins_cust="INSERT INTO customers(username,phone,avatar) VALUES ('$name','$phoneNumber','default.jpg')";
        
                $run_query = mysqli_query($con,$ins_cust) or die(mysqli_error($con));
                $_SESSION["uid"] = mysqli_insert_id($con);
        
                $sess=$_SESSION["uid"];
                $_SESSION["name"] = $name;
                $_SESSION['phone']=$phoneNumber;
          
                $cookie_name = "awsqawa";
                $cookie_value = $_SESSION["uid"]."_".$name."_".$phoneNumber;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                if($run_query){
		$register_sql = "UPDATE cart SET  user_id = '$sess' WHERE ip_add = '$ip_add' AND user_id=-1";
		
                $update_c=mysqli_query($con,$register_sql);
                 if($update_c){
                    echo 'success';   
          }
       
        }
                
	}
}
    