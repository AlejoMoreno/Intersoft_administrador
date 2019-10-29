<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Pucauxiliar;
use App\Pucclases;
use App\Puccuentas;
use App\Pucgrupos;
use App\Pucsubcuentas;

use App\Empresas;
use App\Contabilidad;

class ContabilidadesController extends Controller
{
    public function register($contabilidad){
        //verificar el consecutivo
        $contabilidad->save();
        return  array(            
            "contabilidad"=>$contabilidad);
    }
    
}
