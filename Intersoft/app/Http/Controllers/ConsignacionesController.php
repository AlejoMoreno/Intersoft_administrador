<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Consignaciones;
use App\Bancos;
use App\TipoPagos;

use DB;
use Session;

class ConsignacionesController extends Controller
{
        
    public function create(Request $request){
        try{
            $obj = new Consignaciones();
            $obj->consecutivo     	= $request->consecutivo;
            $obj->concepto   	= $request->concepto;
            $obj->valor= $request->valor;
            $obj->id_tipo_pago = $request->id_tipo_pago;
			$obj->total    	= $request->total;
            $obj->fecha_consignacion    = $request->fecha_consignacion;
            $obj->id_banco  = $request->id_banco;
			$obj->id_empresa		= Session::get('id_empresa');
            $obj->save();
            return redirect('/administrador/consignacion');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Consignaciones::where('id',$request->id)->first();
            $obj->consecutivo     	= $request->consecutivo;
            $obj->concepto   	= $request->concepto;
            $obj->valor= $request->valor;
            $obj->id_tipo_pago = $request->id_tipo_pago;
			$obj->total    	= $request->total;
            $obj->fecha_consignacion    = $request->fecha_consignacion;
            $obj->id_banco  = $request->id_banco;
			$obj->id_empresa		= Session::get('id_empresa');
			//$obj->id_empresa		= Session::get('id_empresa');
            $obj->save();
            return $obj;
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
    
    public function showone($id){
        try{
            /*$obj = Bancos::where('id_empresa','=',Session::get('id_empresa'))
								  ->where('id','=',$id)->fisrt();*/
			$obj = Consignaciones::where('id','=',$id)->fisrt();
            return  array(
                "result"=>"success",
                "body"=>$obj);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function delete($id){
        try{
            $obj = Consignaciones::where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/administrador/consignacion');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Bancos::all();
            return  array(
                "result"=>"success",
                "body"=>$obj);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
        try{
            $bancos = Bancos::all();
            $tipo_pagos = TipoPagos::where('id_empresa','=',Session::get('id_empresa'))->get();
            $objs = Consignaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
            foreach($objs as $obj){
                $obj->id_tipo_pago = TipoPagos::where('id','=',$obj->id_tipo_pago)->first();
                $obj->id_banco = Bancos::where('id','=',$obj->id_banco)->first();
            }
            return view('administrador.consignacion', [
                'consignaciones' => $objs,
                'tipo_pago'=> $tipo_pagos,
                'bancos' => $bancos]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
	}
}
