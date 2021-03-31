<div class="container searchtop"> 

<div class="row">
<div class="col-md-12">


                
<div class="searchdiv">

<div class="push">
        <input name="search" type="search" placeholder="Search item..." class="form-control search qccsearch">
        <span><button type="submit" class="btn btn-success qccpost"><i class="fa fa-search"></i></button></span>
        <div class="searcherror"></div>
  
</div>
                                         
     </div>
<div class="dropoptions" >
  <nav class="navbar navbar-default" style="margin-left: 15%">
    <div class="container-fluid" style="background-color: rgba(192, 29, 129, 1)">
    <!-- Brand and toggle get grouped for better mobile display -->
    
                          <div class="navbar-header">
                              <div class="optns">
      <button type="button" class="navbar-toggle collapsed showSide">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
                              </div>
                              <div class="checkouts">
                              <button type="button" class="navbar-toggle collapsed">Cart</button>
                              </div>
    </div>
                            
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                                
      <ul class="nav navbar-nav menu__list">
                                      <?php

        $sql="SELECT * FROM categories WHERE active=1";
        $query=  mysqli_query($con, $sql);



        while ($row1 = mysqli_fetch_array($query)) {
            $category=$row1['name'];
            $category_id=$row1['id'];
            
            
          $url="subcats?skyu=$category_id&cat=$category";
            
            
                

        ?>

<li class=" menu__item"> <a class="menu__link" href="<?php echo $url ?>" class="list-group-item list-group-item-action"><?php echo $category; ?></a></li>

<?php  } ?>
      
                                    
      </ul>
                                
                                
    </div>
    </div>
  </nav>	
</div>
</div>
</div>

</div>