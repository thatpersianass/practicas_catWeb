<?php
    session_start();
    include('../../functions/config.php');
    include_once('../../functions/get_details.php');
    include('../../functions/get_files_folders.php');

    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
        exit();
    }

    $username = $_SESSION['username'];
    $color = $_SESSION['color'];
    $user_details = get_user_details($username,$con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/buttons.css">
    <link rel="icon" type="image/png" href="../../favicon.png">
    <title>Carpetas</title>
</head>

<body>
    <!-- Encabezado ========================================================== -->
    <header>
        <span class="header-title"><?=$user_details['name']?> <?=$user_details['1surname']?>
            <?=$user_details['2surname']?></span>
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

                <a href="#" class="nav-link" id="logout">
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

                <a href="#" class="nav-link" id="logout">
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
                    <span class="inner-text">Tus carpetas</span>
                </div>

                <div class="folder-box">
                    <?php get_folders($_SESSION['is_admin'],$user_details['id'],$con) ?>
                </div>

            </div>
        </main>


    </div>

    <!-- PopUp cerrado de sesión ========================================================== -->
    <div class="modal-container" id="modal-logout">
        <div class="modal">
            <span class="title">
                <h1>Cerrar sesión</h1>
            </span>
            <div class="modal-content">
                <p class="error-message">¿Estás seguro que deseas cerrar sesión?</p>
            </div>
            <div class="buttons">
                <a href="../../functions/logout.php" class="button-delete"> Si </a>
                <a href="#" class="button-secondary" id="close-logout">No</a>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript"">
var u_open = document.getElementById('logout');
var u_modal_container = document.getElementById('modal-logout');
var u_close = document.getElementById('close-logout');

u_open.addEventListener('click', () => {
    u_modal_container.classList.add('show');
});

u_close.addEventListener('click', () => {
    u_modal_container.classList.remove('show');
});
</script>
</html>