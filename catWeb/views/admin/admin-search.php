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

    $errors = ['register' => $_SESSION['register_error'] ?? ''];

    $activeForm = $_SESSION['active_form'] ?? '';

    function showError($error) {
    return !empty($error) ? "<div class='error-message'>$error</div>" : '';
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
                        <span class="username"><?= $username?></span>
                    </nav>

                </div>

                <a href="admin-dashboard.php" class="nav-link">
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

                <a href="admin-dashboard.php" class="nav-link">
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
                    <span class="inner-text">Buscar Usuarios</span>
                </div>
                <div class="search-box">
                    <input type="text" name="search-usr" id="search-usr" class="search-bar"
                        placeholder="  Introduce el nombre, apellido o DNI del usuario...">
                    <button class="button-add" id="user-create">Añadir usuario</button>
                </div>

                <div class="user-display-box" id="user-display-box">
                </div>
            </div>
        </main>
    </div>

    <!-- Modal/Popup -->
    <div class="modal-container <?= (isset($_SESSION['active_form']) && $_SESSION['active_form'] === 'register') ? 'show' : '' ?>"
        id="modal-add-user">
        <div class="modal">
            <div class="title">
                <h1>Crear Usuario</h1>
                
            </div>
            <div class="modal-content">
                <?= showError($errors['register']); ?>
                <form action="../../functions/admin-register-user.php" method="post">
                    <div class="data-insertion">
                        <label for="name">Nombre(s):</label>
                        <input type="text" name="name" placeholder="  Inserte el/los nombre(s)...">

                        <label for="surname1">Primer apellido:</label>
                        <input type="text" name="surname1" placeholder="  Inserte primer apellido...">

                        <label for="surname2">Segundo apellido:</label>
                        <input type="text" name="surname2" placeholder="  Inserte segundo apellido...">

                        <label for="dni">DNI:</label>
                        <input type="text" name="dni" placeholder="  Inserte DNI...">

                        <label for="username">Nombre de usuario:</label>
                        <input type="text" name="username" placeholder="  Inserte usuario..." required>

                        <label for="password">Contraseña:</label>
                        <input type="password" id="passwd" name="password" placeholder="  Inserte contraseña..."
                            required>
                        <div class="checkboxes">
                            <span class="checkbox">
                                <label for="admin" class="frutiger-checkbox">
                                <input type="checkbox" name="admin" value="1">
                                <span class="custom-check"></span>
                                Administrador
                                </label>
                            </span>
                            <span class="checkbox">
                                <label for="show-passwd" class="frutiger-checkbox">
                                <input type="checkbox" name="show-passwd" value="1" onclick="mostrarContrasenia()">
                                <span class="custom-check"></span>
                                Mostrar Contraseña
                                </label>
                            </span>
                        </div>
                    </div>

                    <script type="text/javascript">
                    function mostrarContrasenia() {
                        var x = document.getElementById("passwd");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                    </script>

                    <div class="buttons">
                        <input type="submit" name="register" value="Añadir usuario" class="button-primary">
                        <button type="button" class="button-secondary" id="close">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript" src="../../scripts/user-modal.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $("#search-usr").keyup(function() {

        var input = $(this).val();
        if (input != "") {
            $("#user-display-box").css("display", "flex")
            $.ajax({

                url: "../../functions/user_search.php",
                method: "POST",
                data: {
                    input: input
                },

                success: function(data) {
                    $("#user-display-box").html(data);
                }
            });
        } else {

            $("#user-display-box").css("display", "none")
        }
    });
});
</script>

<?php
if (isset($_SESSION['active_form'])) {
    unset($_SESSION['active_form']);
}
?>

</html>