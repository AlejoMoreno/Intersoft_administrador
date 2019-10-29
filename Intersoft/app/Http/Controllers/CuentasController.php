<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuentas;
use Session;

use App\Pucauxiliar;
use App\Pucclases;
use App\Puccuentas;
use App\Pucgrupos;
use App\Pucsubcuentas;

use App\Empresas;

class CuentasController extends Controller
{
	public function index(){
        $pucsubcuentas = Pucsubcuentas::all();
        $auxiliares = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->orderBy('codigo','asc')->get();
        //foreach ($auxiliares as $auxiliar){
          //  $auxiliar->id_subcuenta = Pucsubcuentas::where('id','=',$auxiliar->id_subcuenta)->first();
            /*$auxiliar->id_subcuenta->id_cuenta = Puccuentas::where('id','=',$auxiliar->id_subcuenta->id_cuenta)->fisrt();
            $auxiliar->id_subcuenta->id_cuenta->id_grupo = Pucgrupo::where('id','=',$auxiliar->id_subcuenta->id_cuenta->id_grupo)->fisrt();
            $auxiliar->id_subcuenta->id_cuenta->id_grupo->id_clase = Pucclase::where('id','=',$auxiliar->id_subcuenta->id_cuenta->id_grupo->id_clase)->fisrt();*/
        //}
        return view('contabilidad.cuentas', 
                ['auxiliares' => $auxiliares,
                'pucsubcuentas' => $pucsubcuentas]);
    }

    public function create(Request $request){
        $auxiliar = new Pucauxiliar();
        $auxiliar->id_pucsubcuentas = $request->pucsubcuentas;
        $auxiliar->tipo             = $request->tipo;
        $auxiliar->naturaleza       = $request->naturaleza;
        $auxiliar->clase            = $request->clase;
        $auxiliar->codigo           = $request->codigo;
        $auxiliar->descripcion      = $request->descripcion;
        $auxiliar->homologo         = $request->codigo;
        $auxiliar->id_empresa       = Session::get('id_empresa');
        $auxiliar->exogena          = $request->exogena;
        $auxiliar->na               = $request->na;
        $auxiliar->save();

        return redirect('/contabilidad/cuentas');
    }

    public function copiarPrimeraVez(){
        
    }
}
