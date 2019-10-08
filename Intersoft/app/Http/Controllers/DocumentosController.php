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

    public function update(Request $request){
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
    
    public function showone($id){
        $obj = Documentos::find($id);
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Documentos::find($id);
        $obj->delete();
        return redirect('/inventario/documentos');
    }

    public function all(){
        $obj = Documentos::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Documentos::all();
        return view('inventario.documentos', [
            'documentos' => $objs]);
    }

}
