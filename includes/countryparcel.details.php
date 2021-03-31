<?php
require '../database/db.php';
if($_POST){
    
    $townid = $_POST['townid'];
    $routeid = $_POST['routeid'];
    $sql1 = "SELECT * FROM countries WHERE id=$routeid";
    $sql2 = "SELECT * FROM cities WHERE id=$townid";
    $res1 = mysqli_query($con, $sql1);
    $res2 = mysqli_query($con, $sql2);
    
    $country = mysqli_fetch_object($res1);
    $city = mysqli_fetch_object($res2); 
?>
<script src="main.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title" style="background:grey">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
      #3  Estimated Cost</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
        <div>
            <div id="rdetails">
            <div> <p>Country:&nbsp;<span style="visibility: hidden" class="js-route"><?php echo $country->id; ?></span><?php echo $country->country; ?></p></div>
            <div> <p>City:&nbsp;<span style="visibility: hidden" class="js-town"><?php echo $city->id; ?></span><?php echo $city->city; ?></p></div>
            <div id="deprice"> <p>Price:&nbsp;<?php echo "KSH. ".number_format(floatval($country->price),2,'.',','); ?></p></div>
            </div>
            <div class="form-group" id="hours" style="margin-top: 25px;">
                <h4></h4>
                
                <a href="https://wa.me/254713909393"><input type="submit" name="submit" value="TEXT ON WHATSAPP" id="whatsapp" class="my-cart-b"></a>
                <script>

                var deliv="<?php echo $route->price ?>";


                    $('#labex').hide();
                    $('#labex1').hide();
                    $('#labex2').hide();
                    $('#labex3').hide();

                    $('#mpesa').hide();
                    $('#name').hide();
                    $('#phone').hide();
                    $('#delivery1').hide();

                var net_total = 0;
                        $('.qty').each(function(){
                                var row = $(this).parent().parent();
                                var price  = row.find('.price').val();
                                var total = price * $(this).val()-0;
                                row.find('.total').val(total);
                        });
                        $('.total').each(function(){
                                net_total += ($(this).val()-0);
                        });
                        var rem= 5000-net_total;
                        
                        $('#remainder').html("You are " +rem+ "away From getting a free delivery");



                        if (net_total>5000){
                            $('#mpesa').val(net_total);
                                            }
                        else{
                            $('#mpesa').val(net_total+(deliv-0)+100);
                        }


                    $('input[type="radio"]').click(function(){
                      if ($(this).is(':checked'))
                      {
                       var value= $(this).val();

                       if (value==="within"){

                        $('#delivery').addClass("panel");
                        $('#labex').show();
                        $('#labex1').show();
                        $('#labex2').show();
                        $('#labex3').show();

                        $('#mpesa').show();
                        $('#name').show();
                        $('#phone').show();
                        //$('#delivery1').removeAttr('hidden');
                        $('#delivery1').show();

                        }
                        else{
                            $('#delivery').removeClass("panel");
                            $('#labex').hide();
                            $('#labex1').hide();
                            $('#labex2').hide();
                            $('#labex3').hide();

                            $('#mpesa').hide();
                            $('#name').hide();
                            $('#phone').hide();
                            $('#delivery1').hide();


                        }


                      }
                    });

                </script>
                <style>
                    #rdetails{
                     font-size: 1.5em; 
                    }
                    
                    .border{
                      border: 2px solid red;
                    } 
                    #labex3{
                        text-align: center;
                    }
                    #error{
                        color: red;
                        font-size: 1em;
                    }
                  
                    @media(min-width:726px){
                        
                        .multi-gd-img {

                    float: left !important;
                    width: 50% !important;
                    margin-left: 20% !important;
                    }
                    .form-control{
                        width: 60%;
                    }
                    .tabfields{
                       margin-left: 17%;  
                    }
                        
                    }
                    @media(max-width:725px){
                    .multi-gd-img {

                    float: left;
                    width: 90%;
                    margin-left: 45%;
                    }
                    .form-control{
                        width: 80%;
                    }
                    }
                    @media(max-width:420px){
                      .multi-gd-img {
                        width: 77%;
                        margin-left: 15% !important;
                        margin-top: 0px;
                        margin-right: 3px;
                    }
                    .form-control{
                        width: 80%;
                    }
                    }

                </style>
                <div id="delivery" class="panel-default">
                </div>
            </div>

        </div>
    </div>
</div>


        
<?php } ?>