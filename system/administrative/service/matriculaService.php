<?php   
include 'conection.php';


function insertMatricula($codigoPeriodo,$codAlumno,$codNivel)
{
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO matricula_periodo (COD_PERIODO_LECTIVO, COD_ALUMNO, COD_NIVEL_EDUCATIVO) VALUES (?, ?, ?)");
    $stmt->bind_param("sss",$codigoPeriodo,$codAlumno, $codNivel);
    $stmt->execute();
    $stmt->close();
}
function findMatricula()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM matricula_periodo m,periodo_lectivo p WHERE p.ESTADO='ACT' AND m.COD_PERIODO_LECTIVO=p.COD_PERIODO_LECTIVO");;
}
function findMatriculaPeriodo($codPeriodo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM matricula_periodo WHERE PROMEDIO_FINAL>=7 AND COD_PERIODO_LECTIVO=".$codPeriodo);;
}

function matricular($codigoPeriodo)
{
    $codigo= $codigoPeriodo-101;
    $result = findMatriculaPeriodo($codigo);
    while($row = $result->fetch_assoc()) {
        insertMatricula($codigoPeriodo,$row["COD_ALUMNO"],$row["COD_NIVEL_EDUCATIVO"]);
    }
    
}

// Servicios periodos

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