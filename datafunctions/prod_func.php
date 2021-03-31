<?php 
function getDesc($cat_id,$con){
    $sql="SELECT * FROM categories WHERE id=$cat_id";
    $query=mysqli_query($con,$sql);
    $desc="";
    if(mysqli_num_rows($query)>0){
    $row=mysqli_fetch_array($query);
    $decript=$row['description'];
    if(!is_null($decript)){
       $desc= $decript;
    }
    }
    
    return $desc;
}
function getProdesc($id,$con){
    $sql="SELECT * FROM products WHERE id=$id";
    $query=mysqli_query($con,$sql);
    $desc="Get Jumpsuits, Official Dresses, trench coats at an affordable price of less than Ksh.999\=";
    if(mysqli_num_rows($query)>0){
    $row=mysqli_fetch_array($query);
    $decript=$row['description'];
    if(!is_null($decript)){
       $desc= $decript;
    }
    }
    
    return $desc;
}
function subcats($cat_id,$con,$ip_add,$inv){
    $output='';
    
	$product_query = "SELECT *,SUM(quantity+quantity1+quantity2) AS sum FROM products WHERE category_id='$cat_id' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY sku ORDER BY SUM(quantity+quantity1+quantity2) DESC LIMIT 50";
	$run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
		    $sku=$row['sku'];
			$pro_id    = $row['id'];
			$pro_cat   = $row['category_id'];
			$pro_title = $row['name'];
			$pro_image = $row['image'];
                        
                        $pro_price = $row['price'];
                        $dprice    = $row['dprice'];
                        $per       = $row['per'];
                        
                             $colour=$row['colour'];
                              $sizes=$row['sizes'];
                              $stock_status=$row['stock_status'];
                              $qty=$row['qty'];
                             $sum=$row['sum'];
                                $prod_title = explode(" ", $pro_title);
                                
                                
                               if($sum>0){
                                
                                                              
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
                       // facebook share button
                        $fb_url = "https://queensclassycollections.com/" . $geturl;
			$output.= '<div class="col-md-3 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="'.$inv.$pro_image.'" alt="'.$nem.'" class="pro-image-front">
										<img src="'.$inv.$pro_image.'" alt="'.$nem.'" class="pro-image-back">
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
										<h4><a href="'.$geturl.'">'.$nem.'</a></h4>';
										$output.= '<div class="info-product-price">'.$del.'
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
                                                                                   $output .=$colour;
                                                                                    
                                                                                    
										$output .='</br/>'.$view.'
										</div>
										<div class="">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" disc="'.$discount.'" prod_id="" size="">
                                                          BUY NOW
                                                           <i class="glyphicon glyphicon-triangle-bottom" style="float:right; top: 6px; border-radius:0;"></i>
                                                        </button>
                                                        <div class="dd">
                                                        <div class="sizesheader"><h4>'.$pro_title.'<span class="closedds">close</span></h4></div>
                                                        <ul>
                                                        <h4>*Click one variant to buy*</h4>
                                                        ';
                                 $sql3="SELECT * FROM products where `name`='$pro_title' AND colour='$colour' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY sizes";
                                                        $query6=  mysqli_query($con, $sql3);
                                                         foreach ($query6 as $row){
                                                         $sizes=$row['sizes'];
                                                         $colour=$row['colour'];
                                                         $statement='<span id="lisize">'.$colour.'-'.$sizes.'</span> <span id="added"></span>';
                                                         if($sizes==''){
                                                             $sizes=$colour;
                                                             $statement='<span id="lisize">'.$sizes.'</span>';
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
                                                             $output .='
                                                                  <li id="" class="list_size" href="#" pro_id="'.$id.'" notif="yes">Size <span id="lisize">'.$sizes.'</span>-SOLD OUT</li><br/>
                                                                ';
                                                        }
                                                        elseif($quantity>0){
                                                               $output .='
                                                              <li id="" class="list_size" href="#" pro_id="'.$id.'" size="'.$sizes.'" store="'.$store.'" disc="'.$discount.'" price="'.$amount.'" notif="no">'.$statement.'</li><br/>
                                                                ';  
                                                            
                                                        }
                                                        }
                                                     
                                                       $output .= '
                                                           </ul>
                                                           <div class="sizesguide">Sizes Guide</div>
                                                           </div>
                                                      </div>
                                                                                 
														
                                </div>

                            </div>
                    </div>
            </div>';
                               }
		}
	}
	
	return $output;
}
function searchItem($item,$con,$ip_add,$inv){
    $output='';
    
	$product_query = "SELECT *,SUM(quantity+quantity1+quantity2) AS sum FROM products WHERE name LIKE '%$item%' AND image !='<p>You did not select a file to upload.</p>'  AND availability='1' GROUP BY sku ORDER BY sum DESC LIMIT 21";
	$run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id'];
			$pro_cat   = $row['category_id'];
			$pro_title = $row['name'];
			$pro_image = $row['image'];
                        
                        $pro_price = $row['price'];
                        $dprice    = $row['dprice'];
                        $per       = $row['per'];
                             $colour=$row['colour'];
                              $sizes=$row['sizes'];
                              $sku=$row['sku'];
                              $stock_status=$row['stock_status'];
                              $qty=$row['qty'];
                             $sum=$row['sum'];
                                $prod_title = explode(" ", $pro_title);
                                
                                
                               if($sum>0){
                                
                                                              
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
			$output.= '<div class="col-md-3 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="'.$inv.$pro_image.'" alt="" class="pro-image-front">
										<img src="'.$inv.$pro_image.'" alt="" class="pro-image-back">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="'.$geturl.'" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
											
									</div>
									<div class="item-info-product ">
										<h4><a href="'.$geturl.'">'.$nem.'</a></h4>';
										$output.= '<div class="info-product-price">'.$del.'
											Ksh.<span class="item_price">'.$amount.'</span>
										</div>
										<div class="kolas">
										';
                                                                                  $sql1="SELECT * FROM products WHERE sku='$sku'  AND colour!='$colour' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY colour";
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
                                                                                   $output .=$colour;
                                                                                                                                                                      
										$output .='</br/>'.$view.'
										</div>
										<div class="">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" disc="'.$discount.'" prod_id="" size="">
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
                                                         $statement='Buy Size <span id="lisize">'.$sizes.'</span> <span id="added"></span>';
                                                         if($sizes==''){
                                                             $sizes=$colour;
                                                             $statement='Buy Colour <span id="lisize">'.$sizes.'</span>';
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
                                                             $output .='
                                                                  <li id="" class="list_size" href="#" pro_id="'.$id.'" notif="yes">Size <span id="lisize">'.$sizes.'</span>-SOLD OUT</li><br/>
                                                                ';
                                                        }
                                                        elseif($quantity>0){
                                                               $output .='
                                                              <li id="" class="list_size" href="#" pro_id="'.$id.'" size="'.$sizes.'" store="'.$store.'" disc="'.$discount.'" price="'.$amount.'" notif="no">'.$statement.'</li><br/>
                                                                ';  
                                                            
                                                        }
                                                        }
                                                     
                                                       $output .= '
                                                           </ul>
                                                           <div class="sizesguide">Sizes Guide</div>
                                                           </div>
                                                      </div>
                                                                                 
														
                                </div>

                            </div>
                    </div>
            </div>';
                               }
		}
	}
	
	return $output;
}
function catindex($cat_id,$con,$ip_add,$inv){
    $output='';
    
	$product_query = "SELECT *,SUM(quantity+quantity1+quantity2) AS sum FROM products WHERE category_id='$cat_id' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY sku ORDER BY sum DESC LIMIT 7";
	$run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id'];
			$pro_cat   = $row['category_id'];
			$pro_title = $row['name'];
			$pro_image = $row['image'];
                        
                        $pro_price = $row['price'];
                        $dprice    = $row['dprice'];
                        $per       = $row['per'];
                        
                             $colour=$row['colour'];
                              $sizes=$row['sizes'];
                              $sku=$row['sku'];
                             $sum=$row['sum'];
                               if($sum>0){
                                
                                                              
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
			$output.= '<div class="col-md-3 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="'.$inv.$pro_image.'" alt="'.$pro_title.'" class="pro-image-front">
										<img src="'.$inv.$pro_image.'" alt="'.$pro_title.'" class="pro-image-back">
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
									<div class="item-info-product">
										<h4><a href="'.$geturl.'">'.$nem.'</a></h4>';
										$output.= '<div class="info-product-price">'.$del.'
											Ksh.<span class="item_price">'.$amount.'</span>
										</div>
										<div class="kolas">
										';
                                                                                  $sql1="SELECT * FROM products WHERE sku='$sku'  AND colour!='$colour' AND image !='<p>You did not select a file to upload.</p>' AND availability='1' GROUP BY colour";
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
                                                                                   $output .=$colour;
                                                                                    
                                                                                    
										$output .='</br/>'.$view.'
										</div>
										<div class="">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" disc="'.$discount.'" prod_id="" size="">
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
                                                         $statement='Buy Size <span id="lisize">'.$sizes.'</span> <span id="added"></span>';
                                                         if($sizes==''){
                                                             $sizes=$colour;
                                                             $statement='Buy Colour <span id="lisize">'.$sizes.'</span>';
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
                                                             $output .='
                                                                  <li id="" class="list_size" href="#" pro_id="'.$id.'" notif="yes">Size <span id="lisize">'.$sizes.'</span>-SOLD OUT</li><br/>
                                                                ';
                                                        }
                                                        elseif($quantity>0){
                                                               $output .='
                                                              <li id="" class="list_size" href="#" pro_id="'.$id.'" size="'.$sizes.'" store="'.$store.'" disc="'.$discount.'" price="'.$amount.'" notif="no">'.$statement.'</li><br/>
                                                                ';  
                                                            
                                                        }
                                                        }
                                                     
                                                       $output .= '
                                                           </ul>
                                                           <div class="sizesguide">Sizes Guide</div>
                                                           </div>
                                                      </div>
                                                                                 
														
                                </div>

                            </div>
                    </div>
            </div>';
                               }
		}
	}
	
	return $output;
}
?>
