<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kardex;
use App\Referencias;
use App\Lotes;

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
		$obj->estado 		= strval($request->estado);
		$obj->save();


		//buscar la referencia 
		$referencia = Referencias::where('id','=',$obj->id_referencia)->get()[0];
		$lote = Lotes::where('id_referencia','=',$obj->id_referencia)->
						where('numero_lote','=',$obj->lote)->get();

		//guardado de lotes y saldos por lotes	(si no existe es porque es entrada el documento)			
		if(sizeof($lote) == 0 ){         
			$lote = new Lotes();
			$lote->id_referencia     	= $obj->id_referencia;
	        $lote->numero_lote   		= $obj->lote;
	        $lote->fecha_vence_lote  	= $obj->fecha_vencimiento;
	        $lote->ubicacion   			= 'NINGUNA';
	        $lote->serial            	= $obj->serial;
	        $lote->cantidad          	= $obj->cantidad;
	        $lote->save();
		}
		else{
			if($obj->signo == '+'){
				//se suma las cantidades
				$lote[0]->cantidad = $lote[0]->cantidad + $obj->cantidad;
				if($referencia->costo == "0"){
					$referencia->costo_promedio = 	$obj->costo;
					$referencia->costo 		 = 	$obj->costo;
				}
				else{
					$referencia->costo_promedio = 	($referencia->costo_promedio+$obj->costo)/($referencia->saldo+$obj->cantidad);
					$referencia->costo 		 = 	$obj->costo;	
				}
				 
			}
			else if($obj->signo == '-'){
				//las cantidades se restan 
				$lote[0]->cantidad = $lote[0]->cantidad - $obj->cantidad;
				if($referencia->precio4 == "0"){
					$referencia->precio4 = 	$obj->precio;
				}
				else{
					$referencia->precio4 = 	($referencia->precio4+$obj->precio)/($referencia->saldo-$obj->cantidad);
				}
			}
			else{
				//no se hace nada con el saldo
				$lote[0]->cantidad = $lote[0]->cantidad;
			}
			$lote[0]->save();

		}
		
        //reasignar el saldo del inventario
		if($obj->signo == '+'){
			//se suma las cantidades
			$referencia->saldo = $referencia->saldo + $obj->cantidad;
		}
		else if($obj->signo == '-'){
			//las cantidades se restan 
			$referencia->saldo = $referencia->saldo - $obj->cantidad;
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
}
