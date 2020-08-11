<?php
include "../sql_connection/conexion.php";
if (!empty($_POST)) {
    $alert = '';
    //COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
    if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['fecnac']) || empty($_POST['genero']) || empty($_POST['correop'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        //RECOLECTA LOS DATOS DEL FORMULARIO
        $nombres=explode(" ",$_POST['nombre']);
        $nombre1=$nombres[0];
        $nombre2=$nombres[1];
        $apellidos=explode(" ",$_POST['apellido']);
        $apellido1=$apellidos[0];

        $usuario = strtolower($nombre1[0].$nombre2[0].$apellido1);
        $fechas=explode("-",$_POST['fecnac']);
        $password=md5($fechas[2].$fechas[1].$fechas[0]);
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        $fecnac = $_POST['fecnac'];

        $genero = $_POST['genero'];

        $correo = $usuario.'@uecso.com';

        $correop = $_POST['correop'];

        $rol = $_POST['rol'];

        $representante=$_POST['representante'];

        $query = mysqli_query($connection, "SELECT * FROM persona WHERE CEDULA='$cedula'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            //SI EL USUARIO O EMAIL YA ESTAN REGISTRADOS MUESTRA ERROR
            $alert = '<p class="msg_error">El usuario ya ha sido inscrito</p>';
        } else {
            if($representante=='nulled'){
                $query_insert_per = mysqli_query($connection, "INSERT INTO persona(CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO,CORREO_PERSONAL) 
				values('$cedula','$apellido','$nombre','$direccion','$telefono','$fecnac','$genero','$correo','$correop')");
            }
            else if ($representante!='nulled'){
                $query_insert_per = mysqli_query($connection, "INSERT INTO persona(COD_PERSONA_REPRESENTANTE,CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO,CORREO_PERSONAL) 
				values($representante,'$cedula','$apellido','$nombre','$direccion','$telefono','$fecnac','$genero','$correo','$correop')");
            }


            //OBTENCION DE ID DE PERSONA INGRESADO
            $query_searchid = mysqli_query($connection, "SELECT * FROM persona WHERE CEDULA='$cedula'");
            $result_id = mysqli_num_rows($query_searchid);
            if ($result_id > 0) {
                $id = mysqli_fetch_array($query_searchid);
                $id_per = $id["COD_PERSONA"];
            }
            //INGRESO EN TABLA CALF_PRUE_ASP
            $query_insert_user = mysqli_query($connection, "INSERT INTO usuario(COD_PERSONA, NOMBRE_USUARIO, CLAVE, ESTADO)
                values ('$id_per','$usuario', '$password', 'ACT') ");
            
            $query_searchuser = mysqli_query($connection, "SELECT * FROM usuario WHERE NOMBRE_USUARIO='$usuario'");
            $result_user = mysqli_num_rows($query_searchuser);
            if ($result_user > 0) {
                $user = mysqli_fetch_array($query_searchuser);
                $id_user = $user["COD_USUARIO"];
            }
            $query_insert_user_rol = mysqli_query($connection, "INSERT INTO rol_usuario(COD_ROL,COD_USUARIO,ESTADO)
                values ('$rol','$id_user','ACT') ");

            if ($query_insert_per && $query_insert_user && $query_insert_user_rol) {
                $alert = '<p class="msg_save">Aspirante ingresado correctamente</p>';
                header('Location: gestion_persona.php');
            } else {
                $alert = '<p class="msg_error">Error al ingresar el aspirante</p>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro de Usuarios</title>
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
                <h1 class="text-titles">Usuario<small>  Registro</small></h1>
            </div>
            <!-- TODO LO QUE CREEN DEBE IR SEPARADO DENTRO DE ESTE CONTENEDOR-->
            <form action="" method="post" class="aspireForm">
                <div class="form-group label-floating">
                    <label class="control-label" for="cedula">Cédula</label>
                    <input class="form-control" name="cedula" id="cedula" type="text">
                    <p class="help-block">Escribe la Cédula</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="nombre">Nombres</label>
                    <input class="form-control" name="nombre" id="nombre" type="text">
                    <p class="help-block">Escribe los nombres completos</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="apellido">Apellidos</label>
                    <input class="form-control" name="apellido" id="apellido" type="text">
                    <p class="help-block">Escribe los apellidos completos</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="direccion">Dirección</label>
                    <input class="form-control" name="direccion" id="direccion" type="text">
                    <p class="help-block">Escribe la dirección</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="telefono">Teléfono</label>
                    <input class="form-control" name="telefono" id="telefono" type="number">
                    <p class="help-block">Escribe el telefono</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="fecnac">Fecha de nacimiento</label>
                    <input class="form-control" name="fecnac" id="fecnac" type="date">
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
                    <input class="form-control" name="correop" id="correo" type="email">
                    <p class="help-block">Escribe el correo personal</p>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="roll">Rol de Usuario</label>
                    <?php
                    //OBTIENE LOS NIVELES DESDE LA DB
                    $query_rol = mysqli_query($connection, "SELECT * FROM rol");
                    $result_rol = mysqli_num_rows($query_rol);
                    ?>
                    <select name="rol"  id="rol" style="color:black; align-content:center; width:400px">
                        <?php
                        //LISTA LOS NIVELES DESDE LA DB
                        if ($result_rol > 0) {
                            
                            while ($rol = mysqli_fetch_array($query_rol)) {
                        ?>
                                <option value="<?php echo $rol["COD_ROL"]; ?>"><?php echo $rol["NOMBRE"]?></option>
                        <?php
                            }
                        } else {
                            echo "No hay resultados";
                        }
                        ?>
                    </select>
                </div>
                        

                <div class="form-group label-floating">
                    <label class="control-label" for="representante">Representante *(Solo para estudiantes) </label>
                    <?php
                    //OBTIENE LOS NIVELES DESDE LA DB
                    $query_repre = mysqli_query($connection, "SELECT * FROM persona p 
                    INNER JOIN usuario u ON u.COD_PERSONA=p.COD_PERSONA 
                    INNER JOIN rol_usuario ru ON ru.COD_USUARIO=u.COD_USUARIO
                    WHERE ru.COD_ROL=5");
                    $result_repre = mysqli_num_rows($query_repre);
                    ?>
                    <select name="representante"  id="representante" style="color:black; align-content:center; width:400px" <?php if($_GET['rol']!=5){ echo 'disabled';} ?>>
                        <option value="nulled">No asignar representante</option>
                        <?php
                        //LISTA LOS NIVELES DESDE LA DB
                        if ($result_repre > 0) {
                            
                            while ($repre = mysqli_fetch_array($query_repre)) {
                        ?>
                                <option value="<?php echo $repre["COD_PERSONA"]; ?>"><?php echo $repre["CEDULA"].'-'. $repre["NOMBRE"].' '.$repre["APELLIDO"]?></option>
                        <?php
                            }
                        } else {
                            echo "No hay resultados";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Guardar" class="btn btn-raised btn-danger">
                </div>
            </form>
            <div class="form-group text-center">
                    <p class="alert"><?php echo $alert='' ?></p>
                </div>
        </div>
    </section>
</body>

</html>