@extends('layout')

@section('content')

<?php 


$auxiliars = App\Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->orderBy('codigo','asc')->get();

$directorios = App\Directorios::where('id_empresa','=',Session::get('id_empresa'))->get();

?>



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
    <h4 class="title">Documentos contabilidades {{ $nombre_tipo_documento }}</h4>
</div>

<div class="row top-5-w">
<p style="font-size:10pt;font-family:Poppins;margin-left:2%">En esta sección usted podrá corregir cualquier asiento contable, correspondiente
al tipo de documento seleccionado anteriormente.</p>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-hover table-striped" id="tableregimenes">
            <thead>
                <tr>
                    <th>Tipo Documento</th>
                    <th>Sucursal</th>
                    <th>Numero Documento</th>
                    <th>Nit</th>
                    <th>Razón social</th>
                    <th>Fecha documento</th>
                    <th>Entrar al comprobante</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach( $data as $dat){
                ?>
                <tr>
                    <td><?php echo $nombre_tipo_documento ?></td>
                    <td><?php echo $dat['id_sucursal'] ?></td>
                    <td><?php echo "Doc#".$dat['numero_documento'] ?></td>
                    <td><?php echo $dat['id_tercero'] ?></td>
                    <td><?php echo $dat['tercero'] ?></td>
                    <td><?php echo $dat['fecha_documento'] ?></td>
                    <td><div class="btn btn-success" onclick="obj.viewComprobantes(<?php echo $dat['numero_documento']; ?>)"><i class="fas fa-pen-square"></i></div></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
    

<div class="row top-5-w">
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Muestra del comprobante contable</p>
    <div class="col-md-2"></div>
    <div class="col-md-8" style="overflow-x:scroll;margin-left:2%;">
        <table class="table table-hover table-striped" id="tablecont">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Tercero</th>
                    <th>Descripción</th>
                    <th>Debito</th>
                    <th>Credito</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpo">
            </tbody>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="container-fluid">
    <div class="row">


        <div class="col-md-12">
                <div class="">
                    <div class="content" style="overflow-x: scroll">
                        
                        <h4>Adicionar Movimiento Contable</h4>
                        <table class="table table-hover table-striped" > 
                           
                            <tbody>
                                    <tr>
                                        <td style="width: 150px"> 
                                            <label>Tipo Documento</label>
                                                <select name="tipo_documento" id="tipo_documento" class="form-control">
                                                <option value="1">EGRESO</option>
                                                <option value="2">RECIBOS DE CAJA</option>
                                                <option value="3">FACTURAS DE VENTA</option>
                                                <option value="4">FACTURAS DE COMPRA</option>
                                                <option value="5">CAUSACIONES</option>
                                                <option value="6">DEPRECIACION</option>
                                                <option value="7">NOTA DB</option>
                                                <option value="8">CONSIGNACION</option>
                                                <option value="9">NOTA CR</option>
                                                <option value="10">NOTA CONTABLE</option>
                                                <option value="11">COMPROBANTE CIERRE CONTABLE</option>
                                                <option value="12">INGRESO X CONSIGNACION</option>
                                                <option value="13">SALIDA X CONSIGNACION</option>
                                                <option value="14">INGRESO Y SALIDA DE PRODUCCION</option>
                                                <option value="15">NOTA NITF</option>
                                            </select>
                                        </td>
                                        <td style="width: 150px"> 
                                            <label>Id documento</label>
                                            <input type="text" placeholder="id_documento1" list="listadocumento" class="form-control" id="id_documento1">
                                            <datalist id="listadocumento">
                                                @foreach ($documentos as $obj)
                                                <option value="{{ $obj['id'] }}">{{ $obj['id'] }}-{{ $obj['nombre'] }}</option>
                                                @endforeach
                                            </datalist> 
                                        </td>
                                        <td style="width: 150px"> <label>Número</label><input placeholder="numero_documento1" class="form-control" id="numero_documento1"></td>
                                        <td style="width: 150px"> <label>Prefijo</label><input placeholder="prefijo" class="form-control" id="prefijo1"></td>
                                        <td style="width: 150px"> <label>Fecha </label><input type="date" placeholder="fecha_documento" class="form-control" id="fecha_documento1"></td>         
                                        <td style="width: 150px"> <label>Valor</label><input placeholder="valor_transaccion" class="form-control" id="valor_transaccion1"></td>
                                        <td style="width: 150px"> 
                                            <label>Auxiliar</label>
                                            <input type="text" placeholder="id_axiliar" list="listaauxiliar" class="form-control" id="id_axiliar">
                                        </td>
                                        <td style="width: 150px"> 
                                            <label>Tipo</label>
                                            <select class="form-control" id="tipo_transaccion" name="tipo_transaccion1">
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </td>
                                        <td style="width: 150px"> <label>Tercero</label> <input id="id_cliente" type="hidden"> <input placeholder="tercero" class="form-control" id="tercero" onkeyup="buscarcliente(this.value)"><p style="font-size:10px;color:black;" id="resCliente">Para buscar el cliente debe tener un minimo de 3 caracteres</p></td> 
                                        <td style="width: 150px"><label><br></label><div class="btn btn-success" onclick="obj.createComprobantes()" id="botonguardar"><i class="fas fa-plus-circle"></i></div></td>
                                    </tr>
                                </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            
    </div>
</div>
<script type="text/javascript">
var obj = new Obj();
obj.initial();
function Obj(){
    this.initial = function(){
        $('.formulario_').hide();
    };
    this.value = function(input){
        if(config.getClave() == input.value){
             console.log('correcto');
             $('.formulario_').show();
        }
    };

    this.createComprobantes = function(){
        var parametros = {
            'tipo_documento': $('#tipo_documento').val(),
            'id_documento': $('#id_documento1').val(),
            'numero_documento': $('#numero_documento1').val(),
            'prefijo': $('#prefijo1').val(),
            'fecha_documento': $('#fecha_documento1').val(),
            'valor_transaccion': $('#valor_transaccion1').val(),
            'tipo_transaccion': $('#tipo_transaccion1').val(),
            'tercero': $('#id_cliente').val(),
            'id_axiliar': $('#id_axiliar').val()
        };
        console.log(parametros);
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/createComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                $('#resultado').css("display","none");
                $("#cuerpo").html("");
                for(var i=0; i<response.contabilidades.length; i++){
                    var id = response.contabilidades[i].id;
                    var tr = `<tr>
                    <td>`+response.contabilidades[i].numero_documento+` `+response.contabilidades[i].prefijo+`</td>
                    <td>`+response.contabilidades[i].id_auxiliar+`</td>`;
                    if(response.contabilidades[i].tipo_transaccion == 'D'){
                        valor_trans = new Intl.NumberFormat("de-DE").format(response.contabilidades[i].valor_transaccion);
                        tr = tr + `
                        <td style="text-align: right;">`+ valor_trans +`</td>
                        <td style="text-align: right;">0</td>
                        `;
                    }
                    else{
                        valor_trans = new Intl.NumberFormat("de-DE").format(response.contabilidades[i].valor_transaccion);
                        tr = tr + `
                        <td style="text-align: right;">0</td>
                        <td style="text-align: right;">`+ valor_trans +`</td>
                        `;
                    }
                    
                    tr = tr + `
                    <td>`+response.contabilidades[i].tercero+`</td>
                    <td>
                        <div class='btn btn-danger' onclick='obj.deleteComprobantes(`+id+`, `+response.contabilidades[i].numero_documento+`)'>x</div>
                    </td>
                    </tr>`;
                    $("#cuerpo").append(tr)
                }
            }
        });
    }

    this.viewComprobantes = function( numero_documento ){
        parametros = {
            "numero_documento" : numero_documento
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/viewComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').css("display","none");
                
                obj.recargarBody(response);
            }
        });
    }

    this.recargarBody = function (response){
        $('#id_cliente').val(response.contabilidades[0].tercero);
        $('#tipo_documento').val(response.contabilidades[0].tipo_documento);
        $('#tercero').val(response.contabilidades[0].nit);
        $('#id_sucursal').val(response.contabilidades[0].id_sucursal);
        $('#id_documento1').val(response.contabilidades[0].id_documento);
        $('#numero_documento1').val(response.contabilidades[0].numero_documento);
        $('#prefijo').val(response.contabilidades[0].prefijo);
        $('#fecha_documento1').val(response.contabilidades[0].fecha_documento);
        
        
        $("#cuerpo").html("");
        debitos = 0;
        creditos = 0;
        for(var i=0; i<response.contabilidades.length; i++){
            var id = response.contabilidades[i].id;
            var tr = `<tr>
            <td>`+response.contabilidades[i].codigo+`</td>
            <td>`+response.contabilidades[i].razon_social+`</td>
            <td>`+response.contabilidades[i].descripcion+`</td>`;
            if(response.contabilidades[i].tipo_transaccion == 'D'){
                debitos = debitos + response.contabilidades[i].valor_transaccion;
                valor_trans = new Intl.NumberFormat("de-DE").format(response.contabilidades[i].valor_transaccion);
                tr = tr + `
                <td style="text-align: right;">`+valor_trans+`</td>
                <td style="text-align: right;"></td>
                `;
            }
            else{
                creditos = creditos + response.contabilidades[i].valor_transaccion;
                valor_trans = new Intl.NumberFormat("de-DE").format(response.contabilidades[i].valor_transaccion);
                tr = tr + `
                <td style="text-align: right;"></td>
                <td style="text-align: right;">`+valor_trans+`</td>
                `;
            }
            
            tr = tr + `
            <td>
                <div class='btn btn-danger' onclick='obj.deleteComprobantes(`+id+`, `+response.contabilidades[i].numero_documento+`)'>x</div>
            </td>
            </tr>`;
            $("#cuerpo").append(tr)
        }
        debitos = new Intl.NumberFormat("de-DE").format(debitos);
        creditos = new Intl.NumberFormat("de-DE").format(creditos);
        $("#cuerpo").append(`<tr>
            <td colspan=3></td>
            <td style="text-align: right;"><h5>`+debitos+`</h5></td>
            <td style="text-align: right;"><h5>`+creditos+`</h5></td>
            <td></td>
            </tr>`);
        $('#tablecont').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ], 
            "paging": false
        });
    }

    this.deleteComprobantes = function( id, numero_documento ){
        parametros = {
            "id" : id,
            "numero_documento" : numero_documento
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/deleteComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').css("display","none");
                $("#cuerpo").html("");
                if(response.respuesta == "Ok"){
                    obj.recargarBody(response);
                }
                else{
                    alert("error en proceso");
                }
            }
        });
    }

    this.updateComprobantes = function( id, numero_documento ){
        if($('#Dvalor_transaccion'+id).val() != "0"){
            tipo_transaccion = "D";
            valor_transaccion = $('#Dvalor_transaccion'+id).val();
        }
        else{
            tipo_transaccion = "C";
            valor_transaccion = $('#Cvalor_transaccion'+id).val();
        }
        parametros = {
            "id" : id,
            "numero_documento" : numero_documento,
            "id_auxiliar" : $('#id_auxiliar'+id).val(),
            "tipo_transaccion" : tipo_transaccion,
            "valor_transaccion" :  valor_transaccion,
            "tercero" : $('#tercero'+id).val()
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/updateComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').css("display","none");
                $("#cuerpo").html("");
                if(response.respuesta == "Ok"){
                    obj.recargarBody(response);
                }
                else{
                    alert("error en proceso");
                }
            }
        });
    }
}
</script>

<script>
    $(document).ready( function () {
        $('#botonguardar').hide();
        $('#tableregimenes').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ] 
        });
    } );

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
                    $('#resCliente').text("Cliente existe"); 
                    $('#id_cliente').val(cliente.id);
                    $('#botonguardar').show();   
                }  
                else{
                    $('#resCliente').text("Cliente no existe, si desea crearlo, diligencie los datos restantes");               
                    $('#id_cliente').val(0);
                    $('#botonguardar').hide();
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

<datalist id="listaauxiliar">
    @foreach ($auxiliares as $obj)
    <option value="{{ $obj['id'] }}">{{ $obj['codigo'] }}-{{ $obj['descripcion'] }}</option>
    @endforeach
</datalist> 

@endsection()