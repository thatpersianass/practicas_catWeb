<?php
session_start();
    include("../../include/connection.php");
    include("../../include/functions.php");

    $user_data = check_login($con);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="../../style/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <span class="title-panel">Panel de Usuario</span>
    </header>

    <div class="main-container">
        <aside class="sidebar">
            <nav class="nav flex-column usershow">
                <span class="icon_user">
                    <i class="bi bi-person"></i>
                </span>
                <span class="description"><?php echo $user_data['username'];?></span>
            </nav>

            <nav class="nav flex-column">
                <a href="#" class="nav-link active">
                    <span class="icon">
                        <i class="bi bi-folder"></i>
                    </span>
                    <span class="description">Archivos</span>
                </a>
            </nav>

            <nav class="nav flex-column">
                <a href="../../include/logout.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-box-arrow-left"></i>
                    </span>
                    <span class="description">Salir</span>
                </a>
            </nav>
        </aside>

        <main class="content">
            <div class="files-box">
                <?php fetch_folders($user_data,$user_data,$con) ?>
            </div>
        </main>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>