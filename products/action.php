<?php
session_start();

include "../database/db.php";
include '../datafunctions/headerfunc.php';

//$computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT'].$_SERVER['REMOTE_ADDR'];
//$ip_add=md5($computerId);
if(isset($_POST["addToCart"])){
		$price=$_POST['price'];
		$location=$_POST['store'];
                $discount=(int)$_POST['discount'];

		$p_id = $_POST["select"];
		$sizes= $_POST["select1"];

		if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){

		 if(isset($_SESSION['uid'])){
                $user_id=$_SESSION['uid'];   
           }
            elseif (isset($_COOKIE['awsqawa'])) {
                         $string=$_COOKIE['awsqawa'];
                         $contentss=  explode("_", $string);
                         $user_id=$contentss[0];
                     }

		$sql = "SELECT id FROM cart WHERE  user_id ='$user_id' AND p_id=$p_id";
			$qur = mysqli_query($con,$sql) or die(mysqli_error($con));
			if (mysqli_num_rows($qur)<1) {
			
			$sql = "INSERT INTO `cart`
			(`p_id`,`price`,`discount`, `ip_add`, `user_id`, `qty`,`sizes`,`shop_loc`) 
			VALUES ('$p_id','$price',$discount,'$ip_add','$user_id','1','$sizes','$location')";
			$insert=mysqli_query($con,$sql) or die(mysqli_error($con));
			if ($insert) {
				echo "ADDED!";
			}
                        exit();
			}
			
			else {
			    	echo "IN THE BAG!";
					}
		}elseif(!isset($_SESSION["uid"])){
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$qur = mysqli_query($con,$sql) or die(mysqli_error($con));
			if (mysqli_num_rows($qur)<1) {
			
			$sql = "INSERT INTO `cart`
			(`p_id`,`price`,`discount`,`ip_add`, `user_id`, `qty`,`sizes`,`shop_loc`) 
			VALUES ('$p_id','$price',$discount,'$ip_add','-1','1','$sizes','$location')";
			$insert=mysqli_query($con,$sql) or die(mysqli_error($con));
			if ($insert) {
				echo "Added";
			}
			}
			
			else {
			    	echo "In Cart";
					}
		}
                else{
                    echo 'outererror';
                }
		
		
		
		
	}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	 if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){

	if(isset($_SESSION['uid'])){
             $user_id=$_SESSION['uid'];   
           }
            elseif (isset($_COOKIE['awsqawa'])) {
                         $string=$_COOKIE['awsqawa'];
                         $contentss=  explode("_", $string);
                         $user_id=$contentss[0];
                     }
		//When user is logged in this query will execute
		$sql = "SELECT a.id,a.name,a.price,a.image,a.sizes,a.colour,b.id,b.qty FROM products a,cart b WHERE a.id=b.p_id AND b.user_id='$user_id'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.id,a.name,a.price,a.image,a.sizes,a.colour,b.id,b.qty,b.sizes FROM products a,cart b WHERE a.id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0 ";
	}
	$query = mysqli_query($con,$sql);
	$n=0;
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
                    
			
                        while ($row=mysqli_fetch_array($query)) {
                            $qty=$row['qty'];
                            $n+=$qty;
                        }
                }
	echo $n;
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	 if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){

	if(isset($_SESSION['uid'])){
             $user_id=$_SESSION['uid'];   
           }
            elseif (isset($_COOKIE['awsqawa'])) {
                         $string=$_COOKIE['awsqawa'];
                         $contentss=  explode("_", $string);
                         $user_id=$contentss[0];
                     }
		//When user is logged in this query will execute
		$sql = "SELECT a.id,a.name,a.price,a.image,a.sizes,a.colour,b.id,b.qty FROM products a,cart b WHERE a.id=b.p_id AND b.user_id='$user_id'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.id,a.name,a.price,a.image,a.sizes,a.colour,b.id,b.qty,b.sizes FROM products a,cart b WHERE a.id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0 ";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			while ($row=mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["id"];
				$product_title = $row["name"];
				$product_price = $row["price"];
				$product_image = $row["image"];
				$cart_item_id = $row["id"];
                                $sizes=$row["sizes"];
                                $colour=$row["colour"];
				$qty = $row["qty"];
				echo '
					<div class="row cartitems" r_id="'.$product_id.'"  id="myDiv">
						<div class="col-md-3">
                                                    <img class="img-responsive" src="../../queensinv/'.$product_image.'" />
                                                </div>
                                                <div class="col-md-7" style="padding-left:0">
                                                    <div class="col-md-8">'.$product_title.'</div>
                                                        <div class="col-md-8">'.$sizes.'</div>
                                                    <div class="col-md-8">Ksh.'.$product_price.'</div>
                                                        <div class="col-md-8"><div class="col-md-6" style="padding-left:0px">Quantity:</div><div class="col-md-6"><input type="text" name="qty" value="'.$qty.'" class="form-control update" update_id="'.$product_id.'"></div></div>
                                                            
                                                        <div class="col-md-6">
                                                            <i class="btn-danger glyphicon glyphicon-remove delete" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="col-md-6">
                                                         <i class="btn-success  glyphicon glyphicon-ok updatecart" aria-hidden="true"></i>
                                                        </div><br/>
                                                        <div class="updates"></div>
                                                      
                                                </div>
                                                
                                                  
                                               
					</div>'
                                ;
				
			}
			
			exit();
		}
                else{
                    echo 'Your Bag is Empty';
                }
	}

	
	
}



if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
        $postdiff=$_POST['postdiff'];
        $sku=$_POST['sku'];
	if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){

	if(isset($_SESSION['uid'])){
             $user_id=$_SESSION['uid'];   
           }
            elseif (isset($_COOKIE['awsqawa'])) {
                         $string=$_COOKIE['awsqawa'];
                         $contentss=  explode("_", $string);
                         $user_id=$contentss[0];
                     }
                     
         if($postdiff=="min" && $sku !=""){
            $upca="UPDATE cart
                    INNER JOIN products ON cart.p_id = products.id
                    SET cart.price = products.price
                    WHERE sku='$sku' AND user_id='$user_id'";
             $updatenow=mysqli_query($con, $upca) or die(mysqli_error($con));
        }
                     
		$sql = "DELETE FROM cart WHERE id = ".$remove_id." AND user_id = '$user_id'";
	}else{
		$sql = "DELETE FROM cart WHERE id = ".$remove_id." AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is removed from cart</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = (int)$_POST["qty"];
    $postdiff=$_POST['postdiff'];
    $sku=$_POST['sku'];
 $prosql="SELECT products.quantity,products.quantity1 FROM cart INNER JOIN products ON(cart.p_id=products.id) WHERE cart.id='$update_id'";   
 $proquery=mysqli_query($con,$prosql);
 $row=mysqli_fetch_array($proquery);
 $q=$row['quantity'];
 $q1=$row['quantity1'];
 if($q==''){
     $q=0;
 }
 if($q1==''){
     $q1=0;
 }
 $tqty=$q+$q1;
 
 if($qty<=$tqty && $qty>0){
    
    if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){

	if(isset($_SESSION['uid'])){
             $user_id=$_SESSION['uid'];   
           }
            elseif (isset($_COOKIE['awsqawa'])) {
                         $string=$_COOKIE['awsqawa'];
                         $contentss=  explode("_", $string);
                         $user_id=$contentss[0];
                     }
		$sql = "UPDATE cart SET qty='$qty' WHERE id = '$update_id' AND user_id = '$user_id'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE id = '$update_id' AND ip_add = '$ip_add'";
	}
         if($postdiff=="min" && $sku !=""){
            $upca="UPDATE cart
                    INNER JOIN products ON cart.p_id = products.id
                    SET cart.price = products.price
                    WHERE sku='$sku' AND user_id='$user_id'";
             $updatenow=mysqli_query($con, $upca) or die(mysqli_error($con));
        }
	if(mysqli_query($con,$sql)){
		echo "Product is updated";
		exit();
	}
        
}
else{
    echo 'Quantity not available';
}

}


?>


              






