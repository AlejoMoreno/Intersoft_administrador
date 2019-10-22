<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lineas;

use Session;

class LineasController extends Controller
{
    //
    public function create(Request $request){
        try{
            $obj = new Lineas();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->codigo_interno= $request->codigo_interno;
            $obj->codigo_alterno= $request->codigo_alterno;
            $obj->id_empresa    = Session::get('id_empresa');
            $obj->save();
            return redirect('/inventario/lineas');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Lineas::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->codigo_interno= $request->codigo_interno;
            $obj->codigo_alterno= $request->codigo_alterno;
            $obj->id_empresa    = Session::get('id_empresa');
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
            $obj = Lineas::where('id_empresa','=',Session::get('id_empresa'))
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
            $obj = Lineas::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/inventario/lineas');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
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
            $objs = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('inventario.lineas', [
                'lineas' => $objs]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
