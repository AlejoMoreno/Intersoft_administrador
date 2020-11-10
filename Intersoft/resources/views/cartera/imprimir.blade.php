<head>
<meta charset="UTF-8">
</head>
<style type="text/css">
	*{
		font-size: 9px;
	}
</style>


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
	

	@if($carteras['tipoCartera'] == "GASTOS")

	<div style="width: 100%;top:0;left: 0;padding: 2%;">
		<table style="width: 98%;">
			<tr>
				<td style="width: 35%">
					<!--<img style="width:120px;" src="https://wakusoft.com/img/logo_wakusoft.png">-->
					<!--<img style="width:120px;" src="/assets/img/empresas/{{ Session::get('id_empresa') }}.jpeg">-->
				</td>
				<td style="width: 30%">
					<table style="width: 100%">
						<tr><td><strong>{{ $carteras['id_sucursal']['id_empresa']['razon_social'] }}</strong></td></tr>
						<tr><td><strong>NIT. {{ $carteras['id_sucursal']['id_empresa']['nit_empresa'] }}</strong></td></tr>
						<tr><td>{{ $carteras['id_sucursal']['id_empresa']['telefono'] }} - {{ $carteras['id_sucursal']['id_empresa']['telefono1'] }}</td></tr>
						<tr><td>{{ $carteras['id_sucursal']['id_empresa']['direccion'] }}</td></tr>
					</table>
				</td>
				<td style="width: 20%">
					<table style="width: 100%">
						<tr>
							<td style="text-align: right"><strong>Comprobante de {{ $carteras['tipoCartera'] }}</strong>
							<br>
							<div ><?php echo $carteras['prefijo'].'  '.$carteras['numero'];?></div></td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table style="width: 100%;border: 1px dashed black; float: left;">
			<tr>
				<td class="headtablelast" style="text-align: center"><strong >Codigo</strong></td>
				<td class="headtablelast" style="text-align: center"><strong >Concepto</strong></td>
				<td class="headtablelast" style="text-align: center"><strong >Valor</strong></td>
			</tr>
			
			
		</table>


	</div>
	@endif

	@if($carteras['tipoCartera'] == "EGRESOS")
	<div style="width: 100%;top:0;left: 0;padding: 2%;">
		<table style="width: 98%;">
			<tr>
				<td style="width: 35%">
					<!--<img style="width:120px;" src="https://wakusoft.com/img/logo_wakusoft.png">-->
					<!--<img style="width:120px;" src="/assets/img/empresas/{{ Session::get('id_empresa') }}.jpeg">-->
				</td>
				<td style="width: 30%">
					<table style="width: 100%">
						<tr><td><strong>{{ $carteras['id_sucursal']['id_empresa']['razon_social'] }}</strong></td></tr>
						<tr><td><strong>NIT. {{ $carteras['id_sucursal']['id_empresa']['nit_empresa'] }}</strong></td></tr>
						<tr><td>{{ $carteras['id_sucursal']['id_empresa']['telefono'] }} - {{ $carteras['id_sucursal']['id_empresa']['telefono1'] }}</td></tr>
						<tr><td>{{ $carteras['id_sucursal']['id_empresa']['direccion'] }}</td></tr>
					</table>
				</td>
				<td style="width: 20%">
					<table style="width: 100%">
						<tr>
							<td style="text-align: right"><strong>Doc. de {{ $carteras['tipoCartera'] }}</strong>
							<br>
							<div ><?php echo $carteras['prefijo'].'  '.$carteras['numero'];?></div></td>
						</tr>
						<tr>
							<td style="text-align: right"><?php echo $carteras['id_vendedor']['nombre'] . ' ' . $carteras['id_vendedor']['apellido'];?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		

		<table style="width: 20%;border: 1px dashed black; float: left;">
			<tr>
				<td class="headtablelast" style="text-align: center"><strong >FECHA</strong></td>
			</tr>
			<tr>
				<td style="text-align: center"><?php echo $carteras['fecha'];?></td>
			</tr>
		</table>

		<table style="width: 50%; float: left;border:1px dashed black;margin-left: 4%;margin-bottom: 2%;">
			<tr>
				<td style="text-align: center;">
					<?php echo $carteras['id_cliente']['razon_social'];?><br>
					NIT. <?php echo $carteras['id_cliente']['nit'];?><br>
					<?php echo $carteras['id_cliente']['direccion'];?><br>
					Tel. <?php echo $carteras['id_cliente']['telefono'];?>
					- <?php echo $carteras['id_cliente']['telefono1'];?><br>
				</td>
			</tr>
		</table>

		<table style="width: 20%;border: 1px dashed black; float: left;margin-left: 4%;">
			<tr>
				<td class="headtablelast" style="text-align: center"><strong>VENCIMIENTO</strong></td>
			</tr>
			<tr>
				<td style="text-align: center"></td>
			</tr>
		</table>
		
		<br>

		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>FACTURA</strong></th>
					<th class="tg-le8v headtable" style="width: 100px;"><strong>FECHA</strong></th>
					<th class="tg-le8v headtable"><strong>FLETE</strong></th>
					<th class="tg-le8v headtable"><strong>RETE. FTE</strong></th>
					<th class="tg-le8v headtable"><strong>RETE. IVA</strong></th>
					<th class="tg-le8v headtable"><strong>RETE. ICA</strong></th>
					<th class="tg-le8v headtable"><strong>INTERES</strong></th>
					<th class="tg-le8v headtable"><strong>DESC</strong></th> 
					<th class="tg-le8v headtable"><strong>EFECT.</strong></th>
					<th class="tg-le8v headtablelast"><strong>TOTAL</strong></th>
				</tr>
			</thead>
			<?php for($i=0;17>$i; $i++) { ?>
				@if(!isset($kardexCarteras[$i]))
					<tr>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l"><br></td>
					</tr>
				@else
					<tr>
						<td class="tg-yw4l bodytable">{{ $kardexCarteras[$i]['numeroFactura'] }}</td>
						<td class="tg-yw4l bodytable">{{ $kardexCarteras[$i]['fechaFactura'] }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['fletes'], 0, ",", ".") }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['retefuente'], 0, ",", ".") }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['reteiva'], 0, ",", ".") }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['reteica'], 0, ",", ".") }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['sobrecostos'], 0, ",", ".") }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['descuentos'], 0, ",", ".") }}</td>
						<td class="tg-yw4l bodytable">{{ number_format($kardexCarteras[$i]['efectivo'], 0, ",", ".") }}</td>
						<td class="tg-yw4l">{{ number_format(($kardexCarteras[$i]['total']), 0, ",", ".") }}</td>
					</tr>
				@endif
			<?php } ?>
		</table>

		<table style="width: 98%;">
			<tr>
				<td style="width: 70%"><div style="margin-left: 5%;">
				GENERADA POR SOFTWARE: INTERSOFT. TEL 3219045297<br><br>
				 <?php echo $carteras['observaciones'] ?></div></td>
				<td style="width: 30%">
					<table style="width: 100%;border: 1px dashed black;">
						<tr>
							<td style="border-bottom: 1px dashed black;"><strong>SUBTOTAL </strong></td>
							<td style="text-align: right;border-bottom: 1px dashed black;">$ <?php echo number_format($carteras['subtotal'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px dashed black;"><strong>RET. FTE</strong></td>
							<td style="text-align: right;border-bottom: 1px dashed black;">$ <?php echo number_format($carteras['retefuente'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px dashed black;"><strong>I.V.A. </strong></td>
							<td style="text-align: right;border-bottom: 1px dashed black;">$ <?php echo number_format($carteras['iva'], 0, ",", ".");?></td>
						</tr>
						<tr>
							<td><strong>TOTAL</strong></td>
							<td style="text-align: right"><strong >$ <?php echo number_format($carteras['total'], 0, ",", ".");?></strong></td>
						</tr>
					</table>
					
			</tr>
		</table>


		<table style="width: 98%;border: 1px dashed black">
			<tr>
				<td>
					<div style="margin: 1%;font-size: 10px;text-align: justify;width: 98%">
						CLAUSULAS: 1. - RECIBI DE CONFORMIDAD LA MERCANCIA DE QUE TRATA ESTA FACTURA Y ACEPTO EL VALOR ESTIPULADO EN LA MISMA.
					</div>
				</td>
			</tr>
		</table>

		<table style="width: 98%;">
			<tr>
				<td style="border: 1px dashed black;width: 24%;margin-left:2%"></td>
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
	@endif
	

<script>
 //window.print();
</script>

<script>
	/*window.onunload = refreshParent;
	function refreshParent() {
		window.opener.location.reload();
	}*/
</script>


