<!DOCTYPE html>
<html>
<head>
    <?php 
session_start();
 require 'database/db.php';
if(!isset($_COOKIE['awsqawa']) && !isset($_SESSION['uid'])){
    header("location:index");
}
if(isset($_SESSION['uid'])){
  $phone = $_SESSION["phone"];
  $customer =$_SESSION["name"];   
}
 elseif (isset($_COOKIE['awsqawa'])) {
              $string=$_COOKIE['awsqawa'];
              $contentss=  explode("_", $string);
              $user_id=$contentss[0];
              $phone=$contentss[2];
          }
date_default_timezone_set("Africa/Nairobi");
require 'datafunctions/headerfunc.php';

?>
<title>Order History</title>
<?php include 'sidenavs/jscss.php'; ?></head>
<body>
<!-- header -->
<div class="fixtop">
<!-- //header-bot -->
<!-- banner -->
<?php include 'sidenavs/bantop.php'; ?>

</div>
<?php include 'sidenavs/modals.php'; ?>
<link rel="stylesheet" href="css/stylecart.css" />
<!-- //Modal2 -->
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Order History</span></h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.html">Home</a><i>|</i></li>
								<li>Order History</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>
<?php 
        $mpesa="SELECT * FROM orders WHERE customer_phone='$phone' order by id DESC LIMIT 1;";
        $m_query=  mysqli_query($con, $mpesa);
        $row=  mysqli_fetch_array($m_query);
        
        $order_id=$row['id'];
        $order_code=$row['bill_no'];
        $address=$row['customer_address'];
        $phone=$row['customer_phone'];
        $amount=$row['net_amount'];
        $t=$row['date_time'];
        $date=date('Y/m/d H:i:s',$t);
        
        $ps=$row['paid_status'];
        $landmark=$row['landmark'];
        $packed=$row['packed'];
        
        $status="";
        
        if($ps=='1'){
          $status="Status: Paid";  
        }
        
        $dstatus="Not Delivered";
        if($packed==1){
            $dstatus="Ready to dispatch";
            $sql="SELECT * FROM deliveries WHERE bill_id='$order_id'";
            $query=mysqli_query($con,$sql);
            
            $sql1="SELECT * FROM parcel WHERE bill_id='$order_id'";
            $query1=mysqli_query($con,$sql1);
            if(mysqli_num_rows($query)>0){
                while($dels=mysqli_fetch_array($query)){
                    $status=$dels['status'];
                    $returned=$dels['returned'];
                    $reasons=$dels['reasons'];
                    $riderid=$dels['rider_id'];
                    
                    $ridersql="SELECT * FROM users WHERE id=$riderid";
                    $rquery=mysqli_query($con,$ridersql);
                    $rrow=mysqli_fetch_array($rquery);
                    
                    $rider="<br/><b>Rider:</b> ".$rrow['firstname']." ".$rrow['lastname']."<br/> <b>Rider Contacts:</b> ".$rrow['phone'];
                    
                    if($status=='1'){
                        $dstatus="Delivered".$rider;
                    if($returned=='1'){
                        $dstatus="Returned to shop".$rider;
                    }
                    }
                     elseif($status=='0'){
                         $dstatus="Dispatched but not Delivered".$rider;
                    if(isset($reasons)){
                       $dstatus="Dispatched but Never Reached Customer<br/> Reason: ".$reasons.$rider; 
                    }
                     }
                }
            }
            elseif(mysqli_num_rows($query1)>0){
               while($parcs=mysqli_fetch_array($query1)){
                  
                  $receipt=$parcs['receipt'];
                  $riderid=$dels['rider_id'];
                    
                    $ridersql="SELECT * FROM users WHERE id=$riderid";
                    $rquery=mysqli_query($con,$ridersql);
                    $rrow=mysqli_fetch_array($rquery);
                    
                    $rider="<br/><b>Rider:</b> ".$rrow['firstname']." ".$rrow['lastname']."<br/> <b>Rider Contacts:</b> ".$rrow['phone'];
                    $dstatus="Dispatched".$rider; 
                  if(!is_null($receipt)){
                    $dstatus="Dispatched & Receipt Sent.<br/> <span style='color:blue'><a href='http://express.queensclassy.com/parcel.info.php?od=$order_id'>Click Here</a></span> to view Receipt".$rider;  
                  }
                } 
                
            }
        }
        
        
        $cartql="SELECT *,cart_items.qty as cartqty,cart_items.price as cart_price FROM cart_items INNER JOIN products ON (cart_items.p_id=products.id) WHERE order_no='$order_code'";
        $cartquery=  mysqli_query($con, $cartql) or die(mysqli_error($con));
?>
  <!-- banner-bootom-w3-agileits -->
	<div class="banner-bootom-w3-agileits">
	<div class="container">
         <!-- mens -->

		<div class="single-pro">
                
                <div class="main">
			<div class="main-grid1">
				<ul>
                                    <li><a href="#" class="car"> <?php echo $order_code ?></a></li>
				</ul>
			</div>
			<div class="main-grid2">
                            <div class="car">Status: <?php echo $dstatus ?></div>
                            <div class="car">Location: <?php echo $address ?></div>
                            <div class="car">Date Ordered: <?php echo $date ?></div>
				<h2>My Order Items</h2>
                                <?php
                                $cartttl=0;
                                while ($items = mysqli_fetch_array($cartquery)) {
                                                            $image=$items['image'];
                                                            $name=$items['p_name'];
                                                            $qutty=$items['cartqty'];
                                                            $price=$items['cart_price'];
                                                            $subtotal=$items['sub_t'];
                                                         ?>
				<div class="cart_box">
					<div class="message">
						<div class="list_img"><img src="<?php echo $inv.$image ?>" class="img-responsive" alt=""/></div>
						<div class="list_desc"><h4><a href="#"><?php echo $name ?></a></h4>
                                                    <span class="actual">Items: <?php echo $qutty ?></span><br/>
                                                    <span class="actual">Amount: Ksh.<?php echo $subtotal ?></span>
                                                </div>
						  <div class="clear"></div>
					</div>
				</div>
                                <?php } ?>
				
				<div class="total">
					<div class="total-left">
						<p>Total :<span>Ksh. <?php echo $amount ?></span></p>
					</div>
					<div class="total-right">
                                            <a href="tel:+254110025225"><i class="fa fa-phone-square"></i> 0110025225</a>
					</div>
					<div class="clear"> </div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>	
<!-- //mens -->
<!--/grids-->
<?php include 'sidenavs/footer.php'; ?>
<?php include 'sidenavs/scripts.php'; ?>

<link rel="stylesheet" href="css/sidebar.css"/>
<link rel="stylesheet" href="css/sidecart.css"/>

 <?php include 'sidenavs/modalIndex.php';?>
<?php include 'sidenavs/sidecart.php';?>
<!-- //footer -->

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
</body>
</html>
