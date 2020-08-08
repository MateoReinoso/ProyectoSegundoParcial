<?php

    $alert = '';
    //<!– INICIA LA SESION–>
    session_start();
if(!empty($_SESSION['active']))
{
    header('location: system/login/start.php');
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
            $query = mysqli_query($connection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
            $result = mysqli_num_rows($query);
            //<!–VERIFICA QUE LA COLUMNA CON LOS DATOS DE USUARIO Y CLAVE EXISTAN E INICIA SESIÓN CON ESAS CREDENCIALES DE USUARIO–>
            if($result >0)
            {
                $data=mysqli_fetch_array($query);
                $_SESSION['active']=true;
                $_SESSION['idUser']=$data['idusuario'];
                $_SESSION['nombre']=$data['nombre'];
                $_SESSION['user']=$data['usuario'];
                $_SESSION['rol']=$data['rol'];

                header('location: sistema/');
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
</head>

<body class="cover" style="background-image: url(./assets/gallery/7.jpg);">
	<form action="home.html" method="post" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
		<div class="form-group label-floating">
			<label class="control-label" for="UserEmail">E-mail</label>
			<input class="form-control" id="UserEmail" type="email">
			<p class="help-block">Escribe tu E-mail</p>
		</div>
		<div class="form-group label-floating">
			<label class="control-label" for="UserPass">Contraseña</label>
			<input class="form-control" id="UserPass" type="text">
			<p class="help-block">Escribe tu contraseña</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger">
		</div>
		<div class="form-group text-center">
			<a href="recoverpassword.html">Recuperar Contraseña</a>
		</div>
		<div class="form-group text-center">
			<a href="index.html">Unidad Educativa Colegio San Jose de Olmedo</a>
		</div>
	</form>
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