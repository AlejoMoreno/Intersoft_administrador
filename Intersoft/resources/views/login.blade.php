<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
	<html lang="en">
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/intersoft.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script  type="text/javascript" src="js/index.js"></script>
	<script src="js/config.js"></script>
	<script src="js/DB/sesion.js"></script>
  	<script src="js/login.js"></script>
</head>

<body>
	<img class="logo" src="images/logo.png">
	<center>
		<form>
			<p id="empresaConfig"></p>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="cedula" type="text" class="form-control has-success" name="cedula" placeholder="Cédula" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="password" type="password" class="form-control" name="password" placeholder="Password" >
			</div>
			<div class="input-group"><br>
				<button type="button" id="boton" onclick="login.loguearse();" class="btn btn-success entrar">Entrar</button>
			</div>
			<div class="olvido" onclick="config.Redirect('olvidoPassword.html');"><a href="#"> Olvido de Contraseña</a></div>
			<!--ENTER Resultado -->
			<div id="resultado">...</div>
			<!--FIN Resultado -->
		</form>
	</center>
	<!--ENTER cargando gif -->
	<center>
		<div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;display: none;z-index: 100;"></div>
	</center>
	<!-- FIN cargando gif -->
	</body>
</html>
<script>
$(document).ready(function(){
	config.GetAllInformation();
	$('#cedula').focus();
    //login.FocusForm(input,next,fin); asi funciona el login focus
    login.FocusForm('cedula','password','no');
    login.FocusForm('password','boton','no');
    login.FocusForm('boton','boton','si');
});
</script>