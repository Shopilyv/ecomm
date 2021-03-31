<?php
session_start();

require 'db.php';
include 'products/bulkSMS.php';

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST["Name"])) {
$u_name = mysqli_real_escape_string($con, $_REQUEST["Name"]);
$phone = mysqli_real_escape_string($con, $_REQUEST['Phone']);
$email = mysqli_real_escape_string($con, $_REQUEST['Email']);
$password = mysqli_real_escape_string($con, $_REQUEST['Password']);
$repassword = mysqli_real_escape_string($con, $_REQUEST['repassword']);
$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";

if(empty($u_name)|| empty($phone)|| empty($email) || empty($password) || empty($repassword)){
		
		header("location:index.php");
		exit();
	} 
        else {
            if(!preg_match($name,$u_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $u_name is not valid..!</b>
			</div>
		";
		exit();
	}
		
             if(!preg_match($number,$phone)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $phone is not valid</b>
			</div>
		";
		exit();
	}
        if(!(strlen($phone) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
			</div>
		";
		exit();
	}
        if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	}
        if(strlen($password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 7 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>password is not same</b>
			</div>
		";
	}
        //Check existing id number
        $id = "SELECT * FROM customer_info WHERE mobile = '$phone'" ;
	$check_query_id = mysqli_query($con,$id);
	$count_phne = mysqli_num_rows($check_query_id);
	if($count_phne > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>This phone number is already registered</b>
			</div>
		";
		exit();
        }
        //check email address
     
        else{
            $pword = md5($password);
 $sql = "INSERT INTO `customer_info` (`first_name`,`email`,`password`,`mobile`)
            VALUES ('$u_name','$email', '$pword','$phone');";


if(mysqli_query($con,$sql)){
$_SESSION["name"] = $u_name;
$freedel= generateRandomString();
$phone = $_POST['Phone'];
        $countryCode = "254";
        $to= preg_replace('/^0?/', '' . $countryCode, $phone);
            $from ="QueensCC";
            $text ="Hello $_SESSION[name], welcome to Queens Classy Collections.Your free delivery code is $freedel and you can use it up to 5 times.";
            sendMessage($to, $from, $text);
 header("Location:index.php");


			exit();
}
else {
    echo 'Ooops!! Something is wrong';
}

        }
        }


}
?>
