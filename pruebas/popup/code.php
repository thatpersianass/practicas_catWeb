<?php
session_start();
$con = mysqli_connect("localhost","root","","pruebas_bootstrap");

if(isset($_POST['save_data']))
{
    $usrname= $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['number'];

    $query = "INSERT INTO test (usrname,email,phone) VALUES ('$usrname','$email','$phone')";
    $run = mysqli_query($con, $query);

    if($run)
    {
        $_SESSION['status'] = 'Data inserted successfully';
        header('location: index.php');
    }
    else
    {
        $_SESSION['status'] = 'Data insertion failed';
        header('location: index.php');
    }
}
?>