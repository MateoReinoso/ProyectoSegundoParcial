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
    return $conection->query("SELECT * FROM matricula_periodo WHERE PROMEDIO_FINAL>=7 AND COD_NIVEL_EDUCATIVO<13 AND COD_PERIODO_LECTIVO=".$codPeriodo);;
}

function matricular($codigoPeriodo)
{
    $codigo= $codigoPeriodo-101;
    $result = findMatriculaPeriodo($codigo);
    while($row = $result->fetch_assoc()) {
        insertMatricula($codigoPeriodo,$row["COD_ALUMNO"],$row["COD_NIVEL_EDUCATIVO"]+1);
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
//PARTE DE ASPIRANTES

function findCandidates()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM aspirante a, calificacion_prueba_aspirante ca WHERE a.COD_ASPIRANTE=ca.COD_ASPIRANTE AND ca.CALIFICACION>=7");;
}
function saveCandidate($cedula,$apellido,$nombre,$direccion,$telefono,$fechaNacimiento,$genero,$correoPersonal)
{
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO persona (CEDULA, APELLIDO, NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO_PERSONAL) VALUES (?, ?, ?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $cedula,$apellido,$nombre,$direccion,$telefono,$fechaNacimiento,$genero,$correoPersonal);
    $stmt->execute();
    $stmt->close();
}
function incribeCandidates()
{
    $result = findCandidates($codigo);
    while($row = $result->fetch_assoc()) {
        saveCandidate(row["CEDULA"],row["APELLIDO"],row["NOMBRE"],row["DIRECCION"],row["TELEFONO"],row["FECHA_NACIMIENTO"],row["GENERO"],row["CORREO_PERSONAL"],);
    }
    
}

//
?>