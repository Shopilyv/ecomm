<?php

date_default_timezone_set('Africa/Nairobi');
$jana=date('Y-m-d',strtotime("-1 days"));
$today=date('Y-m-d');
$sql = "SELECT products.id,products.category_id,products.name,products.price,products.dprice,products.per,products.image,products.colour,products.sizes,products.sku,products.stock_status, SUM(orders_item.qty)AS summation FROM orders_item
                        JOIN products ON (orders_item.product_id=products.id)
                        JOIN orders ON (orders.id=orders_item.order_id)
                        WHERE FROM_UNIXTIME(orders.date_time+3600*10,'%Y-%m-%d') >= '$jana' AND FROM_UNIXTIME(orders.date_time+3600*10,'%Y-%m-%d') <= '$today' AND products.availability='1'
                        GROUP BY sku ORDER by summation DESC LIMIT 20";
$run_query = mysqli_query($con,$sql);

if(mysqli_num_rows($run_query) > 0){
		while($rowz = mysqli_fetch_array($run_query)){
		    $sku=$rowz['sku'];
		    
		    $prodsql="SELECT * FROM products WHERE sku='$sku' GROUP BY colour ORDER BY SUM(quantity+quantity1+quantity2) DESC LIMIT 1";
		    $prodquery=mysqli_query($con,$prodsql);
		    while($row = mysqli_fetch_array($prodquery)){
			$pro_id    = $row['id'];
			$pro_cat   = $row['category_id'];
			$pro_title = $row['name'];
			$pro_price = $row['price'];
                        $dprice    = $row['dprice'];
                         $per       = $row['per'];
                       
			$pro_image = $row['image'];
                             $colour=$row['colour'];
                              $sizes=$row['sizes'];
                              $stock_status=$row['stock_status'];
                             
                                $nem=$pro_title;
                                $strlen=strlen($nem);
                                
                                if($strlen>23){
                                $nem = substr($pro_title, 0, 23)."..";
                                }
                                
                                 $amount=$pro_price;
                                    $discount=0;
                                    $del="";
                                    if($pro_price>$dprice){
                                        if($per<2){
                                      $amount = $dprice;
                                      $discount= $pro_price-$dprice;
                                      $del="<del>Ksh.".$pro_price."</del>  ";
                                        }
                                    }
                               $geturl="product?id=$pro_id&ptit=$pro_title";
                                $fb_url = "https://queensclassycollections.com/". $geturl;
			echo '<div class="col-md-3 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="'.$inv.$pro_image.'" alt="" class="pro-image-front">
										<img src="'.$inv.$pro_image.'" alt="" class="pro-image-back">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
												
												 <!-- facebook share button-->	
								<div style="float: right; margin-top: 5px; margin-bottom: 5px;" class="fb-share-button"
                         data-href="'.$fb_url.'"
                         data-layout="button"></div>
												
													<a href="'.$geturl.'" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
											
									</div>
									<div class="item-info-product ">
										<div class="item_tittl"><h4><a href="'.$geturl.'">'.$nem.'</a></h4></div>';
										echo '<div class="info-product-price">'.$del.'
											Ksh.<span class="item_price">'.$amount.'</span>
										</div>
										<div class="kolas">
										';
                                                                                  $sql1="SELECT * FROM products WHERE sku='$sku' AND colour!='$colour' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY colour";
                                                                                    $query1=  mysqli_query($con, $sql1);  
                                                                                    $n=0;
                                                                                    $max=0;
                                                                                   $kolas=mysqli_num_rows($query1);
                                                                                   $rem=$kolas-$max;
                                                                                   
                                                                                   $view= '';
                                                                                   if($kolas>0){
                                                                                       if($rem>1){
                                                                                       $view .='<a class="text-mor" href="'.$geturl.'">View More Colours</a>';
                                                                                       }
                                                                                       elseif($rem==1){
                                                                                       $view .='<a class="text-mor" href="'.$geturl.'">View More Colour</a>';
                                                                                       }
                                                                                   }
                                                                                   echo $colour;
                                        echo '</br/>'.$view.'
										</div>
										<div class="">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" prod_id="" disc="'.$discount.'" size="">
                                                          BUY NOW
                                                          <i class="glyphicon glyphicon-triangle-bottom" style="float:right; top: 6px; border-radius:0;"></i>
                                                        </button>
                                                        <div class="dd">
                                                        <div class="sizesheader"><h4>'.$pro_title.'<span class="closedds"><img src="images/icon-close.png"></span></h4></div>
                                                        
                                                        <ul>
                                                        <h4>*Click one variant to buy*</h4>
                                                        ';
                                 $sql3="SELECT * FROM products where `name`='$pro_title' AND colour='$colour' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY sizes";
                                                        $query6=  mysqli_query($con, $sql3);
                                                         foreach ($query6 as $row){
                                                         $sizes=$row['sizes'];
                                                         $colour=$row['colour'];
                                                         
                                                         $statement='<span id="lisize">'.$colour.' - '.$sizes.'</span>';
                                                         if($sizes==''){
                                                            $sizes= $colour;
                                                            $statement='<span id="lisize">'.$colour.'</span>';
                                                         }
                                                           $id=$row['id'];
                                                         
                                                         $q= $row['quantity'];
                                                        $q1= $row['quantity1'];
                                                        $q2= $row['quantity2'];
                                                        
                                                         $quantity=$q+$q1;
                                                         
                                                          
                                                        
                                                        if($q>0 && $q1>0){
                                                            $store= "G12";
                                                        }
                                                        elseif($q>0 && $q1<1){
                                                            
                                                             $store= "G12";
                                                        }
                                                        elseif($q<1 && $q1>0){
                                                            
                                                             $store= "RNG";
                                                        }
                                                        
                                                         if($quantity<1){
                                                             echo '
                                                                  <li id="" class="list_size" href="#" pro_id="'.$id.'" notif="yes">Size <span id="lisize">'.$sizes.'</span>-SOLD OUT</li><br/>
                                                                ';
                                                        }
                                                        else{
                                                           echo '<li class="list_size" href="#" pro_id="'.$id.'" size="'.$sizes.'" store="'.$store.'" disc="'.$discount.'" price="'.$pro_price.'" notif="no">'.$statement.'</li><br/>';  
                                                            
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
	}
                        ?>

                        
