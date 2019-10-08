<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lineas;

use Session;

class LineasController extends Controller
{
    //
    public function create(Request $request){
        $obj = new Lineas();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->codigo_interno= $request->codigo_interno;
        $obj->codigo_alterno= $request->codigo_alterno;
        $obj->id_empresa    = Session::get('id_empresa');
        $obj->save();
        return redirect('/inventario/lineas');
    }

    public function update(Request $request){
        $obj = Lineas::where('id',$request->id)->first();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->codigo_interno= $request->codigo_interno;
        $obj->codigo_alterno= $request->codigo_alterno;
        $obj->id_empresa    = Session::get('id_empresa');
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Lineas::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Lineas::find($id);
        $obj->delete();
        return redirect('/inventario/lineas');
    }

    public function all(){
        $obj = Lineas::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Lineas::all();
        return view('inventario.lineas', [
            'lineas' => $objs]);
    }
}
