<?php

include  'db.php';

$sql = "SELECT * FROM users WHERE type='rider'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$myArrays = array();
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $myArrays[] = array('id'=>$row['id'], 'username'=>$row['username']);
    }
    echo json_encode(['riders'=>$myArrays]);
} else {
    die('404');
}