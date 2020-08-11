<?php
include "../sql_connection/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Aspirante</title>
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
                <h1 class="text-titles">Aspirantes<small> Gestión</small></h1>
                <td><a href="registro_aspirantes.php" class="btn btn-primary btn-raised btn-m"><i class="zmdi zmdi-receipt"></i>  Registrar aspirante</a></td>
            </div>
            <form action="" method="post">
                <?php
                //OBTIENE LOS roles DESDE LA DB
                $query_ne = mysqli_query($connection, "SELECT * FROM nivel_educativo");
                $result_ne = mysqli_num_rows($query_ne);
                ?>
                <h1 class="text-titles"><small>Selecciona el nivel educativo</small></h1>
                <select name="nivel_edu" id="nivel_edu">
                    <?php
                    //LISTA LOS roles DESDE LA DB
                    if ($result_ne > 0) {

                        while ($ne = mysqli_fetch_array($query_ne)) {
                            if($ne["NIVEL"] =='PRI'){
                                $nivel='Primaria';
                            }else if($ne["NIVEL"] =='SEC'){
                                $nivel='Secundaria';
                            }else if($ne["NIVEL"] =='BAC'){
                                $nivel='Bachillerato';
                            }
                    ?>
                            <option value="<?php echo $ne["COD_NIVEL_EDUCATIVO"]; ?>"><?php echo $ne["NOMBRE"].'-'.$nivel?></option>
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
                        $codnivel_edu = $_POST['nivel_edu'];
        ?>
                 <table class="table table-hover text-center">
            <tr>
                <th class="text-center">Codigo</th>
                <th class="text-center">Cedula</th>
                <th class="text-center">Apellidos</th>
                <th class="text-center">Nombres</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Fecha de Nacimiento</th>
                <th class="text-center">Género</th>
                <th class="text-center">Correo Personal</th>
                <th class="text-center">Calificación</th>
                <th class="text-center">Estado</th>
            </tr>
            <?php
                //QUERY PARA LISTAR MODULOS
                $query = mysqli_query($connection, "SELECT a.COD_ASPIRANTE, a.CEDULA, a.APELLIDO, (a.NOMBRE) as nombre_asp, 
                a.DIRECCION, a.TELEFONO, a.FECHA_NACIMIENTO, a.GENERO, a.CORREO_PERSONAL, cpa.CALIFICACION, cpa.ESTADO 
                from aspirante a 
                INNER JOIN calificacion_prueba_aspirante cpa on a.COD_ASPIRANTE=cpa.COD_ASPIRANTE
                INNER JOIN nivel_educativo ne on ne.COD_NIVEL_EDUCATIVO=cpa.COD_NIVEL_EDUCATIVO 
                WHERE ne.COD_NIVEL_EDUCATIVO='$codnivel_edu'");

                $result=mysqli_num_rows($query);

                if($result>0)
                {
                    //CREA FILAS Y LISTA CON LOS DATOS QUE SACA CON EL QUERY
                    while($data = mysqli_fetch_array($query)){
                        //$data es un array que tiene datos del query
            ?>
                        <tr>
                            <td><?php echo $data["COD_ASPIRANTE"] ?></td>
                            <td><?php echo $data["CEDULA"] ?></td>
                            <td><?php echo $data["APELLIDO"] ?></td>
                            <td><?php echo $data["nombre_asp"] ?></td>
                            <td><?php echo $data["DIRECCION"] ?></td>
                            <td><?php echo $data["TELEFONO"] ?></td>
                            <td><?php echo $data["FECHA_NACIMIENTO"] ?></td>
                            <td><?php if($data["GENERO"]=='MAS'){echo 'Masculino';}else if($data["GENERO"]=='FEM'){echo 'Femenino';} ?></td>
                            <td><?php echo $data["CORREO_PERSONAL"] ?></td>
                            <td><?php if($data["CALIFICACION"]!= NULL) {echo $data["CALIFICACION"];} else{ echo "No asignado";} ?></td>
                            <td><?php if($data["ESTADO"]=='APR') {echo 'Aprobado';} else if($data["ESTADO"]=='REP'){ echo "Reprobado";} else if($data["ESTADO"]==null){echo "Pendiente";} ?></td>
                            <td><a href="actualizar_aspirante.php?id=<?php echo $data["COD_ASPIRANTE"]."&idn=".$codnivel_edu ?>" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i>Editar</a></td>
                            <td><a href="notas_aspirantes.php?id=<?php echo $data["COD_ASPIRANTE"]."&idn=".$codnivel_edu ?>" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i>Ingresar Nota</a></td>
                            <td><a href="editar_funcionalidad.php?id=<?php echo $data["COD_ASPIRANTE"]."&idn=".$codnivel_edu ?>" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i>Eliminar</a></td>
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