<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;

use App\Referencias;

use App\Lineas;
use App\Lotes;
use App\Tipo_presentaciones;
use App\Marcas;
use App\Clasificaciones;
use App\Usuarios;
use App\Cuentas;
use App\Pucauxiliar;
use App\Kardex;

use Yajra\Datatables\Datatables;

use DB;
use Excel;
use PDF;

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
			
			$linea = Lineas::where('id','=',$obj->codigo_linea)->first();							
			$lote = $lote = Lotes::where('id_referencia','=',$obj->id)->orderBy('fecha_vence_lote','desc')->get();
			return  array(
				"result"=>"success",
				"body"=>$obj,
				"lote"=>$lote,
				"linea"=>$linea);
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

    public function index(Request $request){
		try{
			$sql = " WHERE 1=1 ";
			$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
			if($request->linea != '' ){
				if($request->linea !=0){
					$sql .= " AND codigo_linea = ".$request->linea."";
				}
			}
			if($request->tipo_reporte != ''){
				if($request->tipo_reporte == 'exitencia'){
					$sql .= " AND saldo > 0 ";
				}
			}
			if($request->orden != ''){
				if($request->orden == "codigo"){
					$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
				}
				else{
					$orden = " ORDER BY ".$request->orden;
				}
			}
			$objs = DB::select("SELECT * FROM referencias ".$sql." AND id_empresa = ".Session::get('id_empresa')." ".$orden);
			$objs= Collection::make($objs);
			
			//$objs = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
			
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
			$referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))
					->orderBy('saldo','desc')
					->get();


			$referenciasmasvendidas = Kardex::select('id_referencia',
				'id_referencia',DB::raw('sum(cantidad) as total'))
					->where('id_empresa','=',Session::get('id_empresa'))
					->where('signo','=','-')
					->groupBy('id_referencia','signo')
					->orderBy('total','desc')
					->take(12)
					->get();
			
			$referenciasmaspedidos = Kardex::select('id_referencia',
				'id_referencia',DB::raw('sum(cantidad) as total'))
					->where('id_empresa','=',Session::get('id_empresa'))
					->where('signo','=','=')
					->groupBy('id_referencia','signo')
					->orderBy('total','asc')
					->take(12)
					->get();
			
			$referenciasmenosvendidos = Kardex::select('id_referencia',
				'id_referencia',DB::raw('sum(cantidad) as total'))
					->where('id_empresa','=',Session::get('id_empresa'))
					->where('signo','=','-')
					->groupBy('id_referencia','signo')
					->orderBy('total','desc')
					->take(12)
					->get();
			foreach($referenciasmenosvendidos as $obj){
				$obj->id_referencia = Referencias::where('id','=',$obj->id_referencia)->first();
			}
			foreach($referenciasmasvendidas as $obj){
				$obj->id_referencia = Referencias::where('id','=',$obj->id_referencia)->first();
			}
			foreach($referenciasmaspedidos as $obj){
				$obj->id_referencia = Referencias::where('id','=',$obj->id_referencia)->first();
			}
			
			return view('inventario.catalogo', [
				'referencias' => $referencias,
				'referenciasmasvendidas'=>$referenciasmasvendidas,
				'referenciasmaspedidos'=>$referenciasmaspedidos,
				'referenciasmenosvendidos'=>$referenciasmenosvendidos
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
	
	public function materiaprima(){
		try{
			$clasificacion = Clasificaciones::where('nombre','=','MATERIA PRIMA')->
											where('id_empresa','=',Session::get('id_empresa'))->first();
			$obj = Referencias::where('id_empresa','=',Session::get('id_empresa'))->
							    where('id_clasificacion','=',$clasificacion->id)->get();
			foreach ($obj as $value) {
				$value->codigo_linea = Lineas::where('id', $value->codigo_linea)->first();
				$value->id_presentacion = Tipo_presentaciones::where('id', $value->id_presentacion)->first();
				$value->id_marca = Marcas::where('id', $value->id_marca)->first();
				$value->id_clasificacion = Clasificaciones::where('id', $value->id_clasificacion)->first();
				$value->usuario_creador = Usuarios::where('id', $value->usuario_creador)->first();
			}
			return view('inventario.materiaprima', [
				'referencias' => $obj
			]);
		}
		catch (ModelNotFoundException $exception){
			return  array(
				"result"=>"fail",
				"body"=>$exception);
		}
	}

	/**
	 * GET
	 */

	public function updatePrecios($id,$precio1,$precio2,$precio3){
		$obj = Referencias::where('id',$id)->first();
		$obj->precio1 			= $precio1;
		$obj->precio2 			= $precio2;
		$obj->precio3 			= $precio3;
		$obj->update();
		return redirect('inventario/actualizacionPrecios');
	}
	public function actualizacionPrecios(Request $request){

		$lineas = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
		$marcas = Marcas::where('id_empresa','=',Session::get('id_empresa'))->get();
		$clasificacion = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();

		$sql = "";
		if($request->buscar == "Buscar"){
			if($request->codigo_linea != "0"){ $sql .= " AND referencias.codigo_linea = ".$request->codigo_linea;}
			if($request->descripcion != ""){ $sql .= " AND referencias.descripcion like '%".$request->descripcion."%'";}
			if($request->id_clasificacion != "0"){ $sql .= " AND referencias.id_clasificacion = ".$request->id_clasificacion;}
			if($request->id_marca != "0"){ $sql .= " AND referencias.id_marca = ".$request->id_marca;}
			if($request->estado != "0"){ $sql .= " AND referencias.estado = ".$request->estado;}
			if($request->saldo != ""){ $sql .= " AND referencias.saldo > ".$request->saldo;}
		}
		
		$objs = DB::select("
		select 
			referencias.id,
			concat(referencias.codigo_linea,referencias.codigo_letras,referencias.codigo_consecutivo) as codigo, 
			referencias.descripcion, 
			marcas.nombre, 
			referencias.precio1, 
			referencias.precio2, 
			referencias.precio3, 
			referencias.precio4, 
			referencias.estado, 
			referencias.costo, 
			referencias.saldo 
		from referencias 
		INNER JOIN marcas ON marcas.id = referencias.id_marca 
		where 1=1 
			".$sql." 
		order by referencias.descripcion");
		$objs= Collection::make($objs);
			
        
        $data= json_decode( json_encode($objs), true);
		return view('inventario.actualizacionPrecios', [
			'referencias' => $data,
			'lineas' => $lineas,
			'marcas' => $marcas,
			'clasificacion' => $clasificacion
		]);
	}

	/**
	 * POST
	 */
	public function actualizarPrecios(){

	}
	

	/**
     * Excel Reporte
     */
    public function excelreferencias1(Request $request){
        
        $sql = " WHERE 1=1 ";
		$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
		if($request->linea != '' ){
			if($request->linea !=0){
				$sql .= " AND codigo_linea = ".$request->linea."";
			}
		}
		if($request->tipo_reporte != ''){
			if($request->tipo_reporte == 'exitencia'){
				$sql .= " AND saldo > 0 ";
			}
		}
		if($request->orden != ''){
			if($request->orden == "codigo"){
				$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
			}
			else{
				$orden = " ORDER BY ".$request->orden;
			}
		}
		$objs = DB::select("
			SELECT 
			concat(referencias.codigo_linea, referencias.codigo_letras, referencias.codigo_consecutivo) as codigo,
			referencias.descripcion,
			'' as conteo,
			referencias.saldo,
			'' as sobra,
			'' as falta,
			referencias.costo,
			lineas.nombre,
			tipo_presentaciones.nombre,
			marcas.nombre,
			referencias.codigo_barras,
			referencias.stok_minimo,
			referencias.stok_maximo,
			referencias.iva,
			referencias.impo_consumo,
			referencias.sobre_tasa,
			referencias.serie,
			referencias.descuento,
			referencias.peso,
			referencias.precio1,
			referencias.precio2,
			referencias.precio3,
			referencias.precio4,
			usuarios.ncedula,
			referencias.id_empresa
			FROM `referencias` 
			INNER JOIN lineas ON referencias.codigo_linea = lineas.id
			INNER JOIN tipo_presentaciones ON referencias.id_presentacion = tipo_presentaciones.id
			INNER JOIN marcas ON referencias.id_marca = marcas.id
			INNER JOIN usuarios ON referencias.usuario_creador = usuarios.id
		".$sql." AND referencias.id_empresa = ".Session::get('id_empresa')." ".$orden);
		$objs= Collection::make($objs);
			
        
        $data= json_decode( json_encode($objs), true);

        Excel::create('Comprobantes Diarios', function($excel) use($data) {
            $excel->sheet('Contabilidad', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');
    }

    /**
     * PDF reportes
     */
    public function pdfreferencias1(Request $request){
		
		$sql = " WHERE 1=1 ";
		$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
		if($request->linea != '' ){
			if($request->linea !=0){
				$sql .= " AND codigo_linea = ".$request->linea."";
			}
		}
		if($request->tipo_reporte != ''){
			if($request->tipo_reporte == 'exitencia'){
				$sql .= " AND saldo > 0 ";
			}
		}
		if($request->orden != ''){
			if($request->orden == "codigo"){
				$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
			}
			else{
				$orden = " ORDER BY ".$request->orden;
			}
		}
		$objs = DB::select("
			SELECT 
			concat(referencias.codigo_linea, referencias.codigo_letras, referencias.codigo_consecutivo) as codigo,
			referencias.descripcion,
			'' as conteo,
			referencias.saldo,
			'' as sobra,
			'' as falta,
			referencias.costo,
			referencias.id_empresa
			FROM `referencias` 
		".$sql." AND referencias.id_empresa = ".Session::get('id_empresa')." ".$orden);
		$objs= Collection::make($objs);
		
        
        $data= json_decode( json_encode($objs), true);

        $pdf = PDF::loadView('pdfs.pdfreferencias1', compact('data'));
        return $pdf->download('Referencias.pdf');
    }
}
