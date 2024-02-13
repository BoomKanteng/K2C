<?php

$server="localhost";
    $dbname="k2c";
    $user="root";
    $password="rootroot";

    $conn = mysqli_connect($server,$user,$password,$dbname);

    mysqli_set_charset($conn,"utf-8");
    
    date_default_timezone_set('Asia/bangkok');

    if(!$conn){
        echo "connection fail";
    }

    ?>