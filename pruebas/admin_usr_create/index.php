<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    if(!$user_data['admin'])
    {
        header('Location: usr_view.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">LogOut</a>
    <h1>INDEX</h1>
    <p>Hello, <?php echo $user_data['username'];?>.</p>

    
</body>
</html>