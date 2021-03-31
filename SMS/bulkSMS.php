<?php

function sendMessage($to,$from,$text){
   
        $username="QueensCC";
        $password="@Berkante1979";
        
        $auth=base64_encode($username.':'.$password);
        $headers = ['Authorization'=>'Basic '.$auth,'Content-Type'=>' application/json', 'Accept' => 'application/json',];
       // $body=["from" => 'QueensCC', "to" =>'254721809280',"text"=>'TEST'];
       // $api_url ='https://api.infobip.com/sms/2/text/single';
       $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.infobip.com/sms/2/text/single",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"from\":\"$from\", \"to\":\"$to\", \"text\":\"$text.\" }",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Basic ".json_encode($auth),
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
   
    }

    ?>
