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

	<div style="width: 100%;top:0;left: 0;padding: 2%;">
		<table style="width: 100%;">
			<tr>
				<td style="width: 20%">
					<img style="width:120px;" src="https://wakusoft.com/img/logo_wakusoft.png">
					<!--<img style="width:100px;float: left;" src="/assets/img/empresas/{{ $factura['id_sucursal']['id_empresa']['id'] }}.jpeg">-->
				</td>
				<td style="width: 40%">
					<table style="width: 100%">
						<tr><td><strong>{{ $factura['id_sucursal']['id_empresa']['razon_social'] }}</strong></td></tr>
						<tr><td><strong>NIT. {{ $factura['id_sucursal']['id_empresa']['nit_empresa'] }}</strong></td></tr>
						<tr><td>{{ $factura['id_sucursal']['id_empresa']['telefono'] }} - {{ $factura['id_sucursal']['id_empresa']['telefono1'] }}</td></tr>
						<tr><td>{{ $factura['id_sucursal']['correo'] }}</td></tr>
						<tr><td>{{ $factura['id_sucursal']['id_empresa']['direccion'] }}</td></tr>
					</table>
				</td>
				<td style="width: 40%">
					<table style="width: 100%">
						<tr>
							<td><strong>Factura</strong></td>
							<td><strong>{{ $factura['id_documento']['nombre'] }} # <?php echo $factura['prefijo'].'  '.$factura['numero'];?></strong></td>
						</tr>
						<tr>
							<td><strong>Fecha Emi / Ven</strong></td>
							<td><?php echo $factura['fecha'];?> / <?php echo $factura['fecha_vencimiento'];?></td>
						</tr>
						<tr>
							<td><strong>Sucursal</strong></td>
							<td><?php echo $factura['id_sucursal']['nombre'];?></td>
						</tr>
						<tr>
							<td><strong>Vendedor</strong></td>
							<td><?php echo $factura['id_vendedor']['nombre'] . ' ' . $factura['id_vendedor']['apellido'];?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		<br><br>

		<table style="width: 100%;">
			<tr>
				<td class="tg-yw4l" colspan="3"><strong>CLIENTE:</strong><br><?php echo $factura['id_cliente']['razon_social'];?></td>
				<td class="tg-yw4l" colspan="2"><strong>NIT:</strong><br> <?php echo $factura['id_cliente']['nit'];?></td>
				<td><strong>DIRECCION:</strong> <br><?php echo $factura['id_cliente']['direccion'];?></td>
				<td><strong>TELÉFONO:</strong><br> <?php echo $factura['id_cliente']['telefono'];?></td>
				<td><strong>CELULAR:</strong><br> <?php echo $factura['id_cliente']['telefono1'];?></td>
				<td><strong>CIUDAD:</strong><br> <?php echo $factura['id_cliente']['id_ciudad']['nombre'];?></td>
			</tr>
		</table>
		
		<br><br>

		<table style="width: 100%;border:1px solid #ddd">
			<thead>
				<tr>
					<th style="border:1px solid #ddd;background: #ddd"><strong>Iva</strong></th>
					<th style="border:1px solid #ddd;background: #ddd"><strong>Descripción</strong></th>
					<th style="border:1px solid #ddd;background: #ddd"><strong>Unidades</strong></th>
					<th style="border:1px solid #ddd;background: #ddd"><strong>Precio Unitario</strong></th>
					<th style="border:1px solid #ddd;background: #ddd"><strong>Precio</strong></th>
				</tr>
			</thead>
			<?php for($i=0;sizeof($kardex)>$i; $i++) { ?>
			<tr>
				<td>{{ $kardex[$i]['id_referencia']['iva'] }}</td>
				<td>{{ $kardex[$i]['id_referencia']['descripcion'] }}</td>
				<td>{{ $kardex[$i]['cantidad'] }}</td>
				<td>{{ number_format($kardex[$i]['precio'], 0, ",", ".") }}</td>
				<td><?php $tt = $kardex[$i]['precio'] * $kardex[$i]['cantidad']; ?>{{ number_format(($tt), 0, ",", ".") }}</td>
			</tr>
			<?php } ?>
			
		</table>

		<br><br>
		<table style="width: 100%">
			<tr>
				<td style="width: 40%"><strong>OBS:</strong> <?php echo $factura['observaciones'] ?></td></td>
				<td style="width: 60%">
					<table style="width: 100%;">
						<tr>
							<td><strong>Total parcial: </strong></td>
							<td>$ <?php echo number_format($factura['subtotal'], 0, ",", ".");?></td>
							<td><strong>IVA: </strong></td>
							<td>$ <?php echo number_format($factura['iva'], 0, ",", ".");?></td>
							<td><strong>Impoconsumo: </strong></td>
							<td>$ <?php echo number_format($factura['impoconsumo'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td><strong>Descuento:</strong></td>
							<td>$ <?php echo number_format($factura['descuento'], 0, ",", ".");?></td>
							<td><strong>Flete:</strong></td>
							<td>$ <?php echo number_format($factura['fletes'], 0, ",", ".");?></td>
							<td><strong>Retefuente:</strong></td>
							<td>$ <?php echo number_format($factura['retefuente'], 0, ",", ".");?></td>
						</tr>
						<tr style="background:#ddd">
							<td colspan="3"><strong>TOTAL FACTURA: </strong></td>
							<td colspan="3" style="text-align: right"><strong>$ <?php echo number_format($factura['total'], 0, ",", ".");?></strong></td>
						</tr>
					</table>
					
			</tr>
		</table>
		<br><br>
		<div style="width: 100%">
			<p>Documento impreso por software Intersoft. Calle 38 A 50 A 71 sur. Tel 3219045297. Impreso el dia </p>
		</div>
		
		
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
$(document).ready(function(){
    saveContabilidad();
});
function saveContabilidad(){
	idFactura = document.getElementById('idFactura').value;
    $.ajax({
        url:   '/contabilidad/generarfactura/'+idFactura,
        type:  'get',
        success:  function (response) {
            console.log(response);
        }
    });
}
//window.print();
</script>

<script>
	/*window.onunload = refreshParent;
	function refreshParent() {
		window.opener.location.reload();
	}*/
</script>
