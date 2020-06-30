@extends('layout')

@section('content')



<?php 

$lista = null;
if(Session::get('cargo') == "Administrador" || Session::get('cargo') == "admin" || Session::get('cargo') == "Admin"){
    $lista = ["Inicio", "Directorio", "Inventario", "Producción", "Facturación", "Tesorería", "Contabilidad", "Parámetros", "Salida"];
}
if(Session::get('cargo') == "Ventas" || Session::get('cargo') == "venta" || Session::get('cargo') == "Vendedor"){
    $lista = ["Inicio", "Directorio", "Producción", "Facturación", "Tesorería", "Salida"];
}
if(Session::get('cargo') == "Obrero" || Session::get('cargo') == "obrero" || Session::get('cargo') == "Obrero"){
    $lista = ["Inicio", "Inventario", "Producción", "Salida"];
}

?>

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
                        
                            <?php if(in_array("Inicio",$lista)){ ?>
                                <tr onclick="config.Redirect('/index');">
                                    <td><img width="30" src="/assets/204366.svg"></td>
                                    <td colspan="2">Inicio</td> 
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Directorio",$lista)){ ?>
                                <tr onclick="config.Redirect('/submenu/directorio');">
                                    <td><img width="30" src="/assets/2245320.svg"></td>
                                    <td colspan="2">Información General</td>
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Inventario",$lista)){ ?>
                                <tr onclick="config.Redirect('/submenu/inventario');">
                                    <td><img width="30" src="/assets/1924873.svg"></td>
                                    <td colspan="2">Inventario</td>
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Producción",$lista)){ ?>
                                <tr onclick="config.Redirect('/submenu/produccion');">
                                    <td><img width="30" src="/assets/2166907.svg"></td>
                                    <td colspan="2">Producción</td>
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Facturación",$lista)){ ?>
                                <tr onclick="config.Redirect('/submenu/facturacion');">
                                    <td><img width="30" src="/assets/138360.svg"></td>
                                    <td colspan="2">Facturación</td>
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Tesorería",$lista)){ ?>
                                <tr onclick="config.Redirect('/submenu/tesoreria');">
                                    <td><img width="30" src="/assets/1162498.svg"></td>
                                    <td colspan="2">Tesorería</td>
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Contabilidad",$lista)){ ?>
                                <tr onclick="config.Redirect('/submenu/contabilidad');">
                                    <td><img width="30" src="/assets/313062.svg"></td>
                                    <td colspan="2">Contabilidad</td>
                                </tr>
                            <?php } ?>

                            <?php if(in_array("Salida",$lista)){ ?>
                                <tr onclick="config.Redirect('/cerrar');">
                                    <td><img width="30" src="/assets/529873.svg"></td>
                                    <td colspan="2">Salida</td>
                                </tr>
                            <?php } ?>

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