<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.php');

if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['file']) && isset($_GET['id'])) {
    $real_name = $_GET['file'];
    $id = $_GET['id'];

    $filePath = "../uploads/" . $real_name;

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $query = "DELETE FROM files WHERE id = '$id'";
    mysqli_query($con, $query);

    header("Location: ../views/admin/admin-files.php?deleted=1");
    exit();
} else {
    header("Location: ../views/admin/admin-files.php?error=1");
    exit();
}
?>
