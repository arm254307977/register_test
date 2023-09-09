<?php

    $servername = "localhost";
    $username = "dblogintest";
    $password = "123456";
    $dbname = "dblogintest";

    $connect = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
        die("connection failed" . mysqli_connect_error());
    }

?>