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

use DB;

use Session;

class ReferenciasController extends Controller
{
    //
    public function create(Request $request){
    	$cont = Referencias::where('codigo_linea','=',$request->codigo_linea)->
    						 where('codigo_letras','=',substr($request->descripcion,0,3))->get();
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
		$obj->cuentaDB 			= $request->cuentaDB;
		$obj->cuentaCR 			= $request->cuentaCR;
		$obj->id_empresa	 	= Session::get('id_empresa');
        $obj->save();
        return redirect('/inventario/referencias');
    }

    public function update(Request $request){
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
		$obj->cuentaDB 			= $request->cuentaDB;
		$obj->cuentaCR 			= $request->cuentaCR;
		$obj->id_empresa	 	= Session::get('id_empresa');
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Referencias::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Referencias::find($id);
        $obj->delete();
        return redirect('/inventario/referencias');
    }

    public function all(){
        $obj = Referencias::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Referencias::all();
        $lineas = Lineas::all();
		$presentaciones = Tipo_presentaciones::all();
		$marcas = Marcas::all();
		$clasificaciones = Clasificaciones::all();
		$usuarios = Usuarios::all();
		$cuentaDB = Cuentas::where('clase','=','1')->where('grupo','=','4')->get();
		$cuentaCR = Cuentas::where('clase','=','1')->where('grupo','=','4')->get();//cambiar por la otra cuenta 
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

    public function catalogo(){
    	$obj = Referencias::all();
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

    public function search(Request $request){
    	$obj = DB::select("SELECT * from referencias where descripcion like '%".$request->search."%' OR codigo_letras like '%".$request->search."%' OR codigo_barras like '%".$request->search."%'  ");
    	//dd($obj);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }
}
