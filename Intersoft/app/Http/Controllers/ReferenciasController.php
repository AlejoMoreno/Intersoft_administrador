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
use App\Cierreinventarios;

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
			$usuario = Usuarios::where('id','=',Session::get('user_id'))->first();
			$precios = str_replace(',','',$usuario->pension);
			$obj = Referencias::select('referencias.*',DB::raw(' '.$precios.' as precioasignado'))->where('id_empresa','=',Session::get('id_empresa'))
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
			
			$objs = Referencias::select(['lineas.*','tipo_presentaciones.*',
				'usuarios.*',
				'marcas.nombre as marcnombre','referencias.descripcion as refdescripcion',
				'referencias.codigo_interno as refcodigo_interno','referencias.codigo_letras as refcodigo_letras',
				'referencias.peso as refpeso','referencias.precio1 as refprecio1',
				'referencias.precio2 as refprecio2','referencias.precio3 as refprecio3','referencias.precio4 as refprecio4',
				'referencias.costo as refcosto','referencias.costo_promedio as refcosto_promedio','referencias.saldo as refsaldo',
				'referencias.codigo_consecutivo as refcodigo_consecutivo','referencias.codigo_barras as refcodigo_barras','usuarios.id as refusuarios',
				'referencias.descuento as refdescuento','referencias.serie as refserie','usuarios.id as refusuarios',
				'referencias.id as refid','referencias.codigo_interno as refcodigo_interno','referencias.codigo_alterno as refcodigo_alterno',
				'referencias.iva as refiva','referencias.impo_consumo as refimpo_consumo','referencias.sobre_tasa as refsobre_tasa',
				'referencias.hommologo as refhommologo','referencias.stok_minimo as refstok_minimo','referencias.stok_maximo as refstok_maximo','referencias.factor_rendimiento as reffactor_rendimiento',
				'lineas.id as idlineas','tipo_presentaciones.id as idtipopresentaciones','marcas.id as idmarcas','clasificaciones.id as idclasificaciones'])
				->where('referencias.id_empresa','=',Session::get('id_empresa'))
				->join('lineas','lineas.id','=','referencias.codigo_linea')
				->join('tipo_presentaciones','tipo_presentaciones.id','=','referencias.id_presentacion')
				->join('marcas','marcas.id','=','referencias.id_marca')
				->join('clasificaciones','clasificaciones.id','=','referencias.id_clasificacion')
				->join('usuarios','usuarios.id','=','referencias.usuario_creador')
				->where(function ($q) use ($request) {
					if($request->linea > 0){
						$q->where('referencias.codigo_linea','=',$request->linea);
					}
					if($request->tipo_reporte == 'exitencia'){
						$q->where('referencias.saldo','>',0);
					}
				})
				->get();
			
			$lineas = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
			$presentaciones = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
			$marcas = Marcas::where('id_empresa','=',Session::get('id_empresa'))->get();
			$clasificaciones = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
			$usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
			
			return view('inventario.referencias', [
				'referencias' => $objs,
				'lineas' => $lineas,
				'presentaciones' => $presentaciones,
				'marcas' => $marcas,
				'clasificaciones' => $clasificaciones,
				'usuarios' => $usuarios
			]);
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

			$lineas = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
			
			
			return view('inventario.catalogo', [
				'referencias' => $referencias,
				'referenciasmasvendidas'=>$referenciasmasvendidas,
				'referenciasmaspedidos'=>$referenciasmaspedidos,
				'referenciasmenosvendidos'=>$referenciasmenosvendidos,
				'lineas'=>$lineas
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
		where referencias.id_empresa = ".Session::get('id_empresa')."
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
				$sql .= " AND codigo_linea in (".$request->linea.")";
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
				$sql .= " AND codigo_linea in (".$request->linea.")";
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
	
	public function catalogoPrecio($numero, Request $request){
		
		$sql = " WHERE 1=1 ";
		$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";
		
		if($request->linea != '' ){
			$sql .= " AND codigo_linea in (".$request->linea.")";
		}
		if($request->tipo_reporte != ''){
			if($request->tipo_reporte == 'exitencia'){
				$sql .= " AND saldo > 0 ";
			}
		}
		$orden = " ORDER BY codigo_linea,codigo_letras,codigo_consecutivo";

		
		
		if($numero==1){
			$objs = DB::select("
				SELECT 
				codigo_linea,
				codigo_barras,
				descripcion,
				precio1 as precio,
				(SELECT nombre FROM lineas where id = codigo_linea) as linea
				FROM `referencias` 
			".$sql." AND referencias.id_empresa = ".Session::get('id_empresa')." ".$orden);
		}
		else if($numero==2){
			$objs = DB::select("
				SELECT 
				codigo_linea,
				codigo_barras,
				descripcion,
				precio2 as precio,
				(SELECT nombre FROM lineas where id = codigo_linea) as linea
				FROM `referencias` 
			".$sql." AND referencias.id_empresa = ".Session::get('id_empresa')." ".$orden);
		}
		else if($numero==3){
			$objs = DB::select("
				SELECT 
				codigo_linea,
				codigo_barras,
				descripcion,
				precio3 as precio,
				id_empresa
				(SELECT nombre FROM lineas where id = codigo_linea) as linea
				FROM `referencias` 
			".$sql." AND referencias.id_empresa = ".Session::get('id_empresa')." ".$orden);
		}
		
		
		$objs= Collection::make($objs);
		
        
        $data= json_decode( json_encode($objs), true);

        /*$pdf = PDF::loadView('pdfs.pdflistaprecios', compact('data'));
		return $pdf->download('Listaprecios.pdf');*/
		return view('pdfs.pdflistaprecios', [
			'data' => $data,
			'vistalineas'=>explode(',',$request->linea)
		]);
	}
	
	/**
     * FUNCIONES PARA SUBIR ARCHIVO PLANO
    */

    public function subirSaldos(Request $request){
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
            "saldos"=>$lineas
        ]);
    }

    public function saveSaldos(Request $request){

        try{
			
			
			$referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))
				->where('codigo_interno','=',$request->codigo)
                ->get();
            if(sizeof($referencias)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "El producto no existe en la base de datos"
                );
			}

			$referencias[0]->saldo = $request->saldo;
			$referencias[0]->costo = $request->ultimoCosto;
            $referencias[0]->save();

            return array(
                "result" => "Correcto",
                "body" => "El producto fue ACTUALIZADO en su totalidad"
            );
        }
        catch(Exception $exce){
            return array(
                "result" => "Incorrecto",
                "body" => $exce
            );
        }
	}

	public function cierreInventarioStore(Request $request){
		try{
			//recorrer inventario y guardar saldos.
			$referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
			foreach($referencias as $referencia){
				$obj = new Cierreinventarios();
				$obj->id_referencia = $referencia->id;
				$obj->fecha = $request->fecha;
				$obj->saldo = $referencia->saldo;
				$obj->estado = 'ACTIVO';
				$obj->id_empresa = Session::get('id_empresa');
				$obj->save();
			}

			$cierres = Cierreinventarios::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
				->get();
			return view('inventario.cierreinventarios',[
				"cierres"=>$cierres
			]); 
		}
		catch(Exception $exce){
			return array(
				"result" => "Incorrecto",
				"body" => $exce
			);
		}
	}
	
	public function cierreInventario(){
		try{
			$cierres = Cierreinventarios::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
				->get();
			return view('inventario.cierreinventarios',[
				"cierres"=>$cierres
			]); 
		}
		catch(Exception $exce){
			return array(
				"result" => "Incorrecto",
				"body" => $exce
			);
		}
	}
}
