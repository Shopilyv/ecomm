<?php
session_start();
require "../database/db.php";


    $searchText = $_POST['search'];

    $sql = "SELECT id,name,SUM(quantity+quantity1+quantity2) AS qty FROM products where name like '%".$searchText."%' OR sku like '%".$searchText."%' AND image!= '<p>You did not select a file to upload.</p>'  GROUP BY sku order by qty desc limit 7";

    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0): 
        while ($row1 = mysqli_fetch_array($result)) {
                $name=$row1['name'];
                $id=$row1['id'];
                $url="product?id=$id&ptit=$name";
        ?>
<a href="<?php echo $url ?>" class="list-group-item list-group-item-action is-moved"><?php echo $name; ?></a>
        
        <?php } else: ?>
<a href="#" class="list-group-item list-group-item-action is-moved" style="color: red;">No such items</a>
  <?php  endif;
