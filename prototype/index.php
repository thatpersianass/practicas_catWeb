<?php
session_start();
    include("include/connection.php");
    include("include/functions.php");

    header("Location: include/logout.php")

    // $user_data = check_login($con);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redireccionando...</title>
</head>

<body>
    <h1>En el improbable caso de que esta página se muestre, <a href="views/login.php">Clique aquí para ir al inicio de sesión</a></h1>
</body>

</html>