<head>
<head>
<meta charset="UTF-8">
</head>
<style type="text/css">
	*{
		font-size: 9px;
	}
</style>


<div style="width: 100%;top:0;left: 0;padding: 2%;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 20%">
				<!--<img style="width:120px;" src="https://wakusoft.com/img/logo_wakusoft.png">-->
				<img style="width:120px;" src="/assets/img/empresas/{{ Session::get('id_empresa') }}.jpeg">
			</td>
			<td style="width: 40%">
				<table style="width: 100%">
					<tr><td><strong>{{ $carteras['id_sucursal']['id_empresa']['razon_social'] }}</strong></td></tr>
					<tr><td><strong>NIT. {{ $carteras['id_sucursal']['id_empresa']['nit_empresa'] }}</strong></td></tr>
					<tr><td>{{ $carteras['id_sucursal']['id_empresa']['telefono'] }} - {{ $carteras['id_sucursal']['id_empresa']['telefono1'] }}</td></tr>
					<tr><td>{{ $carteras['id_sucursal']['correo'] }}</td></tr>
					<tr><td>{{ $carteras['id_sucursal']['id_empresa']['direccion'] }}</td></tr>
				</table>
			</td>
			<td style="width: 40%">
				<table style="width: 100%">
					<tr>
						<td><strong>{{ $carteras['tipoCartera'] }}</strong></td>
						<td><strong># <?php echo $carteras['prefijo'].'  '.$carteras['numero'];?></strong></td>
					</tr>
					<tr>
						<td><strong>Fecha Emi</strong></td>
						<td><?php echo $carteras['fecha'];?> </td>
					</tr>
					<tr>
						<td><strong>Sucursal</strong></td>
						<td><?php echo $carteras['id_sucursal']['nombre'];?></td>
					</tr>
					<tr>
						<td><strong>Usuario</strong></td>
						<td><?php echo $carteras['id_vendedor']['nombre'] . ' ' . $carteras['id_vendedor']['apellido'];?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	

	<table style="width: 100%;border:1px solid #ddd;">
		<tr>
			<td class="tg-yw4l" colspan="3"><strong>CLIENTE:</strong><br><?php echo $carteras['id_cliente']['razon_social'];?></td>
			<td class="tg-yw4l" colspan="2"><strong>NIT:</strong><br> <?php echo $carteras['id_cliente']['nit'];?></td>
			<td><strong>DIRECCION:</strong> <br><?php echo $carteras['id_cliente']['direccion'];?></td>
			<td><strong>TELÉFONO:</strong><br> <?php echo $carteras['id_cliente']['telefono'];?></td>
			<td><strong>CELULAR:</strong><br> <?php echo $carteras['id_cliente']['telefono1'];?></td>
			<td><strong>CIUDAD:</strong><br> <?php echo $carteras['id_cliente']['id_ciudad']['nombre'];?></td>
		</tr>
	</table>
	
	<br>

	<table style="width: 100%;">
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
			<td class="tg-yw4l">{{ $obj['fechaFactura'] }}</td>
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

	<br>
	<table style="width: 100%">
		<tr>
			<td style="width: 40%"><strong>OBS:</strong> <?php echo $carteras['observaciones'] ?></td></td>
			<td style="width: 60%">
				<table style="width: 100%;">
					<tr>
						<td><strong>Total parcial: </strong></td>
						<td>$ <?php echo number_format($carteras['subtotal'], 0, ",", ".");?></td>
						<td><strong>IVA: </strong></td>
						<td>$ <?php echo number_format($carteras['iva'], 0, ",", ".");?></td>
						<td><strong>Impoconsumo: </strong></td>
						<td>$ <?php echo number_format($carteras['impoconsumo'], 0, ",", ".");?></td>
					</tr>
					<tr>
						<td><strong>Descuento:</strong></td>
						<td>$ <?php echo number_format($carteras['descuento'], 0, ",", ".");?></td>
						<td><strong>Flete:</strong></td>
						<td>$ <?php echo number_format($carteras['fletes'], 0, ",", ".");?></td>
						<td><strong>Retefuente:</strong></td>
						<td>$ <?php echo number_format($carteras['retefuente'], 0, ",", ".");?></td>
					</tr>
					<tr style="background:#ddd">
						<td colspan="3"><strong>TOTAL: </strong></td>
						<td colspan="3" style="text-align: right"><strong>$ <?php echo number_format($carteras['total'], 0, ",", ".");?></strong></td>
					</tr>
				</table>
				
		</tr>
	</table>
	<div style="width: 100%">
		<p>Documento impreso por software Intersoft. Calle 38 A 50 A 71 sur. Tel 3219045297. <br><strong>Impreso el dia {{ date("Y-m-d") }}</strong></p>
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
//saveContabilidad();
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



