@extends('layout')

@section('content')

<?php 


$auxiliars = App\Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->orderBy('codigo','asc')->get();

$directorios = App\Directorios::where('id_empresa','=',Session::get('id_empresa'))->get();

?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Submenu Contabilidad</h4>
                    <p class="category">Nota: Las imagenes que se muestran a continuación representan un link a donde podrás viajar por intersoft.</p>
                </div>
                <div class="content">
                    

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i> 
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Ir a la sección del manual
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Documentos</h4>
                    <p class="category">Elige que quieres hacer</p>                    
                </div>
                <div class="col-md-12">
                        <div class="col-md-6">
                            <label>Descargar Informe Diario</label><br>
                            <div onclick="comprobantesDiario.envioExcel()" class="btn btn-success">(EXCEL)</div>
                            <div onclick="comprobantesDiario.envioPDF()" class="btn btn-danger">(PDF)</div>
                        </div>                                
                        <div class="col-md-3"><label>Desde:</label><input id="desde" class="form-control" type="date"></div>
                        <div class="col-md-3"><label>Hasta:</label><input id="hasta" class="form-control" type="date"></div>
                    </div>
                    <div class="col-md-12"><br></div>
                <div class="content">
                    <div> 
                            
                    <table class="table table-hover table-striped"  id="datos">
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
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/1?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>RECIBOS DE CAJA</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/2?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>FACTURAS DE VENTA</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/3?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>FACTURAS DE COMPRA</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/4?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>CAUSACIONES</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/5?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>06</td>
                                            <td>DEPRECIACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/6?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>NOTA DB</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/7?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>08</td>
                                            <td>CONSIGNACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/8?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>09</td>
                                            <td>NOTA CR</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/9?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>NOTA CONTABLE</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/10?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>COMPROBANTE CIERRE CONTABLE</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/11?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>INGRESO X CONSIGNACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/12?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>SALIDA X CONSIGNACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/13?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>INGRESO Y SALIDA DE PRODUCCION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/14?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                        <tr>
                                            <td>15</td>
                                            <td>NOTA NITF</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/15?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                            <td><a class="btn btn-success" data-toggle="modal" data-target="#ingresar">+</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ingresar" role="dialog">
    <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresar Encabezado</h4><hr>
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
                    <input type="text" value="0" class="form-control" name="id_documento" id="id_documento">
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
                    @foreach($directorios as $obj)
                    <option value="{{ $obj['id'] }}">{{ $obj['nit'] }}-{{ $obj['razon_social'] }}</option>
                    @endforeach
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

@endsection()

