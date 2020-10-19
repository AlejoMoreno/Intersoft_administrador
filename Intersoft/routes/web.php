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
//registro
Route::get('/registro', function(){
    return view('registro');
});
//olvido
Route::get('/olvido', function(){
    return view('olvido');
});
Route::post('/login', 'UsuariosController@login');
Route::post('/loguin', 'UsuariosController@addlogin');
Route::get('/layout', function(){
    return view('layout');
});
Route::get('/index', function(){
    $day = date("l");
    $dia = 1;
    switch ($day) {
        case "Sunday":
            $dia = 7;
        break;
        case "Monday":
            $dia = 1;
        break;
        case "Tuesday":
            $dia = 2;
        break;
        case "Wednesday":
            $dia = 3;
        break;
        case "Thursday":
            $dia = 4;
        break;
        case "Friday":
            $dia = 5;
        break;
        case "Saturday":
            $dia = 6;
        break;
    }
    $zonas = App\Zonasusuarios::select('ncedula','nombre','zona','nit','razon_social','direccion','directorios.telefono')
            ->where('zonasusuarios.id_empresa','=',Session::get('id_empresa'))
            ->join('usuarios','zonasusuarios.id_usuario','=','usuarios.id')
            ->join('directorios','zonasusuarios.zona','=','directorios.zona_venta')
            ->where('zonasusuarios.id_usuario','=',Session::get('user_id'))
            ->where('zonasusuarios.estado','=',$dia)
            ->get();
    
    $facturas = App\Facturas::where('facturas.id_empresa','=',Session::get('id_empresa'))
            ->where('id_vendedor','=',Session::get('user_id'))
            ->where('fecha','=',date("Y-m-d"))
            ->join('directorios','id_cliente','=','directorios.id')
            ->join('documentos','id_documento','=','documentos.id')
            ->get();
    $referencias = App\Referencias::where('id_empresa','=',Session::get('id_empresa'))
            ->get();
    
    $to = date("Y-m-d");
    $from = date("Y-m-d",strtotime($to."- 2 month"));
    $lotes = App\Lotes::select('codigo_linea','codigo_letras','codigo_consecutivo','descripcion','fecha_vence_lote','numero_lote','nombre')
            ->join('referencias','referencias.id','=','lotes.id_referencia')
            ->join('sucursales','sucursales.id','=','lotes.id_sucursal')
            ->where('fecha_vence_lote','<=',$from)
            ->where('lotes.id_empresa','=',Session::get('id_empresa'))
            ->get();

    return view('index', array(
        "zona"=>$zonas,
        "facturas"=>$facturas,
        "referencias"=>$referencias,
        "lotes"=>$lotes,
        "day"=>$day
    ));
});

//ruta para cerrar sesion
Route::get('/cerrar', 'UsuariosController@cerrar');

//menucontrolador
Route::get('/administrador/index', function(){
    return view('administrador.index');
});
Route::get('/inventario/index', function(){
    return view('inventario.index');
});
Route::get('/salida/index', function(){
    return view('salida.index');
});
Route::get('/documentos/documentos', function(){
    return view('documentos.documentos');
});
Route::get('/cartera/index', function(){
    return view('cartera.index');
});
Route::get('/contrasena', function(){
    return view('contrasena');
});
Route::post('/contrasena', 'UsuariosController@contrasenanueva');

//install
Route::get('/install', function(){
    return view('install');
});
Route::post('/install', 'EmpresasController@create');

//ciudades
Route::get('/ciudades/all', 'CiudadesController@all');
Route::get('/ciudades', function(){
    $departamentos = App\Departamentos::all();
    return view('ciudades',[
        "departamentos"=>$departamentos
    ]);
});

/**
 * -------------------------------------------------------------------------
 * web Routes Submenus
 * -------------------------------------------------------------------------
 * 
 * Menus y submenus
 * 
 */

Route::get('/submenu/directorio', function(){ return view('submenu.directorio'); });
Route::get('/submenu/contabilidad', function(){ return view('submenu.contabilidad'); });
Route::get('/submenu/facturacion', function(){ return view('submenu.facturacion'); });
Route::get('/submenu/inventario', function(){ return view('submenu.inventario'); });
Route::get('/submenu/produccion', function(){ return view('submenu.produccion'); });
Route::get('/submenu/tesoreria', function(){ return view('submenu.tesoreria'); });


/*
|--------------------------------------------------------------------------
| Web Routes FACTURACION
|--------------------------------------------------------------------------
|
| Registros y servicios del modulo de facturacion
|
*/
Route::get('/facturacion/zona', 'UsuariosController@listaZonas');
Route::get('/facturacion/zona/{id}', 'UsuariosController@listaZonas1');
Route::post('/facturacion/zonacreate', 'UsuariosController@createZonas');
Route::get('/facturacion/zonadelete/{id}', 'UsuariosController@deleteZonas');
Route::get('/facturacion/liquidacionventas', 'UsuariosController@liquidacionVentas');
Route::get('/facturacion/liquidacionventas/{id}/{valor}', 'UsuariosController@liquidacionVentas1');
Route::get('/facturacion/estadisticaventas', 'UsuariosController@estadisticaVentas');
Route::get('/facturacion/pedidos/{id_factura}', 'FacturasController@pedidos');
Route::get('/facturacion/pedidos', 'FacturasController@pedidosIndex');
Route::get('/facturacion/venta/{id_documento}', 'FacturasController@venta');
Route::get('/facturacion/compra/{id_documento}', 'FacturasController@compra');
Route::get('/facturacion/facturatech', 'FacturasController@facturatech');
Route::get('/facturacion/facturatech/{id_documento}/xml', 'FacturasController@facturatechxml');
Route::post('/facturacion/pedidosUpdate', 'FacturasController@updateEstado');
Route::get('/facturacion/devoluciones/{id_factura}', 'FacturasController@devoluciones');
Route::get('/facturacion/devoluciones', 'FacturasController@devolucionesIndex');
Route::get('/facturacion/alistamiento', 'FacturasController@alistamiento');


/*
|--------------------------------------------------------------------------
| Web Routes ADMINISTRADOR
|--------------------------------------------------------------------------
|
| Registros y servicios del modulo de administrador
|
*/

//Empresas
Route::get('/empresas/search', 'EmpresasController@search');
Route::post('/empresas/register', 'EmpresasController@register');


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

//tipoPagos
Route::get('/administrador/tipopagos', 'TipopagosController@index');
Route::get('/administrador/tipopagos/all', 'TipopagosController@all');
Route::get('/administrador/tipopagos/{id}', 'TipopagosController@formcreate');
Route::get('/administrador/tipopagos/delete/{id}', 'TipopagosController@delete');
Route::get('/administrador/tipopagos/update/{id}', 'TipopagosController@showupdate');
Route::post('/administrador/tipopagos/create', 'TipopagosController@create');
Route::post('/administrador/tipopagos/update', 'TipopagosController@update');

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
Route::post('/registrarse', 'UsuariosController@registrar');

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
Route::get('/administrador/directorios/{id}', 'DirectoriosController@showone');
Route::get('/administrador/directorios/delete/{id}', 'DirectoriosController@delete');
Route::get('/administrador/directorios/update/{id}', 'DirectoriosController@showupdate');
Route::post('/administrador/directorios/create', 'DirectoriosController@create');
Route::post('/administrador/directorios/update', 'DirectoriosController@update');
Route::post('/administrador/diretorios/search/search', 'DirectoriosController@search');
Route::get('/administrador/diretorios/search/searchText', 'DirectoriosController@searchText');
Route::post('/administrador/diretorios/addtercero', 'DirectoriosController@addTercero');

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

//bancos
Route::get('/administrador/bancos', 'BancosController@index');
Route::get('/administrador/bancos/all', 'BancosController@all');
Route::get('/administrador/bancos/{id}', 'BancosController@departamento');
Route::get('/administrador/bancos/delete/{id}', 'BancosController@delete');
Route::get('/administrador/bancos/update/{id}', 'BancosController@showupdate');
Route::post('/administrador/bancos/create', 'BancosController@create');
Route::post('/administrador/bancos/update', 'BancosController@update');

//consignacion
Route::get('/administrador/consignacion', 'ConsignacionesController@index');
Route::get('/administrador/consignacion/all', 'ConsignacionesController@all');
Route::get('/administrador/consignacion/{id}', 'ConsignacionesController@departamento');
Route::get('/administrador/consignacion/delete/{id}', 'ConsignacionesController@delete');
Route::get('/administrador/consignacion/update/{id}', 'ConsignacionesController@showupdate');
Route::post('/administrador/consignacion/create', 'ConsignacionesController@create');
Route::post('/administrador/consignacion/update', 'ConsignacionesController@update');


//integracion INTERCON
Route::get('/administrador/integracion','FacturasController@indexIntegracion');
Route::post('/administrador/integracion/facturacion','FacturasController@subirFacturas');
Route::post('/administrador/saveFactura','FacturasController@saveFactura');
Route::post('/administrador/integracion/vendedor','UsuariosController@subirVendedor');
Route::post('/administrador/saveVendedor','UsuariosController@saveVendedor');
Route::post('/administrador/integracion/terceros','DirectoriosController@subirTercero');
Route::post('/administrador/saveTercero','DirectoriosController@saveTercero');
Route::post('/administrador/integracion/kardex','KardexController@subirKardex');
Route::post('/administrador/saveKardex','KardexController@saveKardex');
Route::post('/administrador/integracion/carteras','CarterasController@subirCarteras');
Route::post('/administrador/saveCarteras','CarterasController@saveCarteras');
Route::post('/administrador/integracion/kardexcarteras','KardexCarterasController@subirKardexcarteras');
Route::post('/administrador/saveKardexcarteras','KardexCarterasController@saveKardexcarteras');
Route::post('/administrador/integracion/saldos','ReferenciasController@subirSaldos');
Route::post('/administrador/saveSaldos','ReferenciasController@saveSaldos');

/*
|--------------------------------------------------------------------------
| Web Routes ENTRADAS
|--------------------------------------------------------------------------
|
| Registros y servicios del modulo de entradas
|
*/

//marcas
Route::get('/inventario/marcas', 'MarcasController@index');
Route::get('/inventario/marcas/all', 'MarcasController@all');
Route::get('/inventario/marcas/{id}', 'MarcasController@formcreate');
Route::get('/inventario/marcas/delete/{id}', 'MarcasController@delete');
Route::get('/inventario/marcas/update/{id}', 'MarcasController@showupdate');
Route::post('/inventario/marcas/create', 'MarcasController@create');
Route::post('/inventario/marcas/update', 'MarcasController@update');

//lineas
Route::get('/inventario/lineas', 'LineasController@index');
Route::get('/inventario/lineas/all', 'LineasController@all');
Route::get('/inventario/lineas/{id}', 'LineasController@formcreate');
Route::get('/inventario/lineas/delete/{id}', 'LineasController@delete');
Route::get('/inventario/lineas/update/{id}', 'LineasController@showupdate');
Route::post('/inventario/lineas/create', 'LineasController@create');
Route::post('/inventario/lineas/update', 'LineasController@update');

//tipo_presentaciones
Route::get('/inventario/tipo_presentaciones', 'Tipo_presentacionesController@index');
Route::get('/inventario/tipo_presentaciones/all', 'Tipo_presentacionesController@all');
Route::get('/inventario/tipo_presentaciones/{id}', 'Tipo_presentacionesController@formcreate');
Route::get('/inventario/tipo_presentaciones/delete/{id}', 'Tipo_presentacionesController@delete');
Route::get('/inventario/tipo_presentaciones/update/{id}', 'Tipo_presentacionesController@showupdate');
Route::post('/inventario/tipo_presentaciones/create', 'Tipo_presentacionesController@create');
Route::post('/inventario/tipo_presentaciones/update', 'Tipo_presentacionesController@update');

//clasificaciones
Route::get('/inventario/clasificaciones', 'ClasificacionesController@index');
Route::get('/inventario/clasificaciones/all', 'ClasificacionesController@all');
Route::get('/inventario/clasificaciones/{id}', 'ClasificacionesController@formcreate');
Route::get('/inventario/clasificaciones/delete/{id}', 'ClasificacionesController@delete');
Route::get('/inventario/clasificaciones/update/{id}', 'ClasificacionesController@showupdate');
Route::post('/inventario/clasificaciones/create', 'ClasificacionesController@create');
Route::post('/inventario/clasificaciones/update', 'ClasificacionesController@update');

//referencias
Route::get('/inventario/referencias', 'ReferenciasController@index');
Route::get('/inventario/referencias/all', 'ReferenciasController@all');
Route::get('/inventario/referencias/{id}', 'ReferenciasController@showone');
Route::get('/inventario/referencias/delete/{id}', 'ReferenciasController@delete');
Route::get('/inventario/referencias/update/{id}', 'ReferenciasController@showupdate');
Route::post('/inventario/referencias/create', 'ReferenciasController@create');
Route::post('/inventario/referencias/update', 'ReferenciasController@update');
Route::post('/inventario/referencias/search', 'ReferenciasController@search' );

//lotes
Route::get('/inventario/lotes', 'LotesController@index');
Route::get('/inventario/lotes/all', 'LotesController@all');
Route::get('/inventario/lotes/{id}', 'LotesController@formcreate');
Route::get('/inventario/lotes/delete/{id}', 'LotesController@delete');
Route::get('/inventario/lotes/update/{id}', 'LotesController@showupdate');
Route::post('/inventario/lotes/create', 'LotesController@create');
Route::post('/inventario/lotes/update', 'LotesController@update');

//Documentos
Route::get('/inventario/documentos', 'DocumentosController@index');
Route::get('/inventario/documentos/all', 'DocumentosController@all');
Route::get('/inventario/documentos/{id}', 'DocumentosController@formcreate');
Route::get('/inventario/documentos/delete/{id}', 'DocumentosController@delete');
Route::get('/inventario/documentos/update/{id}', 'DocumentosController@showupdate');
Route::post('/inventario/documentos/create', 'DocumentosController@create');
Route::post('/inventario/documentos/update', 'DocumentosController@update');

//Catalogo
Route::get('/inventario/catalogo', 'ReferenciasController@catalogo');
Route::get('/inventario/catalogo/precio/{numero}', 'ReferenciasController@catalogoPrecio');
//ordenes de produccion (ficha "receta")
Route::get('/inventario/fichatecnica', 'FichatecnicasController@index');
Route::post('/inventario/fichatecnica', 'FichatecnicasController@index');
Route::get('/inventario/ordenesdeproduccion', 'ProduccioningresosController@index');
Route::post('/inventario/ordenesdeproduccion', 'ProduccioningresosController@createOrden');
Route::get('/inventario/materiaprima', 'ReferenciasController@materiaprima');

Route::get('/inventario/ingresoporproduccion', 'ProduccioningresosController@ingresoporproduccion');
Route::post('/inventario/ingresoporproduccion/update', 'ProduccioningresosController@update');
Route::post('/inventario/ingresoporproduccion/convertir', 'ProduccioningresosController@convertir');

Route::get('/inventario/actualizacionPrecios', 'ReferenciasController@actualizacionPrecios');
Route::post('/inventario/actualizacionPrecios', 'ReferenciasController@actualizarPrecios');
Route::get('/inventario/actualizacionPrecios/{id}/{precio1}/{precio2}/{precio3}', 'ReferenciasController@updatePrecios');

/*
|--------------------------------------------------------------------------
| Web Routes SALIDAS
|--------------------------------------------------------------------------
|
| Registros y servicios del modulo de entradas
|
*/



/*
|--------------------------------------------------------------------------
| Web Routes CARTERAS
|--------------------------------------------------------------------------
|
| Carteras
|
*/
Route::get('/cartera/egresos', 'CarterasController@egresos');

Route::get('/cartera/egresos/submenu', 'CarterasController@menuegresos');
Route::get('/cartera/ingresos/submenu', 'CarterasController@menuingresos');
Route::get('/cartera/ingresos', 'CarterasController@ingresos');
Route::get('/cartera/allDocumentos/{id}', 'CarterasController@allDocumentos');
Route::post('/cartera/egresos/guardar', 'CarterasController@save');
Route::post('/cartera/kardex/guardar', 'KardexCarterasController@save');
Route::get('/cartera/imprimir/{id}', 'CarterasController@imprimir');
Route::get('/cartera/consultar_documentos', 'CarterasController@consultar_documentos');

Route::get('/cartera/anular/{id}', 'CarterasController@anular');
Route::get('/cartera/eliminar/{id}', 'CarterasController@eliminar');

Route::get('/cartera/causar', 'CarterasController@causar'); //pendiente 
Route::post('/cartera/causar/guardar', 'CarterasController@saveCausar'); //pendiente

Route::get('/cartera/gastos', 'CarterasController@gastosindex');
Route::get('/cartera/otrosingresos', 'CarterasController@otrosingresosindex');
Route::get('/cartera/extracto', 'CarterasController@extracto');
Route::get('/cartera/historial/{idtercero}', 'CarterasController@historial');

Route::post('/cartera/FormaPagos','CarterasController@saveFormaPagos');


/*
|--------------------------------------------------------------------------
| Web Routes CONTABILIDAD
|--------------------------------------------------------------------------
|
| Registros y servicios del modulo de contabilidad
|
*/
Route::get('/contabilidad/index', function(){
    return view('contabilidad.index');
});
Route::post('/contabilidad/register', 'ContabilidadesController@register');

//cuentas
Route::get('/contabilidad/cuentas', 'CuentasController@index');
Route::get('/contabilidad/cuentas/all', 'CuentasController@all');
Route::get('/contabilidad/cuentas/{id}', 'CuentasController@formcreate');
Route::get('/contabilidad/cuentas/delete/{id}', 'CuentasController@delete');
Route::get('/contabilidad/cuentas/update/{id}', 'CuentasController@showupdate');
Route::post('/contabilidad/cuentas', 'CuentasController@create');
Route::post('/contabilidad/cuentas/update', 'CuentasController@update');

Route::post('/contabilidad/buscarCuentas' , 'CuentasController@buscarCuentas');

Route::get('/contabilidad/librosauxiliares', 'ContabilidadesController@librosauxiliaresIndex');
Route::get('/contabilidad/comprobantesdiario', function(){ 
    $documentos = App\Documentos::select(['id','nombre'])
                ->where('id_empresa','=',Session::get('id_empresa'))
                ->get();

    $auxiliars = App\Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->orderBy('codigo','asc')->get();
    return view('contabilidad.comprobantesdiario',[
        "documentos"=>$documentos,
        "auxiliars"=>$auxiliars
    ]); 
});
Route::get('/contabilidad/doc/{id}', 'ContabilidadesController@getDocumentos');

Route::post('/contabilidad/comprobantes/viewComprobantes', 'ContabilidadesController@viewComprobantes');
Route::post('/contabilidad/comprobantes/deleteComprobantes', 'ContabilidadesController@deleteComprobantes');
Route::post('/contabilidad/comprobantes/updateComprobantes', 'ContabilidadesController@updateComprobantes');
Route::post('/contabilidad/comprobantes/createComprobantes', 'ContabilidadesController@createComprobantes');

Route::get('/contabilidad/generarfactura/{doc}','ContabilidadesController@generarfactura');
Route::get('/contabilidad/generaregreso/{doc}','ContabilidadesController@generaregreso');
Route::get('/contabilidad/generarrecibos/{doc}','ContabilidadesController@generarrecibos');
Route::get('/contabilidad/generarcompra/{doc}','ContabilidadesController@generarcompra');
Route::get('/contabilidad/generarnotadb/{doc}','ContabilidadesController@generarnotadb');
Route::get('/contabilidad/generarnotacr/{doc}','ContabilidadesController@generarnotacr');
Route::get('/contabilidad/generarnotacontable/{doc}','ContabilidadesController@generarnotacontable');


/*
|--------------------------------------------------------------------------
| Web Routes GPS
|--------------------------------------------------------------------------
|
| Get de datos para graficos
|
*/
Route::get('/gps/directoriomaps', 'DirectoriomapsController@index');
Route::post('/gps/directoriomaps', 'DirectoriomapsController@save');
Route::post('/gps/trakingmaps', 'TrakingmapsController@save');




/*
|--------------------------------------------------------------------------
| Web Routes GRAFICAS
|--------------------------------------------------------------------------
|
| Get de datos para graficos
|
*/
Route::get('/administrador/sucursales/chart/pie', 'SucursalesController@chartPie');



/*
|--------------------------------------------------------------------------
| Web Routes GESTION DOCUMENTAL
|--------------------------------------------------------------------------
|
| Registros y servicios del modulo de entradas
|
*/
Route::get('/documentos/documento', function(){
    return view('documentos.documentos');
});
Route::get('/documentos/imprimir/{id}', 'FacturasController@imprimir');
Route::get('/documentos/imprimirpost/{id}', 'FacturasController@imprimirpost');

//procesos con documentos 
Route::get('/documentos/anular/{id}', 'FacturasController@anular');
Route::get('/documentos/eliminar/{id}', 'FacturasController@eliminar');

Route::get('/kardex/pedidos/{id_documento}', 'KardexController@pedidos');
Route::post('/kardex/saveDocument', 'KardexController@saveDocument');
Route::post('/factura/saveDocument', 'FacturasController@saveDocument');
Route::get('/kardex/show/{id}', 'KardexController@showid');
Route::get('/inventario/kardex', 'KardexController@kardexShow');

//Factura post
Route::get('/documentos/facturaPost', 'FacturasController@facturaPost');

//consultar documentos
Route::get('/documentos/consultar/{documento}', 'FacturasController@consultar_documento');

//DESCARGAR EN EXCEL
Route::get('/download/excel/sucursales', 'SucursalesController@excel_all');
Route::get('/excel/excelComprobantesDiario', 'ContabilidadesController@exelComprobantesDiario');
Route::get('/excel/excelreferencias1', 'ReferenciasController@excelreferencias1');
Route::get('/excel/excelDirectorio', 'DirectoriosController@excel');

//DESCARGAR EN PDF
Route::get('/download/pdf/sucursales', 'SucursalesController@pdf_all');
Route::post('/send', 'EmailController@send');
Route::get('/pdf/pdf_comprobanteDiario', 'ContabilidadesController@pdf_comprobanteDiario');
Route::get('/pdf/pdfreferencias1', 'ReferenciasController@pdfreferencias1');
Route::get('/pdf/pdfDirectorio', 'DirectoriosController@pdf');
Route::get('/pdf/fichatecnica', 'FichatecnicasController@pdf');


//REPORTES CHARTS JS
Route::get('/reporte', 'Reportes\usuarios@index');

