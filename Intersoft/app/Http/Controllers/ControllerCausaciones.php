<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Causaciones;
use App\Carteras;
use App\Directorios;
use App\Tipopagos;
use Session;

class ControllerCausaciones extends Controller
{
    public function create(Request $request){
        try{
            $obj = new Causaciones();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo; /**/
            $obj->numero = $request->numero; /**/
            $obj->consecutivo = $request->consecutivo;
            $obj->fecha = $request->fecha; /**/
            $obj->id_tercero = $request->id_tercero;
            $obj->factura = $request->factura;
            $obj->neto_pagar = $request->neto_pagar; /**/
            $obj->fecha_vencimiento = $request->fecha_vencimiento; /**/
            $obj->centro_costo = $request->centro_costo; /**/
            $obj->detalle = $request->detalle; /**/
            $obj->id_auxiliar = $request->id_auxiliar; /**/
            $obj->id_tercero_auxiliar = $request->id_tercero_auxiliar; /**/
            $obj->valor_auxiliar = $request->valor_auxiliar; /**/
            $obj->naturaleza = $request->naturaleza; /**/
            $obj->id_empresa = Session::get('id_empresa');
            if(isset($request->btnagregar)){
                return redirect('/cartera/causacion?prefijo='.$obj->prefijo.'&numero='.$obj->numero);
            }
            $obj->save();
            return redirect('/cartera/causacion?prefijo='.$obj->prefijo.'&numero='.$obj->numero);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function updateSaldo(Request $request){
        $obj = Causaciones::where('id',$request->id)->get();
        foreach($obj as $ob){
            $ob->saldo = $ob->saldo - $request->total;
            $ob->save(); 
        }
    }

    public function update(Request $request){
        try{
            $obj = Causaciones::where('id',$request->id)->first();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo;
            $obj->numero = $request->numero;
            $obj->consecutivo = $request->consecutivo;
            $obj->fecha = $request->fecha;
            $obj->id_tercero = $request->id_tercero;
            $obj->factura = $request->factura;
            $obj->neto_pagar = $request->neto_pagar;
            $obj->saldo = $request->neto_pagar;
            $obj->fecha_vencimiento = $request->fecha_vencimiento;
            $obj->centro_costo = $request->centro_costo;
            $obj->detalle = $request->detalle;
            $obj->id_auxiliar = $request->id_auxiliar;
            $obj->id_tercero_auxiliar = $request->id_tercero_auxiliar;
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
			$obj = Causaciones::where('id','=',$id)->fisrt();
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
            $obj = Causaciones::where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/cartera/causacion?prefijo='.$obj->prefijo.'&numero='.$obj->numero);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Causaciones::all();
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

    public function allTercero($cedula){
        try{
            $tercero = Directorios::where('nit','=',$cedula)->where('id_empresa','=',Session::get('id_empresa'))->first();
            $obj = Causaciones::where('id_tercero','=',$tercero->id)
                        ->where('saldo','>','0')->get();
            return  array(
                "result"=>"success",
                "body"=>$obj);
        }
        catch (Exception $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }


    public function index(){
        try{
            $tipo_pagos = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('cartera.causacion', [
                'tipo_pagos'=>$tipo_pagos
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
    
    public function indexPago(){
        $documento = Carteras::where('id_empresa','=',Session::get('id_empresa'))->where('tipoCartera','=','EGRESO')->orderBy('numero','desc')->first();
        try{
            return view('cartera.causacionPago', array(
                "documento"=>$documento
            ));
        }
        catch(Exception $exc){
            return  array(
                "result"=>"fail",
                "body"=>$exc);
        }
    }
}
