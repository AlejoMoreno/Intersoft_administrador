<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Documentos;
use App\Pucauxiliar;
use Session;

class DocumentosController extends Controller
{
    /*
    nombre
signo
cuenta_contable_partida
cuenta_contable_contrapartida
    */
	public function create(Request $request){
        try{
            if($request->prefijo == ""){ $request->prefijo = "NA";}
            $obj = new Documentos();
            $obj->nombre     	= $request->nombre;
            $obj->signo   		= $request->signo;
            $obj->ubicacion     = $request->ubicacion;
            $obj->prefijo       = $request->prefijo;
            $obj->num_max       = $request->num_max;
            $obj->num_min       = $request->num_min;
            $obj->num_presente  = $request->num_presente;
            $obj->documento_contable  		= $request->documento_contable;
            $obj->resolucion = $request->resolucion;
            $obj->usuario = $request->usuario;
            $obj->password = $request->password;
            $obj->id_empresa  = Session::get('id_empresa');
            $obj->save();
            return redirect('/inventario/documentos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            if($request->prefijo == ""){ $request->prefijo = "NA";}
            $obj = Documentos::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->signo   		= $request->signo;
            $obj->ubicacion     = $request->ubicacion;
            $obj->prefijo       = $request->prefijo;
            $obj->num_max       = $request->num_max;
            $obj->num_min       = $request->num_min;
            $obj->num_presente  = $request->num_presente;
            $obj->documento_contable  		= $request->documento_contable;
            $obj->resolucion = $request->resolucion;
            $obj->usuario = $request->usuario;
            $obj->password = $request->password;
            $obj->id_empresa  = Session::get('id_empresa');
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
            $obj = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                             ->where('id','=',$id)->first();
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
            $obj = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                             ->where('id','=',$id)->first();
            $obj->delete();
            return redirect('/inventario/documentos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $obj = Documentos::where('id_empresa','=',Session::get('id_empresa'))->get();
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
            $objs = Documentos::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('inventario.documentos', [
            'documentos' => $objs
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

}
