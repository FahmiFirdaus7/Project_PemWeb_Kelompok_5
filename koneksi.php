<?php

    $host = "localhost";
    $port = "3306";
    $user = "root";
    $pass = "";
    $db   = "hiking";

    $koneksi = mysqli_connect($host, $user, $pass, $db);
    $mysqli = new mysqli($host, $user, $pass, $db);
?>