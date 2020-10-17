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
use App\Directorios;

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
				$referencia->costo_promedio = 	$obj->precio;
				$referencia->costo 		 = 	$obj->precio;
			}
			else{
				
				$precio_total = $referencia->costo_promedio;
				$cantidad_total = $referencia->saldo + $obj->cantidad;
				if($cantidad_total == 0){
					$cantidad_total = 0.01;
				}
				$referencia->costo_promedio = (($precio_total * $referencia->saldo) + ($obj->cantidad * $obj->precio))/$cantidad_total;
				$referencia->costo 		 = 	$obj->precio;	
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
				
				$precio_total = $referencia->precio_4;
				$cantidad_total = $referencia->saldo + $obj->cantidad;
				if($cantidad_total == 0){
					$cantidad_total = 0.01;
				}
				$referencia->precio4 = (($precio_total * $referencia->saldo) + ($obj->cantidad * $obj->precio))/$cantidad_total;
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

	/**
     * FUNCIONES PARA SUBIR ARCHIVO PLANO
    */

    public function subirKardex(Request $request){
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
                $lineas[] = explode(',',$linea);  
                $numlinea++;
            }
            fclose($archivo);
        }

 
        return view('administrador.integracion',[
            "kardex"=>$lineas
        ]);
    }

    public function saveKardex(Request $request){

        try{
			
			$tercero = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nit','=',$request->nit_tercero)
                            ->first();
            if($tercero==null){
                return array(
                    "result" => "Incorrecto",
                    "body" => "Tercero no existe"
                );
            }

			//buscar el tipo de documento
            if($request->tipo_documento == "1"){ //factura de compra
                $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','COMPRAS')
                            ->first();
            }
            else if($request->tipo_documento == "2"){ //factura de venta
                $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','MAYORISTA')
                            ->first();
			}
			else{
				return array(
                    "result" => "Incorrecto",
                    "body" => "TIPO DOCUMENTO no existe"
                );
			}
			
			$sucursales =  Sucursales::where('id_empresa','=',Session::get('id_empresa'))->get();

            $factura = Facturas::where('id_empresa','=',Session::get('id_empresa'))
				->where('id_sucursal','=',Session::get('sucursal'))	
				->where('numero','=',$request->numero)
                ->where('prefijo','=',$request->prefijo)
                ->where('id_cliente','=',$tercero->id)
                ->where('id_documento','=',$documento->id)
                ->get();
            if(sizeof($factura)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "La factura No existe en la base de datos"
                );
			}
			
			$producto = Referencias::where('id_empresa','=',Session::get('id_empresa'))
                ->where('codigo_interno','like','%'.$request->codigo.'%')
                ->get();
            if(sizeof($producto)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "El producto No existe en la base de datos"
                );
			}

			$lote = Lotes::where('id_empresa','=',Session::get('id_empresa'))
                ->where('id_referencia','=',$producto[0]->id)
                ->get();
            if(sizeof($lote)==0){
				$lotes = new Lotes();
				$lotes->id_referencia     = $producto[0]->id;
				$lotes->numero_lote   	= 0;
				$lotes->fecha_vence_lote  = $request->fecha_vence_lote;
				$lotes->ubicacion   		= " ";
				$lotes->serial            = $request->serial;
				$lotes->cantidad          = $producto[0]->saldo;
				$lotes->id_sucursal       = Session::get('sucursal');
				$lotes->id_empresa	= Session::get('id_empresa');
				$lotes->save();
			}
			$lote = Lotes::where('id_empresa','=',Session::get('id_empresa'))
                ->where('id_referencia','=',$producto[0]->id)
                ->get();
                        
			//verificar si ya esta subido este o no
			$kardex = Kardex::where('id_empresa','=',Session::get('id_empresa'))
							->where('numero','=',$factura[0]->numero)
							->where('prefijo','=',$factura[0]->prefijo)
							->where('id_cliente','=',$factura[0]->id_cliente)
							->where('id_documento','=',$factura[0]->id_documento)
							->where('id_referencia','=',$producto[0]->id_referencia)
							->where('cantidad','=',$request->cantidad)
							->where('precio','=',$request->precio)
							->get();
			if(sizeof($kardex)>0){
				return array(
					"result" => "Incorrecto",
					"body" => "El registro ya existe en la base de datos"
				);
			}
            
            $obj = new Kardex();
			$obj->id_sucursal	= $factura[0]->id_sucursal;
			$obj->numero 		= $factura[0]->numero;
			$obj->prefijo 		= strval($factura[0]->prefijo);
			$obj->id_cliente 	= $factura[0]->id_cliente;
			$obj->id_factura 	= $factura[0]->id;
			$obj->id_vendedor 	= $factura[0]->id_vendedor;
			$obj->fecha 		= $factura[0]->fecha;
			$obj->id_referencia = $producto[0]->id;
			$obj->lote 			= $lote[0]->id;
			$obj->serial 		= $lote[0]->serial;
			$obj->fecha_vencimiento = $lote[0]->fecha_vencimiento;
			$obj->cantidad 		= $request->cantidad;
			$obj->precio 		= $request->precio;
			$obj->costo 		= $request->costo;
			$obj->id_documento 	= $factura[0]->id_documento;
			$obj->signo 		= strval($factura[0]->signo);
			$obj->subtotal 		= $request->subtotal;
			$obj->iva 			= $request->iva;
			$obj->impoconsumo 	= $request->reteica;
			$obj->otro_impuesto = $factura[0]->otro_impuesto;
			$obj->otro_impuesto1 = $request->reteiva;
			$obj->descuento 	= $request->descuento;
			$obj->fletes 		= 0;
			$obj->retefuente 	= $request->retefuente;
			$obj->total 		= $factura[0]->total;
			$obj->observaciones = strval($factura[0]->observaciones);
			$obj->id_modificado = $factura[0]->id_modificado;
			$obj->kardex_anterior = $factura[0]->id; //id factura
			$obj->id_empresa	= Session::get('id_empresa');
			$obj->estado 		= strval($factura[0]->estado);
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
