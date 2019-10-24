<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lotes;

use Session;

class LotesController extends Controller
{
    //
    public function create(Request $request){
        $obj = new Lotes();
        $obj->id_referencia     = $request->id_referencia;
        $obj->numero_lote   	= $request->numero_lote;
        $obj->fecha_vence_lote  = $request->fecha_vence_lote;
        $obj->ubicacion   		= $request->ubicacion;
        $obj->serial            = $request->serial;
        $obj->cantidad          = $request->cantidad;
        $obj->sucursal          = Session::get('sucursal');
        $obj->id_empresa	= Session::get('id_empresa');
        $obj->save();
        return redirect('/inventario/lotes');
    }

    public function update(Request $request){
        $obj = Lotes::where('id',$request->id)->first();
        $obj->id_referencia     = $request->id_referencia;
        $obj->numero_lote  	 	= $request->numero_lote;
        $obj->fecha_vence_lote  = $request->fecha_vence_lote;
        $obj->ubicacion   		= $request->ubicacion;
        $obj->serial            = $request->serial;
        $obj->cantidad          = $request->cantidad;
        $obj->sucursal          = Session::get('sucursal');
        $obj->id_empresa	= Session::get('id_empresa');
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Lotes::where('id_empresa','=',Session::get('id_empresa'))
        ->where('id','=',$id)->first();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Lotes::where('id_empresa','=',Session::get('id_empresa'))
        ->where('id','=',$id)->first();
        $obj->delete();
        return redirect('/inventario/lotes');
    }

    public function all(){
        $obj = Lotes::where('id_empresa','=',Session::get('id_empresa'))->get();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Lotes::where('id_empresa','=',Session::get('id_empresa'))->get();
        return view('inventario.lotes', [
            'lotes' => $objs]);
    }
}
