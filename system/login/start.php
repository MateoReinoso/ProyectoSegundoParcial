<?php

    $alert = '';
    //<!– INICIA LA SESION–>
    session_start();
if(!empty($_SESSION['active']))
{
	if($_SESSION['rol']== 'Administrador'){
		header('location: ../admin/');
	}
	else if($_SESSION['rol']== 'Administrativo'){
		header('location: ../administrative/');
	}
	else if($_SESSION['rol']== 'Docente'){
		header('location: ../teacher/');
	}
	else if($_SESSION['rol']== 'Estudiante'){
		header('location: ../student/');
	}
	else if($_SESSION['rol']== 'Representante'){
		header('location: ../representative/');
	}
}else{

    if(!empty($_POST))
    {
        if(empty($_POST['usuario']) || empty($_POST['clave']))
        {
            $alert = 'Ingrese su usuario y contraseña';
        }else{

            require_once '../sql_connection/conexion.php';

            $user = mysqli_real_escape_string($connection, $_POST['usuario']);
            //<!–ENCRIPTACION DE CONTRASEÑA–>
            $pass = md5(mysqli_real_escape_string($connection,$_POST['clave']));
			//<!–QUERY QUE OBTIENE LOS DATOS DE USUARIO–>
			$last_session = date('Y-m-d H:i:s');
            $query = mysqli_query($connection,"SELECT * FROM usuario u 
			INNER JOIN rol_usuario ru on u.COD_USUARIO=ru.COD_USUARIO
			INNER JOIN rol r on r.COD_ROL=ru.COD_ROL
			where u.ESTADO='ACT' AND ru.ESTADO='ACT' AND u.NOMBRE_USUARIO = '$user' AND u.CLAVE = '$pass'");
            $result = mysqli_num_rows($query);
            //<!–VERIFICA QUE LA COLUMNA CON LOS DATOS DE USUARIO Y CLAVE EXISTAN E INICIA SESIÓN CON ESAS CREDENCIALES DE USUARIO–>
            if($result > 0)
            {
                $data=mysqli_fetch_array($query);
                $_SESSION['active']=true;
                $_SESSION['user']=$data['NOMBRE_USUARIO'];
				$_SESSION['rol']=$data['NOMBRE'];
				$querydate = mysqli_query($connection,"INSERT INTO usuario(ULT_FECHA_INGRESO) values ('$last_session') WHERE usuario = '$user'");

				if($_SESSION['rol']== 'Administrador'){
					header('location: ../admin/');
				}
				else if($_SESSION['rol']== 'Administrativo'){
					header('location: ../administrative/');
				}
				else if($_SESSION['rol']== 'Docente'){
					header('location: ../teacher/');
				}
				else if($_SESSION['rol']== 'Estudiante'){
					header('location: ../student/');
				}
				else if($_SESSION['rol']== 'Representante'){
					header('location: ../representative/');
				}
            }else{
				$alert = 'El usuario o contraseña son incorrectas';
                //<!–DESTRUYE LA SESION POR CONTRASEÑA O USUARIO INCORRECTO–>
                session_destroy();
			}
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Inicio de Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>

<body class="cover" style="background-image: url(../assets/img/background.jpg);">
<img src="../assets/img/logo.png" alt="Logo" class="hidden-xs hidden-sm">		
	<form action="" method="post" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
		<div class="form-group label-floating">
			<label class="control-label" for="usuario">Usuario</label>
			<input class="form-control" name="usuario" id="usuario" type="text">
			<p class="help-block">Escribe tu Usuario</p>
		</div>
		<div class="form-group label-floating">
			<label class="control-label" for="clave">Contraseña</label>
			<input class="form-control" name="clave" id="clave" type="password">
			<p class="help-block">Escribe tu contraseña</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger">
		</div>
		<div class="form-group text-center">
			<a href="forgot_password.php">Recuperar Contraseña</a>
		</div>
		<div class="form-group text-center">
			<a href="../../index.php">Unidad Educativa Colegio San Jose de Olmedo</a>
		</div>
	</form>
	<div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>

</html>