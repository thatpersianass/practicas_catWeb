<?php
session_start();
    include("connection.php");
    include("functions.php");

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro exitoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="includes/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <form method="post">
                
                <h2>¡Registro exitoso!</h2>
                <p><b class="user_registered"><?php echo $_SESSION['last_username']; ?></b> ha sido registrado con exito</p> 
                <p>¡Ahora <a href="login.php">vuelve al inicio de sesión</a> para empezar a subir tus archivos!</p>
                
            
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>
</html>