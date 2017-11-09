<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ciudades;
use App\Departamentos;

class CiudadesController extends Controller
{
    public function create(Request $request){
        $ciudad = new Ciudades();
        $ciudad->codigo         = $request->codigo;
        $ciudad->nombre         = $request->nombre;
        $ciudad->id_departamento= $request->id_departamento;
        $ciudad->save();
        //retornar las ciudades
        $ciudades = Ciudades::all();
        foreach ($ciudades as $ciudad){
            $id_departamento = Departamentos::where('id', $ciudad->id_departamento)->first();
            $ciudad->id_departamento = $id_departamento;
        }
        return view('administrador.ciudades', ['ciudades' => $ciudades]);
    }

    public function update(Request $request){
        $ciudad = Ciudades::where('id',$request->id)->first();
        $ciudad->codigo         = $request->codigo;
        $ciudad->nombre         = $request->nombre;
        $ciudad->id_departamento= $request->id_departamento;
        $ciudad->save();
        //retornar las cudades
        $ciudades = Ciudades::all();
        foreach ($ciudades as $ciudad){
            $id_departamento = Departamentos::where('id', $ciudad->id_departamento)->first();
            $ciudad->id_departamento = $id_departamento;
        }
        return view('administrador.ciudades', ['ciudades' => $ciudades]);
    }

    public function showupdate($id){
        $ciudad = Ciudades::find($id);
        return view('administrador.ciudades-update', ['ciudad' => $ciudad]);
    }

    public function delete($id){
        $ciudad = Ciudades::where('id',$id)->first();
        $ciudad->delete();
        //retornar las ciudades
        $ciudades = Ciudades::all();
        foreach ($ciudades as $ciudad){
            $id_departamento = Departamentos::where('id', $ciudad->id_departamento)->first();
            $ciudad->id_departamento = $id_departamento;
        }
        return view('administrador.ciudades', ['ciudades' => $ciudades]);
    }

    public function all(){
        $ciudades = Ciudades::all();
        foreach ($ciudades as $ciudad) {
            $id_departamento = Departamentos::where('id',$ciudad->id_departamento)->first();
            $ciudad->id_departamento = $id_departamento;
        }        
        return  array(
            "result"=>"success",
            "body"=>$ciudades);
    }

    public function index(){
        $ciudades = Ciudades::all();
        foreach ($ciudades as $ciudad){
            $id_departamento = Departamentos::where('id', $ciudad->id_departamento)->first();
            $ciudad->id_departamento = $id_departamento;
        }
        return view('administrador.ciudades', ['ciudades' => $ciudades]);
    }

    public function departamento($id){
        $ciudades = Ciudades::where('id_departamento', $id)->first();
        foreach ($ciudades as $ciudad){
            $id_departamento = Departamentos::where('id', $ciudad->id_departamento)->first();
            $ciudad->id_departamento = $id_departamento;
        }
        return  array(
            "result"=>"success",
            "body"=>$ciudades);
    }
}
