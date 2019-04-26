<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Directorio_tipos;

class Directorio_tiposController extends Controller
{
    public function create(Request $request){
        $directorio_tipos = new Directorio_tipos();
        $directorio_tipos->nombre     = $request->nombre;
        $directorio_tipos->descripcion= $request->descripcion;
        $directorio_tipos->save();
        $directorio_tipos = Directorio_tipos::all();
        return redirect('/administrador/directorio_tipos');
    }

    public function update(Request $request){
        $directorio_tipos = Directorio_tipos::where('id',$request->id)->first();
        $directorio_tipos->nombre         = $request->nombre;
        $directorio_tipos->descripcion    = $request->descripcion;
        $directorio_tipos->save();
        $directorio_tipos = Directorio_tipos::all();
        return view('administrador.directorio_tipos', ['directorio_tipos' => $directorio_tipos]);
    }

    public function showupdate($id){
        $directorio_tipos = Directorio_tipos::find($id);
        return view('administrador.directorio_tipos-update', ['directorio_tipos' => $directorio_tipos]);
    }

    public function showone($id){
        $directorio_tipos = Directorio_tipos::find($id);
        return  array(
            "result"=>"success",
            "body"=>$directorio_tipos);
    }

    public function delete($id){
        $directorio_tipos = Directorio_tipos::find($id);
        $directorio_tipos->delete();
        $directorio_tipos = Directorio_tipos::all();
        return redirect('/administrador/directorio_tipos');
    }

    public function all(){
        $directorio_tipos = Directorio_tipos::all();
        return  array(
            "result"=>"success",
            "body"=>$directorio_tipos);
    }

    public function index(){
        $directorio_tipos = Directorio_tipos::all();
        return view('administrador.directorio_tipos', ['directorio_tipos' => $directorio_tipos]);
    }
}
