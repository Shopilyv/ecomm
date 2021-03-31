 <?php
date_default_timezone_set('Africa/Nairobi');

# access token
$consumerKey = '4tzAgbyJkpXkRlhktYRIPJB4GRR5Tv6M'; //Fill with your app Consumer Key
$consumerSecret = '3KR0FcI9iZTk4Q3U'; // Fill with your app Secret
# define the variales
# provide the following details, this part is found on your test credentials on the developer account
$BusinessShortCode = '814426';
$Passkey = 'c9f6f817928ab6bbed6cdc5c417f170c89bd2442bb61b378f30c4a2dd44dc5e2';

$PartyA='254704310316';
$PartyB = '498921';
$AccountReference = 'QueensCC';
$TransactionDesc = 'QCC';
$Amount = 1;

# Get the timestamp, format YYYYmmddhms -> 20181004151020
$Timestamp = date('YmdHis');

# Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
$Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

# header for access token
$headers = ['Content-Type:application/json; charset=utf8'];

# M-PESA endpoint urls
$access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

# callback url
$CallBackURL = 'https://queensclassycollections.com/queensclassy/payments/callback_url.php';

$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;
curl_close($curl);

# header for stk push
$stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

# initiating the transaction
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $initiate_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerBuyGoodsOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
$jsondata = json_decode($curl_response, true);
print_r($jsondata);
  