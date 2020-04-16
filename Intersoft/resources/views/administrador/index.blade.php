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
                                            <td><img width="30" src="/assets/148971.png"></td>
                                            <td>Contratos</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/retefuentes');">
                                            <td><img width="30" src="/assets/logodian.png"></td>
                                            <td>Rete-Fuentes</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/regimenes');">
                                            <td><img width="30" src="/assets/logodian.png"></td>
                                            <td>Regímenes</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/sucursales');">
                                            <td><img width="30" src="/assets/149060.svg"></td>
                                            <td>Sucursales</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/documentos');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Documentos entrada y salida de mercancía</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/tipopagos');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Administración de Tipo Pagos</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        
                                        <tr onclick="config.Redirect('/administrador/departamentos');">
                                            <td><img width="30" src="/assets/185277.svg"></td>
                                            <td>Departamentos</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/ciudades');">
                                            <td><img width="30" src="/assets/189060.svg"></td>
                                            <td>Ciudades</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/actividad');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Actividad</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/bancos');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Bancos</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/base_retencion');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Base Retención</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/mis_bancos');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Mis Bancos</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/centro_de_costo');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Centro de Costo</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/control');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Control  (CRTL)</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/cuenta');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Cuenta</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/entidad');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Entidad</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/etapa');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Etapa </td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/forma');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Forma</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/limi');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>LIMI</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/novedad');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Novedad</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/plan');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Plan</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/porcion');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Porción</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/rets');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>RETS</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/tarjeta');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Tarjeta</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/tgru');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>TGRU</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/trabajo');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td>Trabajo</td>                                             
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_clases');">
                                            <td><img width="30" src="/assets/485280.png"></td>
                                            <td>Directorio Clases</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_tipos');">
                                            <td><img width="30" src="/assets/485482.png"></td>
                                            <td>Directorio tipos</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_tipo_terceros');">
                                            <td><img width="30" src="/assets/148971.png"></td>
                                            <td>Directorio Tipo Terceros</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/marcas');">
                                            <td><img width="30" src="/assets/265706.svg"></td>
                                            <td>Marcas</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/lineas');">
                                            <td><img width="30" src="/assets/149023.svg"></td>
                                            <td>Líneas</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/clasificaciones');">
                                            <td><img width="30" src="/assets/272480.png"></td>
                                            <td>Clasificaciones de los productos</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/inventario/tipo_presentaciones');">
                                            <td><img width="30" src="/assets/340077.svg"></td>
                                            <td>Tipo Presentaciones</td>
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
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/directorio');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

