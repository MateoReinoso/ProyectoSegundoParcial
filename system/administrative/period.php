<?php
include './Service/matriculaService.php';

                            
$result = findPeriod();
while($row = $result->fetch_assoc()) {
    $codigo=$row['COD_PERIODO_LECTIVO'];
    $fechaInicio= $row['FECHA_INICIO'];
    $fechaFin=$row['FECHA_FIN'];
    
}

$accion="Agregar";


if (isset($_POST["startDate"])&&isset($_POST["endDate"])&&$_POST["accion"]=="Agregar")
{
    
insertPeriod($codigo+101,$_POST["startDate"],$_POST["endDate"]);
deactivatePeriod($codigo+101);  
}
$result = findPeriod();
while($row = $result->fetch_assoc()) {
    $codigo=$row['COD_PERIODO_LECTIVO'];
    $fechaInicio= $row['FECHA_INICIO'];
    $fechaFin=$row['FECHA_FIN'];
    
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php include "menu/sidebar.php" ?>
    <section class="full-box dashboard-contentPage">
        <?php include "../includes/navbar.php" ?>
        <!-- A PARTIR DE AQUI CREAR CONTENIDO DE LA PAGINA-->
        <h1>Personal Administrativo</h1>
        <div class="container-fluid"><!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
        <div class="container">
                <!-- Featured Project Row-->
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h3>Periodo Actual</h3>
                            <h4>
                            <?php echo 'Fecha de inicio: '.$fechaInicio?>
                        </h4>
                        <h4>
                            <?php echo 'Fecha fin del ciclo: '.$fechaFin?>
                        </h4>
                        </div>
        </div>
        <div class="container">
                <!-- Featured Project Row-->
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h3>Registro de de periodos</h3>
                            <form name="forma" method="post" class="form" action="./period.php">
                            <label for="startDate">Fecha inicio:</label>
                            <input type="date" id="startDate" name="startDate">
                            <label for="endDate">Fecha de fin:</label>
                            <input type="date" id="endDate" name="endDate"><br>
                            <input type="submit" name="accion" value="Agregar<?php // echo $accion ;?>">
                                
                            </form>
                        </div>
        </div>

    </section>
</body>

</html>