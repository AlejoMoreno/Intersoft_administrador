<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresas;
use App\Sucursales;
use App\Usuarios;


class EmpresasController extends Controller
{
    public function create(Request $request){
       $empresa = new Empresas();
       $empresa->razon_social   = $request->razon_social;
       $empresa->direccion      = $request->direccion;
       $empresa->actividad      = $request->actividad;
       $empresa->correo       = $request->correo;
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
        $empresa = Empresas::where('nit_empresa','=',$request->nit)->first();
        try{
            $sucursales = Sucursales::where('id_empresa','=',$empresa->id)->get();
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

    public function register(Request $request){
        try{
            //guardar la empresa
            $empresa = new Empresas();
            $empresa->razon_social   = $request->razon_social;
            $empresa->direccion      = $request->direccion;
            $empresa->actividad      = $request->actividad;
            $empresa->correo       = $request->correo;
            $empresa->nit_empresa    = $request->nit_empresa;
            $empresa->nombre         = $request->nombre;
            $empresa->telefono       = $request->telefono;
            $empresa->telefono1      = $request->telefono1;
            $empresa->telefono2      = $request->telefono2;
            $empresa->ciudad         = $request->ciudad_empresa;
            $empresa->id_regimen     = $request->id_regimen;
            $empresa->save();

            $usuario = new Usuarios();
            $usuario->ncedula             = $request->userncedula;
            $usuario->nombre              = $request->usernombre;
            $usuario->apellido            = $request->userapellido;
            $usuario->cargo               = $request->usercargo;
            $usuario->telefono            = $request->usertelefono;
            $usuario->password            = $request->userpassword;
            $usuario->correo              = $request->usercorreo;
            $usuario->estado              = "ACTIVO";
            $usuario->token               = "12345679";
            $usuario->arl                 = "NINGUNA";
            $usuario->eps                 = "NINGUNA";
            $usuario->cesantias           = "NINGUNA";
            $usuario->pension             = "NINGUNA";
            $usuario->caja_compensacion   = "NINGUNA";
            $usuario->id_contrato         = 1;
            $usuario->referencia_personal = "NINGUNA";
            $usuario->telefono_referencia = "NINGUNA";
            $usuario->id_empresa          = $empresa->id;
            $usuario->save();

            $sucursales = new Sucursales();
            $sucursales->nombre     = $request->sucnombre;
            $sucursales->codigo     = $request->succodigo;
            $sucursales->direccion  = $request->sucdireccion;
            $sucursales->encargado  = $request->sucencargado;
            $sucursales->telefono   = $request->suctelefono;
            $sucursales->correo     = $request->succorreo;
            $sucursales->ciudad     = $request->succiudad;
            $sucursales->id_empresa = $empresa->id;
            $sucursales->save();
            
            return redirect('/login');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
        
    }
}
