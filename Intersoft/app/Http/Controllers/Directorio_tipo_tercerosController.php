<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Directorio_tipo_terceros;

class Directorio_tipo_tercerosController extends Controller
{
    public function create(Request $request){
        $directorio_tipo_terceros = new Directorio_tipo_terceros();
        $directorio_tipo_terceros->nombre     = $request->nombre;
        $directorio_tipo_terceros->descripcion= $request->descripcion;
        $directorio_tipo_terceros->save();
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return redirect('/administrador/directorio_tipo_terceros');
    }

    public function update(Request $request){
        $directorio_tipo_terceros = Directorio_tipo_terceros::where('id',$request->id)->first();
        $directorio_tipo_terceros->nombre         = $request->nombre;
        $directorio_tipo_terceros->descripcion    = $request->descripcion;
        $directorio_tipo_terceros->save();
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return view('administrador.directorio_tipo_terceros', ['directorio_tipo_terceros' => $directorio_tipo_terceros]);
    }

    public function showupdate($id){
        $directorio_tipo_terceros = Directorio_tipo_terceros::find($id);
        return view('administrador.directorio_tipo_terceros-update', ['directorio_tipo_terceros' => $directorio_tipo_terceros]);
    }

    public function showone($id){
        $directorio_tipo_terceros = Directorio_tipo_terceros::find($id);
        return  array(
            "result"=>"success",
            "body"=>$directorio_tipo_terceros);
    }

    public function delete($id){
        $directorio_tipo_terceros = Directorio_tipo_terceros::find($id);
        $directorio_tipo_terceros->delete();
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return redirect('/administrador/directorio_tipo_terceros');
    }

    public function all(){
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return  array(
            "result"=>"success",
            "body"=>$directorio_tipo_terceros);
    }

    public function index(){
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return view('administrador.directorio_tipo_terceros', ['directorio_tipo_terceros' => $directorio_tipo_terceros]);
    }
}
