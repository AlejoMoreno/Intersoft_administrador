<head>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="http://localhost:8000/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- TEXT EDTIT -->
    <link rel="stylesheet" href="https://imperavi.com/assets/redactor/redactor.min.css" />
<head>
<meta charset="UTF-8">
</head>
<style type="text/css">
	*{
		font-size: 9px;
	}
</style>
 	<section>
		<div>
			<img src="dskadsa">
		</div>
	</section>
<div><center style="font-size: 7px;"><h2><strong>{{ $carteras['id_sucursal'][0]['id_empresa']['razon_social'] }}<br>NIT. {{ $carteras['id_sucursal'][0]['id_empresa']['nit_empresa'] }}</strong></h2><br>{{ $carteras['id_sucursal'][0]['id_empresa']['direccion'] }}<br>Teléfono: {{ $carteras['id_sucursal'][0]['id_empresa']['telefono'] }} - {{ $carteras['id_sucursal'][0]['id_empresa']['telefono2'] }}<br>Cel. {{ $carteras['id_sucursal'][0]['id_empresa']['telefono1'] }}<br>{{ $carteras['id_sucursal'][0]['correo'] }}</center><br></div>

	<div id="tablas">
<table class="table table-bordered">
	<tr>
		<td rowspan="2"><strong>Egreso {{ $carteras['id_documento']['nombre'] }} # <?php echo $carteras['prefijo'].'  '.$carteras['numero'];?></strong></td>
	    <td class="tg-le8v" colspan="3"><strong>FECHA EMISIÓN</strong><br><?php echo $carteras['fecha'];?></td>
	    <td class="tg-le8v"><strong>SUCURSAL</strong><br><?php echo $carteras['id_sucursal'][0]['nombre'];?></td>
	    <td class="tg-le8v"><strong>USUARIO</strong><br><?php echo $carteras['id_vendedor']['ncedula'];?></td>
	
	
		<td class="tg-yw4l" colspan="3"><strong>CLIENTE:</strong><br><?php echo $carteras['id_cliente'][0]['razon_social'];?></td>
		</tr>
		<tr>
	    <td class="tg-yw4l" colspan="2"><strong>NIT:</strong><br> <?php echo $carteras['id_cliente'][0]['nit'];?></td>
		<td><strong>DIRECCION:</strong> <br><?php echo $carteras['id_cliente'][0]['direccion'];?></td>
		<td><strong>TELÉFONO:</strong><br> <?php echo $carteras['id_cliente'][0]['telefono'];?></td>
		<td><strong>CELULAR:</strong><br> <?php echo $carteras['id_cliente'][0]['telefono1'];?></td>
		<td><strong>CIUDAD:</strong><br> <?php echo $carteras['id_cliente'][0]['id_ciudad']['nombre'];?></td>
	</tr>
</table>
<br>
<table id="productos" class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="tg-le8v"><strong>Factura</strong></th>
			<th class="tg-le8v"><strong>Fecha</strong></th>
			<th class="tg-le8v"><strong>Flete</strong></th>
			<th class="tg-le8v"><strong>ReteF</strong></th>
			<th class="tg-le8v"><strong>ReteIva</strong></th>
			<th class="tg-le8v"><strong>ReteIca</strong></th>
			<th class="tg-le8v"><strong>Interes</strong></th>
			<th class="tg-le8v"><strong>Desc</strong></th> 
			<th class="tg-le8v"><strong>Efectivo</strong></th>
			<th class="tg-le8v"><strong>Total</strong></th>
		</tr>
	</thead>
	@foreach($kardexCarteras as $obj)
	<tr>
		<td class="tg-yw4l">{{ $obj['numeroFactura'] }}</td>
		<td class="tg-yw4l">{{ $obj['fecha'] }}</td>
		<td class="tg-yw4l">{{ number_format($obj['fletes'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format($obj['retefuente'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format($obj['reteiva'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format($obj['reteica'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format($obj['sobrecostos'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format($obj['descuentos'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format($obj['efectivo'], 0, ",", ".") }}</td>
		<td class="tg-yw4l">{{ number_format(($obj['total']), 0, ",", ".") }}</td>
	</tr>
	@endforeach
</table>

<br><br>
<table class="table">
	<tr>
		<td style="width: 65%"></td>
		<td>
			<table class="">
				
				<tr>
					<td><strong>TOTAL: </strong></td>
					<td><strong>$ <?php echo number_format($carteras['total'], 0, ",", ".");?></strong></td>
				</tr>
			</table>
			
	</tr>
</table>
<br><br>

<table class="table table-bordered">
	<tr>
		<td colspan="2" style="font-size: 10px"><strong>OBS:</strong> <?php echo $carteras['observaciones'] ?></td>
	</tr>
	<tr>
		<td style="width: 50%"><strong>RECIBIDO</strong></td>
		<td><br><strong>Autorizado</strong><br><br><br>__________________________________________<br>Alejandro Moreno Castro<br>CC. 8989898989<br>Tel. 89ds898989</td>
	</tr>
</table>
</div>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;background-color: white;border: 1px solid;color: black;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:2px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-le8v{background-color:#BD0A29;vertical-align:top;color:white;}
.tg .tg-yw4l{vertical-align:top;font-size: 11px;}
table{
	width: 120%;
}
#logo1,#datosempresa,#numeroremision{
	width: 40%;
	float: left;
}
#numeroremision{
	position: absolute;
	left: 75%;
	top: 50px;
}
 #datosPa{
 	margin: 1px 1px 1px;
	padding: 1px 1px 1px 1px;
 }
#datos{
	width: 150%;
}
form input{
	width: 92%;
	height: 30px;
	padding: 10px 10px 10px 10px;
	padding-right: 10px;
}
body{
	font-family: sans-serif;
	color: #9EA3A3;
	font-size: 90%;
}
strong{
	color: black;
}
#pac{
	font-size: 10px;
}
#tablas{
	position: absolute;
	width: 90%;
	left: 5%;
}
#titulo{
	position: relative;
	left: 5%;
}
</style>