$(document).ready(function(){



 $(document).on('click', '.previous', function(){
  var post_id = $(this).attr("id");
  var previous=$(this).parent().parent();
  var colour=previous.find('#colour').attr('pcolour');
  var sku=$(this).attr("sku");
  console.log(colour);
  $.ajax({
   url:"select.php",
   method:"POST",
   data:{post_id:post_id,previous:1,sku:sku,colour:colour},
   success:function(data)
   {
  
    previous.html(data);
   }
  });
  
 });

 $(document).on('click', '.next', function(){
var post_id = $(this).attr("id");
var previous=$(this).parent().parent();
var findcolour=$(this).parent().parent().parent();
var colour=findcolour.find('#colour').attr('pcolour');
var sku=$(this).attr("sku");

console.log(colour);

  $.ajax({
   url:"select.php",
   method:"POST",
   data:{post_id:post_id,next:2,sku:sku,colour:colour},
   success:function(data)
   {
  
    previous.html(data);
   }
  });
 });
 
});