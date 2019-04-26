<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
	<html lang="en">
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
	
	<center>
		<form style="width: 300px;" action="registrarse" method="POST">
			<img class="logo" src="http://famc.net.co/intersoft/pages/images/logo.png">

			<p id="empresaConfig">Intersoft</p>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="ncedula" type="text" class="form-control has-success" name="ncedula" placeholder="Cédula" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="nombre" type="text" class="form-control has-success" name="nombre" placeholder="Nombres" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="apellido" type="text" class="form-control has-success" name="apellido" placeholder="Apellidos" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="cargo" type="text" class="form-control has-success" name="cargo" placeholder="Cargo" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="telefono" type="text" class="form-control has-success" name="telefono" placeholder="Teléfono" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="password" type="text" class="form-control has-success" name="password" placeholder="password" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="correo" type="text" class="form-control has-success" name="correo" placeholder="Correo" >
			</div>
			<input id="estado" type="hidden" class="form-control has-success" name="estado" placeholder="Estado" value="1">
			<input id="token" type="hidden" class="form-control has-success" name="token" placeholder="token" value="12" >
			<input id="arl" type="hidden" class="form-control has-success" name="arl" placeholder="ARL" value="1">
			<input id="eps" type="hidden" class="form-control has-success" name="eps" placeholder="EPS" value="1">
			<input id="cesantias" type="hidden" class="form-control has-success" name="cesantias" placeholder="Cesantias" value="1">
			<input id="pension" type="hidden" class="form-control has-success" name="pension" placeholder="Pensión" value="1">
			<input id="caja_compensacion" type="hidden" class="form-control has-success" name="caja_compensacion" placeholder="Caja de Compensación" value="1">
			<input id="id_contrato" type="hidden" class="form-control has-success" name="cedula" placeholder="id_contrato" value="1">
			<input id="referencia_personal" type="hidden" class="form-control has-success" name="cedula" placeholder="referencia_personal" value="1">
			<input id="telefono_referencia" type="hidden" class="form-control has-success" name="cedula" placeholder="telefono_referencia" value="1">


			<input type="submit" id="boton"  class="olvido2" value="Registrar">
			<div class="olvido" onclick="config.Redirect('olvido');"><a href="#" style="color:white"> Olvido de Contraseña</a></div>
			<div class="olvido1" ><a href="/" style="color:white">Ingresa ahora!</a></div>
			<!--ENTER Resultado -->
			<div id="resultado"></div>
			<!--FIN Resultado -->
			<br><p style="text-align: right;">Creado por Wakusoft</p>
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