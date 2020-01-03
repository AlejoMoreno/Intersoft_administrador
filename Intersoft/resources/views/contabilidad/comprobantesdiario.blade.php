@extends('layout')

@section('content')

<?php 


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
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>EGRESO</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/1?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>RECIBOS DE CAJA</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/2?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>FACTURAS DE VENTA</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/3?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>FACTURAS DE COMPRA</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/4?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>CAUSACIONES</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/5?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>06</td>
                                            <td>DEPRECIACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/6?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>NOTA DB</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/7?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>08</td>
                                            <td>CONSIGNACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/8?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>09</td>
                                            <td>NOTA CR</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/9?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>NOTA CONTABLE</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/10?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>COMPROBANTE CIERRE CONTABLE</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/11?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>INGRESO X CONSIGNACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/12?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>SALIDA X CONSIGNACION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/13?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>INGRESO Y SALIDA DE PRODUCCION</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/14?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>15</td>
                                            <td>NOTA NITF</td>
                                            <td><a class="btn btn-info" onclick="config.Redirect('/contabilidad/doc/15?desde='+$('#desde').val()+'&hasta='+$('#hasta').val())">*</a></td>
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

