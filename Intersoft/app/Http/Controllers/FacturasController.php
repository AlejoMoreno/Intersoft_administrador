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

use Session;

class FacturasController extends Controller
{
    public function saveDocument(Request $request){

    	//buscar si ya existe ese numero con el prefijo y la sucursal de lo contrario es un error.
        $busqueda_factura = Facturas::where('numero',$request->numero)->
                                      where('prefijo',$request->prefijo)->
                                      where('id_documento',$request->id_documento)->
                                      where('id_sucursal',$request->id_sucursal)->
                                      orderBy('numero', 'desc')->get();
        if(sizeof($busqueda_factura) != 0){ // es documento que ya existe
            if($request->signo == "-" || $request->signo == "="){ // se aumenta el numero en 1
                $request->numero = intval($busqueda_factura[0]->numero) + 1;
            }
        }
    	//verificar que el total sea consecuente con el subtotal. 
    	if($request->signo == '+'){
    		$request->id_cliente = Directorios::where('nit',$request->id_cliente)->
    											where('id_directorio_tipo_tercero','1')->get()[0]->id;	
    	}
    	else{
    		$request->id_cliente = Directorios::where('nit',$request->id_cliente)->
    											where('id_directorio_tipo_tercero','!=','1')->get()[0]->id;
    	}

        //verificar si es en efectivo - credito o no aplica (como ajustes)
        if($request->tipo_pago == 'efectivo'){
            $request->saldo = 0;
        }
        else if($request->tipo_pago == 'na'){
            $request->saldo = 0;
        }

    	$obj = new Facturas();
    	$obj->id_sucursal		= Session::get('sucursal');
    	$obj->numero 			= $request->numero;
		$obj->prefijo 			= $request->prefijo;
		$obj->id_cliente 		= $request->id_cliente;
		$obj->id_tercero 		= $request->id_tercero;
		$obj->id_vendedor 		= $request->id_vendedor;
		$obj->fecha 			= $request->fecha;
		$obj->fecha_vencimiento = $request->fecha_vencimiento;
		$obj->id_documento 		= $request->id_documento;
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
		$obj->save();

        //si es en efectivo crear el documento de cartera
        $numero = 1;
        $tipocartera = "";
        if($request->tipo_pago == 'efectivo'){
            if($request->signo == '+'){
                $carteras = Carteras::where('tipoCartera','=','EGRESO')->orderBy('numero','DESC')->first();
                if($carteras){
                   $numero = $carteras->numero +1; 
                }
                $tipocartera = "EGRESO";
            }
            else{
                $carteras = Carteras::where('tipoCartera','=','INGRESO')->orderBy('numero','DESC')->first();
                if($carteras){
                    $numero = $carteras->numero +1;
                }
                $tipocartera = "INGRESO";
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
            $obj_c->id_cliente    = $request->id_cliente;
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
                $obj_1->save();
            }
        }

        //actualizar el numero del documento
        $documento = Documentos::where('id',$request->id_documento)->get()[0];
        //dd($documento->num_presente);
        $documento->num_presente = $obj->numero;
        $documento->save();

		return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function imprimir($id){

    	$factura = Facturas::where('id',$id)->get()[0];
    	$kardex = Kardex::where('id_factura',$id)->get();
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
            $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->get()[0];
        }
    	return view('documentos.impresionFactura', [
            'factura' => $factura,
        	'kardex' => $kardex]);
    }

    public function imprimirpost($id){

        $factura = Facturas::where('id',$id)->get()[0];
        $kardex = Kardex::where('id_factura',$id)->get();
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
            $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->get()[0];
        }
        return view('documentos.impresionFacturaPos', [
            'factura' => $factura,
            'kardex' => $kardex]);
    }

    public function consultar_documento($documento){
        $factura = Facturas::where('id_documento','=',$documento)->get();
        foreach ($factura as $obj) {
            $obj->id_sucursal = Sucursales::where('id','=',$obj->id_sucursal)->get();
            foreach ($obj->id_sucursal as $sucursal) {
                $sucursal->id_empresa = Empresas::where('id',$sucursal->id_empresa)->get()[0];
            }
            $obj->id_documento = Documentos::where('id','=',$obj->id_documento)->get();
            $obj->id_cliente = Directorios::where('id','=',$obj->id_cliente)->get();
            foreach($obj->id_cliente as $cliente){
                $cliente->id_ciudad = Ciudades::where('id',$cliente->id_ciudad)->get()[0];
            }
        }
        return view('documentos.consultar', [
            'factura' => $factura
        ]);
    }
}
