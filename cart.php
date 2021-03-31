<!DOCTYPE html>
<html>
<head>
    <?php 
session_start();
if(!isset($_COOKIE['awsqawa']) && !isset($_SESSION['uid'])){
    header("location:index");
}
 require 'database/db.php';
 require 'datafunctions/headerfunc.php';

?>
<title>Cart</title>
<?php include 'sidenavs/jscss.php'; ?></head>
<body>
<!-- header -->
<div class="fixtop">
<!-- //header-bot -->
<!-- banner -->
<?php include 'sidenavs/bantop.php'; ?>

</div>
<?php include 'sidenavs/modals.php'; ?>
<?php
$phoneNumber='';
$name='';
$user_id='';
if(isset($_SESSION['uid'])){
 $user_id=$_SESSION["uid"]; 
 $phoneNumber=$_SESSION['phone'];
 $name=$_SESSION["name"];
 
}
 elseif (isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $user_id=$contentss[0];
              $name=$contentss[1];
              $phoneNumber=$contentss[2];
          }
?>
<script src="js/paynow.js"></script>

<!-- //Modal2 -->
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
                    			 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">
                                                   
						   <ul class="w3_short">
								<li><a href="index">Home</a><i>|</i></li>
								<li>QUICK CHECKOUT</li>
							</ul>
                                                   
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>

  <!-- banner-bootom-w3-agileits -->
  <?php if($user_id!=''){ ?>
	<div class="banner-bootom-w3-agileits">
	<div class="container">
         <!-- mens -->

		<div class="single-pro">
                <div class="col-md-5 locations">
             <div class="panel panel-primary">   
                                <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
          <?php 
              
              $savedql="SELECT * FROM saved_location  WHERE user_id='$user_id' ORDER BY saved_location.id DESC LIMIT 1";
              $query_saved=  mysqli_query($con, $savedql);
              
              if(mysqli_num_rows($query_saved)>0){
              $srow=  mysqli_fetch_array($query_saved);
              
             
              $tid=$srow['town_id'];
              $type=$srow['type'];
              
              if($type=="D"){
              $location="SELECT * FROM speftown INNER JOIN towns ON (speftown.town_id=towns.id) WHERE speftown.id=$tid";
              }
              elseif($type=="P"){
                $location="SELECT * FROM county_towns INNER JOIN counties ON (county_towns.county_id=counties.id) WHERE county_towns.id=$tid";  
              }
              
              $loc_query=  mysqli_query($con, $location);
              
                  while ($row1 = mysqli_fetch_array($loc_query)) {
                                      $price=$row1["price"];
                                      $town=$row1["town"];
                                    }
                   }
              ?>
          
      </h2>
    </div>
    <?php 
        $set=date('Y-m-d');
        if($set>='2020-12-24' && $set<='2021-01-03'){
        ?>
        <h2 style="text-align:center">We've temporarily closed</h2>
        <h2 style="text-align:center">Merry Christmas & Happy New Year</h2>
        <?php }
        else{
        ?>
    <div class="card-body">
        <div class="form-group ship">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-align:center; background: #fff;">
                        Select Location
                    </h2>
                    <div class="col-md-5">
                        <div class="regionb">
                            <input type="radio"  class="region" value="Nairobi"  data-toggle="modal" data-target="#setloc" name="reg"> Nairobi & Environs</input><br/>
                        </div>
                        <div class="regionb">
                            <input type="radio"  class="region" value="OutNai" data-toggle="modal" data-target="#setparloc" name="reg"> Outside Nairobi</input><br/>
                        </div>
                        <div class="regionb">
                            <input type="radio"  class="region" value="OutKe" data-toggle="modal" data-target="#centralModalSm" name="reg"> Outside Kenya</input>
                        </div>
                        <input type="hidden" id="ordertype" name="typeorder" value="parcel"/>
                        <input type="hidden" id="phone_num" name="phon_number"/>
                    </div>
                    <div class="col-md-6">
                    <div class="cart_sum" style="text-align:left; font-size: 0.93em; font-weight: bold;">
                        <?php 
                            if(mysqli_num_rows($query_saved)>0){
                                    while ($row1 = mysqli_fetch_array($loc_query)) {
                                      $price=$row1["price"];
                                      $town=$row1["town"];
                                    }
                                    echo '<b>Delivery Fees: Ksh.'.$price.'</b><br/>';
                                    echo '<input type="hidden" id="delprice" value="'.$price.'">';
                                }
                                
                                $view_sql="SELECT * FROM cart WHERE user_id='$user_id'";
                                $view_shared=mysqli_query($con,$view_sql);

                                $m=0;
                                $discount=0;
                                while($shared_row=mysqli_fetch_array($view_shared)){

                                    $dis=$shared_row['discount'];

                                    $discount+=$dis;
                                    
                                }
                                if($discount>0){
                                echo '<b>Total Discount: Ksh.'.$discount.'</b><br/>';
                                }
                                ?>
                        <?php if(mysqli_num_rows($query_saved)>0){ ?>
                            location: <?php echo $town ?>
                        <?php }
                        else {
                        ?>
                            Location: None
                    <?php } ?>
                            
                     </div>
                    </div>
                </div>

            </div>
        </div>
      </div>
  </div>
<?php if(mysqli_num_rows($query_saved)>0){ ?>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
      </h2>
    </div>
      <div class="sap_tabs">
        <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                <div class="pay-tabs">
                            <ul class="resp-tabs-list">
                                  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab" style="display: block; width: 100%; margin: 0px;"><span>LIPA NA MPESA</span></li>
                                  <?php 
                                  $today=date('Y-m-d');
                                        $sql="SELECT * FROM discounts WHERE FROM_UNIXTIME(enddate+3600*10,'%Y-%m-%d')>='$today' ORDER BY Code_id DESC LIMIT 1"; 
                                        $query=mysqli_query($con,$sql);
                                        $num_rows=  mysqli_num_rows($query);
                                  if($type=="D"){
                                      
                                        if($num_rows<1):
                                      ?>
                                  <!--<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>PAY ON DELIVERY</span></li> -->
                                  <?php endif; 
                                       } ?>
                                  <div class="clear"></div>
                          </ul>	
                         
                </div>
                <div class="resp-tabs-container">
                        <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                <div class="card-body">
          <div class="form-group ship">
               <?php 
              if($num_rows>0){
                  
              $disc_rows=  mysqli_fetch_array($query);
              $header="Discount Offer!";
               
              $now=date('YmdHis');
              $s=$disc_rows['startdate']; $e=$disc_rows['enddate'];
              $start=date('YmdHis',$s);   $end=date('YmdHis',$e);
              if($now>=$start && $now<=$end){ ?>
                  <div class="hurry">
                <h5>Discount Code</h5>
                <span class="actual siscs"><input type="text" id="discount_code" placeholder="Discount code(optional)" class="form form-control">
                <div class="btn btn-success ap" style="width:auto">Apply</div></span>
                 
               </div> 
               <?php }
            
              }
               ?>
              
              <div class="hurry">
                  <div>Amount to Pay: Ksh.<span id="torals"></span></div>
                    <script>
                        $( document ).ready(function() {
                        var deliv="<?php echo $price?>";
                                     calcost(deliv);
                    });
                    </script>
              </div>
              
              <div class="hurry" id="lmpsr">
               <div class="position">
                   <h4 class="lipa">LIPA NA<span class="nampesa"> MPESA EXPRESS</span></h4>
                    <ol style="width:100%; list-style-type: circle;">
                    <li class="inst">Ensure you have enough M-PESA balance</li>
                    <li class="inst">To pay, click "<b>PAY NOW</b>"</li>
                    <li class="inst">MPESA popup will appear, Enter PIN</li>
                </ol>
                <h4 id="labex2">Name</h4>
                <input type="text" name="name" class="form-control" id="name"  required=""/>
                <div>Phone:</div>
                <input type="text" id="nambari" class="form-control" name="payments" placeholder="07xx xxx xxx" required="" value="<?php echo $phoneNumber; ?>">
                
                <div id="phone_error"></div>
                <div id="amountheader">Amount:</div>
                <input type="text" id="totcost" class="form-control" name="amount" placeholder="pay the amount required" required="" disabled="true">
                     <div id="emptyfields"></div>

                     <div class="placeorder"> <input class="my-cart-b" id="cod_pay" type="submit" value="PAY NOW" /></div>

               </div>
                                  
            </div>
        <div class="hurry">
                 
               <div class="position">
                   <?php if(isset($_SESSION['unpaid'])){ ?>
                    <ol style="width:100%; list-style-type: circle;">
                        <li class="inst" style="color:green">Lipa na mpesa express unsuccessful? Try This</li>
                     </ol>
                   <?php } ?>
                   <div id="paid"><input type="checkbox" id="appmpesa" name="apppsr"/><span id="oooy">Use M-PESA code to place order</span></div>
                 <div id="vmsr">
                      <ol style="width:100%; list-style-type: circle;">
                            <li class="inst">Ensure you have enough M-PESA balance</li>
                            <li class="inst">Go to your SIM Toolkit, select BUY GOODS option</li>
                            <li class="inst">Enter the Exact Amount To Till No. 498921</li>
                            <li class="inst">Copy the transaction code and come back to place your order</li>
                        </ol>
                 <div>Name:</div>
                <input type="text" id="conem" class="form-control" name="conem" placeholder="Your Name" required="" value="">
                 <div>Phone Number that paid:</div>
                <input type="text" id="contacts" class="form-control" name="contacts" placeholder="07xx xxx xxx" required="" value="">
                <div id="amountheader" style="margin-top:15px;">Mpesa Code</div>
                <input type="text" id="mpsacode" class="form-control" name="mpesa" placeholder="OFXXXX123B" style="margin-bottom:5px; text-transform: uppercase">
                <div id="mpesamsg"></div>
                
              <div class="placeorder"> <input class="my-cart-b" id="vefcode" type="submit" value="PLACE ORDER" /></div>
                 </div>
               </div>
                                  
            </div>
                                        
          </div>
           
      </div>
    </div>
     
    <?php if($type=="D"){ ?>
    <!--<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
        <div class="card-body">
          <div class="form-group ship">
              

                <div class="hurry">
                    <div class="position">
                        <div>Name:</div>
                        <input type="text" id="codnem" class="form-control" name="codnem" placeholder="Your Name" required="" value="" style="margin-bottom: 10px">
                     <div class="placeorder"> <input class="my-cart-b" id="placeorder" type="submit" value="PLACE ORDER" /></div>
                    </div>
                </div>
                                        
          </div>
           
        </div>
    </div> -->
    <?php } ?>                                                
</div>	
                                    </div>
                            </div>
      
  </div>
<?php } ?>
  <!--<div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        #3 IMPROVE US(Optional) <i class="fa fa-plus" style="float:right"></i>
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
          <div class="form-group ship">
            <div class="cart_sum">
                <input id="amountorder" type="hidden"/>
                <h4>Give suggestion</h4>
                <textarea class="form-control" id="suggestions"  placeholder="Improve our customer service through your thoughts">
                    
                </textarea><br/>
                <h4>Phone Number:</h4>
                <input type="text" id="phonumber" class="form-control" name="payments" placeholder="07xx xxx xxx" required=""> <br/>
                 <div class="placeorder"> <input class="my-cart-b" id="suggest" type="submit" value="SUBMIT" /></div>
            </div>
          
        </div>
      </div>
    </div>
  </div> -->
</div>
                               

                                    
                                   
    
                                    
    
                        </div> 
                </div>
                <div class="col-md-7 main">
			
			<div class="main-grid2">
				<h2>My Shopping Bag</h2>
                                <div id="carts">
                                 <?php 
                if (isset($_COOKIE['awsqawa'])) {
                      $sql = "SELECT a.id,a.name,a.price,a.image,a.sizes,a.colour,b.id,b.qty,b.price AS cprice,b.sizes AS czises FROM products a,cart b WHERE a.id=b.p_id AND b.user_id='$user_id'";
                  }
                  else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.id,a.name,a.price,a.image,a.sizes,a.colour,b.id,b.qty,b.price AS cprice,b.sizes AS czises FROM products a,cart b WHERE a.id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0 ";
                    }
                    $query = mysqli_query($con,$sql);
                    if (mysqli_num_rows($query) > 0) { 
                        $sum=0;
                        while ($row=mysqli_fetch_array($query)) {
					$product_id = $row["id"];
					$product_title = $row["name"];
					$product_price = $row["cprice"];
					$product_image = $row["image"];
					$cart_item_id = $row["id"];
                                        $qty = $row["qty"];
                                        $colour=$row['colour'];
                                        $sizes=$row["czises"];
                                        $total=$qty*$product_price;
                                        $sum+=$total;
					
                    
?>
				<div class="cart_box">
					<div class="message">
                                            <div id="<?php echo $product_id ?>" class="alert-close"> </div> 
						<div class="list_img"><img src="<?php echo $inv.$product_image ?>" class="img-responsive" alt=""/></div>
						<div class="list_desc"><h4><a href="#"><?php echo $product_title ?></a></h4>
                                                    <span class="actual variants"><?php echo $colour."-".$sizes ?></span><br/>
                                                    <span class="actual">Items: <?php echo $qty ?> x Ksh.<?php echo number_format($product_price, 2, '.', ' '); ?></span><br/>
                                                    <span class="actual">Total: Ksh.<span><?php echo number_format($total, 2, '.', ' ');  ?></span></span><br/>
                                                    <span class="actual"><input type="text" class="form form-control qty" value="<?php echo $qty ?>" ><div update_id="<?php echo $product_id ?>" class="btn btn-success update"><span class="glyphicon glyphicon-ok-sign"></span></div></span>
                                                <div class="" id="updt"></div>
                                                </div>
						  <div class="clear"></div>
					</div>
				</div>
                    <?php }  ?>
                        </div>
				<div class="total">
					<div class="total-left">
                    <p>Items Total : Ksh.<span  id="cart_tt"><?php echo $sum;  ?></span></p>
					</div>
					<div class="clear"> </div>
				</div>
                    <?php } else{  ?>
                                <h4>Your Cart Is Empty</h4>
                        <?php } ?>   
			</div>
		</div>
		</div>
	</div>
</div>
<?php 
        }
        ?>
<?php }
else{
    header("location: /");
}
?>
<!-- //mens -->
<!--/grids-->
<?php include 'sidenavs/footer.php'; ?>
<?php include 'sidenavs/scripts.php'; ?>

<link rel="stylesheet" href="css/sidebar.css"/>
<link rel="stylesheet" href="css/sidecart.css"/>

 <?php include 'sidenavs/modalIndex.php';?>
<?php include 'sidenavs/sidecart.php';?>
<!-- //footer -->

<!-- login -->
			<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-bottom">
										<h3>Sign up for free</h3>
										<form>
											<div class="sign-up">
												<h4>Email :</h4>
												<input type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
											</div>
											<div class="sign-up">
												<h4>Password :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												
											</div>
											<div class="sign-up">
												<h4>Re-type Password :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												
											</div>
											<div class="sign-up">
												<input type="submit" value="REGISTER NOW" >
											</div>
											
										</form>
									</div>
									<div class="login-right">
										<h3>Sign in with your account</h3>
										<form>
											<div class="sign-in">
												<h4>Email :</h4>
												<input type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
											</div>
											<div class="sign-in">
												<h4>Password :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												<a href="#">Forgot password?</a>
											</div>
											<div class="single-bottom">
												<input type="checkbox"  id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>
											<div class="sign-in">
												<input type="submit" value="SIGNIN" >
											</div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<p>By logging in you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- //login -->
<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<script src="js/responsiveslides.min.js"></script>
				<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						 // Slideshow 4
						$("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
						$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
							}
							});
						});
				</script>
<script src="js/modernizr.custom.js"></script>
	<!-- Custom-JavaScript-File-Links --> 
	<!-- cart-js -->
	<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>

	<!-- //cart-js --> 
	<!---->
							<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range" ).slider({
										range: true,
										min: 0,
										max: 9000,
										values: [ 1000, 7000 ],
										slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
										}
							 });
							$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

							});//]]>  

							</script>
						<script type="text/javascript" src="js/jquery-ui.js"></script>
					 <!---->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easyResponsiveTabs.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
              .grbtn{
                  font-weight: normal;
                  color: #1B242F;
                  cursor: pointer;
                  border-radius: 0;
                  background-color:green;
                  height: 4em;
                  width: 100%;
                  margin-left: 0;
                  text-transform: uppercase;
              }
              .drbtn{
                  font-weight: normal;
                  color: #1B242F;
                  cursor: pointer;
                  border-radius: 0;
                  background-color: darkgoldenrod;
                  height: 4em;
                  width: 100%;
                  margin-left: 0;
                  text-transform: uppercase;
              }
          </style>
          <style>
                #emptyfields{
                    margin-top:5px;
                }
                .inst{
                        color:#fc636b;
                        width:100%;
                        font-size:.75em;
                        font-weight:bold;
                        margin-top:3px;
                    } 
                    .proced{
                        margin-top: 4px;
                        text-align: center;
                    }
                    .lipa{
                        text-align: center;
                        color:green;
                        font-weight: bold;
                        margin-bottom: 4px;
                        text-decoration: underline;
                        }
                        .nampesa{
                            color:red;
                        }
                        .position .form-control{
                            border: 2px solid green;
                        }
                        #discount_code{
                            
                            width: 60%;
                            float: left;
                            border: 2px solid #000000;
                            border-radius: 0;

                        }
                        
            </style>
            <script>
               $(document).ready(function(){
                   $('.savemodal').hide();

                    $('.region').click(function(){
                    var reg = $(this).val();

                    var dataString = 'region='+reg;
                    if(reg===''){}
                      else{
                        $.ajax({
                            type: "POST",
                            url: "includes/modal.body.php",
                            data: dataString,
                            success: function(data){
                                $("#modalBody").html(data);                                                        }
                        });
                    }
                });
               });
            </script>
            <script type="text/javascript">
                    $(document).ready(function () {
                            $('#horizontalTab').easyResponsiveTabs({
                                    type: 'default', //Types: default, vertical, accordion           
                                    width: 'auto', //auto or any width like 600px
                                    fit: true   // 100% fit in a container
                            });
                    });

            </script>

</body>
</html>
