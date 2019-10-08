<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuentas;

class CuentasController extends Controller
{
	/**
	clase
nombreClase
grupo
nombreGrupo
cuenta
nombreCuenta
subcuenta
nombreSubcuenta
auxiliar
nombreAuxiliar
homologo
homologo_1
	*/

    public function create(Request $request){
        $obj = new Cuentas();
        $obj->clase = $request->clase;
		$obj->nombreClase = $request->nombreClase;
		$obj->grupo = $request->grupo;
		$obj->nombreGrupo = $request->nombreGrupo;
		$obj->cuenta = $request->cuenta;
		$obj->nombreCuenta = $request->nombreCuenta;
		$obj->subcuenta = $request->subcuenta;
		$obj->nombreSubcuenta = $request->nombreSubcuenta;
		$obj->auxiliar = $request->auxiliar;
		$obj->nombreAuxiliar = $request->nombreAuxiliar;
		$obj->homologo = $request->homologo;
		$obj->homologo_1 = $request->homologo_1;
        $obj->save();
        return view('contabilidad.cuentas', [
            'cuentas' => $obj]);
    }

    public function update(Request $request){
        $obj = Cuentas::where('id',$request->id)->first();
        $obj->clase = $request->clase;
		$obj->nombreClase = $request->nombreClase;
		$obj->grupo = $request->grupo;
		$obj->nombreGrupo = $request->nombreGrupo;
		$obj->cuenta = $request->cuenta;
		$obj->nombreCuenta = $request->nombreCuenta;
		$obj->subcuenta = $request->subcuenta;
		$obj->nombreSubcuenta = $request->nombreSubcuenta;
		$obj->auxiliar = $request->auxiliar;
		$obj->nombreAuxiliar = $request->nombreAuxiliar;
		$obj->homologo = $request->homologo;
		$obj->homologo_1 = $request->homologo_1;
        $obj->save();
        return $obj;
    }
    
    public function buscarCuentas(Request $request){
        $obj = Cuentas::where('clase','=',$request->clase)
                        ->where('grupo','=',$request->grupo)
                        ->where('cuenta','=',$request->cuenta)
                        ->where('subcuenta','=',$request->subcuenta)
                        ->where('auxiliar','=',$request->auxiliar)->get();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function delete($id){
        $obj = Cuentas::find($id);
        $obj->delete();
        return redirect('/contabilidad/cuentas');
    }

    public function all(){
        $obj = Cuentas::all();
        return  array(
            "result"=>"success",
            "body"=>$obj);
    }

    public function index(){
        $objs = Cuentas::first();
        return view('contabilidad.cuentas', [
            'cuentas' => $objs]);
    }
}
