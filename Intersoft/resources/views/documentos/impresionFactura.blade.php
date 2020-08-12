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
		page-break-after: auto;
	}
	</style>
	
	
	<?php $paginas = sizeof($kardex)/5; ?>

	

 	<section>
		<div>
			<img style="width:100px;" src="/assets/img/empresas/{{ $factura['id_sucursal']['id_empresa']['id'] }}.jpeg">
		</div>
	</section>
<div style="top:-30px;left:30%;position:absolute;">
	<div style="font-size: 7px;">
		<h2>
			<strong>{{ $factura['id_sucursal']['id_empresa']['razon_social'] }}
				<br>NIT. {{ $factura['id_sucursal']['id_empresa']['nit_empresa'] }}
			</strong>
		</h2>
	</div>
</div>

<div style="position: absolute;top: 20px;right: 10px;">
	{{ $factura['id_sucursal']['id_empresa']['direccion'] }}<br>
	Teléfono: {{ $factura['id_sucursal']['id_empresa']['telefono'] }} - 
	{{ $factura['id_sucursal']['id_empresa']['telefono2'] }}<br>
	Cel. {{ $factura['id_sucursal']['id_empresa']['telefono1'] }}<br>
	{{ $factura['id_sucursal']['correo'] }}<br>
	<strong>Paginas de {{ $paginas }}</strong>
</div>

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

<div class="page-break"></div>
<table id="productos" class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="tg-le8v"><strong>Descripción</strong></th>
			<th class="tg-le8v"><strong>Unidades</strong></th>
			<th class="tg-le8v"><strong>Precio Unitario</strong></th>
			<th class="tg-le8v"><strong>Precio</strong></th>
		</tr>
	</thead>
	<?php for($i=0;sizeof($kardex)>$i; $i++) { ?>
	<tr>
		<td class="tg-yw4l">{{ $kardex[$i]['id_referencia']['descripcion'] }}</td>
		<td class="tg-yw4l">{{ $kardex[$i]['cantidad'] }}</td>
		<td class="tg-yw4l">{{ number_format($kardex[$i]['precio'], 0, ",", ".") }}</td>
		<td class="tg-yw4l"><?php $tt = $kardex[$i]['precio'] * $kardex[$i]['cantidad']; ?>{{ number_format(($tt), 0, ",", ".") }}</td>
	</tr>
	<?php } ?>
	
</table>

<br><br>
<table class="table">
	<tr>
		<td style="width: 65%"><strong>OBS:</strong> <?php echo $factura['observaciones'] ?></td></td>
		<td>
			<table class="">
				<tr>
					<td><strong>Total parcial: </strong></td>
					<td>$ <?php echo number_format($factura['subtotal'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>IVA: </strong></td>
					<td>$ <?php echo number_format($factura['iva'], 0, ",", ".");?></td>
				</tr>
				<tr>
					<td><strong>Impoconsumo: </strong></td>
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
				<tr style="background:#ddd">
					<td><strong>TOTAL FACTURA: </strong></td>
					<td><strong>$ <?php echo number_format($factura['total'], 0, ",", ".");?></strong></td>
				</tr>
			</table>
			
	</tr>
</table>

	
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
//window.print();
</script>

<script>
	/*window.onunload = refreshParent;
	function refreshParent() {
		window.opener.location.reload();
	}*/
</script>
