
<?php
include 'db.php';

$email =  filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

if(!empty($email) || !empty($password)){
    $sql = "SELECT * FROM users WHERE email='" . $email . "' AND (type='rider' OR type='super' OR type='pack')";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $myArrays = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $passwordCheck = password_verify($password, $row['password']);
            if ($passwordCheck === TRUE) {
                $myArrays = array(
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'level' => $row['level']
                );
            } else if ($passwordCheck === false) {
                die('500');
                exit();
            }
        }
        echo json_encode(['ridersdata' => $myArrays]);
    } else {
        die('404');
    }
} else {
    die('403');
}