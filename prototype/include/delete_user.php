<?php
session_start();

    include("functions.php");
    include("connection.php");
    include("user_details.php");

    $user_selected = $_SESSION['user_selected'];

    $user_details = get_user_details($user_selected,$con);

    $user_id = $user_details['id'];

    $query = "DELETE FROM users WHERE id = '$user_id'";

    $result = mysqli_query($con, $query);

    if (!$result) {
        header('Location: ../views/admin/admin_view.php?error_deleting_user');
        die;
    }

    header('Location: ../views/admin/admin_view.php?user_deleted_successfully');
    die;
?>