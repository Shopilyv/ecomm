<?php

// load GCS library
require_once 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Please use your own private key (JSON file content) which was downloaded in step 3 and copy it here
// your private key JSON structure should be similar like dummy value below.
// WARNING: this is only for QUICK TESTING to verify whether private key is valid (working) or not.  
// NOTE: to create private key JSON file: https://console.cloud.google.com/apis/credentials  
$privateKeyFileContent = '{
  "type": "service_account",
  "project_id": "radiant-night-288511",
  "private_key_id": "6c4b6de02c5f4f3cd81d9ffb79f3eb6b6b8a6455",
  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQClkYzGmH9hWXtC\nMyFnxzfQtFi44lSAf5PaeXFSNQ3diVdMYtJ/B6FEYunkDTln3tFxGVK7lnr2ZAco\niD+A+2y3NV7l/Gty7mDXA6tHePxhwalkzGpDM4n5bRcKVprTl9yh+jv0oLItvCEc\nSS3tWT3Wc3aRk0RYuozQM4XOgaq7X81zcJQw2fH/S9LCFxQTXj64iBD/VYsN6NKD\ncZvjxvffXt8JbkOMOn+0RARK3YGKk9sF3YixYyGQwWC/VhzdH9dq6cZ0uE1mL59l\nOk1i30HYSP0cQ95ahsLIzuNtlNChPfBHmtsz8w9D/srKdKXF9TjGTiNhj5jtnN5d\nKvkLmh6jAgMBAAECggEAAPTKvdjin3LPWe4Gqt1FLsDj5El2WHmkJnZeF63zwwxI\ng0ns0kv+e/EgTa9f3gA08HTHfArd8e9Y9Tx4NWv+UD6QKj7fdf33dDZytkp2FrBy\nJIFjubih+t1M7UPbyA4P+aWC1CJbdRUpkcrAZ6cEyujGzgduNR76sjch9jPcgxGD\nsVJmnHowBFFD5Q3HTDNzF/qxhR0+MbiMlv2sIzpVxsB6z2hLQPQRw+1AG3BzoZE+\ndhOtSxIdkjk6wxQuRNqBGHCEzUFXs+cujS6j0XrOzCoWwNKxdc6OsVte/gkrrXF9\niEj/G+aTO5FXlhghOQcHLk8k9sb511+f9Nm8htUO7QKBgQDdjaw28psIdzJVCQj4\njVctNJakf/rvNfnKbl7Yv099OiPM4krviwjenEdwr5t9Ci49CYcv26dl6VG89zi4\no9uhfVomydkVkxBdkmITKvIMMXvOXclSAv3He474J3cShIvvgRctlKRHEd09QO4Y\nAzvbOkQtywmOUvHWHovqFncy9QKBgQC/T42f8krAm9x5yYIz4tvrsAzREO4u+ZY4\nE4sQ/ZhHhZtozXNd+5CCUnsIJjV1GgOGxcwe1s9AVAqI2237BwgMtVitAly1zG/G\nJI3UAhI4tsXMZOXlnuDoa/sIa4sq7ZM+0E1NpkjxW1aK3/Pon7ji5hy2ZuGbchwZ\nK42OZ2H8NwKBgC7UzItM2uJ+N6Br6X6Ied3vWMxq1QMNeMCGdfwA7G9/A6RCTS63\nR+euRxeVtxtGNKHoSrAeERNkr0dvRokY8cr/8TdzwTRjQrlUwPBmSoWzTAVCI9T3\nFue8wWrJBM1gQSgeNGUJH3R6XTaea/WdcWCUv2ainWF9POtSx6Zymz2lAoGBAIH1\noNfO2EkPmC6DXReyPINXDN3ZCnSOyCU/4XChVRkBAhmnt39YrUpajYlzq0zpZwve\nwlMQyamBbcaaiZPFqwo3Bw5AVIqLXkLUAiTLY2Vzg9rdj+70hwRcliOaKuf2i9hX\n2KuvEk4jJh8hE6grGIXKnCasrQXT9pKCq57ZTA7xAoGBAMSsukyC7Gkdsc/TlNSY\n0YjBgZX+ZpaBk29Qu8CWhJu1oXKoeAFINMWbgW8epqi5D17kGqHli9Qft+gkRkCm\nJtq+mij1Eiozr8XJQ56iYPLXWVTnVTXxLtLoSCyhTAQI8IdlJ0XiS+dISjTpajWR\nfLeV6Rc+UXKA9PsfHzymqNSd\n-----END PRIVATE KEY-----\n",
  "client_email": "shopi-upload@radiant-night-288511.iam.gserviceaccount.com",
  "client_id": "106178439139296790310",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/shopi-upload%40radiant-night-288511.iam.gserviceaccount.com"
}
';

/*
 * NOTE: if the server is a shared hosting by third party company then private key should not be stored as a file,
 * may be better to encrypt the private key value then store the 'encrypted private key' value as string in database,
 * so every time before use the private key we can get a user-input (from UI) to get password to decrypt it.
 */

function uploadFile($bucketName, $fileContent, $cloudPath) {
    $privateKeyFileContent = $GLOBALS['privateKeyFileContent'];
    // connect to Google Cloud Storage using private key as authentication
    try {
        $storage = new StorageClient([
            'keyFile' => json_decode($privateKeyFileContent, true)
        ]);
    } catch (Exception $e) {
        // maybe invalid private key ?
        print $e;
        return false;
    }

    // set which bucket to work in
    $bucket = $storage->bucket($bucketName);

    // upload/replace file 
    $storageObject = $bucket->upload(
            $fileContent,
            ['name' => $cloudPath]
            // if $cloudPath is existed then will be overwrite without confirmation
            // NOTE: 
            // a. do not put prefix '/', '/' is a separate folder name  !!
            // b. private key MUST have 'storage.objects.delete' permission if want to replace file !
    );

    // is it succeed ?
    return $storageObject != null;
}

function getFileInfo($bucketName, $cloudPath) {
    $privateKeyFileContent = $GLOBALS['privateKeyFileContent'];
    // connect to Google Cloud Storage using private key as authentication
    try {
        $storage = new StorageClient([
            'keyFile' => json_decode($privateKeyFileContent, true)
        ]);
    } catch (Exception $e) {
        // maybe invalid private key ?
        print $e;
        return false;
    }

    // set which bucket to work in
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->object($cloudPath);
    return $object->info();
}
//this (listFiles) method not used in this example but you may use according to your need 
function listFiles($bucket, $directory = null) {

    if ($directory == null) {
        // list all files
        $objects = $bucket->objects();
    } else {
        // list all files within a directory (sub-directory)
        $options = array('prefix' => $directory);
        $objects = $bucket->objects($options);
    }

    foreach ($objects as $object) {
        print $object->name() . PHP_EOL;
        // NOTE: if $object->name() ends with '/' then it is a 'folder'
    }
}