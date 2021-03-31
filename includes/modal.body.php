
<?php
require '../database/db.php';
if($_POST){ ?>
<div class="row">
    <div class="panel-group" id="accordion">
        <!--<div class="col-md-4">-->
       
            
          
        <?php 
            switch ($_POST['region']) {
                case 'Nairobi': ?>
                    <script>
                       $('.route').click(function(){
                           $('.two').css('background','green');
                              var net_total = 0;
                              
                    	
                               var routeid = $(this).val();
                               //alert(routeid);    
                               var dataString = 'routeid='+routeid;
                               if(routeid==''){}
                               else{
                                   $.ajax({
                                       type: "POST",
                                       url: "includes/route.details.php",
                                       data: dataString,
                                       success: function(data){
                                           $("#townDetails").html(data);
                                           $('#collapse2').addClass('in');
                                           $('#collapse2').css('height','auto');
                                           
                                           $('#collapse1').removeClass('in');
                                           $('#collapse1').css('height','0px');
                                           $('#ca').addClass('collapsed');
                                       }
                                   });
                               }
                       });
                    </script>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="rem"></div>
                            <h4 class="panel-title" style="background-color: green">
                            <a id="ca">
                        #1    Select Route</a>
                          </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                          
                              <div class="rlist">
                                  <?php
                                      $query = "SELECT * FROM towns ORDER BY id ASC";
                                      $result = mysqli_query($con,$query) or die(mysqli_error()."[".$query."]");
                                      while ($row = mysqli_fetch_array($result)){ ?>
                                  <div class="route1"> <input type="radio" name="routes" class="route" price="<?php echo $row["price"]; ?>" value="<?php echo $row["id"]; ?>"><?php echo $row["route"] ?></div> <hr>   
                                  <?php } ?>
                              </div>
                          </div>
                        </div>
                      </div>
                    <div class="panel panel-default" >
                        <div class="panel-heading" style="background-color: grey">
                            <h4 class="panel-title two">
                              <a id="cb">
                               #2 Select Town 
                              </a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <div  id="townDetails" class="panel-body">
                            
                            </div>
                        </div>
            
                    </div> 
                    
                    
                    <?php
                    break;
                case 'OutNai':?>
                      <script>
                       $('.towns').click(function(){
                           $('.two').css('background','green');
                           var routeid = $(this).val();
                           //alert(routeid);    
                           var dataString = 'routeid='+routeid;
                           if(routeid==''){}
                           else{
                               $.ajax({
                                   type: "POST",
                                   url: "includes/county.details.php",
                                   data: dataString,
                                   success: function(data){
                                       $("#townDetails").html(data);
                                       $('#collapse2').addClass('in');
                                       $('#collapse2').css('height','auto');
                                       
                                       $('#collapse1').removeClass('in');
                                       $('#collapse1').css('height','0px');
                                       $('#ca').addClass('collapsed');
                                   }
                               });
                           }
                       });
                    </script>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title two" style="background-color: green">
                            <a id="ca">
                          #1  Select County</a>
                          </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                          <div class="panel-body">
                              <div class="rlist">
                                  <?php
                                      $query = "SELECT * FROM counties ORDER BY id ASC";
                                      $result = mysqli_query($con,$query) or die(mysqli_error()."[".$query."]");
                                      while ($row = mysqli_fetch_array($result)){ ?>
                                  <div class="route1"><input type="radio" name="routes" class="towns" value="<?php echo $row["id"]; ?>"><?php echo $row["county"] ?> </div><hr>   
                                  <?php } ?>
                              </div>
                          </div>
                        </div>
                      </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title two" style="background-color: grey">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                             #2   Select Town 
                              </a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <div  id="townDetails" class="panel-body">
                            
                            </div>
                        </div>
            
                    </div> 
                    
                    

                  <?php  break;
                case 'OutKe':?>
 <script>
                       $('.cities').click(function(){
                           var routeid = $(this).val();
                           //alert(routeid);    
                           var dataString = 'routeid='+routeid;
                           if(routeid==''){}
                           else{
                               $.ajax({
                                   type: "POST",
                                   url: "includes/country.details.php",
                                   data: dataString,
                                   success: function(data){
                                       $("#townDetails").html(data);
                                   }
                               });
                           }
                       });
                    </script>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title two" style="background-color: grey">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                           #1 Select Country</a>
                          </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                          <div class="panel-body">
                              <div class="rlist">
                                  <?php
                                      $query = "SELECT * FROM countries ORDER BY id ASC";
                                      $result = mysqli_query($con,$query) or die(mysqli_error()."[".$query."]");
                                      while ($row = mysqli_fetch_array($result)){ ?>
                                  <input type="radio" name="routes" class="cities" value="<?php echo $row["id"]; ?>"><?php echo $row["country"] ?> <hr>   
                                  <?php } ?>
                              </div>
                          </div>
                        </div>
                      </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title" style="background-color: grey">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            #2    Select City 
                              </a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <div  id="townDetails" class="panel-body">
                            
                            </div>
                        </div>
            
                    </div> 
                    
                    
                    
                    
                    
                    
                   <?php break;

                default:
                    break;
            }
                
          
        ?>
      
    <!--</div>-->
    <div class="col-md-8">
        <div id="deliveryDetails">
            
        </div> 
    </div>
   </div>  
</div>
         

<?php
    
}else{
    echo "No Results Shown";
}
?>

