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
	<script src="js/install.js"></script>
	<script src="js/DB/sesion.js"></script>
  	<script src="js/login.js"></script>
</head>

<body>
	<img class="logo" src="images/logo.png">
	<center>
		<form action="/install" method="POST" name="installform" id="installform">
		<h1>Instalación Intersoft</h1>
		<p>Registra la empresa en donde estas realizando la instalación, estos datos estarán en diferentes campos de los formularios e impresiones</p>
			{{ csrf_field() }}
			<h2>Datos De la empresa</h2><hr>
			<div id="install_1">
				<img src="/assets/531290.svg" alt="" style="float:left;width:180px;padding:40px;">
				<p id="empresaConfig"></p>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="razon_social" type="text" class="form-control has-success" onkeyup="config.UperCase('razon_social');" name="razon_social" placeholder="razon_social" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
					<input id="nit_empresa" type="text" class="form-control" name="nit_empresa" onkeyup="config.UperCase('nit_empresa');" placeholder="nit_empresa" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="nombre" type="text" class="form-control" name="nombre" onkeyup="config.UperCase('nombre');" placeholder="nombre Representante" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
					<input id="actividad" type="text" class="form-control" onkeyup="config.UperCase('actividad');" name="actividad" placeholder="actividad" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
					<input id="dian_nit" type="text" class="form-control" onkeyup="install.mostrar();" name="dian_nit" placeholder="dian_nit" >
				</div>
			</div>
			<h2>Datos de Contacto</h2><hr>
			<div style="display:none" id="install_2">	
				<img src="/assets/167747.svg" alt="" style="float:right ;width:250px;padding:40px;">		
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="telefono" type="text" class="form-control" onkeyup="config.UperCase('telefono');" name="telefono" placeholder="telefono" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="telefono1" type="text" class="form-control" onkeyup="config.UperCase('telefono1');" name="telefono1" placeholder="telefono1" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="telefono2" type="text" class="form-control" onkeyup="config.UperCase('telefono2');" name="telefono2" placeholder="telefono2" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="direccion" type="text" class="form-control" onkeyup="config.UperCase('direccion');" name="direccion" placeholder="direccion" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<select name="departamento" id="departamento" class="form-control">
						<option value="">SELECCIONE EL DEPARTAMENTO</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<select name="ciudad" id="ciudad" class="form-control">
						<option value="">SELECCIONE EL CIUDAD</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<select name="id_regimen" id="id_regimen" class="form-control">
						<option value="">SELECCIONE EL REGIMEN</option>
					</select>
				</div>
				<div class="input-"><br><br>
					<button id="boton" onclick="install.botonInstalar();" class="btn btn-success entrar">Instalar</button>
				</div>
			</div>
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
	install.getciudades();
	install.getdepartamento();
	install.getregimenes();
});
</script>