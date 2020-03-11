<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursales;
use App\Usuarios;
use App\Fichatecnicas;
use App\Referencias;
use App\Produccioningresos;

use App\Clasificaciones;

use DB;
use Session;

class ProduccioningresosController extends Controller
{
    public function index(Request $request){
        try{
            $produccioningresos = Produccioningresos::where('id_empresa',Session::get('id_empresa'))->orderBy('orden_produccion',"dsc")->get();
            if(sizeof($produccioningresos)!=0){
                foreach($produccioningresos as $obj){
                    $obj->id_sucursal = Sucursales::where('id',$obj->id_sucursal)->first();
                    $obj->operario = Usuarios::where('id',$obj->operario)->first();
                    $obj->id_ficha_tecnica = Fichatecnicas::where('id',$obj->id_ficha_tecnica)->first();
                    $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->first();
                }
            }
            else{
                $produccioningresos = new Produccioningresos();
            }
            $sucursal = Sucursales::where('id_empresa',Session::get('id_empresa'))->get();
            $operario = Usuarios::where('id_empresa',Session::get('id_empresa'))->get();
            $ficha_tecnica = DB::table('fichatecnicas')
                 ->select('nombre', DB::raw('count(*) as total'))
                 ->where('id_empresa',Session::get('id_empresa'))
                 ->groupBy('nombre')
                 ->get();
                 
            //$ficha_tecnica = Fichatecnicas::where('id_empresa',Session::get('id_empresa'))->get();
            $clasificacion = Clasificaciones::where('id_empresa',Session::get('id_empresa'))->
                                              where('nombre','=','PRODUCTO TERMINADO')->first();
            $referencia = Referencias::where('id_empresa',Session::get('id_empresa'))->
                                       where('id_clasificacion',$clasificacion->id)->get();
            return view('inventario.ordenesdeproduccion',[
                "sucursal"=>$sucursal,
                "operario"=>$operario,
                "ficha_tecnica"=>$ficha_tecnica,
                "referencia"=>$referencia,
                "produccioningresos"=>$produccioningresos
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function createOrden(Request $request){
        try{
            if($request->id != null){ //si llega el ID se debe eliminar
                $produccioningresos = Produccioningresos::where('id_empresa','=',Session::get('id_empresa'))->
                                       where('id','=',$request->id)->first();
                $produccioningresos->delete();
            }
            else if($request->Guardar == "Guardar"){
                if($request->orden_produccion == 0){
                    $ultima = Produccioningresos::where('id_empresa','=',Session::get('id_empresa'))
                                ->orderBy('orden_produccion','DESC')->first();
                    if(count($ultima)==0){
                        $request->orden_produccion = $request->orden_produccion + 1;
                    }
                    else{
                        $request->orden_produccion = $ultima->orden_produccion + 1;
                    }
                }
                //saber el id de la ficha
                $ficha = Fichatecnicas::where('id_empresa',Session::get('id_empresa'))->
                        where('nombre','like',$request->id_ficha_tecnica )->first();
                //guardar a orden
                $obj = new Produccioningresos();
                $obj->id_ficha_tecnica = $ficha->id;
                $obj->id_sucursal = $request->id_sucursal;
                $obj->id_empresa = $request->id_empresa;
                $obj->id_turno = $request->id_turno;
                $obj->orden_produccion = $request->orden_produccion;
                $obj->fecha = $request->fecha;
                $obj->operario = $request->operario;
                $obj->id_referencia = $request->id_referencia;
                $obj->lote = $request->lote;
                $obj->etapa = $request->etapa;
                $obj->unidades = $request->unidades;
                $obj->save(); 
            }
            //para la vista
            return redirect('/inventario/ordenesdeproduccion');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    function ingresoporproduccion(){
        $produccioningresos_1 = DB::table('produccioningresos')
                 ->select('orden_produccion', DB::raw('count(*) as total'))
                 ->where('id_empresa',Session::get('id_empresa'))
                 ->groupBy('orden_produccion')
                 ->get();
        
        $produccioningresos = Produccioningresos::where('id_empresa',Session::get('id_empresa'))
                ->where('etapa','!=','11')
                ->orderBy('orden_produccion','DESC')
                ->get();
        return view('/inventario/ingresoporproduccion',[
            "produccioningresos"=>$produccioningresos,
            "produccioningresos1"=>$produccioningresos_1
        ]);
    }
}
