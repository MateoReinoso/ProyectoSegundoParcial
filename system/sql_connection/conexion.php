<?php
//conexion a la base de datos
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'sistemaescolar';

    $connection = @mysqli_connect($host,$user,$password,$db);
?>