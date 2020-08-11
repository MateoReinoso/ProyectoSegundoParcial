<?php
include './Service/matriculaService.php';


$codigoNivel="";
if(isset($_POST["periodo"])&&$_POST["accion"]=="Matricular")
{
 matricular($_POST["periodo"]);
} 
if(isset($_POST["periodo1"])&&$_POST["accion"]=="Registrar")
{
    incribeCandidates($_POST["periodo1"]);
}
if(isset($_POST["nivel"])&&$_POST["accion"]=="Nivel")
{
    $result = findNivelById($_POST["nivel"]);
    $row = $result->fetch_assoc();
    $codigoNivel=$row["COD_NIVEL_EDUCATIVO"];
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
                            <h3>Matricula automatica</h3>
                            <h4>
                            <?php ?>
                        </h4>
                        <form name="forma" method="post" class="form" action="./matricula.php">
                        <label for="periodo" class="text-white mb-4">Elija un periodo:</label>
                        <select id="periodo" name="periodo">
                        <?php
                        $result = findPeriod();
                        while($row = $result->fetch_assoc()) {
                            $sub1 = substr($row['FECHA_INICIO'], 0, 4);
                            $sub2 = substr($row['FECHA_FIN'], 0, 4);?>
                        <option value=<?php echo $row['COD_PERIODO_LECTIVO'];?>  ><?php echo $sub1.'-'.$sub2;?></option>
                        <?php 
                        }
                        ?>
                        </select>
                        <input type="submit" name="accion" value="Matricular">
                        </form>
                        </div>
        </div>
        <div class="container">
                <!-- Featured Project Row-->
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h3>Matricula por Nuevos Aspirantes</h3>
                            <h4>
                            <?php ?>
                        </h4>
                        <form name="forma" method="post" class="form" action="./matricula.php">
                        <label for="periodo1" class="text-white mb-4">Elija un periodo:</label>
                        <select id="periodo1" name="periodo1">
                        <?php
                        $result = findPeriod();
                        while($row = $result->fetch_assoc()) {
                            $sub1 = substr($row['FECHA_INICIO'], 0, 4);
                            $sub2 = substr($row['FECHA_FIN'], 0, 4);?>
                        <option value=<?php echo $row['COD_PERIODO_LECTIVO'];?>  ><?php echo $sub1.'-'.$sub2;?></option>
                        <?php 
                        }
                        ?>
                        </select>
                        <input type="submit" name="accion" value="Registrar">
                        </form>


                        </div>
        </div>
        </div>
        <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h3>Matriculados por nivel</h3>
                            
                        <form name="forma" method="post" class="form" action="./matricula.php">
                        <label for="nivel" class="text-white mb-4">Elija un nivel:</label>
                        <select id="nivel" name="nivel">
                        <?php
                        $result1 = findNivel();
                        while($row1 = $result1->fetch_assoc()) {?>
                        <option value=<?php echo $row1['COD_NIVEL_EDUCATIVO'];?>  ><?php echo $row1["NOMBRE"];?></option>
                        <?php 
                        }
                        ?>
                        </select>
                        <input type="submit" name="accion" value="Nivel">
                        </form>
                        <?php
                        if($codigoNivel!="")

                        {
                             ?>
                            <table class="table text-white-50 text-center table-bordered ">
                            <tr>
                                <td>Periodo</td>
                                <td>Nivel</td>
                                <td>Alumno</td>
                                
                            </tr>
                            <?php 
                            $resultMatricula = findMatriculaNivel($codigoNivel);
                            if ($resultMatricula->num_rows > 0) {
                            // output data of each row
                            while($rowMatricula = $resultMatricula->fetch_assoc()) {
                                $resultNivel = findNivelById($rowMatricula["COD_NIVEL_EDUCATIVO"]);
                                $rowNivel = $resultNivel->fetch_assoc();
                                $resultAlumno = findNivelAlumnoById($rowMatricula["COD_ALUMNO"]);
                                $rowAlumno = $resultAlumno->fetch_assoc();
                            ?>
                            <tr>
                                <td><?php echo $rowMatricula['COD_PERIODO_LECTIVO']; ?></td>
                                <td><?php echo $rowNivel['NOMBRE']; ?></td>
                                <td><?php echo $rowAlumno['NOMBRE']." ".$rowAlumno['APELLIDO'] ; ?></td>
                            </tr>
                            <?php }
                        
                    }
                }
                        ?>
                        </div>
        
        </div>
        
    </section>
</body>

</html>