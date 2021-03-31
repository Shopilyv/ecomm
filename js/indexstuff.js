$(document).ready(function(){
    
getCartItem();
 count_item();
 var sitem=0;
 $('.qccpost').click(function(){
    var search=$(this).parent().parent().find('.qccsearch').val();
    var errordisp=$(this).parent().parent().find('.searcherror');
    if(search===''){
        errordisp.html("Empty field");
    }
    else{
        sitem++;
        if(sitem===1){
       $.ajax({
			url : "postFiles/searchsuggest.php",
			method : "POST",
			data : {search:search},
                        beforeSend: function(){
                                $(this).val('Searching..');
                              },
			success : function(data){
                            console.log(data);
				if(data==='success'){
                    var CookieDate = new Date();
                    CookieDate.setFullYear(CookieDate.getFullYear() +1);
                    document.cookie = 'Item='+search+'; expires=' + CookieDate.toGMTString() + ';';
                    window.location.href='search';
                   
                }
                else {
                    errordisp.html(data);
                }
			}
		}); 
        }
    }
 });
$(".qccsearchloc").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".locbody .routez").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
 $('.csstransforms3d').click(function(){
       $.ajax({
        	url : "postFiles/update.logged.php",
        	method : "POST",
        	data : {logged:'now'},
        	success : function(data){
        	}
        }); 
    });
 /*function check_cookie_name(name) 
    {
      var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      if (match) {
          var name=match[0];
          var split=name.split('=');
          var item =split[1];
        console.log(item);
      }
      else{
           console.log('--something went wrong---');
      }
   }
   */
function getCartItem(){
$.ajax({
	url : "includes/cartitems.php",
	method : "POST",
	data : {Common:1,getCartItem:1},
	success : function(data){
		$("#cart_product").html(data);
                        $("#carts").html(data);
	}
});
}

function count_item(){
    var del=$('#delprice').val()-0;
$.ajax({
	url : "includes/cartitems.php",
	method : "POST",
	data : {count_item:1},
	success : function(data){
    var qtyamt=data.split("_");
    var n=qtyamt[0];
    var amount=qtyamt[1]-0;
	var cost=amount+del;
	$(".badge").html(n);
        $(".count_items").val(n);
        $('#cart_tt').html(amount);
        $('#totcost').val(cost);
        $('#amountorder').val(cost);
        $('#torals').html(cost);
	}
});
}



$(document).on("click", '.list_size', function(event) {
            var size=$(this).attr('size');
            var pro_id=$(this).attr('pro_id');
            var notif=$(this).attr('notif');
            var store=$(this).attr('store');
            var price=$(this).attr('price');
            var addcart=$(this).parent().parent().parent().find('.addcart');
            var t=$(this);
            
            
            if(size===''){
                size="No Size";
            }
            
          if(notif==='yes'){}
          else if(notif==='no'){
              
            if(pro_id !== ""){
                      var discount=$(this).attr('disc');
                      $.ajax({
    			url : "products/action.php",
    			method : "POST",
    			data : {addToCart:1,select:pro_id, select1:size, price:price,store:store,discount:discount},
    			success : function(data){
                                count_item();
                                getCartItem();	
                                t.html(data).css('background-color','pink').css('color','#000000');
                                addcart.html(size+' '+data).css('background-color','pink').css('color','#000000');
                                $('.wrap-header-cart').addClass('show-header');
                
	}
                      });
                  }
        
        }
        });
var clicks=0;
function addremoveClass(dd){
    $('.dd').each(function(){
        var has=$(this).hasClass('showdd');
        if(has){
           $(this).not(dd).removeClass('showdd'); 
        }
    });
}
$(document).on("click", '.addcart', function() { 
   var parent=$(this).parent();
    clicks=clicks+1;
   var dd = parent.find('.dd');
   var darkbdy=$('.darkboody');
    addremoveClass(dd);
    var has=dd.hasClass('showdd');
    
    if(has){
        darkbdy.removeClass('darkbdy');
        dd.removeClass('showdd');
        dd.removeClass('ddwidth'); 
        $(this).css('z-index','');
    }
    else if(!has){
        dd.addClass('ddwidth');
        darkbdy.addClass('darkbdy');
        dd.addClass('showdd');
        $(this).css('z-index','1001');
    }
    });
$('.closedds').click(function(){
    var paro=$(this).parent().parent().parent();
    paro.parent().find('.addcart').css('z-index','');
    paro.removeClass('ddwidth');
    $('.darkboody').removeClass('darkbdy');
    paro.removeClass('showdd');
});
function loader(){
    $('#body').append('<div class="page-loader"><div class="loader">Loading...</div></div>');

}
function fadeLoader(){
          
 $('.loader').fadeOut(1000);
$('.page-loader').delay(1000).fadeOut('slow');
//$("body").hide(0).delay(100).fadeIn(1000);
}
var orval=1;
$(document).on("focusin",".qty", function(){
     orval= $(this).val();
    });
 $(document).on("click",".alert-close",function(event){
    var remove_id = $(this).attr("id");
     var message=$(this).parent().parent();
     
     var qty=message.find('.qty').attr('qty');
     var items=message.find('.qty').attr('itms');
     var min=message.find('.qty').attr('min');
     var sku=message.find('.qty').attr('sku');
     
          var torals=($.trim(items)-0)-($.trim(qty)-0);
          var postdiff="min";
          if(torals>=($.trim(min)-0)){
              postdiff="max";
          }
     
message.fadeOut('slow', function(c){
  	message.remove();
});
        
$.ajax({
	url	:	"products/action.php",
	method	:	"POST",
	data	:	{removeItemFromCart:1,rid:remove_id,postdiff:postdiff,sku:sku},
	success	:	function(){
		count_item();
                        getCartItem(); 
                        
	}
});
});

$(document).on("keyup",".qty",function(event){
var min=$(this).attr('min');
var items=$(this).attr('itms');

var update = $(this).parent().parent().parent();
var updt =update.find('#updt');
var update_id = update.find(".update").attr("update_id");
var qty = update.find(".qty").val();
var sku =$(this).attr('sku');
var itemsdif=($.trim(qty)-0)-($.trim(orval)-0);
var torals=($.trim(items)-0)+itemsdif;
var postdiff="min";
  if(torals>=($.trim(min)-0)){
      postdiff="max";
  }
if($.trim(qty)===''){
}
else if($.trim(qty)==='0'){
update.fadeOut('slow', function(){
  	update.remove();
});
            $.ajax({
	url	:	"products/action.php",
	method	:	"POST",
	data	:	{removeItemFromCart:1,rid:update_id,postdiff:postdiff,sku:sku},
	success	:	function(){
		count_item();
                        getCartItem(); 
                        
	}
});
        }else{
$.ajax({
	url	:	"products/action.php",
	method	:	"POST",
	data	:	{updateCartItem:1,update_id:update_id,qty:qty,postdiff:postdiff,sku:sku},
    beforeSend: function(){
            updt.html("Updating...").addClass('alert alert-success');
          },
    complete: function(){
       updt.html("Updated").addClass('alert-success');
    },
	success	:	function(data){
		count_item(); 
        getCartItem();
                       
	}
});
        }

});

/*$(document).on("click",".update",function(event){
        event.preventDefault();
var update = $(this).parent().parent().parent();
        var updt =update.find('#updt');
var update_id = update.find(".update").attr("update_id");
var qty = update.find(".qty").val();
        if($.trim(qty)===''){
            updt.updt.html("Empty field").addClass('alert alert-danger');
        }
        else if($.trim(qty)==='0'){
             update.fadeOut('slow', function(){
  	update.remove();
});
            $.ajax({
	url	:	"products/action.php",
	method	:	"POST",
	data	:	{removeItemFromCart:1,rid:update_id},
	success	:	function(){
		count_item();
                        getCartItem(); 
                        
	}
});
        }
        else{
$.ajax({
	url	:	"products/action.php",
	method	:	"POST",
	data	:	{updateCartItem:1,update_id:update_id,qty:qty},
                beforeSend: function(){
                        updt.html("Updating...").addClass('alert alert-success');
                      },
                complete: function(){
                   updt.html("Updated").addClass('alert-success');
                },
	success	:	function(data){
		count_item(); 
                        getCartItem();
                       
	}
});
        }

});
*/

                
$('.shopincart').click(function(){
$('.wrap-header-cart').addClass('show-header');

});
$('.checkouts').click(function(){
$('.wrap-header-cart').addClass('show-header');

});
function closeCart() {
$('.wrap-header-cart').removeClass('show-header');
} 
function changeBrowser(){
var allDivs = document.querySelectorAll('div');

for(var i = 0; i < allDivs.length; i++){
allDivs[i].style['background-color'] = 'black';
allDivs[i].style['color'] = 'green';
allDivs[i].style['font-family'] = 'Monospace';
}
}
});