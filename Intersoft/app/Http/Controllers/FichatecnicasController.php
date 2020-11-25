<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fichatecnicas;
use App\Referencias;
use Session;
use DB;

use PDF;

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
                if($request->orden == 0){
                    $ultima = Fichatecnicas::where('id_empresa','=',Session::get('id_empresa'))
                                ->orderBy('orden','DESC')->first();
                    if(count($ultima)==0){
                        $request->orden = $request->orden + 1;
                    }
                    else{
                        $request->orden = $ultima->orden + 1;
                    }
                }
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
            $ficha = DB::table('fichatecnicas')->select(array('nombre','orden','id_empresa'))->
                        where('id_empresa','=',Session::get('id_empresa'))->orderBy('orden','ASC')->groupBy(array('nombre','orden','id_empresa'))->get();

            $referencias = Referencias::select(['referencias.*','clasificaciones.nombre'])
                        ->where('referencias.id_empresa','=',Session::get('id_empresa'))
                        ->join('clasificaciones','referencias.id_clasificacion','=','clasificaciones.id')
                        ->where('clasificaciones.nombre','=','MATERIA PRIMA')->get();
            return view('inventario.fichatecnica', [
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

    public function ordenesdeproduccion(){
        $fichatecnica = Fichatecnicas::select(['orden','nombre','id_empresa'])->where('id_empresa','=',Session::get('id_empresa'))
            ->groupBy(['orden','nombre','id_empresa'])->get();
        return view('inventario.ordenesdeproduccion', [
            'fichatecnicas' => $fichatecnica
        ]);
    }

    public function pdf(Request $request){
        $objs = Fichatecnicas::where('id_empresa','=',Session::get('id_empresa'))->
                               where('orden','=',$request->orden)->get();
        foreach($objs as $obj){
            $obj->id_referencia = Referencias::where('id_empresa','=',Session::get('id_empresa'))->
                                                where('id','=',$obj->id_referencia)->first();
        }
        $pdf = PDF::loadView('pdfs.fichatecnica', compact('objs'));
        return $pdf->download('fichatecnica.pdf');
    }
}
