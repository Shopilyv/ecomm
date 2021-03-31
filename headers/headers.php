
<!--css-->
<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet"> 
<link href="../products/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../products/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../products/css/font-awesome.css" rel="stylesheet">
<link rel="shortcut icon" href="../products/logo.ico" />

<!--Meta Tags/Search Engine Optimization-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Qcc,qcc,Queensclassy,queensclassy,QueensCollections,queenscollections,QueensClassyCollections,queensclassycollections,queensclassy,goshengarderns, goshen gargens,kimono,bodyshaper,body shaper,jeans,bodyshaper jeans,body shaper jeans,slingbags,sling bags,Sling Bags,hoodie,sandals,Sankara,kitenge coats,Queens Classy Collections,Queens Classy,Queens,queens" />
<meta name="description" content="Shop online for ladies/women clothes, handbags/slingbags, bodyshaper jeans for ksh.999\= or less and have them delivered at your doorstep.">
<!-- Javascript  -->
<script src="../products/js/jquery.min.js"></script>
<script src="../products/main.js"></script>
<script src="../products/js/jquery2.js"></script>
<script src="../products/js/responsiveslides.min.js"></script>
<script type="text/javascript" src="../products/js/bootstrap-3.1.1.min.js"></script>
</head>
<body>
	<!--header-->
		<div class="header">
			<div class="header-top">
				<div class="container">
					 <div class="top-left">
						<a href="#"><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +254713909393</a>
					</div>
					<div class="top-right">
					<ul>
                                            <?php
                                            if (isset($_SESSION["uid"])) {
                                                echo '
                                            <li><a href="../products/cart.php">Checkout</a></li>
					    <li><a href="../products/logout.php"> Logout </a></li>';
                                            }
                                    else {                                                
                                        echo '
                                            <li><a href="../products/cart.php">Checkout</a></li>';
					
                                         } ?>
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
                                                            <button type="button" class="navbar-toggle collapsed showSide">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div> 
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="../index.php" class="act">Home</a></li>	
									<!-- Mega Menu -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Topwear<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-5">
													<ul class="multi-column-dropdown">
                                                                                                            <li><a href="../products/Dresses.php">Tops & Blouses</a></li>
                                                                                                            <li><a href="../products/jumpsuits.php.php">Bodysuits</a></li>
                                                                                                            <li><a href="../products/Tops.php">Jackets</a></li>
                                                                                                            <li><a href="../products/bags.php">Hoods</a></li>
                                                                                                            <li><a href="../products/Tops.php"> Kimono </a></li>
													</ul>
												</div>
										
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="#"><img src="../products/images/topwear.jpg" alt=" "/></a>
												</div>
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bottomwear<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
                                                                                            <div class="col-sm-4  multi-gd-img">
                                                                                                <a href="#"><img src="../products/images/bottm.jpg" alt=" "/></a>
												</div>
												<div class="col-sm-3  multi-gd-img">
													<ul class="multi-column-dropdown">											
                                                                                                            <li><a href="../products/blazers.php">Skirts</a></li>
                                                                                                            <li><a href="../products/Bottomwears.php.php">Jeans</a></li>
                                                                                                            <li><a href="../products/Bottomwears.php.php">Shorts</a></li>
                                                                                                            <li><a href="../products/Bottomwears.php">Official Pants</a></li>
													</ul>
												</div>
												 
																								<div class="clearfix"></div>
											</div>
										</ul>
									</li>
                                                                        <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dresses<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
                                                                                            <div class="col-sm-4  multi-gd-img">
                                                                                                    <a href="#"><img src="images/bottm.jpg" alt=" "/></a>
												</div>
												<div class="col-sm-3  multi-gd-img">
													<ul class="multi-column-dropdown">											
                                                                                                            <li><a href="../products/Dresses.php">Official</a></li>
                                                                                                            <li><a href="../products/Dresses.php">Shirtdress</a></li>
                                                                                                            <li><a href="../products/Dresses.php">Bodycon</a></li>
                                                                                                            <li><a href="../products/Dresses.php">Maxi</a></li>
													</ul>
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
                                                                                                            <li><a href="../products/pieces.php">Skirts Set</a></li>
														<li><a href="../products/pieces.php">Pant Set</a></li>
													</ul>
												</div>
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="#"><img src="../products/images/twop.jpg" alt=" "/></a>
												</div> 
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
                                                                        <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bags & Accessories<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-4  multi-gd-img">
													<ul class="multi-column-dropdown">											
                                                                                                            <li><a href="../products/bags.php">Sling bags</a></li>
														<li><a href="../products/bags.php">Waist Bags</a></li>
                                                                                                                <li><a href="../products/bags.php">Belts</a></li>
                                                                                                                <li><a href="../products/bags.php">Hats & Caps</a></li>
													</ul>
												</div>
												<div class="col-sm-3  multi-gd-img">
                                                                                                    <a href="products1.html"><img src="../products/images/bagim.jpg" alt=" "/></a>
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
                                                            <li><a id="trigger" class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
							</ul> <!-- cd-header-buttons -->
							<div id="cd-search" class="cd-search">
                                                            <form action="../products/search.php" method="post">
                                                                    <input name="Search" type="search" placeholder="Search..." class="search">
								</form>
							</div>	
						</div>
       
						<div class="header-right2">
							<div class="">                                                                     
					<ul class="nav navbar-nav navbar-right">
                                            
				<li class="dropdown mega-dropdown"><a href="#" class="dropdown-toggle trial"><span class="glyphicon glyphicon-shopping-cart"><sup class="badge">0</sup></a>
                                    <div class="dropdown-menu" id="drop">
                                        <div class="panel-success">
                                                    <style>
                                                        .panel-heading{
                                                            margin-top: 0;
                                                        }
                                                    </style>
      
							<div class="my-cart-d">
								<div class="row">
									<div class="col-md-8">Your Cart Items</div>
									
								</div>
							</div>
                                                    <div class="panel-body cartstuff">
								<div id="cart_product">
                                                                
								</div>
                                                        
							</div>
                                                    
							
                                                </div>
                                        <div  class="my-cart-b"> <a href="cart.php">View Cart&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></a><div id="closecart">Close</div></div>
                                        </div>
				</li>
				</ul>
                                
								
								</div>	
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>									
							
</div>
								
<div class="panel-footer" id="e_msg"></div>