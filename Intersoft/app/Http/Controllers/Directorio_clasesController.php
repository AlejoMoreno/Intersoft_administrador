<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Directorio_clases;

class Directorio_clasesController extends Controller
{
    public function create(Request $request){
        $directorio_clases = new Directorio_clases();
        $directorio_clases->nombre     = $request->nombre;
        $directorio_clases->descripcion= $request->descripcion;
        $directorio_clases->save();
        $directorio_clases = Directorio_clases::all();
        return redirect('/administrador/directorio_clases');
    }

    public function update(Request $request){
        $directorio_clases = Directorio_clases::where('id',$request->id)->first();
        $directorio_clases->nombre         = $request->nombre;
        $directorio_clases->descripcion    = $request->descripcion;
        $directorio_clases->save();
        $directorio_clases = Directorio_clases::all();
        return view('administrador.directorio_clases', ['directorio_clases' => $directorio_clases]);
    }

    public function showupdate($id){
        $directorio_clases = Directorio_clases::find($id);
        return view('administrador.directorio_clases-update', ['directorio_clases' => $directorio_clases]);
    }

    public function showone($id){
        $directorio_clases = Directorio_clases::find($id);
        return  array(
            "result"=>"success",
            "body"=>$directorio_clases);
    }

    public function delete($id){
        $directorio_clases = Directorio_clases::find($id);
        $directorio_clases->delete();
        $directorio_clases = Directorio_clases::all();
        return redirect('/administrador/directorio_clases');
    }

    public function all(){
        $directorio_clases = Directorio_clases::all();
        return  array(
            "result"=>"success",
            "body"=>$directorio_clases);
    }

    public function index(){
        $directorio_clases = Directorio_clases::all();
        return view('administrador.directorio_clases', ['directorio_clases' => $directorio_clases]);
    }
}
