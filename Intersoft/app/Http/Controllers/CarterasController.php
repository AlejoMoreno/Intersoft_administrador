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
use App\FormaPagos;

use Session;

class CarterasController extends Controller
{
    
	public function save(Request $request){

		$cartera = Carteras::where('id_empresa','=',Session::get('id_empresa'))->orderBy('numero','desc')->first();

		$obj = new Carteras();
		$obj->reteiva 		= $request->reteiva;
		$obj->reteica 		= $request->reteica;
		$obj->efectivo 		= $request->efectivo;
		$obj->sobrecosto 	= $request->sobrecosto;
		$obj->descuento 	= $request->descuento;
		$obj->retefuente 	= $request->retefuente;
		$obj->otros 		= $request->otros;
		$obj->id_sucursal 	= Session::get('sucursal');
		$obj->numero 		= $cartera->numero + 1;
		$obj->prefijo 		= $cartera->prefijo;
		$obj->id_cliente 	= $request->id_cliente;
		$obj->id_vendedor 	= $request->id_vendedor;
		$obj->fecha 		= $request->fecha;
		$obj->tipoCartera 	= $request->tipoCartera;
		$obj->subtotal 		= $request->subtotal;
		$obj->total 		= $request->total;
		$obj->id_modificado = Session::get('user_id');
		$obj->observaciones = $request->observaciones;
		$obj->id_empresa = Session::get('id_empresa');
		$obj->estado 		= $request->estado;
		$obj->save();

		return array(
			"result"=>"success",
            "body"=>$obj
		);

	}

	public function saveFormaPagos(Request $request){
		$obj = new FormaPagos();
		$obj->id_empresa = Session::get('id_empresa');
		$obj->formaPago = $request->formaPago;
		$obj->id_cartera = $request->id_cartera;
		$obj->valor = $request->valor;
		$obj->observacion = $request->observacion;
		$obj->save();
		return array(
			"reault"=>"success",
			"body"=>$obj
		);
	}

	public function imprimir($id){
		$carteras = Carteras::where('id',$id)->
							  where('id_empresa','=',Session::get('id_empresa'))->get()[0];
		$kardexCarteras = KardexCarteras::where('id_cartera','=',$carteras->id)->
										  where('id_empresa','=',Session::get('id_empresa'))->get();

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

	public function consultar_documentos(Request $request){
		$carteras = Carteras::where('tipoCartera', '=', $request->tipo)->
							  where('id_empresa','=',Session::get('id_empresa'))->get();
		return view('cartera.consultar_documentos', [
			"carteras"=>$carteras
		]);
	}

	public function anular($id){ 
		$cartera = Carteras::where('id', '=', $id)->
							 where('id_empresa','=',Session::get('id_empresa'))->first();
		$cartera->estado = "ANULADO";
        $cartera->id_modificado = Session::get('user_id');
        $kardex = KardexCarteras::where('id_cartera',$cartera->id)->get();
        foreach ($kardex as $obj) {
			$factura = Facturas::where('id', '=', $obj->id_factura)->
							     where('id_empresa','=',Session::get('id_empresa'))->first();
            if($cartera->tipoCartera == 'INGRESO'){
                $factura->saldo = $factura->saldo - $obj->total;
            }
            else if($cartera->tipoCartera == 'EGRESO'){
                $factura->saldo = $factura->saldo + $obj->total;
            }
            $factura->save();
            $obj->delete();           
        }
        $cartera->save();
        return array(
            "result" => "Correcto",
            "mensaje" => "El documento fue anulado en su totalidad"
        );
	}

	public function eliminar($id){ 
		$cartera = Carteras::where('id', '=', $id)->
							 where('id_empresa','=',Session::get('id_empresa'))->first();
		if($cartera->estado != "ANULADO"){
			return array(
	            "result" => "Correcto",
	            "mensaje" => "El documento No fue eliminado, ya que debe estar anulado"
	        );
		}
		else{
			$cartera->delete();
			return array(
	            "result" => "Correcto",
	            "mensaje" => "El documento fue eliminado"
	        );
		}	
        
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
			$facturas = Facturas::where('id_cliente',$id)->
								  where('signo','=','+')->
								  where('saldo','>','0')->
								  where('id_empresa','=',Session::get('id_empresa'))->
								  where('estado','!=','ANULADO')->
								  where('estado','!=','ELIMINADO')->orderBy('fecha_vencimiento', 'asc')->get();
		}
		else{
			$facturas = Facturas::where('id_cliente',$id)->
								  where('signo','=','-')->
								  where('saldo','>','0')->
								  where('id_empresa','=',Session::get('id_empresa'))->
								  where('estado','!=','ANULADO')->
								  where('estado','!=','ELIMINADO')->orderBy('fecha_vencimiento', 'asc')->get();
		}

		/*foreach ($facturas as $factura) {
			$factura->id_cliente = Directorios::where('id',$factura->id_cliente)->get()[0];
		}*/

		return array(
			"result"=>"success",
            "body"=>$facturas
		);
	}

	function gastosindex(){
		return view('cartera.gastos');
	}

	function otrosingresosindex(){
		return view('cartera.otrosingresos');
	}

	function extracto(){
		$carteraproveedor = Directorios::where('id_directorio_tipo_tercero', '=', '1')
							->join('facturas', 'directorio.id', '=', 'facturas.id_cliente')
							->where('facturas.id_empresa','=',Session::get('id_empresa'))
							->where('saldo','>','0')
							->get();
		return view('cartera.extracto', array(
			"carteraproveedor"=>$carteraproveedor
		));
	}
	

}
