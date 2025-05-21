<?php
session_start();
include('config.php'); // Ajusta la ruta según donde esté tu config.php

// Comprobar que el usuario está logueado y es admin (o con permisos)
if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['folder_id'])) {
    $folder_id = intval($_GET['folder_id']);

    // Primero, obtener los archivos asociados a esa carpeta para eliminar los archivos físicos
    $query_files = "SELECT real_name FROM files WHERE folder_id = $folder_id";
    $result_files = mysqli_query($con, $query_files);

    if ($result_files) {
        while ($file = mysqli_fetch_assoc($result_files)) {
            $filePath = "../../uploads/" . $file['real_name'];
            if (file_exists($filePath)) {
                unlink($filePath); // Eliminar archivo físico
            }
        }
    }

    // Eliminar los registros de archivos en la base de datos
    $query_delete_files = "DELETE FROM files WHERE folder_id = $folder_id";
    mysqli_query($con, $query_delete_files);

    // Finalmente, eliminar la carpeta en la base de datos
    $query_delete_folder = "DELETE FROM folders WHERE id = $folder_id";
    mysqli_query($con, $query_delete_folder);

    // Redirigir a la página de carpetas con mensaje
    header("Location: ../views/admin/admin-folders.php?deleted=1");
    exit();

} else {
    // Si no se envió folder_id
    header("Location: ../views/admin/admin-folders.php?error=1");
    exit();
}
?>
