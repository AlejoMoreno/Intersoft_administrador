@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Menú</h4>
                </div>
                <div class="content">
                    

                	<table class="table table-hover table-striped"  id="datos">
                        <thead>
                            <tr><th></th>
                            <th>Opcion</th>
                            <th></th>
                        </tr></thead>
                        <tbody>
                            <tr onclick="config.Redirect('/index');">
                                <td><img width="30" src="/assets/204366.svg"></td>
                                <td colspan="2">Inicio</td> 
                            </tr>
                            <tr onclick="config.Redirect('/submenu/directorio');">
                                <td><img width="30" src="/assets/2245320.svg"></td>
                                <td colspan="2">Información General</td>
                            </tr>
                            <tr onclick="config.Redirect('/submenu/inventario');">
                                <td><img width="30" src="/assets/1924873.svg"></td>
                                <td colspan="2">Inventario</td>
                            </tr>
                            <tr onclick="config.Redirect('/submenu/produccion');">
                                <td><img width="30" src="/assets/2166907.svg"></td>
                                <td colspan="2">Producción</td>
                            </tr>
                            <tr onclick="config.Redirect('/submenu/facturacion');">
                                <td><img width="30" src="/assets/138360.svg"></td>
                                <td colspan="2">Facturación</td>
                            </tr>
                            <tr onclick="config.Redirect('/submenu/tesoreria');">
                                <td><img width="30" src="/assets/1162498.svg"></td>
                                <td colspan="2">Tesorería</td>
                            </tr>
                            <tr onclick="config.Redirect('/submenu/contabilidad');">
                                <td><img width="30" src="/assets/313062.svg"></td>
                                <td colspan="2">Contabilidad</td>
                            </tr>
                            <tr onclick="config.Redirect('/cerrar');">
                                <td><img width="30" src="/assets/529873.svg"></td>
                                <td colspan="2">Salida</td>
                            </tr>
                        </tbody>
                    </table>



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

        
    </div>
</div>

@endsection()