

<div class="wrap-header-cart js-panel-cart">
    
   
      <div class="s-full js-hide-cart"></div>
      <div class="header-cart flex-col-l p-l-20 p-r-15">
          <div id="menu-item" class="header-cart-content flex-w js-pscroll">
              <div class="toplogo">
                <div class="logo-left">
                    <a href="index"><img src="images/queenslogo.png" width="45" height="45"/></a><span> My Bag</span>
                </div>
              <div class="closebttn">
                  <span class="closebtn" style="color:red;" onclick="closeCart()"><img src="images/icon-close.png"></span></span>
              </div>
              </div>
              </div>
                     
              <div class="main-grid2" id="cart_product">
                  
              </div>
            <?php if(!isset($_COOKIE['awsqawa']) && !isset($_SESSION['uid'])): ?>
          <style>
              .savestuff{
                  margin-top: 5px;
                  margin-left: 2%;
                 
              }
              .numwid{
                  width: 63%;
                      float:left;
              }
              .savesign{
                  width: 25%;
                      float:left;
              }
              .savesign button{
                  background: rgba(192,29,129,1);
                  height: 34px;
                  width: auto;
                  border: 2px solid rgba(192,29,129,1);
                  font-weight: bold;
              }
              .numwid #customer_number{
                  border: 2px solid rgba(192,29,129,1);
                  border-radius: 0;
                  
              }
          </style>
           
              
              <div class="savestuff">
                  <div id="cust_error" style="color:red"></div>
              <div class="numwid">
                  <input type="text" class="form-control" placeholder="Phone Number" id="customer_number">
              </div>
              <div class="savesign">
                  <button id="checko" class="btn btn-success">Proceed to Pay</button>
              </div>
              </div>
              <?php elseif(isset($_COOKIE['awsqawa'])||isset($_SESSION['uid'])): ?>
            <div class="savestuff">
              <a href="cart"><div class="cartheader"> Proceed to Pay</div></a>
            </div>
              <?php endif; ?>
          <div class="savestuff">
              <div id="updates" style="color:pink; font-size: 1.5em;"></div>
          </div>
            
          </div>
      </div>
</div>

<script>
    $('.cartheader').click(function(){
        $(this).html('Processing..');
    });
$('#checko').click(function(){
    var custnum=$('#customer_number').val();
    var conta=$.trim(custnum);
   
    if(conta===''){
       $('#cust_error').html('Fill in your phone number');
    }
    else if(conta !==''){
         var number= /^\d*$/.test(conta); 
         
         var kenya = /^(?:254|\+254|0)?(7(?:(?:[1-9][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/;
         var kenya1 = /^(?:254|\+254|0)?(1(?:(?:[1-9][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/;
         var tanzania = /^(?:255|\+255|0)?(6(?:(?:[1-9][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/;

            var authenticate = kenya.test(conta);
            var authenticate1 = kenya1.test(conta);
            var authenticate2 = tanzania.test(conta);
        if(number && (authenticate||authenticate1||authenticate2)){
            $.ajax({
			url	:	"includes/cust_num.php",
			method:	"POST",
			data	:{
                            phone:conta
                        },
                        beforeSend: function(){
                              $('#checko').html('Sending..')
                              $('#updates').html('Processing..');
                              },
			success	:function(data){
                    $('#updates').html('Redirecting..');
					window.location.href = "cart";
			
							},
                        error :function(){
                          $('#cust_error').html("Error");   
                        }
		});
           
        }
       
    }
});

$('.shopincart').click(function(){
    $('.wrap-header-cart').addClass('show-header');
   net_total();
});

function closeCart() {
  $('.wrap-header-cart').removeClass('show-header');
} 
function net_total(){
		var net_total = 0;
		$('.qty').each(function(){
			var row = $(this).parent().parent().parent().parent();
			var price  = row.find('.price').val();
			var total = price * $(this).val()-0;
			row.find('.total').val(total);
		});
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		});
		$('.net_total').html("Kes <span id=\"cart_cost\">" +net_total+"</span>");
             


	}
        
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d57a28177aa790be32f51cc/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->