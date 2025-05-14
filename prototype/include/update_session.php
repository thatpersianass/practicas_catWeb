<?php
session_start();
if (isset($_GET['user'])) {
    $_SESSION['user_selected'] = $_GET['user'];
}
header('Location: ../views/admin/admin_files.php');
exit;
?>