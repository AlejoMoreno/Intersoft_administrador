<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trakingmaps;

class TrakingmapsController extends Controller
{
    function save(){
        $obj = new Trakingmaps();
        $obj->id_vendedor;
        $obj->longitud;
        $obj->latitud;
        $obj->accuracy;
    }
}
