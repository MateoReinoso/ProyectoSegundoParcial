<?php
include "../sql_connection/conexion.php";
if (!empty($_POST)) {
    $alert = '';
    //COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
    if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['fecnac']) || empty($_POST['genero']) || empty($_POST['correop'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        //RECOLECTA LOS DATOS DEL FORMULARIO


        //RECOLECTA LOS DATOS DEL FORMULARIO
        $idpersona = $_GET['id'];
        $idrol = $_GET['idr'];
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $fecnac = $_POST['fecnac'];
        $genero = $_POST['genero'];
        $correop = $_POST['correop'];
        $query = mysqli_query($connection, "UPDATE persona
                SET CEDULA='$cedula', APELLIDO='$apellido', NOMBRE='$nombre', DIRECCION='$direccion', TELEFONO='$telefono', FECHA_NACIMIENTO='$fecnac', GENERO='$genero', CORREO_PERSONAL='$correop'
                WHERE COD_PERSONA='$idpersona'");
        if ($query) {
            $alert = '<p class="msg_save">Persona actualizada correctamente</p>';
            header('Location: gestion_aspirante.php');
        } else {
            $alert = '<p class="msg_error">Error al actualizar el usuario</p>';
        }
    }
}
//RECUPERACION DE DATOS DEL USUARIO
if (empty($_GET['id']) && empty($_GET['idr'])) {
    //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
    header('Location: gestion_aspirante.php');
}

$idpersona = $_GET['id'];
$idrol = $_GET['idr'];
$sql = mysqli_query($connection, "SELECT p.CEDULA, p.APELLIDO, (p.NOMBRE) as nombre_per, p.DIRECCION, p.TELEFONO, p.FECHA_NACIMIENTO, p.CORREO_PERSONAL
    from persona p 
    INNER JOIN usuario u on p.COD_PERSONA=u.COD_PERSONA 
    INNER JOIN rol_usuario ru on u.COD_USUARIO=ru.COD_USUARIO 
    WHERE ru.COD_ROL='$idrol' AND ru.ESTADO='ACT' AND u.COD_PERSONA='$idpersona'");

$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: gestion_persona.php');
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $cedula = $data['CEDULA'];
        $apellido = $data['APELLIDO'];
        $nombre = $data['nombre_per'];
        $direccion = $data['DIRECCION'];
        $telefono = $data['TELEFONO'];
        $fecnac = $data['FECHA_NACIMIENTO'];
        $correop = $data['CORREO_PERSONAL'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Actualización de Usuarios</title>
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
                <h1 class="text-titles">Usuario<small> Actualización</small></h1>
            </div>
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <form action="" method="post" class="aspireForm">
                <div class="form-group label-floating">
                    <label class="control-label" for="cedula">Cédula</label>
                    <input class="form-control" name="cedula" id="cedula" type="text" value="<?php echo $cedula ?>">
                    <p class="help-block">Escribe la Cédula</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="nombre">Nombres</label>
                    <input class="form-control" name="nombre" id="nombre" type="text" value="<?php echo $nombre ?>">
                    <p class="help-block">Escribe los nombres completos</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="apellido">Apellidos</label>
                    <input class="form-control" name="apellido" id="apellido" type="text" value="<?php echo $apellido ?>">
                    <p class="help-block">Escribe los apellidos completos</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="direccion">Dirección</label>
                    <input class="form-control" name="direccion" id="direccion" type="text" value="<?php echo $direccion ?>">
                    <p class="help-block">Escribe la dirección</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="telefono">Teléfono</label>
                    <input class="form-control" name="telefono" id="telefono" type="number" value="<?php echo $telefono ?>">
                    <p class="help-block">Escribe el telefono</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="fecnac">Fecha de nacimiento</label>
                    <input class="form-control" name="fecnac" id="fecnac" type="date" value="<?php echo $fecnac ?>">
                    <p class="help-block">Selecciona la fecha de nacimiento</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="genero">Género</label>
                    <input type="radio" name="genero" id="genero" value="MAS">Masculino
                    <input type="radio" name="genero" id="genero" value="FEM">Femenino
                    <p class="help-block">Selecciona el género</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="correop">Correo Personal</label>
                    <input class="form-control" name="correop" id="correo" type="email" value="<?php echo $correop ?>">
                    <p class="help-block">Escribe el correo personal</p>
                </div>

                <div class="form-group text-center">
                    <input type="submit" value="Actualizar" class="btn btn-raised btn-danger">
                </div>
            </form>
            <div class="form-group text-center">
                <p class="alert"><?php echo $alert = '' ?></p>
            </div>
        </div>
    </section>
</body>

</html>