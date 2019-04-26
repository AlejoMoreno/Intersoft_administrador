<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clasificaciones;

class ClasificacionesController extends Controller
{
    //
    public function create(Request $request){
        $obj = new Clasificaciones();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->codigo_interno= $request->codigo_interno;
        $obj->save();
        return redirect('/inventario/clasificaciones');
    }

    public function update(Request $request){
        $obj = Clasificaciones::where('id',$request->id)->first();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion  	= $request->descripcion;
        $obj->codigo_interno= $request->codigo_interno;
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Clasificaciones::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Clasificaciones::find($id);
        $obj->delete();
        return redirect('/inventario/clasificaciones');
    }

    public function all(){
        $obj = Clasificaciones::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Clasificaciones::all();
        return view('inventario.clasificaciones', [
            'clasificaciones' => $objs]);
    }
}
