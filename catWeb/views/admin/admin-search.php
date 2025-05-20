<?php
    session_start();
    include('../../functions/config.php');

    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
        exit();
    }

    if (!$_SESSION['is_admin']){
        header("Location: ../user/user-folders.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/buttons.css">
    <title>Panel Admin</title>
</head>

<body>
    <!-- Encabezado ========================================================== -->
    <header>
        <span class="header-title">PANEL DE ADMINISTRADOR</span>
    </header>

    <div class="main-container">

        <!-- Sidebar ========================================================== -->
        <aside class="sidebar">
            <div class="sidebar-content">
                <!-- Información del usuario ========================================================== -->
                <div class="user-box">
                    <nav class="user-info">
                        <div class="user-pfp">
                            <img src="../../img/pfp/admin.webp">

                        </div>
                        <span class="username">Placeholder</span>
                    </nav>

                </div>

                <a href="../../index.php" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link active">
                    <div class="icon">
                        <img src="../../icons/zoom.png" alt="home">
                    </div>
                    <span class="description">Buscar Usuarios</span>
                </a>

                <a href="#" class="nav-link disabled">
                    <div class="icon">
                        <img src="../../icons/file.png" alt="home">
                    </div>
                    <span class="description">Carpetas</span>
                </a>

                <a href="#" class="nav-link disabled">
                    <div class="icon">
                        <img src="../../icons/document.png" alt="home">
                    </div>
                    <span class="description">Archivos</span>
                </a>

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/close.png" alt="home">
                    </div>
                    <span class="description">Cerrar Sesión</span>
                </a>
            </div>

        </aside>


        <!-- Barra de navegación para móvil ========================================================== -->
        <nav class="mobile-navbar">
            <div class="user-info">
                <span class="icon">
                    <img src="../../img/pfp/admin.webp" alt="usr">
                </span>
                <div class="username">
                    <span class="innertext">Placeholder</span>
                </div>
            </div>

            <div class="sidebar-content">

                <a href="../index.php" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link active">
                    <div class="icon">
                        <img src="../../icons/zoom.png" alt="home">
                    </div>
                    <span class="description">Buscar Usuarios</span>
                </a>

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/close.png" alt="home">
                    </div>
                    <span class="description">Cerrar Sesión</span>
                </a>
            </div>
        </nav>

        <!-- Contenido principal ========================================================== -->
        <main class="content">
            <div class="admin-dashboard">
                <div class="title">
                    <span class="inner-text">Buscar Usuarios</span>
                </div>
                <div class="search-box">
                    <input type="text" name="search-usr" id="search-usr" class="search-bar"
                        placeholder="  Introduce el nombre, apellido o DNI del usuario...">
                    <button class="button-add">Añadir usuario</button>
                </div>

                <div class="user-display-box">
                    <table>
                        <tr>
                            <td class="user-show">
                                <span class="pfp">
                                    <img src="../../img/pfp/aqua.webp" alt="usr">
                                </span>
                                <div class="user-info">
                                    <span class="user-name">Marcos Javier Pérez Gómez</span>
                                    <span class="user-others">43857678J - 23/02/2021</span>
                                </div>

                            </td>
                            <td>
                                <div class="actions">
                                    <a href="admin-folders.php" class="button-primary">Detalles</a>
                                    <a href="#" class="button-delete">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="user-show">
                                <span class="pfp">
                                    <img src="../../img/pfp/yellow.webp" alt="usr">
                                </span>
                                <div class="user-info">
                                    <span class="user-name">Marcos Javier Pérez Gómez</span>
                                    <span class="user-others">43857678J - 23/02/2021</span>
                                </div>

                            </td>
                            <td>
                                <div class="actions">
                                    <a href="admin-folders.php" class="button-primary">Detalles</a>
                                    <a href="#" class="button-delete">Eliminar</a>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </main>


    </div>



</body>

</html>