<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tipo_presentaciones;


use Session;

class Tipo_presentacionesController extends Controller
{
    //
    public function create(Request $request){
        try{
            $obj = new Tipo_presentaciones();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->id_empresa   = Session::get('id_empresa');
            $obj->save();
            return redirect('/inventario/tipo_presentaciones');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Tipo_presentaciones::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->id_empresa   = Session::get('id_empresa');
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
            $obj = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))
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
            $obj = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))
                                      ->where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/inventario/tipo_presentaciones');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
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
            $objs = Tipo_presentaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('inventario.tipo_presentaciones', [
                'tipo_presentaciones' => $objs]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
