<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use App\Contrato_laborals;
use App\Sessions;
use App\Http\Controllers\SessionsController;

class UsuariosController extends Controller
{
    public function login(Request $request){
        $cuenta = Usuarios::where('ncedula',$request->cedula)->where('password',$request->password)->get()->count();

        if($cuenta==0){
            return array(
                "result"=>"error",
                "body"=>"No coinciden resultados"
            );
        }
        else{
            $usuario = Usuarios::where('ncedula',$request->cedula)->where('password',$request->password)->get()[0];
            $sesion_valida = Sessions::where('user_agent','like',encrypt($usuario->id.$request->ip()."Ingreso Al sistema"))->get()->count();
            if($sesion_valida != 0){ //validar session >0 hay alguien en el sistema 0=no hay nadie mas
                return array(
                    "result"=>"error",
                    "body"=>"Hay alguien usando tu usuario"
                );       
            }
            else{
                //Crear sesiones para este usuario
                $sessions = new Sessions();
                $sessions->user_id = $usuario->id;
                $sessions->ip = $request->ip();
                $sessions->user_agent = encrypt($sessions->user_id.$sessions->ip."Ingreso Al sistema");
                $sessions->last_activity = "Ingreso Al sistema";
                $sessions->save();
                SessionsController::storeSession($sessions,$usuario); // save session in server
                return array(
                    "result"=>"success",
                    "body"=>$usuario,
                    "sessions"=>$sessions->user_agent
                );
            }
            
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
        return redirect('/administrador/usuarios');
    }

    //registrar
    public function registrar(Request $request){
        if($request->ncedula == '' || $request->nombre == '' || $request->apellido == '' || $request->cargo == '' || $request->telefono == '' || $request->password == '' || $request->correo == ''  ){
            return view('registro');
        }
        else{
            $usuario = new Usuarios();
            $usuario->ncedula             = $request->ncedula;
            $usuario->nombre              = $request->nombre;
            $usuario->apellido            = $request->apellido;
            $usuario->cargo               = $request->cargo;
            $usuario->telefono            = $request->telefono;
            $usuario->password            = $request->password;
            $usuario->correo              = $request->correo;
            $usuario->estado              = '1';
            $usuario->token               = 'N/A';
            $usuario->arl                 = 'N/A';
            $usuario->eps                 = 'N/A';
            $usuario->cesantias           = 'N/A';
            $usuario->pension             = 'N/A';
            $usuario->caja_compensacion   = 'N/A';
            $usuario->id_contrato         = '1';
            $usuario->referencia_personal = 'N/A';
            $usuario->telefono_referencia = 'N/A';
            $usuario->save();
            //return $request->razon_social;
            $usuarios = Usuarios::all();
            foreach ($usuarios as $value) {
                $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
            }
            return view('/', array('usuarios'=>$usuarios));
        }
        
    }

    public function update(Request $request){
        $usuario = Usuarios::where('id',$request->id)->first();
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
        return $usuario;
    }

    public function delete($id){
        $usuario = Usuarios::where('id',$id)->first();
        $usuario->delete();
        return redirect('/administrador/usuarios');
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
            $value->id_contrato = Contrato_laborals::select(\DB::raw('id','nombre'))->where('id',$value->id_contrato)->first();
        }
        return view('administrador.usuarios', array(
            'usuarios'=>$usuarios,
            'contratos'=>$contratos
        ));
    }

    public function cerrar(){
        SessionsController::deleteSession();
        return redirect('/');
    }
}
