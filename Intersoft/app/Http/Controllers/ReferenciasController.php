<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Referencias;

use App\Lineas;
use App\Tipo_presentaciones;
use App\Marcas;
use App\Clasificaciones;
use App\Usuarios;
use App\Cuentas;
use App\Pucauxiliar;

use DB;

use Session;

class ReferenciasController extends Controller
{
    //
    public function create(Request $request){
		try{
			$cont = Referencias::where('codigo_linea','=',$request->codigo_linea)->
								where('codigo_letras','=',substr($request->descripcion,0,3))->
								where('id_empresa','=',Session::get('id_empresa'))->get();
			$obj = new Referencias();
			$obj->codigo_linea     	= $request->codigo_linea;
			$obj->codigo_letras   	= substr($request->descripcion,0,3);
			$obj->codigo_consecutivo= sizeof($cont)+1;
			$obj->descripcion 		= $request->descripcion;
			$obj->codigo_barras 	= $request->codigo_barras;
			$obj->codigo_interno 	= $request->codigo_interno;
			$obj->codigo_alterno 	= $request->codigo_alterno;
			$obj->id_presentacion 	= $request->id_presentacion;
			$obj->id_marca 			= $request->id_marca;
			$obj->factor_rendimiento= $request->factor_rendimiento;
			$obj->stok_minimo 		= $request->stok_minimo;
			$obj->stok_maximo 		= $request->stok_maximo;
			$obj->iva 				= $request->iva;
			$obj->impo_consumo 		= $request->impo_consumo;
			$obj->sobre_tasa 		= $request->sobre_tasa;
			$obj->serie 			= $request->serie;
			$obj->descuento 		= $request->descuento;
			$obj->id_clasificacion 	= $request->id_clasificacion;
			$obj->peso 				= $request->peso;
			$obj->precio1 			= $request->precio1;
			$obj->precio2 			= $request->precio2;
			$obj->precio3 			= $request->precio3;
			$obj->precio4 			= $request->precio4;
			$obj->estado 			= $request->estado;
			$obj->hommologo 		= $request->hommologo;
			$obj->costo 			= "0";
			$obj->costo_promedio 	= "0";
			$obj->saldo 			= "0";
			$obj->usuario_creador 	= $request->usuario_creador;
			$obj->id_empresa	 	= Session::get('id_empresa');
			$obj->save();
			return redirect('/inventario/referencias');
		}
		catch (ModelNotFoundException $exception){
			return  array(
				"result"=>"fail",
				"body"=>$exception);
		}
    }

    public function update(Request $request){
		try{
			$obj = Referencias::where('id',$request->id)->first();
			$obj->codigo_linea     	= $request->codigo_linea;
			$obj->codigo_letras   	= $request->codigo_letras;
			$obj->codigo_consecutivo= $request->codigo_consecutivo;
			$obj->descripcion 		= $request->descripcion;
			$obj->codigo_barras 	= $request->codigo_barras;
			$obj->codigo_interno 	= $request->codigo_interno;
			$obj->codigo_alterno 	= $request->codigo_alterno;
			$obj->id_presentacion 	= $request->id_presentacion;
			$obj->id_marca 			= $request->id_marca;
			$obj->factor_rendimiento= $request->factor_rendimiento;
			$obj->stok_minimo 		= $request->stok_minimo;
			$obj->stok_maximo 		= $request->stok_maximo;
			$obj->iva 				= $request->iva;
			$obj->impo_consumo 		= $request->impo_consumo;
			$obj->sobre_tasa 		= $request->sobre_tasa;
			$obj->serie 			= $request->serie;
			$obj->descuento 		= $request->descuento;
			$obj->id_clasificacion 	= $request->id_clasificacion;
			$obj->peso 				= $request->peso;
			$obj->precio1 			= $request->precio1;
			$obj->precio2 			= $request->precio2;
			$obj->precio3 			= $request->precio3;
			$obj->precio4 			= $request->precio4;
			$obj->estado 			= $request->estado;
			$obj->hommologo 		= $request->hommologo;
			$obj->usuario_creador 	= $request->usuario_creador;
			$obj->id_empresa	 	= Session::get('id_empresa');
			$obj->save();
			return $obj;
		}
		catch (ModelNotFoundException $exception){
			return  array(
				"result"=>"fail",
				"body"=>$exception);
		}
    }
    
    public function showone($id){
		try{
			$obj = Referencias::where('id_empresa','=',Session::get('id_empresa'))
							->where('id','=',$id)->first();
			return  array(
				"result"=>"success",
				"body"=>$obj);
		}
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function delete($id){
		try{
			$obj = Referencias::where('id_empresa','=',Session::get('id_empresa'))
							->where('id','=',$id)->first();
			$obj->delete();
			return redirect('/inventario/referencias');
		}
		catch (ModelNotFoundException $exception){
			return  array(
				"result"=>"fail",
				"body"=>$exception);
		}
    }

    public function all(){
		try{
			$obj = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
			return  array(
				"result"=>"success",
				"body"=>$obj);
		}
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
		try{
			$objs = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
			$lineas = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
			$presentaciones = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
			$marcas = Marcas::where('id_empresa','=',Session::get('id_empresa'))->get();
			$clasificaciones = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
			$usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
			/**Toca cambiarlo ya que el codigo 13 no pertenece al invetario */
			$cuentaDB = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
								->where('codigo','like','13%')->get();
			/**Toca cambiarlo ya que aun no se cuenta con el credito del inventario */
			$cuentaCR = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
								->where('codigo','like','13%')->get(); 
			foreach ($objs as $value) {
				$value->codigo_linea = Lineas::where('id', $value->codigo_linea)->get();
				$value->id_presentacion = Tipo_presentaciones::where('id', $value->id_presentacion)->get();
				$value->id_marca = Marcas::where('id', $value->id_marca)->get();
				$value->id_clasificacion = Clasificaciones::where('id', $value->id_clasificacion)->get();
				$value->usuario_creador = Usuarios::where('id', $value->usuario_creador)->get();
			}
			return view('inventario.referencias', [
				'referencias' => $objs,
				'lineas' => $lineas,
				'presentaciones' => $presentaciones,
				'marcas' => $marcas,
				'clasificaciones' => $clasificaciones,
				'usuarios' => $usuarios,
				'cuentaDB' => $cuentaDB,
				'cuentaCR' => $cuentaCR]);
		}
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function catalogo(){
		try{
			$obj = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
			foreach ($obj as $value) {
				$value->codigo_linea = Lineas::where('id', $value->codigo_linea)->get();
				$value->id_presentacion = Tipo_presentaciones::where('id', $value->id_presentacion)->get();
				$value->id_marca = Marcas::where('id', $value->id_marca)->get();
				$value->id_clasificacion = Clasificaciones::where('id', $value->id_clasificacion)->get();
				$value->usuario_creador = Usuarios::where('id', $value->usuario_creador)->get();
			}
			return view('inventario.catalogo', [
				'referencias' => $obj
			]);
		}
		catch (ModelNotFoundException $exception){
			return  array(
				"result"=>"fail",
				"body"=>$exception);
		}
    }

    public function search(Request $request){
		try{
			$obj = DB::select("SELECT * from referencias where id_empresa = ".Session::get('id_empresa')." AND descripcion like '%".$request->search."%' OR codigo_letras like '%".$request->search."%' OR codigo_barras like '%".$request->search."%'  ");
			//dd($obj);
			return  array(
				"result"=>"success",
				"body"=>$obj);
		}
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
