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

    $username = $_SESSION['username'];

    $users_registered = 0;
    $result = $con->query("SELECT COUNT(*) AS total FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        $users_registered = (int)$row['total'];
    }

    $files_count = 0;
    $result = $con->query("SELECT COUNT(*) AS total FROM files");
    if ($result) {
        $row = $result->fetch_assoc();
        $files_count = (int)$row['total'];
    }

    $latest_user = null;
    $result = $con->query("SELECT username, created FROM users ORDER BY created DESC LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latest_user = $row['username'];
        $date = $row['created'];
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
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
                        <span class="../../username"><?= $username?></span>
                    </nav>

                </div>

                <a href="#" class="nav-link active">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="views/admin/admin-search.php" class="nav-link">
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
                    <img src="../../img/pfp/admin.webp" alt="usr">
                </span>
                <div class="username">
                    <span class="innertext"><?= $username?></span>
                </div>
            </div>

            <div class="sidebar-content">

                <a href="#" class="nav-link active">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="admin-search.php" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/zoom.png" alt="home">
                    </div>
                    <span class="description">Buscar Usuarios</span>
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
            <div class="admin-dashboard" style="background: none; border: none;">
                <div class="user-count">
                    <div class="topbar">
                        <span class="innertext">Usuarios registrados</span>
                    </div>
                    <div class="count-content">
                        <span class="icon">
                            <img src="../../icons/users.png" alt="users-count">
                        </span>
                        <span class="inner-text">
                            Hay <b class="special-text-1"><?= $users_registered ?></b> usuarios registrados en el Servicio
                        </span>
                    </div>

                </div>

                <div class="files-count">
                    <div class="topbar">
                        <span class="innertext">Archivos Subidos</span>
                    </div>
                    <div class="count-content">
                        <span class="icon">
                            <img src="../../icons/diskette.png" alt="users-count">
                        </span>
                        <span class="inner-text">
                            Se han subido <b class="special-text-1"><?= $files_count ?></b> archivos a la nube
                        </span>
                    </div>
                </div>
                <div class="last-user">
                    <div class="topbar">
                        <span class="innertext">Ultimo usuario</span>
                    </div>
                    <div class="count-content">
                        <span class="icon">
                            <img src="../../icons/user.png" alt="users-count">
                        </span>
                        <span class="inner-text">
                            <b class="special-text-1"><?= $latest_user ?></b> se ha registrado el <b class="special-text-1"><?= $date ?></b>
                        </span>
                    </div>
                </div>
        </main>


    </div>



</body>

</html>