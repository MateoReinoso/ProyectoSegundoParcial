<?php
//DESTRUYE LA SESION CUANDO CLICKEAMOS EN LOGOUT
    session_start();
    session_destroy();

    header('location: start.php');
?>