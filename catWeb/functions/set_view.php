<?php
session_start();

if (isset($_POST['active_view'])) {
    $_SESSION['active_view'] = $_POST['active_view'];
}
