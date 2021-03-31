<!DOCTYPE HTML>
<?php

session_start();
#this is Login form page , if user is already logged in then we will not allow user to access this page by executing isset($_SESSION["uid"])
#if below statment return true then we will send user to their profile.php page
if (isset($_SESSION["uid"])) {
	header("location:../products/payments.php");
}
//in action.php page if user click on "ready to checkout" button that time we will pass data in a form from action.php page
if (!isset($_SESSION["uid"]) && isset($_POST["login_user_with_product"])) {
	//this is product list array
	$product_list = $_POST["product_id"];
	//here we are converting array into json format because array cannot be store in cookie
	$json_e = json_encode($product_list);
	//here we are creating cookie and name of cookie is product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
  $n=  rand();
  $guest=  rand(100, 10000000);
?>
<html>
<head>
<title>Login</title>
<!--css-->

<link href="../products/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../products/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../products/css/font-awesome.css" rel="stylesheet">
<link rel="shortcut icon" href="../products/logo.ico" />
<!--css-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Qcc,Queensclassy,QueensCollections,QueensClassyCollections,Queens Classy Collections,Queens Classy" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="../products/js/jquery.min.js"></script>

<script src="../products/main.js"></script>
<!--search jQuery-->
<script src="../products/js/main.js"></script>
<script src="../products/js/jquery2.js"></script>
<!--search jQuery-->

 <!--mycart-->
 <script type="text/javascript" src="../products/js/bootstrap-3.1.1.min.js"></script>
 <!-- cart -->
 <script src="../products/js/simpleCart.min.js"></script>
<!-- cart -->
  <!--start-rate-->
  <script src="../products/js/jstarbox.js"></script>
  <link rel="stylesheet" href="../products/css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
		
<!--//End-rate-->
</head>
<body>
	<!--header-->
        
		<div class="header">
			<div class="header-top">
				<div class="container">
					 <div class="top-left">
						<a href="#"> Call  <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +254713909393</a>
					</div>
					<div class="top-right">
					
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
				<!--header-->
		<div class="header">
			<div class="header-top">
				<div class="container">
					 <div class="top-left">
						<a href="#"> Call  <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +254713909393</a>
					</div>
					<div class="top-right">
					<ul>
                                        
                                            <li style="color: #fff;"><i class="fa fa-envelope">queensclassycollections@gmail.com</i></li>';
					
                                        
					</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="heder-bottom">
				<div class="container">
					<div class="logo-nav">
						<div class="logo-nav-left">
                                                    <h1><a href="../index.php">QueensClassy <span>Collections</span></a></h1>
						</div>
						<div class="logo-nav-left1">
							<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div> 
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" class="act">Home</a></li>	
									<!-- Mega Menu -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Topwear<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-5  multi-gd-img">
													<ul class="multi-column-dropdown">
														<li><a href="Officialdresses.php">Tops & Blouses</a></li>
														<li><a href="sets.php">Bodysuits</a></li>
														<li><a href="CropTops.php">Jackets</a></li>
                                                                                                                <li><a href="SlingBags.php">Hoods</a></li>
                                                                                                                <li><a href="SlingBags.php"> Kimono </a></li>
													</ul>
												</div>
										
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="#"><img src="images/topwear.jpg" alt=" "/></a>
												</div>
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bottomwear<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-3  multi-gd-img">
													<ul class="multi-column-dropdown">											
														<li><a href="blazers.php">Skirts</a></li>
														<li><a href="jeans.php">Jeans</a></li>
                                                                                                                <li><a href="jeans.php">Shorts</a></li>
                                                                                                                <li><a href="jeans.php">Official Pants</a></li>
													</ul>
												</div>
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="#"><img src="images/bottm.jpg" alt=" "/></a>
												</div> 
																								<div class="clearfix"></div>
											</div>
										</ul>
									</li>
                                                                        <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dresses<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-3  multi-gd-img">
													<ul class="multi-column-dropdown">											
														<li><a href="blazers.php">Official</a></li>
														<li><a href="jeans.php">Shirtdress</a></li>
                                                                                                                <li><a href="jeans.php">Bodycon</a></li>
                                                                                                                <li><a href="jeans.php">Maxi</a></li>
													</ul>
												</div>
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="#"><img src="images/dreses.jpg" alt=" "/></a>
												</div> 
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
                                                                        <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Two Piece<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-3  multi-gd-img">
													<ul class="multi-column-dropdown">											
														<li><a href="blazers.php">Skirts Set</a></li>
														<li><a href="jeans.php">Pant Set</a></li>
													</ul>
												</div>
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="#"><img src="images/twop.jpg" alt=" "/></a>
												</div> 
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
                                                                        <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bags & Accessories<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-3  multi-gd-img">
													<ul class="multi-column-dropdown">											
														<li><a href="blazers.php">Sling bags</a></li>
														<li><a href="jeans.php">Waist Bags</a></li>
                                                                                                                <li><a href="jeans.php">Belts</a></li>
                                                                                                                <li><a href="jeans.php">Hats & Caps</a></li>
													</ul>
												</div>
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="products1.html"><img src="images/bagim.jpg" alt=" "/></a>
												</div> 
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
								 		</ul>
							</div>
							</nav>
						</div>
						<div class="logo-nav-right">
							<ul class="cd-header-buttons">
								<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
							</ul> <!-- cd-header-buttons -->
							<div id="cd-search" class="cd-search">
								<form action="search.php" method="post">
									<input name="Search" type="search" placeholder="Search...">
								</form>
							</div>	
						</div>
						<div class="header-right2">
							<div class="cart box_1">                                                                     
					<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"><sup class="badge">0</sup></a>
					<div class="dropdown-menu">
						<div class="panel-success">
							<div class="panel-heading">
								<div class="row">
									Your Cart
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
								<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in Ksh.</div>
								</div>
								</div>
							</div>
                                                    
							
                                                </div>
                                        </div>
				</li>
				</ul>
				</li>
								
								</div>	
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>									
</form>
								
</div>
								
<div class="panel-footer" id="e_msg"></div>
							
</div>
						
</div>
					
</ul>
				
</li>
			
</ul>
		
</div>
	
</div>

</div>