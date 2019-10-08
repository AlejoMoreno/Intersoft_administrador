<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tipo_presentaciones;


use Session;

class Tipo_presentacionesController extends Controller
{
    //
    public function create(Request $request){
        $obj = new Tipo_presentaciones();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->id_empresa   = Session::get('id_empresa');
        $obj->save();
        return redirect('/inventario/tipo_presentaciones');
    }

    public function update(Request $request){
        $obj = Tipo_presentaciones::where('id',$request->id)->first();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->id_empresa   = Session::get('id_empresa');
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Tipo_presentaciones::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Tipo_presentaciones::find($id);
        $obj->delete();
        return redirect('/inventario/tipo_presentaciones');
    }

    public function all(){
        $obj = Tipo_presentaciones::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Tipo_presentaciones::all();
        return view('inventario.tipo_presentaciones', [
            'tipo_presentaciones' => $objs]);
    }
}
