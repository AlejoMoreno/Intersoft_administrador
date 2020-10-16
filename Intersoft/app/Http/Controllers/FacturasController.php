<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Facturas;
use App\Kardex;
use App\Sucursales;
use App\Empresas;
use App\Documentos;
use App\Directorios;
use App\Ciudades;
use App\Usuarios;
use App\Referencias;

use App\Carteras;
use App\KardexCarteras;
use App\Contabilidades;
use App\Http\Controllers\ContabilidadesController;
use App\Http\Controllers\KardexController;
use App\Pucauxiliar;
use App\Tipopagos;
use App\Directorio_tipo_terceros;

use App\Insumo_x_m_ls;

use PDF;
use DB;
use Session;
use Mail;

class FacturasController extends Controller
{
    public function saveDocument(Request $request){
        $documento = Documentos::where('id','=',$request->id_documento)
                               ->where('id_empresa','=',Session::get('id_empresa'))->first();
        //aumentar el numero de documento
        $documento->num_presente = intval($documento->num_presente) + 1;
        $documento->save();
        //verificar el clinete/proveedor/tercero
        $tercero = FacturasController::Tercero($documento->signo,$request);

        $facturas = Facturas::where('id_tercero','=',$request->id_tercero)
                ->where('subtotal','=',$request->subtotal)
                ->where('signo','=',$request->signo)
                ->where('fecha','=',$request->fecha)
                ->get();
        if(sizeof($facturas)>0){
            return array(
                "result" => "false",
                "body" => "Cedula ya esta facturada con el mismo valor en el dia de hoy" 
            );
        }
        //creacion de factura 
        $obj = new Facturas();
    	$obj->id_sucursal		= Session::get('sucursal');
    	$obj->numero 			= $documento->num_presente;
		$obj->prefijo 			= $documento->prefijo;
		$obj->id_cliente 		= $tercero->id;
		$obj->id_tercero 		= $request->id_tercero;
		$obj->id_vendedor 		= $request->id_vendedor;
		$obj->fecha 			= $request->fecha;
		$obj->fecha_vencimiento = $request->fecha_vencimiento;
		$obj->id_documento 		= $documento->id;
		$obj->signo 			= (string)$request->signo;
		$obj->subtotal 			= $request->subtotal;
		$obj->iva 				= $request->iva;
		$obj->impoconsumo 		= $request->impoconsumo;
		$obj->otro_impuesto 	= $request->otro_impuesto;
		$obj->otro_impuesto1 	= $request->otro_impuesto1;
		$obj->descuento 		= $request->descuento;
		$obj->fletes 			= $request->fletes;
		$obj->retefuente 		= $request->retefuente;
		$obj->total 			= $request->total;
		$obj->id_modificado 	= $request->id_modificado;
		$obj->observaciones 	= (string)$request->observaciones;
		$obj->estado 			= $request->estado;
		$obj->saldo             = $request->saldo;
		$obj->id_empresa	 	= Session::get('id_empresa');
        if($obj->save()){ //si guarda correctamente la factura
            $obj->kardex = KardexController::saveDocumentSinContabilidad($request->productosArr,$obj,$obj->asiento_contable);
        }
        //entradas de inventarios
        
        //envio mail
        $obj->id_documento = Documentos::where('id',$obj->id_documento)->first();
        $obj->id_vendedor = Usuarios::where('id',$obj->id_vendedor)->first();
        $obj->id_cliente = Directorios::where('id',$obj->id_cliente)->first();

        $obj->id_empresa = Empresas::where('id','=',Session::get('id_empresa'))->first();
        
        Mail::send('mail.venta', ['facturas' => $obj], function ($m) use ($obj) {
            $m->from('intersoft@wakusoft.com', 'Intersoft');
            $m->to(["wakusoft@gmail.com",$obj->id_empresa->correo])->subject('Documento generado '.$obj->id_documento->nombre.' #'.$obj->numero  );
        });


        return array(
            "result" => "success",
            "body" => $obj 
        );
    }
    

    static function Tercero($signo,$request){
        $tercero = null;
        if($signo == '+'){
            $tercero = Directorios::where('nit',$request->id_cliente)->
                                    where('id_directorio_tipo_tercero','=','1')->
                                    where('id_empresa','=',Session::get('id_empresa'))->first();
        }
        //nada con el inventario o Salida de inventario
        else{
            $tercero = Directorios::where('nit',$request->id_cliente)->
                                    where('id_directorio_tipo_tercero','=','2')->
                                    where('id_empresa','=',Session::get('id_empresa'))->first();
        }
        return $tercero;
    }

    public function imprimir($id){

        $factura = Facturas::where('id',$id)->
                            where('id_empresa','=',Session::get('id_empresa'))->first();
        $kardex = Kardex::where('id_factura',$id)->
                          where('id_empresa','=',Session::get('id_empresa'))->get();
    	$factura->id_sucursal = Sucursales::where('id',$factura->id_sucursal)->first();
    	$factura->id_sucursal->id_empresa = Empresas::where('id',$factura->id_sucursal->id_empresa)->first();
    	$factura->id_documento = Documentos::where('id',$factura->id_documento)->first();
        $factura->id_vendedor = Usuarios::where('id',$factura->id_vendedor)->first();
    	$factura->id_cliente = Directorios::where('id',$factura->id_cliente)->first();
    	$factura->id_cliente->id_ciudad = Ciudades::where('id',$factura->id_cliente->id_ciudad)->first();
        foreach ($kardex as $obj) {
            $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->
                                               where('id_empresa','=',Session::get('id_empresa'))->
                                            first();
        }


        //$customPaper = array(0,0,595.28,420.94); //Carta
        //$customPaper = array(0,0,830/2,620); //media Carta
        $pdf = PDF::loadView('documentos.impresionFactura', [
            'factura' => $factura,
            'kardex' => $kardex
        ]);//->setPaper($customPaper, 'landscape');
        return $pdf->download($factura->id_documento->nombre.'-'.$factura->prefijo.'-'.$factura->numero.'.pdf');

    	/*return view('documentos.impresionFactura', [
            'factura' => $factura,
            'kardex' => $kardex
        ]);*/
    }

    public function imprimirpost($id){

        $factura = Facturas::where('id',$id)->
                            where('id_empresa','=',Session::get('id_empresa'))->first();
        $kardex = Kardex::where('id_factura',$id)->
                          where('id_empresa','=',Session::get('id_empresa'))->get();
    	$factura->id_sucursal = Sucursales::where('id',$factura->id_sucursal)->first();
    	$factura->id_sucursal->id_empresa = Empresas::where('id',$factura->id_sucursal->id_empresa)->first();
    	$factura->id_documento = Documentos::where('id',$factura->id_documento)->first();
        $factura->id_vendedor = Usuarios::where('id',$factura->id_vendedor)->first();
    	$factura->id_cliente = Directorios::where('id',$factura->id_cliente)->first();
    	$factura->id_cliente->id_ciudad = Ciudades::where('id',$factura->id_cliente->id_ciudad)->first();
        foreach ($kardex as $obj) {
            $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->
                                               where('id_empresa','=',Session::get('id_empresa'))->
                                               get()[0];
        }
        return view('documentos.impresionFacturaPos', [
            'factura' => $factura,
            'kardex' => $kardex]);
    }

    public function getUpdate($id){
        $factura = Facturas::where('id',$id)->
                             where('id_empresa','=',Session::get('id_empresa'))->get()[0];
        $kardex = Kardex::where('id_factura',$id)->
                          where('id_empresa','=',Session::get('id_empresa'))->get();
        $factura->id_sucursal = Sucursales::where('id',$factura->id_sucursal)->get();
        foreach ($factura->id_sucursal as $sucursal) {
            $sucursal->id_empresa = Empresas::where('id',$sucursal->id_empresa)->get()[0];
        }
        $factura->id_documento = Documentos::where('id',$factura->id_documento)->get()[0];
        $factura->id_vendedor = Usuarios::where('id',$factura->id_vendedor)->get()[0];
        $factura->id_cliente = Directorios::where('id',$factura->id_cliente)->get();
        foreach($factura->id_cliente as $cliente){
            $cliente->id_ciudad = Ciudades::where('id',$cliente->id_ciudad)->get()[0];
        }
        foreach ($kardex as $obj) {
            $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->
                                               where('id_empresa','=',Session::get('id_empresa'))->
                                               get()[0];
        }
        return view('documentos.update', [
            'factura' => $factura,
            'kardex' => $kardex]);   
    }

    public function consultar_documento($documento, Request $request){
        $factura = Facturas::select(
            ['documentos.*','facturas.*','sucursales.nombre as sucunombre',
            'directorios.*','ciudades.nombre as ciudadnombre','empresas.*',
            'facturas.created_at as creado','facturas.id as idfactura',
            'directorios.razon_social as nombrecliente','usuarios.nombre as nombrevendedor',
            'facturas.estado as estadofactura'])
                    ->where('facturas.id_documento','=',$documento)
                    ->join('documentos','documentos.id','=','facturas.id_documento')            
                    ->join('sucursales','sucursales.id','=','facturas.id_sucursal')                    
                    ->join('directorios','directorios.id','=','facturas.id_cliente')
                    ->join('ciudades','ciudades.id','=','directorios.id_ciudad')
                    ->join('empresas','empresas.id','=','facturas.id_empresa')
                    ->join('usuarios','usuarios.id','=','facturas.id_vendedor')
                    ->where('facturas.id_empresa','=',Session::get('id_empresa'))
                    ->where(function ($q) use ($request) {
                        if(isset($request->nit)){
                            $q->where('id_tercero','=',$request->nit);
                        }
                        if(isset($request->razonsocial)){
                            $q->where('directorios.razon_social','like','%'.$request->razonsocial.'%');                  
                        }
                        if(isset($request->fechainicio)){
                            $q->whereBetween('fecha', [$request->fechainicio, $request->fechafinal]);
                        }
                        if(isset($request->vendedor)){
                            $q->where('id_vendedor','=',$request->vendedor);
                        }
                    })
                    ->orderBy('id_documento','desc')
                    ->take(100)
                    ->get();
        
        
        
        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->orderBy('nombre','desc')->get();

        return view('documentos.consultar', [
            'factura' => $factura,
            'usuarios'=> $usuarios
        ]);
    }

    public function anular($id){ 
        $factura = Facturas::where('id', '=', $id)->
                             where('id_empresa','=',Session::get('id_empresa'))->first();
        
        if($factura->signo != "="){
            if($factura->saldo != $factura->total){
                return array(
                    "result" => "Alerta",
                    "mensaje" => "No se puede realizar la anulación ya que tiene un abono, se debe anhular el abono para ejecutar la anulacion del documento"
                );
            }
        }  
        else{
            $factura->estado = "ANULADO";
            $factura->id_modificado = Session::get('user_id');
            $factura->save();
            return array(
                "result" => "Correcto",
                "mensaje" => "El documento = fue anulado en su totalidad"
            );
        }                   
        $factura->estado = "ANULADO";
        $factura->id_modificado = Session::get('user_id');
        $kardex = Kardex::where('id_factura',$factura->id)->
                            where('id_empresa','=',Session::get('id_empresa'))->get();
        foreach ($kardex as $obj) {
            $referencia = Referencias::where('id', '=', $obj->id_referencia)->
                                        where('id_empresa','=',Session::get('id_empresa'))->
                                        first();
            if($factura->signo == '-'){
                $referencia->saldo = $referencia->saldo + $obj->cantidad;
            }
            else if($factura->signo == '+'){
                $referencia->saldo = $referencia->saldo - $obj->cantidad;
            }
            $referencia->save();
            $obj->delete();           
        }
        $factura->save();

        return array(
            "result" => "Correcto",
            "mensaje" => "El documento + - fue anulado en su totalidad"
        );
    }

    public function eliminar($id){ 
        $factura = Facturas::where('id', '=', $id)->
                             where('id_empresa','=',Session::get('id_empresa'))->first();
        if($factura->signo != "="){
            if($factura->saldo != $factura->total || $factura->estado != "ANULADO"){
                return array(
                    "result" => "Alerta",
                    "mensaje" => "No se puede realizar la eliminación ya que tiene un abono, se debe anhular el abono para ejecutar la anulacion del documento, ó el documento no se encuentra anulado"
                );
            }                 
        }
        else{
            $factura->estado = "ELIMINADO";
            $factura->id_modificado = Session::get('user_id');
            $factura->save();

            $factura->delete();

            return array(
                "result" => "Correcto",
                "mensaje" => "El documento fue ELIMINADO en su totalidad"
            );
        }
    }

    public function facturaPost() {
        return view('documentos.facturaPost');
    }

    /**
     * PEDIDOS FACTURA
     */
    public function pedidos($id_factura){
        $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
        $ciudades = Ciudades::where('id','>',0)->orderBy('nombre','asc')->get();
        $facturas = Facturas::where('id_empresa','=',Session::get('id_empresa'))->where('id',$id_factura)->get(); //estado=FACTURADO
        foreach($facturas as $factura){
            $factura->id_documento = Documentos::where('id','=',$factura->id_documento)->first();
            $factura->id_cliente = Directorios::where('id','=',$factura->id_cliente)->first();
            $factura->id_vendedor = Usuarios::where('id','=',$factura->id_vendedor)->first();
        }
        $documento = Documentos::where('id','=',$facturas[0]->id_documento)->first();
        $documento_dev = Documentos::where('id_empresa','=',Session::get('id_empresa'))->where('signo','=','-')->first();
        $kardex = Kardex::where('id_factura','=',$facturas[0]->id)->get();
        return view('facturacion.pedidos',array(
            "referencias"=>$referencias,
            "documento"=>$documento,
            "ciudades"=>$ciudades,
            "facturas"=>$facturas,
            "kardex"=>$kardex,
            "documento_dev"=>$documento_dev
        ));
    }
    public function pedidosIndex(Request $request){
        $pedidos = Facturas::select(
            ['documentos.*','facturas.*','sucursales.nombre as sucunombre',
            'directorios.*','ciudades.nombre as ciudadnombre','empresas.*',
            'facturas.created_at as creado','facturas.id as idfactura','usuarios.*',
            'directorios.razon_social as nombrecliente','usuarios.nombre as nombrevendedor',
            'facturas.estado as estadofactura','facturas.id as id_factura'])
                    ->join('documentos','documentos.id','=','facturas.id_documento')            
                    ->join('sucursales','sucursales.id','=','facturas.id_sucursal')                    
                    ->join('directorios','directorios.id','=','facturas.id_cliente')
                    ->join('ciudades','ciudades.id','=','directorios.id_ciudad')
                    ->join('empresas','empresas.id','=','facturas.id_empresa')
                    ->join('usuarios','usuarios.id','=','facturas.id_vendedor')
                    ->where('facturas.id_empresa','=',Session::get('id_empresa'))
                    ->where('facturas.signo','=','=')
                    ->whereNotIn('facturas.estado',['FACTURADO','RECHAZADO','DEVUELTO'])
                    ->where(function ($q) use ($request) {
                        if(isset($request->nit)){
                            $q->where('id_tercero','=',$request->nit);
                        }
                        if(isset($request->razonsocial)){
                            $q->where('directorios.razon_social','like','%'.$request->razonsocial.'%');                  
                        }
                        if(isset($request->fechainicio)){
                            $q->whereBetween('fecha', [$request->fechainicio, $request->fechafinal]);
                        }
                        if(isset($request->vendedor)){
                            $q->where('id_vendedor','=',$request->vendedor);
                        }
                    })
                    ->orderBy('id_documento','desc')
                    ->take(100)
                    ->get();
        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
        
        return view('facturacion.pedidosIndex',array(
            "pedidos"=>$pedidos,
            "usuarios"=>$usuarios
        ));
    }

    public function updateEstado(Request $request){
        $pedido = Facturas::where('id','=',$request->id_documento)->first();
        $pedido->estado = $request->estado; //FACTURADO / RECHAZADO / DEVUELTO
        $pedido->save();
        return $pedido;
    }

    /**
     * DEVOLUCIONES FACTURA
     */
    public function devoluciones($id_factura){
        $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
        $ciudades = Ciudades::where('id','>',0)->orderBy('nombre','asc')->get();
        $facturas = Facturas::where('id_empresa','=',Session::get('id_empresa'))->where('id',$id_factura)->get(); //estado=FACTURADO
        foreach($facturas as $factura){
            $factura->id_documento = Documentos::where('id','=',$factura->id_documento)->first();
            $factura->id_cliente = Directorios::where('id','=',$factura->id_cliente)->first();
            $factura->id_vendedor = Usuarios::where('id','=',$factura->id_vendedor)->first();
        }
        $documento = Documentos::where('id','=',$facturas[0]->id_documento)->first();
        $documento_dev = Documentos::where('id_empresa','=',Session::get('id_empresa'))->where('nombre','=','DEVOLUCION VENTAS')->first();
        $kardex = Kardex::where('id_factura','=',$facturas[0]->id)->get();
        return view('facturacion.devoluciones',array(
            "referencias"=>$referencias,
            "documento"=>$documento,
            "ciudades"=>$ciudades,
            "facturas"=>$facturas,
            "kardex"=>$kardex,
            "documento_dev"=>$documento_dev
        ));
    }
    public function devolucionesIndex(){
        $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
        $facturas = Facturas::where('id_empresa','=',Session::get('id_empresa'))->where('signo','=','-')->whereNotIn('estado',['FACTURADO','RECHAZADO','DEVUELTO'])->get(); //estado=FACTURADO
        foreach($facturas as $factura){
            $factura->id_documento = Documentos::where('id','=',$factura->id_documento)->first();
            $factura->id_cliente = Directorios::where('id','=',$factura->id_cliente)->first();
            $factura->id_vendedor = Usuarios::where('id','=',$factura->id_vendedor)->first();
        }
        return view('facturacion.devolucionesIndex',array(
            "referencias"=>$referencias,
            "facturas"=>$facturas
        ));
    }

    public function updateDevoluciones(Request $request){
        $pedido = Facturas::where('id','=',$request->id_documento)->first();
        $pedido->estado = $request->estado; //FACTURADO / RECHAZADO
        $pedido->save();
    }

    /**
     * FACTURAS DE VENTA
     */
    public function venta($id_documento){
        $documento = Documentos::where('id','=',$id_documento)->first();
        $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))
                                ->where('estado','=','ACTIVO')->get();
        $ciudades = Ciudades::where('id','>',0)->orderBy('nombre','asc')->get();
        
        return view('facturacion.venta',array(
            "referencias"=>$referencias,
            "documento"=>$documento,
            "ciudades"=>$ciudades
        ));
    }
    /**
     * FACTURAS DE COMPRA
     */
    public function compra($id_documento){
        $documento = Documentos::where('id','=',$id_documento)->first();
        $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
        $ciudades = Ciudades::where('id','>',0)->orderBy('nombre','asc')->get();
        
        return view('facturacion.compras',array(
            "referencias"=>$referencias,
            "documento"=>$documento,
            "ciudades"=>$ciudades
        ));
    }
    /**
     * ALISTAMIENTO 
     */
    public function alistamiento(Request $request){
        if(isset($request->date)){
            $date = $request->date;
        }
        else{
            $date = date('Y-m-d');
        }
        $documentos = Documentos::where('id_empresa','=',Session::get('id_empresa'))->get();
        $kardex = Kardex::join('directorios','kardexes.id_cliente','directorios.id')
                        ->join('usuarios','kardexes.id_vendedor','usuarios.id')
                        ->where('kardexes.id_empresa','=',Session::get('id_empresa'))
                        ->where('kardexes.signo','=','=')
                        ->where('kardexes.fecha', '=',$date)
                        ->orderBy('kardexes.id_referencia')->get();

        $kardex1 = Kardex::select('id_referencia',DB::raw('SUM(kardexes.cantidad) as total'))
                        ->where('kardexes.id_empresa','=',Session::get('id_empresa'))
                        ->where('kardexes.signo','=','=')
                        ->where('kardexes.fecha', '=',$date)
                        ->groupBy('id_referencia')
                        ->orderBy('kardexes.id_referencia')
                        ->get();
        $total = 0;
        foreach($kardex as $obj){
            $obj->id_referencia = Referencias::where('id','=',$obj->id_referencia)->first();
            $obj->id_factura = Facturas::where('id','=',$obj->id_factura)->first();
            $total = $total + ($obj->cantidad * $obj->precio);
        }
        foreach($kardex1 as $obj){
            $obj->id_referencia = Referencias::where('id','=',$obj->id_referencia)->first();
            $obj->id_factura = Facturas::where('id','=',$obj->id_factura)->first();
        }
        
        return view('facturacion.alistamiento',array(
            "documento"=>$documentos,
            "kardex"=>$kardex,
            "kardex1"=>$kardex1,
            "total"=>$total
        ));
    }

    /**
     * FACTURATECH
     */
    public function facturatech(Request $request){
        $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','%MAYO%')
                            ->first();
        $factura = Facturas::select(
            ['documentos.*','facturas.*','sucursales.nombre as sucunombre',
            'directorios.*','ciudades.nombre as ciudadnombre','empresas.*',
            'facturas.created_at as creado','facturas.id as idfactura',
            'directorios.razon_social as nombrecliente','usuarios.nombre as nombrevendedor',
            'facturas.estado as estadofactura','facturas.id as idfactura'])
                    ->where('facturas.id_documento','=',$documento->id)
                    ->join('documentos','documentos.id','=','facturas.id_documento')            
                    ->join('sucursales','sucursales.id','=','facturas.id_sucursal')                    
                    ->join('directorios','directorios.id','=','facturas.id_cliente')
                    ->join('ciudades','ciudades.id','=','directorios.id_ciudad')
                    ->join('empresas','empresas.id','=','facturas.id_empresa')
                    ->join('usuarios','usuarios.id','=','facturas.id_vendedor')
                    ->where('facturas.id_empresa','=',Session::get('id_empresa'))
                    ->where(function ($q) use ($request) {
                        if(isset($request->nit)){
                            $q->where('id_tercero','=',$request->nit);
                        }
                        if(isset($request->razonsocial)){
                            $q->where('directorios.razon_social','like','%'.$request->razonsocial.'%');                  
                        }
                        if(isset($request->fechainicio)){
                            $q->whereBetween('fecha', [$request->fechainicio, $request->fechafinal]);
                        }
                        if(isset($request->vendedor)){
                            $q->where('id_vendedor','=',$request->vendedor);
                        }
                    })
                    ->orderBy('id_documento','desc')
                    ->take(100)
                    ->get();
        
        
        
        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->orderBy('nombre','desc')->get();

        
        return view('facturacion.facturatech', [
            'factura' => $factura,
            'usuarios'=> $usuarios
        ]);
    }

    static function createXml($id_documento, $request){
        //dd($id_documento);
        $factura = Kardex::select(['facturas.*','kardexes.*','directorios.*','regimenes.*','empresas.*',
                            'regimenes.descripcion as cod_reg_facturatech',
                            'directorios.razon_social as nombre_cliente',
                            'directorios.direccion as direccion_cliente',
                            'departamentos.codigo as depto_codigo',
                            'departamentos.nombre as depto_nombre',
                            'ciudades.codigo as ciudad_codigo',
                            'ciudades.nombre as nombre_ciudad'])
                          ->join('facturas','facturas.id','=','kardexes.id_factura')
                          ->join('directorios','directorios.id','=','kardexes.id_cliente')
                          ->join('empresas','empresas.id','=','kardexes.id_empresa')
                          ->join('regimenes','regimenes.id','=','directorios.id_regimen')
                          ->join('ciudades','ciudades.id','=','directorios.id_ciudad')
                          ->join('departamentos','departamentos.id','=','ciudades.id_departamento')
                          ->where('facturas.id','=',$id_documento)
                          ->get();
        //Construccion del documento en XML
        $empresa = Directorios::select(['regimenes.*','directorios.*',
                            'regimenes.descripcion as cod_reg_facturatech',
                            'departamentos.codigo as depto_codigo',
                            'departamentos.nombre as depto_nombre',
                            'ciudades.codigo as ciudad_codigo',
                            'ciudades.nombre as nombre_ciudad',
                            'f_tacs.TAC_1 as TAC_1'])
                            ->join('regimenes','regimenes.id','=','directorios.id_regimen')
                            ->join('ciudades','ciudades.id','=','directorios.id_ciudad')
                            ->join('departamentos','departamentos.id','=','ciudades.id_departamento')
                            ->join('f_tacs','f_tacs.id_empresa','=','directorios.id_empresa')
                            ->where('nit','=',$factura[0]->nit_empresa)->first();
        
        $totales = Facturas::where('id','=',$id_documento)->first();                    
        $documento = Documentos::where('id','=',$totales->id_documento)->first();

        $digito_verificacion = 7;
        $digito_verificacion_cliente = 7;
        

        $FACTURA = new \SimpleXMLElement('<FACTURA/>');

        //$FACTURA    = $xml->addChild('FACTURA');
        $FACTURA->addAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance'); // add this
        $FACTURA->addAttribute('xmlns:xsd','http://www.w3.org/2001/XMLSchema'); // add this
        $ENC        = $FACTURA->addChild('ENC');
            $ENC->addChild('ENC_1','INVOIC'); //INVOIC
            $ENC->addChild('ENC_2',$factura[0]->nit_empresa); //Identificación del obligado a facturar electrónico - NIT. 
            $ENC->addChild('ENC_3',$factura[0]->nit); //Identificación del adquiriente - NIT. 
            $ENC->addChild('ENC_4','UBL 2.1'); //Versión del esquema UBL
            $ENC->addChild('ENC_5','DIAN 2.1');  //Versión del formato del documento
            $ENC->addChild('ENC_6',$factura[0]->prefijo . $factura[0]->numero); //Número de documento. Número de documento. (factura o factura cambiaria, nota crédito, nota débito). Incluye prefijo + consecutivo de factura autorizados por la DIAN.  
            $ENC->addChild('ENC_7',date("Y-m-d", strtotime($factura[0]->fecha))); //Fecha de emisión de la factura/nota. Formato AAAA-MM-DD 
            $ENC->addChild('ENC_8',date("H:M:S", strtotime($factura[0]->created_at)) + '-05:00'); //Hora de emisión de la factura/nota. Formato: HH:MM:SSdhh:mm
            $ENC->addChild('ENC_9','01'); //Tipo de factura/Nota. (1. FACTURA DE VENTA NACIONAL) (2. FACTURA DE EXPORTACIÓN) (3. FACTURA DE CONTINGENCIA FACTURADOR ) (4. FACTURA CONTINGENCIA DIAN) (91. NOTA CRÉDITO) (92. NOTA DÉBITO)
            $ENC->addChild('ENC_10','COP'); //Divisa consolidada aplicable a toda la factura/nota.
            $ENC->addChild('ENC_15',sizeof($factura)); //Número total de líneas en el documento. Rechazo Si el valor de  ENC _15<> número de ocurrencias del ITE_1
            $ENC->addChild('ENC_16',date("Y-m-d", strtotime($factura[0]->fecha_vencimiento)));//Fecha de vencimiento. Formato AAAA-MM-DD 
            $ENC->addChild('ENC_20','1'); //Código que describe el “ambiente de destino (1. Produccion) (2. Pruebas) donde será procesada la validación previa de este documento electrónico”
            $ENC->addChild('ENC_21','10');  //Indicador del tipo de operación Tablas 2.1 numero 38

        $EMI        = $FACTURA->addchild('EMI'); 
            $EMI->addchild('EMI_1',$empresa->id_directorio_tipo); //Tipo de identificación - Tipos de Persona (1. natural) (2. juridica)
            $EMI->addchild('EMI_2',$empresa->nit); //NIT del emisor.
            $EMI->addchild('EMI_3',$empresa->id_directorio_clase); //Tipo de identificador fiscal de la persona. (DIRECTORIO TIPO CLASE)
            $EMI->addchild('EMI_4',$empresa->cod_reg_facturatech); //Régimen al que pertenece el emisor
            $EMI->addchild('EMI_6',$empresa->razon_social); //Nombre o Razón Social del emisor.
            $EMI->addchild('EMI_7',$empresa->razon_social); //Nombre comercial del emisor.
            $EMI->addchild('EMI_10',$empresa->direccion); //informaciones de su dirección,
            $EMI->addchild('EMI_11',$empresa->depto_codigo); //Código del Departamento.
            $EMI->addchild('EMI_13',$empresa->nombre_ciudad); //Nombre de la ciudad
            $EMI->addchild('EMI_14',$empresa->ciudad_codigo); //Código postal. 
            $EMI->addchild('EMI_15','CO'); //Código País.
            $EMI->addchild('EMI_19',$empresa->depto_nombre); //Nombre del Departamento.  
            $EMI->addchild('EMI_21','COLOMBIA'); //Nombre del País.
            $EMI->addchild('EMI_22',$digito_verificacion); //digito de virificacion ----------HAY QUE HACERLO
            $EMI->addchild('EMI_23',$empresa->ciudad_codigo); //Código del municipio.
            $EMI->addchild('EMI_24',$empresa->razon_social); //Nombre registrado en el RUT.
            $EMI->addchild('EMI_25',$factura[0]->actividad); //Corresponde al código de actividad económica CIIU.

            $TAC    = $EMI->addchild('TAC');
                $TAC->addchild('TAC_1',$empresa->TAC_1); //Obligaciones del contribuyente

            $DFE    = $EMI->addchild('DFE');
                $DFE->addchild('DFE_1',$empresa->ciudad_codigo); //Código del municipio 
                $DFE->addchild('DFE_2',$empresa->depto_codigo); //Código del Departamento
                $DFE->addchild('DFE_3','CO'); //Código dentificador del país
                $DFE->addchild('DFE_4',$empresa->ciudad_codigo); //Código postal
                $DFE->addchild('DFE_5','Colombia'); //Nombre del país
                $DFE->addchild('DFE_6',$empresa->depto_nombre); //Nombre del Departamento
                $DFE->addchild('DFE_7',$empresa->nombre_ciudad); //Nombre de la ciudad
                $DFE->addchild('DFE_8',$empresa->direccion); //informaciones de su dirección,

            $ICC    = $EMI->addchild('ICC');
                $ICC->addchild('ICC_9',$factura[0]->prefijo); //Prefijo de la facturación usada para el punto de venta. 
            
            $CDE    = $EMI->addchild('CDE');
                $CDE->addchild('CDE_1','1'); //Tipo de contacto, del emisor (1. Persona de contacto) (2. Contacto de despacho) (3. Contacto de contabilidad) (4. Contacto de ventas)
                $CDE->addchild('CDE_2',$empresa->razon_social); //Nombre y cargo de la persona de contacto
                $CDE->addchild('CDE_3',$empresa->telefono); //Teléfono  de la persona de contacto
                $CDE->addchild('CDE_4',$empresa->correo); //Correo electrónico  de la persona de contacto
            
            $GTE    = $EMI->addchild('GTE');
                $GTE->addchild('GTE_1','01'); // Identificador del tributo
                $GTE->addchild('GTE_2','IVA'); // Nombre del tributo

        $ADQ    = $FACTURA->addchild('ADQ');
            $ADQ->addchild('ADQ_1',$factura[0]->id_directorio_tipo); //Identificador de tipo de persona
            $ADQ->addchild('ADQ_2',$factura[0]->nit); //Identificador del adquiriente.
            $ADQ->addchild('ADQ_3',$factura[0]->id_directorio_clase); //Tipo de documento de identificación fiscal de la persona
            $ADQ->addchild('ADQ_4',$factura[0]->cod_reg_facturatech); //Régimen: Régimen al que pertenece. 
            $ADQ->addchild('ADQ_6',$factura[0]->nombre_cliente); //Razón social de la empresa.  
            $ADQ->addchild('ADQ_10',$factura[0]->direccion_cliente); //Direccion
            $ADQ->addchild('ADQ_11',$factura[0]->depto_codigo); //Código del Departamento.  
            $ADQ->addchild('ADQ_13',$factura[0]->nombre_ciudad); //Nombre de la ciudad. 
            $ADQ->addchild('ADQ_14',$factura[0]->ciudad_codigo); //Código postal. 
            $ADQ->addchild('ADQ_15','CO'); //Código identificador del país.
            $ADQ->addchild('ADQ_19',$factura[0]->depto_nombre);  //Nombre del Departamento
            $ADQ->addchild('ADQ_21','Colombia');  //Nombre del País 
            $ADQ->addchild('ADQ_22',$digito_verificacion_cliente); //Digito de verificación -DV del NIT del adquiriente
            $ADQ->addchild('ADQ_23',$factura[0]->ciudad_codigo); //Código del municipio.

            $TCR    = $ADQ->addchild('TCR');
                $TCR->addchild('TCR_1','O-99'); //Responsabilidades del adquiriente. 

            $ILA    = $ADQ->addchild('ILA');
                $ILA->addchild('ILA_1',$factura[0]->nombre_cliente);  //Nombre registrado en el RUT
                $ILA->addchild('ILA_2',$factura[0]->nit); //Identificador del adquiriente. 
                $ILA->addchild('ILA_3',$factura[0]->id_directorio_clase); //Tipo de documento de identificación fiscal de la persona
                $ILA->addchild('ILA_4',$digito_verificacion_cliente); //Digito de verificación -DV del NIT del adquiriente

            $DFA    = $ADQ->addchild('DFA');
                $DFA->addchild('DFA_1','CO'); //Código dentificador del país
                $DFA->addchild('DFA_2',$factura[0]->depto_codigo); //Código del Departamento
                $DFA->addchild('DFA_3',$factura[0]->ciudad_codigo); //Código postal
                $DFA->addchild('DFA_4',$factura[0]->ciudad_codigo); //Código del municipio
                $DFA->addchild('DFA_5','Colombia'); //Nombre del país
                $DFA->addchild('DFA_6',$factura[0]->depto_nombre); //Nombre del Departamento
                $DFA->addchild('DFA_7',$factura[0]->nombre_ciudad); //Nombre de la ciudad
                $DFA->addchild('DFA_8',$factura[0]->direccion_cliente); //Direccion
                
            $CDA    = $ADQ->addchild('CDA');
                $CDA->addchild('CDA_1','1'); //Tipo de contacto, del adquiriente
                $CDA->addchild('CDA_2',$factura[0]->nombre_cliente); //Nombre y cargo de la persona de contacto / Nombre del departamento 
                $CDA->addchild('CDA_3',$factura[0]->telefono); //Teléfono de la persona de contacto
                $CDA->addchild('CDA_4',$factura[0]->correo); //Correo electrónico  de la persona de contacto.

            $GTA    = $ADQ->addchild('GTA');
                $GTA->addchild('GTA_1','01'); //Identificador del tributo
                $GTA->addchild('GTA_2','IVA'); //Nombre del tributo

        $TOT    = $FACTURA->addchild('TOT');
            $TOT->addchild('TOT_1',$totales->subtotal); //Valor bruto antes de tributos
            $TOT->addchild('TOT_2','COP'); //Moneda total Importe bruto antes de impuestos. 
            $TOT->addchild('TOT_3','000000000.00'); //Total Valor Base Imponible : Base imponible para el cálculo de los tributos
            $TOT->addchild('TOT_4','COP');  //Moneda del total Base Imponible 
            $TOT->addchild('TOT_5',$totales->total); //Valor a Pagar de Factura: Valor total de ítems (incluyendo cargos y descuentos a nivel de ítems)+valor tributos + valor cargos – valor descuentos – valor anticipos
            $TOT->addchild('TOT_6','COP'); //Moneda del total de la factura.
            $TOT->addchild('TOT_7',$totales->subtotal + $totales->iva); //Total de Valor Bruto más tributos
            $TOT->addchild('TOT_8','COP'); //Moneda Total de Valor bruto con tributos
        
        $TIM    = $FACTURA->addchild('TIM');
            $TIM->addchild('TIM_1','true'); //Indica que el elemento es un: Impuesto retenido o retención. 
            $TIM->addchild('TIM_2',$totales->iva); //Valor del tributo. 
            $TIM->addchild('TIM_3','COP'); //Moneda valor del tributo del impuesto

            if($totales->retefuente > 0){
                $IMP    = $TIM->addchild('IMP');
                    $IMP->addchild('IMP_1','06'); //Identificador del tributo. Retefuente
                    $IMP->addchild('IMP_2',$totales->subtotal); //Base Imponible sobre la que se calcula el valor del tributo.
                    $IMP->addchild('IMP_3','COP'); //Moneda de la base Imponible sobre la que se calcula el valor del tributo.
                    $IMP->addchild('IMP_4',$totales->retefuente); //Valor del tributo:
                    $IMP->addchild('IMP_5','COP'); //Moneda del valor del tributo
                    $IMP->addchild('IMP_6','02.50'); //Tarifa del tributo
            }

            
        
        $TDC    = $FACTURA->addchild('TDC');
            $TDC->addchild('TDC_1','COP'); //Divisa base del documento
            $TDC->addchild('TDC_2','COP'); //Divisa a la cual se hace la conversión
            $TDC->addchild('TDC_3','1.0'); //Valor de la tasa de cambio entre las divisas.
            $TDC->addchild('TDC_4','2020-04-04'); //Fecha en la que se fijó la tasa de cambio (TDC_3 - (CalculationRate))
            $TDC->addchild('TDC_5','1'); //Base monetaria de la divisa extranjera para el cambio. Debe ser 1.00. La DIAN rechaza si trae un valor diferente a 1.00
            $TDC->addchild('TDC_6','1'); //Base monetaria en pesos colombianos para la conversión. Debe ser 1.00. La DIAN rechaza si trae un valor diferente a 1.00

        $DRF    = $FACTURA->addchild('DRF');
            $DRF->addchild('DRF_1',$documento->resolucion); //Número autorización: Número del código de la resolución otorgada para la numeración
            $DRF->addchild('DRF_2',$documento->fecha_inicio); //Fecha de inicio del período de autorización de la numeración.
            $DRF->addchild('DRF_3',$documento->fecha_fin); //Fecha de fin del período de autorización de la numeración.
            $DRF->addchild('DRF_4',$documento->prefijo); //Prefijo del rango de numeración.
            $DRF->addchild('DRF_5',$documento->num_min); //Rango de Numeración (mínimo)
            $DRF->addchild('DRF_6',$documento->num_max); //Rango de Numeración (máximo)

        $NOT    = $FACTURA->addchild('NOT');
            $NOT->addchild('NOT_1',$totales->observaciones); //Información adicional: Texto libre, relativo al documento.

        $MEP    = $FACTURA->addchild('MEP');
            $MEP->addchild('MEP_1','ZZZ'); //Código correspondiente al medio de pago.
            if($totales->fecha == $totales->fecha_vencimiento){
                $MEP->addchild('MEP_2','1'); //Método de pago. Efectivo
            }
            else{
                $MEP->addchild('MEP_2','2'); //Método de pago.
            }
            $MEP->addchild('MEP_3',$totales->fecha_vencimiento); //Fecha de pago 


        $linea = 0;
        foreach($factura as $kardex){
            $referencia = Referencias::where('id','=',$kardex->id_referencia)->first();
            $linea += 1;
            $ITE    = $FACTURA->addchild('ITE');
                $ITE->addchild('ITE_1',$linea); //Número de Línea
                $ITE->addchild('ITE_3',$kardex->cantidad); //Cantidad del producto o servicio.
                $ITE->addchild('ITE_4','94'); //Identificación de la unidad de medida de la cantidad del producto o servicio.
                $ITE->addchild('ITE_5',($kardex->cantidad * $kardex->precio)); //Valor total de la línea.
                $ITE->addchild('ITE_6','COP'); //Moneda del valor total de la línea.
                $ITE->addchild('ITE_7',($kardex->cantidad * $kardex->precio)); //Valor del artículo o servicio (Precio * Unidad)
                $ITE->addchild('ITE_8','COP'); //Moneda del valor del artículo o servicio.
                $ITE->addchild('ITE_11',$referencia->descripcion); //Descripción.
                $ITE->addchild('ITE_19',($kardex->cantidad * $kardex->precio)); //Total del ítem (incluyendo Descuentos y cargos)
                $ITE->addchild('ITE_20','COP'); //Moneda del Total del ítem 
                $ITE->addchild('ITE_21',($kardex->cantidad * $kardex->precio)); //Valor a pagar del ítem
                $ITE->addchild('ITE_22','COP'); //Moneda del Valor a pagar ítem.
                $ITE->addchild('ITE_23',($kardex->cantidad * $kardex->precio));  //Valor subtotal del grupo de conceptos del ítem
                $ITE->addchild('ITE_24','COP'); //Moneda del Subtotal del grupo de conceptos del ítem.
                $ITE->addchild('ITE_27',$kardex->cantidad); //La cantidad real sobre la cual el precio aplica. 
                $ITE->addchild('ITE_28','94'); //Unidad de medida de la cantidad del artículo solicitado
                
                $IAE    = $ITE->addchild('IAE');
                    $IAE->addchild('IAE_1','14212000-0'); //Código del producto acuerdo con el estándar descrito en el campo  IAE_2
                    $IAE->addchild('IAE_2','001'); //Código del estándar. 
                
                
                if($kardex->retefuente > 0){
                    $TII    = $ITE->addchild('TII');
                        $TII->addchild('TII_1',$kardex->retefuente);  //Valor del tributo. 
                        $TII->addchild('TII_2','COP'); //Moneda del valor del tributo
                        $TII->addchild('TII_3','true'); //Indica que el elemento es un: Impuesto retenido o retención. 
                        
                        $IIM    = $TII->addchild('IIM');
                            $IIM->addchild('IIM_1','06');  //Identificador del tributo
                            $IIM->addchild('IIM_2',$kardex->retefuente); //Valor del tributo
                            $IIM->addchild('IIM_3','COP'); //Moneda del valor del tributo
                            $IIM->addchild('IIM_4',($kardex->cantidad * $kardex->precio)); //Base Imponible sobre la que se calcula el valor del tributo
                            $IIM->addchild('IIM_5','COP'); //Moneda de la base imponible sobre la que se calcula el valor del tributo
                            $IIM->addchild('IIM_6','02.50'); //Tarifa del tributo.
                }
                
        }

        $insumo = Insumo_x_m_ls::where('id_factura','=',$id_documento)->get();
        if(sizeof($insumo)==0){ //guardar
            $obj = new Insumo_x_m_ls();
            $obj->id_factura = $id_documento;
            $obj->id_sucursal = $totales->id_sucursal;
            $obj->id_empresa = $totales->id_empresa;
            $obj->id_cliente = $totales->id_cliente;
            $obj->enviado = $FACTURA->asXML();
            $obj->save();
        }
        else{
            $obj = $insumo[0];
            $obj->enviado = $FACTURA->asXML();
            $obj->save();
        }

        return $FACTURA->asXML();
    }

    public function facturatechxml($id_documento, Request $request){
        
        $factura = Kardex::select(['facturas.*','kardexes.*','directorios.*','regimenes.*','empresas.*',
                'regimenes.descripcion as cod_reg_facturatech',
                'directorios.razon_social as nombre_cliente',
                'directorios.direccion as direccion_cliente',
                'departamentos.codigo as depto_codigo',
                'departamentos.nombre as depto_nombre',
                'ciudades.codigo as ciudad_codigo',
                'ciudades.nombre as nombre_ciudad'])
                ->join('facturas','facturas.id','=','kardexes.id_factura')
                ->join('directorios','directorios.id','=','kardexes.id_cliente')
                ->join('empresas','empresas.id','=','kardexes.id_empresa')
                ->join('regimenes','regimenes.id','=','directorios.id_regimen')
                ->join('ciudades','ciudades.id','=','directorios.id_ciudad')
                ->join('departamentos','departamentos.id','=','ciudades.id_departamento')
                ->where('facturas.id','=',$id_documento)
                ->first();
        
        return response(FacturasController::createXml($id_documento, $request))
            ->header('Content-Type', 'text/xml')
            ->header('Cache-Control', 'public')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Disposition', 'attachment; filename=' . $factura->prefijo . $factura->numero . '.xml')
            ->header('Content-Transfer-Encoding', 'binary');


        /*Header('Content-type: text/xml');
        print($xml->asXML());
        */
        /*return array(
            "factura" => $xml->asXML()
        );*/ 
    }


    /**
     * FUNCIONES PARA SUBIR ARCHIVO PLANO
    */
    public function indexIntegracion(){
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return view('administrador.integracion',[
            "directorio_tipo_terceros"=>$directorio_tipo_terceros
        ]);
    }

    public function subirFacturas(Request $request){
        //GUARDAR ARCHIVO EN EL STORAGE
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));

        //RECORRER EL ARCHIVO EN EL STORAGE
        $public_path = public_path();
        $url = $public_path.'/storage/'.$nombre;
        //verificamos si el archivo existe y lo retornamos
        if (\Storage::exists($nombre))
        {
            $numlinea = 0;
            $archivo = fopen($url,'r');
            //recorrer cada linea
            while ($linea = fgets($archivo)) {
                if($numlinea!=0){
                    $lineas[] = explode(',',$linea);    
                }
                $numlinea++;
            }
            fclose($archivo);
        }

 
        return view('administrador.integracion',[
            "archivo"=>$lineas
        ]);
    }

    public function saveFactura(Request $request){

        try{
            $facturas = Facturas::where('id_sucursal','=',Session::get('sucursal'))
                ->where('id_empresa','=',Session::get('id_empresa'))
                ->where('numero','=',$request->numero)
                ->where('prefijo','=',$request->prefijo)
                ->where('id_cliente','=',$request->id_cliente)
                ->where('id_documento','=',$request->id_documento)
                ->get();
            if(sizeof($facturas)>0){
                return array(
                    "result" => "Existe",
                    "body" => "La factura ya existe en la base de datos"
                );
            }

            $tercero = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nit','=',$request->nit_tercero)
                            ->first();
            if($tercero==null){
                return array(
                    "result" => "Incorrecto",
                    "body" => "Tercero no existe"
                );
            }
            $vendedor = Usuarios::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('ncedula','=',$request->nit_vendedor)
                            ->first();
            if($vendedor==null){
                return array(
                    "result" => "Incorrecto",
                    "body" => "vendedor no existe"
                );
            }
            //buscar el tipo de documento
            if($request->tipo_documento == "FC"){ //factura de compra
                $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','COMPRAS')
                            ->first();
            }
            else if($request->tipo_documento == "FV"){ //factura de venta
                $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','MAYORISTA')
                            ->first();
            }
            
            
            
            $obj = new Facturas();
            $obj->id_sucursal		= Session::get('sucursal');
            $obj->numero 			= $request->numero;
            $obj->prefijo 			= $request->prefijo;
            $obj->id_cliente 		= $tercero->id;
            $obj->id_tercero 		= $request->nit_tercero;
            $obj->id_vendedor 		= $vendedor->id;
            $obj->fecha 			= substr($request->fecha,0,4).'-'.substr($request->fecha,4,2).'-'.substr($request->fecha,6,2);
            $obj->fecha_vencimiento = substr($request->fecha,0,4).'-'.substr($request->fecha,4,2).'-'.substr($request->fecha,6,2);
            $obj->id_documento 		= $documento->id;
            $obj->signo 			= $documento->signo;
            $obj->subtotal 			= $request->subtotal;
            $obj->iva 				= $request->iva;
            $obj->impoconsumo 		= $request->impoconsumo;
            $obj->otro_impuesto 	= $request->otro_impuesto;
            $obj->otro_impuesto1 	= $request->otro_impuesto1;
            $obj->descuento 		= $request->descuento;
            $obj->fletes 			= $request->fletes;
            $obj->retefuente 		= $request->retefuente;
            $obj->total 			= ($request->subtotal + $request->iva - $request->impoconsumo - $request->otro_impuesto - $request->otro_impuesto1 - $request->descuento - $request->fletes - $request->retefuente);
            $obj->id_modificado 	= Session::get('user_id');
            $obj->observaciones 	= "INTERCON";
            $obj->estado 			= $request->estado;
            $obj->saldo             = ($obj->total - $request->saldo);
            $obj->id_empresa	 	= Session::get('id_empresa');
            $obj->save();
            return array(
                "result" => "Correcto",
                "body" => "El documento fue SUBIDO en su totalidad"
            );
        }
        catch(Exception $exce){
            return array(
                "result" => "Incorrecto",
                "body" => $exce
            );
        }
    }

}
