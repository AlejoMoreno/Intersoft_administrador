<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastocontados;
use Session;

class ControllerGastocontados extends Controller
{
    public function create(Request $request){
        try{
            
            $obj = new Gastocontados();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo;
            $obj->numero = $request->numero;
            $obj->consecutivo = $request->consecutivo;
            $obj->fecha_egreso = $request->fecha_egreso;
            $obj->centro_costo = $request->centro_costo;
            $obj->id_tercero = $request->id_tercero;
            $obj->id_auxiliar = $request->id_auxiliar;
            $obj->valor = $request->valor;
            $obj->naturaleza = $request->naturaleza;
            $obj->detalle = $request->detalle;
            $obj->id_empresa = Session::get('id_empresa');
            if(isset($request->btnagregar)){
                return redirect('/cartera/gastocontados?prefijo='.$obj->prefijo.'&numero='.$obj->numero.'&fecha_egreso='.$obj->fecha_egreso);
            }
            $obj->save();
            return redirect('/cartera/gastocontados?prefijo='.$obj->prefijo.'&numero='.$obj->numero.'&fecha_egreso='.$obj->fecha_egreso);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Gastocontados::where('id',$request->id)->first();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo;
            $obj->numero = $request->numero;
            $obj->consecutivo = $request->consecutivo;
            $obj->fecha_egreso = $request->fecha_egreso;
            $obj->centro_costo = $request->centro_costo;
            $obj->id_tercero = $request->id_tercero;
            $obj->id_auxiliar = $request->id_auxiliar;
            $obj->valor = $request->valor;
            $obj->naturaleza = $request->naturaleza;
            $obj->detalle = $request->detalle;
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
			$obj = Gastocontados::where('id','=',$id)->fisrt();
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
            $obj = Gastocontados::where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/cartera/gastocontados');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Gastocontados::all();
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
            $objs = Gastocontados::where('id_empresa','=',Session::get('id_empresa'))->get();
            
            return view('cartera.gastocontados', [
                'causaciones' => $objs
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
	}
}
