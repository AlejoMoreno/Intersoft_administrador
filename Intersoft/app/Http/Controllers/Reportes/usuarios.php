<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sessions;
use App\Facturas;
use DB;
use Session;


class usuarios extends Controller
{
    function index(Request $request){

        $sesiones = Sessions::select(['sessions.user_id','usuarios.ncedula', DB::raw('COUNT(*) as sesiones')])
                    ->join('usuarios','usuarios.id', '=', 'sessions.user_id')
                    ->where(function ($q) use ($request) {
                        if(isset($request->sesion_fecha_inicio)){
                            $q->where('sessions.created_at','>=',$request->sesion_fecha_inicio);
                        }
                        if(isset($request->sesion_fecha_final)){
                            $q->where('sessions.created_at','<',$request->sesion_fecha_final);
                        }
                        if(isset($request->usuarios)){
                            if($request->usuarios != 0){
                                $q->where('usuarios.id','=',$request->usuarios);
                            }
                        }
                    })
                    ->where('usuarios.id_empresa','=',Session::get('id_empresa'))
                    ->groupBy('sessions.user_id','usuarios.ncedula')
                    ->orderBy('sesiones')
                    ->get();
                    
        $ventas = Facturas::select([DB::raw('SUM(subtotal) as subtotal'),
                                    DB::raw('SUM(iva) as iva'),
                                    DB::raw('SUM(retefuente) as retefuente'),
                                    DB::raw('SUM(total) as total')])
                    ->where('id_empresa','=',Session::get('id_empresa'))
                    ->where('signo','=','-')
                    ->where(function ($q) use ($request) {
                        if(isset($request->sesion_fecha_inicio)){
                            $q->where('fecha','>=',$request->sesion_fecha_inicio);
                        }
                        if(isset($request->sesion_fecha_final)){
                            $q->where('fecha','<',$request->sesion_fecha_final);
                        }
                        if(isset($request->usuarios)){
                            if($request->usuarios != 0){
                                $q->where('id_vendedor','=',$request->usuarios);
                            }
                        }
                    })
                    ->get();
        
        $compras = Facturas::select([DB::raw('SUM(subtotal) as subtotal'),
                                    DB::raw('SUM(iva) as iva'),
                                    DB::raw('SUM(retefuente) as retefuente'),
                                    DB::raw('SUM(total) as total')])
                    ->where('id_empresa','=',Session::get('id_empresa'))
                    ->where('signo','=','+')
                    ->where(function ($q) use ($request) {
                        if(isset($request->sesion_fecha_inicio)){
                            $q->where('fecha','>=',$request->sesion_fecha_inicio);
                        }
                        if(isset($request->sesion_fecha_final)){
                            $q->where('fecha','<',$request->sesion_fecha_final);
                        }
                        if(isset($request->usuarios)){
                            if($request->usuarios != 0){
                                $q->where('id_vendedor','=',$request->usuarios);
                            }
                        }
                    })
                    ->get();

        $pedidos = Facturas::select([DB::raw('SUM(subtotal) as subtotal'),
                                    DB::raw('SUM(iva) as iva'),
                                    DB::raw('SUM(retefuente) as retefuente'),
                                    DB::raw('SUM(total) as total')])
                    ->where('id_empresa','=',Session::get('id_empresa'))
                    ->where('signo','=','=')
                    ->where(function ($q) use ($request) {
                        if(isset($request->sesion_fecha_inicio)){
                            $q->where('fecha','>=',$request->sesion_fecha_inicio);
                        }
                        if(isset($request->sesion_fecha_final)){
                            $q->where('fecha','<',$request->sesion_fecha_final);
                        }
                        if(isset($request->usuarios)){
                            if($request->usuarios != 0){
                                $q->where('id_vendedor','=',$request->usuarios);
                            }
                        }
                    })
                    ->get();

        $usuarios = DB::select('select * from usuarios where id_empresa = '.Session::get('id_empresa'));

		return view('reportes.index',[
            'sesiones' => $sesiones,
            'ventas' => $ventas,
            'compras' => $compras,
            'pedidos' => $pedidos,
            'usuarios' => $usuarios
        ]);
	}
}
