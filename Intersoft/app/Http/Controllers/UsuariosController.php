<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use App\Contrato_laborals;

class UsuariosController extends Controller
{
    public function login(Request $request){
        $cuenta = Usuarios::where('ncedula',$request->cedula)->where('password',$request->password)->get()->count();
        $usuario = Usuarios::where('ncedula',$request->cedula)->where('password',$request->password)->get();
        if($cuenta==0){
            return array(
                "result"=>"error",
                "body"=>"No coinciden resultados"
            );
        }
        else{
            return array(
                "result"=>"success",
                "body"=>$usuario
            );
        }
    }

    public function create(Request $request){
        $usuario = new Usuarios();
        $usuario->ncedula             = $request->ncedula;
        $usuario->nombre              = $request->nombre;
        $usuario->apellido            = $request->apellido;
        $usuario->cargo               = $request->cargo;
        $usuario->telefono            = $request->telefono;
        $usuario->password            = $request->password;
        $usuario->correo              = $request->correo;
        $usuario->estado              = $request->estado;
        $usuario->token               = $request->token;
        $usuario->arl                 = $request->arl;
        $usuario->eps                 = $request->eps;
        $usuario->cesantias           = $request->cesantias;
        $usuario->pension             = $request->pension;
        $usuario->caja_compensacion   = $request->caja_compensacion;
        $usuario->id_contrato         = $request->id_contrato;
        $usuario->referencia_personal = $request->referencia_personal;
        $usuario->telefono_referencia = $request->telefono_referencia;
        $usuario->save();
        //return $request->razon_social;
        $usuarios = Usuarios::all();
        foreach ($usuarios as $value) {
            $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
        }
        return view('administrador.usuarios', array('usuarios'=>$usuarios));
    }

    public function update(Request $request){
        $usuario = Usuarios::where('id',$request->id)->get();
        $usuario->ncedula             = $request->ncedula;
        $usuario->nombre              = $request->nombre;
        $usuario->apellido            = $request->apellido;
        $usuario->cargo               = $request->cargo;
        $usuario->telefono            = $request->telefono;
        $usuario->password            = $request->password;
        $usuario->correo              = $request->correo;
        $usuario->estado              = $request->estado;
        $usuario->token               = $request->token;
        $usuario->arl                 = $request->arl;
        $usuario->eps                 = $request->eps;
        $usuario->cesantias           = $request->cesantias;
        $usuario->pension             = $request->pension;
        $usuario->caja_compensacion   = $request->caja_compensacion;
        $usuario->id_contrato         = $request->id_contrato;
        $usuario->referencia_personal = $request->referencia_personal;
        $usuario->telefono_referencia = $request->telefono_referencia;
        $usuario->save();
        //return $request->razon_social;
        $usuarios = Usuarios::all();
        foreach ($usuarios as $value) {
            $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
        }
        return view('administrador.usuarios', array('usuarios'=>$usuarios));
    }

    public function delete($id){
        $usuario = Usuarios::where('id',$id)->first();
        $usuario->delete();
        //return $request->razon_social;
        $usuarios = Usuarios::all();
        foreach ($usuarios as $value) {
            $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
        }
        return view('administrador.usuarios', array('usuarios'=>$usuarios));
    }

    public function all(){
        $usuarios = Usuarios::all();   
        foreach ($usuarios as $value) {
            $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
        }
        return  array(
            "result"=>"success",
            "body"=>$usuarios);
    }

    public function index(){
        $usuarios = Usuarios::all();
        $contratos = Contrato_laborals::all();
        foreach ($usuarios as $value) {
            $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
        }
        return view('administrador.usuarios', array(
            'usuarios'=>$usuarios,
            'contratos'=>$contratos
        ));
    }
}
