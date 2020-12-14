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
$tipo_pagos = App\Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
$usuarios = App\Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
$ciudades = App\Ciudades::where('id','>','0')->orderBy('nombre','asc')->get();
?>


<div class="enc-article">
  <h4 class="title">Control de pago a terceros</h4>
  <input type="text" class="form-control " style="width: 100px;position: absolute;top: 25%;left: 35%;" id="prefijo" value="{{ $documento['prefijo'] }}">
  <input type="text" class="form-control " style="width: 100px;position: absolute;top: 25%;left: 45%;" id="numero" value="{{ $documento['numero'] + 1 }}">
</div>

<div class="row top-11-w">
    
  <div class="card" style="margin:3%;">
      <div class="header row" style="background:#dbdbdb">
          <h4 class="title col-md-12" style="color:black;">Datos terceros<hr></h4>
          <div class="col-md-4">
              <label>Nit:</label>
              <input type="text" name="cedula_tercero" value=""  id="cedula_tercero" placeholder="nit" class="form-control" onkeyup="buscarcliente(this.value)">
              <p style="font-size:10px;color:black;" id="resCliente">Para buscar el Tercero debe tener un minimo de 3 caracteres</p>
              
          </div>
          <div class="col-md-4">
              <label>Razón Social:</label>
              <input type="text" name="nombre" list="listaclientes"  id="nombre" placeholder="Razón Social" class="form-control" >
              <datalist id="listaclientes"></datalist>
          </div>
          <div class="col-md-4">
              <label>Dirección:</label>
              <input type="text" name="direccion"  id="direccion" placeholder="Dirección" class="form-control" >
          </div>
          <div class="col-md-4">
              <label>Teléfono:</label>
              <input type="text" name="telefono"  id="telefono" placeholder="Teléfono" class="form-control" >
          </div>
          <div class="col-md-2">
              <label>Correo:</label>
              <input type="text" name="correo"  id="correo" placeholder="Correo" class="form-control" >
          </div>
          <div class="col-md-2">
              <label>Ciudad:</label>
              <select name="id_ciudad" class="form-control"  id="id_ciudad">
                  @foreach ( $ciudades as $ciudad)
                  <option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }} - {{ $ciudad['codigo'] }}</option>
                  @endforeach
              </select>
          </div>
          
          <div class="col-md-6" style="margin-bottom:2%;">
              <label>Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" onkeyup="documentos.fechaActual(event)" >
          </div>
          <input type="hidden" name="id_modificado" id="id_modificado" class="form-control" value="{{ Session::get('user_id') }}" placeholder="Esciba el nombre del vendedor">        
          
      </div>
  </div>
  
</div>

<div class="row top-11-w">
  <div class="col-md-3">
    <p style="font-size:10px;">Agrega gastos al recibo de pago</p>
    <div id="tabla_facturas" style="width: 100%;overflow:scroll;"></div>
    <div class="col-sm-12">
      Nota: <br>
      Si desea <strong>eliminar un producto</strong> primero seleccione la fila y dirijase al boton eliminar.<br>
      <div class="btn btn-danger" onclick="carteras.eliminar();">Eliminar</div><br>
      Si ha <strong>terminado de registrar</strong> las facturas dirijase a escoger la forma de pago.<br><br><br>
    </div>
  </div>

  <div class="col-md-9">
    <p style="margin-left: 20px;font-size:10px;">Tabla que indica los documentos que serán incorporados en el egreso:</p> 
    <div style="overflow-x:scroll">
      <table id="tabla_facturas_seleccionadas" class="table table-bordered" style="width: 96%;margin-left: 2%;">
        <thead>
          <tr>
            <th><input type="checkbox" name="" id="checkbox_noname"> </th>
            <th>Prefijo</th>
            <th># Factura</th>
            <th>Fecha Factura</th>
            <th>Flete</th>
            <th>ReteF.</th>
            <th>ReteIva.</th>
            <th>ReteIca.</th>
            <th>Interes</th>
            <th>Desc</th>
            <th>Efectivo</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  
</div>

<hr>

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
            <input type="text" id="valor_pago" name="" class="form-control" placeholder="Valor">
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
      <div class="col-sm-3">
        <label>Fletes</label>
        <input type="text" id="valor_flete" value="0" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>Retefuente</label>
        <input value="0" type="text" id="valor_retefuente" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>Reteiva</label>
        <input value="0" type="text" id="valor_reteiva" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>Reteica</label>
        <input type="text" value="0" id="valor_reteica" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>InteresL</label>
        <input type="text" value="0" id="valor_interes" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>Descuento</label>
        <input type="text" value="0" id="valor_descuento" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>Efectivo</label>
        <input type="text" value="0" id="valor_efectivo" class="form-control" disabled="">
      </div>
      <div class="col-sm-3">
        <label>TOTAL</label>
        <input type="number" name="total" id="total" class="form-control" disabled="">
      </div>
      <div class="col-sm-12" style="height: 20px;"></div>
      <div class="col-sm-12">
        <label>CONDICIONES DE </label>
        <input id="observaciones" name="observaciones" class="form-control" value="SIN OBSERVACIONES" >
      </div>
      <div class="col-sm-12" style="height: 20px;"></div>
      <div class="col-sm-12">
        <div id="Guardar" class="btn btn-success form-control" onclick="carteras.save_documento('GASTOCAUSADO');" style="background-color: #28a745;color:white;">GUARDAR</div>
        <div id="imprimirPOST" onclick="carteras.imprimirPost();" class="btn btn-warning form-control" style="background-color: white;">Imprimir Pos</div>
        <div id="imprimirDOC" onclick="carteras.imprimir();" class="btn btn-danger form-control" style="background-color: white;">Imprimir Documento</div>
      </div>
      <div class="col-sm-12" style="height: 20px;"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#imprimirPOST').hide();
  $('#imprimirDOC').hide();

  $('#checkbox_noname').change(function(){
    var tabla = document.getElementById("tabla_productos");
    if($(this).is(":checked")){
      for (var i=1;i < tabla.rows.length; i++){  
        id = document.getElementById(tabla.rows[i].cells[0].getElementsByTagName("input")[0].id);
        id.checked = true;
        var padre = id.parentNode.parentNode;
        padre.style.background = "#4262d3";
        padre.style.color = "#ffffff";
      }
    }
    else{
      for (var i=1;i < tabla.rows.length; i++){  
        id = document.getElementById(tabla.rows[i].cells[0].getElementsByTagName("input")[0].id);
        id.checked = false;
        var padre = id.parentNode.parentNode;
        padre.style.background = "#ffffff";
        padre.style.color = "#000000";
      }
    }
  });
</script>

<script type="text/javascript">
  //document.getElementById('prefijo').focus();
</script>


<script>
  // functiones para el cliente create y buscar
  function guardarCliente(){
      var urls = "/administrador/diretorios/addtercero";
      parametros = {
          "nit" : $('#cedula_tercero').val().trim(),
          "id_ciudad": $('#id_ciudad').val(),
          "razon_social": $('#nombre').val(),
          "direccion" : $('#direccion').val(),
          "correo" : $('#correo').val(),
          "telefono" : $('#telefono').val(),
          "id_directorio_tipo_tercero" : "2"
      };
      if(parametros.razon_social == "" || parametros.direccion == "" || parametros.correo == "" || parametros.telefono == ""   ){
          swal({
              title: "Algo anda mal",
              text: "Verifique los datos del cliente ya que hacen falta",
              icon: "error",
              button: "Aceptar",
          });
          return 0;
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
                  buscarcliente(response.body.nit);
                  
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
  
  function buscarcliente(texto){
      console.log(texto);
      if(texto.length > 3){
          var urls = "/administrador/diretorios/search/search";
          parametros = {
              "nit" : texto.trim(),
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
                      $('#cedula_tercero').val(cliente.nit);
                      $('#nombre').val(cliente.razon_social);
                      $('#direccion').val(cliente.direccion);
                      $('#telefono').val(cliente.telefono);
                      $('#correo').val(cliente.correo); 
                      $('#id_ciudad').val(cliente.id_ciudad);
                      $('#nombre').prop( "disabled", true );  
                      $('#direccion').prop( "disabled", true );  
                      $('#telefono').prop( "disabled", true );  
                      $('#correo').prop( "disabled", true );    
                      $('#id_ciudad').prop("disabled", true);
                      $('#guardarCliente').hide();   
                      $('#resCliente').text("Proveedor existe");     
                      allDocumentos();      
                  }  
                  else{
                      $('#nombre').val("");
                      $('#cedula_tercero').val("");
                      $('#direccion').val("");
                      $('#telefono').val("");
                      $('#correo').val("");
                      $('#nombre').prop( "disabled", false );  
                      $('#direccion').prop( "disabled", false );  
                      $('#telefono').prop( "disabled", false );  
                      $('#correo').prop( "disabled", false ); 
                      $('#id_ciudad').prop("disabled", false);
                      $('#guardarCliente').show();
                      $('#resCliente').text("Proveedor no existe, si desea crearlo, diligencie los datos restantes");               
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
                    $('#cedula_tercero').val(cliente.nit);
                    $('#id_tercero').val(cliente.id);
                    $('#id_tercero_auxiliar').val(cliente.id);
                    $('#nit_tercero').val(cliente.nit);
                    //$('#nombre').val(cliente.razon_social);
                    //$('#guardarCliente').hide();
                    allDocumentos();
                }  
                else{
                    $('#listaclientes').find('option').remove();
                    $('#cedula_tercero').val("");
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

function allDocumentos(){
    parametros = {
        "tipo" : "causacion"
    };
    $.ajax({
        data:  parametros,
        url:   '/cartera/causacion/all/' + $('#cedula_tercero').val(),
        type:  'get',
        beforeSend: function () {
            $('#tabla_facturas').html('<p>Espere porfavor</p>');
        },
        success:  function (response) {
            //console.log(response);
            $('#tabla_facturas').html('');
            console.log(response.body);
            $('#tabla_facturas').append('<table class="table table-hover table-striped" id="tabla_fac" >'+
                    '<thead>'+
                        '<tr>'+
                        '<th># ID</th>'+
                        '<th>Prefijo</th>'+
                        '<th>Factura</th>'+
                        '<th>Fecha</th>'+
                        '<th>Fecha Venc</th>'+
                        '<th>Valor</th>'+
                        '<th>Saldo</th>'+
                        '<th></th>'+
                        '</tr>'+
                    '</thead><tbody>');
            $.each( response.body, function( key, value ) {
                var id = value.id;
                var prefijo = value.prefijo;
                var numero = value.numero;
                var fecha = value.fecha;
                var fecha_vencimiento = value.fecha_vencimiento;
                var total = value.neto_pagar;
                var saldo = value.saldo;
                $('#tabla_fac').append('<tr >'+
                    '<td>'+value.id+'</td>'+
                    '<td>'+value.prefijo+'</td>'+
                    '<td>'+value.numero+'</td>'+
                    '<td>'+value.fecha+'</td>'+
                    '<td>'+value.fecha_vencimiento+'</td>'+
                    '<td>'+value.neto_pagar+'</td>'+
                    '<td>'+value.saldo+'</td>'+
                    '<td><div class="btn btn-success" id="pagarbtn" onclick="carteras.getDocumento('+
                        id+',`'+
                        prefijo+'`,`'+
                        numero+'`,`'+
                        fecha+'`,`'+
                        fecha_vencimiento+'`,`'+
                        total+'`,`'+
                        saldo+'`'+
                    ')" >Pagar</div></td>'+
                    '</tr>');
            });
            $('#tabla_fac').append('</tbody></table>');
        },
        error: function(error){
            $('#tabla_facturas').html('No existen resultados');
        }
    });
}

$('#cedula_tercero').on('keydown', function(e) {
  if (e.key === "Enter") {
      buscarcliente($('#cedula_tercero').val());
      return false;
  }
});

$('#nombre').on('keydown', function(e) {
    if (e.key === "Enter") {
        buscarcliente2($('#nombre').val());
        return false;
    }
});
  </script>

@endsection()