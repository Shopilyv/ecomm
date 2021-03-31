<?php

function grabIpInfo($ip)
{

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, "https://api.ipgeolocationapi.com/geolocate/" . $ip);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

  $returnData = curl_exec($curl);

  curl_close($curl);

  return $returnData;

}


$ipInfo = grabIpInfo($_SERVER["REMOTE_ADDR"]);
$ipJsonInfo = json_decode($ipInfo);

print_r($ipJsonInfo);

?>

