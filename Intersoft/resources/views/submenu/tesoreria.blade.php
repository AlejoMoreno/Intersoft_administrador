@extends('layout')

@section('content')

<?php 


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Tesorería</h4>
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
                    <h4 class="title">Sub menu Tesorería</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                    <div> 
                    <table class="table table-hover table-striped">
                                    <thead>
                                        <tr><th></th>
                                        <th>Opcion</th>
                                        <th></th>
                                    </tr></thead>
                                    <tbody>
                                        <tr onclick="config.Redirect('/cartera/gastos');">
                                            <td><img width="30" src="/assets/1907668.svg"></td>
                                            <td>Control de Gastos</td>
                                            <td><img width="20" onclick="config.Redirect('inventarios/searchProductos.html');" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/otrosingresos');">
                                            <td><img width="30" src="/assets/1907692.svg"></td>
                                            <td>Otros Ingresos</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/egresos');">
                                            <td><img width="30" src="/assets/2146243.svg"></td>
                                            <td>Pago a Proveedores</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/ingresos');">
                                            <td><img width="30" src="/assets/2174854.svg"></td>
                                            <td>Cobro Cartera</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/cheques');">
                                            <td><img width="30" src="/assets/138297.svg"></td>
                                            <td>Cheques</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/Importaciones');">
                                            <td><img width="30" src="/assets/2083108.svg"></td>
                                            <td>Pago Importaciones</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/pagoobligaciones');">
                                            <td><img width="30" src="/assets/495653.svg"></td>
                                            <td>Retefuente, Iva, Reteica</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/extracto');">
                                            <td><img width="30" src="/assets/2145576.svg"></td>
                                            <td>Extracto y Cuentas de Cobro</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/cartera/Causaciones');">
                                            <td><img width="30" src="/assets/2150839.svg"></td>
                                            <td>Causaciones</td>
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