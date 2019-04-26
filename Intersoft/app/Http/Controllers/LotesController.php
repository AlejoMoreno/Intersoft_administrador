<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lotes;

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
        $obj->save();
        return $obj;
    }
    
    public function showone($id){
        $obj = Lotes::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Lotes::find($id);
        $obj->delete();
        return redirect('/inventario/lotes');
    }

    public function all(){
        $obj = Lotes::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Lotes::all();
        return view('inventario.lotes', [
            'lotes' => $objs]);
    }
}
