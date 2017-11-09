<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contrato_laborals;

class Contrato_laboralController extends Controller
{
    public function create(Request $request){
        $contrato_laborales = new Contrato_laborals();
        $contrato_laborales->tipo_contrato  = $request->tipo_contrato;
        $contrato_laborales->descripcion    = $request->descripcion;
        $contrato_laborales->consecutivo    = $request->consecutivo;
        $contrato_laborales->fecha_inicial  = $request->fecha_inicial;
        $contrato_laborales->fecha_final    = $request->fecha_final;
        $contrato_laborales->save();
        //retornar las contrato_laborales
        $contrato_laborales = Contrato_laborals::all();
        return view('administrador.contratos', ['contrato_laborales' => $contrato_laborales]);
    }

    public function update(Request $request){
        $contrato_laborales = Contrato_laborals::where('id',$request->id)->first();
        $contrato_laborales->tipo_contrato  = $request->tipo_contrato;
        $contrato_laborales->descripcion    = $request->descripcion;
        $contrato_laborales->consecutivo    = $request->consecutivo;
        $contrato_laborales->fecha_inicial  = $request->fecha_inicial;
        $contrato_laborales->fecha_final    = $request->fecha_final;
        $contrato_laborales->save();
        //retornar las contrato_laborales
        $contrato_laborales = Contrato_laborals::all();
        return view('administrador.contratos', ['contrato_laborales' => $contrato_laborales]);
    }

    public function showupdate($id){
        $contrato_laborales = Contrato_laborals::find($id);
        return view('administrador.contratos-update', ['contrato_laborales' => $contrato_laborales]);
    }

    public function delete($id){
        $contrato_laborales = Contrato_laborals::where('id',$id)->first();
        $contrato_laborales->delete();
         //retornar las contrato_laborales
         $contrato_laborales = Contrato_laborals::all();
         return view('administrador.contratos', ['contrato_laborales' => $contrato_laborales]);
    }

    public function all(){
        $contrato_laborales = Contrato_laborals::all();    
        return  array(
            "result"=>"success",
            "body"=>$contrato_laborales);
    }

    public function index(){
        $contrato_laborales = Contrato_laborals::all();
        return view('administrador.contratos', ['contrato_laborales' => $contrato_laborales]);
    }

}
