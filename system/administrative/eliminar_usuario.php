<?php
include "../sql_connection/conexion.php";
if (!empty($_POST)) {
    $alert = '';

        //RECOLECTA LOS DATOS DEL FORMULARIO
        $idusuario = $_GET['id'];
        $idrol = $_GET['idr'];
        $query = mysqli_query($connection, "UPDATE usuario
                SET ESTADO='INA'
                WHERE COD_USUARIO='$idusuario'");
        $query2 = mysqli_query($connection, "UPDATE rol_usuario
        SET ESTADO='INA'
        WHERE COD_USUARIO='$idusuario' AND COD_ROL='$idrol'");
        if ($query && $query2) {
            $alert = '<p class="msg_save">Persona actualizada correctamente</p>';
            header('Location: gestion_usuario.php');
        } else {
            $alert = '<p class="msg_error">Error al actualizar el usuario</p>';
        }
    
}
//RECUPERACION DE DATOS DEL USUARIO
if (empty($_GET['id']) && empty($_GET['idr'])) {
    //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
    header('Location: gestion_usuario.php');
}

$idusuario = $_GET['id'];
$idrol = $_GET['idr'];
$sql = mysqli_query($connection, "SELECT p.CEDULA, p.APELLIDO, (p.NOMBRE) as nombre_per, p.DIRECCION, p.TELEFONO, p.FECHA_NACIMIENTO, p.CORREO_PERSONAL
    from persona p 
    INNER JOIN usuario u on p.COD_PERSONA=u.COD_PERSONA 
    INNER JOIN rol_usuario ru on u.COD_USUARIO=ru.COD_USUARIO 
    WHERE ru.COD_ROL='$idrol' AND ru.ESTADO='ACT' AND u.COD_USUARIO='$idusuario'");

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
                <h1 class="text-titles">Usuario<small> Eliminacion</small></h1>
                <td><a href="registro_aspirantes.php" class="btn btn-primary btn-raised btn-m"><i class="zmdi zmdi-receipt"></i> Eliminar usuario</a></td>
                <h2>¿Está seguro de que quiere borrar el siguiente usuario?</h2>
                <p>Cédula:<span><?php echo $cedula; ?></span></p>
                <p>Nombre:<span><?php echo $nombre; ?></span></p>
                <p>Apellidos:<span><?php echo $apellido; ?></span></p>

                <form method="post" action="">
                    <a href="gestion_persona.php" class="btn btn-success btn-raised btn-m">Cancelar</a>
                    <input type="submit" value="Aceptar" class="btn btn-danger btn-raised btn-m" style="width:150px">
                </form>
            </div>
        </div>
    </section>
</body>

</html>