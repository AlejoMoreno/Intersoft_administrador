<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Marcas;


class MarcasController extends Controller
{
    public function create(Request $request){
        $obj = new Marcas();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->logo  		= $request->logo;
        $obj->codigo_interno= $request->codigo_interno;
        $obj->codigo_alterno= $request->codigo_alterno;
        $obj->save();
        return redirect('/inventario/marcas');
    }

    public function update(Request $request){
        $obj = Marcas::where('id',$request->id)->first();
        $obj->nombre     	= $request->nombre;
        $obj->descripcion   = $request->descripcion;
        $obj->logo  		= $request->logo;
        $obj->codigo_interno= $request->codigo_interno;
        $obj->codigo_alterno= $request->codigo_alterno;
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Marcas::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Marcas::find($id);
        $obj->delete();
        return redirect('/inventario/marcas');
    }

    public function all(){
        $obj = Marcas::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Marcas::all();
        return view('inventario.marcas', [
            'marcas' => $objs]);
    }
}
