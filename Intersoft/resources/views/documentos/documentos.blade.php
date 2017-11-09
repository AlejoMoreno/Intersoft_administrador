@extends('layout')

@section('content')


<div class="container">
	<div class="well well-lg" style="padding-bottom: 5%;">
		<center><h3>{{nombre.documento}}</h3></center><hr>
		<label style="float: left;padding-right: 4%;">NÚMERO {{nombre.documento}}: </label><input type="text" name="sucursal" id="sucursal" class="form-control" style="float: left;width: 100px;margin-right: 4%;" placeholder="sucursal" disabled><input type="text" name="Prefijo" id="Prefijo" class="form-control" style="float: left;width: 100px;margin-right: 4%;" placeholder="Prefijo"><input type="text" name="Numero_documento" id="Numero_documento" class="form-control" style="float: left;width: 100px;margin-right: 4%;" placeholder="Número">
	</div>
	<div class="well well-lg">
		<table class="encabezado">
			<tr>
				<th>{{tipo.tercero}}</th>
				<th>FECHA EMISIÓN</th>
				<th>FECHA VENCIMIENTO</th>
			</tr>
			<tbody>
			<tr>
				<td><select class="form-control" id="nombreTercero" name="nombreTercero">
					<option value="">SELECCIONE {{tipo.tercero}}</option>
					</select></td>
				<td><input class="form-control" type="date" name="fechaEmision" id="fechaEmision"></td>
				<td><input class="form-control" type="date" name="fechaVencimiento" id="fechaVencimiento"></td>
			</tr>
			<tr>
				<th>NIT / CÉDULA <img width="20" onclick="redirect('administrador/tercero.html');" src="https://image.flaticon.com/icons/svg/148/148764.svg"></th>
				<th>VENDEDOR <img width="20" onclick="redirect('administrador/tercero.html');" src="https://image.flaticon.com/icons/svg/148/148764.svg"></th>
				<th>OTRO TERCERO <img width="20" onclick="redirect('administrador/tercero.html');" src="https://image.flaticon.com/icons/svg/148/148764.svg"></th>
				<th></th>
			</tr>
			<tr>
				<td><input class="form-control" type="text" name="nitTercero" id="nitTercero" placeholder="ej.(1030570356)" disabled></td>
				<td><select class="form-control" id="vendedor" name="vendedor">
					<option value="">SELECCIONE {{tipo.vendedor}}</option>
					</select></td>
				<td><select class="form-control" id="vendedor" name="vendedor">
					<option value="">SELECCIONE {{tipo.tercero}}</option>
					</select></td>
				<td></td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="well well-lg">
		<table>
			<tr>
				<th></th>
				<th>REFERENCIA</th>
				<th>DESCRIPCIÓN</th>
				<th>LOTE</th>
				<th>FECHA VENCE.</th>
				<th>DSC.%</th>
				<th>INC.%</th>
				<th>CANTIDAD</th>
				<th>VALOR UNID.</th>
			</tr>
			<tbody>
				<tr>
					<td>1</td>
					<td><input type="text" name="referencia" id="referencia" class="form-control" style="width: 100px;"></td>
					<td><input type="text" name="descripcion" id="descripcion" class="form-control" style="width: 500px;"></td>
					<td><input type="text" name="lote" id="lote" class="form-control" style="width: 100px;"></td>
					<td><input type="text" name="fechavence" id="fechavence" class="form-control" style="width:120px;"></td>
					<td><input type="text" name="dsc" id="dsc" class="form-control" style="width: 80px;"></td>
					<td><input type="text" name="incremento" id="incremento" class="form-control" style="width: 80px;"></td>
					<td><input type="text" name="cantidad" id="cantidad" class="form-control" style="width: 80px;"></td>
					<td><input type="text" name="valorUnd" id="valorUnd" class="form-control" style="width: 100px;"></td>
				</tr>
				<tr>
					<td>2</td>
					<td><input type="text" name="referencia" id="referencia" class="form-control" style="width: 100px;"></td>
					<td><input type="text" name="descripcion" id="descripcion" class="form-control" style="width: 500px;"></td>
					<td><input type="text" name="lote" id="lote" class="form-control" style="width: 100px;"></td>
					<td><input type="text" name="fechavence" id="fechavence" class="form-control" style="width:120px;"></td>
					<td><input type="text" name="dsc" id="dsc" class="form-control" style="width: 80px;"></td>
					<td><input type="text" name="incremento" id="incremento" class="form-control" style="width: 80px;"></td>
					<td><input type="text" name="cantidad" id="cantidad" class="form-control" style="width: 80px;"></td>
					<td><input type="text" name="valorUnd" id="valorUnd" class="form-control" style="width: 100px;"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="well well-lg">
		<table class="pie">
			<tr>
				<th>SUBTOTAL</th>
				<th>FLETES</th>
				<th>IVA</th>
				<th>RETE.ICA</th>
				<th>DESCUENTO</th>
			</tr>
			<tr>
				<td><input class="form-control" type="" name="subtotal" id="subtotal"></td>
				<td><input class="form-control" type="" name="fletes" id="fletes"></td>
				<td><input class="form-control" type="" name="iva" id="iva"></td>
				<td><input class="form-control" type="" name="reteica" id="reteica"></td>
				<td><input class="form-control" type="" name="descuento" id="descuento"></td>
			</tr>
			<tr>
				<th>RETEFUENTE</th>
				<th>RETEIVA</th>
				<th>IMPO.CONSUMO</th>
				<th>TOTAL</th>
				<th>FORMA PAGO</th>
			</tr>
			<tr>
				<td><input class="form-control" type="" name="retefuente" id="retefuente"></td>
				<td><input class="form-control" type="" name="reteiva" id="reteiva"></td>
				<td><input class="form-control" type="" name="impoconsmo" id="impoconsmo"></td>
				<td><input class="form-control" type="" name="total" id="total"></td>
				<td><select class="form-control" name="formaPago" id="formaPago">
					<option value="">Seleccione la forma de pago</option>
				</select></td>
			</tr>
		</table>
		<br><br>
		<button type="button" style="width: 100%;" class="btn btn-primary">Guardar</button>
	</div>
</div>
<style type="text/css">
.encabezado td{padding-right: 5%;padding-bottom: 4%;padding-top: 3%;}
.pie td{padding-right: 5%;padding-bottom: 4%;padding-top: 3%;}
</style>


@endsection()