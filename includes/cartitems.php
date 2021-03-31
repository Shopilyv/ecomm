<?php
session_start();
require '../database/db.php';
include '../datafunctions/headerfunc.php';

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	 if (isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])) {
             if(isset($_SESSION['uid'])){
            $uid=$_SESSION['uid'];   
             }
         elseif(isset($_COOKIE['awsqawa'])) {
                      $string=$_COOKIE['awsqawa'];
                      $contentss=  explode("_", $string);
                      $uid=$contentss[0];
          }
		//When user is logged in this query will execute
		$sql = "SELECT b.qty,b.price AS cprice FROM products a,cart b WHERE a.id=b.p_id AND b.user_id='$uid'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT b.qty,b.price AS cprice FROM products a,cart b WHERE a.id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0 ";
	}
	$query = mysqli_query($con,$sql);
	$n=0;
        $sum=0;
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
                    
			
                        while ($row=mysqli_fetch_array($query)) {
                            $qty=$row['qty'];
                            $product_price = $row["cprice"];
                            $total=$qty*$product_price;
                            $sum+=$total;
                            $n+=$qty;
                        }
                }
	echo $n."_".$sum;
	exit();
}

?>

<?php if (isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])) {
        if(isset($_SESSION['uid'])){
            $uid=$_SESSION['uid'];   
             }
         elseif(isset($_COOKIE['awsqawa'])) {
                      $string=$_COOKIE['awsqawa'];
                      $contentss=  explode("_", $string);
                      $uid=$contentss[0];
          }
                      $sql = "SELECT a.id,a.sku,a.name,a.price AS pprice,a.image,a.sizes,a.colour,b.id,b.qty,b.price AS cprice,b.sizes AS czises FROM products a,cart b WHERE a.id=b.p_id AND b.user_id='$uid' ORDER BY b.id DESC";
                  }
                  else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.id,a.sku,a.name,a.price AS pprice,a.image,a.sizes,a.colour,b.id,b.qty,b.price AS cprice,b.sizes AS czises FROM products a,cart b WHERE a.id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0 ORDER BY b.id DESC";
                    }
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
 $query = mysqli_query($con,$sql);
                    if (mysqli_num_rows($query) > 0) { 
                        $sum=0;
                        while ($row=mysqli_fetch_array($query)) {
					$product_id = $row["id"];
                                        $sku=$row['sku'];
					$product_title = $row["name"];
                                        $original=$row['pprice'];
					$product_price = $row["cprice"];
					$product_image = $row["image"];
					$cart_item_id = $row["id"];
                                        $qty = $row["qty"];
                                        $colour=$row['colour'];
                                        $sizes=$row["czises"];
                                        $total=$qty*$product_price;
                                        $sum+=$total;
                              if (isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])) {
                                  if(isset($_SESSION['uid'])){
                                    $uid=$_SESSION['uid'];   
                                     }
                                 elseif(isset($_COOKIE['awsqawa'])) {
                                              $string=$_COOKIE['awsqawa'];
                                              $contentss=  explode("_", $string);
                                              $uid=$contentss[0];
                                  }
                             $cart="SELECT products.per,SUM(cart.qty) AS citems FROM cart INNER JOIN products ON (cart.p_id=products.id) WHERE products.sku='$sku' AND cart.user_id='$uid' GROUP BY sku";
                              }
                              else {
                               $cart="SELECT products.per,SUM(cart.qty) AS citems FROM cart INNER JOIN products ON (cart.p_id=products.id) WHERE products.sku='$sku' AND cart.ip_add='$ip_add' GROUP BY sku";   
                              }
                             $cartq=  mysqli_query($con, $cart);
                             $per=0; $citems=0;
                             while ($row1 = mysqli_fetch_array($cartq)) {
                            $per=$row1['per'];
                            $citems=$row1['citems'];
                           
                                 }
					
                    
?>
				<div class="cart_box">
					<div class="message">
                                            <div id="<?php echo $product_id ?>" class="alert-close"> </div> 
						<div class="list_img"><img src="<?php echo $inv.$product_image ?>" class="img-responsive" alt=""/></div>
						<div class="list_desc"><h4><a href="#"><?php echo $product_title ?></a></h4>
                                                    <span class="actual variants"><?php echo $colour."-".$sizes ?></span><br/>
                                                    <span class="actual">Items: <?php echo $qty ?> x Ksh.<?php echo number_format($product_price, 2, '.', ' '); ?></span><br/>
                                                    <span class="actual">Total: Ksh.<span><?php echo number_format($total, 2, '.', ' '); ?></span></span><br/>
                                                    <span class="actual"><input type="text" class="form form-control qty" qty="<?php echo $qty ?>" sku="<?php echo $sku ?>" min="<?php echo $per ?>" itms="<?php echo $citems ?>" value="<?php echo $qty ?>" ><div update_id="<?php echo $product_id ?>" class="btn btn-success update"><span class="glyphicon glyphicon-ok-sign"></span></div></span>
                                                    <div class="" id="updt"></div>
                                                </div>
						  <div class="clear"></div>
					</div>
				</div>
                    <?php } }
                    else{  ?>
                                <div class="cart_box">
                                    <div class="message">
                                <h4>Your Cart Is Empty</h4>
                                    </div>
                                </div>
                     <?php } } ?> 
