<?php
    session_start();
    require_once 'config.php';

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $surname1 = $_POST['surname1'];
        $surname2 = $_POST['surname2'];
        $dni = $_POST['dni'];
        $username = $_POST['username'];
        $passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $colores = ['aqua', 'blue', 'cyan', 'green', 'orange', 'purple', 'red', 'yellow'];

        $color = $colores[array_rand($colores)];

        $checkUsername = $con->query("SELECT username FROM users WHERE username = '$username'");
        if ($checkUsername->num_rows > 0){
            $_SESSION['register_error'] = 'El usuario ya está registrado!';
            $_SESSION['active_form'] = 'register';
        } else {
            $con->query("INSERT INTO users (name,1surname,2surname,dni,color,username,passwd) VALUES ('$name','$surname1','$surname2','$dni','$color','$username','$passwd')");
        }

        header("Location: ../index.php");
        exit();

    }

    if (isset($_POST['login'])){
        $username = $_POST['user'];
        $passwd = $_POST['password'];

        $result = $con->query("SELECT * FROM users WHERE username = '$username'");
        if ($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if (password_verify($passwd, $user['passwd'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['color'] = $user['color'];
                $_SESSION['is_admin'] = $user['admin'];
                
                if ($user['admin']) {
                    header("Location: ../views/admin/admin-dashboard.php");
                } else {
                    header("Location: ../views/user/user-folders.php");
                }
                exit();
            }
        }
        $_SESSION['login_error'] = 'Usuario o Contraseña incorrectos';
        $_SESSION['active_form'] = 'login';
        header("Location: ../index.php");
        exit();
    }

?>