<?php
session_start();
$admin = $_SESSION['is_admin'];

if (isset($_GET['folder'])) {
    $_SESSION['folder_selected'] = $_GET['folder'];
}
if($admin){
    header('Location: ../views/admin/admin-files.php');
    exit;
} else {
    header('Location: ../views/user/user-files.php');
    exit;
}
?>