<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
        exit();
    }

    $username = $_SESSION['username'];
    $color = $_SESSION['color'];

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
                            <img src="../../img/pfp/<?=$color?>.webp">

                        </div>
                        <span class="username"><?= $username ?></span>
                    </nav>

                </div>

                <a href="#" class="nav-link active">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link disabled">
                    <div class="icon">
                        <img src="../../icons/document.png" alt="home">
                    </div>
                    <span class="description">Archivos</span>
                </a>

                <a href="../../functions/logout.php" class="nav-link">
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
                    <img src="../../img/pfp/<?=$color?>.webp" alt="usr">
                </span>
                <div class="username">
                    <span class="innertext"><?= $username ?></span>
                </div>
            </div>

            <div class="sidebar-content">

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="../../functions/logout.php" class="nav-link">
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
                    <span class="inner-text">Carpetas de Placeholder</span>
                </div>

                <div class="folder-box">

                    <div class="folder-element">
                        <div class="folder">
                            <span class="icon">
                                <img src="../../icons/file.png" alt="folder-icon">
                            </span>
                            <div class="folder-info">
                                <span class="description">
                                    Documentos
                                </span>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="user-files.php" class="button-primary">Ver</a>
                        </div>
                    </div>
                    <div class="folder-element">
                        <div class="folder">
                            <span class="icon">
                                <img src="../../icons/file.png" alt="folder-icon">
                            </span>
                            <div class="folder-info">
                                <span class="description">
                                    Documentos
                                </span>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="user-files.php" class="button-primary">Ver</a>
                        </div>
                    </div>

                </div>

            </div>
        </main>


    </div>



</body>

</html>