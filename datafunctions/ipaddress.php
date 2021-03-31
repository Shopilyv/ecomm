<?php
$ip_add=$_SERVER['REMOTE_ADDR'];
if(isset($_COOKIE['cstln'])){
  $ip_add= $_COOKIE['cstln'];
}
elseif(!isset($_COOKIE['cstln'])){
    $cookie_name = "cstln";
    $cookie_value = $ip_add;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30*60), "/");
}