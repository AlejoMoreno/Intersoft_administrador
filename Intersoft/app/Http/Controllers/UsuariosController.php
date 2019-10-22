<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use App\Contrato_laborals;
use App\Sessions;
use App\Sucursales;
use App\Http\Controllers\SessionsController;
use Session;

class UsuariosController extends Controller
{
    public function login(Request $request){
        try{
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
                    $sessions->id_empresa = 1;
                    $sessions->save();
                    //buscar sucursal
                    $sucursal = Sucursales::where('id','=',$request->sucursal)->first();

                    SessionsController::storeSession($sessions,$usuario,$request->sucursal); // save session in server
                    return array(
                        "result"=>"success",
                        "body"=>$usuario,
                        "sessions"=>$sessions->user_agent
                    );
                }
                
            }
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function addlogin(Request $request){
        try{
            $cuenta = Usuarios::where('ncedula',$request->cedula)->where('password',$request->password)->get()->count();

            if($cuenta==0){
                return view('login', array(
                    "result"=>"error",
                    "body"=>"No coinciden resultados"
                ));
            }
            else{
                $usuario = Usuarios::where('ncedula',$request->cedula)->where('password',$request->password)->get()[0];
                $sesion_valida = Sessions::where('user_agent','like',encrypt($usuario->id.$request->ip()."Ingreso Al sistema"))->get()->count();
                if($sesion_valida != 0){ //validar session >0 hay alguien en el sistema 0=no hay nadie mas
                    return view('login', array(
                        "result"=>"error",
                        "body"=>"Hay alguien usando tu usuario"
                    ));       
                }
                else{
                    //Crear sesiones para este usuario
                    $sessions = new Sessions();
                    $sessions->user_id = $usuario->id;
                    $sessions->ip = $request->ip();
                    $sessions->user_agent = encrypt($sessions->user_id.$sessions->ip."Ingreso Al sistema");
                    $sessions->last_activity = "Ingreso Al sistema";
                    $sessions->id_empresa = 1;
                    $sessions->save();

                    //ver la sucursal
                    $sucursal = Sucursales::where('id','=',$request->sucursal)->first();

                    SessionsController::storeSession($sessions,$usuario,$sucursal); // save session in server
                    return view('login', array(
                        "result"=>"success",
                        "body"=>$usuario,
                        "sessions"=>$sessions->user_agent
                    ));
                }
                
            }   
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function create(Request $request){
        try{
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
            $usuario->id_empresa  = Session::get('id_empresa');
            $usuario->save();
            return redirect('/administrador/usuarios');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    //registrar
    public function registrar(Request $request){
        try{
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
                $usuario->id_empresa  = Session::get('id_empresa');
                $usuario->save();
                //return $request->razon_social;
                $usuarios = Usuarios::all();
                foreach ($usuarios as $value) {
                    $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
                }
                return view('/', array('usuarios'=>$usuarios));
            }
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
        
    }

    public function update(Request $request){
        try{
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
            $usuario->id_empresa  = Session::get('id_empresa');
            $usuario->save();
            return $usuario;
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function delete($id){
        try{
            $usuario = Usuarios::where('id_empresa','=',Session::get('id_empresa'))
            ->where('id','=',$id)->fisrt();
            $usuario->delete();
            return redirect('/administrador/usuarios');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();   
            foreach ($usuarios as $value) {
                $value->id_contrato = Contrato_laborals::where('id',$value->id_contrato)->first();
            }
            return  array(
                "result"=>"success",
                "body"=>$usuarios);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
        try{
            $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
            $contratos = Contrato_laborals::where('id_empresa','=',Session::get('id_empresa'))->get();
            foreach ($usuarios as $value) {
                $value->id_contrato = Contrato_laborals::select(\DB::raw('id','nombre'))->where('id',$value->id_contrato)->first();
            }
            return view('administrador.usuarios', array(
                'usuarios'=>$usuarios,
                'contratos'=>$contratos
            ));
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function cerrar(){
        SessionsController::deleteSession();
        return redirect('/');
    }
}
