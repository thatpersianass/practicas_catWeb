<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $passwd = $_POST['password'];

        if(!is_numeric($username))
        {
            //guardar en la base de datos
            $user_id = random_num(2);
            $query ="insert into usuarios (user_id,username, passwd) values('$user_id','$username','$passwd')";
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
            <input type="text" name="username" id="text" required><br><br>
            <!-- <label for="password">Contraseña</label><br> -->
            <input type="password" name="password" id="text" required><br><br>
            <input type="submit" value="Registrarse" id="button"><br><br>

            <a href="signup.php">Registrate</a>
        </form>
    </div>
</body>
</html>