<?php
    session_start();
    include('../../functions/config.php');
    include_once('../../functions/get_details.php');
    include('../../functions/get_files_folders.php');

    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
        exit();
    }
    $folder_selected = $_SESSION['folder_selected'];

    $username = $_SESSION['username'];
    $color = $_SESSION['color'];
    $user_details = get_user_details($username,$con);
    $folder_details = get_folder_details($folder_selected,$con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/buttons.css">
    <title>Archivos</title>
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

                <a href="user-folders.php" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link active">
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

                <a href="user-folders.php" class="nav-link">
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
                    <span class="inner-text"></span>
                </div>
                <div class="search-box">
                    <input type="text" name="search-usr" id="search-usr" class="search-bar"
                        placeholder="  Introduce el nombre del archivo...">
                </div>

                <div class="folder-box" id="folder-box">

                    <?php get_files($_SESSION['is_admin'],$folder_details['id'],$con) ?>

                </div>

            </div>
        </main>


    </div>

    <div class="modal-container" id="modal-preview">
        <div class="modal">
            <span class="title">
                <h1>Vista previa del archivo</h1>
            </span>
            <div class="modal-content" id="preview-content">
                <!-- Aquí se inserta dinámicamente un <iframe> o <img> -->
            </div>
            <div class="buttons">
                <button type="button" class="button-secondary" id="close-preview">Cerrar</button>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="../../scripts/preview-modal.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $("#search-usr").keyup(function() {

        var input = $(this).val();
        if (input != "") {
            $("#folder-box").css("display", "flex")
            $.ajax({

                url: "../../functions/file_search.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#folder-box").html(data);
                }
            });
        } else {

            location.reload();
        }
    });
});
</script>
</html>