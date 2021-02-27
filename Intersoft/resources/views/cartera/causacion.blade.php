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

$prefijos = App\Resoluciones::where()->first();


if(isset($_GET['prefijo'])){
  $causaciones = App\Causaciones::where('id_empresa','=',Session::get('id_empresa'))
          ->where('prefijo','=',$_GET['prefijo'])
          ->where('numero','=',$_GET['numero'])
          ->get();
  foreach ($causaciones as $key => $value) {
    $value->id_tercero = App\Directorios::where('id','=',$value->id_tercero)->first();
    $value->id_tercero_auxiliar = App\Directorios::where('id','=',$value->id_tercero_auxiliar)->first();
    $value->id_auxiliar = App\Pucauxiliar::where('id','=',$value->id_auxiliar)->first();
  }
}

?>


<div class="enc-article">
  <h4 class="title">Causaciones</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

  <div class="panel panel-default col-md-12" >
      <!-- Default panel contents -->
    <!--<form action="/cartera/causacion" method="post" name="formulario1">-->
      <div class="panel-heading row"><h5>Encabezado de la causación</h5></div>
      <div class="panel-body" >
        <div class="row">
          <div class="col-md-1">
            <label>Prefijo</label>
            <input type="text"  placeholder="Prefijo" class="form-control" id="prefijo" name="prefijo" value="{{ isset($_GET['prefijo'])? $_GET['prefijo'] : '' }}">
          </div>
          <div class="col-md-1">
            <label>Número</label>
            <input type="text" placeholder="Número" class="form-control" id="numero" name="numero" value="{{ isset($_GET['numero'])? $_GET['numero'] : '' }}">
          </div>
          <div class="col-md-3">
            <label>Fecha</label>
            <input type="date" placeholder="fecha" class="form-control" id="fecha" name="fecha" value="{{ isset($causaciones)? $causaciones[0]->fecha : '' }}" >
          </div>          
          <div class="col-md-3">
            <label>Fecha vencimiento</label>
            <input type="date"  class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ isset($causaciones)? $causaciones[0]->fecha_vencimiento : '' }}">
          </div>
          <div class="col-md-3">
            <label>Centro de costo</label>
            <input type="text" placeholder="centro costo" onkeyup="config.UperCase('centro_costo');"  class="form-control" id="centro_costo" name="centro_costo" value="{{ isset($causaciones)? $causaciones[0]->centro_costo : '' }}">
          </div>
          <div class="col-md-4">
            <label>Tercero</label>
            <input type="hidden" placeholder="id_tercero"  class="form-control" id="id_tercero" name="id_tercero" value="{{ isset($causaciones)? $causaciones[0]->id_tercero->id : '' }}">
            <div class="row">
              <div class="col-md-6">
                <input type="text" placeholder="Nit" name="nit" id="nit" class="col-md-6 form-control" value="{{ isset($causaciones)? $causaciones[0]->id_tercero->nit : '' }}" >
              </div>
              <div class="col-md-6">
                <input type="text" placeholder="Razon social" list="listaclientes"  name="razon_social" id="razon_social" class="col-md-6 form-control" value="{{ isset($causaciones)? $causaciones[0]->id_tercero->razon_social : '' }}">
                <datalist id="listaclientes"></datalist>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <label>Factura</label>
            <input type="text" placeholder="Factura" onkeyup="config.UperCase('factura');"  class="form-control" id="factura" name="factura" value="{{ isset($causaciones)? $causaciones[0]->factura : '' }}">
          </div>
          <div class="col-md-3">
            <label>Neto a pagar</label>
            <input type="number" placeholder="neto pagar" onkeyup="config.UperCase('neto_pagar');"  class="form-control" id="neto_pagar" name="neto_pagar" value="{{ isset($causaciones)? $causaciones[0]->neto_pagar : '' }}">
          </div>
          <div class="col-md-3">
            <label>Detalle</label>
            <input type="text" placeholder="Detalle" onkeyup="config.UperCase('detalle');"  class="form-control" id="detalle" name="detalle" value="{{ isset($causaciones)? $causaciones[0]->detalle : '' }}">
          </div>
          <div class="col-md-2">
            <br>
            <div class="form-control btn btn-success" style="background: #3c763d;color:white;" name="btnagregar"> Buscar</div>
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
                <th>concepto</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if(isset($causaciones))
                @foreach ($causaciones as $obj)
                <?php $consec = $obj->consecutivo; ?>
                    <tr>
                      <td> {{ $obj->consecutivo }}</td>
                      <td> {{ $obj->id_tercero_auxiliar->nit }} - {{ $obj->id_tercero_auxiliar->razon_social }}</td>
                      <td> {{ $obj->id_auxiliar->codigo }} - {{ $obj->id_auxiliar->descripcion }}</td>
                      <td> {{ $obj->valor_auxiliar }}</td>
                      <td> {{ $obj->naturaleza }}</td>
                      <td><a href="javascript:;" class="btn btn-danger" onclick="eliminar('{{ $obj }}')" >X</a></td>
                    </tr>
                @endforeach
              @endif
              <tr>
                <td><input type="number" placeholder="consecutivo" name="consecutivo" id="consecutivo" class="form-control" value="{{ isset($consec)?$consec + 1:'' }}"></td>
                <td>
                  <div class="row">
                    <input type="hidden" placeholder="id_tercero_auxiliar" name="id_tercero_auxiliar" id="id_tercero_auxiliar" class="col-md-6 form-control" >
                    <div class="col-md-6">
                      <input type="text" placeholder="Nit" name="nit_tercero" id="nit_tercero" class="col-md-6 form-control" >
                    </div>
                    <div class="col-md-6">
                      <input type="text" placeholder="Razon social" list="listaclientes"  name="razon_social" id="razon_social" class="col-md-6 form-control" >
                      <datalist id="listaclientes1"></datalist>
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
                <td><input type="number" placeholder="valor_auxiliar" name="valor_auxiliar" id="valor_auxiliar" class="form-control" ></td>
                <td><input type="text" placeholder="naturaleza" onkeyup="config.UperCase('naturaleza');"  name="naturaleza" id="naturaleza" class="form-control" ></td>
                <td><input type="submit" id="guardar" class="btn btn-success" value="Guardar"></td>
              </tr>
            
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>

<script>

function eliminar(data){
  data = JSON.parse(data);
  console.log(data);
  config.Redirect('/cartera/causacion/delete/'+data.id);
}



$('#nombre').on('keydown', function(e) {
    if (e.key === "Enter") {
        buscarcliente2($('#nombre').val());
        return false;
    }
});

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
                    $('#id_tercero_auxiliar').val(cliente.id);
                    $('#nit').val(cliente.nit);
                    $('#nit_tercero').val(cliente.nit);
                    $('#razon_social').val(cliente.razon_social);
                    //$('#guardarCliente').hide();   
                }  
                else{
                    $('#id_tercero').val("");
                    $('#id_tercero_auxiliar').val("");
                    $('#nit').val("");
                    $('#nit_tercero').val();
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
                        $('#listaclientes1').append('<option value="'+response.body[i].razon_social+'">"'+response.body[i].razon_social+'"</option>');                   
                    }
                    $('#nit').val(cliente.nit);
                    $('#id_tercero').val(cliente.id);
                    $('#id_tercero_auxiliar').val(cliente.id);
                    $('#nit_tercero').val(cliente.nit);
                    //$('#nombre').val(cliente.razon_social);
                    //$('#guardarCliente').hide();

                }  
                else{
                    $('#listaclientes').find('option').remove();
                    $('#nit').val("");
                    $('#nit_tercero').val("");
                    $('#id_tercero').val("");
                    $('#id_tercero_auxiliar').val("");
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