<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresas;

class EmpresasController extends Controller
{
    public function create(Request $request){
       $empresa = new Empresas();
       $empresa->razon_social   = $request->razon_social;
       $empresa->direccion      = $request->direccion;
       $empresa->actividad      = $request->actividad;
       $empresa->dian_nit       = $request->dian_nit;
       $empresa->nit_empresa    = $request->nit_empresa;
       $empresa->nombre         = $request->nombre;
       $empresa->telefono       = $request->telefono;
       $empresa->telefono1      = $request->telefono1;
       $empresa->telefono2      = $request->telefono2;
       $empresa->ciudad         = $request->ciudad;
       $empresa->id_regimen     = $request->id_regimen;
       $empresa->save();
       //return $request->razon_social;
       return view('/login');

    }

    public function search(Request $request){
        $empresa = Empresas::where('nit_empresa','=',$request->nit)->get();
        try{
            $variable = $empresa[0]->nit_empresa;
            $sucursales = Sucursales::where('id_empresa','=',$empresa[0]->id)->get();
            return  array(
                "result"=>"Success",
                "body"=>$empresa,
                "sucursales"=>$sucursales);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
        
    }
}
