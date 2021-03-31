<?php

require '../database/db.php';
    if($_POST){ 
        $routeid = $_POST["routeid"]; ?>
        <script>
           $('.cities').click(function(){
               var townid=$(this).val();
               var routeid="<?php echo $routeid; ?>";
               var dataString='townid='+townid+'&routeid='+routeid;
               if(townid=''){}
               else{
                $.ajax({
                    type: "POST",
                    url: "includes/countryparcel.details.php",
                    data: dataString,
                    success: function(data){
                        $("#deliveryDetails").html(data);
                    }
                });
               }
           });
        </script>
        
              
                    <div class="list-group rlist">
                    <?php

                    $query = "SELECT * FROM cities WHERE country_id=$routeid ORDER BY id ASC";
                    $result = mysqli_query($con,$query) or die(mysqli_error()."[".$query."]");
                    while ($row = mysqli_fetch_array($result)){ ?>
                        <input type="radio" name="towns" class="cities" value="<?php echo $row["id"]; ?>"></input><?php echo $row["city"] ?>  <hr/> 
                    <?php } ?>        
                    </div>
                
            
        
<?php
        }
?>
