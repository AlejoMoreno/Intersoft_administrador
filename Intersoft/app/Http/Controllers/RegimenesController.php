<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regimenes;

class RegimenesController extends Controller
{
    public function create(Request $request){
        $regimenes = new Regimenes();
        $regimenes->nombre     = $request->nombre;
        $regimenes->descripcion= $request->descripcion;
        $regimenes->save();
        $regimenes = Regimenes::all();
        return redirect('/administrador/regimenes');
    }

    public function update(Request $request){
        $regimenes = Regimenes::where('id',$request->id)->first();
        $regimenes->nombre         = $request->nombre;
        $regimenes->descripcion    = $request->descripcion;
        $regimenes->save();
        $regimenes = Regimenes::all();
        return view('administrador.regimenes', ['regimenes' => $regimenes]);
    }

    public function showupdate($id){
        $regimenes = Regimenes::find($id);
        return view('administrador.regimenes-update', ['regimenes' => $regimenes]);
    }

    public function showone($id){
        $regimenes = Regimenes::find($id);
        return  array(
            "result"=>"success",
            "body"=>$regimenes);
    }

    public function delete($id){
        $regimenes = Regimenes::find($id);
        $regimenes->delete();
        $regimenes = Regimenes::all();
        return redirect('/administrador/regimenes');
    }

    public function all(){
        $regimenes = Regimenes::all();
        return  array(
            "result"=>"success",
            "body"=>$regimenes);
    }

    public function index(){
        $regimenes = Regimenes::all();
        return view('administrador.regimenes', ['regimenes' => $regimenes]);
    }
}
