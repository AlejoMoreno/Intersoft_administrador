<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Marcas;

use Session;

class MarcasController extends Controller
{
    public function create(Request $request){
        try{
            $obj = new Marcas();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->logo  		= $request->logo;
            $obj->codigo_interno= $request->codigo_interno;
            $obj->codigo_alterno= $request->codigo_alterno;
            $obj->id_empresa    = Session::get('id_empresa');
            $obj->save();
            return redirect('/inventario/marcas');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Marcas::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->descripcion   = $request->descripcion;
            $obj->logo  		= $request->logo;
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
            $obj = Marcas::where('id_empresa','=',Session::get('id_empresa'))
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
            $obj = Marcas::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/inventario/marcas');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Marcas::where('id_empresa','=',Session::get('id_empresa'))->get();
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
            $objs = Marcas::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('inventario.marcas', [
                'marcas' => $objs]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
