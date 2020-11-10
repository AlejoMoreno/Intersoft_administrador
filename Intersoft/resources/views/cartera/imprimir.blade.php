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
		<br><br>

		<div style="width: 40%;float: left;">
			<br>
		</div>
		<table style="width: 58%;border: 1px dashed black; float: left;">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>GASTO</strong></th>
					<th class="tg-le8v headtable" style="width: 120px;"><strong>FECHA</strong></th>
					<th class="tg-le8v headtablelast" style="width: 110px;"><strong>TOTAL</strong></th>
				</tr>
			</thead>
			<?php for($i=0;2>$i; $i++) { ?>
				@if(!isset($kardexCarteras[$i]))
					<tr>
						<td class="tg-yw4l bodytable"><br></td>
						<td class="tg-yw4l bodytable" style="width: 120px;"><br></td>
						<td class="tg-yw4l" style="width: 110px;"><br></td>
					</tr>
				@else
					<tr>
						<td class="tg-yw4l bodytable">{{ $kardexCarteras[$i]['numeroFactura'] }}</td>
						<td class="tg-yw4l bodytable" style="width: 120px;text-align: center">{{ $kardexCarteras[$i]['fechaFactura'] }}</td>
						<td class="tg-yw4l" style="width: 110px;text-align: right">{{ number_format(($kardexCarteras[$i]['total']), 0, ",", ".") }}</td>
					</tr>
				@endif
			<?php } ?>
		</table>

		<br><br>

		<?php 
		$gastoscontados = App\Gastocontados::where('id_empresa','=',Session::get('id_empresa'))
			->where('prefijo','=',explode('|',$kardexCarteras[0]['numeroFactura'])[0])
			->where('numero','=',explode('|',$kardexCarteras[0]['numeroFactura'])[1])
			->get();
		foreach ($gastoscontados as $value) {
			$value->id_auxiliar = App\Pucauxiliar::where('id','=',$value->id_auxiliar)->first();
			$value->id_tercero = App\Directorios::where('id','=',$value->id_tercero)->first();
		}
		?>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>CÓDIGO</strong></th>
					<th class="tg-le8v headtable" style="width: 100px;"><strong>CONCEPTO</strong></th>
					<th class="tg-le8v headtable" style="width: 120px;"><strong>TERCERO</strong></th>
					<th class="tg-le8v headtablelast" style="width: 110px;"><strong>VALOR</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;17>$i; $i++) { ?>
					@if(!isset($gastoscontados[$i]))
						<tr>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l bodytable" style="width: 120px;"><br></td>
							<td class="tg-yw4l" style="width: 110px;"><br></td>
						</tr>
					@else
						<tr>
							<td class="tg-yw4l bodytable">{{ $gastoscontados[$i]['id_auxiliar']['codigo'] }} {{ $gastoscontados[$i]['naturaleza'] }}</td>
							<td class="tg-yw4l bodytable">{{ $gastoscontados[$i]['id_auxiliar']['descripcion'] }} </td>
							<td class="tg-yw4l bodytable" style="width: 120px;font-size: 10px;">{{ $gastoscontados[$i]['id_tercero']['nit'] }} {{ $gastoscontados[$i]['id_tercero']['razon_social'] }} </td>
							<td class="tg-yw4l" style="width: 110px;text-align: right">{{ number_format(($gastoscontados[$i]['valor']), 0, ",", ".") }}</td>
						</tr>
					@endif
				<?php } ?>
			</tbody>
		</table>

		<?php 
		$forma_pagos = App\Formapagos::where('id_cartera','=',$carteras->id)->get();
		foreach ($forma_pagos as $value) {
			$value->formaPago = App\Tipopagos::where('id','=',$value->formaPago)->first();
		}
		?>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>FORMA PAGO</strong></th>
					<th class="tg-le8v headtable"><strong>BANCO</strong></th>
					<th class="tg-le8v headtablelast" style="width: 236px;"><strong>DESCRIPCION</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;3>$i; $i++) { ?>
					@if(!isset($forma_pagos[$i]))
						<tr>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l"><br></td>
						</tr>
					@else
						<tr>
							<td class="tg-yw4l bodytable">{{ $forma_pagos[$i]['formaPago']['nombre'] }} </td>
							<td class="tg-yw4l bodytable">{{ $forma_pagos[$i]['id_banco'] }} </td>
							<td class="tg-yw4l" style="font-size: 10px;">{{ $forma_pagos[$i]['observacion'] }} </td>
						</tr>
					@endif
				<?php } ?>
			</tbody>
		</table>
		<br><br>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>PREPARADO</strong></th>
					<th class="tg-le8v headtable"><strong>REVISADO</strong></th>
					<th class="tg-le8v headtable"><strong>APROBADO</strong></th>
					<th class="tg-le8v headtablelast"><strong>CONTABILIZADO</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tg-yw4l bodytable" style="height: 100px"></td>
					<td class="tg-yw4l bodytable" style="height: 100px"></td>
					<td class="tg-yw4l bodytable" style="height: 100px"></td>
					<td class="tg-yw4l" style="height: 100px"></td>
				</tr>
			</tbody>
						
		</table>




	</div>
	@endif

	@if($carteras['tipoCartera'] == "OTROINGRESO")

	<div style="width: 100%;top:0;left: 0;padding: 2%;">
		<table style="width: 98%;">
			<tr>
				<td style="width: 100%">
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

		<table style="width: 98%;border: 1px dashed black; float: left;">
			<thead>
				<tr>
					<td class="tg-le8v ">
						<div style="float: left"><strong>RECIBI DE: </strong> {{ $carteras['id_cliente']['razon_social'] }} </div> <div style="float: right"><strong>NIT/C.C. {{ $carteras['id_cliente']['nit'] }}</strong></div><br>
						<div style="float: left"><strong>VALOR: {{ $carteras['total'] }}</strong></div> <div style="float: right"><strong>FECHA: {{ $carteras['fecha'] }}</strong></div><br>
					</td>
				</tr>
			</thead>
		</table>

		<br><br>

		<?php 
		$otrosingresos = App\Otrosingresos::where('id_empresa','=',Session::get('id_empresa'))
			->where('prefijo','=',explode('|',$kardexCarteras[0]['numeroFactura'])[0])
			->where('numero','=',explode('|',$kardexCarteras[0]['numeroFactura'])[1])
			->get();
		foreach ($otrosingresos as $value) {
			$value->id_auxiliar = App\Pucauxiliar::where('id','=',$value->id_auxiliar)->first();
			$value->id_tercero = App\Directorios::where('id','=',$value->id_tercero)->first();
		}
		?>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>CÓDIGO</strong></th>
					<th class="tg-le8v headtable" style="width: 100px;"><strong>CONCEPTO</strong></th>
					<th class="tg-le8v headtable" style="width: 120px;"><strong>TERCERO</strong></th>
					<th class="tg-le8v headtablelast" style="width: 110px;"><strong>VALOR</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;5>$i; $i++) { ?>
					@if(!isset($otrosingresos[$i]))
						<tr>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l bodytable" style="width: 120px;"><br></td>
							<td class="tg-yw4l" style="width: 110px;"><br></td>
						</tr>
					@else
						<tr>
							<td class="tg-yw4l bodytable">{{ $otrosingresos[$i]['id_auxiliar']['codigo'] }} {{ $otrosingresos[$i]['naturaleza'] }}</td>
							<td class="tg-yw4l bodytable">{{ $otrosingresos[$i]['id_auxiliar']['descripcion'] }} </td>
							<td class="tg-yw4l bodytable" style="width: 120px;font-size: 10px;">{{ $otrosingresos[$i]['id_tercero']['nit'] }} {{ $otrosingresos[$i]['id_tercero']['razon_social'] }} </td>
							<td class="tg-yw4l" style="width: 110px;text-align: right">{{ number_format(($otrosingresos[$i]['valor']), 0, ",", ".") }}</td>
						</tr>
					@endif
				<?php } ?>
			</tbody>
		</table>

		<?php 
		$forma_pagos = App\Formapagos::where('id_cartera','=',$carteras->id)->get();
		foreach ($forma_pagos as $value) {
			$value->formaPago = App\Tipopagos::where('id','=',$value->formaPago)->first();
		}
		?>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>FORMA PAGO</strong></th>
					<th class="tg-le8v headtable"><strong>BANCO</strong></th>
					<th class="tg-le8v headtablelast" style="width: 236px;"><strong>DESCRIPCION</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;3>$i; $i++) { ?>
					@if(!isset($forma_pagos[$i]))
						<tr>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l bodytable"><br></td>
							<td class="tg-yw4l"><br></td>
						</tr>
					@else
						<tr>
							<td class="tg-yw4l bodytable">{{ $forma_pagos[$i]['formaPago']['nombre'] }} </td>
							<td class="tg-yw4l bodytable">{{ $forma_pagos[$i]['id_banco'] }} </td>
							<td class="tg-yw4l" style="font-size: 10px;">{{ $forma_pagos[$i]['observacion'] }} </td>
						</tr>
					@endif
				<?php } ?>
			</tbody>
		</table>
		<br><br>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>PREPARADO</strong></th>
					<th class="tg-le8v headtable"><strong>REVISADO</strong></th>
					<th class="tg-le8v headtable"><strong>APROBADO</strong></th>
					<th class="tg-le8v headtablelast"><strong>CONTABILIZADO</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l" style="height: 20px"></td>
				</tr>
			</tbody>
						
		</table>




	</div>
	@endif
	
	@if($carteras['tipoCartera'] == "GASTOCAUSADO")
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
		
		

		<table style="width: 98%;border: 1px dashed black; float: left;">
			<thead>
				<tr>
					<td class="tg-le8v ">
						<div style="float: left"><strong> PROVEEDOR: </strong> {{ $carteras['id_cliente']['razon_social'] }} </div> <div style="float: right"><strong>NIT/C.C. {{ $carteras['id_cliente']['nit'] }}</strong></div><br>
						<div style="float: left"><strong>VALOR: {{ $carteras['total'] }}</strong></div> <div style="float: right"><strong>FECHA: {{ $carteras['fecha'] }}</strong></div><br>
					</td>
				</tr>
			</thead>
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
		<br>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>PREPARADO</strong></th>
					<th class="tg-le8v headtable"><strong>REVISADO</strong></th>
					<th class="tg-le8v headtable"><strong>APROBADO</strong></th>
					<th class="tg-le8v headtablelast"><strong>CONTABILIZADO</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l" style="height: 20px"></td>
				</tr>
			</tbody>
						
		</table>
		
		
	</div>
	@endif

	@if($carteras['tipoCartera'] == "EGRESO")
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
		
		

		<table style="width: 98%;border: 1px dashed black; float: left;">
			<thead>
				<tr>
					<td class="tg-le8v ">
						<div style="float: left"><strong> PROVEEDOR: </strong> {{ $carteras['id_cliente']['razon_social'] }} </div> <div style="float: right"><strong>NIT/C.C. {{ $carteras['id_cliente']['nit'] }}</strong></div><br>
						<div style="float: left"><strong>VALOR: {{ $carteras['total'] }}</strong></div> <div style="float: right"><strong>FECHA: {{ $carteras['fecha'] }}</strong></div><br>
					</td>
				</tr>
			</thead>
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
		<br>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>PREPARADO</strong></th>
					<th class="tg-le8v headtable"><strong>REVISADO</strong></th>
					<th class="tg-le8v headtable"><strong>APROBADO</strong></th>
					<th class="tg-le8v headtablelast"><strong>CONTABILIZADO</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l" style="height: 20px"></td>
				</tr>
			</tbody>
						
		</table>
		
		
	</div>
	@endif
	

	@if($carteras['tipoCartera'] == "INGRESO")
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
							<td style="text-align: right"><strong>Recibo de caja</strong>
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
		
		

		<table style="width: 98%;border: 1px dashed black; float: left;">
			<thead>
				<tr>
					<td class="tg-le8v ">
						<div style="float: left"><strong> CLIENTE: </strong> {{ $carteras['id_cliente']['razon_social'] }} </div> <div style="float: right"><strong>NIT/C.C. {{ $carteras['id_cliente']['nit'] }}</strong></div><br>
						<div style="float: left"><strong>VALOR: {{ $carteras['total'] }}</strong></div> <div style="float: right"><strong>FECHA: {{ $carteras['fecha'] }}</strong></div><br>
					</td>
				</tr>
			</thead>
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
		<br>
		<table style="width: 98%;border: 1px dashed black">
			<thead>
				<tr>
					<th class="tg-le8v headtable"><strong>PREPARADO</strong></th>
					<th class="tg-le8v headtable"><strong>REVISADO</strong></th>
					<th class="tg-le8v headtable"><strong>APROBADO</strong></th>
					<th class="tg-le8v headtablelast"><strong>CONTABILIZADO</strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l bodytable" style="height: 20px"></td>
					<td class="tg-yw4l" style="height: 20px"></td>
				</tr>
			</tbody>
						
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


