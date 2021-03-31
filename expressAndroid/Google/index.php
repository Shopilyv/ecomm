<html>
    <head>
        <meta charset="UTF-8">
        <title>GCP Storage File Upload using PHP</title>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
         integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
         <style>
             img {
    width: 90%;
    height: auto;
}
         </style>
    </head>
    <body>
        
        <section class="section mt-5">
    <div class="container">
        <form id="fileUploadForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
    <input type="text" name="order_no" id="order" placeholder="Enter Bill No Here...." required class="form-control">
</div><div class="form-group">
   <input type="file" name="file" accept="image/*" />
            <input type="submit" name="upload" value="Upload"/>
            
</div>
<div class="text-muted font-weight-bold">
    <span id="uploadingmsg"></span>
</div>
            
            
          
           
            <pre id="json"></pre>
            
           
            <div id="output"></div>
        </form>
    </div>
</section>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script>
            // $("#fileUploadForm").submit(function (e) {
            //     e.preventDefault();
            //     var action = "requests.php?action=upload";
            //     $("#uploadingmsg").html("Uploading...");
            //     var data = new FormData(e.target);
            //     $.ajax({
            //         type: 'POST',
            //         url: action,
            //         data: data, 
            //         /*THIS MUST BE DONE FOR FILE UPLOADING*/
            //         contentType: false,
            //         processData: false,
            //     }).done(function (response) {
            //         $("#uploadingmsg").html("");
            //         //$("#json").html(JSON.stringify(response, null, 4));
            //         //https://storage.googleapis.com/[BUCKET_NAME]/[OBJECT_NAME]
            //         $("#output").html('<a href="https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '"><i>https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '</i></a>');
            //         if(response.data.contentType === 'image/jpeg' || response.data.contentType === 'image/jpg' || response.data.contentType === 'image/png') {
            //             $("#output").append('<br/><img src="https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '"/>');
            //         }
            //     }).fail(function (data) {
            //         //any message
            //     });
            // });
            
            function uploadName(name, order) {
            var data = {
                name: name,
                order_no: order
            };
            $.ajax({
                type: 'POST',
                url: 'uploadname.php',
                data: data
            });
        }
        $("#fileUploadForm").submit(function(e) {
            e.preventDefault();
            var action = "requests.php?action=upload";
            $("#uploadingmsg").html("Uploading...");
            var data = new FormData(e.target);
            var order = $('#order').val();
            $.ajax({
                type: 'POST',
                url: action,
                data: data,
                /*THIS MUST BE DONE FOR FILE UPLOADING*/
                contentType: false,
                processData: false,
            }).done(function(response) {
                var name = response.data.name;
                var res = name.split('/');
                var imageName = res[1];
              
               
                // $("#json").html(JSON.stringify(response, null, 4));
                // //https://storage.googleapis.com/[BUCKET_NAME]/[OBJECT_NAME]
                // $("#output").html('<a href="https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '"><i>https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '</i></a>');
                if (response.data.contentType === 'image/jpeg' || response.data.contentType === 'image/jpg' || response.data.contentType === 'image/png') {
                     uploadName(imageName, order);
                    $("#output").html('<br/><img class="" src="https://storage.googleapis.com/' + response.data.bucket + '/' + response.data.name + '"/>');
                }
                $("#uploadingmsg").html("Success");
            }).fail(function(data) {
                //any message
            });
        });

            
        </script>
    </body>
</html>