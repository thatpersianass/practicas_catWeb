<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.php');

if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $query_folders = "SELECT id FROM folders WHERE user_id = $user_id";
    $result_folders = mysqli_query($con, $query_folders);

    if ($result_folders) {
        while ($folder = mysqli_fetch_assoc($result_folders)) {
            $folder_id = $folder['id'];

            $query_files = "SELECT real_name FROM files WHERE folder_id = $folder_id";
            $result_files = mysqli_query($con, $query_files);

            if ($result_files) {
                while ($file = mysqli_fetch_assoc($result_files)) {
                    $filePath = "../uploads/" . basename($file['real_name']);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            mysqli_query($con, "DELETE FROM files WHERE folder_id = $folder_id");
        }
        mysqli_query($con, "DELETE FROM folders WHERE user_id = $user_id");
    }
    mysqli_query($con, "DELETE FROM users WHERE id = $user_id");

    header("Location: ../views/admin/admin-search.php?deleted=1");
    exit();

} else {
    header("Location: ../views/admin/admin-search.php?error=1");
    exit();
}
?>
