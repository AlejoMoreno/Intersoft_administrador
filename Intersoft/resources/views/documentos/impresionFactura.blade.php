<head>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Bootstrap core CSS     -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
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
<style>
	.page-break {
		page-break-after: always;
	}
	</style>
	
 	<section>
		<div>
			<img style="width:100px;" src="/assets/img/empresas/{{ $factura['id_sucursal']['id_empresa']['id'] }}.jpeg">
		</div>
	</section>
<div><center style="font-size: 7px;"><h2><strong>{{ $factura['id_sucursal']['id_empresa']['razon_social'] }}<br>NIT. {{ $factura['id_sucursal']['id_empresa']['nit_empresa'] }}</strong></h2><br>{{ $factura['id_sucursal']['id_empresa']['direccion'] }}<br>Teléfono: {{ $factura['id_sucursal']['id_empresa']['telefono'] }} - {{ $factura['id_sucursal']['id_empresa']['telefono2'] }}<br>Cel. {{ $factura['id_sucursal']['id_empresa']['telefono1'] }}<br>{{ $factura['id_sucursal']['correo'] }}</center><br></div>

	<div id="tablas">
<table class="table table-bordered">
	<tr>
		<td rowspan="2"><strong>{{ $factura['id_documento']['nombre'] }} # <?php echo $factura['prefijo'].'  '.$factura['numero'];?></strong></td>
	    <td class="tg-le8v" colspan="3"><strong>FECHA EMISIÓN</strong><br><?php echo $factura['fecha'];?></td>
	    <td class="tg-le8v" colspan="4"><strong>FECHA VENCIMIENTO</strong><br><?php echo $factura['fecha_vencimiento'];?></td>
	    <td class="tg-le8v"><strong>SUCURSAL</strong><br><?php echo $factura['id_sucursal']['nombre'];?></td>
	    <td class="tg-le8v"><strong>VENDEDOR</strong><br><?php echo $factura['id_vendedor']['ncedula'];?></td>
	</tr>
	<tr>
		<td class="tg-yw4l" colspan="3"><strong>CLIENTE:</strong><br><?php echo $factura['id_cliente']['razon_social'];?></td>
	    <td class="tg-yw4l" colspan="2"><strong>NIT:</strong><br> <?php echo $factura['id_cliente']['nit'];?></td>
		<td><strong>DIRECCION:</strong> <br><?php echo $factura['id_cliente']['direccion'];?></td>
		<td><strong>TELÉFONO:</strong><br> <?php echo $factura['id_cliente']['telefono'];?></td>
		<td><strong>CELULAR:</strong><br> <?php echo $factura['id_cliente']['telefono1'];?></td>
		<td><strong>CIUDAD:</strong><br> <?php echo $factura['id_cliente']['id_ciudad']['nombre'];?></td>
	</tr>
</table>
<br>
<table id="productos" class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="tg-le8v"><strong>REFERENCIA</strong></th>
			<th class="tg-le8v"><strong>COD.Barras</strong></th>
			<th class="tg-le8v"><strong>NOMBRE</strong></th>
			<th class="tg-le8v"><strong>LOTE</strong></th>
			<th class="tg-le8v"><strong>SERIAL</strong></th>
			<th class="tg-le8v"><strong>VENCIMIENTO</strong></th>
			<th class="tg-le8v"><strong>CANTIDAD</strong></th>
			<th class="tg-le8v"><strong>DSC</strong></th>
			<th class="tg-le8v"><strong>IVA</strong></th> 
			<th class="tg-le8v"><strong>VALOR UNIDAD</strong></th>
			<th class="tg-le8v"><strong>VALOR TOTAL</strong></th>
		</tr>
	</thead>
	@foreach($kardex as $obj)
	<tr>
		<td class="tg-yw4l">{{ $obj['id_referencia']['codigo_linea'].$obj['id_referencia']['codigo_letras'].$obj['id_referencia']['codigo_consecutivo'] }}</td>
		<td class="tg-yw4l">{{ $obj['id_referencia']['codigo_barras'] }}</td>
		<td class="tg-yw4l">{{ $obj['id_referencia']['descripcion'] }}</td>
		<td class="tg-yw4l">{{ $obj['lote'] }}</td>
		<td class="tg-yw4l">{{ $obj['serial'] }}</td>
		<td class="tg-yw4l">{{ $obj['fecha_vencimiento'] }}</td>
		<td class="tg-yw4l">{{ $obj['cantidad'] }}</td>
		<td class="tg-yw4l">{{ $obj['descuento'] }}</td>
		<td class="tg-yw4l">{{ $obj['iva'] }}</td>
		<td class="tg-yw4l">{{ number_format($obj['precio'], 0, ",", ".") }}</td>
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
					<td><strong>SUBTOTAL: </strong></td>
					<td>$ <?php echo number_format($factura['subtotal'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>IVA: </strong></td>
					<td>$ <?php echo number_format($factura['iva'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>IMPOCONSUMO: </strong></td>
					<td>$ <?php echo number_format($factura['impoconsumo'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>DESCUENTO:</strong></td>
					<td>$ <?php echo number_format($factura['descuento'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>FLETES:</strong></td>
					<td>$ <?php echo number_format($factura['fletes'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>RETEFUENTE:</strong></td>
					<td>$ <?php echo number_format($factura['retefuente'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>TOTAL: </strong></td>
					<td><strong>$ <?php echo number_format($factura['total'], 0, ",", ".");?></strong></td>
				</tr>
			</table>
			
	</tr>
</table>
<br><br>

<table class="table table-bordered">
	<tr>
		<td colspan="2" style="font-size: 10px"><strong>OBS:</strong> <?php echo $factura['observaciones'] ?></td>
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

<script>
window.print();
</script>