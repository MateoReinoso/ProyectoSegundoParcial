<?php
include './Service/matriculaService.php';


$codigoNivel="";
$nombre="";
$nombreNivel="";
$tipo="";
$creditos=0;
$accion="Agregar";

if(isset($_POST["periodo1"])&&$_POST["accion"]=="Registrar")
{
    incribeCandidates($_POST["periodo1"]);
}
if(isset($_POST["nivel"])&&$_POST["accion"]=="Seleccionar")
{
    $result = findNivelById($_POST["nivel"]);
    $row = $result->fetch_assoc();
    $codigoNivel=$row["COD_NIVEL_EDUCATIVO"];
    $nombreNivel=$row["NOMBRE"];
} 
if(isset($_POST["codNivel"])&&isset($_POST["accion"])=="Agregar")
{
    insertAsignatura($_POST["codNivel"],$_POST["nombre"],$_POST["creditos"],$_POST["tipo"]);
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
        

        
        <div class="container-fluid"><!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
        <h1>Personal Administrativo</h1>
        <div class="container-fluid"><!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
        <div class="container">
                <!-- Featured Project Row-->
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h3>Asignaturas</h3>
                            <h4>
                            <?php ?>
                        </h4>
                        <form name="forma" method="post" class="form" action="./asignatura.php">
                        <label for="nivel" class="text-white mb-4">Elija un nivel academico:</label>
                        <select id="nivel" name="nivel">
                        <?php
                        $result = findNivel();
                        while($row = $result->fetch_assoc()) {
                            //$sub1 = substr($row['FECHA_INICIO'], 0, 4);
                            //$sub2 = substr($row['FECHA_FIN'], 0, 4);?>
                        <option value=<?php echo $row['COD_NIVEL_EDUCATIVO'];?>  ><?php echo $row["NOMBRE"];?></option>
                        <?php 
                        }
                        ?>
                        </select>
                        <input type="submit" name="accion" value="Seleccionar">
                        </form>
                        </div>
        </div>

        <?php 
        if ($codigoNivel!="")
        {
        ?>
        <!-- Featured Project Row-->
        <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h3>Registro</h3>
                            <h4>
                            <?php ?>
                        </h4>
                        <form name="forma" method="post" class="form" action="./asignatura.php">
                            <label for="codNivel"><?php echo $nombreNivel; ?></label>
                            <input type="hidden" id="codNivel" name="codNivel" value="<?php echo $codigoNivel; ?>" required>
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                            <label for="creditos">Creditos:</label>
                            <input type="text" id="creditos" name="creditos" value="<?php echo $creditos; ?>"required pattern="[0-9.0]+">
                            <label for="tipo">Tipo:</label>
                            <input type="text" id="tipo" name="tipo" value="<?php echo $tipo; ?>" required>
                            <?php ?>
                            <input type="submit" name="accion" value="<?php echo $accion ;?>">
                            
                        </form> 
                        </div>
        </div>
        <!-- Featured Project Row-->
        <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                        <br><br>
                        <h3>Lista de asignaturas</h3><br><br>
                        <table class="table text-white-50 text-center table-bordered ">
                            <tr>
                                <td>Nombre</td>
                                <td>Creditos</td>
                                <td>Tipo</td>
                                <td>Modificar</td>
                                <td>Eliminar</td>
                            </tr>
                            <?php 
                            $resultasignaturas = findAsignatura($codigoNivel);
                            if ($resultasignaturas->num_rows > 0) {
                            // output data of each row
                            while($rowAsignatura = $resultasignaturas->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $rowAsignatura['NOMBRE']; ?></td>
                                <td><?php echo $rowAsignatura['CREDITOS']; ?></td>
                                <td><?php echo $rowAsignatura['TIPO']; ?></td>
                                <td><a href="asignatura.php?update= <?php echo $rowAsignatura["COD_ASIGNATURA"];?>"><img  src="/system/assets/img/update.png" style="width:25px;height:25px;" alt="" /></a></td>
                                <td><a href="asignatura.php?delete= <?php echo $rowAsignatura["COD_ASIGNATURA"];?>"><img class="img-small" src="./..//img/delete.png" style="width:25px;height:25px;" alt="" /></a></td>
                            </tr>
                            <?php 
                            
                            
                            }
                            }?>
                        </table>
                        </div>
        </div>
        <?php 
        }
        ?>
        </div>
    </section>
</body>

</html>