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
                                            <td><a class="btn btn-info" href="/contabilidad/doc/1">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>RECIBOS DE CAJA</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/2">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>FACTURAS DE VENTA</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/3">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>FACTURAS DE COMPRA</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/4">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>CAUSACIONES</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/5">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>06</td>
                                            <td>DEPRESIACION</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/6">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>NOTA DB</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/7">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>08</td>
                                            <td>CONSIGNACION</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/8">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>09</td>
                                            <td>NOTA CR</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/9">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>NOTA CONTABLE</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/10">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>COMPROBANTE CIERRE CONTABLE</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/11">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>INGRESO X CONSIGNACION</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/12">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>SALIDA X CONSIGNACION</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/13">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>INGRESO Y SALIDA DE PRODUCCION</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/14">*</a></td>
                                        </tr>
                                        <tr>
                                            <td>15</td>
                                            <td>NOTA NITF</td>
                                            <td><a class="btn btn-info" href="/contabilidad/doc/15">*</a></td>
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

@endsection()

