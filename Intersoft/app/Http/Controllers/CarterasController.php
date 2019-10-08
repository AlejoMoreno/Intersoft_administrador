<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carteras;
use App\Facturas;
use App\Directorios;
use App\KardexCarteras;
use App\Sucursales;
use App\Empresas;
use App\Documentos;
use App\Usuarios;
use App\Ciudades;

use Session;

class CarterasController extends Controller
{
    
	public function save(Request $request){

		$obj = new Carteras();
		$obj->reteiva 		= $request->reteiva;
		$obj->reteica 		= $request->reteica;
		$obj->efectivo 		= $request->efectivo;
		$obj->sobrecosto 	= $request->sobrecosto;
		$obj->descuento 	= $request->descuento;
		$obj->retefuente 	= $request->retefuente;
		$obj->otros 		= $request->otros;
		$obj->id_sucursal 	= Session::get('sucursal');
		$obj->numero 		= $request->numero;
		$obj->prefijo 		= $request->prefijo;
		$obj->id_cliente 	= $request->id_cliente;
		$obj->id_vendedor 	= $request->id_vendedor;
		$obj->fecha 		= $request->fecha;
		$obj->tipoCartera 	= $request->tipoCartera;
		$obj->subtotal 		= $request->subtotal;
		$obj->total 		= $request->total;
		$obj->id_modificado = $request->id_modificado;
		$obj->observaciones = $request->observaciones;
		$obj->id_empresa = Session::get('id_empresa');
		$obj->estado 		= $request->estado;
		$obj->save();


		return array(
			"result"=>"success",
            "body"=>$obj
		);

	}

	public function imprimir($id){
		$carteras = Carteras::where('id',$id)->get()[0];
    	$kardexCarteras = KardexCarteras::where('id_cartera','=',$carteras->id)->get();

    	$carteras->id_sucursal = Sucursales::where('id',$carteras->id_sucursal)->get();
    	foreach ($carteras->id_sucursal as $sucursal) {
    		$sucursal->id_empresa = Empresas::where('id',$sucursal->id_empresa)->get()[0];
    	}
        $carteras->id_vendedor = Usuarios::where('id',$carteras->id_vendedor)->get()[0];
    	$carteras->id_cliente = Directorios::where('id',$carteras->id_cliente)->get();
    	foreach($carteras->id_cliente as $cliente){
    		$cliente->id_ciudad = Ciudades::where('id',$cliente->id_ciudad)->get()[0];
    	}

		return view('cartera.imprimir',[
			"carteras"=>$carteras,
			"kardexCarteras"=>$kardexCarteras
		]);
	}

	public function egresos(){
		return view('cartera.egresos');
	}

	public function ingresos(){
		return view('cartera.ingresos');
	}

	public function causar(){
		return view('cartera.causar');
	}

	public function allDocumentos($id,Request $request){
		if($request->tipo == "egreso"){
			$facturas = Facturas::where('id_cliente',$id)->where('signo','=','+')->where('saldo','>','0')->orderBy('fecha_vencimiento', 'asc')->get();
		}
		else{
			$facturas = Facturas::where('id_cliente',$id)->where('signo','=','-')->where('saldo','>','0')->orderBy('fecha_vencimiento', 'asc')->get();
		}

		/*foreach ($facturas as $factura) {
			$factura->id_cliente = Directorios::where('id',$factura->id_cliente)->get()[0];
		}*/

		return array(
			"result"=>"success",
            "body"=>$facturas
		);
	}
	

}
