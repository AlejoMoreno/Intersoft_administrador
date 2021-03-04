<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lineas;
use App\Pucauxiliar;

use Session;

class LineasController extends Controller
{
    //
    public function create(Request $request){
        try{
            $obj = new Lineas();
            $obj->nombre     	= $request->nombre;
            if(!isset($request->descripcion)){
                $request->descripcion = $request->nombre;
            }
            $obj->descripcion   = $request->descripcion;
            if(!isset($request->codigo_interno)){
                $request->codigo_interno = $request->nombre;
            }
            $obj->codigo_interno= $request->codigo_interno;
            if(!isset($request->codigo_alterno)){
                $request->codigo_alterno = $request->nombre;
            }
            if($request->retefuente_porcentaje == '0'){
                $request->v_puc_retefuente = 1;
                $request->c_puc_retefuente = 1;
            }
            if($request->reteiva_porcentaje == '0'){
                $request->v_puc_reteiva = 1;
                $request->c_puc_reteiva = 1;
            }
            if($request->reteica_porcentaje == '0'){
                $request->v_puc_reteica = 1;
                $request->c_puc_reteica = 1;
            }
            $obj->codigo_alterno        = $request->codigo_alterno;
            $obj->id_empresa            = Session::get('id_empresa');
            $obj->retefuente_porcentaje = $request->retefuente_porcentaje;
            $obj->v_puc_retefuente        = $request->v_puc_retefuente;
            $obj->c_puc_retefuente        = $request->c_puc_retefuente;
            $obj->reteiva_porcentaje    = $request->reteiva_porcentaje;
            $obj->v_puc_reteiva           = $request->v_puc_reteiva;
            $obj->c_puc_reteiva           = $request->c_puc_reteiva;
            $obj->reteica_porcentaje    = $request->reteica_porcentaje;
            $obj->v_puc_reteica           = $request->v_puc_reteica;
            $obj->c_puc_reteica           = $request->c_puc_reteica;
            $obj->iva_porcentaje        = $request->iva_porcentaje;
            $obj->v_puc_iva               = $request->v_puc_iva;
            $obj->c_puc_iva               = $request->c_puc_iva;
            $obj->puc_compra            = $request->puc_compra;
            $obj->puc_venta             = $request->puc_venta;
            $obj->save();
            return redirect('/inventario/lineas');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $obj = Lineas::where('id',$request->id)->first();
            $obj->nombre     	        = $request->nombre;
            $obj->descripcion           = $request->descripcion;
            $obj->codigo_interno        = $request->codigo_interno;
            $obj->codigo_alterno        = $request->codigo_alterno;
            $obj->id_empresa            = Session::get('id_empresa');
            $obj->retefuente_porcentaje = $request->retefuente_porcentaje;
            $obj->v_puc_retefuente        = $request->v_puc_retefuente;
            $obj->c_puc_retefuente        = $request->c_puc_retefuente;
            $obj->reteiva_porcentaje    = $request->reteiva_porcentaje;
            $obj->v_puc_reteiva           = $request->v_puc_reteiva;
            $obj->c_puc_reteiva           = $request->c_puc_reteiva;
            $obj->reteica_porcentaje    = $request->reteica_porcentaje;
            $obj->v_puc_reteica           = $request->v_puc_reteica;
            $obj->c_puc_reteica           = $request->c_puc_reteica;
            $obj->iva_porcentaje        = $request->iva_porcentaje;
            $obj->v_puc_iva               = $request->v_puc_iva;
            $obj->c_puc_iva               = $request->c_puc_iva;
            $obj->puc_compra            = $request->puc_compra;
            $obj->puc_venta             = $request->puc_venta;
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
            $obj = Lineas::where('id_empresa','=',Session::get('id_empresa'))
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
            $obj = Lineas::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$id)->fisrt();
            $obj->delete();
            return redirect('/inventario/lineas');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $objs = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
            foreach($objs as $obj){
                $obj->c_puc_retefuente= Pucauxiliar::where('id','=',$obj->c_puc_retefuente)->first();
                $obj->c_puc_reteiva   = Pucauxiliar::where('id','=',$obj->c_puc_reteiva)->first();
                $obj->c_puc_reteica   = Pucauxiliar::where('id','=',$obj->c_puc_reteica)->first();
                $obj->c_puc_iva       = Pucauxiliar::where('id','=',$obj->c_puc_iva)->first();
                $obj->c_puc_compra    = Pucauxiliar::where('id','=',$obj->c_puc_compra)->first();
                $obj->c_puc_venta     = Pucauxiliar::where('id','=',$obj->c_puc_venta)->first();
                $obj->v_puc_retefuente= Pucauxiliar::where('id','=',$obj->v_puc_retefuente)->first();
                $obj->v_puc_reteiva   = Pucauxiliar::where('id','=',$obj->v_puc_reteiva)->first();
                $obj->v_puc_reteica   = Pucauxiliar::where('id','=',$obj->v_puc_reteica)->first();
                $obj->v_puc_iva       = Pucauxiliar::where('id','=',$obj->v_puc_iva)->first();
                $obj->v_puc_compra    = Pucauxiliar::where('id','=',$obj->v_puc_compra)->first();
                $obj->v_puc_venta     = Pucauxiliar::where('id','=',$obj->v_puc_venta)->first();
            }
            return  array(
                "result"=>"success",
                "body"=>$objs);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
        try{
            $objs = Lineas::where('id_empresa','=',Session::get('id_empresa'))->get();
            $cuentas = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->get();
            foreach($objs as $obj){
                $obj->c_puc_retefuente= Pucauxiliar::where('id','=',$obj->c_puc_retefuente)->first();
                $obj->c_puc_reteiva   = Pucauxiliar::where('id','=',$obj->c_puc_reteiva)->first();
                $obj->c_puc_reteica   = Pucauxiliar::where('id','=',$obj->c_puc_reteica)->first();
                $obj->c_puc_iva       = Pucauxiliar::where('id','=',$obj->c_puc_iva)->first();
                $obj->c_puc_compra    = Pucauxiliar::where('id','=',$obj->c_puc_compra)->first();
                $obj->c_puc_venta     = Pucauxiliar::where('id','=',$obj->c_puc_venta)->first();
                $obj->v_puc_retefuente= Pucauxiliar::where('id','=',$obj->v_puc_retefuente)->first();
                $obj->v_puc_reteiva   = Pucauxiliar::where('id','=',$obj->v_puc_reteiva)->first();
                $obj->v_puc_reteica   = Pucauxiliar::where('id','=',$obj->v_puc_reteica)->first();
                $obj->v_puc_iva       = Pucauxiliar::where('id','=',$obj->v_puc_iva)->first();
                $obj->v_puc_compra    = Pucauxiliar::where('id','=',$obj->v_puc_compra)->first();
                $obj->v_puc_venta     = Pucauxiliar::where('id','=',$obj->v_puc_venta)->first();
                $obj->puc_compra    = Pucauxiliar::where('id','=',$obj->puc_compra)->first();
                $obj->puc_venta     = Pucauxiliar::where('id','=',$obj->puc_venta)->first();
                
            }
            return view('inventario.lineas', [
                'lineas' => $objs,
                'cuentas'=> $cuentas
                ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
}
