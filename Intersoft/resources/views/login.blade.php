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
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet">
	<style>
		*,p{
			font-family: Poppins;
		}
		.jumbotron{
			z-index:100;
			background: #111111;
			opacity: 0.8;
			color: white;
			padding: 0%;
			position:fixed;
			width:100%;
			top:0px;
		}
		.pantallaInicial{
			width:100%;
			margin: 0 auto;
			padding: 0 auto;
			padding-top:3%;
			padding-bottom: 5%;
			color: white;
			font-size: 12pt;
			-webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
			-webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
			animation: pantallain 100s infinite;
			animation-direction: alternate;
		}
		/* Safari 4.0 - 8.0 */
		@-webkit-keyframes pantallain {
			0%   {background: #5abd61;}
			25%  {background: #022c76;}
			50% {background: #e3569d;}
			75%  {background: #ce3a28;}
			100%  {background: #fbc430;} 
		}
		
		@keyframes pantallain {
			0%   {background: #5abd61;}
			25%  {background: #022c76;}
			50% {background: #e3569d;}
			75%  {background: #ce3a28;}
			100%  {background: #fbc430;} 
		}
		.btn-danger:hover{
			background:#ce3a28 !important;
			color:white;
		}
		@keyframes up {
		0% {
		opacity: 0;
		}
		10%, 90% {
		opacity: 1;
		}
		100% {
		opacity: 0;
		transform: translateY(-1024px);
		}
		}
		@keyframes wobble {
		33% {
		transform: translateX(-50px);
		}
		66% {
		transform: translateX(50px);
		} }
		.circulo {
			width: 3rem;
			height: 3rem;
			border-radius: 50%;
			background: white;
			opacity: 0.3;
			display: flex;
			justify-content: center;
			align-items: center;
			text-align: center;
			margin:0px auto;
			padding:1%;
			position:absolute;
		}
		.panel{
			border-radius: 0px 0px 0px 0px;
			-moz-border-radius: 0px 0px 0px 0px;
			-webkit-border-radius: 0px 0px 0px 0px;
			border: 0px solid #000000;
			-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
		}
		.form-control{
			border-radius: 0px 0px 0px 0px;
			-moz-border-radius: 0px 0px 0px 0px;
			-webkit-border-radius: 0px 0px 0px 0px;
			border: 0px solid #000000;
			margin:1%;
			font-family: Poppins;
		}
		.body-content{
			background: white;
			padding-top: 5%;
			padding-bottom: 5%;
		}
		.card{
			border-radius: 0px 0px 0px 0px;
			-moz-border-radius: 0px 0px 0px 0px;
			-webkit-border-radius: 0px 0px 0px 0px;
			border: 0px solid #000000;
			background:white;
			margin:1%;
			color: #666;
			-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			height: 200px;
		}
		.card-title{
			background:#e3569d;
			color:white;
			margin:0 auto;
			padding: 8%;
			top:0px;
			left:0px;
			width:100%;
		}
		.card-text{
			margin-left:6%;
			width:80%;
			padding-top:5%;
			text-align:justify;
		}
	</style>
	

</head>
<?php if(isset($result)==false){ $result = "";} ?>
<body style="overflow-x:hidden;width:100%;">



	<div class="jumbotron">
		<div class="row">
			<div class="col-md-2">
				<img class="logo" style="width:100px;" src="/assets/img/logo_intersoft1.png">
			</div>
		</div>
	</div>

	<div class="row pantallaInicial">
		<div class="col-md-12">
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color:white">Intersoft</a>
					</div>
					<div class="navbar-header" style="margin-left:30%;"><a class="navbar-brand" href="#" style="color:white">Nosotros</a></div>
					<div class="navbar-header"><a class="navbar-brand" href="#" style="color:white">Modulos</a></div>
					<div class="navbar-header"><a class="navbar-brand" href="#" style="color:white">Contactos</a></div>
					<ul class="nav navbar-nav navbar-right">
					<li><a class="btn-danger" href="#" style="color:white"> Demo</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="col-md-5">
			<div class="row">
				<h1 style="margin-left:10%;font-size:40pt;"><strong>Administra</strong> tu empresa, desde cualquier <strong>lugar</strong><h1>
				<p style="margin-left:10%;font-size:12pt;">Administra inventario, agenda clientes, contabilidad, cartera, tesoreria, entre otros modulos disponibles para ti. <strong>Entra a nuestro demo para que te animes a darte de alta</strong></p>
			</div>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-4">
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


			<p></p>
			<div class="panel panel-success" id="empresa" style="width: 300px;">
				<div class="panel-heading" style="text-aling:center"><img class="logo" src="/assets/img/logo_intersoft1.png"></div>
				<div class="panel-body">
					<input type="text" id="nit_empresa" class="form-control" onkeypress="pulsar(event)" autocomplete="off" placeholder="nit empresa" >
					<p style="color:black;font-size:8pt">Escriba el nit sin puntos junto al digito de verificación</p>
					<div class="form-control btn btn-success" id="validar_empresa">Validar Empresa</div>
				</div>
			</div>

			<form action="/loguin" method="POST" style="width: 300px;" >
				
				
				
				<div id="login">
					<div class="panel panel-success" id="empresa">
						<div class="panel-heading" style="text-aling:center"><img class="logo" src="/assets/img/logo_intersoft1.png"></div>
						<div class="panel-body">
							<p id="empresaConfig"></p>
							<p style="color:black;font-size:8pt">Elija es usuario con el cual desea ingresar correspondiente al nit</p>
							<div class="input-group">
								<div id="usuarios"></div>
							</div>
							<div class="input-group">
								<input id="password" type="password" class="form-control" name="password" placeholder="Password" >
							</div>
							<p style="color:black;font-size:8pt">A que Sucursal</p>
							<div class="input-group">
								<div id="sucursales"></div>
							</div>
							<!--div  id="boton" onclick="login.loguearse();" class="olvido2">Entrar</div-->
							<input  id="boton" type="submit" name="boton" class="olvido2" style="border: 0px;" value="Entrar">
							<div class="olvido" onclick="config.Redirect('olvido?data='+$('#nit_empresa').val());"><a href="#" style="color:white"> Olvido de Contraseña</a></div>
								
						</div>
					</div>
				</div>
				<!--ENTER Resultado -->
				<div id="resultado"></div>
				<!--FIN Resultado -->
				<br><p style="text-align: right;">Creado por Wakusoft</p>
			</form>
		</div>
		<div class="circulo" style="left:5%;top:10%;"></div>
		<div class="circulo" style="left:80%;top:14%;"></div>
		<div class="circulo" style="left:25%;top:23%;"></div>
		<div class="circulo" style="left:60%;top:50%;"></div>
		<div class="circulo" style="left:38%;top:35%;"></div>
		<div class="circulo" style="left:30%;top:60%;"></div>
		<div class="circulo" style="left:7%;top:55%;"></div>
	</div>


	<div class="content body-content">
		<article class="row" style="padding-bottom:5%;">
			<div class="col-md-6">
				<h1 style="margin-left:10%;font-size:40pt;">Nosotros</h1>
				<p style="margin-left:10%;font-size:20pt;">Intersoft es un sistema realizado por la empresa <a href="https://www.wakusoft.com">Wakusoft</a>.<p>
				<p style="margin-left:10%;font-size:12pt;">Especialistas en desarrollo de software a la medida creada desde el año 2013, con la finalidad de satisfacer las necesidades de nuestros clientes adaptando el software a las especificaciones de cada uno de ellos.<br>
				Wakusoft es un área dedicada al desarrollo de software a la medida, que brinda a sus clientes confiabilidad, calidad, efectividad y seguridad en el software entregado.</p>
			</div>
			<div class="col-md-6">
				<div class="circulo" style="background-image: url('/assets/img/fondo1.png');width:250px;height:250px;opacity:1;margin-left:30%;margin-top:10%; ">
				</div>
			</div>
		</article>

		<article class="row" style="background:#022c76;color:white;padding-bottom:5%;">
			<div class="col-md-12">
				<h1 style="margin-left:5%;font-size:40pt;"><br>Modulos</h1>
				
				<p style="margin-left:5%;font-size:20pt;">Intersoft presenta a su disposición varios módulos como lo son:</a>.<p>
				<div class="row" style="width:100%;margin-left:5%;">
					<div class="card col-md-3" >
						<div class="card-body">
							<h5 class="card-title" style="background:#5abd61">Información General</h5>
							<p class="card-text">Crea usuarios ilimitados, clientes y proveedores. Parametriza tu negocio</p>
							<br><br>
						</div>
					</div>
					<div class="card col-md-3" >
						<div class="card-body">
							<h5 class="card-title" style="background:#022c76">Inventario</h5>
							<p class="card-text">Crea referencias, genera stock nuevo, compras y ventas de mercancia, fabricacion por materia prima.</p>
							<br><br>
						</div>
					</div>
					<div class="card col-md-3" >
						<div class="card-body">
							<h5 class="card-title" style="background:#022c76">Producción</h5>
							<p class="card-text">Llevar el control del producción de mercancia terminada.</p>
							<br><br>
						</div>
					</div>
					<div class="card col-md-3" >
						<div class="card-body">
							<h5 class="card-title" style="background:#e3569d">Facturación</h5>
							<p class="card-text">Crea cotizaciones, remisiones, facturas de venta tipo post. Proximamente integración XML DIAN</p>
							<br><br>
						</div>
					</div>
					<div class="card col-md-3" >
						<div class="card-body">
							<h5 class="card-title" style="background:#ce3a28">Tesoreria</h5>
							<p class="card-text">Registra tus gastos y creditos.</p>
							<br><br>
						</div>
					</div>
					<div class="card col-md-3" >
						<div class="card-body">
							<h5 class="card-title" style="background:#fbc430">Contabilidad</h5>
							<p class="card-text">Genera reportes contables básicos</p>
							<br><br>
						</div>
					</div>
					
				</div>
			</div>
		</article>

		<article class="row" style="margin-left:5%;font-size:12pt;"	>
			<h1 style="margin-left:5%;font-size:40pt;">Contactos</h1>
			<div class="col-md-4" style="padding-top:5%">
				Nuestras oficinas<br>
				<a href="https://www.google.com/maps/dir/Calle+38A+Sur+%2350a71,+Bogot%C3%A1/Cl.+71+Sur,+Bosa,+Bogot%C3%A1/@4.5933655,-74.1780862,14z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x8e3f9ed28717659f:0xe66ee148df96e1df!2m2!1d-74.127088!2d4.597795!1m5!1m1!1s0x8e3f9e409ee9807d:0xfebdf204db45bce6!2m2!1d-74.1940864!2d4.6063584" target="_blank">Calle 38 A # 50 A - 71 Sur,</a><br>
				Bogotá Colombia
			</div>
			<div class="col-md-4" style="padding-top:5%">
				Llamanos<br>
				<a href="https://api.whatsapp.com/send?phone=3115065024" target="_blank">311 506 50 24</a><br>
				<a href="https://api.whatsapp.com/send?phone=32199045297" target="_blank">321 904 52 97</a>
			</div>
			<div class="col-md-4" style="padding-top:5%">
				Email us<br>
				<a href="mailto:wakusoft@gmail.com">wakusoft@gmail.com</a><br>
				<a href="mailto:interconsis@yahoo.com">interconsis@yahoo.com</a>
			</div>
		</article>
	</div>

	<!--ENTER cargando gif -->
	<center>
		<div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;display: none;z-index: 100;"></div>
	</center>
	<!-- FIN cargando gif -->
	</body>
</html>
<script>

function pulsar(e) {
	if (e.keyCode === 13 && !e.shiftKey) {
		e.preventDefault();
		$('#validar_empresa').trigger('click');		
	}
}

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
				//console.log(response);
				$('#resultado').html('');
				if(response.result == 'Success'){
					$('#login').show();
					$('#empresa').hide();
					//indicar las sucursales de la empresa escrita
					sucursales = '<select name="sucursal" class="form-control" id="sucursal" style="witdh:100%;">';
					response.sucursales.forEach(element => {
						sucursales += '<option value="' + element.id + '">' + element.nombre + '</option>';
					});						
					sucursales += '</select>';
					$('#sucursales').html(sucursales);
					//indicar los usuarios de la mpresa escrita
					usuarios = '<select name="cedula" class="form-control" id="cedula">';
					response.usuarios.forEach(element => {
						usuarios += '<option value="' + element.ncedula + '">' + element.nombre + ' ' + element.apellido + '</option>';
					});						
					usuarios += '</select>';
					$('#usuarios').html(usuarios);
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