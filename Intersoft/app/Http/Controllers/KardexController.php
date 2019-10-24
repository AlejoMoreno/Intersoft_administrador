<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kardex;
use App\Referencias;
use App\Lotes;
use App\Documentos;
use App\Facturas;
use App\Sucursales;

use Session;

class KardexController extends Controller
{
    public function saveDocument(Request $request){

    	if($request->lote == '' || $request->lote == null){
    		$request->lote = "";
    		$request->serial = "";
    		$request->fecha_vencimiento = "";
    	}

    	$obj = new Kardex();
    	$obj->id_sucursal	= $request->id_sucursal;
		$obj->numero 		= $request->numero;
		$obj->prefijo 		= strval($request->prefijo);
		$obj->id_cliente 	= $request->id_cliente;
		$obj->id_factura 	= $request->id_factura;
		$obj->id_vendedor 	= $request->id_vendedor;
		$obj->fecha 		= $request->fecha;
		$obj->id_referencia = $request->id_referencia;
		$obj->lote 			= $request->lote;
		$obj->serial 		= $request->serial;
		$obj->fecha_vencimiento = $request->fecha_vencimiento;
		$obj->cantidad 		= $request->cantidad;
		$obj->precio 		= $request->precio;
		$obj->costo 		= $request->costo;
		$obj->id_documento 	= $request->id_documento;
		$obj->signo 		= strval($request->signo);
		$obj->subtotal 		= $request->subtotal;
		$obj->iva 			= $request->iva;
		$obj->impoconsumo 	= $request->impoconsumo;
		$obj->otro_impuesto = $request->otro_impuesto;
		$obj->otro_impuesto1 = $request->otro_impuesto1;
		$obj->descuento 	= $request->descuento;
		$obj->fletes 		= $request->fletes;
		$obj->retefuente 	= $request->retefuente;
		$obj->total 		= $request->total;
		$obj->observaciones = strval($request->observaciones);
		$obj->id_modificado = $request->id_modificado;
		$obj->kardex_anterior = $request->kardex_anterior; //id factura
		$obj->id_empresa	= Session::get('id_empresa');
		$obj->estado 		= strval($request->estado);
		$obj->save();


		//buscar la referencia 
		$referencia = Referencias::where('id','=',$obj->id_referencia)->get()[0];
		$lote = Lotes::where('id_referencia','=',$obj->id_referencia)->
						where('numero_lote','=',$obj->lote)->
						where('id_empresa','=',Session::get('id_empresa'))->first();

		//guardado de lotes y saldos por lotes	(si no existe es porque es entrada el documento)			
		if(sizeof($lote) == 0 ){         
			$lotes = new Lotes();
			$lotes->id_referencia     	= $obj->id_referencia;
	        $lotes->numero_lote   		= $obj->lote;
	        $lotes->fecha_vence_lote  	= $obj->fecha_vencimiento;
	        $lotes->ubicacion   		= 'NINGUNA';
	        $lotes->serial            	= $obj->serial;
			$lotes->cantidad          	= $obj->cantidad;
			$lotes->id_empresa	= Session::get('id_empresa');
			$lotes->save();
	        
		}
		else{
			if($obj->signo == '+'){
				//se suma las cantidades
				$lote->cantidad = $lote->cantidad + $obj->cantidad;				 
			}
			else if($obj->signo == '-'){
				//las cantidades se restan 
				$lote->cantidad = $lote->cantidad - $obj->cantidad;
			}
			else{
				//no se hace nada con el saldo
				$lote->cantidad = $lote->cantidad;
			}
			$lote->save();

		}
		
        //reasignar el saldo del inventario
		if($obj->signo == '+'){
			//se suma las cantidades
			$referencia->saldo = $referencia->saldo + $obj->cantidad;
			//costo
			if($referencia->costo == "0"){
				$referencia->costo_promedio = 	$obj->costo;
				$referencia->costo 		 = 	$obj->costo;
			}
			else{
				$valor = $referencia->saldo-$obj->cantidad;
				if($valor == 0){
					$valor = 0.01;
				}
				$referencia->costo_promedio = 	( ($referencia->costo_promedio * $referencia->saldo) + ($obj->costo * $obj->cantidad) )/($valor);
				$referencia->costo 		 = 	$obj->costo;	
			}
		}
		else if($obj->signo == '-'){
			//las cantidades se restan 
			$referencia->saldo = $referencia->saldo - $obj->cantidad;
			if($referencia->precio4 == "0"){
				$referencia->precio4 = 	$obj->precio;
			}
			else{
				$valor = $referencia->saldo-$obj->cantidad;
				if($valor == 0){
					$valor = 0.01;
				}
				$referencia->precio4 = 	( ($referencia->precio4 * $referencia->saldo) - ( $obj->precio * $obj->cantidad) )/($valor);
			}
		}
		else{
			//no se hace nada con el saldo
			$referencia->saldo = $referencia->saldo;
		}
		$referencia->save();





		return  array(
            "result"=>"success",
            "body"=> array (
            	$obj,
            	$referencia,
            	$lote)
        );
    }

    public function showid($id){

		$kardex = Kardex::where('id_referencia','=',$id)->orderBy('created_at')->get();
    	foreach ($kardex as $value) {
    		$value->cabecera = Facturas::where('numero','=',$value->numero)->where('id_documento','=',$value->id_documento)->get();
    		$value->id_referencia = Referencias::where('id','=',$value->id_referencia)->first();
    		$value->id_documento = Documentos::where('id','=',$value->id_documento)->first();
    		$value->id_sucursal = Sucursales::where('id','=',$value->cabecera[0]->id_sucursal)->first();    		
    	}
    	//dd($kardex);
    	return view('inventario.kardex',[
    		'kardex'=>$kardex
    	]);
    }

}
