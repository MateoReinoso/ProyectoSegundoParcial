<?php
function getConection()
{
    $host = 'br1he3ydbvwczq2gziyd-mysql.services.clever-cloud.com';
    $user = 'ujjyf3gvlocovukq';
    $password = '9QpZlzvcXJzhAVLVB0Zx';
    $db = 'br1he3ydbvwczq2gziyd';

    $connection = @mysqli_connect($host,$user,$password,$db);
    
    if (!$connection) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "errno de  depuración: " . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }
    return $connection;
}

?>
