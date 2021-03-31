
<?php
require 'db.php';
include 'ipaddress.php';
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>jumpsuits</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Qcc,Queensclassy,QueensCollections,QueensClassyCollections,Queens Classy Collections,Queens Classy" />

<?php include 'headerincludes.php';?>

	
<div class="banner1">
			<div class="container">
				<h3><a href="index.html">Home</a> / <span><?php echo $_POST['search']; ?></span></h3>
			</div>
		</div>
<div class="container-fluid">
		
<div class="row">
			

			
                      
			
<div class="col-md-8 col-xs-12">
				
    <div class="row">
					
<div class="col-md-12 col-xs-12" id="product_msg">
					
</div>
				</div>
				
<div class="panel panel-info">
					
<div class="panel-heading">Products</div>
					
<div class="panel-body">
						
<?php
if(isset($_POST["search"])!=""){
		$q = $_POST["search"];
		$sql = "SELECT *,SUM(quantity+quantity1+quantity2) AS summation FROM products WHERE image !='<p>You did not select a file to upload.</p>' AND name LIKE '%$q%' OR price LIKE '%$q%' OR colour LIKE '%$q%' OR sizes LIKE '%$q%'  GROUP BY sku ORDER BY summation";
	
	
	$run_query = mysqli_query($con,$sql);
if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id'];
			$pro_cat   = $row['category_id'];
			$pro_title = $row['name'];
                        
			$pro_price = $row['price'];
                        $dprice    = $row['dprice'];
                        
			$pro_image = $row['image'];
                             $colour=$row['colour'];
                              $sizes=$row['sizes'];
                              $sku=$row['sku'];
                              $stock_status=$row['stock_status'];
                              $qty=$row['qty'];
                             
                                   $nem=$pro_title;
                                $strlen=strlen($nem);
                                
                                if($strlen>23){
                                $nem = substr($pro_title, 0, 23)."..";
                                }
                                
                                $amount=$pro_price;
                                    $discount=0;
                                    $del="";
                                    $status="New";
                                    if($pro_price>$dprice){
                                      $amount = $dprice;
                                      $discount= $pro_price-$dprice;
                                      $del="<del>Ksh.".$pro_price."</del>  ";
                                    }
                                
                               
                       
			echo '<div class="col-md-3 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="../../queensinv/'.$pro_image.'" alt="" class="pro-image-front">
										<img src="../../queensinv/'.$pro_image.'" alt="" class="pro-image-back">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="similar_products.php?id='.$pro_id.'" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
											<span class="product-new-top">New</span>
											
									</div>
									<div class="item-info-product ">
										<h4><a href="similar_products.php?id='.$pro_id.'">'.$nem.'</a></h4>';
										echo '<div class="info-product-price">'.$del.'
											Ksh.<span class="item_price">'.$amount.'</span>
										</div>
										<div class="kolas">
										';
                                                                                  $sql1="SELECT * FROM products WHERE sku='$sku' AND image !='<p>You did not select a file to upload.</p>' GROUP BY colour";
                                                                                    $query1=  mysqli_query($con, $sql1);  
                                                                                    $n=0;
                                                                                    $max=3;
                                                                                   $kolas=mysqli_num_rows($query1);
                                                                                   $rem=$kolas-$max;
                                                                                   
                                                                                   $view= '';
                                                                                   if($kolas>3){
                                                                                       if($rem>1){
                                                                                       $view .='<a class="text-mor" href="similar_products.php?id='.$pro_id.'">'.$rem.' More Colours</a>';
                                                                                       }
                                                                                       elseif($rem==1){
                                                                                       $view .='<a class="text-mor" href="similar_products.php?id='.$pro_id.'">'.$rem.' More Colour</a>';
                                                                                       }
                                                                                   }
                                                                                   
                                                                                    while ($row1 = mysqli_fetch_array($query1) and $n<$max) {
                                                                                       $colour_group=$row1['colour_group']; 
                                                                                       $product_id    = $row1['id'];
                                                                                       $n++;
                                                                                     
                                                                                      
                                                                                       if($colour_group=='1'){
                                                                                           echo '<a href="similar_products.php?id='.$product_id.'"><span id="red" class="dot"></span></a>';
                                                                                       }
                                                                                       elseif($colour_group=='2'){
                                                                                          echo '<a href="similar_products.php?id='.$product_id.'"><span id="green" class="dot"></span></a>'; 
                                                                                       }
                                                                                       elseif($colour_group=='3'){
                                                                                           echo '<a href="similar_products.php?id='.$product_id.'"><span id="blue" class="dot"></span></a>';
                                                                                       }
                                                                                       elseif($colour_group=='4'){
                                                                                          echo '<a href="similar_products.php?id='.$product_id.'"><span id="black" class="dot"></span></a>'; 
                                                                                       }
                                                                                       elseif($colour_group=='5'){
                                                                                          echo '<a href="similar_products.php?id='.$product_id.'"><span id="orange" class="dot"></span></a>'; 
                                                                                       }
                                                                                       elseif($colour_group=='6'){
                                                                                          echo '<a href="similar_products.php?id='.$product_id.'"><span id="indigo" class="dot"></span></a>'; 
                                                                                       }
                                                                                       elseif($colour_group=='7'){
                                                                                          echo '<a href="similar_products.php?id='.$product_id.'"><span id="violet" class="dot"></span></a>'; 
                                                                                       }
                                                                                       elseif($colour_group=='8'){
                                                                                         echo '<a href="similar_products.php?id='.$product_id.'"><span id="pink" class="dot"></span></a>';  
                                                                                       }
                                                                                       elseif($colour_group=='9'){
                                                                                         echo '<a href="similar_products.php?id='.$product_id.'"><span id="white" class="dot"></span></a>';  
                                                                                       }
                                                                                       elseif($colour_group=='10'){
                                                                                         echo '<a href="similar_products.php?id='.$product_id.'"><span id="yellow" class="dot"></span></a>';  
                                                                                       }
                                                                                       
                                                                                    }
                                                                                    
										echo '</br/>'.$view.'
										</div>
										<div class="">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" disc="'.$discount.'" prod_id="" size="">
                                                          BUY NOW
                                                        </button>
                                                        <div class="dd">
                                                        <div class="sizesheader"><h4>Select Size</h4></div>
                                                        <ul>';
                                 $sql3="SELECT * FROM products where `name`='$pro_title' AND colour='$colour' AND image !='<p>You did not select a file to upload.</p>' GROUP BY sizes";
                                                        $query6=  mysqli_query($con, $sql3);
                                                          foreach ($query6 as $row){
                                                         $sizes=$row['sizes'];
                                                         $colour=$row['colour'];
                                                         $id=$row['id'];
                                                         $quantity=$row['quantity']+$row['quantity1']+$row['quantity2'];
                                                         
                                                          $q= $row['quantity'];
                                                        $q1= $row['quantity1'];
                                                        $q2= $row['quantity2'];
                                                        
                                                        if($q2>0){
                                                            
                                                            $store= "Online";
                                                        }
                                                        elseif($q>0){
                                                            $store="G12";
                                                        }
                                                        elseif($q1>0){
                                                            
                                                            $store="RNG";
                                                        }
                                                        
                                                        
                                                    $sql4="SELECT * FROM cart WHERE p_id='$id' AND ip_add='$ip_add'"; 
                                                    $query7=  mysqli_query($con, $sql4);
                                                         if($quantity<1){
                                                             echo '
                                                                  <li id="" class="list_size" href="#" pro_id="'.$id.'" notif="yes">Size <span id="lisize">'.$sizes.'</span>-SOLD OUT</li><br/>
                                                                ';
                                                        }
                                                        else{
                                                            if(mysqli_num_rows($query7)>0){
                                                          echo'
                                                              <li id="" class="list_size" href="#" pro_id="'.$id.'" style="background-color:pink;">Size <span id="lisize">'.$sizes.'</span>-In your bag</li><br/>
                                                                '; 
                                                            }
                                                            else{
                                                               echo '
                                                              <li id="" class="list_size" href="#" pro_id="'.$id.'" store="'.$store.'" notif="no">Size <span id="lisize">'.$sizes.'</span></li><br/>
                                                                ';  
                                                            }
                                                        }
                                                        }
                                                     
                                                       echo  "
                                                           </ul>
                                                           <div class='sizesguide'>Sizes Guide</div>
                                                           </div>
                                                      </div>
                                                                                 
														
                                </div>

                            </div>
                    </div>
            </div>";

		}
	}
 else {
            echo 'No search results';
}
	}
        else{
            header("location : ../index.php");
        }
?>
                                            
					
</div>
			
</div>
			

		
</div>
	
</div>
</div>
<?php include 'footer.php';?>
</body>
</html>