<?php
include "../sql_connection/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuarios</title>
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
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <div class="page-header">
                <h1 class="text-titles">Usuarios<small> Gestión</small></h1>
                <td><a href="registro_persona.php" class="btn btn-primary btn-raised btn-m"><i class="zmdi zmdi-receipt"></i>  Registrar nuevo usuario</a></td>
            </div>
            <form action="" method="post">
                <?php
                //OBTIENE LOS roles DESDE LA DB
                $query_rol = mysqli_query($connection, "SELECT * FROM rol");
                $result_rol = mysqli_num_rows($query_rol);
                ?>
                <h1 class="text-titles"><small>Selecciona el tipo de usuario</small></h1>
                <select name="rol" id="rol">
                    <?php
                    //LISTA LOS roles DESDE LA DB
                    if ($result_rol > 0) {

                        while ($rol = mysqli_fetch_array($query_rol)) {
                    ?>
                            <option value="<?php echo $rol["COD_ROL"]; ?>"><?php echo $rol["NOMBRE"];?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Aceptar" class="btn_save">
            </form>
            <?php
            	if(!empty($_POST))
                {
                    $alert='';
                        //RECOLECTA LOS DATOS DEL FORMULARIO
                        $codrol = $_POST['rol'];
        ?>
                 <table class="table table-hover text-center">
            <tr>
                <th class="text-center">Usuario</th>
                <th class="text-center">Cedula</th>
                <th class="text-center">Apellidos</th>
                <th class="text-center">Nombres</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Fecha de Nacimiento</th>
                <th class="text-center">Género</th>
                <th class="text-center">Correo Institucional</th>
                <th class="text-center">Correo Personal</th>
                <th class="text-center">Ultima fecha de acceso</th>
            </tr>
            <?php
                //QUERY PARA LISTAR MODULOS
                $query = mysqli_query($connection, "SELECT p.COD_PERSONA, p.CEDULA, u.NOMBRE_USUARIO, p.APELLIDO, (p.NOMBRE) as nombre_per, p.DIRECCION, p.TELEFONO, p.FECHA_NACIMIENTO, p.GENERO, p.CORREO, p.CORREO_PERSONAL, u.ULT_FECHA_INGRESO 
                from persona p 
                INNER JOIN usuario u on p.COD_PERSONA=u.COD_PERSONA 
                INNER JOIN rol_usuario ru on u.COD_USUARIO=ru.COD_USUARIO 
                WHERE ru.COD_ROL='$codrol' AND ru.ESTADO='ACT'");

                $result=mysqli_num_rows($query);

                if($result>0)
                {
                    //CREA FILAS Y LISTA CON LOS DATOS QUE SACA CON EL QUERY
                    while($data = mysqli_fetch_array($query)){
                        //$data es un array que tiene datos del query
            ?>
                        <tr>
                        <td><?php echo $data["NOMBRE_USUARIO"] ?></td>
                            <td><?php echo $data["CEDULA"] ?></td>
                            <td><?php echo $data["APELLIDO"] ?></td>
                            <td><?php echo $data["nombre_per"] ?></td>
                            <td><?php echo $data["DIRECCION"] ?></td>
                            <td><?php echo $data["TELEFONO"] ?></td>
                            <td><?php echo $data["FECHA_NACIMIENTO"] ?></td>
                            <td><?php if($data["GENERO"]=='MAS'){echo 'Masculino';}else if($data["GENERO"]=='FEM'){echo 'Femenino';} ?></td>
                            <td><?php if($data["CORREO"]==null){echo 'No disponible';}else{echo $data["CORREO"];} ?></td>
                            <td><?php echo $data["CORREO_PERSONAL"] ?></td>
                            <td><?php echo $data["ULT_FECHA_INGRESO"] ?></td>
                            <td><a href="actualizar_persona.php?id=<?php echo $data["COD_PERSONA"]."&idr=".$codrol ?>" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i>Editar</a></td>
                            <td><a href="cambiar_contraseña.php?id=<?php echo $data["COD_PERSONA"]."&idr=".$codrol ?>" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i>Cambiar Contraseña</a></td>
                            <td><a href="eliminar_persona.php?id=<?php echo $data["COD_PERSONA"]."&idr=".$codrol ?>" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i>Eliminar</a></td>
                        </tr>
            <?php
                      }
                }
            ?>

        </table>
        <?php           
                }
        ?>

        </div>
    </section>
</body>

</html>