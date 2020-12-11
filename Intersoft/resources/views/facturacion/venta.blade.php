@extends('layout')

@section('content')


<style>
    
span{
    color: black;
    font-size: 10pt;
    text-align: right;
}
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

<div class="enc-article">
    <h4 class="title">{{ ($documento['nombre']=="Factura Electronica")?"Factura de Venta":$documento['nombre'] }}</h4>
    <select class="form-control " style="width: 400px;position: absolute;top: 25%;left: 35%;" id="prefijo">
        @foreach ($resoluciones as $pre)
        <option value="{{ $pre->prefijo }}">Prefijo: {{ $pre->prefijo }} Número actual: {{ ($pre->numero_presente)+1 }} </option>
        @endforeach
    </select>
    
    <input type="hidden" id="idDocumento" value="{{ $documento['id'] }}">
    <input type="hidden" id="signoDocumento" value="{{ $documento['signo'] }}">
</div>


<?php $tipo_pagos = App\Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get(); ?>
<?php if(isset($_GET['nit'])){ $nit = $_GET['nit']; }else{ $nit="";} ?>

<div class="row top-11-w">
    
    <div class="card" style="margin:3%;">
        <div class="header row" style="background:#dbdbdb">
            <h4 class="title col-md-12" style="color:black;">Datos Cliente<hr></h4>
            <div class="col-md-4">
                <label>Nit:</label>
                <input type="hidden" id="id_retefuente" value="0" placeholder="id_retefuente" class="form-control">
                <input type="hidden" id="directorio_tipo" placeholder="directorio_tipo" class="form-control">
                <input type="text" list="listDirectorio" name="cedula_tercero" value="{{ $nit }}"  id="cedula_tercero" placeholder="nit" class="form-control" onchange="buscarcliente(this.value)">
                <p style="font-size:10px;color:black;"  id="resCliente">Para buscar el cliente debe tener un minimo de 3 caracteres</p>
                
            </div>
            <div class="col-md-4">
                <label>Razón Social:</label>
                <input type="text" name="nombre" list="listaclientes"  id="nombre" placeholder="Razón Social" class="form-control" onchange="buscarcliente2(this.value)" >
                <datalist id="listaclientes"></datalist>
            </div>
            <div class="col-md-4">
                <label>Dirección:</label>
                <input type="text" name="direccion"  id="direccion" placeholder="Dirección" class="form-control" >
            </div>
        </div>
        <div class="header row" style="background:#dbdbdb">
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
                <input name="id_ciudad" class="form-control"  id="id_ciudad" list="ciudades">
                <datalist id="ciudades">    
                    @foreach ( $ciudades as $ciudad)
                    <option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }} - {{ $ciudad['codigo'] }}</option>
                    @endforeach
                </datalist>
            </div>
            <div class="col-md-4">
                <label>Nombre Zona:</label>
                <input type="text" name="zona"  id="zona" placeholder="Zona" class="form-control" >
            </div>
        </div>
        <div class="header row" style="background:#dbdbdb">
            <div class="col-md-12" style="margin-bottom:2%;">
                <label><br></label>
                <a href="/gps/directoriomaps" target="_blank" style="background:white;" class="btn btn-warning">Agregar al mapa</a>
                <label><br></label>
                <div class="btn btn-success" style="background:#3c763d;color:white;" id="guardarCliente" onclick="guardarCliente();">Guardar Cliente</div>
            </div>
            <div class="col-md-6" style="margin-bottom:2%;">
                <label>Fecha:</label>
                <input type="date" name="fecha" id="fecha" value="{{ date('Y-m-d') }}" class="form-control" onkeyup="documentos.fechaActual(event)" >
            </div>
            <div class="col-md-3" style="margin-bottom:2%;">
                <label>Fecha vencimiento:</label>
                  <input type="date" name="fecha_vencimiento" value="{{ date('Y-m-d') }}" id="fecha_vencimiento" class="form-control" onkeyup="documentos.siguiente(event,'id_modificado');">
            </div>    
            <div class="col-md-3" style="margin-bottom: 2%;">
                <label>Vendedor</label>
                <select name="id_modificado" id="id_modificado" class="form-control" >
                    @foreach ($usuarios as $usuario )
                    <option value="{{ $usuario->id }}">{{ $usuario->apellido }} {{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
        </div>
    </div>
    
</div>


<div class="row top-11-w">
    
    <div class="card col-md-11" style="margin:3%;margin-top:0%;color:black;">
        <div class="header row " style="background:white;">
            <div class="col-md-6" style="overflow-x:scroll">
                <table id="busquedaReferencia" class="table " style="color:black;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>codigo interno</th>
                            <th>descripcion</th>
                            <th>Iva</th>
                            <th>precio #1</th>
                            <th>precio #2</th>
                            <th>precio #3</th>
                            <th>costo</th>
                            <th>saldo</th>
                        </tr>
                    </thead>
                </table>   
            </div>
            
            <div class="col-md-5" style="background: #ddd;margin-left: 6%;margin-top:6%; color:black;">
                <br>
                Nota: <br>
                Para <strong>agregar productos</strong> dirijase al boton más.<br>
                Si desea <strong>eliminar un producto</strong> primero seleccione la fila y dirijase al boton eliminar.<br>
                <div class="btn btn-danger">X</div><br>
                Si ha <strong>terminado de registrar</strong> los productos dirijase al boton Guardar.<br><br><br>
            </div>
        </div>
        
    </div>

    <div class="card" style="margin:3%;margin-top:0%;">
        <div class="header row" style="background:white">
            
            <div class="row" style="overflow-x: scroll;overflow-y: scroll;height: 400px;">
                <table id="tabla_productos" class="table table-bordered">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="checkbox_noname"> </th>                        
                        <th>CODIGO</th>
                        <th>DESCRIPCIÓN</th>
                        <th style="width:100px;">LOTE</th>
                        <th style="width:200px;">CANTIDAD</th>
                        <th style="width:200px;">VALOR_UNIDAD.</th>
                        <th style="width:100px;">IVA (%)</th>
                        <th style="width:200px;">VALOR_TOTAL.</th>
                    </tr>
                    </thead>
                </table>
            </div>
            
        </div>
    </div>

    <div class="col-sm-12">
        
        </div>
        <div class="col-sm-12">
            <div class="row titulo">
                <div class="col-sm-3">
                    <label>Tipo Pago: </label>
                    <select id="tipo_pago" name="tipo_pago" onchange="banderaefectivo()" class="form-control">                      
                    @foreach ($tipo_pagos as $obj)
                    <option value="{{ $obj['id']}}">{{ $obj['nombre']}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-sm-9">
                    <p style="font-size:10px;color:black;">De ser necesario agrega diferentes tipos de pago, puesto que por defecto el sistema registra pago en efectivo, sin embargo puede ser con baucher, cheques o transacciones.</p>
                    <button type="button" class="btn form-control" id="btnSiCaja"  data-toggle="modal" onclick="tomarDatosCartera()" data-target="#myModal">Abrir Pago personalizado</button>
                    <button type="button" class="btn form-control" id="btnNoCaja" style="color: red;">Pago en credito </button>
                </div>
                <div class="col-sm-3">
                    <label>SUB.TOTAL</label>
                    <p id="subtotalTex">$ 0.00</p>
                    <input type="hidden" id="subtotal"  class="form-control" disabled="">
                </div>
                <div class="col-sm-3">
                    <label>IVA</label>
                    <p id="ivaTex">$ 0.00</p>
                    <input type="hidden" id="iva" class="form-control" disabled="">
                </div>
                <div class="col-sm-3">
                    <label>DESCUENTO</label>
                    <br>
                    <p id="descuentoTex" onclick="config.aparecer('descuento','descuentoTex')">$ 0.00</p>
                    <input type="number" style="display: none" value="0" id="descuento" class="form-control" onchange="config.aparecer('descuentoTex','descuento')" onkeyup="recorrerCree()">
                </div>
                <div class="col-sm-3">
                    <label>FLETES</label>
                    <br>
                    <p id="fletesTex" onclick="config.aparecer('fletes','fletesTex')">$ 0.00</p>
                    <input type="number" style="display: none" value="0" id="fletes" onchange="config.aparecer('fletesTex','fletes')" onkeyup="recorrerCree();" class="form-control ">
                </div>
                <div class="col-sm-3">
                    <label>RETEFUENTE</label>
                    <br>
                    <p id="retefuenteTex" onclick="config.aparecer('retefuente','retefuenteTex')">$ 0.00</p>
                    <input type="number" style="display: none" value="0" id="retefuente" onchange="config.aparecer('retefuenteTex','retefuente')" class="form-control" onkeyup="recorrerCree();">
                </div>
                <div class="col-sm-3">
                    <label>ICA</label>
                    <br>
                    <p id="impoconsumoTex" onclick="config.aparecer('impoconsumo','impoconsumoTex')">$ 0.00</p>
                    <input type="number" style="display: none" value="0" id="impoconsumo" onchange="config.aparecer('impoconsumoTex','impoconsumo')" class="form-control" onkeyup="recorrerCree();">
                </div>
                <div class="col-sm-3">
                    <label>CREE</label>
                    <br>
                    <p id="otro_impuestoTex" onclick="config.aparecer('otro_impuesto','otro_impuestoTex')">$ 0.00</p>
                    <input type="number" style="display: none" value="0" id="otro_impuesto" onchange="config.aparecer('otro_impuestoTex','otro_impuesto')" class="form-control" onkeyup="recorrerCree();">
                </div>
                <div class="col-sm-3">
                    <label>TOTAL</label>
                    <p id="totalTex" class="numberTex">$ 0.00</p>
                    <input type="hidden" id="total" class="form-control" disabled="">
                </div>
                <div class="col-sm-12" style="height: 20px;"></div>
                <div class="col-sm-12">
                    <label>CONDICIONES DE Documento</label>
                    <input id="observaciones" name="observaciones" class="form-control" onkeyup="documentos.enterObser(event);" value="SIN OBSERVACIONES" >
                </div>
                <div class="col-sm-12" style="height: 20px;"></div>
                <div class="col-sm-12">
                    <div id="Guardar" class="btn btn-success form-control" onclick="save_documento();" style="background-color: #28a745;color:white;">GUARDAR</div>
                    <div id="imprimirPOST" onclick="documentos.imprimirPost();" class="btn btn-warning form-control" style="background-color: white;">Imprimir Pos</div>
                    <div id="imprimirDOC" onclick="documentos.imprimir();" class="btn btn-danger form-control" style="background-color: white;">Imprimir Documento</div>
                </div>
                <div class="col-sm-12" style="height: 20px;"></div>
            </div>
        </div>
    </div>
    
</div>



<!-- Modal CARTERTA -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cartera</h4>
      </div>
      <div class="modal-body" style="font-size: 10px;color:black;">
        <div style="margin:1%;padding:3%; background:#eee">
            <p>Estos son los datos de pago a la factura adicionales</p>
            <div class="row">
                <div class="col-md-4">
                    <label>sobrecostos</label>
                    <input type="number" class="form-control" id="Carteraxsobrecostos">
                </div>
                <div class="col-md-4">
                    <label>reteiva</label>
                    <input type="number" class="form-control" id="Carteraxreteiva">
                </div>
                <div class="col-md-4">
                    <label>reteica</label>
                    <input type="number" class="form-control" id="Carteraxreteica">
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <br>
                    <input type="hidden" id="idFactura">
                    <input type="hidden" id="numeroFactrua">
                    <input type="hidden" id="Carteraxdescuentos">
                    <input type="hidden" id="Carteraxfletes">
                    <input type="hidden" id="Carteraxretefuente">
                    <input type="hidden" id="Carteraxefectivo">
                    <input type="hidden" id="Carteraxtotal">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="tabla_forma_pagos">
                        <thead>
                            <th>Forma de pago</th>
                            <th>Valor</th>
                            <th>Observación</th>
                            <th style="background: white;"><button class="btn btn-success" onclick="addFormaPago();">+</button></th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="Carterasreteiva">
                <input type="hidden" id="Carterasreteica">
                <input type="hidden" id="Carterasefectivo">
                <input type="hidden" id="Carterassobrecosto">
                <input type="hidden" id="Carterasdescuento">
                <input type="hidden" id="Carterasretefuente">
                <input type="hidden" id="Carterasotros">
                <input type="hidden" id="Carterasid_cliente">
                <input type="hidden" id="Carterasid_vendedor">
                <input type="hidden" id="CarterastipoCartera">
                <input type="hidden" id="Carterassubtotal">
                <label>Total</label>
                <input type="currency" class="form-control" style="text-align: right;" id="Carterastotal" disabled>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div style="position:fixed;top:0;left:0;background:#999;opacity:0.7;width: 100%;height: 800px;" id="cargando">
 <div style="margin-top:27%;margin-left:45%;" class="preloader"></div>
</div>

<script>
//funciones script para carteras

$(document).ready(function(){
    $('#btnNoCaja').hide();
    $('#cargando').hide();
});

function saveCartera(){
    var parametros = {
        "reteiva":$('#Carterasreteiva').val(),
		"reteica": $('#Carterasreteica').val(),
		"efectivo":$('#Carterasefectivo').val(),
		"sobrecosto":$('#Carterassobrecosto').val(),
		"descuento":$('#Carterasdescuento').val(),
		"retefuente":$('#Carterasretefuente').val(),
		"otros":$('#Carterasotros').val(),
		"numero":"0",
		"prefijo":"NA",
		"id_cliente":$('#cedula_tercero').val(),
		"id_vendedor":$('#Carterasid_vendedor').val(),
		"fecha":$('#fecha').val(),
		"tipoCartera":$('#CarterastipoCartera').val(),
		"subtotal":$('#Carterassubtotal').val(),
		"total":$('#Carterastotal').val(),
		"id_modificado":$('#Carterasid_vendedor').val(),
		"observaciones":"SIN OBSERVACIONES",
		"estado":"CANCELADO"
    };
    $.ajax({
        data:  parametros,
        url:   '/cartera/egresos/guardar',
        type:  'post',
        success:  function (response) {
            config.createToast("success", "Tesoreria ha guardado este registro como comprobante de cancelado");
            console.log(response);
            ///TENGO UN PROBLEMA ACA............................................
            setTimeout(function(){ 
                var parametros1 = {
                    'id_cartera':response.body.id,
                    'id_factura':$('#idFactura').val(),
                    'fechaFactura':response.body.fecha,
                    'numeroFactura':$('#numeroFactrua').val(),
                    'descuentos':$('#Carteraxdescuentos').val(),
                    'sobrecostos':$('#Carteraxsobrecostos').val(),
                    'fletes':$('#Carteraxfletes').val(),
                    'retefuente':$('#Carteraxretefuente').val(),
                    'efectivo':$('#Carteraxefectivo').val(),
                    'reteiva':$('#Carteraxreteiva').val(),
                    'reteica':$('#Carteraxreteica').val(),
                    'total':$('#Carteraxtotal').val(),
                    'id_auxiliar':1
                };
                $.ajax({
                    data:  parametros1,
                    url:   '/cartera/kardex/guardar',
                    type:  'post',
                    success:  function (response1) {
                        console.log(response1);
                    }
                });
             }, 1000);
            
            //guardar formas de pago
            CarteraformaPago = document.getElementsByName("CarteraformaPago");
            Carteravalor = document.getElementsByName("Carteravalor");
            Carteraobservacion = document.getElementsByName("Carteraobservacion");

            setTimeout(function(){ 
                for(i=0;i<CarteraformaPago.length;i++){ 
                    formaPago = CarteraformaPago[i];
                    valor = Carteravalor[i];
                    observacion = Carteraobservacion[i];
                    var parametros2 = {
                        'formaPago':formaPago.value,
                        'id_cartera':response.body.id,
                        'valor':valor.value,
                        'observacion':observacion.value
                    };
                    $.ajax({
                        data:  parametros2,
                        url:   '/cartera/FormaPagos',
                        type:  'post',
                        success:  function (response1) {
                            console.log(response1);
                        }
                    });
                }
            }, 1000);
        }
    });
}

function saveContabilidad(){
    $.ajax({
        data:  parametros,
        url:   '/contabilidad/generarfactura/'+$('#idFactura').val(),
        type:  'get',
        success:  function (response) {
            config.createToast("success", "Contabilidad generada y guardada con exito");
            console.log(response);
        }
    });
}


function banderaefectivo(){
    var tipo_pago = $('#tipo_pago option:selected').html();
    if(tipo_pago == "EFECTIVO" || tipo_pago == "CAJA"){
        $('#btnNoCaja').hide();
        $('#btnSiCaja').show();
    }
    else{
        $('#btnNoCaja').show();
        $('#btnSiCaja').hide();
    }
}
function tomarDatosCartera(){
    $('#Carterasxtotal').val($('#total').val());
    $('#Carteraxdescuentos').val($('#descuento').val());
    $('#Carteraxsobrecostos').val(0);
    $('#Carteraxfletes').val($('#fletes').val());
    $('#Carteraxretefuente').val($('#retefuente').val());
    $('#Carteraxefectivo').val($('#total').val());
    $('#Carteraxreteiva').val(0);
    $('#Carteraxreteica').val(0);
    $('#Carteraxtotal').val($('#total').val());

    $('#Carterasreteiva').val($('#Carteraxreteiva').val());
    $('#Carterasreteica').val($('#Carteraxreteica').val());
    $('#Carterasefectivo').val($('#Carteraxefectivo').val());
    $('#Carterassobrecosto').val($('#Carteraxsobrecostos').val());
    $('#Carterasdescuento').val($('#Carteraxdescuentos').val());
    $('#Carterasretefuente').val($('#Carteraxretefuente').val());
    $('#Carterasotros').val($('#Carteraxsobrecostos').val());
    $('#Carterasid_vendedor').val($('#id_modificado').val());
    $('#CarterastipoCartera').val("INGRESO");
    $('#Carterassubtotal').val($('#Carteraxtotal').val());
    $('#Carterastotal').val($('#Carteraxtotal').val());

}

function addFormaPago(){
    tipoPagos = {!! json_encode($tipo_pagos) !!};
    var total = $('#total').val();
    var tipo_pago = $('#tipo_pago option:selected').val();
    
    var table = document.getElementById("tabla_forma_pagos");
    var row = table.insertRow(1);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    tipopagoselect = '<select class="form-control" type="text" name="CarteraformaPago">';
        for (let index = 0; index < tipoPagos.length; index++) {
            const element = tipoPagos[index];
            tipopagoselect += '<option value="'+element.id+'">'+element.nombre+'</option>';
        }    
    tipopagoselect += '</select>';
    cell0.innerHTML = tipopagoselect;
    cell1.innerHTML = '<input class="form-control" type="text" value="'+total+'" name="Carteravalor">';
    cell2.innerHTML = '<input class="form-control" type="text" value="NA" name="Carteraobservacion">';
    cell3.innerHTML = '<button class="btn btn-danger deleteformapagobtn" onclick="deleteFormaPago();">x</button>';
    
}

$(document).on('click', 'button.deleteformapagobtn', function () {
    var mensaje;
    var opcion = confirm("¿Desea eliminar la fila?");
    if (opcion == true) {
        $(this).closest('tr').remove();
	}   
    return false;
});

var cantidadxdias = 0;

</script>


<script>


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


$(document).on('click', 'button.deletebtn', function () {
    var mensaje;
    var opcion = confirm("¿Desea eliminar la fila?");
    if (opcion == true) {
        $(this).closest('tr').remove();
        recorrerTotal();
	}   
    return false;
});

function save_documento(){
    //$('#cargando').show();
    //validaciones
    if(documentos.verificar() == true){ //todo esta correcto
        config.createToast("info", "Preparando documento");
        $('#Guardar').hide();
        saveFactura();
        //$('#imprimirPOST').show(100);
        //$('#imprimirDOC').show(100);
        $('#cargando').hide();
    }
    else{
        swal({
            title: "Verifica algo anda mal",
            text: "Los campos resaltados en rojo son importantes para este formulario",
            icon: "error",
            button: "Aceptar",
        });
        $('#cargando').hide();
    }
    
    
    
}

function saveFactura(){
    var prefijo = '';
    var fecha_vencimiento = '';
    var descuento = '';
    if($('#prefijo').val()=='')             { prefijo = '_'; }                          else { prefijo = $('#prefijo').val(); }
    if($('#fecha_vencimiento').val()=='')   { fecha_vencimiento = $('#fecha').val(); }  else { fecha_vencimiento = $('#fecha_vencimiento').val(); }
    if($('#descuento').val()=='')   { descuento = '0'; }  else { descuento = $('#descuento').val(); }
    //poner los datos de la tabla de productos en un json 
    var jsonArr = [];
    var tabla = document.getElementById("tabla_productos");
    config.createToast("info", "Cargando Productos");
    for (var i=1;i < tabla.rows.length; i++){  

        var cantidad, descuento, valor, total;

        inputs = tabla.rows[i].getElementsByTagName('input');
        selects = tabla.rows[i].getElementsByTagName('select');

        check = inputs[0].value;
        id = inputs[1].value;
        cantidad = inputs[2].value.replace(",","");
        iva = inputs[3].value;
        subtotal = inputs[4].value;

        lote = selects[0].value;
        valor_unidad = selects[1].value;

        var productos = {
            'id_referencia' : id,
            'lote' : lote,
            'serial' : lote, //falta
            'fecha_vencimiento' : lote, //falta
            'cantidad': cantidad,
            'precio' : valor_unidad,
            'costo' : 0,
            'subtotal' : subtotal,
            'iva' : iva,
            'descuento' : 0
        };
        jsonArr.push(productos);

    }
    var parametros = {
        'id_sucursal' : '1',
        'numero' : '0',
        'prefijo' : prefijo,
        'id_cliente' : $('#cedula_tercero').val(), //debe ser el id
        'id_tercero' : $('#cedula_tercero').val(), //debe ser el id
        'id_vendedor' : $('#id_modificado').val(),
        'fecha' : $('#fecha').val(),
        'fecha_vencimiento' : $('#fecha_vencimiento').val(),
        'id_documento' : $('#idDocumento').val(),
        'signo' : $('#signoDocumento').val(),
        'subtotal' :  $('#subtotal').val().replace(",",""),
        'iva' : $('#iva').val().replace(",",""),
        'impoconsumo' : $('#impoconsumo').val().replace(",",""),
        'otro_impuesto' : $('#otro_impuesto').val().replace(",",""),
        'otro_impuesto1' : '0',
        'descuento' : $('#descuento').val().replace(",",""),
        'fletes' : $('#fletes').val().replace(",",""),
        'retefuente' : $('#retefuente').val().replace(",",""),
        'total' : $('#total').val().replace(",",""),
        'id_modificado' : localStorage.getItem('Id_usuario'),
        'observaciones' : $('#observaciones').val(),
        'estado' : 'ACTIVO',
        'saldo'  : $('#total').val().replace(",",""),
        'tipo_pago' : $('#tipo_pago').val(),
        'productosArr' : jsonArr
    };
    $.ajax({
        data:  parametros,
        url:   HOST+'/factura/saveDocument',
        type:  'post',
        beforeSend: function () {
            $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
        },
        success:  function (response) {
            config.createToast("info", "Encabezado Guardado exitosamente");
            console.log(response);

            factura = response.body;
            
            //datos para generar la cartera
            $('#idFactura').val(factura.id);
            $('#numeroFactrua').val(factura.numero);
            if($('#tipo_pago').val() != '3'){
                setTimeout(function(){ saveCartera(); }, 1000);
            }
            
            //fin de cartera
            setTimeout(function(){ saveContabilidad(); }, 1000);

            $('#resultado').hide();
            //si la respuesta es correcta 
            if(response.result == "success"){
                
                localStorage.setItem("factura",factura.id);
                
                $('#resultado').hide();
                console.log("Guardado exitoso");
                $('#cargando').hide();
                //$('#Guardar').show();
                setTimeout(function(){ 
                    swal({
                    title: "Imprimir",
                    text: "¿Deseas imprimir el documento?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.open("/documentos/imprimir/"+factura.id);
                        location.reload();
                    } else {
                        swal("Guardado exitoso. En otra ocación podrás imprmir.");
                    }
                    }); 
                 }, 7000);
                   
            }
            else{
                config.createToast("error", response.body);
                $('#cargando').hide();
                $('#resultado').hide();
                swal({
                    title: "Algo anda mal",
                    text: response.body,
                    icon: "error",
                    button: "Aceptar",
                });
                
            }
        },
        error: function (request, status, error) {
            $('#resultado').hide();
            console.log(request.responseText);
            swal({
                title: "Algo anda mal",
                text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                icon: "error",
                button: "Aceptar",
            });
            $('#cargando').hide();
        }
    });
}


$('#imprimirPOST').hide();
$('#imprimirDOC').hide();

function actualizardocumento(id_documento){
    var parametros = {
        "estado":"RECHAZADO",
        "id_documento":id_documento
    };
    $.ajax({
        data:  parametros,
        url:   '/facturacion/pedidosUpdate',
        type:  'post',
        success:  function (response) {
            console.log(response);
            config.Redirect('/facturacion/pedidos');
        }
    });
}

</script>


<script>

$(document).ready( function () {
    referencias = {!! json_encode($referencias) !!};
    $('#busquedaReferencia').DataTable( {
        data: referencias,
        "lengthMenu": [[3, 5, 10], [3, 5, 10]],
        columns: [
            { data: 'id' },
            { data: 'codigo_interno' },
            { data: 'descripcion' },
            { data: 'iva' },
            { data: 'precio1' },
            { data: 'precio2' },
            { data: 'precio3' },
            { data: 'costo' },
            { data: 'saldo' }
        ],
        columnDefs: [
            {
                targets: 0,
                render: function ( id, type, row, meta ) {
                    if(type === 'display'){
                        data = '<a href="javascript:;" onclick="getReferencia('+row.id+')" class="btn btn-warning">+</a>';
                    }
                    return data;
                }
            }
        ]
    } );
    
} );

function getReferencia(id){
    var urls = "/inventario/referencias/"+id;
    $.ajax({
        url:   urls,
        type:  'get',
        beforeSend: function () {
            $('#resultado').html('<p>Espere porfavor</p>');
        },
        success:  function (response) {
            config.createToast("success", "Producto cargado de forma exitosa");
            console.log(response);
            referencia = response.body;
            lote = response.lote;
            linea = response.linea;

            var precioasignado = referencia.precioasignado.toString();
            precios = "<select class='form-control' onchange='recorrerproductos(this)' id='preciosselect' name='valor_unidad'>";
            var options = { style: 'currency', currency: 'USD' };
            var numberFormat = new Intl.NumberFormat('en-US', options);
            //console.log();

            if(precioasignado.includes("1")){  
                precios += "<option value='"+referencia.precio1+"'>"+ numberFormat.format(referencia.precio1) +"</option>";
            }
            if(precioasignado.includes("2")){
                precios += "<option value='"+referencia.precio2+"'>"+ numberFormat.format(referencia.precio2) +"</option>";
            }
            if(precioasignado.includes("3")){
                precios += "<option value='"+referencia.precio3+"'>"+ numberFormat.format(referencia.precio3) +"</option>";
            }
            precios += "<option value=''>Otro valor</option>";
            precios += "</select>";
            lotes = "<select class='form-control' name='lote'>";
            for(i=0;i<lote.length;i++){ 
                lotes += "<option value='"+lote[i].id+"'>"+lote[i].numero_lote+" - "+lote[i].fecha_vence_lote+" - "+lote[i].cantidad+"</option>";
            }
            lotes += "</select>";
            var table = document.getElementById("tabla_productos");
            var row = table.insertRow(1);
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            var cell3 = row.insertCell(3);
            var cell4 = row.insertCell(4);
            var cell5 = row.insertCell(5);
            var cell6 = row.insertCell(6);
            var cell7 = row.insertCell(7);
            cell0.innerHTML = "<button type='button' class='deletebtn btn btn-danger' title='Remove row'>X</button><input type='hidden' value='0' class='' name='check'><input type='hidden' name='id' value='"+referencia.id+"'>";
            cell1.innerHTML = "<strong style='color:black'>"+referencia.codigo_interno+"</strong>";
            cell2.innerHTML = "<strong style='color:black'>"+referencia.descripcion+"</strong>";
            cell3.innerHTML = lotes;
            cell4.innerHTML = "<input value='0' onchange='recorrerproductos(this)' class='form-control' onkeyup='config.puntuacion(this)' name='cantidad'>";
            cell5.innerHTML = precios;
            cell6.innerHTML = "<input type='text' value='"+referencia.iva+"' class='form-control' name='iva' disabled><input type='hidden' name='totaliva'>";
            cell7.innerHTML = "<input type='hidden' value='0' class='form-control' name='subtotal' disabled><input type='hidden' value='0' class='form-control' name='totalretefuente'><p name='spanTotal' class='numberTex' style='color:black;'>$ 0.00</p>";
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

function recorrerproductos(element){
    
    config.createToast("info", "Intersoft esta calculando impuestos para el producto seleccionado");
    td = element.parentNode;
    tr = td.parentNode;
    
    inputs = tr.getElementsByTagName('input');
    selects = tr.getElementsByTagName('select');
    span = tr.getElementsByTagName('p');

    if($('#preciosselect').val() == ''){
        swal("Escribe el valor del producto:", {
            content: "input",
        })
        .then((value) => {
            var option = document.createElement("option");
            option.text = value;
            option.value = value;
            selects[1].add(option);
            selects[1].value = value;
            recorrerproductos(element);
        });
    }
    
    check = inputs[0].value;
    id = inputs[1].value;
    cantidad = inputs[2].value.replace(",","");
    iva = inputs[3].value;
    totaliva = inputs[4].value;
    subtotal = inputs[5].value;

    lote = selects[0].value;
    valor_unidad = selects[1].value;

    
    inputs[5].value = parseFloat(cantidad) * parseFloat(valor_unidad); 
    span[0].innerHTML = "$ " + new Intl.NumberFormat().format(inputs[5].value);

    //IVA 
    if(iva == 0){
        inputs[4].value = 0;    
    }
    else{
        inputs[4].value = ((parseFloat(cantidad) * parseFloat(valor_unidad)) * iva)/100;
        //inputs[4].value = (parseFloat(cantidad) * parseFloat(valor_unidad)) - ((parseFloat(cantidad) * parseFloat(valor_unidad))/(1+parseFloat(iva)));//totaliva
    }

    //RETENCION
    try{
        retefuente = 0;
        if($('#id_retefuente').val() == '0'){
            //retefuente = parseFloat(((parseFloat(cantidad) * parseFloat(valor_unidad))/(1+parseFloat(iva)))) * 2.5;
            retefuente = parseFloat( (((parseFloat(cantidad) * parseFloat(valor_unidad))) * 2.5)/100);
            inputs[6].value = retefuente; 
        }
        else{
            id_retefuente = JSON.parse($('#id_retefuente').val());
            if(id_retefuente.nombre == "SOBRE TODO"){
                //retefuente = parseFloat(((parseFloat(cantidad) * parseFloat(valor_unidad))/(1+parseFloat(iva)))) * 2.5;
                retefuente = parseFloat( (((parseFloat(cantidad) * parseFloat(valor_unidad))) * 2.5)/100);
            }
            else if(id_retefuente.nombre == "SOBRE LA BASE MENSUAL"){
                //retefuente = parseFloat(((parseFloat(cantidad) * parseFloat(valor_unidad))/(1+parseFloat(iva)))) * 2.5;
                retefuente = parseFloat( (((parseFloat(cantidad) * parseFloat(valor_unidad))) * 2.5)/100);
            }
            else{
                retefuente = 0;
            }
            inputs[6].value = retefuente;
        }
        
    }
    catch(Exception){
        retefuente = parseFloat(((parseFloat(cantidad) * parseFloat(valor_unidad))/(1+parseFloat(iva)))) * 0.25;
        inputs[6].value = retefuente;
        console.log("No ha seleccionado al cliente");
    }
    
    if($('#signoDocumento').val()=="-"){
        recorrerTotal();
    }    
    else{
        recorrerSinImpuestos();
    }

    
}

function recorrerCree(){
    subtot = parseFloat($('#subtotal').val().replace(",",""));
    descuento = parseFloat($('#descuento').val().replace(",",""));
    document.getElementById("descuentoTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#descuento').val());
    fletes = parseFloat($('#fletes').val().replace(",",""));
    document.getElementById("fletesTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#fletes').val());
    cree = parseFloat($('#otro_impuesto').val().replace(",",""));
    document.getElementById("otro_impuestoTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#otro_impuesto').val());
    retefuente = parseFloat($('#retefuente').val().replace(",",""));
    document.getElementById("retefuenteTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#retefuente').val());
    impoconsumo = parseFloat($('#impoconsumo').val().replace(",",""));
    iva = parseFloat($('#iva').val().replace(",",""));
    document.getElementById("impoconsumoTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#impoconsumo').val());
    $('#total').val( parseFloat(subtot - descuento + fletes - cree - impoconsumo - retefuente + iva).toFixed(2) );
    document.getElementById("totalTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#total').val());
}

function recorrerSinImpuestos(){
    config.createToast("info", "Intersoft esta calculando el total del pedido");
    subtotales = document.getElementsByName("subtotal");
    subtot = 0;
    descuento = parseFloat($('#descuento').val());
    fletes = parseFloat($('#fletes').val().replace(",",""));
    cree = $('#otro_impuesto').val().replace(",","");
    retefuente = $('#retefuente').val().replace(",","");
    impoconsumo = $('#impoconsumo').val().replace(",","");

    for(i=0;i<subtotales.length;i++){ 
        element = subtotales[i];
        subtot += parseFloat(element.value);
    }
    ivas = document.getElementsByName("totaliva");
    iva = 0;
    for(i=0;i<ivas.length;i++){ 
        element = ivas[i];
        iva += parseFloat(element.value);
    }

    $('#subtotal').val((parseFloat(subtot) - parseFloat(iva)).toFixed(2));
    document.getElementById("subtotalTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#subtotal').val());
    $('#iva').val(parseFloat(iva).toFixed(2));
    document.getElementById("ivaTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#iva').val());
    $('#retefuente').val(parseFloat(retefuente).toFixed(2));
    document.getElementById("retefuenteTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#retefuente').val());
    directorio_tipo = $('#directorio_tipo').val();
    $('#total').val( parseFloat(subtot - descuento + fletes - cree - retefuente - impoconsumo + iva).toFixed(2) );
    document.getElementById("totalTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#total').val());

    /** cartera verificar y recorrer **/
    var table = document.getElementById("tabla_forma_pagos");
    if(table.rows.length >= 1 ){
        if(table.rows.length == 1){
            addFormaPago();
        }
        elemento = document.getElementsByName("Carteravalor");
        elemento[0].value = $('#total').val();
        tomarDatosCartera();
    }
}

function recorrerTotal(){
    config.createToast("info", "Intersoft esta calculando el Total de la factura");
    subtotales = document.getElementsByName("subtotal");
    subtot = 0;
    descuento = parseFloat($('#descuento').val());
    fletes = parseFloat($('#fletes').val());
    impoconsumo = $('#impoconsumo').val();

    for(i=0;i<subtotales.length;i++){ 
        element = subtotales[i];
        subtot += parseFloat(element.value);
    }
    ivas = document.getElementsByName("totaliva");
    iva = 0;
    for(i=0;i<ivas.length;i++){ 
        element = ivas[i];
        iva += parseFloat(element.value);
    }
    //SABER SI LA RETENCION PASA LA BASE
    id_retefuente = JSON.parse($('#id_retefuente').val());
    if( (parseFloat(subtot) - parseFloat(iva)) >= id_retefuente.valor){
        retefuentestotal = document.getElementsByName("totalretefuente");
        retefuente = 0;
        for(i=0;i<retefuentestotal.length;i++){ 
            element = retefuentestotal[i];
            retefuente += parseFloat(element.value);
        }
    }
    else{
        retefuente = 0;
    }
    

    $('#subtotal').val((parseFloat(subtot)).toFixed(2));
    document.getElementById("subtotalTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#subtotal').val());
    $('#iva').val(parseFloat(iva).toFixed(2));
    document.getElementById("ivaTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#iva').val());
    $('#retefuente').val(parseFloat(retefuente).toFixed(2));
    document.getElementById("retefuenteTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#retefuente').val());
    directorio_tipo = $('#directorio_tipo').val();
    //VERIFICAR TIPO DE TERCERO (CREE)
    if(directorio_tipo == "JURIDICA"){
        $('#otro_impuesto').val(parseFloat($('#subtotal').val() * 0.0040).toFixed(2)); //CREE
    }
    else{
        $('#otro_impuesto').val(parseFloat($('#subtotal').val() * 0.0040).toFixed(2)); //CREE
    }
    cree = $('#otro_impuesto').val();
    document.getElementById("otro_impuestoTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#otro_impuesto').val());
    $('#total').val( parseFloat(subtot - descuento + fletes - cree - retefuente - impoconsumo + iva).toFixed(2) );
    document.getElementById("totalTex").innerHTML = "$ " + new Intl.NumberFormat().format($('#total').val());
    

    /** cartera verificar y recorrer **/
    var table = document.getElementById("tabla_forma_pagos");
    if(table.rows.length >= 1 ){
        if(table.rows.length == 1){
            addFormaPago();
        }
        elemento = document.getElementsByName("Carteravalor");
        elemento[0].value = $('#total').val();
        tomarDatosCartera();
    }
}


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
        "zona_venta" : $('#zona').val(),
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
                config.createToast("success", "El tercero se ha creado en la base de datos satisfactoriamente");
                buscarcliente(response.body.nit);
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Los datos para la creación del cliente no son soficientes. Verifique la información.",
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
        if($('#nombre').val()==""){
            parametros = {
                "nit" : texto.trim()
            };
        }
        else{
            parametros = {
                "razon_social" : $('#nombre').val()
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
                    $('#cedula_tercero').val(cliente.nit);
                    $('#nombre').val(cliente.razon_social);
                    $('#direccion').val(cliente.direccion);
                    $('#telefono').val(cliente.telefono);
                    $('#correo').val(cliente.correo); 
                    $('#id_ciudad').val(cliente.id_ciudad);
                    $('#zona').val(cliente.zona_venta);
                    $('#directorio_tipo').val(cliente.id_directorio_tipo.nombre);
                    $('#id_retefuente').val(JSON.stringify(cliente.id_retefuente));
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false );    
                    $('#id_ciudad').prop("disabled", false);
                    $('#zona').prop("disabled", false);
                    //$('#guardarCliente').hide();   
                    config.createToast("success", "Cliente existe");
                    $('#resCliente').text("Cliente existe");    
                    //cartera
                    $('#Carterasid_cliente').val(cliente.id);           
                }  
                else{
                    $('#cedula_tercero').val("");
                    $('#nombre').val("");
                    $('#direccion').val("");
                    $('#telefono').val("");
                    $('#correo').val("");
                    $('#zona').val("");
                    $('#directorio_tipo').val("");
                    $('#id_retefuente').val("");
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false ); 
                    $('#id_ciudad').prop("disabled", false);
                    $('#zona').prop("disabled", false);
                    //$('#guardarCliente').show();
                    config.createToast("error", "Cliente no existe, si desea crearlo, diligencie los datos restantes");
                    $('#resCliente').text("Cliente no existe, si desea crearlo, diligencie los datos restantes");               
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
            "razon_social" : texto.trim()
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
                    //$('#nombre').val(cliente.razon_social);
                    $('#direccion').val(cliente.direccion);
                    $('#telefono').val(cliente.telefono);
                    $('#correo').val(cliente.correo); 
                    $('#id_ciudad').val(cliente.id_ciudad);
                    $('#zona').val(cliente.zona_venta);
                    $('#directorio_tipo').val(cliente.id_directorio_tipo.nombre);
                    $('#id_retefuente').val(JSON.stringify(cliente.id_retefuente));
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false );    
                    $('#id_ciudad').prop("disabled", false);
                    $('#zona').prop("disabled", false);
                    //$('#guardarCliente').hide();   
                    config.createToast("success", "Cliente existe");
                    $('#resCliente').text("Cliente existe");    
                    //cartera
                    $('#Carterasid_cliente').val(cliente.id);           
                }  
                else{
                    $('#listaclientes').find('option').remove();
                    $('#cedula_tercero').val("");
                    $('#nombre').val("");
                    $('#direccion').val("");
                    $('#telefono').val("");
                    $('#correo').val("");
                    $('#zona').val("");
                    $('#directorio_tipo').val("");
                    $('#id_retefuente').val("");
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false ); 
                    $('#id_ciudad').prop("disabled", false);
                    $('#zona').prop("disabled", false);
                    //$('#guardarCliente').show();
                    config.createToast("error", "Cliente no existe, si desea crearlo, diligencie los datos restantes");
                    $('#resCliente').text("Cliente no existe, si desea crearlo, diligencie los datos restantes");               
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
$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}


</script>


@endsection()