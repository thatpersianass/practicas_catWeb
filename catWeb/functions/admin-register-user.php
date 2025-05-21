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

        $admin = isset($_POST['admin']) ? 1 : 0;

        $checkUsername = $con->query("SELECT username FROM users WHERE username = '$username'");
        if ($checkUsername->num_rows > 0){
            $_SESSION['register_error'] = 'El usuario ya está registrado!';
            $_SESSION['active_form'] = 'register';
        } else {
            $con->query("INSERT INTO users (name,1surname,2surname,dni,color,username,passwd,admin) VALUES ('$name','$surname1','$surname2','$dni','$color','$username','$passwd','$admin')");
        }

        header("Location: ../views/admin/admin-search.php");
        exit();

    }

?>