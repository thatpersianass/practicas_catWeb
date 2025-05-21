<?php
    session_start();
    include('../../functions/config.php');
    include('../../functions/get_details.php');
    include('../../functions/get_files_folders.php');

    $username = $_SESSION['username'];

    $user_selected = $_SESSION['user_selected'];

    $folder_selected = $_SESSION['folder_selected'];

    $user_details = get_user_details($user_selected,$con);

    $folder_details = get_folder_details($folder_selected,$con);

    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
        exit();
    }

    if (!$_SESSION['is_admin']){
        header("Location: ../user/user-folders.php");
        exit();
    }

    $user_selected = $_SESSION['user_selected'];

    $user_details = get_user_details($user_selected,$con);

if(isset($_POST['upload'])) {
    $file = $_FILES['input-file'];
    $fileName = $_FILES['input-file']['name'];
    $fileTmpName = $_FILES['input-file']['tmp_name'];
    $fileSize = $_FILES['input-file']['size'];
    $fileError = $_FILES['input-file']['error'];
    $fileType = $_FILES['input-file']['type'];
    $user_id = $user_details['user_id'];
    $folder_id = $_SESSION['folder_selected'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $name = $_POST['name'] . '.' . $fileActualExt;

    $allowed = array('jpg','jpeg','pdf','png');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000000000){

                $uploadDir = '../../uploads/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = $uploadDir.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);

                $query ="insert into files (real_name,name,type,size,folder_id) values('$fileNameNew','$name','$fileActualExt','$fileSize','$folder_id')";
                mysqli_query($con, $query);

                header("Location: admin-files.php?uploadsuccesfull");
            } else {
                echo "The file is too big!";
            }

        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
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

                <a href="admin-folders.php" class="nav-link">
                    <div class="icon">
                        <img src="../../icons/file.png" alt="home">
                    </div>
                    <span class="description">Carpetas</span>
                </a>

                <a href="#" class="nav-link active">
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
                    <span class="inner-text">Archivos de <?= $user_details['name'] ?> - <?= $folder_details['name'] ?>
                    </span>
                </div>
                <div class="search-box">
                    <input type="text" name="search-usr" id="search-usr" class="search-bar"
                        placeholder="  Introduce el nombre del archivo...">
                    <button class="button-add" id="upload-file">Subir archivo</button>
                </div>

                <div class="folder-box">

                    <?php get_files($_SESSION['is_admin'],$folder_details['id'],$con) ?>

                </div>

            </div>
        </main>


    </div>

    <div class="modal-container" id="modal-upload-file">
        <div class="modal">
            <span class="title">
                <h1>Subir Archivo a <?=$folder_details['name']?></h1>
            </span>
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <label for="name">Nombre del archivo:</label>
                    <input type="text" class="form-control" name="name" placeholder="Introduce el nombre del archivo..."
                        required>
                    <div class="drop-file">
                        <label for="input-file" id="drop-area">
                            <input type="file" name="input-file" id="input-file" hidden>
                            <div class="drag-drop">
                                <img src="../../icons/up.png">
                                <p>Arrastra y suelta aqui un archivo <br>para subirlo</p>
                            </div>
                        </label>
                    </div>
                    <div class="buttons">
                        <input type="submit" name="upload" value="Subir Archivo" class="button-primary">
                        <button type="button" class="button-secondary" id="close">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-container" id="modal-preview">
        <div class="modal">
            <span class="title">
                <h1>Vista previa del archivo</h1>
            </span>
            <div class="modal-content" id="preview-content">
            </div>
            <div class="buttons">
                <button type="button" class="button-secondary" id="close-preview">Cerrar</button>
            </div>
        </div>
    </div>

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

    <div class="modal-container" id="modal-delete-file">
        <div class="modal">
            <span class="title">
                <h1>Eliminar Archivo</h1>
            </span>
            <div class="modal-content">
                <p class="error-message">¿Estás seguro que deseas eliminar este archivo?</p>
                <p class="error-message">¡Esta acción no se puede revertir!</p>
            </div>
            <div class="buttons">
                <a href="#" class="button-delete" id="confirm-delete">Sí</a>
                <a href="#" class="button-secondary" id="cancel-delete">No</a>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="../../scripts/drag-file.js"></script>
<script type="text/javascript" src="../../scripts/file-modal.js"></script>
<script type="text/javascript" src="../../scripts/preview-modal.js"></script>
<script type="text/javascript"">
const r_open = document.getElementById('logout');
const a_modal_container = document.getElementById('modal-logout');
const r_close = document.getElementById('close-logout');

r_open.addEventListener('click', () => {
    a_modal_container.classList.add('show');
});

r_close.addEventListener('click', () => {
    a_modal_container.classList.remove('show');
});
</script>

</html>