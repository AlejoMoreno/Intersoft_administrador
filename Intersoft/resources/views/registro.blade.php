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
	<?php
	use App\Ciudades;
	use App\Regimenes;
	?>
	<center>
		<form class="row" action="/empresas/register" method="POST">
			<img class="logo col-md-12" src="/assets/1.png">
			<p class="col-md-12"></p>
			<div class="col-md-6">
				<div class="panel panel-success " id="empresa">
					<div class="panel-heading">Información de la empresa</div>
					<div class="panel-body">
						<input type="text" class="form-control" name="razon_social" placeholder="Escribir Razón Social">
						<input type="text" class="form-control" name="direccion" placeholder="Escribir Dirección Principal">
						<input type="text" class="form-control" name="actividad" placeholder="Escribir Código Actividad Económica">
						<input type="text" class="form-control" name="correo" placeholder="Escribir correo">
						<input type="text" class="form-control" name="nit_empresa" placeholder="Escribir Nit Empresa">
						<input type="text" class="form-control" name="nombre" placeholder="Escribir Nombre Público">
						<input type="text" class="form-control" name="telefono" placeholder="Escribir Teléfono">
						<input type="text" class="form-control" name="telefono1" placeholder="Escribir Fax">
						<input type="text" class="form-control" name="telefono2" placeholder="Escribir Celular">
						<select name="ciudad_empresa" class="form-control" id="ciudad_empresa" placeholder="Ciudad" required>
							<option value="">SELECCIONE CIUDAD</option>
							@foreach( Ciudades::all() as $ciudad )
							<option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }}</option>
							@endforeach
						</select>
						<select name="id_regimen" class="form-control" id="id_regimen" placeholder="id_regimen" required>
							<option value="">SELECCIONE REGIMEN</option>
							@foreach( Regimenes::all() as $regimen )
							<option value="{{ $regimen['id'] }}">{{ $regimen['nombre'] }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-danger " id="empresa">
					<div class="panel-heading">Información del Usuario Admin</div>
					<div class="panel-body">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="userncedula" type="text" class="form-control has-success" name="userncedula" placeholder="Cédula" >
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="usernombre" type="text" class="form-control has-success" name="usernombre" placeholder="Nombres" >
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="userapellido" type="text" class="form-control has-success" name="userapellido" placeholder="Apellidos" >
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="usercargo" type="text" class="form-control has-success" name="usercargo" placeholder="Cargo" >
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="usertelefono" type="text" class="form-control has-success" name="usertelefono" placeholder="Teléfono" >
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="userpassword" type="text" class="form-control has-success" name="userpassword" placeholder="password" >
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="usercorreo" type="text" class="form-control has-success" name="usercorreo" placeholder="Correo" >
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-warning ">
					<div class="panel-heading">Información de Sucursal principal</div>
					<div class="panel-body">
					<input type="hidden" name="id" id="id">
					<input type="text" name="sucnombre" class="form-control"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre" required>
					<input type="text" name="succodigo" class="form-control"  onkeyup="config.UperCase('codigo');" id="codigo" placeholder="Código" required>
					<input type="text" name="sucdireccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Dirección" required>
					<input type="text" name="sucencargado" class="form-control"  onkeyup="config.UperCase('encargado');" id="encargado" placeholder="Encargado" required>
					<input type="number" name="suctelefono" class="form-control"  onkeyup="config.UperCase('telefono');" id="telefono" placeholder="Teléfono" required>
					<input type="email" name="succorreo" class="form-control"  onkeyup="config.UperCase('correo');" id="correo" placeholder="Correo" required>
					<select name="succiudad" class="form-control" id="ciudad" placeholder="Ciudad" required>
						<option value="">SELECCIONE CIUDAD</option>
						@foreach( Ciudades::all() as $ciudad )
						<option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }}</option>
						@endforeach
					</select>
					</div>
				</div>
			</div>
			
			
			<p id="empresaConfig"></p>
			<div class="col-md-6">
				<div class="panel panel-info ">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<input type="submit" id="boton"  class="btn btn-success" value="Registrar">
						<!--ENTER Resultado -->
						<div id="resultado"></div>
					</div>
				</div>
			</div>
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