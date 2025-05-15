<?php
session_start();
if (isset($_GET['user'])) {
    $_SESSION['user_selected'] = $_GET['user'];
}
header('Location: ../delete_user.php');
exit;
?>