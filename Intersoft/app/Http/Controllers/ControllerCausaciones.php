<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Causaciones;
use Session;

class ControllerCausaciones extends Controller
{
    public function create(Request $request){
        try{
            $obj = new Causaciones();
            $obj->id_sucursal = Session::get('sucursal');
            $obj->prefijo = $request->prefijo;
            $obj->numero = $request->numero;
            $obj->consecutivo = $request->consecutivo;
            $obj->fecha = $request->fecha;
            $obj->id_tercero = $request->id_tercero;
            $obj->factura = $request->factura;
            $obj->neto_pagar = $request->neto_pagar;
            $obj->fecha_vencimiento = $request->fecha_vencimiento;
            $obj->centro_costo = $request->centro_costo;
            $obj->detalle = $request->detalle;
            $obj->id_auxiliar = $request->id_auxiliar;
            $obj->id_tercero_auxiliar = $request->id_tercero_auxiliar;
            $obj->valor_auxiliar = $request->valor_auxiliar;
            $obj->naturaleza = $request->naturaleza;
            $obj->id_empresa = Session::get('id_empresa');
            $obj->save();
            return redirect('/cartera/causacion');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
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
            return redirect('/cartera/causacion');
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

    public function index(){
        try{
            $objs = Causaciones::where('id_empresa','=',Session::get('id_empresa'))->get();
            
            return view('cartera.causacion', [
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
