<?php
include 'db.php';
include 'rando.php';
include 'Google/config.php';
$gen = new Gen();
$bill_no = filter_input(INPUT_POST, "order_no");
$bill_id = $gen->get_order_id($conn, $bill_no);
$status = 1;
$url = "https://express.queensclassy.com/userfiles/receipts/";
$base64_string = $_POST['image'];
$outputfile = date("Ymdhis").".jpg";
$realImage = $gen->base64_to_image($base64_string, $outputfile);
$response;
//set which bucket to work in
$bucketName = "shopi_express";
// get local file for upload testing
$fileContent = file_get_contents($realImage);
// NOTE: if 'folder' or 'tree' is not exist then it will be automatically created !
$cloudPath = 'receipts/' .$outputfile;

$isSucceed = uploadFile($bucketName,$realImage, $cloudPath);


if ($isSucceed == true) {
    echo '201';
    $response = getFileInfo($bucketName, $cloudPath);
} else {
    die('500');
}


echo json_encode($response);


