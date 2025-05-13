<?php

    $con = mysqli_connect("localhost","root","","test");

    if(!$con){
        echo "Connection Failed" . mysqli_connect_error();
    }
?>