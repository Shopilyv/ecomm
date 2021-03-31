<?php

include_once 'config.php';

function compress_image($source_url, $destination_url, $quality){
    $info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
    imagejpeg($image, $destination_url, $quality);
}

$action = filter_var(trim($_REQUEST['action']), FILTER_SANITIZE_STRING);
if ($action == 'upload') {
    $response['code'] = "200";
    $fileName = "";
    if ($_FILES['file']['error'] != 4) {
        $fileName = $_FILES['file']['name'];
        //set which bucket to work in
        $bucketName = "shopi_express";
        // get local file for upload testing
        $fileContent = file_get_contents($_FILES["file"]["tmp_name"]);
        // NOTE: if 'folder' or 'tree' is not exist then it will be automatically created !
        $cloudPath = 'receipts/' . $fileName;
        compress_image($_FILES['file']['tmp_name'], $cloudPath, 100);
        $isSucceed = uploadFile($bucketName, $fileContent, $cloudPath);

        if ($isSucceed == true) {
            $response['msg'] = 'SUCCESS: to upload ' . $cloudPath . PHP_EOL;
            // TEST: get object detail (filesize, contentType, updated [date], etc.)
            $response['data'] = getFileInfo($bucketName, $cloudPath);
        } else {
            $response['code'] = "201";
            $response['msg'] = 'FAILED: to upload ' . $cloudPath . PHP_EOL;
        }
    }
    header("Content-Type:application/json");
    echo json_encode($response);
    exit();
}