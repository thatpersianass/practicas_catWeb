<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Adminisrador</title>
    <link rel="stylesheet" href="includes/sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h2>Panel de Administrador</h2>
        </div>
        <ul>
            <li><span class="icon">
                    <i class="bi bi-search"></i>
                </span></i>&nbsp; Buscar</li>
            <li><a href="logout.php"><span class="icon">
                    <i class="bi bi-door-open"></i>
                </span>&nbsp; Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Buscar usuario...">
                    <button type="submit">
                        <span class="icon">
                            <i class="bi bi-search"></i>
                        </span>

                    </button>

                </div>

                <div class="user">
                    <a href="#" class="btn">Add New</a>
                    <span class="icon_user">
                        <i class="bi bi-person"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>