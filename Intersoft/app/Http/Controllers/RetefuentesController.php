<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Retefuentes;

class RetefuentesController extends Controller
{
    public function create(Request $request){
        $retefuentes = new Retefuentes();
        $retefuentes->nombre     = $request->nombre;
        $retefuentes->valor      = $request->valor;
        $retefuentes->descripcion= $request->descripcion;
        $retefuentes->save();
        $retefuentes = Retefuentes::all();
        return view('administrador.retefuentes', ['retefuentes' => $retefuentes]);
    }

    public function update(Request $request){
        $retefuentes = Retefuentes::where('id',$request->id)->first();
        $retefuentes->valor         = $request->valor;
        $retefuentes->nombre         = $request->nombre;
        $retefuentes->descripcion    = $request->descripcion;
        $retefuentes->save();
        $retefuentes = Retefuentes::all();
        return view('administrador.retefuentes', ['retefuentes' => $retefuentes]);
    }

    public function showupdate($id){
        $retefuentes = Retefuentes::find($id);
        return view('administrador.retefuentes-update', ['retefuentes' => $retefuentes]);
    }

    public function showone($id){
        $retefuentes = Retefuentes::find($id);
        return  array(
            "result"=>"success",
            "body"=>$retefuentes);
    }

    public function delete($id){
        $retefuentes = Retefuentes::find($id);
        $retefuentes->delete();
        $retefuentes = Retefuentes::all();
        return view('administrador.retefuentes', ['retefuentes' => $retefuentes]);
    }

    public function all(){
        $retefuentes = Retefuentes::all();
        return  array(
            "result"=>"success",
            "body"=>$retefuentes);
    }

    public function index(){
        $retefuentes = Retefuentes::all();
        return view('administrador.retefuentes', ['retefuentes' => $retefuentes]);
    }
}
