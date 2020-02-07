<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamentos;

class DepartamentosController extends Controller
{
    public function create(Request $request){
        $departamento = new Departamentos();
        $departamento->codigo         = $request->codigo;
        $departamento->nombre         = $request->nombre;
        $departamento->save();
        $departamento = Departamentos::all();
        return view('administrador.departamentos', ['departamentos' => $departamento]);
    }

    public function update(Request $request){
        $departamento = Departamentos::where('id',$request->id)->first();
        $departamento->codigo         = $request->codigo;
        $departamento->nombre         = $request->nombre;
        $departamento->save();
        $departamento = Departamentos::all();
        return view('administrador.departamentos', ['departamentos' => $departamento]);
    }

    public function showupdate($id){
        $departamento = Departamentos::find($id);
        return view('administrador.departamentos-update', ['departamento' => $departamento]);
    }

    public function showone($id){
        $departamento = Departamentos::find($id);
        return  array(
            "result"=>"success",
            "body"=>$departamento);
    }

    public function delete($id){
        $departamento = Departamentos::find($id);
        $departamento->delete();
        $departamento = Departamentos::all();
        return view('administrador.departamentos', ['departamentos' => $departamento]);
    }

    public function all(){
        $departamento = Departamentos::all();
        return  array(
            "result"=>"success",
            "body"=>$departamento);
    }

    public function index(){
        $departamento = Departamentos::paginate(10);
        return view('administrador.departamentos', ['departamentos' => $departamento]);
    }
}
