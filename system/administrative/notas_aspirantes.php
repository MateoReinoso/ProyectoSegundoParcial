<?php
include "../sql_connection/conexion.php";
if (!empty($_POST)) {
    $alert = '';
    //COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
    if (empty($_POST['calificacion'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        //RECOLECTA LOS DATOS DEL FORMULARIO
        $idaspirante=$_GET['id'];
        $idnivel=$_GET['idn'];
        $calificacion = $_POST['calificacion'];

        if($calificacion>=7)
        {
            $query = mysqli_query($connection, "UPDATE calificacion_prueba_aspirante
            SET CALIFICACION='$calificacion', ESTADO='APR' 
            WHERE COD_NIVEL_EDUCATIVO='$idnivel' AND COD_ASPIRANTE='$idaspirante'");
            if($query)
            {
                $alert = '<p class="msg_save">Usuario actualizdo correctamente</p>';
                header('Location: gestion_aspirante.php');
            }else{
                $alert = '<p class="msg_error">Error al actualizar el usuario</p>';
                header('Location: gestion_aspirante.php');
            }
        }else{
            $query = mysqli_query($connection, "UPDATE calificacion_prueba_aspirante
            SET CALIFICACION='$calificacion', ESTADO='REP' 
            WHERE COD_NIVEL_EDUCATIVO='$idnivel' AND COD_ASPIRANTE='$idaspirante'");
            if($query)
            {
                $alert = '<p class="msg_save">Usuario actualizdo correctamente</p>';
                header('Location: gestion_aspirante.php');
            }else{
                $alert = '<p class="msg_error">Error al actualizar el usuario</p>';
                header('Location: gestion_aspirante.php');
            }
        }
        
    }
}
    //RECUPERACION DE DATOS DEL USUARIO
    if(empty($_GET['id']) && empty($_GET['idn']))
    {
        //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
        header('Location: gestion_aspirante.php');
    }

    $idaspirante=$_GET['id'];
    $idnivel=$_GET['idn'];   
    $sql= mysqli_query($connection,"SELECT a.cedula, a.APELLIDO, a.NOMBRE, cpa.CALIFICACION, cpa.ESTADO from aspirante a 
    INNER JOIN calificacion_prueba_aspirante cpa on a.COD_ASPIRANTE=cpa.COD_ASPIRANTE
    INNER JOIN nivel_educativo ne on ne.COD_NIVEL_EDUCATIVO=cpa.COD_NIVEL_EDUCATIVO 
    WHERE ne.COD_NIVEL_EDUCATIVO='$idnivel' AND a.COD_ASPIRANTE='$idaspirante'");

    $result_sql = mysqli_num_rows($sql);
    if($result_sql==0)
    {
        header('Location: lista_usuarios.php');
    }else{
        $option = '';
        while($data = mysqli_fetch_array($sql)){
            $cedula = $data['cedula'];
            $apellido = $data['APELLIDO'];
            $nombre = $data['NOMBRE'];
            $calificacion = $data['CALIFICACION'];
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Aspirantes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php include "menu/sidebar.php" ?>
    <section class="full-box dashboard-contentPage">
        <?php include "../includes/navbar.php" ?>
        <!-- A PARTIR DE AQUI CREAR CONTENIDO DE LA PAGINA-->
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="text-titles">Aspirantes<small>  Ingreso de nota</small></h1>
            </div>
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <form action="" method="post" class="aspireForm">
                <div class="form-group label-floating">
                    <label class="control-label" for="cedula" >Cédula</label>
                    <input class="form-control" name="cedula" id="cedula" type="text" value="<?php echo $cedula; ?>" disabled>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="nombre">Nombres</label>
                    <input class="form-control" name="nombre" id="nombre" type="text" value="<?php echo $nombre; ?>" disabled>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="apellido">Apellidos</label>
                    <input class="form-control" name="apellido" id="apellido" type="text" value="<?php echo $apellido; ?>" disabled>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="calificacion">Calificación</label>
                    <input class="form-control" name="calificacion" id="calificacion" type="number" value="<?php echo $calificacion; ?>">
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Ingresar calificacion" class="btn btn-raised btn-danger">
                </div>
            </form>
        </div>
    </section>
</body>

</html>