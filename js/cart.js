$(document).ready(function(c) {
$('.savemodal').click(function(){
        var route = $(this).parent().parent().find('.js-route').html();
        var town =  $(this).parent().parent().find('.js-town').html();
        var landmark=$('#lmark').val();
        var deltype=$('#del').val();
        
        var type="D";
        if(deltype==='2'){
            type="P";
        }


           $.ajax({
                    url	:	"payments/stk_initiate.php",
                    method:	"POST",
                    data	:	{route:route, town:town,nompesa:1,landmark:landmark,type:type},
                    beforeSend: function(){
                             $('.savemodal').html("Saving Location...");
                          },
                    success	:	function(data){

                            $('.savemodal').html(data);
                            modalDisappear();
                            
                            $('.grbtn ').addClass('collapsed');
                            $('#collapseOne').removeClass('in');
                            $('#collapseOne').css('height','0px');
                            
                            $('#paympesa').removeClass('collapsed');
                            $('#collapseTwo').addClass('in');
                            $('#collapseTwo').css('height','auto');
                            
                            location.reload(true);
                            
                            
                                                 }
                     }); 


    });

     function modalDisappear(){


        setTimeout(function() {

                                $("#centralModalSm").removeClass('in');
                                $("#centralModalSm").attr('aria-hidden','true');
                                $("#centralModalSm").css('display','none');
                                $('.modal-backdrop').remove();
                                $('body').removeClass('modal-open');
                            }, 2500);

    }
});
