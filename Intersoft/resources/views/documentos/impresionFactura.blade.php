<head>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta charset="UTF-8">
</head>
<style type="text/css">
	*{
		font-size: 12pt;
		font-family: 'Courier New', Courier, monospace;
		color:black;
	}
	.headtable{
		border-right: 1px dashed black; 
		border-bottom: 1px dashed black;
	}
	.headtablelast{
		border-bottom: 1px dashed black;
	}
	.bodytable{
		border-right: 1px dashed black;
	}
</style>
<style>
	.page-break {
		page-break-after: auto;
	}
	</style>

	<?php 
	$resolucion = App\Resoluciones::where('id_documento','=',$factura['id_documento']['id'])
									->where('prefijo','=',$factura['prefijo'])->first();
	?>
	
	
	<?php $paginas = sizeof($kardex)/5; ?>

	<div style="width: 100%;top:0;left: 0;padding: 2%;">
		<table style="width: 98%;">
			<tr>
				<td style="width: 35%">
					<!--<img style="width:120px;" src="https://wakusoft.com/img/logo_wakusoft.png">-->
					<!--<img style="width:120px;" src="/assets/img/empresas/{{ Session::get('id_empresa') }}.jpeg">-->
				</td>
				<td style="width: 30%">
					<table style="width: 100%">
						<tr><td><strong>{{ $factura['id_sucursal']['id_empresa']['razon_social'] }}</strong></td></tr>
						<tr><td><strong>NIT. {{ $factura['id_sucursal']['id_empresa']['nit_empresa'] }}</strong></td></tr>
						<tr><td>{{ $factura['id_sucursal']['id_empresa']['telefono'] }} - {{ $factura['id_sucursal']['id_empresa']['telefono1'] }}</td></tr>
						<tr><td>{{ $factura['id_sucursal']['id_empresa']['direccion'] }}</td></tr>
					</table>
				</td>
				<td style="width: 20%">
					<table style="width: 100%">
						<tr>
							<td style="text-align: right"><strong>{{ ($factura['id_documento']['nombre']=="Factura Electronica")?"FACTURA DE VENTA":$factura['id_documento']['nombre'] }}</strong>
							<br>
							<div ><?php echo $factura['prefijo'].'  '.$factura['numero'];?></div></td>
						</tr>
						<tr>
							<td style="text-align: right"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		@if(isset($resolucion))
			<div style="width: 100%;"><small style="font-size: 10px"> RESOL. {{ $resolucion['usuario_dian'] }} DE {{ $resolucion['fecha'] }} RANGO. {{ $resolucion['prefijo'] }} {{ $resolucion['rango_inicio'] }} - {{ $resolucion['prefijo'] }} {{ $resolucion['rango_final'] }} REGIMEN COMUN ACTIV ECON. {{ $resolucion['password_dian'] }} ICA: ICA {{ $resolucion['ica'] }}</small> <br></div>
		@endif

		<table style="width: 20%;border: 1px dashed black; float: left;">
			<tr>
				<td class="headtablelast" style="text-align: center"><strong >FECHA</strong></td>
			</tr>
			<tr>
				<td style="text-align: center"><?php echo $factura['fecha'];?></td>
			</tr>
		</table>

		<table style="width: 50%; float: left;border:1px dashed black;margin-left: 4%;margin-bottom: 2%;">
			<tr>
				<td style="text-align: center;">
					<?php echo $factura['id_cliente']['razon_social'];?><br>
					NIT. <?php echo $factura['id_cliente']['nit'];?><br>
					<?php echo $factura['id_cliente']['direccion'];?><br>
					Tel. <?php echo $factura['id_cliente']['telefono'];?>
					- <?php echo $factura['id_cliente']['telefono1'];?><br>
				</td>
			</tr>
		</table>

		<table style="width: 20%;border: 1px dashed black; float: left;margin-left: 4%;">
			<tr>
				<td class="headtablelast" style="text-align: center"><strong>VENCIMIENTO</strong></td>
			</tr>
			<tr>
				<td style="text-align: center"><?php echo $factura['fecha_vencimiento'];?></td>
			</tr>
		</table>
		
		<br>

		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="headtable"><strong>IVA</strong></th>
					<th class="headtable"><strong>CODIGO</strong></th>
					<th class="headtable"><strong>DESCRIPCIÓN</strong></th>
					<th class="headtable"><strong>CANTID.</strong></th>
					<th class="headtable"><strong>PRECIO/U</strong></th>
					<th class="headtablelast"><strong>PARCIAL</strong></th>
				</tr>
			</thead>
			<?php for($i=0;15>$i; $i++) { ?>
			@if(!isset($kardex[$i]))
			<tr>
				<td class="bodytable"><br></td>
				<td class="bodytable"><br></td>
				<td class="bodytable"><br></td>
				<td class="bodytable" style="text-align: right;"><br></td>
				<td class="bodytable" style="text-align: right;"><br></td>
				<td style="text-align: right;"><br></td>
			</tr>
			@else
			<tr>
				<td class="bodytable">{{ $kardex[$i]['id_referencia']['iva'] }}</td>
				<td class="bodytable">{{ $kardex[$i]['id_referencia']['codigo_interno'] }}</td>
				<td class="bodytable">{{ $kardex[$i]['id_referencia']['descripcion'] }}</td>
				<td class="bodytable" style="text-align: right;">{{ number_format($kardex[$i]['cantidad'], 0, ",", ".") }}</td>
				<td class="bodytable" style="text-align: right;">{{ number_format($kardex[$i]['precio'], 0, ",", ".") }}</td>
				<td style="text-align: right;"><?php $tt = $kardex[$i]['precio'] * $kardex[$i]['cantidad']; ?>{{ number_format(($tt), 0, ",", ".") }}</td>
			</tr>
			@endif
			<?php } ?>
			
		</table>

		<table style="width: 98%;">
			<tr>
				<td style="width: 70%"><div style="margin-left: 5%;">
					@if($factura['id_documento']['nombre']!="Compras")
					<div>FAVOR CONSIGNAR A LAS CUENTAS CORRIENTES: <BR>
						BOGOTA No. 037064961 BANCOLOMBIA No. 21589409081<BR>
						BANCO AGRARIO No. 302600000368<BR><BR>
						GENERADA POR SOFTWARE: INTERSOFT. TEL 3219045297<br><br>
					</div>
					@endif
				 <?php echo $factura['observaciones'] ?></div></td>
				<td style="width: 30%">
					<table style="width: 100%;border: 1px dashed black;">
						<tr>
							<td style="border-bottom: 1px dashed black;"><strong>SUBTOTAL </strong></td>
							<td style="text-align: right;border-bottom: 1px dashed black;">$ <?php echo number_format($factura['subtotal'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px dashed black;"><strong>RET. FTE</strong></td>
							<td style="text-align: right;border-bottom: 1px dashed black;">$ <?php echo number_format($factura['retefuente'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px dashed black;"><strong>I.V.A. </strong></td>
							<td style="text-align: right;border-bottom: 1px dashed black;">$ <?php echo number_format($factura['iva'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td><strong>TOTAL</strong></td>
							<td style="text-align: right"><strong >$ <?php echo number_format($factura['total'], 0, ",", ".");?></strong></td>
						</tr>
					</table>
					
			</tr>
		</table>


		<table style="width: 98%;border: 1px dashed black">
			<tr>
				<td>
					<div style="margin: 1%;font-size: 10px;text-align: justify;width: 98%">
						CLAUSULAS: 1. - LA PRESENTE FACTURA DE VENTA SE ASIMILA EN TODOS SUSU EFECOS A UN TITULO VALOR SEGUN LEY 1231
						DEL 2008. 2. - EN CASO DE MORA SE COBRARA EL MAXIMO INTERES AUTORIZADO POR LA LEY. 3. - SE HACE CONSTAR QUE LA 
						FIRMA DE UNA PERSONA DISTINTA DEL COMPRADOR IMPLICA QUE DICHA PERSONA ESTA AUTORIZADA EXPRESAMENTE POR EL COMPRADOR 
						PARA FIRMAR, CONFESAR LA DEUDA Y OBLIGAR AL COMPRADOR. 4. - RECIBI DE CONFORMIDAD LA MERCANCIA DE QUE TRATA 
						ESTA FACTURA Y ACEPTO EL VALOR ESTIPULADO EN LA MISMA.
					</div>
				</td>
			</tr>
		</table>

		<table style="width: 98%;">
			<tr>
				<td style="border: 1px dashed black;width: 24%;margin-left:2%"><?php echo $factura['id_vendedor']['nombre'] . ' ' . $factura['id_vendedor']['apellido'];?></td>
				<td style="border: 1px dashed black;width: 10%;margin-left:2%"></td>
				<td style="border: 1px dashed black;width: 30%;margin-left:2%">
				<table style="width: 100%;">
					<tr>
						<td style="border-bottom: 1px dashed black"><br>NOMBRE</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px dashed black">C.C.</td>
					</tr>
					<tr>
						<td>FECHA</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="width: 24%;text-align: center;">Firma Vendedor</td>
				<td style="width: 10%;text-align: center;">Cliente</td>
				<td style="width: 30%;text-align: center;"></td>
			</tr>
		</table>
		
		
	</div>

<script>
 window.print();
</script>

<script>
	/*window.onunload = refreshParent;
	function refreshParent() {
		window.opener.location.reload();
	}*/
</script>
