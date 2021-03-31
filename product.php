<html>
<head>
    <?php
    session_start();
    require 'database/db.php';
    require 'datafunctions/headerfunc.php';
    $id=-1;
    $prtitle='';
    if (isset($_GET['ptit']) && $_GET['ptit'] != '') {
        $prtitle = $_GET['ptit'];
    }
    if (isset($_GET['id']) && $_GET['id'] !='') {
        $id = $_GET['id'];

    }
if($id<1 || $prtitle==''){
        header("location:index.php");
        exit();
    }
    //for og: image
    $sql2 = "SELECT * FROM products WHERE id='$id'";
    $query2 = mysqli_query($con, $sql2);
$img="";
if(mysqli_num_rows($query2)>0){
    $row2 = mysqli_fetch_array($query2);
    $img = $row2['image'];
}

    ?>
    <title><?php echo $prtitle ?> for women Kenya @ affordable prices online | Queens Classy Collections</title>
    <meta name="description"
          content="Get the <?php echo $prtitle ?> for women and other ladies clothes online at Queens Classy Collections Kenya. We process and deliver your order as fast and efficently as possible. The pay on delivery option is now available.">
    <meta property="og:image" content="<?php echo $inv . $img ?>">
    <!--<meta property="og:image:width" content="1200" >-->
    <!--<meta property="og:image:height" content="630" >-->
    <?php include 'sidenavs/jscss.php'; ?>

</head>
<body>

<!-- header -->
<div class="fixtop">
    <!-- //header-bot -->
    <!-- banner -->
    <?php include 'sidenavs/bantop.php'; ?>

</div>
<?php include 'sidenavs/modals.php'; ?>
<?php
$sql = "SELECT * FROM products WHERE id='$id'";
$query = mysqli_query($con, $sql);
if(mysqli_num_rows($query)>0){
while ($row = mysqli_fetch_array($query)) {
    $product = $row['name'];

    $price = $row['price'];
    $dprice = $row['dprice'];
    $per = $row['per'];
    $descr = $row['description'];
    $sku = $row['sku'];
    $colour = $row['colour'];
    $image = $row['image'];


$amount = $price;
$discount = 0;
$del = "";
if ($price > $dprice) {
    if ($per < 2) {
        $amount = $dprice;
        $discount = $price - $dprice;
        $del = "<del>Ksh." . $price . "</del>  ";
    }
}

$sql1 = "SELECT * FROM products WHERE sku='$sku' AND availability='1'  GROUP BY colour ORDER BY case when id = '$id' then 1 else 2 end ";

$query1 = mysqli_query($con, $sql1);
?>
<div class="page-head_agile_info_w3l">
    <div class="container">
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">

                <ul class="w3_short">
                    <li><a href="index.php">Home</a><i>|</i></li>
                    <li><?php echo $product; ?></li>
                </ul>
            </div>
        </div>
        <!--//w3_short-->
    </div>
</div>

<div class="banner-bootom-w3-agileits">
    <div class="container" style="background-color: white">
        <div class="col-md-4 single-right-left ">
            <div class="flexslide">
                    
                    <img src="<?php echo $inv . $image ?>" alt="<?php echo $product; ?>" class="img-responsive">
                    
                    <div class="clearfix"></div>
                </div>
           
        </div>
        <div class="col-md-8 single-right-left simpleCart_shelfItem">
            <div class="" style="padding: 5%">
                <div class="col-md-8" style="border-right: #2A2B2F; padding: 3%">
                    <h3> <?php echo $product; ?></h3>

                    <p><?php echo $del; ?>Ksh.<span class="item_price"><?php echo $amount; ?></span></p>

                    <div class="description">
                        <h5><?php echo $descr ?></h5>
                        <!--<form action="#" method="post">
                       <input type="text" value="Enter Discount Code" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter pincode';}" required="">
                       <input type="submit" value="Apply">
                       </form> -->
                    </div>

                    <?php
                    echo '<div class="info-product-price">
                                                <span class="item_price">' . $colour . '</span>
										      </div>
										<div class="col-md-4">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" disc="' . $discount . '" prod_id="" size="">
                                                          BUY NOW
                                                           <i class="glyphicon glyphicon-triangle-bottom" style="float:right; top: 6px; border-radius:0;"></i>
                                                        </button>
                                                        <div class="dd">
                                                        <div class="sizesheader"><h4>'.$product.'<span class="closedds"><img src="images/icon-close.png"></span></h4></div>
                                                        <ul>
                                                        <h4>*Click one variant to buy*</h4>
                                                        ';
                    $sql3 = "SELECT * FROM products where `name`='$product' AND colour='$colour' AND image !='<p>You did not select a file to upload.</p>'  AND availability='1' GROUP BY sizes";
                    $query6 = mysqli_query($con, $sql3);
                    foreach ($query6 as $row) {
                        $sizes = $row['sizes'];
                        $colour = $row['colour'];
                        $statement = 'Buy Size <span id="lisize">' . $sizes . '</span> <span id="added"></span>';
                        if ($sizes == '') {
                            $sizes = $colour;
                            $statement = 'Buy Colour <span id="lisize">' . $sizes . '</span>';
                        }

                        $id = $row['id'];

                        $q = $row['quantity'];
                        $q1 = $row['quantity1'];
                        $q2 = $row['quantity2'];

                        $quantity = $q + $q1;


                        if ($q > 0 && $q1 > 0) {
                            $store = "G12";
                        } elseif ($q > 0 && $q1 < 1) {

                            $store = "G12";
                        } elseif ($q < 1 && $q1 > 0) {

                            $store = "RNG";
                        }
                        if ($quantity < 1) {
                            echo '
                                                                  <li id="" class="list_size" href="#" pro_id="' . $id . '" notif="yes">Size <span id="lisize">' . $sizes . '</span>-SOLD OUT</li><br/>
                                                                ';
                        } elseif ($quantity > 0) {

                            echo '<li id="" class="list_size" href="#" pro_id="' . $id . '" size="' . $sizes . '" store="' . $store . '" disc="' . $discount . '" price="' . $amount . '" notif="no">' . $statement . '</li><br/>';

                        }
                    }

                    echo "
                                   </ul>
                                  <div class='sizesguide' data-toggle='modal' data-target='#sizeguide'>Sizes Guide</div>
                            </div>
                          </div>
		
                      </div>";

                    ?>

                </div>


                <!--<div class="col-md-4" style="padding: 10%">-->
                    <!--            facebook share button-->
                <!--    <?php $fb_url = "https://queensclassycollections.com/product?id=$id&ptit=$product" ?>-->

                <!--    <hr style="background-color: darkgrey; height: 1px;">-->

                <!--    <div style="float: right; margin-top: 5px; margin-bottom: 5px;" class="fb-share-button"-->
                <!--         data-href="<?php echo $fb_url ?>"-->
                <!--         data-layout="button"></div>-->

                <!--</div>-->
            </div>

        </div>
        <div class="clearfix"></div>

        <!-- //new_arrivals -->
        <!--/slider_owl-->
        <hr style="background-color: darkgrey; height: 1px;">
        <div class="w3_agile_latest_arrivals">
            <hr style="background-color: darkgrey; height: 1px;">
            <h3 class="wthree_text_info">Shop <span>Other Colours</span></h3>

            <?php


            $sql = "SELECT * FROM products WHERE sku='$sku' AND colour!='$colour' AND image !='<p>You did not select a file to upload.</p>'  AND availability='1' GROUP BY colour";
            $query = mysqli_query($con, $sql);
            if (mysqli_num_rows($query) > 0) {
                $n = 0;
                while ($row = mysqli_fetch_array($query)) {
                    $pro_id = $row['id'];
                    $pro_cat = $row['category_id'];
                    $pro_title = $row['name'];

                    $pro_price = $row['price'];
                    $dprice = $row['dprice'];

                    $pro_image = $row['image'];

                    $colour = $row['colour'];
                    $sizes = $row['sizes'];
                    $sku = $row['sku'];
                    $stock_status = $row['stock_status'];

                    $nem = $pro_title;
                    $strlen = strlen($nem);

                    if ($strlen > 23) {
                        $nem = substr($pro_title, 0, 23) . "..";
                    }

                    $amount = $pro_price;
                    $discount = 0;
                    $del = "";
                    if ($pro_price > $dprice) {
                        if ($per < 2) {
                            $amount = $dprice;
                            $discount = $pro_price - $dprice;
                            $del = "<del>Ksh." . $pro_price . "</del>  ";
                        }
                    }


                    $fb_url2 = "https://queensclassycollections.com/product?id=$pro_id&ptit=$pro_title";
                    echo '<div class="col-md-3 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="' . $inv . $pro_image . '" alt="" class="pro-image-front">
										<img src="' . $inv . $pro_image . '" alt="" class="pro-image-back">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
												
														 <!-- facebook share button-->	
                    
                      <div style="float: right; margin-top: 5px; margin-bottom: 5px;" class="fb-share-button"
                         data-href="' . $fb_url2 . '"
                         data-layout="button"></div>
												
													<a href="product?id=' . $pro_id . '&ptit=' . $pro_title . '" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
											
									</div>
									<div class="item-info-product">
										<h4><a href="product?id=' . $pro_id . '&ptit=' . $pro_title . '">' . $nem . '</a></h4>';

                    echo '<div class="info-product-price">
                                                <span class="item_color">' . $colour . '</span><br/>' . $del . '
											Ksh.<span class="item_price">' . $amount . '</span>
										      </div>
										<div class="">
                                                  <div class="btn-group opendrop">
                                                        <button type="button" class="btn btn-secondary hvr-outline-out addcart" disc="' . $discount . '" prod_id="" size="">
                                                          BUY NOW
                                                           <i class="glyphicon glyphicon-triangle-bottom" style="float:right; top: 6px; border-radius:0;"></i>
                                                        </button>
                                                        <div class="dd">
                                                        <div class="sizesheader"><h4>'.$pro_title.'<span class="closedds"><img src="images/icon-close.png"></span></h4></div>
                                                        <ul>
                                                        <h4>*Click one variant to buy*</h4>
                                                        ';
                    $sql3 = "SELECT * FROM products where `name`='$pro_title' AND colour='$colour' AND image !='<p>You did not select a file to upload.</p>'  AND availability='1' GROUP BY sizes";
                    $query6 = mysqli_query($con, $sql3);
                    foreach ($query6 as $row) {
                        $sizes = $row['sizes'];
                        $colour = $row['colour'];
                        $statement = 'Buy Size <span id="lisize">' . $sizes . '</span> <span id="added"></span>';
                        if ($sizes == '') {
                            $sizes = $colour;
                            $statement = 'Buy Colour <span id="lisize">' . $sizes . '</span>';
                        }

                        $id = $row['id'];

                        $q = $row['quantity'];
                        $q1 = $row['quantity1'];
                        $q2 = $row['quantity2'];

                        $quantity = $q + $q1;


                        if ($q > 0 && $q1 > 0) {
                            $store = "G12";
                        } elseif ($q > 0 && $q1 < 1) {

                            $store = "G12";
                        } elseif ($q < 1 && $q1 > 0) {

                            $store = "RNG";
                        }
                        if ($quantity < 1) {
                            echo '
                                                                  <li id="" class="list_size" href="#" pro_id="' . $id . '" notif="yes">Size <span id="lisize">' . $sizes . '</span>-SOLD OUT</li><br/>
                                                                ';
                        } elseif ($quantity > 0) {

                            echo '
                                                              <li id="" class="list_size" href="#" pro_id="' . $id . '" size="' . $sizes . '" store="' . $store . '" disc="' . $discount . '" price="' . $amount . '" notif="no">' . $statement . '</li><br/>
                                                                ';

                        }
                    }

                    echo "
                                                           </ul>
                                                           <div class='sizesguide' data-toggle='modal' data-target='#sizeguide'>Sizes Guide</div>
                                                           </div>
                                                      </div>
                                                                                 
														
                                </div>

                            </div>
                    </div>
            </div>";

                }

            }
}
}
            ?>

            <div class="clearfix"></div>
            <!--//slider_owl-->
        </div>
    </div>
</div>

<!--grids-->
<!-- footer -->
<?php include 'sidenavs/footer.php'; ?>
<!-- //footer -->


<!-- //login -->
<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover"
                                                                         style="opacity: 1;"> </span></a>
<!-- js -->

<!-- //js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!-- Custom-JavaScript-File-Links -->
<!-- cart-js -->
<script src="js/minicart.min.js"></script>


<!-- //cart-js -->
<!-- single -->
<script src="js/imagezoom.js"></script>
<!-- single -->
<!-- script for responsive tabs -->
<script src="js/easy-responsive-tabs.js"></script>
<script>
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
<!-- FlexSlider -->
<script src="js/jquery.flexslider.js"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function () {
        $('.flexslider').flexslider({});
    });
</script>
<!-- //FlexSlider-->
<!-- //script for responsive tabs -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });


    });
</script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
<!-- //here ends scrolling icon -->

<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap.js"></script>

<link rel="stylesheet" href="css/sidebar.css"/>
<link rel="stylesheet" href="css/sidecart.css"/>

<?php include 'sidenavs/modalIndex.php'; ?>
<?php include 'sidenavs/sidecart.php'; ?>
</body>
</html>


