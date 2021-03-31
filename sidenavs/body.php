<script>

    $(document).on("click", '#closedd', function () {
        $(this).parent().parent().parent().css("display", "none");
    });


    /*function CountdownTracker(label, value){

      var el = document.createElement('span');

      el.className = 'flip-clock__piece';
      el.innerHTML = '<b class="flip-clock__card card"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b>' +
        '<span class="flip-clock__slot">' + label + '</span>';

      this.el = el;

      var top = el.querySelector('.card__top'),
          bottom = el.querySelector('.card__bottom'),
          back = el.querySelector('.card__back'),
          backBottom = el.querySelector('.card__back .card__bottom');

      this.update = function(val){
        val = ( '0' + val ).slice(-2);
        if ( val !== this.currentValue ) {

          if ( this.currentValue >= 0 ) {
            back.setAttribute('data-value', this.currentValue);
            bottom.setAttribute('data-value', this.currentValue);
          }
          this.currentValue = val;
          top.innerText = this.currentValue;
          backBottom.setAttribute('data-value', this.currentValue);

          this.el.classList.remove('flip');
          void this.el.offsetWidth;
          this.el.classList.add('flip');
        }
      }

      this.update(value);
    }

    // Calculation adapted from https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/

    function getTimeRemaining(endtime) {
      var t = Date.parse(endtime) - Date.parse(new Date());
      return {
        'Total': t,
        'Days': Math.floor(t / (1000 * 60 * 60 * 24)),
        'Hours': Math.floor((t / (1000 * 60 * 60)) % 24),
        'Minutes': Math.floor((t / 1000 / 60) % 60),
        'Seconds': Math.floor((t / 1000) % 60)
      };
    }

    function getTime() {
      var t = new Date();
      return {
        'Total': t,
        'Hours': t.getHours() % 12,
        'Minutes': t.getMinutes(),
        'Seconds': t.getSeconds()
      };
    }

    function Clock(countdown,callback) {

      countdown = countdown ? new Date(Date.parse(countdown)) : false;
      callback = callback || function(){};

      var updateFn = countdown ? getTimeRemaining : getTime;

      this.el = document.createElement('div');
      this.el.className = 'flip-clock';

      var trackers = {},
          t = updateFn(countdown),
          key, timeinterval;

      for ( key in t ){
        if ( key === 'Total' ) { continue; }
        trackers[key] = new CountdownTracker(key, t[key]);
        this.el.appendChild(trackers[key].el);
      }

      var i = 0;
      function updateClock() {
        timeinterval = requestAnimationFrame(updateClock);

        // throttle so it's not constantly updating the time.
        if ( i++ % 10 ) { return; }

        var t = updateFn(countdown);
        if ( t.Total < 0 ) {
          cancelAnimationFrame(timeinterval);
          for ( key in trackers ){
            trackers[key].update( 0 );
          }
          callback();
          return;
        }

        for ( key in trackers ){
          trackers[key].update( t[key] );
        }
      }

      setTimeout(updateClock,500);
    }

    var deadline = new Date(Date.parse(new Date()) + 12 * 24 * 60 * 60 * 1000);
    var c = new Clock(deadline, function(){ alert('countdown complete') });
    document.body.appendChild(c.el);


    */
</script>
<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
<div class="afterstuff">
    <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
            <li data-target="#myCarousel" data-slide-to="4" class=""></li>
        </ol>
        <div class="carousel-inner" role="listbox">

            <div class="item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h3> Identi<span>fy</span></h3>
                        <p>What You Want </p>
                    </div>
                </div>
            </div>
            <div class="item item2">
                <div class="container">
                    <div class="carousel-caption">
                        <h3> Clic<span>k</span></h3>
                        <p>Buy Now Button </p>
                    </div>
                </div>
            </div>
            <div class="item item3">
                <div class="container">
                    <div class="carousel-caption">
                        <h3>Sele<span>ct</span></h3>
                        <p>Your Size</p>
                    </div>
                </div>
            </div>
            <div class="item item4">
                <div class="container">
                    <div class="carousel-caption">
                        <h3>Enter<span>Contacts</span></h3>
                        <p>Proceed to Order</p>
                    </div>
                </div>
            </div>
            <div class="item item5">
                <div class="container">
                    <div class="carousel-caption">
                        <h3>Instant <span>Checkout</span></h3>
                        <p>Wait for your order</p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      
    </div> -->



    <!-- //banner -->
    <!-- <div><h3 style="text-align:center">Free Delivery Offer Expires In:</h3></div> -->


    <!-- schedule-bottom -->

    <!-- //schedule-bottom -->
    <!-- banner-bootom-w3-agileits -->
    <style>
        #demo {
            font-size: 1.7em;
        }

        @media (max-width: 600px) {
            .col-md-5 {

                width: 46.66666667%;

                margin-right: 2px;
            }

            h2, .h2 {

                font-size: 1em;

            }

            .col-md-7 {

                width: 58.33333333%;


            }

            .col-md-5, .col-md-7 {
                float: left;


                padding-left: 0;
                padding-right: 0;
            }

            #demo {
                font-size: 1em;
            }

            .grid figure h3 span {

                font-weight: 800;
                color: #000000 !important;
                font-size: 12px;
                letter-spacing: 2px;

            }

        }

    </style>
    <?php
    $date = date('Y-m-d');
    $sql = "SELECT * FROM discounts WHERE FROM_UNIXTIME(enddate+3600*10,'%Y-%m-%d')>='$date' ORDER BY Code_id DESC LIMIT 1";
    $query = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($query);

    $sqli = "SELECT * FROM index_manager WHERE wt2 !='file not uploaded' ORDER BY uploads_id DESC LIMIT 1";
    $query1 = mysqli_query($con, $sqli);
    $num_rows1 = mysqli_num_rows($query1);

    $n = 0;
    $online = "images/frontshop.jpg";
    $header = "RNG SHOP";
    if ($num_rows > 0 && $num_rows1 > 0) {

        $disc_rows = mysqli_fetch_array($query);
        $header = "Discount Offer!";

        $now = date('YmdHis');
        $s = $disc_rows['startdate'];
        $e = $disc_rows['enddate'];
        $start = date('YmdHis', $s);
        $end = date('YmdHis', $e);
        if ($now >= $start && $now <= $end) {
            $n = 1;
        }


        $images = mysqli_fetch_array($query1);
        $online = $inv . $images['wt2'];
    }

    if ($num_rows > 0 && $num_rows1 > 0) {
        if ($n == 1) {
            ?>
            <style>
                .agileinfo_schedule_bottom_left img {
                    width: 250px;
                    height: 300px;
                    text-align: center;
                }

            </style>
            <div class="container" style="margin-top: 100px">

              
            </div>
        <?php }
        
    } 
        ?>
    <div class="banner-bootom-w3-agileits">
        <div class="container" id="trending">
            <h3 class="wthree_text_info">What's <span>Trending</span></h3>

            <?php include 'trending.php'; ?>

        </div>
    </div>

    <?php
    $sql = "SELECT * FROM categories WHERE active=1";
    $query = mysqli_query($con, $sql);


    while ($row1 = mysqli_fetch_array($query)) {
        $category = $row1['name'];
        $category_id = $row1['id'];
        $cat_id = json_encode(array($category_id));
        $url = "subcats?skyu=$category_id&cat=$category";
        ?>
        <div class="container">
            <h3 class="wthree_text_info"><?php echo $category; ?>
                <a class="vall" href="<?php echo $url ?>">View All<span
                            class="glyphicon glyphicon-chevron-right"></span></a>
            </h3>
            <div id="horizontalTab">
                <?php echo catindex($cat_id, $con, $ip_add, $inv); ?>
                <!-- <div id="instafeed"></div>-->

            </div>
        </div>
    <?php } ?>

    <!-- About Queens Classy Collections -->
    <!-- Container -->
    <div class="container_fluid" style="background-color: white">

        <!-- Row -->
        <div class="row is-flex">

            <!-- About Image -->
            <div class="col-lg-4" style="background-image: url('about.jpg');">
                <div class="box">
                    <div class="page-header" style="padding-top: 100%; padding-bottom: 100%; padding-left: 10%">
                        <h1 style="color: floralwhite; font-weight: bold; font-size: 300%;">Queens Classy Collections
                            Kenya</h1>
                    </div>
                </div>
            </div>
            <!--/Column-->

            <!-- About Text -->
            <div class="col-lg-8" style="padding: 10%">
                <div class="box">
                    <div class="page-header">
                        <h1 style="font-weight: bold; font-size: 200%;">Shop Online For Ladies Clothes</h1>
                    </div>
                    <p><b>Queens Classy Collections</b> is your one stop online shop for ladies clothes in Kenya.
                        Our
                        main focus is
                        to give women the best fashion experience at the most affordable prices.</p><br>
                        <p>At our <b><i>online shop</i></b>, you can shop for and buy;
                        <a href="https://queensclassycollections.com/subcats?skyu=2&cat=Jumpsuits">jumpsuits</a>,
                        <a href="https://queensclassycollections.com/subcats?skyu=4&cat=Bottomwear">body shaping
                            jeans</a>, skirts, shorts, shirts and blouses, <a
                                href="https://queensclassycollections.com/subcats?skyu=3&cat=Topwear">trench coats</a>,
                        jackets,
                        <a href="https://queensclassycollections.com/subcats?skyu=1&cat=Dresses">dresses</a>
                        including but not limited to, bodycons, maxis, tri-peplum and skater dresses.</p><br>
                        <p>You can also find <a href="https://queensclassycollections.com/subcats?skyu=6&cat=Bags%20&%20Accessories">Sling bags</a>,
                        waist bags, women sandals and doll shoes.</p><br>
                    <p> If you’re all about a matching look, we got you too. You can find classy, trendy and
                        affordable matching sets and two piece outfits <a
                                href="https://queensclassycollections.com/subcats?skyu=5&cat=Matching%20sets">here</a>
                        just for you. </p>

                    <div style="padding-top: 5%; padding-bottom: 2%">
                        <h2 style="font-weight: bold; font-size: 150%;">Kenya’s No 1 Online Store</h2>
                    </div>
                    <p>We have our eyes set on becoming <b><i>Kenya’s largest fashion house</i></b>, this inturn
                        means that everyone at Queens Classy Collections is invested in ensuring that all our
                        clients/customers have the
                        experience of their lives while shopping with us.</p><br>
                        <p>At our online shop, you can shop, buy and pay for any of our
                        products and have it delivered at your doorstep.</p><br>
                    <p><b>Lipa na Mpesa</b> is the main mode of payment at the online shop, this is highly
                        convenient
                        for us and our clients.
                        In addition, we have recently introduced a <b>pay on delivery</b> option which allows you to
                        pay
                        for your goods once they arrive.</p><br>
                    <p>We also have an amazing support team that is always on call to assist you as you shop online
                        for
                        ladies clothes.</p><br>
                    <p>Queens Classy Collections is best known for having the best prices in the market. All our
                        products sell @<b> KSH. 999</b> and below.</p>

                    <div style="padding-top: 5%"></div>
                    <h3 style="text-align: center; font-weight: bold; font-size: larger;">Queens Classy Collection -
                        Kenya’s No 1 Online Store</h3>
                </div>
                <!--/box-->
            </div>
            <!-- /Column -->


        </div>
        <!-- /Row -->

    </div>
    <!-- /Container_fluid -->
    <!-- /About Queens Classy Collections -->

    <style>
        .vall {
            float: right;
            font-size: .8em;
            color: #fc636b;
        }

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
@media(max-width:414px){
.prod_discounts{
    width: 45%;
    float:left;
}
}
    </style>
    
 


    <!--/grids-->
    <!-- /new_arrivals -->


    <div class="coupons">
        <div class="coupons-grids text-center">
            <div class="w3layouts_mail_grid">
                <div class="row">
                    <div class="col-md-3 w3layouts_mail_grid_left">
                        <div class="w3layouts_mail_grid_left1 hvr-radial-out">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                        </div>
                        <div class="w3layouts_mail_grid_left2">
                            <h3>SHIPPING</h3>
                            <p>We do it at a fair price for you!</p>
                        </div>
                    </div>
                    <div class="col-md-3 w3layouts_mail_grid_left">
                        <div class="w3layouts_mail_grid_left1 hvr-radial-out">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                        </div>
                        <div class="w3layouts_mail_grid_left2">
                            <h3>SUPPORT</h3>
                            <p>You can call us any time between 8am-8pm from mon-sat and from 2pm-8pm on sundays</p>
                        </div>
                    </div>
                    <div class="col-md-3 w3layouts_mail_grid_left">
                        <div class="w3layouts_mail_grid_left1 hvr-radial-out">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </div>
                        <div class="w3layouts_mail_grid_left2">
                            <h3>RETURNS GUARANTEE</h3>
                            <a href="#" data-toggle="modal" data-target="#myModalx"><u style="color:rgba(192,29,129,1)">VIEW
                                    OUR RETURNS/EXCHANGES</u> POLICIES</a>
                        </div>
                    </div>
                    <div class="col-md-3 w3layouts_mail_grid_left">
                        <div class="w3layouts_mail_grid_left1 hvr-radial-out">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                        </div>
                        <div class="w3layouts_mail_grid_left2">
                            <h3>FREE GIFT COUPONS</h3>
                            <p>Surprise your loved ones with gifts from Queens classy collections</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>

        </div>
    </div>