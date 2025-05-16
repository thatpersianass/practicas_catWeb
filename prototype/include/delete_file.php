<?php
session_start();
include("connection.php");

// Verificar archivo seleccionado
$file_id = $_SESSION['file_selected'] ?? null;
if (!$file_id) {
    header('Location: ../views/admin/admin_files_manage.php?error=no_file');
    exit;
}

// Obtener detalles del archivo
$result = mysqli_query($con, "SELECT user_id, real_name FROM files WHERE id = '$file_id'");
$file = mysqli_fetch_assoc($result);

if (!$file) {
    header('Location: ../views/admin/admin_files_manage.php?error=no_db');
    exit;
}

// Eliminar archivo físico
$file_path = "../uploads/{$file['user_id']}/{$file['real_name']}";
if (file_exists($file_path)) {
    unlink($file_path);
}

// Eliminar de la base de datos
mysqli_query($con, "DELETE FROM files WHERE id = '$file_id'");

// Redireccionar
header('Location: ../views/admin/admin_files_manage.php?success=1');
exit;
?>