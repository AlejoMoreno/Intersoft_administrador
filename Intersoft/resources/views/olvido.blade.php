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

	<?php 

	use App\Usuarios;
	use App\Empresas;
	use App\Mail\Mail\Olvido;
	use Illuminate\Support\Facades\Mail;
	
	if(isset($_GET['boton'])){
		
		if($_GET['boton'] == "Recordar"){ //gerenar el recordatorio
			$empresa =  Empresas::where('nit_empresa','=',$_GET['data'])->first();
			$usuarios = Usuarios::where('ncedula',$_GET['cedula'])->where('id_empresa',$empresa->id)->first();
			
				if($usuarios==null){
					echo "<div style='width:100%;background-color:red;color:white;'><center>No existe el usuario</center></div>";
				}
				else{
					echo "el usuario si existe";
					Mail::to($usuarios->correo)->send(new App\Mail\Mail\Olvido($usuarios));
				}
		}
	}
	?>
	
	<center>
		<form action="" method="GET" style="width: 300px;">
			

			<p id="empresaConfig">Recordar Contraseña</p>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				<input id="data" type="text" class="form-control has-success" name="data" value="<?php echo $_GET['data']; ?>" placeholder="empresa" >
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="cedula" type="text" class="form-control has-success" name="cedula" placeholder="Cédula" >
			</div>
			<input type="submit" id="boton" class="olvido2" name="boton" value="Recordar">
			<div class="olvido" ><a href="/" style="color:white">Ingresa ahora!</a></div>
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