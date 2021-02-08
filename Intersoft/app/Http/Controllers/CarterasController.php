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
use App\Tipopagos;
use App\Cierrecarterasaldos;
use App\Causaciones;
use App\Contabilidades;
use App\Pucauxiliar;
use App\Otrosingresos;
use App\Gastocontados;

use PDF;
use DB;

use Session;

class CarterasController extends Controller
{
    
	public function save(Request $request){

		$cartera = Carteras::where('id_empresa','=',Session::get('id_empresa'))->orderBy('numero','desc')->first();

		if($request->tipoCartera == "GASTOS"){
			$id_cliente = Directorios::where('id_empresa','=',Session::get('id_empresa'))->first();
		}
		else{
			$id_cliente = Directorios::where('id_empresa','=',Session::get('id_empresa'))->where('nit',$request->id_cliente)->first();
		}
		
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
		$obj->id_cliente 	= $id_cliente->id;
		$obj->id_vendedor 	= Session::get('user_id');
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
		//guardar contabilidad
		//saber cual tipo pago fue la forma de pago
		$tipopago = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->where('id','=',$obj->formaPago)->first();
		//saber si es ingreso o egreso
		$cartera = Carteras::where('id','=',$obj->id_cartera)->first();
		if($cartera->tipoCartera == 'EGRESO'){
			$auxiliar = $tipopago->puc_compra;
			$naturaleza = 'D';
			$credito = $obj->valor;
			$tipo_doc = 1;
			$aux = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->where('codigo','=','22050501')->first();
			//contra partida
			$contabilidad = new Contabilidades();     
			$contabilidad->numero_documento = $cartera->numero;
			$contabilidad->id_auxiliar = $aux->id;
			$contabilidad->tipo_documento = $tipo_doc;
			$contabilidad->id_documento = $request->id_cartera;
			$contabilidad->prefijo = $cartera->prefijo;
			$contabilidad->fecha_documento = $cartera->fecha;
			$contabilidad->valor_transaccion = $obj->valor;
			$contabilidad->tipo_transaccion = 'C';
			$contabilidad->tercero = $cartera->id_cliente;
			$contabilidad->id_sucursal = Session::get('sucursal');
			$contabilidad->id_empresa = Session::get('id_empresa');
			$contabilidad->save();
		}
		else if($cartera->tipoCartera == 'INGRESO'){
			$auxiliar = $tipopago->puc_cuenta;
			$debito = $obj->valor;
			$naturaleza = 'C';
			$tipo_doc = 2;
			$aux = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))->where('codigo','=','13050501')->first();
			//contra partida
			$contabilidad1 = new Contabilidades();     
			$contabilidad1->numero_documento = $cartera->numero;
			$contabilidad1->id_auxiliar = $aux->id;
			$contabilidad1->tipo_documento = $tipo_doc;
			$contabilidad1->id_documento = $request->id_cartera;
			$contabilidad1->prefijo = $cartera->prefijo;
			$contabilidad1->fecha_documento = $cartera->fecha;
			$contabilidad1->valor_transaccion = $obj->valor;
			$contabilidad1->tipo_transaccion = 'D';
			$contabilidad1->tercero = $cartera->id_cliente;
			$contabilidad1->id_sucursal = Session::get('sucursal');
			$contabilidad1->id_empresa = Session::get('id_empresa');
			$contabilidad1->save();
		}
		else if($cartera->tipoCartera == 'GASTOS'){
			$auxiliar = $tipopago->puc_compra;
			$naturaleza = 'D';
			$credito = $obj->valor;
			$tipo_doc = 1;
			//saber cual es el gasto que se genero
			$kardexcartera = KardexCarteras::where('id_empresa','=',Session::get('id_empresa'))->where('id_cartera','=',$cartera->id)->first();
			$gasto = Gastocontados::where('id_empresa','=',Session::get('id_empresa'))->where('prefijo','=',explode('|',$kardexcartera->numeroFactura)[0])->where('numero','=',explode('|',$kardexcartera->numeroFactura)[1])->get();
			foreach($gasto as $gastocontado){
				$contabilidad = new Contabilidades();     
				$contabilidad->numero_documento = $cartera->numero;
				$contabilidad->id_auxiliar = $gastocontado->id_auxiliar;
				$contabilidad->tipo_documento = $tipo_doc;
				$contabilidad->id_documento = $request->id_cartera;
				$contabilidad->prefijo = $cartera->prefijo;
				$contabilidad->fecha_documento = $gastocontado->fecha_egreso;
				$contabilidad->valor_transaccion = $gastocontado->valor;
				$contabilidad->tipo_transaccion = $gastocontado->naturaleza;
				$contabilidad->tercero = $gastocontado->id_tercero;
				$contabilidad->id_sucursal = Session::get('sucursal');
				$contabilidad->id_empresa = Session::get('id_empresa');
				$contabilidad->save();
			}
			
		}
		else if($cartera->tipoCartera == 'OTROINGRESO'){
			$auxiliar = $tipopago->puc_cuenta;
			$debito = $obj->valor;
			$naturaleza = 'C';
			$tipo_doc = 2;
			//saber cual es el gasto que se genero
			$kardexcartera = KardexCarteras::where('id_empresa','=',Session::get('id_empresa'))->where('id_cartera','=',$cartera->id)->first();
			$ingreso = Otrosingresos::where('id_empresa','=',Session::get('id_empresa'))->where('prefijo','=',explode('|',$kardexcartera->numeroFactura)[0])->where('numero','=',explode('|',$kardexcartera->numeroFactura)[1])->get();
			foreach($ingreso as $otrosing){
				$contabilidad = new Contabilidades();     
				$contabilidad->numero_documento = $cartera->numero;
				$contabilidad->id_auxiliar = $otrosing->id_auxiliar;
				$contabilidad->tipo_documento = $tipo_doc;
				$contabilidad->id_documento = $request->id_cartera;
				$contabilidad->prefijo = $cartera->prefijo;
				$contabilidad->fecha_documento = $otrosing->fecha;
				$contabilidad->valor_transaccion = $otrosing->valor;
				$contabilidad->tipo_transaccion = $otrosing->naturaleza;
				$contabilidad->tercero = $otrosing->id_tercero;
				$contabilidad->id_sucursal = Session::get('sucursal');
				$contabilidad->id_empresa = Session::get('id_empresa');
				$contabilidad->save();
			}
		}
		else{
			$auxiliar = $tipopago->puc_cuenta;
			$debito = $obj->valor;
			$naturaleza = 'D';
			$tipo_doc = 2;
		}
		
		$contabilidad = new Contabilidades();     
		$contabilidad->numero_documento = $cartera->numero;
		$contabilidad->id_auxiliar = $auxiliar;
		$contabilidad->tipo_documento = $tipo_doc;
		$contabilidad->id_documento = $request->id_cartera;
		$contabilidad->prefijo = $cartera->prefijo;
		$contabilidad->fecha_documento = $cartera->fecha;
		$contabilidad->valor_transaccion = $obj->valor;
		$contabilidad->tipo_transaccion = $naturaleza;
		$contabilidad->tercero = $cartera->id_cliente;
		$contabilidad->id_sucursal = Session::get('sucursal');
		$contabilidad->id_empresa = Session::get('id_empresa');
		$contabilidad->save();

		
		return array(
			"reault"=>"success",
			"body"=>$obj
		);
	}

	public function imprimir($id){
		$carteras = Carteras::where('id',$id)->
							  where('id_empresa','=',Session::get('id_empresa'))->first();
		$kardexCarteras = KardexCarteras::where('id_cartera','=',$carteras->id)->
										  where('id_empresa','=',Session::get('id_empresa'))->get();

    	$carteras->id_sucursal = Sucursales::where('id',$carteras->id_sucursal)->first();
    	$carteras->id_sucursal->id_empresa = Empresas::where('id',$carteras->id_sucursal->id_empresa)->first();
        $carteras->id_vendedor = Usuarios::where('id',$carteras->id_vendedor)->first();
    	$carteras->id_cliente = Directorios::where('id',$carteras->id_cliente)->first();
		$carteras->id_cliente->id_ciudad = Ciudades::where('id',$carteras->id_cliente->id_ciudad)->first();
		foreach($kardexCarteras as $obj){
			$obj->id_factura = Facturas::where('id','=',$obj->id_factura)->first();
		}
		//dd($carteras->id_sucursal->id_empresa);
		/*$pdf = PDF::loadView('cartera.imprimir', [
            "carteras"=>$carteras,
			"kardexCarteras"=>$kardexCarteras
        ]);//->setPaper($customPaper, 'landscape');
        return $pdf->download($carteras->tipoCartera.'-'.$carteras->prefijo.'-'.$carteras->numero.'.pdf');
			*/
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
		$documento = Carteras::where('id_empresa','=',Session::get('id_empresa'))->where('tipoCartera','=','EGRESO')->orderBy('numero','desc')->first();
		return view('cartera.egresos',[
			"documento"=>$documento
		]);
	}

	public function ingresos(){
		$documento = Carteras::where('id_empresa','=',Session::get('id_empresa'))->where('tipoCartera','=','INGRESO')->orderBy('numero','desc')->first();
		return view('cartera.ingresos',[
			"documento"=>$documento
		]);
	}

	public function causar(){
		return view('cartera.causar');
	}

	public function allDocumentos($id,Request $request){
		if($request->tipo == "egreso"){
			$tercero = Directorios::where('id_directorio_tipo_tercero', '=', '1')->
								  where('nit','=',$id)->first();
			$facturas = Facturas::where('id_cliente',$tercero->id)->
								  where('signo','=','+')->
								  where('saldo','>','0')->
								  where('id_empresa','=',Session::get('id_empresa'))->
								  where('estado','!=','ANULADO')->
								  where('estado','!=','ELIMINADO')->orderBy('fecha_vencimiento', 'asc')->get();
		}
		else{
			$tercero = Directorios::where('id_directorio_tipo_tercero', '=', '2')->
								  where('nit','=',$id)->first();
			$facturas = Facturas::where('id_cliente',$tercero->id)->
								  where('signo','=','-')->
								  where('saldo','>','0')->orderBy('fecha_vencimiento', 'asc')->
								  get();  
		}
		//dd($tercero);

		/*foreach ($facturas as $factura) {
			$factura->id_cliente = Directorios::where('id',$factura->id_cliente)->get()[0];
		}*/

		return array(
			"result"=>"success",
            "body"=>$facturas
		);
	}

	function gastosindex(){
		$tipo_pagos = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
		return view('cartera.gastos',[
			"tipo_pagos"=>$tipo_pagos
		]);
	}

	function otrosingresosindex(){
		$tipo_pagos = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();
		return view('cartera.otrosingresos',[
			"tipo_pagos"=>$tipo_pagos
		]);
	}

	function castigarcartera(Request $request){
		$totalcarteraProveedor=null;
		$totalcarteracliente=null;
		$cartera = Directorios::select('facturas.*','directorios.*','usuarios.*',
						DB::raw('facturas.id as idfactura'),
						DB::raw('directorios.id as idcliente'))
					->join('facturas', 'directorios.id', '=', 'facturas.id_cliente')
					->join('usuarios', 'facturas.id_vendedor', '=', 'usuarios.id')
					->where('facturas.id_empresa','=',Session::get('id_empresa'))
					->where('saldo','!=','0')
					->where(function ($q) use ($request) {
						if(isset($request->tipo_informe)){
							$q->where('directorios.id_directorio_tipo_tercero','=',$request->tipo_informe);
						}
						if(isset($request->nit)){
							$q->where('directorios.nit','=',$request->nit);
						}
						if(isset($request->razonsocial)){
							$q->where('directorios.razon_social','like','%'.$request->razonsocial.'%');                  
						}
						if(isset($request->fechafinal)){
							$q->where('facturas.fecha','<=',$request->fechafinal);
						}
					})
					->orderBy('directorios.razon_social','asc')
					->get();
		
		return view('cartera.castigarcartera', array(
			"cartera"=>$cartera
		));
	}

	function extracto($id_cliente, $fecha){

		/**
		 * SELECT facturas.id as idfactura, facturas.id_cliente as cliente, 
		 * facturas.numero as fnumero, facturas.prefijo as fprefijo, 
		 * facturas.total, facturas.signo, carteras.id as idcartera, 
		 * carteras.numero as cnumero, carteras.prefijo as cprefijo, 
		 * carteras.total as totalcartera FROM facturas 
		 * INNER JOIN carteras on carteras.id_cliente = facturas.id_cliente 
		 * where facturas.id_cliente = 50638
		 */

		$docs = Facturas::select(DB::raw('facturas.id as idfactura'), DB::raw('kardex_carteras.id_factura as carterafactura'),
					DB::raw('facturas.id_cliente as cliente'), DB::raw('facturas.id_documento as id_documento'), 
					DB::raw('facturas.numero as fnumero'), DB::raw('facturas.prefijo as fprefijo'), 
					DB::raw('facturas.total'), DB::raw('kardex_carteras.total as totalkardexcartera'),
					DB::raw('facturas.signo'),  DB::raw('carteras.tipoCartera as tipoCartera'), DB::raw('carteras.id as idcartera'), 
					DB::raw('carteras.numero as cnumero'), DB::raw('carteras.prefijo as cprefijo'), 
					DB::raw('carteras.total as totalcartera'))
				->leftJoin('kardex_carteras', 'kardex_carteras.id_factura', '=', 'facturas.id')
				->leftJoin('carteras', 'carteras.id', '=', 'kardex_carteras.id_cartera')
				->where('facturas.id_empresa','=',Session::get('id_empresa'))
				->where('facturas.id_cliente','=',$id_cliente)
				->where('facturas.fecha', '<', $fecha)
				->orderBy('facturas.fecha','desc')
				->take(100)
				->get();
		
		foreach($docs as $doc){
			$doc->cliente = Directorios::where('id','=',$doc->cliente)->first();
			$doc->id_documento = Documentos::where('id','=',$doc->id_documento)->first();
		}

		$cierres = Cierrecarterasaldos::select('fecha')
			->groupBy('fecha')
			->where('id_empresa','=',Session::get('id_empresa'))
			->get();
		$sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))->get();
			
		return view('cartera.extracto', array(
			"docs"=>$docs,
			"fecha"=>$fecha,
			"cierres"=>$cierres,
			"sucursales"=>$sucursales
		));
	}

	function extractoindex(Request $request){
		$sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))->get();
		$cierres = Cierrecarterasaldos::select('fecha')
			->groupBy('fecha')
			->where('id_empresa','=',Session::get('id_empresa'))
			->get();
		$cliente = null;
		$saldos = null;
		$carteras = null;
		$facturas = null;
		if(isset($request->id_cliente)){
			$cliente = Directorios::where('id','=',$request->id_cliente)->first();
			$saldos = Cierrecarterasaldos::where('id_tercero','=',$cliente->id)->where('fecha','=',$request->fecha_corte)->first();

			$carteras = KardexCarteras::select('kardex_carteras.*','carteras.*','kardex_carteras.total as totalkard')
				->where('carteras.id_empresa','=',Session::get('id_empresa'))
				->join('carteras','carteras.id','=','kardex_carteras.id_cartera')
				->where('fecha','>',$request->fecha_corte)
				->where('carteras.id_cliente','=',$cliente->id)
				->get();

			$facturas = Facturas::where('id_empresa','=',Session::get('id_empresa'))
				->where('fecha','>',$request->fecha_corte)
				->where('id_cliente','=',$cliente->id)
				->get();
				foreach($facturas as $factura){
					$factura->id_documento = Documentos::where('id','=',$factura->id_documento)->first();
				}
		}

		return view('cartera.extracto', array(
			"cierres"=>$cierres,
			"sucursales"=>$sucursales,
			"cliente"=>$cliente,
			"saldos"=>$saldos,
			"carteras"=>$carteras,
			"facturas"=>$facturas
		));
	}

	function historial($idtercero){
		$carteracliente = Directorios::where('id_directorio_tipo_tercero', '=', '2')
							->select('facturas.*','directorios.*','usuarios.*',DB::raw('facturas.id as idfactura'))
							->join('facturas', 'directorios.id', '=', 'facturas.id_cliente')
							->join('usuarios', 'facturas.id_vendedor', '=', 'usuarios.id')
							->where('facturas.id_empresa','=',Session::get('id_empresa'))
							->where('directorios.id','=',$idtercero)
							->where('saldo','>','0')
							->get();
		$cartera = KardexCarteras::select('carteras.*','kardex_carteras.*',
								DB::raw('facturas.numero as numfactura'),
								DB::raw('facturas.id as idfactura'),
								DB::raw('carteras.id as idcartera'),
								DB::raw('kardex_carteras.total as carteratotal'),
								DB::raw('facturas.prefijo as prefijofactura'))
							->join('carteras', 'carteras.id', '=', 'kardex_carteras.id_cartera')
							->join('facturas', 'facturas.id', '=', 'kardex_carteras.id_factura')
							->where('carteras.id_empresa','=',Session::get('id_empresa'))
							->where('carteras.id_cliente','=',$idtercero)
							->get();
		return view('cartera.historial', array(
			"carteracliente"=>$carteracliente,
			"cartera"=>$cartera
		));
	}
	

	/**
     * FUNCIONES PARA SUBIR ARCHIVO PLANO
    */

    public function subirCarteras(Request $request){
        //GUARDAR ARCHIVO EN EL STORAGE
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));

        //RECORRER EL ARCHIVO EN EL STORAGE
        $public_path = public_path();
        $url = $public_path.'/storage/'.$nombre;
        //verificamos si el archivo existe y lo retornamos
        if (\Storage::exists($nombre))
        {
            $numlinea = 0;
            $archivo = fopen($url,'r');
            //recorrer cada linea
            while ($linea = fgets($archivo)) {
                $lineas[] = explode(',',$linea);  
                $numlinea++;
            }
            fclose($archivo);
        }

 
        return view('administrador.integracion',[
            "carteras"=>$lineas
        ]);
    }

    public function saveCarteras(Request $request){

        try{
			
			$tercero = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nit','=',$request->nit_tercero)
                            ->first();
            if($tercero==null){
                return array(
                    "result" => "Incorrecto",
                    "body" => "Tercero no existe"
                );
            }

            $cartera = Carteras::where('id_empresa','=',Session::get('id_empresa'))
				->where('numero','=',$request->numero)
                ->where('prefijo','=',$request->prefijo)
                ->where('id_cliente','=',$tercero->id)
                ->where('tipoCartera','=',$request->tipoCartera)
                ->get();
            if(sizeof($cartera)>0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "La Cartera ya existe en la base de datos"
                );
			}
                        
			
            $obj = new Carteras();
			$obj->reteiva 		= 0;
			$obj->reteica 		= 0;
			$obj->efectivo 		= $request->efectivo;
			$obj->sobrecosto 	= 0;
			$obj->descuento 	= 0;
			$obj->retefuente 	= 0;
			$obj->otros 		= 0;
			$obj->id_sucursal 	= Session::get('sucursal');
			$obj->numero 		= $request->numero;
			$obj->prefijo 		= $request->prefijo;
			$obj->id_cliente 	= $tercero->id;
			$obj->id_vendedor 	= Session::get('user_id');
			$obj->fecha 		= substr($request->fecha,0,4).'-'.substr($request->fecha,4,2).'-'.substr($request->fecha,6,2);
			$obj->tipoCartera 	= $request->tipoCartera;
			$obj->subtotal 		= 0;
			$obj->total 		= $request->total;
			$obj->id_modificado = Session::get('user_id');
			$obj->observaciones = "INTERCON";
			$obj->id_empresa = Session::get('id_empresa');
			$obj->estado 		= "ACTIVO";
			$obj->save();

            return array(
                "result" => "Correcto",
                "body" => "El documento fue SUBIDO en su totalidad"
            );
        }
        catch(Exception $exce){
            return array(
                "result" => "Incorrecto",
                "body" => $exce
            );
        }
	}
	
	function consultaTipo(Request $request, $tipo){

		$documento = Carteras::select(
			['carteras.*','directorios.*',
			'directorios.razon_social as nombre_cliente','directorios.nit as nit_cliente',
			'carteras.id as idcartera'])
					->join('directorios','directorios.id','=','id_cliente')
                    ->where('tipoCartera','=',$tipo)
                    ->where('carteras.id_empresa','=',Session::get('id_empresa'))
                    ->where(function ($q) use ($request) {
                        if(isset($request->nit)){
                            $q->where('id_tercero','=',$request->nit);
                        }
                        if(isset($request->razonsocial)){
                            $q->where('directorios.razon_social','like','%'.$request->razonsocial.'%');                  
                        }
                        if(isset($request->fechainicio)){
                            $q->whereBetween('fecha', [$request->fechainicio, $request->fechafinal]);
						}
						if(isset($request->prefijo)){
                            $q->where('prefijo', '=',$request->prefijo);
						}
						if(isset($request->numero)){
                            $q->where('numero', '=',$request->numero);
                        }
                    })
                    ->orderBy('carteras.id','desc')
                    ->take(100)
                    ->get();
        
        return view('cartera.consultaTipo', [
			'documento' => $documento,
			'tipo' => $tipo
        ]);
	}

	public function cierreCarteraStore(Request $request){
		try{
			$directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))->get();
			foreach($directorios as $directorio){
				if($directorio->id_directorio_tipo_tercero == 3){ //causacion
					$documento = Causaciones::select([DB::raw('SUM(saldo) as saldo')])
						->where('id_tercero','=',$directorio->id)
						->first();
				}
				else if($directorio->id_directorio_tipo_tercero == 2){ //cliente
					$documento = Facturas::select([DB::raw('SUM(saldo) as saldo')])
						->where('signo','=','-')
						->where('id_cliente','=',$directorio->id)
						->first();
						
				}
				else if($directorio->id_directorio_tipo_tercero == 1){ //proveedor
					$documento = Facturas::select([DB::raw('SUM(saldo) as saldo')])
						->where('signo','=','+')
						->where('id_cliente','=',$directorio->id)
						->first();
				}
				
				if($documento->saldo != null){
					//recorrer cartera y guardar saldos.
					$obj = new Cierrecarterasaldos();
					$obj->id_tercero = $directorio->id;
					$obj->fecha = $request->fecha;
					$obj->saldo = $documento->saldo;
					$obj->estado = 'ACTIVO';
					$obj->id_empresa = Session::get('id_empresa');
					$obj->save();
				}
			}
			
			$cierres = Cierrecarterasaldos::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
				->get();
			return view('cartera.cierrecartera',[
				"cierres"=>$cierres
			]); 
		}
		catch(Exception $exce){
			return array(
				"result" => "Incorrecto",
				"body" => $exce
			);
		}
	}

	public function verificarNumeracion(Request $request){
		$cartera = Carteras::where('id_empresa','=',Session::get('id_empresa'))
				->where('prefijo','=',$request->prefijo)
				->where('numero','=',$request->numero)
				->where('tipoCartera','=',$request->tipo)
				->first();
		if($cartera === null){
			return "DISPONIBLE";	
		}
		else{
			return "NODISPONIBLE";
		}
		
	}
	
	public function cierreCartera(){
		try{
			$cierres = Cierrecarterasaldos::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
				->get();
			return view('cartera.cierrecartera',[
				"cierres"=>$cierres
			]); 
		}
		catch(Exception $exce){
			return array(
				"result" => "Incorrecto",
				"body" => $exce
			);
		}
	}

}
