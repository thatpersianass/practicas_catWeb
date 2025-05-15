<?php
session_start();
if (isset($_GET['folder'])) {
    $_SESSION['folder_selected'] = $_GET['folder'];
}
header('Location: ../../views/user/usr_files.php');
exit;
?>