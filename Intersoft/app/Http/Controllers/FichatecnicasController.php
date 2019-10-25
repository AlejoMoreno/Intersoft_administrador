<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fichatecnicas;
use App\Referencias;
use Session;
use DB;

class FichatecnicasController extends Controller
{
    //
    public function index(Request $request){
        try{
            if($request->id != null){
                $fichatecnica = Fichatecnicas::where('id_empresa','=',Session::get('id_empresa'))->
                                       where('id','=',$request->id)->first();
                $fichatecnica->delete();
            }
            if($request->agregar == "Agregar"){
                $obj = new Fichatecnicas();
                $obj->id_referencia = $request->id_referencia;
                $obj->id_sucursal   = Session::get('sucursal');
                $obj->id_empresa    = Session::get('id_empresa');
                $obj->nombre        = $request->nombre;
                $obj->orden         = $request->orden;
                $obj->cantidad      = $request->cantidad;
                $obj->estado        = $request->estado;
                $obj->save();   
            }
            if($request->orden == "0"){
                $objs = Fichatecnicas::where('id_empresa','=',Session::get('id_empresa'))->get();
            }
            else{
                $objs = Fichatecnicas::where('id_empresa','=',Session::get('id_empresa'))->
                                       where('orden','=',$request->orden)->get();
            }

            foreach($objs as $obj){
                $obj->id_referencia = Referencias::where('id_empresa','=',Session::get('id_empresa'))->
                                                  where('id','=',$obj->id_referencia)->first();
            }

            //$ficha = DB::select('SELECT nombre,orden From fichatecnicas WHERE id_empresa = '.Session::get('id_empresa').' GROUP BY nombre,orden');
            $ficha = DB::table('fichatecnicas')->select(array('nombre','orden'))->groupBy(array('nombre','orden'))->get();

            $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))
                                      ->where('id_clasificacion','=','2')->get();
            return view('inventario.ordenesproduccion', [
                'fichatecnicas' => $objs,
                'referencias' => $referencias,
                'ficha' => $ficha]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
