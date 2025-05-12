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
            //leer de la base de datos
            $query ="SELECT * FROM users_admin WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['passwd'] === $passwd)
                    {
                        $_SESSION['user_id'] =$user_data['user_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
        }
    }else
    {
        echo 'Introduce informacion valida';
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIN</title>
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
            <h1>INICIO DE SESION</h1>
            <label for="username">Nombre de usuario</label><br>
            <input type="text" name="username" id="username"><br><br>
            <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password"><br><br>
            <input type="submit" value="LogIN"><br><br>

            <a href="signup.php">Registrate</a>
        </form>
    </div>
</body>
</html>