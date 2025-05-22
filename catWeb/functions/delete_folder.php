<?php
session_start();
include('config.php');

if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['folder_id'])) {
    $folder_id = intval($_GET['folder_id']);

    $query_files = "SELECT real_name FROM files WHERE folder_id = '$folder_id'";
    $result_files = mysqli_query($con, $query_files);

    if ($result_files) {
        while ($file = mysqli_fetch_assoc($result_files)) {
            $filePath = "../uploads/" . $file['real_name'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    $query_delete_files = "DELETE FROM files WHERE folder_id = $folder_id";
    mysqli_query($con, $query_delete_files);

    $query_delete_folder = "DELETE FROM folders WHERE id = $folder_id";
    mysqli_query($con, $query_delete_folder);

    header("Location: ../views/admin/admin-folders.php?deleted=1");
    exit();

} else {
    header("Location: ../views/admin/admin-folders.php?error=1");
    exit();
}
?>
