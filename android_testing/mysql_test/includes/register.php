<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
    file_put_contents("debug.log", print_r($_POST, true), FILE_APPEND);
    require_once "connection.php";
    require_once "validate.php";
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $sql = "insert into users(username,password,email) values('$name','". md5($password) ."','$email')";
    if(!$con->query($sql)){
        file_put_contents("debug.log", "MySQL Error: " . $conn->error . "\n", FILE_APPEND);
        echo "failure";
    } else {
        echo "success";
    }
}
?>