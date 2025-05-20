<?php
    session_start();
    include('../../functions/config.php');
    include('../../functions/get_details.php');
    include('../../functions/get_files_folders.php');

    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
        exit();
    }

    if (!$_SESSION['is_admin']){
        header("Location: ../user/user-folders.php");
        exit();
    }

    $username = $_SESSION['username'];

    $user_selected = $_SESSION['user_selected'];

    $user_details = get_user_details($user_selected,$con);
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
                        <span class="username"><?=$username?></span>
                    </nav>

                </div>

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/zoom.png" alt="home">
                    </div>
                    <span class="description">Buscar Usuarios</span>
                </a>

                <a href="#" class="nav-link active">
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
                    <span class="innertext"><?=$username?></span>
                </div>
            </div>

            <div class="sidebar-content">

                <a href="../index.php" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link">
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
                    <span class="inner-text">Carpetas de <?=$user_details['name']?> <?=$user_details['1surname']?> <?=$user_details['2surname']?></span>
                </div>

                <div class="folder-box">
                    <?php get_folders($user_details['id'],$con) ?>
                </div>

            </div>
            <div class="add-button">
                <a href="#" class="button-add">Crear Carpeta</a>
            </div>
        </main>


    </div>



</body>

</html>