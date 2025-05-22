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

    if(isset($_POST['add-folder']))
{
        //something was posted
        $name = $_POST['name'];
        $user_id = $user_details['id'];

        //guardar en la base de datos
        $query ="insert into folders (user_id,name) values('$user_id','$name')";
        mysqli_query($con, $query);
        
        header("Location: admin-folders.php");
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/buttons.css">
    <link rel="icon" type="image/png" href="../../favicon.png">
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

                <a href="admin-dashboard.php" class="nav-link">
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
                    <img src="../../img/pfp/admin.webp" alt="usr">
                </span>
                <div class="username">
                    <span class="innertext"><?=$username?></span>
                </div>
            </div>

            <div class="sidebar-content">

                <a href="admin-dashboard.php" class="nav-link">
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
                    <span class="inner-text">Carpetas de <?=$user_details['name']?> <?=$user_details['1surname']?>
                        <?=$user_details['2surname']?></span>
                </div>

                <div class="folder-box show">
                    <?php get_folders($_SESSION['is_admin'],$user_details['id'],$con) ?>
                </div>

            </div>
            <div class="add-button">
                <a href="#" class="button-add" id="add-folder">Crear Carpeta</a>
            </div>
        </main>

        <!-- Popup Crear Carpeta  ========================================================== -->
        <div class="modal-container" id="modal-add-folder">
            <div class="modal">
                <span class="title">
                    <h1>Crear Carpeta para <?=$user_selected?></h1>
                </span>
                <div class="modal-content">
                    <form action="#" method="post">
                        <div class="data-insertion">
                            <label for="name">Nombre de la carpeta:</label>
                            <input type="text" name="name" placeholder="  Inserte el nombre de la carpeta...">
                        </div>
                        <div class="buttons">
                            <input type="submit" name="add-folder" value="Crear carpeta" class="button-primary">
                            <button type="button" class="button-secondary" id="close">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- PopUp cerrado de sesion  ========================================================== -->
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

    <!-- PopUp eliminacion de carpeta  ========================================================== -->
    <div class="modal-container" id="modal-delete-folder">
        <div class="modal">
            <span class="title">
                <h1>Eliminar Carpeta</h1>
            </span>
            <div class="modal-content">
                <p class="error-message" id="delete-folder-message">¿Estás seguro que deseas eliminar esta carpeta?</p>
                <p class="error-message">¡Esta acción no se puede revertir!</p>
            </div>
            <div class="buttons">
                <a href="#" class="button-delete" id="confirm-delete-folder">Sí</a>
                <a href="#" class="button-secondary" id="cancel-delete-folder">No</a>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../../scripts/folder-modal.js"></script>

    <!-- Mostrar cerrado de sesión  ========================================================== -->
    <script type="text/javascript"">
    var modal_open = document.getElementById('logout');
    var r_modal_container = document.getElementById('modal-logout');
    var modal_close = document.getElementById('close-logout');

    modal_open.addEventListener('click', () => {
        r_modal_container.classList.add('show');
    });

    modal_close.addEventListener('click', () => {
        r_modal_container.classList.remove('show');
    });
    </script>

<!-- Mostrar eliminación de carpetas  ========================================================== -->
<script>
document.querySelectorAll('.open-delete-modal').forEach(button => {
    button.addEventListener('click', e => {
        e.preventDefault();

        const folderId = e.currentTarget.getAttribute('data-folder-id');
        const folderName = e.currentTarget.getAttribute('data-folder-name');

        const msg = document.getElementById('delete-folder-message');
        msg.textContent = `¿Estás seguro que deseas eliminar la carpeta "${folderName}" y todos los archivos asociados?`;

        const modal = document.getElementById('modal-delete-folder');
        modal.classList.add('show');

        const confirmBtn = document.getElementById('confirm-delete-folder');
        confirmBtn.href = `../../functions/delete_folder.php?folder_id=${folderId}`;
    });
});

document.getElementById('cancel-delete-folder').addEventListener('click', e => {
    e.preventDefault();
    const modal = document.getElementById('modal-delete-folder');
    modal.classList.remove('show');
});
</script>

</body>



</html>