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

<div class="enc-article">
    <h4 class="title">{{ $documento_dev['nombre'] }}</h4>
    <input type="hidden" id="prefijo" value="{{ $documento_dev['prefijo'] }}">
    <input type="hidden" id="idDocumento" value="{{ $documento_dev['id'] }}">
    <input type="hidden" id="signoDocumento" value="{{ $documento_dev['signo'] }}">
    <input type="hidden" id="id_factura_ant" value="{{ $facturas[0]['id'] }}">
</div>

<?php $tipo_pagos = App\Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get(); ?>

<div class="row top-11-w">
    
    <div class="card" style="margin:3%;">
        <div class="header row" style="background:#dbdbdb">
            <h4 class="title col-md-12" style="color:black;">Datos Cliente<hr></h4>
            <div class="col-md-4">
                <label>Nit:</label>
                <input type="text" list="listDirectorio" name="cedula_tercero" value="{{ $facturas[0]['id_cliente']['nit'] }}"  id="cedula_tercero" placeholder="nit" class="form-control" onkeyup="buscarcliente(this.value)">
                <p style="font-size:10px;color:black;" id="resCliente">Preciona enter para traer toda la información</p>
                
            </div>
            <div class="col-md-4">
                <label>Razón Social:</label>
                <input type="text" name="nombre"  id="nombre" placeholder="Razón Social" class="form-control" >
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
            <div class="col-md-12" style="margin-bottom:2%;">
                <label><br></label>
                <div class="btn btn-success" style="background:#3c763d;color:white;" id="guardarCliente" onclick="guardarCliente();">Guardar Cliente</div>
            </div>
            <div class="col-md-6" style="margin-bottom:2%;">
                <label>Fecha:</label>
                  <input type="date" name="fecha" id="fecha" class="form-control" onkeyup="documentos.fechaActual(event)" >
            </div>
            <div class="col-md-6" style="margin-bottom:2%;">
                <label>Fecha vencimiento:</label>
                  <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" onkeyup="documentos.siguiente(event,'id_modificado');">
            </div>    
            <input type="hidden" name="id_modificado" id="id_modificado" class="form-control" value="{{ Session::get('user_id') }}" placeholder="Esciba el nombre del vendedor">        
            
        </div>
    </div>
    
</div>


<div class="row top-11-w">
    
    <div class="card col-md-4" style="margin:3%;margin-top:0%;color:black;">
        <div class="header row " style="background:white;overflow-x:scroll;">
            <table id="busquedaReferencia" class="table" style="color:black;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>codigo interno</th>
                        <th>descripcion</th>
                        <th>precio1</th>
                        <th>precio2</th>
                        <th>precio3</th>
                        <th>costo</th>
                        <th>saldo</th>
                    </tr>
                </thead>
            </table>   
        </div>
        <br>
        Nota: <br>
        Para <strong>agregar productos</strong> dirijase al boton más.<br>
        Si desea <strong>eliminar un producto</strong> primero seleccione la fila y dirijase al boton eliminar.<br>
        <div class="btn btn-danger" onclick="documentos.eliminar();">Eliminar</div><br>
        Si ha <strong>terminado de registrar</strong> los productos dirijase al boton Guardar.<br><br><br>
    </div>

    <div class="card" style="margin:3%;margin-top:0%;">
        <div class="header row" style="background:white">
            
            <div class="row" style="overflow-x: scroll;overflow-y: scroll;height: 400px;">
                <table id="tabla_productos" class="table table-bordered">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="checkbox_noname"> </th>                        
                        <th>REFERNCIA</th>
                        <th>DESCRIPCIÓN</th>
                        <th style="width:100px;">LOTE</th>
                        <th style="width:50px;">CANTIDAD</th>
                        <th>VALOR_UNIDAD.</th>
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
        <label>Tipo Pago: </label>
                <select id="tipo_pago" name="tipo_pago" class="form-control">                      
                  @foreach ($tipo_pagos as $obj)
                  <option value="{{ $obj['id']}}">{{ $obj['nombre']}}</option>
                  @endforeach
                </select>
            <div class="col-sm-3">
            <label>SUB.TOTAL</label>
            <input type="number" id="subtotal" class="form-control" disabled="">
            </div>
            <div class="col-sm-3">
            <label>IVA</label>
            <input type="number" id="iva" class="form-control" disabled="">
            </div>
            <div class="col-sm-3">
            <label>DESCUENTO</label>
            <input type="number" id="descuento" class="form-control">
            </div>
            <div class="col-sm-3">
            <label>FLETES</label>
            <input type="number"  value="0" id="fletes" onkeyup="recorrerTotal();" class="form-control">
            </div>
            <div class="col-sm-3">
            <label>RETEFUENTE</label>
            <input type="number" value="0" id="retefuente" class="form-control" onkeyup="recorrerTotal();">
            </div>
            <div class="col-sm-3">
            <label>IMPOCONSUMO</label>
            <input type="number" value="0" id="impoconsumo" class="form-control" onkeyup="recorrerTotal();">
            </div>
            <div class="col-sm-3">
            <label>Otro Impuesto</label>
            <input type="number" value="0" id="otro_impuesto" class="form-control" onkeyup="recorrerTotal();">
            </div>
            <div class="col-sm-3">
            <label>TOTAL</label>
            <input type="number"  id="total" class="form-control" disabled="">
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




<script>


$('#cedula_tercero').on('keydown', function(e) {
    if (e.key === "Enter") {
        buscarcliente($('#cedula_tercero').val());
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

$(document).ready(function(){
    traerKardex();
});

function traerKardex(){
    kardex = {!! json_encode($kardex) !!};
    console.log(kardex);
    kardex.forEach(element => {
        getReferencia_kardex(element.id_referencia, element.cantidad, element.precio);
    });
    recorrerTotal();
}

function save_documento(){
        
    //validaciones
    if(documentos.verificar() == true){ //todo esta correcto
        saveFactura();
        //$('#Guardar').hide();
        $('#imprimirPOST').show(100);
        $('#imprimirDOC').show(100);
    }
    else{
        swal({
            title: "Verifica algo anda mal",
            text: "Los campos resaltados en rojo son importantes para este formulario",
            icon: "error",
            button: "Aceptar",
        });
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
    for (var i=1;i < tabla.rows.length; i++){  

        var cantidad, descuento, valor, total;

        inputs = tabla.rows[i].getElementsByTagName('input');
        selects = tabla.rows[i].getElementsByTagName('select');

        check = inputs[0].value;
        id = inputs[1].value;
        cantidad = inputs[2].value;
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
    //actualizar documento a Devuelto
    actualizardocumento($('#id_factura_ant').val());

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
        'subtotal' :  $('#subtotal').val(),
        'iva' : $('#iva').val(),
        'impoconsumo' : $('#impoconsumo').val(),
        'otro_impuesto' : $('#otro_impuesto').val(),
        'otro_impuesto1' : '0',
        'descuento' : $('#descuento').val(),
        'fletes' : $('#fletes').val(),
        'retefuente' : $('#retefuente').val(),
        'total' : $('#total').val(),
        'id_modificado' : localStorage.getItem('Id_usuario'),
        'observaciones' : $('#observaciones').val(),
        'estado' : 'ACTIVO',
        'saldo'  : $('#total').val(),
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
            console.log(response);
            $('#resultado').hide();
            //si la respuesta es correcta 
            if(response.result == "success"){
                factura = response.body;

                localStorage.setItem("factura",factura.id);
                $('#resultado').hide();
                console.log("Guardado exitoso");
                swal({
                    title: "Imprimir",
                    text: "¿Deseas imprimir el documento?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("/documentos/imprimir/"+factura.id);
                    } else {
                        swal("Guardado exitoso. En otra ocación podrás imprmir.");
                    }
                    });    
            }
            else{
                console.log("Error interno fila ");
                swal({
                    title: "Algo anda mal",
                    text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila  de los productos.",
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
        }
    });
}


$('#imprimirPOST').hide();
$('#imprimirDOC').hide();

function actualizardocumento(id_documento){
    var parametros = {
        "estado":"DEVUELTO",
        "id_documento":id_documento
    };
    $.ajax({
        data:  parametros,
        url:   '/facturacion/pedidosUpdate',
        type:  'post',
        success:  function (response) {
            console.log(response);
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

function getReferencia_kardex(id, cantidad, precio){
    var urls = "/inventario/referencias/"+id;
    $.ajax({
        url:   urls,
        type:  'get',
        beforeSend: function () {
            $('#resultado').html('<p>Espere porfavor</p>');
        },
        success:  function (response) {
            console.log(response);
            total = cantidad * precio;
            referencia = response.body;
            lote = response.lote;
            linea = response.linea;
            ivaTot = ((cantidad * precio)*linea.iva_porcentaje)/100;
            precios = "<select class='form-control' onchange='recorrerproductos(this)' name='valor_unidad'><option value='"+referencia.precio1+"'>"+referencia.precio1+"</option><option value='"+referencia.precio2+"'>"+referencia.precio2+"</option><option value='"+referencia.precio3+"'>"+referencia.precio3+"</option></select>";
            lotes = "<select class='form-control' name='lote'>";
            for(i=0;i<lote.length;i++){ 
                lotes += "<option value='"+lote[i].id+"'>"+lote[i].numero_lote+" - "+lote[i].fecha_vence_lote+" - "+lote[i].cantidad+"</option>";
            }
            lotes += "</select>";
            $('#valor_unidad').val(precio);
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
            cell4.innerHTML = "<input type='number' value='"+cantidad+"' onchange='recorrerproductos(this)' class='form-control' name='cantidad'>";
            cell5.innerHTML = precios;
            cell6.innerHTML = "<input type='text' value='"+linea.iva_porcentaje+"' class='form-control' name='iva' disabled><input type='hidden' value='"+ivaTot+"' name='totaliva'>";
            cell7.innerHTML = "<input type='number' value='"+total+"' class='form-control' name='subtotal' disabled>";
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

function getReferencia(id){
    var urls = "/inventario/referencias/"+id;
    $.ajax({
        url:   urls,
        type:  'get',
        beforeSend: function () {
            $('#resultado').html('<p>Espere porfavor</p>');
        },
        success:  function (response) {
            console.log(response);
            referencia = response.body;
            lote = response.lote;
            linea = response.linea;
            precios = "<select class='form-control' onchange='recorrerproductos(this)' name='valor_unidad'><option value='"+referencia.precio1+"'>"+referencia.precio1+"</option><option value='"+referencia.precio2+"'>"+referencia.precio2+"</option><option value='"+referencia.precio3+"'>"+referencia.precio3+"</option></select>";
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
            cell4.innerHTML = "<input type='number' value='0' onchange='recorrerproductos(this)' class='form-control' name='cantidad'>";
            cell5.innerHTML = precios;
            cell6.innerHTML = "<input type='text' value='"+linea.iva_porcentaje+"' class='form-control' name='iva' disabled><input type='hidden' name='totaliva'>";
            cell7.innerHTML = "<input type='number' value='0' class='form-control' name='subtotal' disabled>";
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
    td = element.parentNode;
    tr = td.parentNode;
    
    inputs = tr.getElementsByTagName('input');
    selects = tr.getElementsByTagName('select');
    
    check = inputs[0].value;
    id = inputs[1].value;
    cantidad = inputs[2].value;
    iva = inputs[3].value;
    totaliva = inputs[4].value;
    subtotal = inputs[5].value;

    lote = selects[0].value;
    valor_unidad = selects[1].value;

    
    inputs[5].value = parseInt(cantidad) * parseInt(valor_unidad);

    if(iva == 0){
        inputs[4].value = 0;    
    }
    else{
        inputs[4].value = (parseInt(cantidad) * parseInt(valor_unidad) * parseInt(iva))/100;
    }

    recorrerTotal();
}


function recorrerTotal(){
    subtotales = document.getElementsByName("subtotal");
    subtot = 0;
    for(i=0;i<subtotales.length;i++){ 
        element = subtotales[i];
        subtot += parseInt(element.value);
    }
    ivas = document.getElementsByName("totaliva");
    iva = 0;
    for(i=0;i<ivas.length;i++){ 
        element = ivas[i];
        iva = iva  + parseInt(element.value);
    }
    $('#subtotal').val(subtot);
    $('#total').val(subtot);
    $('#iva').val(iva);
    $('#descuento').val(0);
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
            "nit" : texto.trim()
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
                    $('#resCliente').text("Cliente existe");               
                }  
                else{
                    $('#nombre').val("");
                    $('#direccion').val("");
                    $('#telefono').val("");
                    $('#correo').val("");
                    $('#nombre').prop( "disabled", false );  
                    $('#direccion').prop( "disabled", false );  
                    $('#telefono').prop( "disabled", false );  
                    $('#correo').prop( "disabled", false ); 
                    $('#id_ciudad').prop("disabled", false);
                    $('#guardarCliente').show();
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

@endsection()