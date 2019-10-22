<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Documentos;
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
            $obj = new Documentos();
            $obj->nombre     	= $request->nombre;
            $obj->signo   		= $request->signo;
            $obj->ubicacion     = $request->ubicacion;
            $obj->prefijo       = $request->prefijo;
            $obj->num_max       = $request->num_max;
            $obj->num_min       = $request->num_min;
            $obj->num_presente  = $request->num_presente;
            $obj->cuenta_contable_partida  		= $request->cuenta_contable_partida;
            $obj->cuenta_contable_contrapartida= $request->cuenta_contable_contrapartida;
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
            $obj = Documentos::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->signo   		= $request->signo;
            $obj->ubicacion     = $request->ubicacion;
            $obj->prefijo       = $request->prefijo;
            $obj->num_max       = $request->num_max;
            $obj->num_min       = $request->num_min;
            $obj->num_presente  = $request->num_presente;
            $obj->cuenta_contable_partida  		= $request->cuenta_contable_partida;
            $obj->cuenta_contable_contrapartida= $request->cuenta_contable_contrapartida;
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
            'documentos' => $objs]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

}
