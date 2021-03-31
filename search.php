<!DOCTYPE html>
<html>
<head>
 <?php 
session_start();
 require 'database/db.php';
 require 'datafunctions/headerfunc.php';
$item='';
if(isset($_COOKIE['Item'])){
 $item=$_COOKIE['Item'];     
    }
    else{
    header("location:index.php");
}

?>
<title><?php echo $item ?></title>
<?php include 'sidenavs/jscss.php'; ?></head>
<body>
<!-- header -->
<div class="fixtop">
<!-- //header-bot -->
<!-- banner -->
<?php include 'sidenavs/bantop.php'; ?>

</div>
<?php include 'sidenavs/modals.php'; ?>
<!-- //Modal2 -->
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.html">Home</a><i>|</i></li>
								<li><?php echo $item ?></li>
							</ul>
							<div class="o_process" style="letter-spacing: 0;">
                                                            <h5 style="text-align:center"><u>Add to Cart guide</u></h5>
                                                            <ol>
                                                                <li>Step 1: Click/double click the <span class="mnpts"> BUY NOW</span> button</li>
                                                                <li>Step 2: Click the <span class="mnpts">size or colour</span> you want.Your cart will slide from the right </li>
                                                                <li>Step 3: Enter phone number<span class="mnpts"> and proceed to order</span> or <span style="color:rgba(192,29,129,1)">Click the x button at the top right to continue shopping</span> </li>
                                                            </ol>
                                                        </div>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>

  <!-- banner-bootom-w3-agileits -->
	<div class="banner-bootom-w3-agileits">
	<div class="container">
         <!-- mens -->

		<div class="single-pro">
<?php
if($item !=''){
echo searchItem($item, $con, $ip_add,$inv); 
}
 ?>
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


</body>
</html>
