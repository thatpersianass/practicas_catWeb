<?php
if(isset($_POST['username']) && isset($_POST['password'])){
    // file_put_contents("login_debug.log", print_r($_POST, true), FILE_APPEND);
    require_once "connection.php";

    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    // file_put_contents("login_debug.log", $sql . "\n", FILE_APPEND); '
    $result = $con->query($sql);

    if($result->num_rows > 0){
        // echo "success";
        $user = $result->fetch_assoc();
            if (password_verify($passwd, $user['passwd'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['color'] = $user['color'];
                $_SESSION['is_admin'] = $user['admin'];
                
                if ($user['admin']) {
                    echo "success admin";
                } else {
                    echo "success user";
                }
            } else {
                echo "failure";
            }
    } else {
        echo "failure";
    }
}

?>