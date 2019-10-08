<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendarios;

class CalendariosController extends Controller
{
    public function create(Request $request){
        $calendarios = new Calendarios();
        $calendarios->titulo       = $request->titulo;
        $calendarios->fecha_inicio = $request->fecha_inicio;
        $calendarios->hora_inicio  = $request->hora_inicio;
        $calendarios->fecha_final  = $request->fecha_final;
        $calendarios->hora_final   = $request->hora_final;
        $calendarios->lugar        = $request->lugar;
        $calendarios->descripcion  = $request->descripcion;
        $calendarios->color        = $request->color;
        $calendarios->notificacion = $request->notificacion;
        $calendarios->valor        = $request->valor;
        $calendarios->periodicidad = $request->periodicidad;
        $calendarios->id_empresa	 	= Session::get('id_empresa');
        $calendarios->save();
        $calendario = Calendarios::find($calendarios->id);
        return view('invitadosform', ['calendario' => $calendario]);
    }

    public function update(Request $request){
        $calendarios = new Calendarios();
        $calendarios->titulo       = $request->titulo;
        $calendarios->fecha_inicio = $request->fecha_inicio;
        $calendarios->hora_inicio  = $request->hora_inicio;
        $calendarios->fecha_final  = $request->fecha_final;
        $calendarios->hora_final   = $request->hora_final;
        $calendarios->lugar        = $request->lugar;
        $calendarios->descripcion  = $request->descripcion;
        $calendarios->color        = $request->color;
        $calendarios->notificacion = $request->notificacion;
        $calendarios->valor        = $request->valor;
        $calendarios->periodicidad = $request->periodicidad;
        $calendarios->id_empresa	 	= Session::get('id_empresa');
        $calendarios->save();
        $calendarios = Calendarios::all();
        return view('calendarios', ['calendarios' => $calendarios]);
    }

    public function showupdate($id){
        $calendarios = Calendarios::find($id);
        return view('calendarios-update', ['calendarios' => $calendarios]);
    }

    public function showone($id){
        $calendarios = Calendarios::find($id);
        return  array(
            "result"=>"success",
            "body"=>$calendarios);
    }

    public function delete($id){
        $calendarios = Calendarios::find($id);
        $calendarios->delete();
        $calendarios = Calendarios::all();
        return view('calendarios', ['calendarios' => $calendarios]);
    }

    public function all(){
        $calendarios = Calendarios::all();
        return  array(
            "result"=>"success",
            "body"=>$calendarios);
    }

    public function index(){
        $calendarios = Calendarios::all();
        return view('calendarios', ['calendarios' => $calendarios]);
    }
}
