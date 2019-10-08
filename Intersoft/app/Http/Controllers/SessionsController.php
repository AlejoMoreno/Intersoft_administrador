<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SessionsController extends Controller
{
    static function storeSession($session,$usuario,$sucursal){
    	Session::put('user_id',$session->user_id);
		Session::put('ip',$session->ip);
		Session::put('user_agent',$session->user_agent);
		Session::put('last_activity',$session->last_activity);
		Session::put('ncedula',$usuario->ncedula);
		Session::put('nombre',$usuario->nombre . ' ' . $usuario->apellido);
		Session::put('cargo',$usuario->cargo);
		Session::put('id_empresa',$usuario->id_empresa);
		Session::put('estado',$usuario->estado);
		Session::put('sucursal',$sucursal->id);
		Session::put('sucursalNombre',$sucursal->nombre);
    }

    static function deleteSession(){
    	Session::forget('user_id',"");
		Session::forget('ip',"");
		Session::forget('user_agent',"");
		Session::forget('last_activity',"");
		Session::forget('ncedula',"");
		Session::forget('nombre',"");
		Session::forget('cargo',"");
		Session::forget('estado',"");
		Session::forget('id_empresa',"");
		Session::forget('sucursal',"");
		Session::forget('sucursalNombre',"");
    }


}
