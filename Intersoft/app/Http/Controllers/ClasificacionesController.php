<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clasificaciones;
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
            $obj->codigo_interno= $request->codigo_interno;
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
            $objs = Clasificaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('inventario.clasificaciones', [
                'clasificaciones' => $objs]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
