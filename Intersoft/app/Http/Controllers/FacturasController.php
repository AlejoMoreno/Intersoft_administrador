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


    	$obj = new Facturas();
    	$obj->id_sucursal		= $request->id_sucursal;
    	$obj->numero 			= $request->numero;
		$obj->prefijo 			= $request->prefijo;
		$obj->id_cliente 		= $request->id_cliente;
		$obj->id_tercero 		= $request->id_tercero;
		$obj->id_vendedor 		= $request->id_vendedor;
		$obj->fecha 			= $request->fecha;
		$obj->fecha_vencimiento = $request->fecha_vencimiento;
		$obj->id_documento 		= $request->id_documento;
		$obj->signo 			= $request->signo;
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
		$obj->observaciones 	= $request->observaciones;
		$obj->estado 			= $request->estado;
        $obj->saldo             = $request->saldo;
		$obj->save();

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
}
