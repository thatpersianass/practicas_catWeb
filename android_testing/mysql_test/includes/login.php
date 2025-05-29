<?php
if(isset($_POST['email']) && isset($_POST['password'])){
    file_put_contents("login_debug.log", print_r($_POST, true), FILE_APPEND);
    require_once "connection.php";
    require_once "validate.php";

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '".md5($password)."'";
    file_put_contents("login_debug.log", $sql . "\n", FILE_APPEND);
    $result = $con->query($sql);
    if($result->num_rows > 0){
        echo "success";
    } else {
        echo "failure";
    }
}

?>