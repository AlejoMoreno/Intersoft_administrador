@extends('layout')

@section('content')

<?php 


?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Contabilidad</h4>
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
                    <h4 class="title">Sub menu Contabilidad</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                    <div> 
                    <table class="table table-hover table-striped"  id="datos">
                                    <thead>
                                        <tr><th></th>
                                        <th>Opcion</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr></thead>
                                    <tbody>
                                        <tr onclick="config.Redirect('/contabilidad/cuentas');">
                                            <td><img width="30" src="/assets/154923.svg"></td>
                                            <td>PUC</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/comprobantesdiario');">
                                            <td><img width="30" src="/assets/2145545.svg"></td>
                                            <td>Comprobantes de Diario</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/librosauxiliares');">
                                            <td><img width="30" src="/assets/2090647.svg"></td>
                                            <td>Libros Auxiliares</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/librosmayores');">
                                            <td><img width="30" src="/assets/2144086.svg"></td>
                                            <td>Libros Mayores</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/balancecomprobacion');">
                                            <td><img width="30" src="/assets/950943.svg"></td>
                                            <td>Balance de Comprobación</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/perdidasganancias');">
                                            <td><img width="30" src="/assets/943800.svg"></td>
                                            <td>Perdidas y Ganancias</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/analisismensual');">
                                            <td><img width="30" src="/assets/1006636.svg"></td>
                                            <td>Análisis Mensual Gastos</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/mediosmagneticos');">
                                            <td><img width="30" src="/assets/888850.svg"></td>
                                            <td>Medios Magnéticos</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/balancegeneral');">
                                            <td><img width="30" src="/assets/2145673.svg"></td>
                                            <td>Balance General</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/certificados');">
                                            <td><img width="30" src="/assets/2132241.svg"></td>
                                            <td>Certificados</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/contabilidad/liquidacionimpuestos');">
                                            <td><img width="30" src="/assets/2145586.svg"></td>
                                            <td>Liquidación Impuestos</td>
                                            <td></td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
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

