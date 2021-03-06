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
		font-size: 10px;
		padding: 0 auto;
		margin: 0 auto;
	}
</style>
<body style="width: 300px;margin-left: 35%;">
<div><center><strong>{{ $factura['id_sucursal']['id_empresa']['razon_social'] }}<br>NIT. {{ $factura['id_sucursal']['id_empresa']['nit_empresa'] }}</strong><br><br>{{ $factura['id_sucursal']['id_empresa']['direccion'] }}<br>Teléfono: {{ $factura['id_sucursal']['id_empresa']['telefono'] }} - {{ $factura['id_sucursal']['id_empresa']['telefono2'] }}<br>Cel. {{ $factura['id_sucursal']['id_empresa']['telefono1'] }}<br>{{ $factura['id_sucursal']['correo'] }}<br> <?php echo $factura['id_sucursal']['nombre'];?><br></center><br></div>

<center>
	<strong>{{ $factura['id_documento']['nombre'] }} # <?php echo $factura['prefijo'].'  '.$factura['numero'];?></strong><br>
	<strong><?php echo $factura['fecha'];?><br>
	<strong>VENDEDOR <?php echo $factura['id_vendedor']['ncedula'];?><br></strong>
</center>

	<div id="tablas"><br>
		<center>
<table class="table">
	<tr>
		<td class="tg-yw4l" colspan="3">
			<strong>CLIENTE:</strong><br>
			<?php echo $factura['id_cliente']['razon_social'];?><br>
			Nit. <?php echo $factura['id_cliente']['nit'];?><br>
			Dir. <?php echo $factura['id_cliente']['direccion'];?>
		</td>
		<td>
			<br>
			Tel. <?php echo $factura['id_cliente']['telefono'];?><br> 
			Tel2. <?php echo $factura['id_cliente']['telefono1'];?><br> 
			Ciud. <?php echo $factura['id_cliente']['id_ciudad']['nombre'];?>
		</td>
	</tr>
</table>
</center>
<br>
<table id="productos" class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="tg-le8v"><strong>Referencia</strong></th>
			<th class="tg-le8v"><strong>Nombre</strong></th>
			<th class="tg-le8v"><strong>Cantidad</strong></th>
			<th class="tg-le8v"><strong>Iva</strong></th>
			<th class="tg-le8v"><strong>Total</strong></th>
		</tr>
	</thead>
	@foreach($kardex as $obj)
	<tr>
		<td class="tg-yw4l">{{ $obj['id_referencia']['codigo_linea'].$obj['id_referencia']['codigo_letras'].$obj['id_referencia']['codigo_consecutivo'] }}</td>
		<td class="tg-yw4l">{{ $obj['id_referencia']['descripcion'] }}</td>
		<td class="tg-yw4l">{{ $obj['cantidad'] }}</td>
		<td class="tg-yw4l">{{ $obj['iva'] }}</td>
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
					<td><strong>Subtotal: </strong></td>
					<td>$ <?php echo number_format($factura['subtotal'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Iva: </strong></td>
					<td>$ <?php echo number_format($factura['iva'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Inpoconsumo: </strong></td>
					<td>$ <?php echo number_format($factura['impoconsumo'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Descuento:</strong></td>
					<td>$ <?php echo number_format($factura['descuento'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Flete:</strong></td>
					<td>$ <?php echo number_format($factura['fletes'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Retefuente:</strong></td>
					<td>$ <?php echo number_format($factura['retefuente'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Total: </strong></td>
					<td><strong>$ <?php echo number_format($factura['total'], 0, ",", ".");?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="width: 65%"><strong>Pago en efectivo: </strong></td>
		<td>
			<table class="">
				<tr>
					<td><strong>Total: </strong></td>
					<td><strong>$ <?php echo number_format($factura['total'], 0, ",", ".");?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br><br>

<center>
	-----------------------------------------------<br>
	intersoft <br>
	Desarrollado por Wakusoft <br>
	NIT. 1030570356 <br>
	-----------------------------------------------
</center>
</div>
</body>
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

<script>
	window.print();
	</script>