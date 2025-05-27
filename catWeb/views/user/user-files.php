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

    $active_view = $_SESSION['active_view'] ?? 'simple';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/buttons.css">
    <link rel="icon" type="image/png" href="../../favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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

                <a href="user-folders.php" class="nav-link">
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
                    <span class="inner-text"></span>
                </div>
                <div class="search-box">
                    <input type="text" name="search-usr" id="search-usr" class="search-bar"
                        placeholder="  Introduce el nombre del archivo...">
                </div>

                <div class="views">
                    <a href="?view=general" class="button-icon <?= $active_view === 'simple' ? 'active' : '' ?>"
                        id="general-view" title="Vista general"><img src="../../icons/general-view.png"></a>
                    <a href="?view=detailed" class="button-icon <?= $active_view === 'detailed' ? 'active' : '' ?>"
                        id="detailed-view" title="Vista detallada"><img src="../../icons/detailed-view.png"></a>
                </div>

                <div class="folder-box <?= $active_view === 'simple' ? 'show' : '' ?>" id="folder-box">

                    <?php get_files($_SESSION['is_admin'],$folder_details['id'],$con) ?>

                </div>
                <div class="folder-box <?= $active_view === 'simple' ? 'show' : '' ?>" id="folder-box">

                    <?php get_files($_SESSION['is_admin'],$folder_details['id'],$con) ?>

                </div>

                <div class="folder-box-details <?= $active_view === 'detailed' ? 'show' : '' ?>" id="file-table">
                    <?php
                        if ($active_view === 'detailed') {
                            get_files_detailed($_SESSION['is_admin'], $folder_details['id'], $con);
                        }
                    ?>
                </div>
                <div class="query-buttons">
                    <a href="#" class="button-add" id="export-csv">Exportar CSV</a>
                    <a href="#" class="button-secondary" id="export-pdf">Imprimir</a>
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
    <!-- Popup de previsualización ========================================================== -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<!-- Busqueda de archivos ========================================================== -->
<script type="text/javascript">
$(document).ready(function() {

    $("#search-usr").keyup(function() {
        var input = $(this).val();
        var folder_id = "<?php echo $folder_details['id'] ?? ''; ?>";
        if (input != "") {
            // Saber qué vista está activa
            var activeView = "<?php echo $_SESSION['active_view'] ?? 'simple'; ?>";

            if (activeView === "detailed") {
                // Mostrar la tabla (en caso esté oculta)
                $("#folder-box").hide();
                $("#file-table").show();

                $.ajax({
                    url: "../../functions/file_search.php",
                    method: "POST",
                    data: {
                        input: input,
                        folder_id: folder_id
                    },
                    success: function(data) {
                        // Poner los <tr> en el tbody de la tabla
                        $("#file-table-body").html(data);
                    }
                });

            } else {
                // Vista simple: mostrar carpeta, ocultar tabla
                $("#folder-box").css("display", "flex");
                $("#file-table").hide();

                $.ajax({
                    url: "../../functions/file_search.php",
                    method: "POST",
                    data: {
                        input: input,
                        folder_id: folder_id
                    },
                    success: function(data) {
                        // Poner los divs en folder-box
                        $("#folder-box").html(data);
                    }
                });
            }
        } else {
            location.reload();
        }
    });
});
</script>

<!-- Vistas detallada y simple ======================================================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const btnDetailed = document.getElementById('detailed-view');
    const btnSimple = document.getElementById('general-view');
    const boxSimple = document.getElementById('folder-box');
    const boxDetailed = document.getElementById('file-table');
    const btnCSV = document.getElementById('export-csv');
    const btnPDF = document.getElementById('export-pdf');

    function setActiveView(view) {
        if (view === 'detailed') {
            boxSimple.classList.remove('show');
            boxSimple.classList.add('hide');
            boxDetailed.classList.remove('hide');
            boxDetailed.classList.add('show');

            btnDetailed.classList.add('active');
            btnSimple.classList.remove('active');

            btnCSV.classList.remove('hide');
            btnCSV.classList.add('show');
            btnPDF.classList.remove('hide');
            btnPDF.classList.add('show');
        } else {
            boxSimple.classList.remove('hide');
            boxSimple.classList.add('show');
            boxDetailed.classList.remove('show');
            boxDetailed.classList.add('hide');

            btnDetailed.classList.remove('active');
            btnSimple.classList.add('active');

            btnCSV.classList.remove('show');
            btnCSV.classList.add('hide');
            btnPDF.classList.remove('show');
            btnPDF.classList.add('hide');
        }
    }

    // Obtener la vista desde la URL
    function getViewFromURL() {
        const params = new URLSearchParams(window.location.search);
        const view = params.get('view');
        if (view === 'detailed' || view === 'general') {
            return view === 'detailed' ? 'detailed' : 'simple';
        }
        return 'simple'; // valor por defecto
    }

    // Al cargar la página, aplicar vista según URL
    setActiveView(getViewFromURL());

    btnDetailed.addEventListener('click', function (e) {
        e.preventDefault();
        history.replaceState(null, '', '?view=detailed');
        location.reload();
    });

    btnSimple.addEventListener('click', function (e) {
        e.preventDefault();
        history.replaceState(null, '', '?view=general');
        location.reload();
    });
});
</script>

<!-- Exportación a CSV de la búsqueda detallada ==================================== -->
<script>
    document.getElementById("export-csv").addEventListener("click", function(e) {
        e.preventDefault();

        const table = document.querySelector("#file-table table");
        if (!table) return alert("No se encontró la tabla para exportar.");

        let csv = [];
        const rows = table.querySelectorAll("tr");

        for (let row of rows) {
            let cols = row.querySelectorAll("th, td");
            let rowData = [];

            // Excluir la última columna (Acciones)
            for (let i = 0; i < cols.length - 1; i++) {
                let data = cols[i].innerText.replace(/(\r\n|\n|\r)/gm, "").replace(/"/g, '""');
                rowData.push(`"${data}"`);
            }

            csv.push(rowData.join(","));
        }

        const csvString = csv.join("\n");
        const blob = new Blob([csvString], { type: "text/csv" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "archivos_exportados.csv";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });
</script>

<!-- Exportar a PDF ======================================================= -->
<script>
document.getElementById("export-pdf").addEventListener("click", function(e) {
    e.preventDefault();

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const table = document.querySelector("#file-table table");
    if (!table) return alert("No se encontró la tabla para exportar.");

    // Obtener headers (sin columna Acciones)
    let headers = [];
    table.querySelectorAll("thead tr th").forEach((th, i, arr) => {
        if (i < arr.length - 1) { // excluye última columna
            headers.push(th.innerText.trim());
        }
    });

    // Obtener filas de datos (sin columna Acciones)
    let data = [];
    table.querySelectorAll("tbody tr").forEach(row => {
        let rowData = [];
        const cols = row.querySelectorAll("td");
        for (let i = 0; i < cols.length - 1; i++) { // excluye última columna
            rowData.push(cols[i].innerText.trim());
        }
        data.push(rowData);
    });

    doc.autoTable({
        head: [headers],
        body: data,
        startY: 10,
        styles: { fontSize: 8 },
        headStyles: { fillColor: [22, 160, 133] },
        alternateRowStyles: { fillColor: [238, 238, 238] },
    });

    doc.autoPrint();
    window.open(doc.output('bloburl'), '_blank');
});
</script>

<!-- Ordenado y filtrado================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
const table = document.getElementById('file-table');
const headers = table.querySelectorAll('th.sortable');
let sortDirection = {};

headers.forEach((header, index) => {
    sortDirection[index] = 'asc';

    header.addEventListener('click', () => {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const sortType = header.getAttribute('data-sort');

    rows.sort((a, b) => {
        let aText = a.children[index].textContent.trim();
        let bText = b.children[index].textContent.trim();

        if (sortType === 'size') {
        const sizeToBytes = (sizeStr) => {
            const [value, unit] = sizeStr.split(' ');
            const valNum = parseFloat(value);
            if (unit === 'KB') return valNum * 1024;
            if (unit === 'MB') return valNum * 1048576;
            return valNum;
        }
        aText = sizeToBytes(aText);
        bText = sizeToBytes(bText);
        }

        else if (sortType === 'created') {
        aText = new Date(aText);
        bText = new Date(bText);
        }

        else {
        aText = aText.toLowerCase();
        bText = bText.toLowerCase();
        }

        if (aText > bText) return sortDirection[index] === 'asc' ? 1 : -1;
        if (aText < bText) return sortDirection[index] === 'asc' ? -1 : 1;
        return 0;
    });

    sortDirection[index] = sortDirection[index] === 'asc' ? 'desc' : 'asc';

    rows.forEach(row => tbody.appendChild(row));
    });
});
});
</script>

<!-- Mostrar cerrado de sesión ========================================================== -->
<script type="text/javascript"">
var open = document.getElementById('logout');
var modal_container = document.getElementById('modal-logout');
var close = document.getElementById('close-logout');

open.addEventListener('click', () => {
    modal_container.classList.add('show');
});

close.addEventListener('click', () => {
    modal_container.classList.remove('show');
});
</script>

</html>