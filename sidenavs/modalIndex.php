<div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4>Notify Me</h4>
					</div>
						<div class="modal-body modal-body-sub_agile">
						<div class="notify">
                                                    
						<h3 class="agileinfo_sign">Phone Number</h3>
                                                <form action="" method="post" id="notice">
							<div class="styled-input agile-styled-input-top">
                                                            <input type="text" class="form-control" id="phonenumber" name="phone" required="">
								<input type="hidden" name="pro_id" id="notify" pid=""/>
								<span></span>
							</div>
                                                    <input class="my-cart-b" type="submit" id="sendnotif" value="NOTIFY ME">
						</form>
						 
						</div>
                                                    <div id="error"></div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>
		
		<div class="modal fade" id="sizeguide" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4>Sizes Chart</h4>
					</div>
						<div class="modal-body modal-body-sub_agile">
                    		<div class="table table-responsive" style="font-size:.75em">
                              <table>
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Size</th>
                          <th scope="col">Bust</th>
                          <th scope="col">Waist</th>
                          <th scope="col">Hips</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">X-small</th>
                          <td>2-4</td>
                          <td>30-32</td>
                          <td>23.5-25.5</td>
                          <td>34-36</td>
                        </tr>
                        <tr>
                          <th scope="row">Small</th>
                          <td>5-6</td>
                          <td>32-34</td>
                          <td>25.5-27.5</td>
                          <td>36-38</td>
                        </tr>
                        <tr>
                          <th scope="row">Medium</th>
                          <td>8-9</td>
                          <td>34-36</td>
                          <td>27.5-29.5</td>
                          <td>38-40</td>
                        </tr>
                        <tr>
                          <th scope="row">Large</th>
                          <td>10-12</td>
                          <td>36-38</td>
                          <td>29.5-31.5</td>
                          <td>40-42</td>
                        </tr>
                        <tr>
                          <th scope="row">XL</th>
                          <td>13-14</td>
                          <td>38-40</td>
                          <td>31.5-33.5</td>
                          <td>42-44</td>
                        </tr>
                        <tr>
                          <th scope="row">2/3XL</th>
                          <td>15-16</td>
                          <td>40-42</td>
                          <td>33.5-35.5</td>
                          <td>44-46</td>
                        </tr>
                      </tbody>
                    </table>
                    	</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- //Modal content-->
			</div>
		</div>

        <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

              <!-- Change class .modal-sm to change the size of the modal -->
              <div class="modal-dialog modal-lg" role="document">


                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Set Location</h4>
                    <hr>
                  </div>
                   
                  <div id="modalBody" class="modal-body">
                    
                  </div>
                
                  <div class="modal-footer">
                          <div id="landm"></div>
                    <!--<a href="https://wa.me/254721809280"><button type="button"  class="btn btn-primary btn-sm savemodal">Save</button></a>-->
                    <button type="button"  class="my-cart-b savemodal">Save</button>
                    
                  </div>
                </div>

                  
              </div>
            </div>
            <div class="modal fade" id="setloc" tabindex="-1" role="dialog" aria-labelledby="loctitle" aria-hidden="true">

              <!-- Change class .modal-sm to change the size of the modal -->
              <div class="modal-dialog modal-lg" role="document">


                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title w-100" id="loctitle">Set Location</h4>
                  </div>
                   
                  <div class="modal-body">
                      <div class="pushloc">
                                <input name="search" type="search" placeholder="Search Location..." class="form-control search qccsearchloc">
                                <span><button type="submit" class="btn btn-success qccloc"><i class="fa fa-search"></i></button></span>
                                <div class="slocerr"></div>
                        </div>
                        <div id="locbody" class="locbody">
                    <?php 
                    $sql="SELECT towns.id AS townid,speftown.id as spefid,price,town FROM speftown INNER JOIN towns ON (speftown.town_id=towns.id) ORDER BY speftown.id DESC";
                    $query=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($query)){
                        $price=$row['price'];
                        $routid=$row['townid'];
                        $speftid=$row['spefid'];
                        $town=$row['town']; ?>
                        <div class="routez"> <input type="radio" name="routez" class="routes" price="<?php echo $price; ?>"  value="<?php echo $routid; ?>" speftown="<?php echo $town ?>" spefid="<?php echo $speftid; ?>"> <?php echo $town ?></div>
                  <?php  }
                    ?>
                    </div>
                    <div class="describe" id="describe" style="margin-top: 2px;">
                        <div id="routedetails">
                            <div id="delitown"></div>
                            <div id="deliprice"></div>
                            <div class="totocost">
                               
                            </div>
                             <script>
                             function totalCost(deliv){ 
                                var net_total = $('#cart_tt').html()-0;
                                var within_cost=net_total+(deliv-0);
                                
                                return within_cost;
                                }
                                function modalFade(){
                                        setTimeout(function() {
                            
                                                            $("#setloc").removeClass('in');
                                                            $("#setloc").attr('aria-hidden','true');
                                                            $("#setloc").css('display','none');
                                                            $('.modal-backdrop').remove();
                                                            $('body').removeClass('modal-open');
                                                        }, 2500);
                                            }
                                $(document).ready(function(){
                                     
                                    $('.savemodl').hide();
                                     $(document).on('click','#saveloc',function(){
                                        var route= $('.routes:checked').val();
                                        var town = $('.routes:checked').attr('spefid');
                                        var type="D";
                                        var landmark=$('#lanmark').val();
                                        var button=$(this);
                                            $.ajax({
                                            url	:	"payments/stk_initiate.php",
                                            method:	"POST",
                                            data	:	{route:route, town:town,nompesa:1,landmark:landmark,type:type},
                                            beforeSend: function(){
                                                     button.html("Saving Location...");
                                                  },
                                            success	:	function(data){
                                                    button.html(data);
                                                    location.reload(true);
                                                }
                                         }); 
                                    });
                                })
                                $('.routez').on('click',function(){
                                  var price=  $(this).find('.routes').attr('price');
                                  var speftown= $(this).find('.routes').attr('speftown');
                                  var totalcost=totalCost(price);
                                   $(this).find('.routes').prop('checked','true');
                                 $('#delitown').html(speftown);
                                 $('#deliprice').html("Del. Fee: Ksh."+price);
                                 $('.totocost').html("Total: Ksh."+totalcost);
                                 $('.savemodl').show();
                                 $('#routedetails').css('border','2px solid rgba(192,29,129,1)');
                                });
                               
                                </script>
                        </div>
                    <label for="exampleFormControlTextarea1">Landmark/Extra notes</label>
                      <textarea class="form-control" id="lanmark" rows="3" placeholder="Add A Note(Optional)"></textarea>
                    </div>
                  </div>
                
                  <div class="modal-footer">
                          <div id="nots"></div>
                    <!--<a href="https://wa.me/254721809280"><button type="button"  class="btn btn-primary btn-sm savemodal">Save</button></a>-->
                    <button type="button" id="saveloc"  class="my-cart-b savemodl">Save</button>
                    
                  </div>
                </div>

                  
              </div>
            </div>
            
        <div class="modal fade" id="setparloc" tabindex="-1" role="dialog" aria-labelledby="parcloctitle" aria-hidden="true">

              <!-- Change class .modal-sm to change the size of the modal -->
              <div class="modal-dialog modal-lg" role="document">


                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title w-100" id="parcloctitle">Set Location</h4>
                  </div>
                   
                  <div class="modal-body">
                      <div class="pushloc">
                                <input name="search" type="search" placeholder="Search Location..." class="form-control search qccsearchparcloc">
                                <span><button type="submit" class="btn btn-success qccparcloc"><i class="fa fa-search"></i></button></span>
                                <div class="slocerr"></div>
                        </div>
                        <div id="parclocbody" class="locbody">
                    <?php 
                    $sql="SELECT counties.id AS countyid,county_towns.id as cityid,price,town FROM county_towns INNER JOIN counties ON (county_towns.county_id=counties.id) ORDER BY county_towns.id DESC";
                    $query=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($query)){
                        $parprice=$row['price'];
                        $countyid=$row['countyid'];
                        $cityid=$row['cityid'];
                        $city=$row['town']; ?>
                        <div class="parcroutez"> <input type="radio" name="routez" class="parcroutes" price="<?php echo $parprice; ?>"  value="<?php echo $countyid; ?>" speftown="<?php echo $city ?>" spefid="<?php echo $cityid; ?>"> <?php echo $city ?></div>
                  <?php  }
                    ?>
                    </div>
                    <div class="describe" id="pardescribe" style="margin-top: 2px;">
                        <div id="parcroutedetails">
                            <div id="parctown"></div>
                            <div id="parcprice"></div>
                            <div class="parctotocost">
                               
                            </div>
                             <script>
                             function parctotalCost(deliv){ 
                                var net_total = $('#cart_tt').html()-0;
                                var within_cost=net_total+(deliv-0);
                                
                                return within_cost;
                                }
                                function modalFade(){
                                        setTimeout(function() {
                            
                                                            $("#setloc").removeClass('in');
                                                            $("#setloc").attr('aria-hidden','true');
                                                            $("#setloc").css('display','none');
                                                            $('.modal-backdrop').remove();
                                                            $('body').removeClass('modal-open');
                                                        }, 2500);
                                            }
                                $(document).ready(function(){
                                     
                                    $('.saveparcmodl').hide();
                                     $(document).on('click','#saveparcloc',function(){
                                        var route= $('.parcroutes:checked').val();
                                        var town = $('.parcroutes:checked').attr('spefid');
                                        var type="P";
                                        var landmark=$('#landsmark').val();
                                        var button=$(this);
                                            $.ajax({
                                            url	:	"payments/stk_initiate.php",
                                            method:	"POST",
                                            data	:	{route:route, town:town,nompesa:1,landmark:landmark,type:type},
                                            beforeSend: function(){
                                                     button.html("Saving Location...");
                                                  },
                                            success	:	function(data){
                                                    button.html(data);
                                                    location.reload(true);
                                                }
                                         }); 
                                    });
                                      $(document).on("keyup",".qccsearchparcloc", function() {
                                        var value = $(this).val().toLowerCase();
                                        $(".locbody .parcroutez").filter(function() {
                                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                        });
                                      });
                                })
                                $('.parcroutez').on('click',function(){
                                  var price=  $(this).find('.parcroutes').attr('price');
                                  var speftown= $(this).find('.parcroutes').attr('speftown');
                                  var totalcost=totalCost(price);
                                   $(this).find('.parcroutes').prop('checked','true');
                                 $('#parctown').html(speftown);
                                 $('#parcprice').html("Del. Fee: Ksh."+price);
                                 $('.parctotocost').html("Total: Ksh."+totalcost);
                                 $('.saveparcmodl').show();
                                 $('#parcroutedetails').css('border','2px solid rgba(192,29,129,1)');
                                });
                               
                                </script>
                        </div>
                    <label for="exampleFormControlTextarea1">Landmark/Extra notes</label>
                      <textarea class="form-control" id="landsmark" rows="3" placeholder="Add A Note(Optional)"></textarea>
                    </div>
                  </div>
                
                  <div class="modal-footer">
                          <div id="nots"></div>
                    <!--<a href="https://wa.me/254721809280"><button type="button"  class="btn btn-primary btn-sm savemodal">Save</button></a>-->
                    <button type="button" id="saveparcloc"  class="my-cart-b saveparcmodl">Save</button>
                    
                  </div>
                </div>

                  
              </div>
            </div>
<div class="wrap-header-cart-2 js-panel-cart">
    
   
      <div class="s-full js-hide-cart"></div>
      <div class="header-cart-2 flex-col-l p-l-20 p-r-15">
          <div id="menu-item" class="header-cart-content flex-w js-pscroll">
              <div class="toplogo">
                  <div class="logo-left">
                  <a href="/"><img class="logoimg" src="images/queenslogo.png" width="45" height="45"/></a><span> Menu</span>
            </div>
              <div class="closebttn">
                  <span class="closebtn" style="color:red;" onclick="closeNav()"><img src="images/icon-close.png"></span></span>
              </div>
              </div>
   <div class="serch">
       <div class="serchbar"><input name="search" type="search" id="iptwq" placeholder="Search product.." class="form-control serchinpt qccsearch"></div>
       <div class="serchbtn ">    <button type="submit" class="btn btn-success btnsearch qccpost"><i class="fa fa-search"></i></button></div>
       <div class="searcherror"></div>
   </div>
              
              <div id="mitmz" class="list-group">
    <?php
$sql="SELECT * FROM categories WHERE active=1";
$query=  mysqli_query($con, $sql);



while ($row1 = mysqli_fetch_array($query)) {
    $category=$row1['name'];
    $category_id=$row1['id'];
    
    
 $url="subcats?skyu=$category_id&cat=$category";
    
    
        

?>

    <a href="<?php echo $url ?>" class="list-group-item list-group-item-action"><?php echo $category; ?></a>
    
    <?php  } ?>
</div>
              
   
      
          </div>
      </div>
</div>

<style>

</style>
<script>
  var mitmz=$('#mitmz');
  var menu=mitmz.html();
var items = document.querySelectorAll('.list-group .list-group-item-action');

// get vendor transition property
var docElemStyle = document.documentElement.style;
var transitionProp = typeof docElemStyle.transition === 'string' ?
    'transition' : 'WebkitTransition';

$('.showSide').click(function(){
    $('.js-panel-cart').addClass('show-header-cart');
    for ( var i=0; i < items.length; i++ ) {
    var item = items[i];
    // stagger transition with transitionDelay
    item.style[ transitionProp + 'Delay' ] = ( i * 100 ) + 'ms';
    item.classList.add('is-moved');
  }
  menu=mitmz.html();
});
  
$('#iptwq').keyup(function(){
    var items=$(this).val();
    
    if($.trim(items)===''){
        mitmz.html(menu);
    }
    else {
        $.ajax({
			url : "postFiles/popsug.php",
			method : "POST",
			data : {search:$.trim(items)},
			success : function(data){
				mitmz.html(data);
			}
		}); 
    
    }
});
function closeNav() {
  $('.js-panel-cart').removeClass('show-header-cart');
  $('.list-group-item-action').removeClass('is-moved');
} 

                                     </script>