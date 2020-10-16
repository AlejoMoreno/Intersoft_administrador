@extends('layout')

@section('content')

<?php 




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
    <h4 class="title">Comprobantes de diario</h4>
</div>

<div class="row top-11-w" style="padding:2%;">

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Tipos de documentos</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">Realice el filtro y seleccione consultar si desea agregar o eliminar algun registro. De lo contrario inserte
                dicho comprobante diario.
            </p>
            <div class="row">
                <div class="col-md-4">
                    <label>Informe Diario</label><br>
                    <div onclick="comprobantesDiario.envioExcel()" class="btn btn-success"><i class="fas fa-file-excel"></i></div>
                    <div onclick="comprobantesDiario.envioPDF()" class="btn btn-danger"><i class="fas fa-print"></i></div>
                </div>                                
                <div class="col-md-4"><label>Desde:</label><input id="desde" class="form-control" type="date"></div>
                <div class="col-md-4"><label>Hasta:</label><input id="hasta" class="form-control" type="date"></div>
            </div>
            <br>
            <table class="table table-hover table-striped"  id="tabla">
                <thead>
                    <TH>código</TH>
                    <th>Nombre</th>
                    <th>Consultar</th>
                    <th>Insertar</th>
                </tr></thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>EGRESO</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/1?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                        
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>RECIBOS DE CAJA</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/2?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td>FACTURAS DE VENTA</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/3?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>04</td>
                        <td>FACTURAS DE COMPRA</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/4?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>05</td>
                        <td>CAUSACIONES</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/5?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>06</td>
                        <td>DEPRECIACION</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/6?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>07</td>
                        <td>NOTA DB</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/7?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>08</td>
                        <td>CONSIGNACION</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/8?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>09</td>
                        <td>NOTA CR</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/9?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>NOTA CONTABLE</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/10?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>COMPROBANTE CIERRE CONTABLE</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/11?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>INGRESO X CONSIGNACION</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/12?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>SALIDA X CONSIGNACION</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/13?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>INGRESO Y SALIDA DE PRODUCCION</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/14?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>NOTA NITF</td>
                        <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/15?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())"><i class="fas fa-pen-square"></i></a></td>
                        <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar"><i class="fas fa-plus-circle"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-4">Insertar comprobante </h5>
            </div>
            <div class="panel-body" >
                <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados con el comprobante a crear.
                </p>

                <div class="modal fade" id="ingresar" role="dialog" style="position: relative;">
                    <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <form action="/contabilidad/comprobantes/createComprobantes" method="POST">
                        <input type="hidden" name="id_sucursal" id="id_sucursal" value="<?php echo Session::get('sucursal'); ?>">
                        <input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo Session::get('id_empresa'); ?>">
                        <div class="row">
                            <div class="col-md-6"><label># Documento</label></div>
                            <div class="col-md-6">
                                <input type="text" id="numero_documento" name="numero_documento" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Auxiliar</label></div>
                            <div class="col-md-6">
                                <select name="id_auxiliar" id="id_auxiliar" class="form-control">
                                    @foreach($auxiliars as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['codigo'] }}-{{ $obj['descripcion'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Tipo Documento</label></div>
                            <div class="col-md-6">
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
                            </div>
                        </div>
                        
                        </div>
                        <div class="modal-body">
                        <p>Ingresar datos:</p>
                        <div class="row">
                                <div class="col-md-6"><label>Id Documento</label></div>
                                <div class="col-md-6">
                                    <input type="text" list="listadocumentos" value="0" class="form-control" name="id_documento" id="id_documento">
                                    <datalist id="listadocumentos">
                                        @foreach ($documentos as $doc )
                                        <option value="{{ $doc['id'] }}">{{ $doc['id'] }}-{{ $doc['nombre'] }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><label>Prefijo</label></div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="prefijo" id="prefijo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><label>Fecha Documento</label></div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="fecha_documento" id="fecha_documento">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><label>Valor Transacción</label></div>
                                <div class="col-md-6">
                                    <input type="text" data-type="currency"  class="form-control" name="valor_transaccion" id="valor_transaccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><label>Tipo Transacción</label></div>
                                <div class="col-md-6">
                                    <select class="form-control" id="tipo_transaccion" name="tipo_transaccion">
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><label>Tercero</label></div>
                                <div class="col-md-6">
                                    <select class="form-control" id="tercerp" name="tercero">
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Guardar</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                    </div>
                </div>
                

            </div>
        </div>
    </div>

</div>


<!-- Modal -->


<script>
var comprobantesDiario = new ComprobantesDiario();

function ComprobantesDiario(){

    this.envioPDF = function(){
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        config.Redirect("/pdf/pdf_comprobanteDiario?desde="+desde+"&hasta="+hasta);
    }

    this.envioExcel = function(){
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        config.Redirect("/excel/excelComprobantesDiario?desde="+desde+"&hasta="+hasta);
    }
}
</script>

<script>
$(document).ready(function() {
    var table = $('#tabla').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});
</script>

@endsection()

