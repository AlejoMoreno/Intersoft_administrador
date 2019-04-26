@extends('layout')

@section('content')

<?php 

use App\Usuarios;
$usuarios = Usuarios::all();
use App\Directorios;
$directorios = Directorios::all();
use App\Departamentos;
$departamentos = Departamentos::all();
use App\Ciudades;
$ciudades = Ciudades::all();
use App\Contrato_laborals;
$contratos = Contrato_laborals::all();
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
$sucursales = Sucursales::all();
use App\Lineas;
$lineas = Lineas::all();
use App\Marcas;
$marcas = Marcas::all();
use App\Clasificaciones;
$clasificaciones = Clasificaciones::all();
use App\Tipo_presentaciones;
$tipo_presentaciones = Tipo_presentaciones::all();
use App\Documentos;
$documentos = Documentos::all();?>



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
                                        <tr onclick="config.Redirect('/administrador/usuarios');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/201/201570.svg"></td>
                                            <td>Usuarios</td>
                                            <td><?php echo sizeof($usuarios); ?></td>
                                            <td><img width="20" onclick="config.Intoredirect('administrador/usuarios.html');" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorios');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/265/265675.png"></td>
                                            <td>Directorio</td>
                                            <td><?php echo sizeof($directorios); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/departamentos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/185/185277.svg"></td>
                                            <td>Departamentos</td>
                                            <td><?php echo sizeof($departamentos); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/ciudades');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/189/189060.svg"></td>
                                            <td>Ciudades</td>
                                            <td><?php echo sizeof($ciudades); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
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
                                        <tr onclick="config.Redirect('/administrador/directorio_clases');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/485/485280.png"></td>
                                            <td>Directorio Clases</td>
                                            <td><?php echo sizeof($directorio_clases); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_tipos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/485/485482.png"></td>
                                            <td>Directorio tipos</td>
                                            <td><?php echo sizeof($directorio_tipos); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_tipo_terceros');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/148/148971.png"></td>
                                            <td>Directorio Tipo Terceros</td>
                                            <td><?php echo sizeof($directorio_tipo_terceros); ?></td>
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
                                        <tr onclick="config.Redirect('/inventario/marcas');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/265/265706.svg"></td>
                                            <td>Marcas</td>
                                            <td><?php echo sizeof($marcas); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/lineas');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/149/149023.svg"></td>
                                            <td>Líneas</td>
                                            <td><?php echo sizeof($lineas); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/clasificaciones');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/272/272480.png"></td>
                                            <td>Clasificaciones de los productos</td>
                                            <td><?php echo sizeof($clasificaciones); ?></td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/tipo_presentaciones');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/340/340077.svg"></td>
                                            <td>Tipo Presentaciones</td>
                                            <td><?php echo sizeof($tipo_presentaciones); ?></td>
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Intoredirect('dashboard.html');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

