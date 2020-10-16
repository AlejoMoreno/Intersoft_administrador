<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trakingmaps;

use Session;

class TrakingmapsController extends Controller
{
    function save(Request $request){
        $map = Trakingmaps::where('id_vendedor','=',Session::get('user_id'))->get();
        if(sizeof($map) == 0){
            $obj = new Trakingmaps();
            $obj->id_vendedor = Session::get('user_id');
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
}
