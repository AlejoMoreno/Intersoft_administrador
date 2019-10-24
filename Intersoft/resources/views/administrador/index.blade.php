@extends('layout')

@section('content')

<?php 

use App\Usuarios;
$usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Directorios;
$directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Departamentos;
$departamentos = Departamentos::all();
use App\Ciudades;
$ciudades = Ciudades::all();
use App\Contrato_laborals;
$contratos = Contrato_laborals::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Retefuentes;
$retefuentes = Retefuentes::all();
use App\Regimenes;
$regimenes = Regimenes::all();
use App\Directorio_clases;
$directorio_clases = Directorio_clases::all();
use App\Directorio_tipos;
$directorio_tipos = Directorio_tipos::all();
use App\Directorio_tipo_terceros;
$directorio_tipo_terceros = Directorio_tipo_terceros::all();
use App\Sucursales;
$sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Lineas;
$lineas = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Marcas;
$marcas = Marcas::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Clasificaciones;
$clasificaciones = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Tipo_presentaciones;
$tipo_presentaciones = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
use App\Documentos;
$documentos = Documentos::where('id_empresa','=',Session::get('id_empresa'))->get();?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Administrador</h4>
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
                    <h4 class="title">Sub menu Administrador</h4>
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
                                        <tr onclick="config.Redirect('/administrador/contratos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/148/148971.png"></td>
                                            <td>Contratos</td>
                                            <td><?php echo sizeof($contratos); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/retefuentes');">
                                            <td><img width="30" src="https://pbs.twimg.com/profile_images/728257432313532416/ATp81uTy.jpg"></td>
                                            <td>Rete-Fuentes</td>
                                            <td><?php echo sizeof($retefuentes); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/regimenes');">
                                            <td><img width="30" src="https://pbs.twimg.com/profile_images/728257432313532416/ATp81uTy.jpg"></td>
                                            <td>Regímenes</td>
                                            <td><?php echo sizeof($regimenes); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/sucursales');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/149/149060.svg"></td>
                                            <td>Sucursales</td>
                                            <td><?php echo sizeof($sucursales); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/documentos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/148/148912.svg"></td>
                                            <td>Administración de Documentos</td>
                                            <td><?php echo sizeof($documentos); ?></td>
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

