<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use App\Contrato_laborals;
use App\Sessions;
use App\Sucursales;
use App\Zonasusuarios;
use App\Directorios;
use App\Empresas;
use DB;
use App\Facturas;
use App\Http\Controllers\SessionsController;

use Mail;
use App\Mail\Mail\Welcome;

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
            //envio mail
            //Mail::to($usuario->correo)->send(new Welcome($usuario));
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
            //envio mail
            Mail::send('mail.welcome', ['usuario' => $usuario], function ($m) use ($usuario) {
                $m->from('intersoft@wakusoft.com', 'Intersoft');
                $m->to($usuario->correo, $usuario->nombre)->subject('Bienvenida');
            });
            //Mail::to($usuario->correo)->send(new Welcome($usuario));
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

    /**
     * FUNCIONES PARA TOMAR LISTA DE ZONAS Y REPORTES DE VENTAS
     */
    public function listaZonas(){
        
        $nombre_zonas = DB::table('directorios')
                                        ->select(DB::raw('count(*) as contador, zona_venta'))
                                        ->where('id_empresa','=',Session::get('id_empresa'))
                                        ->groupBy('zona_venta')
                                        ->get();
                                        
        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
        $zonas = null;
        return view('facturacion.zona',array(
            'usuarios'=>$usuarios,
            'zona'=>$zonas,
            'id'=>0,
            'nombre_zonas'=>$nombre_zonas
        ));
    }
    public function listaZonas1($id){
        
        $nombre_zonas = DB::table('directorios')
                                        ->select(DB::raw('count(*) as contador, zona_venta'))
                                        ->where('id_empresa','=',Session::get('id_empresa'))
                                        ->groupBy('zona_venta')
                                        ->get();

        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
        $zonas = Zonasusuarios::where('id_empresa','=',Session::get('id_empresa'))->where('id_usuario','=',$id)->get();
        foreach($zonas as $zona){
            $zona->id_usuario = Usuarios::where('id','=',$zona->id_usuario)->first();
            $zona->id_tercero = Directorios::where('id','=',$zona->id_tercero)->first();
        }
        return view('facturacion.zona',array(
            'usuarios'=>$usuarios,
            'zona'=>$zonas,
            'id'=>$id,
            'nombre_zonas'=>$nombre_zonas
        ));
    }
    public function createZonas(Request $request){

        $obj = Zonasusuarios::where('id_usuario','=',$request->id_usuario)->where('zona','=',$request->zona)->get();
        $zona = new Zonasusuarios();
        $zona->id_usuario = $request->id_usuario;
        if(sizeof($obj)==0){             
            $zona->id_tercero = 1;
            $zona->zona = $request->zona;
            $zona->id_empresa = Session::get('id_empresa');
            $zona->estado = $request->estado;
            $zona->save();
        }
        return redirect('/facturacion/zona/'.$zona->id_usuario);
    }
    public function deleteZonas($id){
        $zona = Zonasusuarios::where('id','=',$id)->first();
        $zona->delete();
        return redirect('/facturacion/zona/'.$zona->id_usuario);
    }

    public function contrasenanueva(Request $request){
        $usuario = Usuarios::where('id','=',Session::get('user_id'))->first();
        $usuario->password = $request->password;
        $usuario->save();
        $usuario->id_empresa = Empresas::where('id','=',Session::get('id_empresa'))->first();
        //envio mail
        Mail::send('mail.welcome', ['usuario' => $usuario], function ($m) use ($usuario) {
            $m->from('intersoft@wakusoft.com', 'Intersoft');
            $m->to($usuario->correo, $usuario->nombre)->subject('Bienvenida');
        });
        return view('contrasena');
    }



    public function liquidacionVentas(){
        $valor = 0;
        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
        $facturas = null;
        return view('facturacion.liquidacionventas',array(
            'usuarios'=>$usuarios,
            'facturas'=>$facturas,
            'valor'=>$valor
        ));
    }

    public function liquidacionVentas1($id,$valor){
        $facturas = Facturas::where('id_modificado',$id)->
                             where('saldo','=',0)->
                             where('id_empresa','=',Session::get('id_empresa'))->get();

        $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
        return view('facturacion.liquidacionventas',array(
            'usuarios'=>$usuarios,
            'facturas'=>$facturas,
            'valor'=>$valor
        ));
    }

    public function estadisticaVentas(){
        $facturas = Facturas::where('id_vendedor','=',Session::get('user_id'))
                    ->get();
        return view('facturacion.estadisticaventas',array(
            "facturas"=>$facturas
        ));
    }
}
