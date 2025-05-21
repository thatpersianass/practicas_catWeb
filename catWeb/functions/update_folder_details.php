<?php
session_start();
if (isset($_GET['folder'])) {
    $_SESSION['folder_selected'] = $_GET['folder'];
}
header('Location: ../views/admin/admin-files.php');
exit;
?>