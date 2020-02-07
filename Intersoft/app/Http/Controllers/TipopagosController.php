<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tipopagos;
use App\Pucauxiliar;
use App\Directorios;

use Session;

class TipopagosController extends Controller
{
    //
    public function create(Request $request){
        try{
            $obj = new Tipopagos();
            $obj->nombre     	= $request->nombre;
            $obj->puc_cuenta   = $request->puc_cuenta;
            $obj->tercero       = $request->tercero;
            $obj->id_empresa   = Session::get('id_empresa');
            $obj->save();
            return redirect('/administrador/tipopagos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Tipopagos::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->puc_cuenta   = $request->puc_cuenta;
            $obj->tercero       = $request->tercero;
            $obj->id_empresa   = Session::get('id_empresa');
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
            $obj = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))
                                      ->where('id','=',$id)->fisrt();
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
            $obj = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))
                                      ->where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/administrador/tipopagos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
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
            $objs = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
            $cuentas = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->get();
            $terceros = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                                    ->where('id_directorio_tipo_tercero','=',3)->get();
            foreach( $objs as $obj ){
                $obj->puc_cuenta = Pucauxiliar::where('id','=',$obj->puc_cuenta)->first();
                $obj->tercero = Directorios::where('id','=',$obj->tercero)->first();
            }
            return view('/administrador/tipopagos', [
                'tipopagos' => $objs,
                'cuentas' => $cuentas,
                'terceros' => $terceros]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
