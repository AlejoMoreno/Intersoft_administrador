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
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/204/204366.svg"></td>
                                <td colspan="2">Inicio</td> 
                            </tr>
                            <tr onclick="config.Redirect('/calendario/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/123/123392.svg"></td>
                                <td colspan="2">Directorio</td>
                            </tr>
                            <tr onclick="config.Redirect('/inventario/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/1924/1924873.svg"></td>
                                <td colspan="2">Inventario</td>
                            </tr>
                            <tr onclick="config.Redirect('/salida/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/138/138360.svg"></td>
                                <td colspan="2">Facturación</td>
                            </tr>
                            <tr onclick="config.Redirect('/cartera/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/31/31368.svg"></td>
                                <td colspan="2">Tesorería</td>
                            </tr>
                            <tr onclick="config.Redirect('/contabilidad/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/313/313062.svg"></td>
                                <td colspan="2">Contabilidad</td>
                            </tr>
                            <tr onclick="config.Redirect('/calendario/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/123/123392.svg"></td>
                                <td colspan="2">Producción</td>
                            </tr>
                            <tr onclick="config.Redirect('/calendario/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/123/123392.svg"></td>
                                <td colspan="2">Calendario</td>
                            </tr>
                            <tr onclick="config.Redirect('/administrador/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/148/148912.svg"></td>
                                <td colspan="2">Administrador</td>
                            </tr>
                            <tr onclick="config.Redirect('/reportes/index');">
                                <td><img width="30" src="https://image.flaticon.com/icons/svg/1055/1055644.svg"></td>
                                <td colspan="2">Reportes</td>
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