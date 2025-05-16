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
                <a href="usr_view.php" class="nav-link">
                    <span class="icon">
                        <i class="bi bi-folder"></i>
                    </span>
                    <span class="description">Carpetas</span>
                </a>
            </nav>

            <nav class="nav flex-column">
                <a href="#" class="nav-link active">
                    <span class="icon">
                        <i class="bi bi-file-earmark"></i>
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
                <div class="title-panel">
                    Tus archivos
                </div>
                <div class="search-box">
                    <input type="text" id="live_search" autocomplete="off"
                        placeholder="Introduce el nombre del archivo...">
                </div>
                <div class="search_result" id="search_result">
                    <?php fetch_files($user_data,$user_data,$con) ?>
                </div>

        </main>
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>

        <script type="text/javascript">
        $(document).ready(function() {

            $("#live_search").keyup(function() {

                var input = $(this).val();
                // alert(input);
                if (input != "") {
                    $("#search_result").css("display", "flex")
                    $.ajax({

                        url: "../../include/search_files.php",
                        method: "POST",
                        data: {
                            user_admin: <?php echo $user_data['admin']; ?>,
                            input: input
                        },

                        success: function(data) {
                            $("#search_result").html(data);
                        }
                    });
                }
            });
        });
        </script>
</body>

</html>