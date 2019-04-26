<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index(){
    	return view('contabilidad.cuentas');
    }
}
