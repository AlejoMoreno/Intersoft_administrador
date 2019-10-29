<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clasificaciones;
use App\Pucauxiliar;
use Session;

class ClasificacionesController extends Controller
{
    //
    public function create(Request $request){
        try{
            $obj = new Clasificaciones();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->codigo_interno= $request->codigo_interno;
            $obj->id_empresa    = Session::get('id_empresa');
            $obj->save();
            return redirect('/inventario/clasificaciones');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Clasificaciones::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion  	= $request->descripcion;
            $obj->cuenta_contable= $request->cuenta_contable;
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
            $obj = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))
                                  ->where('id','=',$id)->fisrt();
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
            $obj = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))
                                  ->where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/inventario/clasificaciones');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
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
            $pucauxiliares = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                                        ->where('codigo','like','14%')->get();
            $objs = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('inventario.clasificaciones', [
                'clasificaciones' => $objs,
                'pucauxiliares' => $pucauxiliares]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
