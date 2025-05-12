<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $passwd = $_POST['password'];
        $admin = isset($_POST['admin']) ? true : false;

        if(!is_numeric($username))
        {
            //guardar en la base de datos
            $user_id = random_num(2);
            $query ="insert into users_admin (user_id,username, passwd, admin) values('$user_id','$username','$passwd','$admin')";
            mysqli_query($con, $query);

            header("Location: login.php");
            die;

        }else
        {
            echo 'Introduce informacion valida';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        div {
            margin: auto;
            width: 30%;
            border: 3px solid #000000;
            padding: 10px;
            display: grid;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <form method="post">
            <h1>REGISTRAR</h1>
            <!-- <label for="username">Nombre de usuario</label><br> -->
            <input type="text" name="username" id="text" placeholder="Username..."  required><br><br>
            <!-- <label for="password">Contraseña</label><br> -->
            <input type="password" name="password" id="text" placeholder="Contraseña..." required><br><br>
            <input type="checkbox" name="admin" id="checkbox"><label for="checkbox">Administrador</label><br><br>
            <input type="submit" value="Registrarse" id="button"><br><br>
        </form>
    </div>
</body>
</html>