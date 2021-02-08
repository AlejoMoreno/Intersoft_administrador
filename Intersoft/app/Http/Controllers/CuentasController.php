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
        $auxiliares = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->orderBy('codigo','asc')->take(10)->get();
        //foreach ($auxiliares as $auxiliar){
          //  $auxiliar->id_subcuenta = Pucsubcuentas::where('id','=',$auxiliar->id_subcuenta)->first();
            /*$auxiliar->id_subcuenta->id_cuenta = Puccuentas::where('id','=',$auxiliar->id_subcuenta->id_cuenta)->fisrt();
            $auxiliar->id_subcuenta->id_cuenta->id_grupo = Pucgrupo::where('id','=',$auxiliar->id_subcuenta->id_cuenta->id_grupo)->fisrt();
            $auxiliar->id_subcuenta->id_cuenta->id_grupo->id_clase = Pucclase::where('id','=',$auxiliar->id_subcuenta->id_cuenta->id_grupo->id_clase)->fisrt();*/
        //}
        return view('contabilidad.cuentas', 
                ['auxiliares' => $auxiliares]);
    }

    public function create(Request $request){
        $auxiliar = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
          ->where('codigo','=',$request->codigo)
          ->first();
        if(sizeof($auxiliar)==0){
          $auxiliar1 = new Pucauxiliar();
          $auxiliar1->id_pucsubcuentas = $request->pucsubcuentas;
          $auxiliar1->tipo             = $request->tipo;
          $auxiliar1->naturaleza       = $request->naturaleza;
          $auxiliar1->clase            = $request->clase;
          $auxiliar1->codigo           = $request->codigo;
          $auxiliar1->descripcion      = $request->descripcion;
          $auxiliar1->homologo         = $request->codigo;
          $auxiliar1->id_empresa       = Session::get('id_empresa');
          $auxiliar1->exogena          = $request->exogena;
          $auxiliar1->na               = $request->na;
          $auxiliar1->save();
        }
        else{
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
        }
        

        return redirect('/contabilidad/cuentas');
    }

    public function update(Request $request){
      $auxiliar = Pucauxiliar::where('id','=',$request->id)->first();
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

  public function buscarCodigo(Request $request){
    $puc = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
      ->where('codigo','=',$request->codigo)
      ->first();
    if(sizeof($puc)!=0){
      return  array(
        "result"=>"success",
        "body"=>"codigo contable cargado",
        "puc"=>$puc);
    }
    return  array(
      "result"=>"fail",
      "body"=>"No coincide codigo contable",
      "puc"=>null);
  }
}
