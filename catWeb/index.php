<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
                            <img src="img/usr_placeholder.webp">

                        </div>
                        <span class="username">Placeholder</span>
                    </nav>

                </div>

                <a href="#" class="nav-link active">
                    <div class="icon">
                        <img src="icons/home.png" alt="home">
                    </div>
                    <span class="description">Inicio</span>
                </a>

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="icons/zoom.png" alt="home">
                    </div>
                    <span class="description">Buscar Usuarios</span>
                </a>

                <a href="#" class="nav-link">
                    <div class="icon">
                        <img src="icons/close.png" alt="home">
                    </div>
                    <span class="description">Cerrar Sesión</span>
                </a>
            </div>

        </aside>


        <!-- Barra de navegación para móvil ========================================================== -->
        <nav class="mobile-navbar">
            <div class="user-info">
                <span class="icon">
                    <img src="img/usr_placeholder.webp" alt="usr">
                </span>
                <div class="username">
                    <span class="innertext">Placeholder</span>
                </div>
            </div>
        
        <div class="sidebar-content">

            <a href="#" class="nav-link active">
                <div class="icon">
                    <img src="icons/home.png" alt="home">
                </div>
                <span class="description">Inicio</span>
            </a>

            <a href="#" class="nav-link">
                <div class="icon">
                    <img src="icons/zoom.png" alt="home">
                </div>
                <span class="description">Buscar Usuarios</span>
            </a>

            <a href="#" class="nav-link">
                <div class="icon">
                    <img src="icons/close.png" alt="home">
                </div>
                <span class="description">Cerrar Sesión</span>
            </a>
        </div>
        </nav>

        <!-- Contenido principal ========================================================== -->
        <main class="content">
            <div class="admin-dashboard">
                <div class="user-count">
                    <div class="topbar">
                        <span class="innertext">Usuarios registrados</span>
                    </div>
                    <div class="count-content">
                        <span class="icon">
                            <img src="icons/users.png" alt="users-count">
                        </span>
                        <span class="inner-text">
                            Hay <b class="special-text-1">X</b> usuarios registrados en el Servicio
                        </span>
                    </div>

                </div>

                <div class="files-count">
                    <div class="topbar">
                        <span class="innertext">Archivos Subidos</span>
                    </div>
                    <div class="count-content">
                        <span class="icon">
                            <img src="icons/diskette.png" alt="users-count">
                        </span>
                        <span class="inner-text">
                            Hay <b class="special-text-1">X</b> archivos subidos a la nube
                        </span>
                    </div>
                </div>
                <div class="last-user">
                    <div class="topbar">
                        <span class="innertext">Ultimo usuario</span>
                    </div>
                    <div class="count-content">
                        <span class="icon">
                            <img src="icons/user.png" alt="users-count">
                        </span>
                        <span class="inner-text">
                            <b class="special-text-1">X</b> se ha conectado el <b class="special-text-1">XX-XX-XXXX</b>
                        </span>
                    </div>
                </div>
        </main>


    </div>



</body>

</html>