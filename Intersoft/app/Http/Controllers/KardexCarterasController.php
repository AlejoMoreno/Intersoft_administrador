<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Carteras;
use App\KardexCarteras;
use App\Facturas;
use App\Directorios;
use App\Documentos;

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
		$obj->id_auxiliar	= $request->id_auxiliar;
		$obj->total	 		= $request->total;

		$obj->save();

		$factura = Facturas::where('id',$obj->id_factura)->get();
		if(sizeof($factura)>0){
			if($factura[0]->saldo != 0){
				$factura[0]->saldo = $factura[0]->saldo - $obj->efectivo;
				$factura[0]->save();
			}
		}


		return array(
			'result' => "success",
			'body' => $obj  
		);
	}

	/**
     * FUNCIONES PARA SUBIR ARCHIVO PLANO
    */

    public function subirKardexcarteras(Request $request){
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
            "kardexcarteras"=>$lineas
        ]);
    }

    public function saveKardexcarteras(Request $request){

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

            $cartera = Carteras::where('id_empresa','=',Session::get('id_empresa'))
				->where('numero','=',$request->numero)
                ->where('prefijo','=',$request->prefijo)
                ->where('id_cliente','=',$tercero->id)
                ->where('tipoCartera','=',$request->tipoCartera)
                ->get();
            if(sizeof($cartera)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "La Cartera No existe en la base de datos"
                );
			}

			//buscar el tipo de documento
            if($request->tipo_factura == "1"){ //factura de compra
                $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','COMPRAS')
                            ->first();
            }
            else if($request->tipo_factura == "2"){ //factura de venta
                $documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nombre','like','MAYORISTA')
                            ->first();
            }
			

			$factura = Facturas::where('id_empresa','=',Session::get('id_empresa'))
				->where('numero','=',$request->numero_factura)
                ->where('prefijo','=',$request->prefijo_factura)
				->where('id_cliente','=',$tercero->id)
				->where('id_documento','=',$documento->id)
                ->get();
            if(sizeof($factura)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "La Factura No existe en la base de datos"
                );
			}

			$kardex = KardexCarteras::where('id_empresa','=',Session::get('id_empresa'))
				->where('id_cartera','=',$cartera[0]->id)
                ->where('id_factura','=',$factura[0]->id)
				->where('id_cliente','=',$tercero->id)
				->where('total','=',$request->efectivo)
                ->get();
            if(sizeof($kardex)>0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "El registro ya existe en la base de datos"
                );
			}

			
            $obj = new KardexCarteras();
			$obj->id_cartera 	= $cartera[0]->id;
			$obj->id_factura    = $factura[0]->id;
			$obj->fechaFactura 	= $cartera[0]->fecha;
			$obj->numeroFactura = $factura[0]->numero;
			$obj->descuentos 	= $request->descuentos;
			$obj->sobrecostos 	= $request->sobrecostos;
			$obj->fletes 		= 0;
			$obj->retefuente 	= $request->retefuente;
			$obj->efectivo 		= $request->efectivo;
			$obj->reteiva 		= $request->reteiva;
			$obj->reteica 		= $request->reteica;
			$obj->id_empresa	= Session::get('id_empresa');
			$obj->id_auxiliar	= 0;
			$obj->total	 		= $request->efectivo;
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
