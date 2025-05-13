<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $passwd = $_POST['passwd'];

        if(!is_numeric($username))
        {
            //leer de la base de datos
            $query ="SELECT * FROM users_prueba WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['passwd'] === $passwd)
                    {
                        if($user_data['admin']){
                            $_SESSION['user_id'] =$user_data['user_id'];
                            header("Location: index.php");
                            die;
                        } else {
                            $_SESSION['user_id'] =$user_data['user_id'];
                            header("Location: usr_view.php");
                            die;
                        }
                    }
                }
            }
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="includes/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <form method="post">

                <h2>Inicia Sesión</h2>
                <input type="text" name="username" placeholder="Nombre de usuario..." required>
                <input type="password" name="passwd" placeholder="Contraseña..." id="passwd" required>
                <label for="admin">Mostrar contraseña</label>
                <input class="form-check-input mt-0 align-end" type="checkbox" name="admin" id="checkbox" onclick="mostrarContrasenia()">
                <input type="submit" value="Iniciar Sesión" class="button">
                <p>¿No tienes una cuenta? <a href="register.php">¡Registrate!</a></p>

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

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>