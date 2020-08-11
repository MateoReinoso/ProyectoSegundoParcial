<?php
    include "../sql_connection/conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		//COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
		if(empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['fecnac']) || empty($_POST['genero']) || empty($_POST['correo']) || empty($_POST['nivel']))
		{
			$alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
			//RECOLECTA LOS DATOS DEL FORMULARIO
            $cedula=$_POST['cedula'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $fecnac = $_POST['fecnac'];
            $genero = $_POST['genero'];
            $correo = $_POST['correo'];
            $nivel = $_POST['nivel'];

			$query = mysqli_query($connection,"SELECT * FROM aspirante WHERE cedula='$cedula'");
			$result = mysqli_fetch_array($query);

			if($result > 0)
			{
				//SI EL USUARIO O EMAIL YA ESTAN REGISTRADOS MUESTRA ERROR
				$alert='<p class="msg_error">El usuario ya ha sido inscrito</p>';
			}else{
				$query_insert_asp = mysqli_query($connection, "INSERT INTO aspirante(CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO_PERSONAL) 
				values('$cedula','$apellido','$nombre','$direccion','$telefono','$fecnac','$genero','$correo')");
                
                //OBTENCION DE ID DE ASPIRANTE INGRESADO
                $query_searchid = mysqli_query($connection,"SELECT * FROM aspirante WHERE cedula='$cedula'");
                $result_id=mysqli_num_rows($query_searchid);
                if($result_id>0)
                {
                    $id= mysqli_fetch_array($query_searchid);
                    $id_asp=$id["COD_ASPIRANTE"];
                }
                //INGRESO EN TABLA CALF_PRUE_ASP
                $query_insert_niv = mysqli_query($connection, "INSERT INTO calificacion_prueba_aspirante(COD_NIVEL_EDUCATIVO, COD_ASPIRANTE)
                values ('$nivel','$id_asp') ");

				if($query_insert_asp && $query_insert_niv)
				{
					$alert = '<p class="msg_save">Aspirante ingresado correctamente</p>';
				}else{
					$alert = '<p class="msg_error">Error al ingresar el aspirante</p>';
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Inscripción de Aspirantes</title>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>

<body class="cover" style="background-image: url(../assets/img/background.jpg);">
    <img src="../assets/img/logo.png" alt="Logo" class="hidden-xs hidden-sm" style="align-content:center">
    <div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>
	<form action="" method="post" class="aspireForm">
    <img src="../assets/img/logo2.png" alt="Logo" class="hidden-xs hidden-sm">		
    <p class="text-center text-muted text-uppercase">Resgistra tus datos para completar tu inscripcion</p>
		<div class="form-group label-floating">
			<label class="control-label" for="cedula">Cédula</label>
			<input class="form-control" name="cedula" id="cedula" type="text">
			<p class="help-block">Escribe tu Cédula</p>
		</div>
		<div class="form-group label-floating">
			<label class="control-label" for="nombre">Nombres</label>
			<input class="form-control" name="nombre" id="nombre" type="text">
			<p class="help-block">Escribe tus nombres completos</p>
        </div>
        <div class="form-group label-floating">
			<label class="control-label" for="apellido">Apellidos</label>
			<input class="form-control" name="apellido" id="apellido" type="text">
			<p class="help-block">Escribe tus apellidos completos</p>
        </div>
        <div class="form-group label-floating">
			<label class="control-label" for="direccion">Dirección</label>
			<input class="form-control" name="direccion" id="direccion" type="text">
			<p class="help-block">Escribe tu dirección</p>
        </div>
        <div class="form-group label-floating">
			<label class="control-label" for="telefono">Teléfono</label>
			<input class="form-control" name="telefono" id="telefono" type="number">
			<p class="help-block">Escribe tu telefono</p>
        </div>
        <div class="form-group label-floating">
			<label class="control-label" for="fecnac">Fecha de nacimiento</label>
			<input class="form-control" name="fecnac" id="fecnac" type="date">
			<p class="help-block">Selecciona tu fecha de nacimiento</p>
        </div>
        <div class="form-group label-floating">
			<label class="control-label" for="genero">Género</label>
            <input type="radio" name="genero" id="genero" value="MAS">Masculino
            <input type="radio" name="genero" id="genero" value="FEM">Femenino
			<p class="help-block">Selecciona tu género</p>
        </div>
        <div class="form-group label-floating">
        <label class="control-label" for="correo">Correo Personal</label>
			<input class="form-control" name="correo" id="correo" type="email">
			<p class="help-block">Escribe tu correo personal</p>
        </div>
        <div class="form-group label-floating">
			<label class="control-label" for="nivel">Nivel Educativo a Inscribirse</label>
            <?php
				//OBTIENE LOS NIVELES DESDE LA DB
					$query_nivel=mysqli_query($connection, "SELECT * FROM nivel_educativo");
					$result_nivel=mysqli_num_rows($query_nivel);
				?>
            <select name="nivel" name="id" id="nivel" style="color:black; align-content:center; width:400px">
                    <?php
						//LISTA LOS NIVELES DESDE LA DB
						if($result_nivel>0){

							while($nivel= mysqli_fetch_array($query_nivel)){
					?>
								<option value="<?php echo $nivel["COD_NIVEL_EDUCATIVO"]; ?>"><?php echo $nivel["NOMBRE"]."-".$nivel["NIVEL"] ?></option>
					<?php
							}
                        }
                        else{
                            echo "No hay resultados";
                        }
					?>
			</select>
        </div>
		<div class="form-group text-center">
			<input type="submit" value="Terminar Inscripción" class="btn btn-raised btn-danger">
		</div>
		<div class="form-group text-center">
			<a href="../../index.php">Unidad Educativa Colegio San Jose de Olmedo</a>
        </div>
    </form>
   
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
</body>

</html>