<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="includes/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box" id="register-form">
            <form method="post">
                <h2>Registrate</h2>
                <input type="text" name="username" placeholder="Nombre de usuario..." required>
                <input type="text" name="passwd" placeholder="Contraseña..." required>
                <input class="form-check-input mt-0" type="checkbox" value="admin" id="admin">
                <label for="admin">Administrador</label>
                <input type="submit" value="Registrar" class="button">
                <p>¿Ya tienes una cuenta? <a href="login.php">¡Inicia sesión!</a></p> 

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>
</html>