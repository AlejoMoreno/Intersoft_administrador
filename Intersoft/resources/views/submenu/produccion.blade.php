@extends('layout')

@section('content')

<?php 


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Producción</h4>
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
                    <h4 class="title">Sub menu Producción</h4>
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
                                        <tr onclick="config.Redirect('/inventario/fichatecnica');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/2082/2082163.svg"></td>
                                            <td>Ficha técnica</td>
                                            <td><img width="20"  src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/materiaprima');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/1924/1924873.svg"></td>
                                            <td>Inventario Materia Prima</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/ordenesdeproduccion');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/1037/1037503.svg"></td>
                                            <td>Ordenes de Producción</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/liquidacionobra');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/157/157631.svg"></td>
                                            <td>Liquidación Mano de Obra</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/costosdirectos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/1286/1286724.svg"></td>
                                            <td>Costos Directos</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/ingresoporproduccion');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/743/743007.svg"></td>
                                            <td>Ingreso por producción</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
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