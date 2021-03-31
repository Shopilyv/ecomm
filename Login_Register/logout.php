<?php

session_start();

unset($_SESSION["uid"]);

unset($_SESSION["name"]);

$cookie_name = "awsqawa";

$cookie_value=$_COOKIE['awsqawa'];

setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/");

header("location: ../");

?>