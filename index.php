<?php
session_start();
require 'database/db.php';
if (isset($_SESSION["uid"]) || isset($_COOKIE['awsqawa'])) {
    if (isset($_SESSION['uid'])) {
        $name = $_SESSION['name'];
    } elseif (isset($_COOKIE['awsqawa'])) {
        $string = $_COOKIE['awsqawa'];
        $contentss = explode("_", $string);
        $name = $contentss[1];

    }
    $space = "  ";

    //header("location:profile");
    $log_status = ' <div class="header" id="home">
            <div class="container">
                <div class="topadetop">
                    <div class="col-md-5 toplog"><i class="fa fa-user"></i>' . $space . '' . $name . '</div>
                    <div class="col-md-5 toplog1"><a href="Login_Register/logout.php">Logout</a></div>

                </div>
            </div>
        </div>';

} else {
    $log_status = "";
}
$referrer="None";
if(isset($_GET['rfr']) && $_GET['rfr'] !==""){
   $referrer=$_GET['rfr']; 
  $getusql="SELECT * FROM users WHERE id=$referrer";  
  $getusquery=mysqli_query($con,$getusql);
   if(mysqli_num_rows($getusquery)>0){
       $getusrdata=mysqli_fetch_array($getusquery);
       $refername=$getusrdata['username'];
        setcookie('rfr', $refername, time() + (86400 * 3), "/");
        setcookie('rfrid', $referrer, time() + (86400 * 3), "/");
   }   
  
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ladies Clothes - Shop online for ladies clothes, hand bags and accessories - KSH 999 and below | Queens
        Classy Collection Kenya</title>
         <meta name="description"
          content="Shop Online for ladies clothes, handbags/slingbags, bodyshaper jeans and Trench coats and have them delivered at your doorstep. We have the most affordable prices in the market. Ksh.999\= and below">
    <meta property="og:image" content="http://queensclassycollections.com/images/frontshop.jpg">
    <?php include 'sidenavs/jscss.php'; ?>
  <div class="fixtop">

        <!-- //header-bot -->
        <!-- banner -->

        <?php
        echo $log_status;
        include 'sidenavs/bantop.php';
        ?>

    </div>
 <div class="darkboody"></div>

    <?php
    echo $log_status;
    include 'sidenavs/toppest.php';
    ?>

    <!-- //banner-top -->
    <!-- Modal1 -->
    <?php 
    include 'sidenavs/modals.php';
     ?>
    <!-- //Modal2 -->

    <!-- banner -->
    <?php
    include 'datafunctions/headerfunc.php';
    include 'sidenavs/body.php'; ?>
    <!--grids-->
    <!-- footer -->
    <?php include 'sidenavs/footer.php'; ?>
    <?php include 'sidenavs/scripts.php'; ?>

    <?php include 'sidenavs/modalIndex.php'; ?>
    <?php include 'sidenavs/sidecart.php'; ?>

    </div>
    <script>
        $(document).ready(function(){
              $('.csstransforms3d').click(function(){
               $.ajax({
                	url : "postFiles/update.logged.php",
                	method : "POST",
                	data : {logged:'now'},
                	success : function(data){
                		console.log(data);
                	}
                }); 
            });
        });
    </script>
    </body>
</html>

<!--return policy moday-->
<div class="modal fade" id="myModalx" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
                                            
						<button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3>Returns & Exchanges Policies</h3>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="modal_body_left modal_body_left1">
                                                
                                                                                <ol>
                                                                                    <li>QueensClassyCollection’s online returns portal can only be used to return items <b>PURCHASED ONLINE</b> at <a href="queensclassycollections.com/queensclassy" style="color:rgba(192,29,129,1)">QueensClassyCollections.com</a></li>
                                                                                    <li>Exchanges/returns are within 3 days from the time you receive your item.</li>
                                                                                    <li>Please allow 24hrs for us to process your return once it is received by our Distribution Center. You will receive a confirmation Code once the return is approved</li>
                                                                                    <li>We <b>STRICTLY</b> don't accept exchanges/returns for bodysuits and inner wears.</li>
                                                                                    <li>We don't give cash refunds. Incase you exchange with a cheaper item or return an item, we will keep your balance as a store credit which you can redeem in your next purchase.</li>
                                                                                    <li>The shipping cost for a return/exchange, will be covered by the customer. We might pay where necessary.</li>
                                                                                    <li>Damaged or defective items must be reported within the same day of delivery.</li>
                                                                                    <li>Items must be unworn, unwashed, and have original tags attached.</li>
                                                                                    <li> Items must be free of stains, makeup, deodorant, or wear. </li>
                                                                                    <li>Queens Classy Collections is not liable for any return packages that may become lost or stolen in-transit. Please keep your proof of postage.</li>
                                                                                </ol>
                                                <a href="tel:+254110025225" class="my-cart-b">Request Exchange</a>
						  <ul class="social-nav model-3d-0 footer-social w3_agile_social top_agile_third">
															<li><a href="https://www.facebook.com/Queensclassycollections/" class="facebook">
																  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
															<li><a href="https://www.instagram.com/queensclassycollections/" class="instagram">
																  <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
                                                  </ul>
														<div class="clearfix"></div>
														

						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
