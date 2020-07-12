<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kardex;
use App\Referencias;
use App\Lotes;
use App\Documentos;
use App\Facturas;
use App\Sucursales;
use App\Lineas;

use App\Clasificaciones;
use App\Contabilidades;

use Session;

class KardexController extends Controller
{
	static function saveDocument($productosArr,$factura,$asiento_contable){
		$productos_insertados = array();
		//recorrer los productos
		foreach($productosArr as $producto){
			$obj_pro = KardexController::AddProducto($producto,$factura);
			//$asiento = KardexController::AsientoContable($obj_pro,$asiento_contable,$factura->signo);
			//asientp contable
			array_push($productos_insertados, $obj_pro);
		}
		return $productos_insertados;
	}

	static function saveDocumentSinContabilidad($productosArr,$factura,$asiento_contable){
		$productos_insertados = array();
		//recorrer los productos
		foreach($productosArr as $producto){
			$obj_pro = KardexController::AddProducto($producto,$factura);
			//$asiento = KardexController::AsientoContable($obj_pro,$asiento_contable,$factura->signo);
			//asientp contable
			array_push($productos_insertados, $obj_pro);
		}
		return $productos_insertados;
	}

    static function AddProducto($producto,$factura){
		$producto = (object)$producto;
    	if($producto->lote == '' || $producto->lote == null){
    		$producto->lote = "";
    		$producto->serial = "";
    		$producto->fecha_vencimiento = "";
		}
		
		//buscar la referencia 
		$referencia = Referencias::where('id','=',$producto->id_referencia)->get()[0];

		$linea = Lineas::where('id','=',$referencia->codigo_linea)->first();

    	$obj = new Kardex();
    	$obj->id_sucursal	= $factura->id_sucursal;
		$obj->numero 		= $factura->numero;
		$obj->prefijo 		= strval($factura->prefijo);
		$obj->id_cliente 	= $factura->id_cliente;
		$obj->id_factura 	= $factura->id;
		$obj->id_vendedor 	= $factura->id_vendedor;
		$obj->fecha 		= $factura->fecha;
		$obj->id_referencia = $producto->id_referencia;
		$obj->lote 			= $producto->lote;
		$obj->serial 		= $producto->serial;
		$obj->fecha_vencimiento = $producto->fecha_vencimiento;
		$obj->cantidad 		= $producto->cantidad;
		$obj->precio 		= $producto->precio;
		$obj->costo 		= $producto->costo;
		$obj->id_documento 	= $factura->id_documento;
		$obj->signo 		= strval($factura->signo);
		$obj->subtotal 		= $producto->subtotal;
		//sacar el iva 
		$iva = ($producto->subtotal) * ($linea->iva_porcentaje/100);
		$obj->iva 			= $iva;
		//sacar el reteica
		$reteica = ($producto->subtotal) * ($linea->reteica_porcentaje/100);
		$obj->impoconsumo 	= $reteica;
		$obj->otro_impuesto = $factura->otro_impuesto;
		//sacar el reteiva
		$reteiva = ($producto->subtotal) * ($linea->reteiva_porcentaje/100);
		$obj->otro_impuesto1 = $reteiva;
		//sacar el descuento
		$descuento = ($producto->subtotal) * ($producto->descuento/100);
		$obj->descuento 	= $descuento;
		$obj->fletes 		= 0;
		//sacar el retefuente
		$retefuente = ($producto->subtotal) * ($linea->retefuente_porcentaje/100);
		$obj->retefuente 	= $retefuente;
		$obj->total 		= $factura->total;
		$obj->observaciones = strval($factura->observaciones);
		$obj->id_modificado = $factura->id_modificado;
		$obj->kardex_anterior = $factura->id; //id factura
		$obj->id_empresa	= Session::get('id_empresa');
		$obj->estado 		= strval($factura->estado);
		$obj->save();

		
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
			$lotes->id_sucursal	= Session::get('sucursal');
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
				$valor = $referencia->saldo - $obj->cantidad;
				if($valor == 0){
					$valor = 0.01;
				}
				$referencia->costo_promedio = 	( ($referencia->costo_promedio * $valor) + ($obj->costo * $obj->cantidad) )/($valor);
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
				$referencia->precio4 = 	( ($referencia->precio4 * $valor) - ( $obj->precio * $obj->cantidad) )/($valor);
			}
		}
		else{
			//no se hace nada con el saldo
			$referencia->saldo = $referencia->saldo;
		}
		$referencia->save();
		$obj->referencia = $referencia;
		$obj->lote = $lote;
		return  $obj;
	}
	
	static function AsientoContable($obj_pro,$asiento_contable,$signo){
		$referencia = (object)$obj_pro->referencia;
		//verificar auxiliar contable apartir de la clasificacion del producto
		$clasificacion = Clasificaciones::where('id','=',$referencia->id_clasificacion)->first();
		//registrar asiento contable
		$tipo_transaccion = '';
		//buscar la referencia 
		$linea = Lineas::where('id','=',$referencia->codigo_linea)->first();
		if($signo == '-'){ //va  ala contrapartida
			$tipo_transaccion = "C";
			$puc = $linea->puc_venta;
			$puc_val = $obj_pro->total;
			$iva = $linea->v_puc_iva;
			$iva_val = $puc_val * ($linea->iva_porcentaje/100);
			$reteica = $linea->v_puc_reteica;
			$reteica_val = $puc_val * ($linea->reteica_porcentaje/100);
			$reteiva = $linea->v_puc_reteiva;
			$reteiva_val = $puc_val * ($linea->reteiva_porcentaje/100);
			$retefuente = $linea->v_puc_retefuente;
			$retefuente_val = $puc_val * ($linea->retefuente_porcentaje/100);
		}
		else if($signo == '+'){ //va  ala partida
			$tipo_transaccion = "D";
			$puc = $linea->puc_compra;
			$puc_val = $obj_pro->total;
			$iva = $linea->c_puc_iva;
			$iva_val = $puc_val * ($linea->iva_porcentaje/100);
			$reteica = $linea->c_puc_reteica;
			$reteica_val = $puc_val * ($linea->reteica_porcentaje/100);
			$reteiva = $linea->c_puc_reteiva;
			$reteiva_val = $puc_val * ($linea->reteiva_porcentaje/100);
			$retefuente = $linea->c_puc_retefuente;
			$retefuente_val = $puc_val * ($linea->retefuente_porcentaje/100);
		}        
		
		//trgistro del movimiento contable
		$contabilidad = new Contabilidades();
		
        $contabilidad->tipo_documento = (string)$asiento_contable->tipo_documento;
        $contabilidad->id_sucursal = $asiento_contable->id_sucursal;
        $contabilidad->id_documento = $asiento_contable->id_documento;
        $contabilidad->numero_documento = $asiento_contable->numero_documento;
        $contabilidad->prefijo = $asiento_contable->prefijo; 
        $contabilidad->fecha_documento = $asiento_contable->fecha_documento;
        $contabilidad->tercero = $asiento_contable->tercero;
		$contabilidad->id_empresa = Session::get('id_empresa');	
		$contabilidad->tipo_transaccion = $tipo_transaccion;
		$contabilidad->id_auxiliar = $puc;
		$contabilidad->valor_transaccion = $puc_val;

		$contabilidad1 = $contabilidad; //copiar el registro
		$contabilidad1->tipo_transaccion = $tipo_transaccion;
		$contabilidad1->id_auxiliar = $iva;
		$contabilidad1->valor_transaccion = $iva_val;

		$contabilidad2 = $contabilidad; //copiar el registro
		$contabilidad2->tipo_transaccion = $tipo_transaccion;
		$contabilidad2->id_auxiliar = $reteica;
		$contabilidad2->valor_transaccion = $reteica_val;

		$contabilidad3 = $contabilidad; //copiar el registro
		$contabilidad3->tipo_transaccion = $tipo_transaccion;
		$contabilidad3->id_auxiliar = $reteiva;
		$contabilidad3->valor_transaccion = $reteiva_val;

		$contabilidad4 = $contabilidad; //copiar el registro
		$contabilidad4->tipo_transaccion = $tipo_transaccion;
		$contabilidad4->id_auxiliar = $retefuente;
		$contabilidad4->valor_transaccion = $retefuente_val;

		//dd($puc_val);

		$asiento_contable1 = $contabilidad->save();//ContabilidadesController::register($contabilidad);
		$asiento_contable1 = $contabilidad1->save();//ContabilidadesController::register($contabilidad1);
		$asiento_contable1 = $contabilidad2->save();//ContabilidadesController::register($contabilidad2);
		$asiento_contable1 = $contabilidad3->save();//ContabilidadesController::register($contabilidad3);
		$asiento_contable1 = $contabilidad4->save();//ContabilidadesController::register($contabilidad4);
		
        return $asiento_contable1;
    }

    public function showid($id){

		$kardex = Kardex::where('id_referencia','=',$id)->orderBy('created_at')->paginate(5);
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
	
	public function kardexShow(){
		$kardex = Kardex::where('id_empresa','=',Session::get('id_empresa'))->orderBy('created_at')->paginate(5);
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


	public function pedidos( $id_documento ){
		$kardex = Kardex::where('id_documento','=',$id_documento)->get();
		return array(
			"kardex"=>$kardex
		);
	}

}
