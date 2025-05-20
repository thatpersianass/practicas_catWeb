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
                            <img src="../../img/pfp/blue.webp">

                        </div>
                        <span class="username">Placeholder</span>
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
                    <img src="../../img/pfp/admin.webp" alt="usr">
                </span>
                <div class="username">
                    <span class="innertext">Placeholder</span>
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
                    <span class="inner-text">Archivos de placeholder - --carpeta-- </span>
                </div>
                <div class="search-box">
                    <input type="text" name="search-usr" id="search-usr" class="search-bar"
                        placeholder="  Introduce el nombre del archivo...">
                </div>

                <div class="folder-box">

                    <div class="folder-element">
                        <div class="folder">
                            <span class="icon">
                                <img src="../../icons/document.png" alt="folder-icon">
                            </span>
                            <div class="folder-info">
                                <span class="description">
                                    Factura.pdf
                                </span>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="#" class="button-primary">Ver</a>
                            <a href="" class="button-secondary">Descargar</a>
                        </div>
                    </div>
                    <div class="folder-element">
                        <div class="folder">
                            <span class="icon">
                                <img src="../../icons/png.png" alt="folder-icon">
                            </span>
                            <div class="folder-info">
                                <span class="description">
                                    meme.png
                                </span>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="#" class="button-primary">Ver</a>
                            <a href="" class="button-secondary">Descargar</a>
                        </div>
                    </div>

                </div>

            </div>
        </main>


    </div>



</body>

</html>