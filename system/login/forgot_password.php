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
		<p class="text-center text-muted text-uppercase">Recupera tu contraseña</p>
		<div class="form-group label-floating">
			<label class="control-label" for="correo">Escribe tu correo institucional</label>
			<input class="form-control" name="correo" id="usuario" type="text">
			<p class="help-block">Escribe tu correo</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="Recuperar Contraseña" class="btn btn-raised btn-danger">
        </div>
        <div class="form-group text-center">
			<a href="start.php">Regresar a Iniciar Sesión</a>
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