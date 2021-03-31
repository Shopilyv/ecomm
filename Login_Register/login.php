<?php
include "../db.php";

session_start();
include '../products/ipaddress.php';

if(isset($_POST["phone"]) && isset($_POST["password"])){
	$phone = mysqli_real_escape_string($con,$_POST["phone"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM customers WHERE phone = '$phone' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	//if user record is available in database then $count will be equal to 1
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["uid"] = $row["user_id"];
		$_SESSION["name"] = $row["first_name"];
		
		//we have created a cookie in login_form.php page so if that cookie is available means user is not login

                
			if (isset($_COOKIE["product_list"])) {
				$p_list = stripcslashes($_COOKIE["product_list"]);
				//here we are decoding stored json product list cookie to normal array
				$product_list = json_decode($p_list,true);
				for ($i=0; $i < count($product_list); $i++) { 
					//After getting user id from database here we are checking user cart item if there is already product is listed or not
					$verify_cart = "SELECT id FROM cart WHERE user_id = $_SESSION[uid] AND p_id = ".$product_list[$i];
					$result  = mysqli_query($con,$verify_cart);
					if(mysqli_num_rows($result) < 1){
						//if user is adding first time product into cart we will update user_id into database table with valid id
                                            
                                            
						$update_cart = "UPDATE cart, saved_location
                                                SET           cart.user_id = '$_SESSION[uid]',
                                                    saved_location.user_id = '$_SESSION[uid]'
                                                WHERE
                                                                cart.ip_add = '$ip_add'
                                                  AND saved_location.ip_address = '$ip_add'
                                                  AND           cart.user_id=-1
                                                  AND           saved_location.user_id=-1;
                                                  ;";
						$update_c=mysqli_query($con,$update_cart);
                                                if($update_c){
                                                    
                                                   
                              $Check_location=" SELECT towns.route,speftown.town FROM saved_location
                                                  JOIN towns ON (saved_location.route_id=towns.id)
                                                  JOIN speftown ON (saved_location.town_id=speftown.id) 
                                                  WHERE user_id='$_SESSION[uid]' ORDER BY saved_location.id DESC";  
                                                  $select_location=  mysqli_query($con, $Check_location);
                                                  $location_row=  mysqli_fetch_array($select_location);
                                                  $route=$location_row['route'];
                                                  $town=$location_row['town'];
                                                  
                                                  $update_cust="UPDATE customer_info SET address1='$route', address2='$town' WHERE user_id='$_SESSION[uid]'";
                                                  mysqli_query($con, $update_cust);
                                                }
                                                
					}else{
						//if already that product is available into database table we will delete that record
						$delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$product_list[$i];
						mysqli_query($con,$delete_existing_product);
					}
				}
				//here we are destroying user cookie
				setcookie("product_list","",strtotime("-1 day"),"/");
				//if user is logging from after cart page we will send cart_login
				header('location:payments.php');
				exit();
				
			}
			else {
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
                                                  
                                                  $update_cust="UPDATE customer_info SET address1='$route', address2='$town' WHERE user_id='$_SESSION[uid]'";
                                                 $register_update= mysqli_query($con, $update_cust);
                                                 if($register_update){
                                                     header("location: ../products/payments.php");
                                                 }
                                                 else{
                                                     echo 'Some Problem';
                                                 }
                                                 
                                                }
			    
			    
			}
			
		}else{
			header('location: ../products/Dresses.php');
			exit();
		}
	
}



?>