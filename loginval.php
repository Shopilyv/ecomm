<?php
session_start();

require 'database/db.php';

if($_POST["phone"] && $_POST["billno"]){
$phone = mysqli_real_escape_string($con, $_REQUEST['phone']);
$billno = $_POST["billno"];
$sql = "SELECT * FROM customers INNER JOIN
        orders ON (customers.phone=orders.customer_phone) 
        WHERE customers.phone = '$phone' AND orders.bill_no = '$billno' ORDER BY orders.id DESC LIMIT 1";
$run_query = mysqli_query($con,$sql);
$count = mysqli_num_rows($run_query);
	//if user record is available in database then $count will be equal to 1
        if($count == 1){
            $row = mysqli_fetch_array($run_query);
                $_SESSION["uid"] = $row["cust_id"];
		$_SESSION["name"] = $row["username"];
                $_SESSION['phone']=$row["phone"];
                
                $cookie_name = "awsqawa";
            $cookie_value = $row['cust_id']."_".$row["username"]."_".$row["phone"];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 300), "/");
                echo 'Success';;
            
        }
 else {
     
            echo 'Incorrect';
 }
}
