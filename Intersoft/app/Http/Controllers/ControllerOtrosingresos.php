<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Otrosingresos;
use App\Tipopagos;
use Session;

class ControllerOtrosingresos extends Controller
{
    public function create(Request $request){
        try{
            $obj = new Otrosingresos();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo;
            $obj->numero = $request->numero;
            $obj->fecha = $request->fecha;
            $obj->id_tercero = $request->id_tercero;
            $obj->concepto = $request->concepto;
            $obj->valor = $request->valor;
            $obj->id_auxiliar = $request->id_auxiliar;
            $obj->id_tercero_cuenta = $request->id_tercero;
            $obj->valor_auxiliar = $request->valor_auxiliar;
            $obj->naturaleza = $request->naturaleza;
            $obj->id_empresa = Session::get('id_empresa');
            if(isset($request->btnagregar)){
                return redirect('/cartera/otrosingresos?prefijo='.$obj->prefijo.'&numero='.$obj->numero);
            }
            $obj->save();
            return redirect('/cartera/otrosingresos?prefijo='.$obj->prefijo.'&numero='.$obj->numero);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Otrosingresos::where('id',$request->id)->first();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo;
            $obj->numero = $request->numero;
            $obj->fecha = $request->fecha;
            $obj->id_tercero = $request->id_tercero;
            $obj->concepto = $request->concepto;
            $obj->valor = $request->valor;
            $obj->id_auxiliar = $request->id_auxiliar;
            $obj->id_tercero_cuenta = $request->id_tercero_cuenta;
            $obj->valor_auxiliar = $request->valor_auxiliar;
            $obj->naturaleza = $request->naturaleza;
            $obj->id_empresa = Session::get('id_empresa');
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
			$obj = Otrosingresos::where('id','=',$id)->first();
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
            $obj = Otrosingresos::where('id','=',$id)->first();
            $obj->delete();
            return redirect('/cartera/otrosingresos?prefijo='.$obj->prefijo.'&numero='.$obj->numero);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Otrosingresos::all();
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
            $objs = Otrosingresos::where('id_empresa','=',Session::get('id_empresa'))->get();
            $tipo_pagos = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('cartera.otrosingresos', [
                'causaciones' => $objs,
                'tipo_pagos'=>$tipo_pagos
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
	}
}
