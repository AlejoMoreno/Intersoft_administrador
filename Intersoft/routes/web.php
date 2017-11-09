<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/laravel', function () {
    return view('welcome');
});

//login
Route::get('/', function(){
    return view('login');
});
Route::post('/login', 'UsuariosController@login');
Route::get('/layout', function(){
    return view('layout');
});

//menucontrolador
Route::get('/administrador/index', function(){
    return view('administrador.index');
});
Route::get('/inventario/index', function(){
    return view('inventario.index');
});
Route::get('/documentos/documentos', function(){
    return view('documentos.documentos');
});

//install
Route::get('/install', function(){
    return view('install');
});
Route::post('/install', 'EmpresasController@create');

//ciudades
Route::get('/ciudades/all', 'CiudadesController@all');
Route::get('/ciudades', function(){
    return view('ciudades');
});

//Departamentos
Route::get('/departamentos/all', 'DepartamentosController@all');
Route::get('/departamentos/{id}', 'DepartamentosController@showone');
Route::get('/administrador/departamentos', 'DepartamentosController@index');
Route::get('/administrador/departamentos/delete/{id}', 'DepartamentosController@delete');
Route::get('/administrador/departamentos/update/{id}', 'DepartamentosController@showupdate');
Route::post('/administrador/departamentos/create', 'DepartamentosController@create');
Route::post('/administrador/departamentos/update', 'DepartamentosController@update');

//Ciudades
Route::get('/ciudades/all', 'CiudadesController@all');
Route::get('/ciudades/departamento/{id}', 'CiudadesController@departamento');
Route::get('/administrador/ciudades', 'CiudadesController@index');
Route::get('/administrador/ciudades/delete/{id}', 'CiudadesController@delete');
Route::get('/administrador/ciudades/update/{id}', 'CiudadesController@showupdate');
Route::post('/administrador/ciudades/create', 'CiudadesController@create');
Route::post('/administrador/ciudades/update', 'CiudadesController@update');

//inventario Lineas
Route::get('/inventario/lineas', function(){
    return view('inventario.lineas');
});
Route::get('/inventario/lineas/update/{id}', function(){
    return view('inventario.lineas-update');
});

//contrato laboral
Route::get('/administrador/contratos', 'Contrato_laboralController@index');
Route::get('/administrador/contratos/all', 'Contrato_laboralController@all');
Route::get('/administrador/contratos/{id}', 'Contrato_laboralController@departamento');
Route::get('/administrador/contratos/delete/{id}', 'Contrato_laboralController@delete');
Route::get('/administrador/contratos/update/{id}', 'Contrato_laboralController@showupdate');
Route::post('/administrador/contratos/create', 'Contrato_laboralController@create');
Route::post('/administrador/contratos/update', 'Contrato_laboralController@update');

//usuarios
Route::get('/administrador/usuarios', 'UsuariosController@index');
Route::get('/administrador/usuarios/all', 'UsuariosController@all');
Route::get('/administrador/usuarios/{id}', 'UsuariosController@departamento');
Route::get('/administrador/usuarios/delete/{id}', 'UsuariosController@delete');
Route::get('/administrador/usuarios/update/{id}', 'UsuariosController@showupdate');
Route::post('/administrador/usuarios/create', 'UsuariosController@create');
Route::post('/administrador/usuarios/update', 'UsuariosController@update');

//sucursales
Route::get('/administrador/sucursales', 'SucursalesController@index');
Route::get('/administrador/sucursales/all', 'SucursalesController@all');
Route::get('/administrador/sucursales/{id}', 'SucursalesController@departamento');
Route::get('/administrador/sucursales/delete/{id}', 'SucursalesController@delete');
Route::post('/administrador/sucursales/create', 'SucursalesController@create');
Route::post('/administrador/sucursales/update', 'SucursalesController@update');

//retefuentes
Route::get('/administrador/retefuentes', 'RetefuentesController@index');
Route::get('/administrador/retefuentes/all', 'RetefuentesController@all');
Route::get('/administrador/retefuentes/{id}', 'RetefuentesController@departamento');
Route::get('/administrador/retefuentes/delete/{id}', 'RetefuentesController@delete');
Route::get('/administrador/retefuentes/update/{id}', 'RetefuentesController@showupdate');
Route::post('/administrador/retefuentes/create', 'RetefuentesController@create');
Route::post('/administrador/retefuentes/update', 'RetefuentesController@update');

//resoluciones

//regimenes
Route::get('/administrador/regimenes', 'RegimenesController@index');
Route::get('/administrador/regimenes/all', 'RegimenesController@all');
Route::get('/administrador/regimenes/{id}', 'RegimenesController@departamento');
Route::get('/administrador/regimenes/delete/{id}', 'RegimenesController@delete');
Route::get('/administrador/regimenes/update/{id}', 'RegimenesController@showupdate');
Route::post('/administrador/regimenes/create', 'RegimenesController@create');
Route::post('/administrador/regimenes/update', 'RegimenesController@update');

//chats

//directorio_tipo_terceros
Route::get('/administrador/directorio_tipo_terceros', 'Directorio_tipo_tercerosController@index');
Route::get('/administrador/directorio_tipo_terceros/all', 'Directorio_tipo_tercerosController@all');
Route::get('/administrador/directorio_tipo_terceros/{id}', 'Directorio_tipo_tercerosController@departamento');
Route::get('/administrador/directorio_tipo_terceros/delete/{id}', 'Directorio_tipo_tercerosController@delete');
Route::get('/administrador/directorio_tipo_terceros/update/{id}', 'Directorio_tipo_tercerosController@showupdate');
Route::post('/administrador/directorio_tipo_terceros/create', 'Directorio_tipo_tercerosController@create');
Route::post('/administrador/directorio_tipo_terceros/update', 'Directorio_tipo_tercerosController@update');

//directorio_clases
Route::get('/administrador/directorio_clases', 'Directorio_clasesController@index');
Route::get('/administrador/directorio_clases/all', 'Directorio_clasesController@all');
Route::get('/administrador/directorio_clases/{id}', 'Directorio_clasesController@departamento');
Route::get('/administrador/directorio_clases/delete/{id}', 'Directorio_clasesController@delete');
Route::get('/administrador/directorio_clases/update/{id}', 'Directorio_clasesController@showupdate');
Route::post('/administrador/directorio_clases/create', 'Directorio_clasesController@create');
Route::post('/administrador/directorio_clases/update', 'Directorio_clasesController@update');

//directorio_tipos
Route::get('/administrador/directorio_tipos', 'Directorio_tiposController@index');
Route::get('/administrador/directorio_tipos/all', 'Directorio_tiposController@all');
Route::get('/administrador/directorio_tipos/{id}', 'Directorio_tiposController@departamento');
Route::get('/administrador/directorio_tipos/delete/{id}', 'Directorio_tiposController@delete');
Route::get('/administrador/directorio_tipos/update/{id}', 'Directorio_tiposController@showupdate');
Route::post('/administrador/directorio_tipos/create', 'Directorio_tiposController@create');
Route::post('/administrador/directorio_tipos/update', 'Directorio_tiposController@update');

//directorios
Route::get('/administrador/directorios', 'DirectoriosController@index');
Route::get('/administrador/directorios/all', 'DirectoriosController@all');
Route::get('/administrador/directorios/{id}', 'DirectoriosController@departamento');
Route::get('/administrador/directorios/delete/{id}', 'DirectoriosController@delete');
Route::get('/administrador/directorios/update/{id}', 'DirectoriosController@showupdate');
Route::post('/administrador/directorios/create', 'DirectoriosController@create');
Route::post('/administrador/directorios/update', 'DirectoriosController@update');

//calendarios
Route::get('/calendario', 'CalendariosController@index');
Route::get('/calendario/all', 'CalendariosController@all');
Route::get('/calendario/{id}', 'CalendariosController@departamento');
Route::get('/calendario/delete/{id}', 'CalendariosController@delete');
Route::get('/calendario/update/{id}', 'CalendariosController@showupdate');
Route::post('/calendario/create', 'CalendariosController@create');
Route::post('/calendario/update', 'CalendariosController@update');

//invitados
Route::get('/invitados', 'InvitadosController@index');
Route::get('/invitados/all', 'InvitadosController@all');
Route::get('/invitados/{id}', 'InvitadosController@formcreate');
Route::get('/invitados/delete/{id}', 'InvitadosController@delete');
Route::get('/invitados/update/{id}', 'InvitadosController@showupdate');
Route::post('/invitados/create', 'InvitadosController@create');
Route::post('/invitados/update', 'InvitadosController@update');


//DESCARGAR EN EXCEL
Route::get('/download/excel/sucursales', 'SucursalesController@excel_all');

//DESCARGAR EN PDF
Route::get('/download/pdf/sucursales', 'SucursalesController@pdf_all');
Route::post('/send', 'EmailController@send');