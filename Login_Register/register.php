<?php
session_start();
include "../db.php";
include '../products/bulkSMS.php';

include '../products/ipaddress.php';

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
        
        $emailcheck=NULL;
        $email = $_POST['email'];
        if(isset($email)){
           $emailcheck= $email;
        }
        
	
	$mobile = $_POST['mobile'];
        $countryCode = "254";
        $to= preg_replace('/^0?/', '' . $countryCode, $mobile);
        
        $password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

if(empty($f_name) || empty($password) || empty($repassword) ||empty($mobile)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='register_form.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} 

		elseif(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $f_name is not valid..!</b>
			</div>
		";
		exit();
	}

	elseif(strlen($password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	elseif(strlen($repassword) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	elseif($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>password is not same</b>
			</div>
		";
	}
	elseif(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $mobile is not valid</b>
			</div>
		";
		exit();
	}
	elseif(!(strlen($mobile) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
			</div>
		";
		exit();
	}
	//existing email address in our database
	$sql = "SELECT * FROM customers WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Email Address is already available Try Another email address</b>
			</div>
		";
		exit();
	} 
     $sql4="SELECT * FROM customers WHERE phone='$mobile' AND password IS NULL";
     $check_customer = mysqli_query($con,$sql4);
     $freedel= generateRandomString();
     $password = md5($password);
     if(mysqli_num_rows($check_customer)==1){
             
         
         while ($row = mysqli_fetch_array($check_customer)) {
         $sql="UPDATE customers 
        SET `username`='$f_name',`email`='$emailcheck',password='$password' 
        WHERE phone='$mobile' AND password IS NULL";
             
             
        $_SESSION["uid"] = $row["cust_id"];
	$_SESSION["name"] = $row["username"];
        $_SESSION['phone']=$mobile;
        /* $from ="QueensCC";
            $text ="Hello $_SESSION[name], welcome to Queens Classy Collections.Your free delivery code is $freedel and you can use it up to 5 times.";
            sendMessage($to, $from, $text);*/
             
         }
     }
        else {
             
            
            
		
		$sql = "INSERT INTO `customers` 
		(`username`, `phone`, 
		`password`, `email`) 
		VALUES ('$f_name', '$mobile', 
		'$password', '$emailcheck')";
		
                
                
		$_SESSION["uid"] = mysqli_insert_id($con);
		$_SESSION["name"] = $f_name;
		
                /* $from ="QueensCC";
            $text ="Hello $_SESSION[name], welcome to Queens Classy Collections.Your free delivery code is $freedel and you can use it up to 5 times.";
            sendMessage($to, $from, $text);*/
        }     
        $run_query = mysqli_query($con,$sql) or die(mysqli_error($con));
                if($run_query){
		$register_sql = "UPDATE cart, saved_location 
                        SET           
                            cart.user_id = '$_SESSION[uid]',
                            saved_location.user_id = '$_SESSION[uid]'
                        WHERE
                            cart.ip_add = '$ip_add'
                        AND 
                            saved_location.ip_address = '$ip_add'
                        AND 
                            cart.user_id=-1
                        AND 
                            saved_location.user_id=-1";
		
                $update_c=mysqli_query($con,$register_sql);
                                                if($update_c){
                              $Check_location=" SELECT towns.route,speftown.town FROM saved_location
                                                  JOIN towns ON (saved_location.route_id=towns.id)
                                                  JOIN speftown ON (saved_location.town_id=speftown.id) 
                                                  WHERE user_id='$_SESSION[uid]' ORDER BY saved_location.id DESC LIMIT 1";  
                                                  $select_location=  mysqli_query($con, $Check_location);
                                                  $location_row=  mysqli_fetch_array($select_location);
                                                  $route=$location_row['route'];
                                                  $town=$location_row['town'];
                                                  
                                                  $update_cust="UPDATE customers SET location='$town' WHERE cust_id='$_SESSION[uid]'";
                                                 $register_update= mysqli_query($con, $update_cust);
                                                 if($register_update){
                                                     header("location: ../products/Dresses.php");
                                                 }
                                                 
                                                }
	}
 else {
            echo 'Bado';
 }
        
	
	
}



?>






















































