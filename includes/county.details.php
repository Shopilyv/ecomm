<?php

require '../database/db.php';
    if($_POST){ 
        $routeid = $_POST["routeid"]; ?>
        <script>
           $('.town').click(function(){
                
               $('#post_order').find('#ordertype').val('parcel');
               var townid=$(this).val();
               var routeid="<?php echo $routeid; ?>";
               var dataString='townid='+townid+'&routeid='+routeid;
               if(townid=''){}
               else{
                $.ajax({
                    
                    type: "POST",
                    url: "includes/parcel.details.php",
                    data: dataString,
                    success: function(data){
                        $("#deliveryDetails").html(data);
                        $('#collapse3').addClass('in');
                        $('#collapse3').css('height','auto');
                        $('.savemodal').show();
                       
                       $('#collapse2').removeClass('in');
                       $('#collapse2').css('height','0px');
                       $('#cb').addClass('collapsed');
                    }
                });
               }
           });
       
           
        </script>
        
              
                    <div class="list-group rlist">
                    <?php

                    $query = "SELECT * FROM county_towns WHERE county_id=$routeid ORDER BY id ASC";
                    $result = mysqli_query($con,$query) or die(mysqli_error()."[".$query."]");
                    while ($row = mysqli_fetch_array($result)){ ?>
                        <div class="route1"> <input type="radio" name="towns" class="town" value="<?php echo $row["id"]; ?>"></input><?php echo $row["town"] ?> </div> <hr/> 
                    <?php } ?>        
                    </div>
                
            
        
<?php
        }
?>
