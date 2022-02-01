@extends('layout')

@section('content')

<style>

  .title{
      margin-left: 2%;
      font-weight: bold;
      font-family: Poppins;
  }
  .top-5-w{
      margin-top:5%;
  }
  .table > thead th {
      -webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
      -webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
      animation: pantallain 100s infinite;
      animation-direction: alternate;
  }
  
  </style>

<?php
if(isset($_GET['prefijo'])){
  $gastos = App\Gastocontados::where('id_empresa','=',Session::get('id_empresa'))
          ->where('prefijo','=',$_GET['prefijo'])
          ->where('numero','=',$_GET['numero'])
          ->get();
          
  $total = 0;
  if(sizeof($gastos)!=0){
    foreach ($gastos as $key => $value) {
      $value->id_tercero = App\Directorios::where('id','=',$value->id_tercero)->first();
      $value->id_auxiliar = App\Pucauxiliar::where('id','=',$value->id_auxiliar)->first();
      $total = $total + $value->valor;
    }
    $_GET['buscar'] = 'false';
  }
  else{
    $_GET['buscar'] = 'true';
  }
  
  $kardex_carteras = App\KardexCarteras::where('id_empresa','=',Session::get('id_empresa'))
          ->where('numeroFactura','=',$_GET['prefijo'].'|'.$_GET['numero'])
          ->first();
  if(isset($kardex_carteras)){
    $kardex_carteras->id_cartera = App\Carteras::where('id','=',$kardex_carteras->id_cartera)->first();
  }

}

?>


<div class="enc-article">
  <h4 class="title">Gastos de Contado</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

  <div class="panel panel-default col-md-12" >
      <!-- Default panel contents -->
    <form action="/cartera/gastocontados" method="post" name="formulario1">
      <div class="panel-heading row"><h5>Encabezado del Gasto</h5></div>
      <div class="panel-body" >
        <div class="row">
          <div class="col-md-2">
            <label>prefijo</label>
            <input type="text" placeholder="Prefijo" class="form-control" id="prefijo" name="prefijo" value="{{ isset($_GET['prefijo'])? $_GET['prefijo'] : 'GT' }}">
          </div>
          <div class="col-md-2">
            <label>numero</label>
            <input type="text" placeholder="Número" class="form-control" id="numero" name="numero" value="{{ isset($_GET['numero'])? $_GET['numero'] : '' }}">
          </div>
          <div class="col-md-3">
            <label>Fecha egreso</label>
            <input type="date" placeholder="fecha_egreso" class="form-control" id="fecha" name="fecha_egreso" value="{{ isset($_GET['prefijo'])? sizeof($gastos)!=0? $gastos[0]->fecha_egreso : '' : '' }}">
          </div>
          <div class="col-md-3">
            <label>Centro de costo</label>
            <input type="text" placeholder="centro costo" onkeyup="config.UperCase('centro_costo');"  class="form-control" id="centro_costo" name="centro_costo" value="{{ isset($_GET['prefijo'])? sizeof($gastos)!=0? $gastos[0]->centro_costo : '' : '' }}">
          </div>
          <div class="col-md-2">
            <br>
            <input type="submit" class="form-control btn btn-success" style="background: #3c763d;color:white;" value="Buscar" name="btnagregar">
          </div>
          <div class="col-md-12"><br><br></div>
          <table class="table table-hover col-md-12" >
            <thead>
              <tr>
                <th>Consecutivo</th>
                <th>Tercero</th>
                <th>PUC</th>
                <th>Valor</th>
                <th>Naturaleza</th>
                <th>Detalle</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if(isset($_GET['prefijo']))
                @if(sizeof($gastos)!=0)
                  @foreach ($gastos as $obj)
                  <?php $consec = $obj->consecutivo; ?>
                      <tr>
                        <td> {{ $obj->consecutivo }}</td>
                        <td> {{ $obj->id_tercero->nit }} - {{ $obj->id_tercero->razon_social }}</td>
                        <td> {{ $obj->id_auxiliar->codigo }} - {{ $obj->id_auxiliar->descripcion }}</td>
                        <td> {{ $obj->valor }}</td>
                        <td> {{ $obj->naturaleza }}</td>
                        <td> {{ $obj->detalle }}</td>
                        <td><a href="javascript:;" class="btn btn-danger" onclick="eliminar('{{ $obj }}')" >X</a></td>
                      </tr>
                  @endforeach
                @endif
              @endif
              <tr>
                <td><input type="number" placeholder="consecutivo" name="consecutivo" id="consecutivo" class="form-control" value="{{ isset($consec)?$consec + 1:'' }}"></td>
                <td>
                  <div class="row">
                    <input type="hidden" placeholder="id_tercero" name="id_tercero" id="id_tercero" class="col-md-6 form-control" >
                    <div class="col-md-6">
                      <input type="text" placeholder="Nit" name="nit" id="nit" class="col-md-6 form-control" >
                    </div>
                    <div class="col-md-6">
                      <input type="text" placeholder="Razon social" list="listaclientes"  name="razon_social" id="razon_social" class="col-md-6 form-control" >
                      <datalist id="listaclientes"></datalist>
                    </div>
                  </div>
                </td>
                <td>
                  <input type="hidden" placeholder="id_auxiliar" name="id_auxiliar" id="id_auxiliar" class="form-control" >
                  <div class="col-md-6">
                    <input type="text" placeholder="codigo" list="listacodigo" name="codigo" id="codigo" class="col-md-6 form-control" >
                    <datalist id="listacodigo"></datalist>
                  </div>
                  <div class="col-md-6">
                    <input type="text" placeholder="descripcion codigo"  disabled="true" name="descripcion_codigo" id="descripcion_codigo" class="col-md-6 form-control" >
                  </div>
                </td>
                <td><input type="number" placeholder="valor" name="valor" id="valor" class="form-control" ></td>
                <td><input type="text" placeholder="naturaleza" onkeyup="config.UperCase('naturaleza');"  name="naturaleza" id="naturaleza" class="form-control" ></td>
                <td><input type="text" placeholder="detalle" onkeyup="config.UperCase('detalle');"  name="detalle" id="detalle" class="form-control" ></td>
                <td><input type="submit" id="guardar" class="btn btn-success" value="Guardar"></td>
              </tr>
            
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

@if(isset($kardex_carteras))
<div>
  <h3>Se realizo el pago con el documento: {{ $kardex_carteras->id_cartera->tipoCartera }}  {{ $kardex_carteras->id_cartera->prefijo }} {{ $kardex_carteras->id_cartera->numero }}</h3>
</div>
@else
<div class="row top-11-w">
  <div class="col-md-6">
    <p style="font-size:10px">FORMA DE PAGO: </p>
    <table class="table table-bordered" style="width: 96%;margin-left: 2%;">
      <thead>
        <tr>
          <th>
            <select id="forma_pago" name="forma_pago" class="form-control">                      
              @foreach ($tipo_pagos as $obj)
              <option value="{{ $obj['id']}}">{{ $obj['nombre']}}</option>
              @endforeach
            </select>
          </th>
          <th>
            <input type="text" id="valor_pago" name="" class="form-control" placeholder="Valor" value="{{ isset($_GET['valor'])? $_GET['valor'] : isset($ingresos)? $ingresos[0]->valor : '' }}">
          </th>
          <th>
            <input type="text" id="observacion_pago" name="" value="NINGUNA" class="form-control" placeholder="Observacion">
          </th>
          <th><div class="btn btn-success form-control" onclick="carteras.getReferenciaPago()">+</div></th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="col-md-6">
    <p style="font-size:10px">Tabla que indica las formas de pago que serán incorporados en el egreso:</p> 
    <table id="tabla_forma_pago" class="table table-bordered" style="width: 96%;margin-left: 2%;">
      <thead>
        <tr>
          <th>Forma de Pago</th>
          <th>Valor</th>
          <th>Observaciones</th>
          <th></th>
        </tr>
      </thead>
    </table>
    <label>Total Forma Pago</label>
    <input type="text" class="form-control" id="total_forma_pago" value="" disabled="">
  </div>
</div>

<hr>
            
<div class="row top-11-w">
  <div class="col-sm-12">
    <div class="row titulo">
      <div>
        <label>Total</label>
        <input type="hidden" value="0" id="valor_efectivo" class="form-control" >
        <input type="hidden" value="0" id="valor_descuento" class="form-control" >
        <input type="hidden" value="0" id="valor_interes" class="form-control" >
        <input value="0" type="hidden" id="valor_retefuente" class="form-control" >
        <input type="hidden" value="0" id="valor_reteica" class="form-control" >
        <input value="0" type="hidden" id="valor_reteiva" class="form-control" >
        <input type="hidden" id="valor_flete" value="0" class="form-control" >
        <input type="number" name="total" id="total" class="form-control" value="{{ $total }}">
      </div>
      <div class="col-sm-12" style="height: 20px;"></div>
      <div class="col-sm-12">
        <label>CONDICIONES DE </label>
        <input id="observaciones" name="observaciones" class="form-control" value="SIN OBSERVACIONES" >
      </div>
      <div class="col-sm-12" style="height: 20px;"></div>
      <div class="col-sm-12">
        <div id="Guardar" class="btn btn-success form-control" onclick="carteras.save_documento('GASTOS');" style="background-color: #28a745;color:white;">GUARDAR</div>
      </div>
      <div class="col-sm-12" style="height: 20px;"></div>
    </div>
  </div>
</div>
@endif

<script>

function eliminar(data){
  data = JSON.parse(data);
  console.log(data);
  config.Redirect('/cartera/gastocontados/delete/'+data.id);
}


$('#nit').on('keydown', function(e) {
    if (e.key === "Tab") {
        buscarcliente($('#nit').val());
        return false;
    }
});

$('#razon_social').on('keydown', function(e) {
    if (e.key === "Tab") {
        buscarcliente2($('#razon_social').val());
        return false;
    }
});

  
function buscarcliente(texto){
    console.log(texto);
    if(texto.length > 3){
        var urls = "/administrador/diretorios/search/search";
        if($('#nit').val()==""){
            parametros = {
                "nit" : texto.trim(),
                "tipo" : "TERCEROS"
            };
        }
        else{
            parametros = {
                "razon_social" : $('#razon_social').val(),
                "tipo" : "TERCEROS"
            };
        }
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                console.log(response);
                if(response.body.length != 0){ // existe
                    cliente = response.body[0];
                    $('#id_tercero').val(cliente.id);
                    $('#nit').val(cliente.nit);
                    $('#razon_social').val(cliente.razon_social);
                    //$('#guardarCliente').hide();   
                }  
                else{
                    $('#id_tercero').val("");
                    $('#nit').val("");
                    $('#razon_social').val("");
                    //$('#guardarCliente').show();
                }              
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }
}

function buscarcliente2(texto){
    console.log(texto);
    if(texto.length > 3){
        var urls = "/administrador/diretorios/search/search";
        parametros = {
            "razon_social" : texto.trim(),
            "tipo" : "TERCEROS"
        };
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                console.log(response);
                if(response.body.length != 0){ // existe
                    cliente = response.body[0];
                    $('#listaclientes').find('option').remove();
                    for(i=0;response.body.length > i;i++){
                        $('#listaclientes').append('<option value="'+response.body[i].razon_social+'">"'+response.body[i].razon_social+'"</option>');
                    }
                    $('#nit').val(cliente.nit);
                    $('#id_tercero').val(cliente.id);
                    //$('#nombre').val(cliente.razon_social);
                    //$('#guardarCliente').hide();

                }  
                else{
                    $('#listaclientes').find('option').remove();
                    $('#nit').val("");
                    $('#id_tercero').val("");
                    $('#razon_social').val("");
                    //$('#guardarCliente').show();
                }              
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }
}
</script>

<script>


$('#codigo').on('keydown', function(e) {
    if (e.key === "Tab") {
      buscarauxiliar($('#codigo').val());
        return false;
    }
});

  
function buscarauxiliar(texto){
    console.log(texto);
    if(texto.length > 1){
        var urls = "/contabilidad/auxiliars/search/searchcode";
        parametros = {
            "codigo" : texto.trim()
        };
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                console.log(response);
                if(response.body.length != 0){ // existe
                    auxiliar = response.body[0];
                    $('#id_auxiliar').val(auxiliar.id);
                    $('#codigo').val(auxiliar.codigo);
                    $('#descripcion_codigo').val(auxiliar.descripcion);
                    $('#listacodigo').find('option').remove();
                    for(i=0;response.body.length > i;i++){
                        $('#listacodigo').append('<option value="'+response.body[i].codigo+'">"'+response.body[i].codigo+'"</option>');
                    }
                    //$('#guardarCliente').hide();   
                }  
                else{
                    $('#id_auxiliar').val("");
                    $('#codigo').val("");
                    $('#descripcion_codigo').val("");
                    //$('#guardarCliente').show();
                }              
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }
}
</script>
@endsection()