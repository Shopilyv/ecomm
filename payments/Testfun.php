<?php

require '../products/db.php';
include '../products/ipaddress.php';
require '../headers/rando.php';

$rand = new gen();
 $str =  $rand->trans_id_pay($con);
 echo $str;