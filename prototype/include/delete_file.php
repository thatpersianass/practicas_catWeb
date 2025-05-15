<?php
session_start();

include("functions.php");
include("connection.php");
include("user_details.php");

// Verificar si el archivo está seleccionado
if (!isset($_SESSION['file_selected'])) {
    header('Location: ../views/admin/admin_files_manage.php?error=no_file_selected');
    die();
}

$file_id = $_SESSION['file_selected'];

// Obtener detalles del archivo
$file_details = get_file_details($file_id, $con);
if (!$file_details) {
    header('Location: ../views/admin/admin_files_manage.php?error=file_not_found');
    die();
}

// Construir ruta del archivo
$upload_dir = realpath("../uploads/") . '/'; // Usamos realpath para ruta absoluta
$file_path = $upload_dir . $file_details['user_id'] . '/' . $file_details['real_name'];

// 1. Primero verificar y eliminar el archivo físico
if (file_exists($file_path)) {
    // Verificar permisos
    if (!is_writable($file_path)) {
        header('Location: ../views/admin/admin_files_manage.php?error=file_not_writable');
        die();
    }
    
    if (!unlink($file_path)) {
        // Registrar el error para depuración
        error_log("No se pudo eliminar el archivo: " . $file_path);
        header('Location: ../views/admin/admin_files_manage.php?error=cannot_delete_file');
        die();
    }
} else {
    error_log("Archivo no encontrado: " . $file_path);
    // Puedes decidir si continuar o no cuando el archivo físico no existe
}

// 2. Luego eliminar el registro de la base de datos (usando sentencia preparada)
$query = "DELETE FROM files WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $file_id);
$result = mysqli_stmt_execute($stmt);

if (!$result) {
    error_log("Error al eliminar de BD: " . mysqli_error($con));
    header('Location: ../views/admin/admin_files_manage.php?error=database_error');
    die();
}

// Todo correcto
header('Location: ../views/admin/admin_files_manage.php?success=file_deleted');
die();
?>