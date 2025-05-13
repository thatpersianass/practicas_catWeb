<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $name = $_POST['name'];
        $surname1 = $_POST['surname1'];
        $surname2 = $_POST['surname2'];
        $dni = $_POST['dni'];
        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
        $admin = isset($_POST['admin']) ? 1 : 0;

        if(!is_numeric($username))
        {
            //guardar en la base de datos
            $user_id = random_num(2);
            $query ="insert into users_prueba (user_id,username, passwd, nombre, 1apellido, 2apellido, dni, admin) values('$user_id','$username','$passwd','$name','$surname1','$surname2','$dni','$admin')";
            mysqli_query($con, $query);

            $_SESSION['last_username'] = $username;
            header("Location: successful.php");
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
                <input type="text" name="name" placeholder="Nombre(s)...">
                <input type="text" name="surname1" placeholder="Primer apellido...">
                <input type="text" name="surname2" placeholder="Segundo apellido...">
                <input type="text" name="dni" placeholder="DNI...">
                <input type="text" name="username" placeholder="Nombre de usuario..." required>
                <input type="password" name="passwd" id="passwd" placeholder="Contraseña..." required>
                <label for="admin">Mostrar contraseña</label>
                <input class="form-check-input mt-0 align-end" type="checkbox" name="admin" id="checkbox"
                    onclick="mostrarContrasenia()"><br>
                <label for="admin">Administrador</label>
                <input class="form-check-input mt-0" type="checkbox" name="admin" id="checkbox">
                <input type="submit" value="Registrar" class="button">
                <p>¿Ya tienes una cuenta? <a href="login.php">¡Inicia sesión!</a></p>

            </form>
        </div>
    </div>

    <script type="text/javascript">
    function mostrarContrasenia() {
        var x = document.getElementById("passwd");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>