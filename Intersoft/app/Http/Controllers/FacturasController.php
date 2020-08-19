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
                                    where('id_empresa','=',Session::get('id_empresa'))->first();
        }
        //nada con el inventario o Salida de inventario
        else{
            $tercero = Directorios::where('nit',$request->id_cliente)->
                                    where('id_directorio_tipo_tercero','!=','1')->
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


    	return view('documentos.impresionFactura', [
            'factura' => $factura,
            'kardex' => $kardex
        ]);
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
                        ->where('kardexes.fecha', '>',$date)
                        ->orderBy('kardexes.id_referencia')->get();

        $kardex1 = Kardex::select('id_referencia',DB::raw('SUM(kardexes.cantidad) as total'))
                        ->where('kardexes.id_empresa','=',Session::get('id_empresa'))
                        ->where('kardexes.signo','=','=')
                        ->where('kardexes.fecha', '>',$date)
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
}
