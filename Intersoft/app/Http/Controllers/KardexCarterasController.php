<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KardexCarteras;
use App\Facturas;

use Session;

class KardexCarterasController extends Controller
{
    public function save(Request $request){

    	$obj = new KardexCarteras();

    	$obj->id_cartera 	= $request->id_cartera;
    	$obj->id_factura    = $request->id_factura;
		$obj->fechaFactura 	= $request->fechaFactura;
		$obj->numeroFactura = $request->numeroFactura;
		$obj->descuentos 	= $request->descuentos;
		$obj->sobrecostos 	= $request->sobrecostos;
		$obj->fletes 		= $request->fletes;
		$obj->retefuente 	= $request->retefuente;
		$obj->efectivo 		= $request->efectivo;
		$obj->reteiva 		= $request->reteiva;
		$obj->reteica 		= $request->reteica;
		$obj->id_empresa	= Session::get('id_empresa');
		$obj->total	 		= $request->total;

		$obj->save();

		$factura = Facturas::where('id',$obj->id_factura)->get()[0];
		$factura->saldo = $factura->saldo - $obj->efectivo;
		$factura->save();


		return array(
			'result' => "success",
			'body' => $obj  
		);
	}
}
