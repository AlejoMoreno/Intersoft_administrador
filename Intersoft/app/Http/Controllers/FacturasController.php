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

use Session;

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
        //verificar si es en efectivo - credito o no aplica (como ajustes)
        $banderaTipoPago = true; // si tiene un tipo de pago, de lo contrario no se tiene en cuenta en contabilidad
        if($request->tipo_pago != 0){
            $tipopago = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))
                              ->where('id','=',$request->tipo_pago)->first();
            if($tipopago->nombre == 'EFECTIVO'){
                $request->saldo = 0;
            }
        }
        else{
            $banderaTipoPago = false;
            $request->saldo = 0;
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
            if($banderaTipoPago == true){ //true= guarda en contabilidad (11050501-caja)
                if($request->signo == '+'){
                    $obj->asiento_contable = FacturasController::AsientoContableCaja($obj,$documento,'C',$tipopago->puc_cuenta);   
                }
                else if($request->signo == '-'){
                    $obj->asiento_contable = FacturasController::AsientoContableCaja($obj,$documento,'D',$tipopago->puc_cuenta);
                }
            }
            //registro de cada saldo y movimientos contables porcada producto
            if($banderaTipoPago == true){
                $obj->kardex = KardexController::saveDocument($request->productosArr,$obj,$obj->asiento_contable);
            }
            else{
                $obj->kardex = KardexController::saveDocumentSinContabilidad($request->productosArr,$obj,$obj->asiento_contable);
            }
            
            if(sizeOf($obj->kardex)>0){
                //registrar el pago
                $numero = 1;
                $tipocartera = "";
                if($request->tipo_pago != 0){
                    $tipopago = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))
                                      ->where('id','=',$request->tipo_pago)->first();
                    if($tipopago->nombre == 'EFECTIVO'){
                        if($request->signo == '+'){
                            $carteras = Carteras::where('tipoCartera','=','EGRESO')->
                                                where('id_empresa','=',Session::get('id_empresa'))->
                                                orderBy('numero','DESC')->first();
                            if($carteras){
                            $numero = $carteras->numero +1; 
                            }
                            $tipocartera = "EGRESO";
                            $tipo_documento = 1; //egreso
                            $tipo_transaccion = "C";
                            //revisar
                            $tipo_transaccion_2 = "D";
                        }
                        else{
                            $carteras = Carteras::where('tipoCartera','=','INGRESO')->
                                                where('id_empresa','=',Session::get('id_empresa'))->
                                                orderBy('numero','DESC')->first();
                            if($carteras){
                                $numero = $carteras->numero +1;
                            }
                            $tipocartera = "INGRESO";
                            $tipo_documento = 2; //recibo de caja
                            $tipo_transaccion = "D";
                            //revisar
                            $tipo_transaccion_2 = "C";
                        }
                        $obj_c = new Carteras();
                        $obj_c->reteiva       = $request->otro_impuesto1;
                        $obj_c->reteica       = $request->otro_impuesto;
                        $obj_c->efectivo      = $obj->total;
                        $obj_c->sobrecosto    = 0;
                        $obj_c->descuento     = $request->descuento;
                        $obj_c->retefuente    = $request->retefuente;
                        $obj_c->otros         = 0;
                        $obj_c->id_sucursal   = Session::get('sucursal');
                        $obj_c->numero        = ( $numero + 1 );
                        $obj_c->prefijo       = "NA";
                        $obj_c->id_cliente    = $tercero->id;
                        $obj_c->id_vendedor   = $request->id_vendedor;
                        $obj_c->fecha         = $request->fecha;
                        $obj_c->tipoCartera   = $tipocartera;         
                        $obj_c->subtotal      = $request->subtotal;
                        $obj_c->total         = $request->total;
                        $obj_c->id_modificado = $request->id_modificado;
                        $obj_c->observaciones = $request->observaciones;
                        $obj_c->id_empresa = Session::get('id_empresa');
                        $obj_c->estado        = $request->estado;
                        if($obj_c->save()){
                            $obj_1 = new KardexCarteras();
                            $obj_1->id_cartera    = $obj_c->id;
                            $obj_1->id_factura    = $obj->id;
                            $obj_1->fechaFactura  = $obj->fecha;
                            $obj_1->numeroFactura = $obj->numero;
                            $obj_1->descuentos    = $obj_c->descuento;
                            $obj_1->sobrecostos   = 0;
                            $obj_1->fletes        = $obj->fletes;
                            $obj_1->retefuente    = $obj_c->retefuente;
                            $obj_1->efectivo      = $obj_c->efectivo;
                            $obj_1->reteiva       = $obj_c->reteiva;
                            $obj_1->reteica       = $obj_c->reteica;
                            $obj_1->id_empresa    = Session::get('id_empresa');
                            $obj_1->total         = $obj_c->total;
                            $obj_1->id_auxiliar	  = 1; //arreglar
                            $obj_1->save();

                            //registro contable egreso/ingreso
                            $contabilidad = new Contabilidades();
                            $contabilidad->tipo_documento = $tipo_documento;
                            $contabilidad->id_sucursal = $obj_c->id_sucursal;
                            $contabilidad->id_documento = $obj_c->id;
                            $contabilidad->numero_documento = $obj_c->numero;
                            $contabilidad->prefijo = $obj_c->prefijo; 
                            $contabilidad->fecha_documento = $obj_c->fecha;
                            $contabilidad->tercero = $obj_c->id_cliente;
                            $contabilidad->id_empresa = Session::get('id_empresa');	

                            $contabilidad->tipo_transaccion = $tipo_transaccion;
                            $contabilidad->id_auxiliar = $obj->asiento_contable->id_auxiliar;
                            $contabilidad->valor_transaccion = $obj_c->total;
                            $asiento_contable = ContabilidadesController::register($contabilidad);

                            //registro contable egreso/ingreso contrapartida
                            $contabilidad = new Contabilidades();
                            $contabilidad->tipo_documento = $tipo_documento;
                            $contabilidad->id_sucursal = $obj_c->id_sucursal;
                            $contabilidad->id_documento = $obj_c->id;
                            $contabilidad->numero_documento = $obj_c->numero;
                            $contabilidad->prefijo = $obj_c->prefijo; 
                            $contabilidad->fecha_documento = $obj_c->fecha;
                            $contabilidad->tercero = $obj_c->id_cliente;
                            $contabilidad->id_empresa = Session::get('id_empresa');	

                            $contabilidad->tipo_transaccion = $tipo_transaccion_2;
                            $contabilidad->id_auxiliar = $obj->asiento_contable->id_auxiliar;
                            $contabilidad->valor_transaccion = $obj_c->total;
                            $asiento_contable = ContabilidadesController::register($contabilidad);
                        }
                    }
                }
            }
        }
        //entradas de inventarios
        
        return array(
            "result" => "success",
            "body" => $obj 
        );
    }
    

    static function AsientoContableCaja($factura,$documento,$tipo_transaccion,$id_auxiliar){
        //registrar asiento contable
        $contabilidad = new Contabilidades();
        $contabilidad->tipo_documento = $documento->documento_contable;
        $contabilidad->id_sucursal = $factura->id_sucursal;
        $contabilidad->id_documento = $factura->id;
        $contabilidad->numero_documento = $factura->numero;
        $contabilidad->prefijo = $factura->prefijo; 
        $contabilidad->fecha_documento = $factura->fecha;
        $contabilidad->valor_transaccion = $factura->total;
        $contabilidad->tipo_transaccion = $tipo_transaccion;
        $contabilidad->tercero = $factura->id_cliente;
        $contabilidad->id_auxiliar = $id_auxiliar;
        $contabilidad->id_empresa = Session::get('id_empresa');
        $contabilidad->save();
        return $contabilidad;
    }

    static function AsientoContablePago(){

    }

    public function Tercero($signo,$request){
        if($signo == '+'){
            $tercero = Directorios::where('nit',$request->id_cliente)->
                                    where('id_directorio_tipo_tercero','1')->
                                    where('id_empresa','=',Session::get('id_empresa'))->first();
        }
        //salidas de inventarios
        if($signo == '-'){
            $tercero = Directorios::where('nit',$request->id_cliente)->
                                    where('id_directorio_tipo_tercero','!=','1')->
                                    where('id_empresa','=',Session::get('id_empresa'))->first();
        }
        //nada con el inventario
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
                                               get()[0];
        }

        /*$pdf = PDF::loadView('documentos.impresionFactura', compact('factura','kardex'));
        $pdf->setPaper('letter','landscape');
        return $pdf->download('Factura_'.$factura->prefijo.'_'.$factura->numero.'.pdf');
*/
    	return view('documentos.impresionFactura', [
            'factura' => $factura,
        	'kardex' => $kardex]);
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

    public function consultar_documento($documento){
        $factura = Facturas::where('id_documento','=',$documento)->
                             where('id_empresa','=',Session::get('id_empresa'))->paginate(5);
        
        foreach ($factura as $obj) {
            $obj->id_sucursal = Sucursales::where('id','=',$obj->id_sucursal)->first();
            
            $obj->id_documento = Documentos::where('id','=',$obj->id_documento)->first();
            $obj->id_cliente = Directorios::where('id','=',$obj->id_cliente)->first();
            $obj->id_cliente ->id_ciudad = Ciudades::where('id',$obj->id_cliente ->id_ciudad)->first();
            $obj->id_sucursal ->id_empresa = Empresas::where('id',$obj->id_sucursal ->id_empresa)->first();
        }
        return view('documentos.consultar', [
            'factura' => $factura
        ]);
    }

    public function anular($id){ 
        $factura = Facturas::where('id', '=', $id)->
                             where('id_empresa','=',Session::get('id_empresa'))->first();
        if($factura->saldo != $factura->total){
            return array(
                "result" => "Alerta",
                "mensaje" => "No se puede realizar la anulación ya que tiene un abono, se debe anhular el abono para ejecutar la anulacion del documento"
            );
        }
        else{
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
                "mensaje" => "El documento fue anulado en su totalidad"
            );
        }
    }

    public function eliminar($id){ 
        $factura = Facturas::where('id', '=', $id)->
                             where('id_empresa','=',Session::get('id_empresa'))->first();
        if($factura->saldo != $factura->total || $factura->estado != "ANULADO"){
            return array(
                "result" => "Alerta",
                "mensaje" => "No se puede realizar la eliminación ya que tiene un abono, se debe anhular el abono para ejecutar la anulacion del documento, ó el documento no se encuentra anulado"
            );
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
}
