<?php
session_start();

if(isset($_SESSION['user_id']))
{
    unset($_SESSION['user_id']);
}

// session_unset();
// seission_destroy();
header("Location:../views/login.php");
die;
?>