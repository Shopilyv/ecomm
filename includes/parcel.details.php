<?php
require '../database/db.php';
if($_POST){
   
    $townid = $_POST['townid'];
    $routeid = $_POST['routeid'];
    $sql1 = "SELECT * FROM counties WHERE id=$routeid";
    $sql2 = "SELECT * FROM county_towns WHERE id=$townid";
    $res1 = mysqli_query($con, $sql1);
    $res2 = mysqli_query($con, $sql2);
    
    $county = mysqli_fetch_object($res1);
    $town = mysqli_fetch_object($res2); 
?>
<script src="../js/paynow.js"></script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title parcel" style="background:green;">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
    #3   View Estimated Cost</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
        <div>
            <div id="rdetails">
            <div> <p>County:&nbsp;<span style="visibility: hidden" class="js-route"><?php echo $county->id; ?></span><?php echo $county->county; ?></p></div>
            <div> <p>Town:&nbsp;<span style="visibility: hidden" class="js-town"><?php echo $town->id; ?></span><?php echo $town->town; ?></p></div>
            <div id="deprice"> <p>Price:&nbsp;<?php echo "KSH. ".number_format(floatval($county->price),2,'.',','); ?></p></div>
            <div class="totalcost"></div>
            <div id="courier"><p>Courier:&nbsp;<?php echo $county->Courier; ?></p></div>
            </div>
            <div class="form-group" id="hours" style="margin-top: 25px;">
         
                <script>
             
                var deliv="<?php echo $county->price ?>";

                 calcost(deliv);
            </script>
            <label for="exampleFormControlTextarea1">Landmark/Extra notes</label>
              <textarea class="form-control" id="lmark" rows="3" placeholder="Add A Note(Optional)"></textarea>
            </div>
                <input type="hidden" id="del" value="2" />
        </div>
    </div>
</div>

</div>
        
<?php }