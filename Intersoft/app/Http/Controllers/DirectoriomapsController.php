<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Directoriomaps;

class DirectoriomapsController extends Controller
{
    function save(Request $request){
        $map = Directoriomaps::where('id_cliente','=',$request->id)->get();
        if(sizeof($map) == 0){
            $obj = new Directoriomaps();
            $obj->id_cliente = $request->id;
            $obj->direccion = $request->direccion;
            $obj->longitud = $request->longitud;
            $obj->latitud = $request->latitud;
            $obj->accuracy = $request->accuracy;
            $obj->save();
        }
        else{
            $obj = $map[0];
            $obj->longitud = $request->longitud;
            $obj->latitud = $request->latitud;
            $obj->accuracy = $request->accuracy;
            $obj->save();
        }

        
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    function index(){
        return view('gps.directoriomaps');
    }
}
