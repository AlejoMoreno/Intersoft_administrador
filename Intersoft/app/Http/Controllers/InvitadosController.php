<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invitados;
use App\Calendarios;
use App\Directorios;

class InvitadosController extends Controller
{
    //['correo','nombre','id_calendario','id_directorio']

    public function create(Request $request){
        $invitados = new Invitados();
        $invitados->correo       = $request->correo;
        $invitados->nombre = $request->nombre;
        $invitados->id_calendario  = $request->id_calendario;
        $invitados->id_directorio  = $request->id_directorio;
        $invitados->save();
        $calendarios = Calendarios::all();
        return view('calendarios', ['calendarios' => $calendarios]);
    }

    public function update(Request $request){
        $invitados = new Invitados();
        $invitados->correo       = $request->correo;
        $invitados->nombre = $request->nombre;
        $invitados->id_calendario  = $request->id_calendario;
        $invitados->id_directorio  = $request->id_directorio;
        $invitados->save();
        $invitados = Invitados::all();
        return view('invitados', ['invitados' => $invitados]);
    }

    public function showupdate($id){
        $invitados = Invitados::find($id);
        return view('invitados-update', ['invitados' => $invitados]);
    }

    public function showone($id){
        $invitados = Invitados::find($id);
        return  array(
            "result"=>"success",
            "body"=>$invitados);
    }

    public function delete($id){
        $invitados = Invitados::find($id);
        $invitados->delete();
        $invitados = Invitados::all();
        return view('invitados', ['invitados' => $invitados]);
    }

    public function all(){
        $invitados = Invitados::all();
        return  array(
            "result"=>"success",
            "body"=>$invitados);
    }

    public function index(){
        $invitados = Invitados::all();
        foreach($invitados as $invitado){
            $invitado->id_calendario = Calendarios::find($invitado->id_calendario);
            $invitado->id_directorio = Directorios::find($invitado->id_directorio);
        }
        return view('invitados', ['invitados' => $invitados]);
    }

    public function formcreate($id){
        $calendario = Calendarios::find($id);
        return view('invitadosform', ['calendario' => $calendario]);
    }
}
