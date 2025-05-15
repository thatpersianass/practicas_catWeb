<?php
session_start();
if (isset($_GET['file_id'])) {
    $_SESSION['file_selected'] = $_GET['file_id'];
}
header('Location: ../delete_file.php');
exit;
?>