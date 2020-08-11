<?php
include './Service/matriculaService.php';

if(isset($_POST["periodo"]))
{
 matricular($_POST["periodo"]);
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
                            <h3>Matricula Nuevo Ingreso</h3>
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
        </div>
    </section>
</body>

</html>