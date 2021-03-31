<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    require 'database/db.php';
    require 'datafunctions/headerfunc.php';
    if (isset($_GET['cat']) && $_GET['cat'] !== '') {
        $category = $_GET['cat'];
    } else {
        header("location:index.php");
    }
    if (isset($_GET['skyu']) && $_GET['skyu']) {
        $skyu = $_GET['skyu'];
        $cat_id = json_encode(array($skyu));
    } else {
        header("location:index.php");
    }

    /* for category page SEO
     * the page defines the page titles and meta descriptions
     * for the various categories.
     */

    include 'sidenavs/cat_seo.php';

    ?>
    <title><?php echo $title ?> | Cosmetics</title>
    <?php include 'sidenavs/jscss.php'; ?>
    <meta name="description" content="<?php echo getDesc($skyu, $con); ?>">
</head>
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
<div style="margin-top: 100px">
    <div class="container">
    <?php
    include 'sidenavs/toppest.php';
    ?>
        <div class="services-breadcrumb">
            <div class="agile_inner_breadcrumb">

                <ul class="w3_short">
                    <li><a href="/">Home</a><i>|</i></li>
                    <li><?php echo $_GET['cat'] ?></li>
                </ul>
                <!--<div class="o_process" style="letter-spacing: 0;">-->
                <!--    <h5 style="text-align:center"><u>Add to Cart guide</u></h5>-->
                <!--    <ol>-->
                <!--        <li>Step 1: Click/double click the <span class="mnpts"> BUY NOW</span> button</li>-->
                <!--        <li>Step 2: Click the <span class="mnpts">size or colour</span> you want.Your cart will slide-->
                <!--            from the right-->
                <!--        </li>-->
                <!--        <li>Step 3: Enter phone number<span class="mnpts"> and proceed to order</span> or <span-->
                <!--                    style="color:rgba(192,29,129,1)">Click the x button at the top right to continue shopping</span>-->
                <!--        </li>-->
                <!--    </ol>-->
                <!--</div>-->
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
            <?php echo subcats($cat_id, $con, $ip_add, $inv) ?>
        </div>
    </div>
</div>
<!-- //mens -->
<!--/grids-->

<!-- About Category -->
<!-- Container -->
<div class="container_fluid" style="background-color: white">

    <!-- Row -->
    <div class="row is-flex">

        <!-- About Image -->
        <!-- <div class="col-lg-4" style="background-image: url('<?php echo $image ;?>');">
            <div class="box">
                <div class="page-header" style="padding-top: 60%; padding-bottom: 60%; padding-left: 10%">
                    <h1 style="color: floralwhite; font-weight: bold; font-size: 350%;"><?php echo $h1; ?></h1>
                </div>
            </div>
        </div> -->
        <!--/Column-->

        <!-- About Text -->
        <div class="col-lg-8" style="padding: 10%">
            <div class="box">
                <div class="page-header">
                    <h1 style="font-weight: bold; font-size: 200%;"> <?php echo $h1_2; ?> </h1>
                </div>
                <p><?php echo $p1; ?></p><br>
                <p><?php echo $p2; ?></p><br>
                <p><?php echo $p3; ?></p><br>

                <div style="padding-top: 5%; padding-bottom: 2%">
                    <h2 style="font-weight: bold; font-size: 150%;"><?php echo $h2; ?></h2>
                </div>
                <p><?php echo $p4; ?></p><br>
                <p><?php echo $p5; ?></p><br>
                <p><?php echo $p6; ?></p><br>

                <div style="padding-top: 5%"></div>
                <h3 style="text-align: center; font-weight: bold; font-size: larger;">Cosmetics -
                    No 1 Cosmetics</h3>

            </div>
            <!--/box-->
        </div>
        <!-- /Column -->


    </div>
    <!-- /Row -->

</div>
<!-- /Container_fluid -->
<!-- /About Category -->

<style>

    .row.is-flex {
        display: flex;
        flex-wrap: wrap;
    }

    .row.is-flex > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }


    .is-flex .box {
        background: none;
        position: static;
    }

    .is-flex [class*="col-"] {
        background: #fff;
    }

</style>

<?php include 'sidenavs/footer.php'; ?>
<?php include 'sidenavs/scripts.php'; ?>

<link rel="stylesheet" href="css/sidebar.css"/>
<link rel="stylesheet" href="css/sidecart.css"/>

<?php include 'sidenavs/modalIndex.php'; ?>
<?php include 'sidenavs/sidecart.php'; ?>

</body>
</html>