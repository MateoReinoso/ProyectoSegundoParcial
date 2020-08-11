<?php
include "../sql_connection/conexion.php";
if (!empty($_POST)) {
    $alert = '';
    //COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
    if (empty($_POST['clave'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        //RECOLECTA LOS DATOS DEL FORMULARIO
        $idusuario = $_GET['id'];
        $idrol = $_GET['idr'];
        $password = md5($_POST['clave']);

        $query = mysqli_query($connection, "UPDATE usuario
            SET CLAVE='$password'
            WHERE COD_USUARIO='$idusuario'");
        if ($query) {
            $alert = '<p class="msg_save">Contraseña cambiada correctamente</p>';
            header('Location: gestion_aspirante.php');
        } else {
            $alert = '<p class="msg_error">Error al actualizar el usuario</p>';
        }
    }
}
//RECUPERACION DE DATOS DEL USUARIO
if (empty($_GET['id']) && empty($_GET['idr'])) {
    //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
    header('Location: gestion_persona.php');
}

$idusuario = $_GET['id'];
$idrol = $_GET['idr'];
$sql = mysqli_query($connection, "SELECT p.COD_PERSONA, p.CEDULA, u.NOMBRE_USUARIO, p.APELLIDO, (p.NOMBRE) as nombre_per
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
        $nombreusuario = $data['NOMBRE_USUARIO'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Cambio de Contraseña</title>
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
                <h1 class="text-titles">Usuarios<small> Cambio de contraseña</small></h1>
            </div>
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <form action="" method="post" class="aspireForm">
                <div class="form-group label-floating">
                    <label class="control-label" for="usuario">Nombre de Usuario</label>
                    <input class="form-control" name="usuario" id="usuario" type="text" value="<?php echo $nombreusuario; ?>" disabled>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="cedula">Cédula</label>
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
                    <label class="control-label" for="clave">Password</label>
                    <input class="form-control" name="clave" id="clave" type="password" value="">
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Cambiar contraseña" class="btn btn-raised btn-danger">
                </div>
            </form>
        </div>
    </section>
</body>

</html>