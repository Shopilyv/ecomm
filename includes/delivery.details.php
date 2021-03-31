<?php
require '../database/db.php';

if($_POST){
    $townid = $_POST['townid'];
    $routeid = $_POST['routeid'];
    $sql1 = "SELECT * FROM towns WHERE id=$routeid";
    $sql2 = "SELECT * FROM speftown WHERE id=$townid";
    $res1 = mysqli_query($con, $sql1);
    $res2 = mysqli_query($con, $sql2);
    
    $route = mysqli_fetch_object($res1);
    $town = mysqli_fetch_object($res2); 
?>
<script src="../js/paynow.js"></script>

    
<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"  style="background-color: green" id="showdetail">
        <a id="cc">
    #3   View Estimated Cost</a>
      </h4>
    </div>
     
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
        <div>
            <div id="rdetails">
            <div> <p>Route:&nbsp;<span style="visibility: hidden" class="js-route"><?php echo $route->id; ?></span><?php echo $route->route; ?></p></div>
            <div> <p>Town:&nbsp;<span style="visibility: hidden" class="js-town"><?php echo $town->id; ?></span><?php echo $town->town; ?></p></div>
            <div id="deprice"> <p>Price:&nbsp;<?php echo "KSH. ".number_format(floatval($route->price),2,'.',','); ?></p></div>
            <div class="totalcost"></div>
            </div>
            <div class="form-group" id="hours" style="margin-top: 25px;">
              
            <script>
                var deliv="<?php echo $route->price ?>";
                 calcost(deliv);
            </script>
              <label for="exampleFormControlTextarea1">Landmark/Extra notes</label>
              <textarea class="form-control" id="lmark" rows="3" placeholder="Add A Note(Optional)"></textarea>
            </div>
            <input type="hidden" id="del" value="1" />
        </div>
    </div>
</div>


        
<?php } ?>
</div>