<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursales;
use App\Usuarios;
use App\Fichatecnicas;
use App\Referencias;

use Session;

class ProduccioningresosController extends Controller
{
    public function index(Request $request){
        try{
            $sucursal = Sucursales::where('id_empresa',Session::get('id_empresa'))->get();
            $operario = Usuarios::where('id_empresa',Session::get('id_empresa'))->get();
            $ficha_tecnica = Fichatecnicas::where('id_empresa',Session::get('id_empresa'))->get();
            $referencia = Referencias::where('id_empresa',Session::get('id_empresa'))->get();
            return view('inventario.ordenesdeproduccion',[
                "sucursal"=>$sucursal,
                "operario"=>$operario,
                "ficha_tecnica"=>$ficha_tecnica,
                "referencia"=>$referencia
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
