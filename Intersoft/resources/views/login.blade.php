<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
	<html lang="en">
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="/assets/img/logo_intersot.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/intersoft.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.min3.js"></script>
	<script  type="text/javascript" src="js/index.js"></script>
	<script src="js/config.js"></script>
	<script src="js/DB/sesion.js"></script>
  	<script src="js/login.js"></script>

	  <script data-ad-client="ca-pub-4639820515028360" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

  	<script src="/assets/js/sweetalert.min.js"></script>
</head>
<?php if(isset($result)==false){ $result = "";} ?>
<body>
	
	<center>
		@if( $result == "error" )

		<script>
			$( document ).ready(function() {
			    config.saveErrorLogin(<?php echo json_encode( $body ) ?>);	
			    //config.Redirect('/');	
			});
		</script>

		@endif

		@if( $result == "success" )

		<script>
			$( document ).ready(function() {
			    config.saveLogin(<?php echo json_encode( $body ) ?>, <?php echo json_encode( $sessions ) ?>);	
				config.Redirect('/index');	
			});
		</script>
		
		@endif

		<?php  use App\Sucursales; ?>

		

		<form action="/loguin" method="POST" style="width: 300px;" >
			<img class="logo" src="/assets/img/logo_intersoft1.png">
			<p></p>
			<div class="panel panel-success" id="empresa">
				<div class="panel-heading">Escribe Nit de la empresa</div>
				<div class="panel-body">
					<input type="text" id="nit_empresa" class="form-control" autocomplete="off" >
					<div class="form-control btn btn-success" id="validar_empresa">Validar Empresa</div>
					<a href="/registro">Registra la empresa</a>
				</div>
			</div>
			
			<div id="login">
				<p id="empresaConfig"></p>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="cedula" type="text" class="form-control has-success" name="cedula" placeholder="Cédula" >
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="password" type="password" class="form-control" name="password" placeholder="Password" >
				</div>
				<div class="input-group">
					<label>A que Sucursal</label>
					<div id="sucursales"></div>
				</div>
				<!--div  id="boton" onclick="login.loguearse();" class="olvido2">Entrar</div-->
				<input  id="boton" type="submit" name="boton" class="olvido2" style="border: 0px;" value="Entrar">
				<div class="olvido" onclick="config.Redirect('olvido?data='+$('#nit_empresa').val());"><a href="#" style="color:white"> Olvido de Contraseña</a></div>
				<!--<div class="olvido1" onclick="config.Redirect('registro');"><a href="#" style="color:white"> Date de alta como usuario</a></div>-->
			</div>
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

	$('#login').hide();

	$('#validar_empresa').click(function (){
		parametros = {
			"nit" : $('#nit_empresa').val()
		};

		$.ajax({			
			data:  parametros,
			url:   HOST+'/empresas/search',
			type:  'get',
			beforeSend: function () {
				$('#resultado').html('<p style="color:green">Buscando Resultados</p>');
			},
			success:  function (response) {
				let sucursales = '';
				console.log(response);
				$('#resultado').html('');
				if(response.result == 'Success'){
					$('#login').show();
					$('#empresa').hide();
					//indicar las sucursales de la empresa escrita
					sucursales = '<select name="sucursal" class="form-control" id="sucursal">';
					response.sucursales.forEach(element => {
						sucursales += '<option value="' + element.id + '">' + element.nombre + '</option>';
					});						
					sucursales += '</select>';
					$('#sucursales').html(sucursales);
				}
				else{
					$('#login').hide();
					$('#empresa').show();
					$('#resultado').html('<p style="color:red">No se encontro Empresa</p>');
				}
			}
		});		
	});

	config.GetAllInformation();
	$('#cedula').focus();
    //login.FocusForm(input,next,fin); asi funciona el login focus
    login.FocusForm('cedula','password','no');
    login.FocusForm('password','boton','no');
    login.FocusForm('boton','boton','si');


});

</script>