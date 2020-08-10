<?php   
include 'conection.php';


function insertPeriod($codigo, $fechInicio, $fechFin)
{
    $conection = getConection();
    $estado='ACT';
    $stmt = $conection->prepare("INSERT INTO periodo_lectivo (COD_PERIODO_LECTIVO, ESTADO, FECHA_INICIO,FECHA_FIN) VALUES (?, ?, ?,?)");
    $stmt->bind_param("dsss",$codigo,$estado, $fechInicio, $fechFin);
    $stmt->execute();
    $stmt->close();
}
function findPeriod()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM periodo_lectivo WHERE ESTADO='ACT'");;
}
function deactivatePeriod($codigo)
{
    $codigo+=0;
    $conection = getConection();
    $stmt = $conection->prepare("UPDATE periodo_lectivo set ESTADO='INA' where COD_PERIODO_LECTIVO != ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $stmt->close();
}



?>