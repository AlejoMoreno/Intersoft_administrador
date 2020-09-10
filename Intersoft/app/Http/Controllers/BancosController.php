<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bancos;
use App\Pucauxiliar;
use Session;

class BancosController extends Controller
{

	public function create(Request $request){
        try{
            $obj = new Bancos();
            $obj->nombre     	= $request->nombre;
            $obj->sucursal   	= $request->sucursal;
            $obj->numero_de_cuenta= $request->numero_cuenta;
            $obj->cuenta_contable = $request->cuenta_contable;
			$obj->impuesto    	= $request->impuesto;
			
			$obj->consecutivo_cheque    = $request->consecutivo_cheque;
			//$obj->id_empresa		= Session::get('id_empresa');
            $obj->save();
            return redirect('/administrador/bancos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Bancos::where('id',$request->id)->first();
            $obj->nombre     	= $request->nombre;
            $obj->sucursal   	= $request->sucursal;
            $obj->numero_de_cuenta= $request->numero_de_cuenta;
            $obj->cuenta_contable = $request->cuenta_contable;
			$obj->impuesto    	= $request->impuesto;
			$obj->consecutivo_cheque    = $request->consecutivo_cheque;
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
			$obj = Bancos::where('id','=',$id)->fisrt();
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
            $obj = Bancos::where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/administrador/bancos');
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
            $pucauxiliares = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->get();
            $objs = Bancos::all();
            foreach($objs as $obj){
                $obj->cuenta_contable = Pucauxiliar::where('id','=',$obj->cuenta_contable)->first();
            }
            return view('administrador.bancos', [
                'bancos' => $objs,
                'pucauxiliares' => $pucauxiliares]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
	}
	
    
}
