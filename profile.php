<?php
session_start();
 require 'database/db.php';
if(!isset($_COOKIE['awsqawa']) && !isset($_SESSION['uid'])){
    //header("location: index");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Queens Classy</title>
<?php include 'sidenavs/jscss.php'; ?>
<div class="fixtop">
<div class="header" id="home">
	<div class="container">
            <div class="topadetop">
                <div class="col-md-5 toplog"><i class="fa fa-user"></i> 
                    <?php 
                    if(isset($_SESSION["uid"])||isset($_COOKIE['awsqawa'])){
                    if(isset($_SESSION['uid'])){
                        $name=$_SESSION['name'];   
                   }
                    elseif(isset($_COOKIE['awsqawa'])) {
                    $string=$_COOKIE['awsqawa'];
                    $contentss=  explode("_", $string);
                    $name=$contentss[1];

                    } 
                    echo $name;
                              }
                    ?>
                </div>
                <div class="col-md-5 toplog1"><a href="Login_Register/logout.php">Logout</a></div>
                
	</div>
	</div>
</div>

<!-- //header-bot -->
<!-- banner -->
<?php include 'sidenavs/bantop.php'; ?>

</div>
<!-- Modal1 -->
<?php include 'sidenavs/modals.php'; ?>
<!-- //Modal2 -->

<!-- banner -->
<?php include 'datafunctions/headerfunc.php'; ?>
<?php include 'sidenavs/body.php'; ?>
<!--grids-->
<!-- footer -->
<?php include 'sidenavs/footer.php'; ?>
<?php include 'sidenavs/scripts.php'; ?>
<link rel="stylesheet" href="css/sidebar.css"/>
<link rel="stylesheet" href="css/sidecart.css"/>

 <?php include 'sidenavs/modalIndex.php';?>
<?php include 'sidenavs/sidecart.php';?>

</body>
</html>
