<?php
//BORRAR USUARIO
include "../sql_connection/conexion.php";
if (!empty($_POST)) {
    $idAspirante = $_POST['idaspirante'];
    $query_delete = mysqli_query($connection, "DELETE FROM aspirante WHERE COD_ASPIRANTE = $idAspirante");
    $query_delete_CPA = mysqli_query($connection, "DELETE FROM calificacion_prueba_aspirante WHERE COD_ASPIRANTE = $idAspirante");

    if ($query_delete && $query_delete_CPA) {
        header("location: gestion_aspirante.php");
    } else {
        echo "Error al eliminar";
    }
}

//RECUPERA DATOS DEL USUARIO A ELIMINAR
//RECUPERACION DE DATOS DEL USUARIO
if (empty($_GET['id']) && empty($_GET['idn'])) {
    //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
    header('Location: gestion_aspirante.php');
}

$idaspirante = $_GET['id'];
$idnivel = $_GET['idn'];
$sql = mysqli_query($connection, "SELECT a.COD_ASPIRANTE, a.CEDULA, a.APELLIDO, (a.NOMBRE) as nombre_asp, 
    a.DIRECCION, a.TELEFONO, a.FECHA_NACIMIENTO, a.GENERO, a.CORREO_PERSONAL, cpa.CALIFICACION, cpa.ESTADO 
     from aspirante a 
    INNER JOIN calificacion_prueba_aspirante cpa on a.COD_ASPIRANTE=cpa.COD_ASPIRANTE
    INNER JOIN nivel_educativo ne on ne.COD_NIVEL_EDUCATIVO=cpa.COD_NIVEL_EDUCATIVO 
    WHERE ne.COD_NIVEL_EDUCATIVO='$idnivel' AND a.COD_ASPIRANTE='$idaspirante'");

$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header('Location: gestion_aspirante.php');
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {

        $cedula = $data['CEDULA'];
        $apellido = $data['APELLIDO'];
        $nombre = $data['nombre_asp'];
    }
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
        <div class="container-fluid">
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <div class="page-header">
                <h1 class="text-titles">Aspirantes<small> Eliminacion</small></h1>
                <td><a href="registro_aspirantes.php" class="btn btn-primary btn-raised btn-m"><i class="zmdi zmdi-receipt"></i> Eliminar aspirante</a></td>
                <h2>¿Está seguro de que quiere borrar el siguiente aspirante?</h2>
                <p>Cédula:<span><?php echo $cedula; ?></span></p>
                <p>Nombre:<span><?php echo $nombre; ?></span></p>
                <p>Apellidos:<span><?php echo $apellido; ?></span></p>

                <form method="post" action="">
                    <input type="hidden" name="idaspirante" value="<?php echo $idaspirante ?>">
                    <a href="gestion_aspirante.php" class="btn btn-success btn-raised btn-m">Cancelar</a>
                    <input type="submit" value="Aceptar" class="btn btn-danger btn-raised btn-m" style="width:150px">
                </form>
            </div>
        </div>
    </section>
</body>

</html>