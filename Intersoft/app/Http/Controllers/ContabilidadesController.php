<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Pucauxiliar;
use App\Pucclases;
use App\Puccuentas;
use App\Pucgrupos;
use App\Pucsubcuentas;
use App\Directorios;
use App\Sucursales;
use App\Facturas;
use App\Kardex;
use App\KardexCarteras;
use App\Documentos;
use App\Lineas;
use App\Clasificaciones;
use App\Referencias;
use App\FormaPagos;
use App\Tipopagos;

use App\Empresas;
use App\Contabilidades;

use App\Cierrecontables;
use App\Cierreclases;
use App\Cierrecuentas;
use App\Cierregrupos;
use App\Cierresubcuentas;

use Excel;
use PDF;
use DB;

class ContabilidadesController extends Controller
{
    static function register($contabilidad){
        //verificar el consecutivo
        $contabilidad->save();
        return $contabilidad;
    }

    static function registerIva($contabilidad1, $signo, $iva, $cuenta){
        $contabilidad = new Contabilidades();        
        if($signo == '+'){
            $cuenta = $cuenta * 100;
            $cuenta = '240808'. $cuenta;
            $aux = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                              ->where('codigo','like',$cuenta)->first();
            $contabilidad->numero_consecutivo = $contabilidad1->numero_consecutivo;
            $contabilidad->id_auxiliar = $aux->id;
            $contabilidad->debito = 0;
            $contabilidad->credito = $iva;
            $contabilidad->tipo_documento = $contabilidad1->tipo_documento;
            $contabilidad->id_documento = $contabilidad1->id_documento;
            $contabilidad->id_sucursal = Session::get('sucursal');
            $contabilidad->id_empresa = Session::get('id_empresa');
        }
        else if($signo == '-'){
            $cuenta = $cuenta * 100;
            $cuenta = '240808'. $cuenta;
            $aux = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                              ->where('codigo','like', $cuenta)->first();
            $contabilidad->numero_consecutivo = $contabilidad1->numero_consecutivo;
            $contabilidad->id_auxiliar = $aux->id;
            $contabilidad->debito = $iva;
            $contabilidad->credito = 0;
            $contabilidad->tipo_documento = $contabilidad1->tipo_documento;
            $contabilidad->id_documento = $contabilidad1->id_documento;
            $contabilidad->id_sucursal = Session::get('sucursal');
            $contabilidad->id_empresa = Session::get('id_empresa');
        }
        $contabilidad->save();
        return $contabilidad;
    }

    public function librosauxiliaresIndex(Request $request){
        if($request->consultar == "consultar"){
            $data = Contabilidades::select('contabilidades.numero_documento','contabilidades.prefijo',
                'pucauxiliars.codigo','pucauxiliars.descripcion','contabilidades.tipo_documento','contabilidades.fecha_documento',
                'contabilidades.valor_transaccion','contabilidades.tipo_transaccion','directorios.razon_social','directorios.nit')
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('directorios','directorios.id','=','contabilidades.tercero')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->where(function ($q) use ($request) {
                    if(isset($request->cuenta_desde)){
                        $q->whereBetween('pucauxiliars.codigo', [$request->cuenta_desde, $request->cuenta_hasta]);
                    }
                    if(isset($request->fecha_desde)){
                        $q->whereBetween('contabilidades.fecha_documento', [$request->fecha_desde, $request->fecha_hasta]);
                    }
                })
                ->orderBy('pucauxiliars.codigo','asc')
                ->orderBy('directorios.nit','asc')
                ->get();
            return view('contabilidad.librosauxiliares', array(
                "data"=>$data
            ));
        }
        else{
            return view('contabilidad.librosauxiliares', array(
                "data"=>null
            ));
        }
        
    }
    
    public function librosmayoresIndex(Request $request){
        if($request->tipo == "CLASES"){
            $data = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total')
                ,'pucclases.codigo','pucclases.descripcion','contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->join('pucgrupos','pucgrupos.id','=','puccuentas.id_pucgrupos')
                ->join('pucclases','pucclases.id','=','pucgrupos.id_pucclases')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->groupBy('pucclases.codigo','pucclases.descripcion','contabilidades.tipo_transaccion')
                ->orderBy('pucclases.codigo','asc')
                ->get();
        }
        else if($request->tipo == "GRUPOS"){
            $data = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total')
                ,'pucgrupos.codigo','pucgrupos.descripcion','contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->join('pucgrupos','pucgrupos.id','=','puccuentas.id_pucgrupos')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->groupBy('pucgrupos.codigo','pucgrupos.descripcion','contabilidades.tipo_transaccion')
                ->orderBy('pucgrupos.codigo','asc')
                ->get();
        }
        else if($request->tipo == "CUENTAS"){
            $data = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total')
                ,'puccuentas.codigo','puccuentas.descripcion','contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->groupBy('puccuentas.codigo','puccuentas.descripcion','contabilidades.tipo_transaccion')
                ->orderBy('puccuentas.codigo','asc')
                ->get();
        }
        else if($request->tipo == "SUBCUENTAS"){
            $data = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total')
                ,'pucsubcuentas.codigo','pucsubcuentas.descripcion','contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->groupBy('pucsubcuentas.codigo','pucsubcuentas.descripcion','contabilidades.tipo_transaccion')
                ->orderBy('pucsubcuentas.codigo','asc')
                ->get();
        }
        else{
            $data = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total')
                ,'pucclases.codigo','pucclases.descripcion','contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->join('pucgrupos','pucgrupos.id','=','puccuentas.id_pucgrupos')
                ->join('pucclases','pucclases.id','=','pucgrupos.id_pucclases')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->groupBy('pucclases.codigo','pucclases.descripcion','contabilidades.tipo_transaccion')
                ->orderBy('pucclases.codigo','asc')
                ->get();
        }
        
        return view('contabilidad.librosmayores', array(
            "data"=>$data
        ));
    }

    public function getDocumentos($id, Request $request){
        $data = Contabilidades::select([
            DB::raw('count(*) as cantidad'),
            DB::raw('(select nombre from sucursales where id = contabilidades.id_sucursal) as id_sucursal'),
            'contabilidades.tipo_documento',
            'contabilidades.numero_documento',
            'contabilidades.fecha_documento',
            DB::raw('(select nit from directorios where id = contabilidades.tercero) as id_tercero'),
            DB::raw('(select razon_social from directorios where id = contabilidades.tercero) as tercero')])
            ->where('tipo_documento','=',$id)
            ->where('id_empresa','=',Session::get('id_empresa'))
            ->where('tipo_documento','=',$id)
            ->where(function ($q) use ($request) {
                if(isset($request->prefijo)){
                    $q->where('prefijo','=',$request->prefijo);
                }
                if(isset($request->numero)){
                    $q->where('numero_documento','=',$request->numero);
                }
                if(isset($request->desde)){
                    $q->whereBetween('fecha_documento',[$request->desde,$request->hasta]);
                }
            })
            ->groupBy(['id_empresa','id_sucursal','tipo_documento','numero_documento',
            'fecha_documento','id_tercero','tercero'])
            ->get();
        
        $documentos = Documentos::select(['id','nombre'])
                ->where('id_empresa','=',Session::get('id_empresa'))
                ->get();
        
        $auxiliares = Pucauxiliar::select(['id','codigo','descripcion'])
                ->where('id_empresa','=',Session::get('id_empresa'))
                ->get();

        if($id == 1){$nombre = "EGRESO";} if($id == 2){$nombre = "RECIBOS DE CAJA";}  
        if($id == 3){$nombre = "FACTURAS DE VENTA";} if($id == 4){$nombre = "FACTURAS DE COMPRA";}  
        if($id == 5){$nombre = "CAUSACIONES";} if($id == 6){$nombre = "DEPRECIACION";}  
        if($id == 7){$nombre = "NOTA DB";} if($id == 8){$nombre = "CONSIGNACION";}  
        if($id == 9){$nombre = "NOTA CR";}  if($id == 10){$nombre = "NOTA CONTABLE";}  
        if($id == 11){$nombre = "COMPROBANTE CIERRE CONTABLE";}  if($id == 12){$nombre = "INGRESO X CONSIGNACION";}  
        if($id == 13){$nombre = "SALIDA X CONSIGNACION";}   if($id == 14){$nombre = "INGRESO Y SALIDA DE PRODUCCION";}  
        if($id == 15){$nombre = "NOTA NITF";}  

        return view('contabilidad.doc.index',[
            'data' => $data,
            'nombre_tipo_documento' => $nombre,
            'documentos'=>$documentos,
            'auxiliares'=>$auxiliares
        ]);
    }

    public function viewComprobantes(Request $request){
        
        $contabilidades = Contabilidades::select('pucauxiliars.id','pucauxiliars.codigo',
                'pucauxiliars.descripcion','contabilidades.tipo_transaccion','directorios.razon_social',
                DB::raw('SUM(contabilidades.valor_transaccion) as valor_transaccion'))
                        ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                        ->where('numero_documento','=',$request->numero_documento)
                        ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                        ->join('directorios','directorios.id','=','contabilidades.tercero')
                        ->groupBy('pucauxiliars.id','pucauxiliars.codigo','pucauxiliars.descripcion','contabilidades.tipo_transaccion','directorios.razon_social')
                        ->get();
        return array(
            "contabilidades"=>$contabilidades
        );
    }

    public function deleteComprobantes(Request $request){
        $respuesta = "Ok";
        $contabilidad = Contabilidades::where('id','=',$request->id)->
                                        where('id_empresa','=',Session::get('id_empresa'))->
                                        where('id_sucursal','=',Session::get('sucursal'))->first();
        if(!$contabilidad->delete()){
            $respuesta = "ERROR";
        }
        $contabilidades = Contabilidades::where('id_empresa','=',Session::get('id_empresa'))->
                                          where('numero_documento','=',$contabilidad->numero_documento)->get();
        return array(
            "respuesta"=>$respuesta,
            "contabilidades"=>$contabilidades
        );
    }

    public function updateComprobantes(Request $request){
        $respuesta = "ERROR";
        $contabilidad = Contabilidades::where('id','=',$request->id)->
                                        where('id_empresa','=',Session::get('id_empresa'))->
                                        where('id_sucursal','=',Session::get('sucursal'))->first();
        $contabilidad->id_auxiliar = $request->id_auxiliar;
        $contabilidad->tipo_transaccion = $request->tipo_transaccion;
        $contabilidad->valor_transaccion = $request->valor_transaccion;
        $contabilidad->tercero = $request->tercero;
        if($contabilidad->save()){
            $respuesta = "Ok";
        }
        
        $contabilidades = Contabilidades::where('id_empresa','=',Session::get('id_empresa'))->
                                          where('numero_documento','=',$contabilidad->numero_documento)->get();
       return array(
            "respuesta"=>$respuesta,
            "contabilidades"=>$contabilidades
        );
    }
    public function createComprobantes(Request $request){
        $respuesta = "ERROR";
        $contabilidad = new Contabilidades();
        $contabilidad->tipo_documento = $request->tipo_documento;
        $contabilidad->id_sucursal = Session::get('sucursal');
        $contabilidad->id_documento = $request->id_documento;
        $contabilidad->numero_documento = $request->numero_documento;
        $contabilidad->prefijo = $request->prefijo;
        $contabilidad->fecha_documento = $request->fecha_documento;
        $contabilidad->valor_transaccion = $request->valor_transaccion;
        $contabilidad->tipo_transaccion = $request->tipo_transaccion;
        $contabilidad->tercero = $request->tercero;
        $contabilidad->id_auxiliar = $request->id_axiliar;
        $contabilidad->id_empresa = Session::get('id_empresa');
        $contabilidad->save();
        $respuesta = "Ok";
        $contabilidades = Contabilidades::where('id_empresa','=',Session::get('id_empresa'))->
                                          where('numero_documento','=',$contabilidad->numero_documento)->get();
        return array(
            "respuesta"=>$respuesta,
            "contabilidades"=>$contabilidades
        );
    }



    /**
     * Excel Reporte
     */
    public function exelComprobantesDiario(Request $request){
        
        $obj = DB::select("SELECT 
            contabilidades.tipo_documento as 'tipo_documento', 
            sucursales.nombre as 'sucursal', 
            contabilidades.numero_documento as 'numero_documento', 
            contabilidades.prefijo as 'prefijo', 
            contabilidades.valor_transaccion as 'valor_transaccion', 
            contabilidades.tipo_transaccion as 'tipo_transaccion', 
            pucauxiliars.codigo as 'cuenta', 
            pucauxiliars.descripcion as 'descripcion', 
            directorios.nit as 'tercero', 
            directorios.razon_social as 'razon_social', 
            contabilidades.fecha_documento as 'fecha_documento' 
            FROM `contabilidades` 
                JOIN sucursales ON contabilidades.id_sucursal = sucursales.id 
                JOIN pucauxiliars ON contabilidades.id_auxiliar = pucauxiliars.id 
                JOIN directorios ON contabilidades.tercero = directorios.id
            WHERE contabilidades.id_empresa = ".Session::get("id_empresa"));
        
        $data= json_decode( json_encode($obj), true);

        Excel::create('Comprobantes Diarios', function($excel) use($data) {
            $excel->sheet('Contabilidad', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');
    }

    /**
     * PDF reportes
     */
    public function pdf_comprobanteDiario(Request $request){
        $obj = DB::select("SELECT 
            contabilidades.tipo_documento as 'tipo_documento', 
            sucursales.nombre as 'sucursal', 
            contabilidades.numero_documento as 'numero_documento', 
            contabilidades.prefijo as 'prefijo', 
            contabilidades.valor_transaccion as 'valor_transaccion', 
            contabilidades.tipo_transaccion as 'tipo_transaccion', 
            pucauxiliars.codigo as 'cuenta', 
            pucauxiliars.descripcion as 'descripcion', 
            directorios.nit as 'tercero', 
            directorios.razon_social as 'razon_social', 
            contabilidades.fecha_documento as 'fecha_documento' 
            FROM `contabilidades` 
                JOIN sucursales ON contabilidades.id_sucursal = sucursales.id 
                JOIN pucauxiliars ON contabilidades.id_auxiliar = pucauxiliars.id 
                JOIN directorios ON contabilidades.tercero = directorios.id
            WHERE contabilidades.id_empresa = ".Session::get("id_empresa"));
        
        $data= json_decode( json_encode($obj), true);

        $pdf = PDF::loadView('pdfs.pdfcomprobanteDiario', compact('data'));
        return $pdf->download('invoice.pdf');
    }


    /**
     * GENERAR EL SAVE DE LA CONTABILIDAD
     * */ 
    public static function savefactura($factura,$tipo_documento_contable){
        $empresa = Empresas::where('id','=',Session::get('id_empresa'))->first();
        $directorio = Directorios::where('nit','=',$empresa->nit_empresa)->first();
        if(sizeof($directorio)!=0){
            $contabilidad = new Contabilidades();
            $contabilidad->tipo_documento = $tipo_documento_contable;
            $contabilidad->id_sucursal = Session::get('sucursal');
            $contabilidad->id_documento = $factura->id_factura;
            $contabilidad->numero_documento = $factura->numero;
            $contabilidad->prefijo = $factura->prefijo;
            $contabilidad->fecha_documento = $factura->fecha;
            $contabilidad->tercero = $directorio->id;
            $contabilidad->id_empresa = Session::get('id_empresa');
            return $contabilidad;
        }
        else{
            $directorios = new Directorios();
            $directorios->nit       = (string)$empresa->nit_empresa;
            $directorios->digito    = (string)"0";
            $directorios->razon_social= (string)$empresa->razon_social;
            $directorios->direccion = (string)$empresa->direccion;
            $directorios->correo    = (string)$empresa->correo;
            $directorios->telefono  = (string)$empresa->telefono;
            $directorios->telefono1 = (string)$empresa->telefono1;
            $directorios->telefono2 = (string)$empresa->telefono2;
            $directorios->financiacion= (double)"0";
            $directorios->descuento = (double)"0";
            $directorios->cupo_financiero= (double)"0";
            $directorios->rete_ica  = (double)"0";
            $directorios->porcentaje_rete_iva= (double)"0";
            $directorios->actividad_economica= $empresa->actividad;
            $directorios->calificacion= "B";
            $directorios->nivel     = "N";
            $directorios->zona_venta= "0";
            $directorios->transporte= "N";
            $directorios->estado    = "ACTIVO";
            $directorios->id_retefuente= 0;
            $directorios->id_ciudad = 182;
            $directorios->id_regimen= 1;
            $directorios->id_usuario= 14;
            $directorios->id_directorio_tipo= 1;
            $directorios->id_directorio_clase= 31;
            $directorios->id_directorio_tipo_tercero= 3;
            $directorios->id_empresa	 	= Session::get('id_empresa');
            $directorios->save();

            $contabilidad = new Contabilidades();
            $contabilidad->tipo_documento = $tipo_documento_contable;
            $contabilidad->id_sucursal = Session::get('sucursal');
            $contabilidad->id_documento = $factura->id_factura;
            $contabilidad->numero_documento = $factura->numero;
            $contabilidad->prefijo = $factura->prefijo;
            $contabilidad->fecha_documento = $factura->fecha;
            $contabilidad->tercero = $directorios->id;
            $contabilidad->id_empresa = Session::get('id_empresa');
            return $contabilidad;
        }
        
    }

    /**
     *  GENERAR LA CONTABILIZACION DE LA CAJA
     */
    public static function ContabilizarCaja($factura, $tipo_documento_contable ){
        switch ($tipo_documento_contable) {
            case 3: //venta
                
                if($factura->saldo != 0){ //si el saldo es 0 es credito
                    $tipopago = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('nombre','=','CREDITO')->first();
                    $cuentaPorCobrarCliente = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$tipopago->puc_cuenta)
                        ->first(); 
                    $valorCuentaPorCobrarCliente = $factura->total;
                    $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                    $contabilidad->tercero = $factura->id_cliente;
                    $contabilidad->valor_transaccion = $valorCuentaPorCobrarCliente;
                    $contabilidad->tipo_transaccion = "D";
                    $contabilidad->id_auxiliar = $cuentaPorCobrarCliente->id;
                    $contabilidad->save();
                    
                }
                else{ //es caja
                    $cartera = KardexCarteras::where('id_factura','=',$factura->id)->first();
                    $formapagos = FormaPagos::where('id_cartera','=',$cartera->id_cartera)->get();
                    foreach($formapagos as $formapago){
                        $tipopagos = Tipopagos::where('id','=',$formapago->formaPago)->first();
                        $cuentaPorCobrarCliente = Pucauxiliar::
                                where('id_empresa','=',Session::get('id_empresa'))
                                ->where('id','=',$tipopagos->puc_cuenta)
                                ->first();
                        $valorCuentaPorCobrarCliente = $factura->total;
                        $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                        $contabilidad->tercero = $tipopagos->tercero;
                        $contabilidad->valor_transaccion = $formapago->valor;
                        $contabilidad->tipo_transaccion = $cuentaPorCobrarCliente->naturaleza;
                        $contabilidad->id_auxiliar = $cuentaPorCobrarCliente->id;
                        $contabilidad->save();
                    }
                }
                
                break;
            case 4: //compra
                
                if($factura->saldo != 0){ //si el saldo es 0 es credito
                    $tipopago = Tipopagos::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('nombre','=','CREDITO')->first();
                    $cuentaPorCobrarCliente = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$tipopago->puc_compra)
                        ->first(); 
                    $valorCuentaPorCobrarCliente = $factura->total;
                    $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                    $contabilidad->tercero = $factura->id_cliente;
                    $contabilidad->valor_transaccion = $valorCuentaPorCobrarCliente;
                    $contabilidad->tipo_transaccion = "C";
                    $contabilidad->id_auxiliar = $cuentaPorCobrarCliente->id;
                    $contabilidad->save();
                    
                }
                else{ //es caja
                    $cartera = KardexCarteras::where('id_factura','=',$factura->id)->first();
                    $formapagos = FormaPagos::where('id_cartera','=',$cartera->id_cartera)->get();
                    foreach($formapagos as $formapago){
                        $tipopagos = Tipopagos::where('id','=',$formapago->formaPago)->first();
                        $cuentaPorCobrarCliente = Pucauxiliar::
                                where('id_empresa','=',Session::get('id_empresa'))
                                ->where('id','=',$tipopagos->puc_compra)
                                ->first();
                        $valorCuentaPorCobrarCliente = $factura->total;
                        $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                        $contabilidad->tercero = $tipopagos->tercero;
                        $contabilidad->valor_transaccion = $formapago->valor;
                        $contabilidad->tipo_transaccion = "C";
                        $contabilidad->id_auxiliar = $cuentaPorCobrarCliente->id;
                        $contabilidad->save();
                    }
                }
                
                break;
        }
    }

    /**
     *  GENERAR LA CONTABILIZACION DE LA  RETEFUENTE
     */
    public static function ContabilizarRetefuente($factura, $tipo_documento_contable, $kar, $obj, $valor_retefuente){
        switch ($tipo_documento_contable) {
            case 3: //venta

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_retefuente)
                        ->first();
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor_retefuente;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor_retefuente>0){$contabilidad->save();};

                break;
            case 4: //compra

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->c_puc_retefuente)
                        ->first();
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor_retefuente;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor_retefuente>0){$contabilidad->save();};

                break;
        }
    }

    /**
     *  GENERAR LA CONTABILIZACION DE LA RETEIVA
     */
    public static function ContabilizarReteiva($factura, $tipo_documento_contable, $kar, $obj){
        switch ($tipo_documento_contable) {
            case 3: //venta

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_reteiva)
                        ->first();
                $valor = floatval($kar->kardexiva) / 10 ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                break;
            case 4: //compra

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->c_puc_reteiva)
                        ->first();
                $valor =  floatval($kar->kardexiva) / 10 ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                break;
        }        
    }

    /**
     *  GENERAR LA CONTABILIZACION DE LA RETEICA
     */
    public static function ContabilizarReteica($factura, $tipo_documento_contable, $kar, $obj, $valor_reteica){
        switch ($tipo_documento_contable) {
            case 3: //venta

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_reteica)
                        ->first();
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor_reteica;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor_reteica>0){$contabilidad->save();};

                break;
            case 4: //compra

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->c_puc_reteica)
                        ->first();
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor_reteica;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor_reteica>0){$contabilidad->save();};

                break;
        }
    }

    /**
     *  GENERAR LA CONTABILIZACION DE LA IVA
     */
    public static function ContabilizarIva($factura, $tipo_documento_contable, $kar, $obj){
        switch ($tipo_documento_contable) {
            case 3: //venta

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_iva)
                        ->first();
                $valor = floatval($kar->kardexiva) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                break;

            case 4: //compra

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->c_puc_iva)
                        ->first();
                $valor = floatval($kar->kardexiva) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "D";
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                
                break;
        }
    }

    /**
     * AUTORETENCION
     */
    public static function ContabilizarAutoretencion($factura,$tipo_documento_contable){
        switch ($tipo_documento_contable){
            case 3: //venta
                $reteAutoretencionD = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','13559504')
                        ->first();
                $valorAutoretencionD = ($factura->subtotal*4)/1000;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valorAutoretencionD;
                $contabilidad->tipo_transaccion = $reteAutoretencionD->naturaleza;
                $contabilidad->id_auxiliar = $reteAutoretencionD->id;
                $contabilidad->save();
                $reteAutoretencionC = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','23657004')
                        ->first();
                $valorAutoretencionC = ($factura->subtotal*4)/1000;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valorAutoretencionC;
                $contabilidad->tipo_transaccion = $reteAutoretencionC->naturaleza;
                $contabilidad->id_auxiliar = $reteAutoretencionC->id;
                $contabilidad->save();        
                break;
            case 4: //compra
                break;
        }        
    }

    /**
     * IMPOCONSUMO
     */
    public static function ContabilizarImpoconsumo($factura,$tipo_documento_contable) {
        switch ($tipo_documento_contable){
            case 3: //venta

                $impoconsumo = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','13551801') //preguntar el codigo contable
                        ->first();
                $valor = ($factura->impoconsumo);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "D";
                $contabilidad->id_auxiliar = $impoconsumo->id;
                $contabilidad->save();

                break;
            case 4: //compra

                $impoconsumo = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','13551801') ////preguntar el codigo contable
                        ->first();
                $valor = ($factura->impoconsumo);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $impoconsumo->id;
                $contabilidad->save();

                break;
        }
    }

    /**
     * DESCUENTO
     */
    public static function ContabilizarDescuento($factura,$tipo_documento_contable) {
        switch ($tipo_documento_contable){
            case 3: //venta

                $descuento = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','42104001') 
                        ->first();
                $valor = ($factura->descuento);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "D";
                $contabilidad->id_auxiliar = $descuento->id;
                $contabilidad->save();

                break;
            case 4: //compra

                $descuento = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','42104001') 
                        ->first();
                $valor = ($factura->descuento);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $descuento->id;
                $contabilidad->save();

                break;
        }
    }

    /**
     * FLETES
     */
    public static function ContabilizarFlete($factura,$tipo_documento_contable) {
        switch ($tipo_documento_contable){
            case 3: //venta

                $flete = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','52355001') 
                        ->first();
                $valor = ($factura->fletes);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $flete->id;
                $contabilidad->save();

                break;
            case 4: //compra

                $flete = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','52355001')
                        ->first();
                $valor = ($factura->fletes);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "D";
                $contabilidad->id_auxiliar = $flete->id;
                $contabilidad->save();

                break;
        }
    }

    /**
     * CREE
     */
    public static function ContabilizarCree($factura,$tipo_documento_contable) {
        switch ($tipo_documento_contable){
            case 3: //venta

                $cree = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','13559504') 
                        ->first();
                $valor = ($factura->cree);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "D";
                $contabilidad->id_auxiliar = $cree->id;
                $contabilidad->save();

                $cree = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','23657004') 
                        ->first();
                $valor = ($factura->cree);
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $cree->id;
                $contabilidad->save();

                break;
        }
    }

    /**
     *  CREACION DE COMPROBANTES CONTABLES A PARTIR DE CADA UNO DE LOS DOCUMENTOS.
     */
    public function generarfactura($doc){

        $respuesta = "";

        //primero traer los datos de la factura
        $factura = Facturas::select(['facturas.*','empresas.*','facturas.id as id_factura'])
                        ->where('facturas.id_empresa','=',Session::get('id_empresa'))
                        ->join('empresas','id_empresa','=','empresas.id')
                        ->join('directorios','facturas.id_cliente','=','directorios.id')
                        ->where('facturas.id','=',$doc)
                        ->first();

        //datos del tipo de documento
        $tipo_documento = Documentos::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$factura->id_documento)->first();
        
        //segundo traer los datos del kardex de los productos
        $kardex = Kardex::select(['kardexes.*','referencias.*','lineas.*','directorios.*',
                            'kardexes.iva as kardexiva'])
                        ->where('kardexes.id_empresa','=',Session::get('id_empresa'))
                        ->join('referencias','kardexes.id_referencia','=','referencias.id')
                        ->join('lineas','referencias.codigo_linea','=','lineas.id')
                        ->join('directorios','kardexes.id_cliente','=','directorios.id')
                        ->where('kardexes.id_factura','=',$factura->id_factura)
                        ->get();

        
        //verificar si el documento ya se contabilizo
        $contabilidad = Contabilidades::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id_documento','=',$factura->id)
                        ->get();
        if(sizeof($contabilidad) == 0){ //no existe
            $respuesta = "No existe contabilizacion para este documento";
        }
        else{ //existe
            $respuesta = "Documento ya se encuentra contabilidazado";
            return array(
                "respuesta"=>$respuesta,
                "factura"=>null,
                "kardex"=>null,
                "contabilidad"=>$contabilidad
            );
        }

        //asignar el tipo de documento contable
        if($tipo_documento->documento_contable == 3){ //FACTURA DE VENTA
            $nombre = "FACTURAS DE VENTA";
            $tipo_documento_contable = 3;
            
            /** 
             * REGISTRAR LA PRIMERA CUENTA CONTABLE PREGUNTANDO SI ES CAJA O CREDITO 
             * 
            **/
            ContabilidadesController::ContabilizarCaja($factura, $tipo_documento_contable );
            
            /**
             * RECORRER LOS PRODUCTOS Y FORMAR LA CONTABILIZACION DE CADA UNO DE LOS ITEMS
             */
            $cliente_cuenta = 0;
            $valor_reteiva = 0;
            $valor_reteica = 0;
            $valor_retefuente =  0;
            foreach($kardex as $kar){
                $obj = Lineas::where('id','=',$kar->codigo_linea)->first();
                $referencia = Referencias::where('id','=',$kar->id_referencia)->first();
                $clasificaciones = Clasificaciones::where('id','=',$kar->id_clasificacion)->first();
                
                /**
                 * RETEFUENTE
                 * preguntar si el cliente retiene o no
                 */
                if($factura->retefuente!=0){
                    if($valor_retefuente == 0){
                        $valor_retefuente = $factura->retefuente;
                        ContabilidadesController::ContabilizarRetefuente($factura, $tipo_documento_contable, $kar, $obj, $valor_retefuente);
                    }
                }

                /**
                 * RETEIVA
                 */
                if($factura->reteiva != 0){
                    if($valor_reteiva==0){
                        $valor_reteiva = $factura->reteiva;
                        ContabilidadesController::ContabilizarReteiva($factura, $tipo_documento_contable, $kar, $obj);
                    }
                }                

                /**
                 * RETEICA
                 */
                if($factura->reteica!=0){
                    if($valor_reteica == 0){
                        $valor_reteica = $factura->reteica;
                        ContabilidadesController::ContabilizarReteica($factura, $tipo_documento_contable, $kar, $obj, $valor_reteica);
                    }
                }

                /**
                 * IVA
                 */
                //SI EL IVA ES DEL 19% SE DIVIDE EL PRECIO EN 1.19 EL RESULTADO ES EL VALOR DEL PRODUCTO Y LA DIFERENCIA ES EL IVA.
                if($referencia->iva != 0){
                    ContabilidadesController::ContabilizarIva($factura, $tipo_documento_contable, $kar, $obj);
                }
                
                /**
                 * VENTA DE INSUMOS POR TIPO DE CLASIFICACION DEL PRODUCTO PARTIDA Y CONTRAPARTIDA
                 */
                $valor = floatval( floatval(($kar->precio * $kar->cantidad))) ;
                //______--------verificar que la referencia tenga iva-----___________
                if ($referencia->iva == 5){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','41351405')
                        ->first();
                }
                else if ($referencia->iva == 10){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','41351410')
                        ->first();
                }
                else if ($referencia->iva == 16){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','41351416')
                        ->first();
                }
                else if ($referencia->iva == 19){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','41351419')
                        ->first();
                }
                else{
                    //partida
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','41351401')
                        ->first();
                }
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};
                
                //contrapartida
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->puc_compra) //1435...
                        ->first();
                $cliente_cuenta = $clasificaciones->cuenta_contrapartida;
                $valor = floatval( floatval(($kar->costo_promedio * $kar->cantidad))) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $dir = Directorios::where('nit','=','1002')->first(); //costo de ventas
                $contabilidad->tercero = $dir->id;// costo de ventas
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->puc_venta) //613595...
                        ->first();
                $cliente_cuenta = $clasificaciones->cuenta_contrapartida;
                $valor = floatval( floatval(($kar->costo_promedio * $kar->cantidad))) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $dir = Directorios::where('nit','=','1002')->first(); //costo de ventas
                $contabilidad->tercero = $dir->id;// costo de ventas
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "D";
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};
                
            }

            /**
             * IMPOCONSUMO
             */
            if($factura->impoconsumo != 0){
                ContabilidadesController::ContabilizarImpoconsumo($factura,$tipo_documento_contable);
            }

            /**
             * DESCUENTOS
             */
            if($factura->descuento != 0){
                ContabilidadesController::ContabilizarDescuento($factura,$tipo_documento_contable);
            }

            /**
             * FLETES
             */
            if($factura->fletes != 0){
                ContabilidadesController::ContabilizarFlete($factura,$tipo_documento_contable);
            }

            /**
             * AUTORETENCION
             */
            /*if($factura->retefuente != 0){
                ContabilidadesController::ContabilizarAutoretencion($factura,$tipo_documento_contable);
            }*/

            /**
             * RETECREE
             */
            if($factura->cree != 0){
                ContabilidadesController::ContabilizarCree($factura,$tipo_documento_contable);
            }

            $respuesta = "Documento contabilizado";

            
        }
        else if($tipo_documento->documento_contable == 4){ //FACTURA DE COMPRA
            $nombre = "FACTURAS DE COMPRA";
            $tipo_documento_contable = 4;
            
            
            /** 
             * REGISTRAR LA PRIMERA CUENTA CONTABLE PREGUNTANDO SI ES CAJA O CREDITO 
             * 
            **/
            ContabilidadesController::ContabilizarCaja($factura, $tipo_documento_contable );
            
            /**
             * RECORRER LOS PRODUCTOS Y FORMAR LA CONTABILIZACION DE CADA UNO DE LOS ITEMS
             */
            $valor_reteiva = 0;
            $valor_reteica = 0;
            $valor_retefuente =  0;
            foreach($kardex as $kar){
                $obj = Lineas::where('id','=',$kar->codigo_linea)->first();
                $referencia = Referencias::where('id','=',$kar->id_referencia)->first();
                $clasificaciones = Clasificaciones::where('id','=',$kar->id_clasificacion)->first();
                
                /**
                 * RETEFUENTE
                 * preguntar si el cliente retiene o no
                 */
                if($factura->retefuente!=0){
                    if($valor_retefuente == 0){
                        $valor_retefuente = $factura->retefuente;
                        ContabilidadesController::ContabilizarRetefuente($factura, $tipo_documento_contable, $kar, $obj, $valor_retefuente);
                    }
                }
                /**
                 * RETEIVA
                 */
                if($factura->reteiva != 0){
                    if($valor_reteiva==0){
                        ContabilidadesController::ContabilizarReteiva($factura, $tipo_documento_contable, $kar, $obj);
                    }
                }

                /**
                 * RETEICA
                 */
                if($factura->reteica!=0){
                    if($valor_reteica == 0){
                        $valor_reteica = $factura->reteica;
                        ContabilidadesController::ContabilizarReteica($factura, $tipo_documento_contable, $kar, $obj, $valor_reteica);
                    }
                }

                /**
                 * IVA
                 */
                //SI EL IVA ES DEL 19% SE DIVIDE EL PRECIO EN 1.19 EL RESULTADO ES EL VALOR DEL PRODUCTO Y LA DIFERENCIA ES EL IVA.
                if($referencia->iva != 0){
                    ContabilidadesController::ContabilizarIva($factura, $tipo_documento_contable, $kar, $obj);
                }
                
                /**
                 * VENTA DE INSUMOS POR TIPO DE CLASIFICACION DEL PRODUCTO PARTIDA Y CONTRAPARTIDA
                 */
                $valor = floatval( floatval(($kar->precio * $kar->cantidad))) ;
                //______--------verificar que la referencia tenga iva-----___________
                if ($referencia->iva == 5){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','14350505')
                        ->first();
                }
                else if ($referencia->iva == 10){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','14350510')
                        ->first();
                }
                else if ($referencia->iva == 16){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','14350516')
                        ->first();
                }
                else if ($referencia->iva == 19){
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','14350519')
                        ->first();
                }
                else{
                    //partida
                    $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$clasificaciones->cuenta_contable)
                        ->first();
                }
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->tercero = $factura->id_cliente;
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};
                
            }
            /**
             * IMPOCONSUMO
             */
            if($factura->impoconsumo != 0){
                ContabilidadesController::ContabilizarImpoconsumo($factura,$tipo_documento_contable);
            }

            /**
             * DESCUENTOS
             */
            if($factura->descuento != 0){
                ContabilidadesController::ContabilizarDescuento($factura,$tipo_documento_contable);
            }

            /**
             * FLETES
             */
            if($factura->fletes != 0){
                ContabilidadesController::ContabilizarFlete($factura,$tipo_documento_contable);
            }
            $respuesta = "Documento contabilizado";
        }
        else{
            $respuesta = "Documento no influye en la parametrización contable";
            return array(
                "respuesta"=>$respuesta,
                "factura"=>null,
                "kardex"=>null,
                "contabilidad"=>null
            );
        }

        return array(
            "respuesta"=>$respuesta,
            "factura"=>$factura
        );
    }

    public function generaregreso($doc){
        
        return array(
            "respuesta"=>"OK"
        );
    }

    public function generarrecibos($doc){
        
        return array(
            "respuesta"=>"OK"
        );
    }

    public function generarcompra($doc){
        
        return array(
            "respuesta"=>"OK"
        );
    }

    public function generarnotadb($doc){
        
        return array(
            "respuesta"=>"OK"
        );
    }

    public function generarnotacr($doc){
        
        return array(
            "respuesta"=>"OK"
        );
    }

    public function generarnotacontable($doc){
        
        return array(
            "respuesta"=>"OK"
        );
    }



    /**
     * FUNCIONES PARA SUBIR ARCHIVO PLANO
    */

    public function subirContabilidad(Request $request){
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
                $lineas[] = explode(':',$linea);  
                $numlinea++;
            }
            fclose($archivo);
        }
        //dd($lineas);
 
        return view('administrador.integracion',[
            "contabilidad"=>$lineas
        ]);
    }

    public function saveContabilidad(Request $request){

        try{


			
			$tercero = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('nit','=',$request->tercero)
                            ->first();
            if($tercero==null){
                return array(
                    "result" => "Incorrecto",
                    "body" => "Tercero no existe"
                );
            }

            $auxiliar = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                            ->where('codigo','=',$request->id_auxiliar)
                            ->first();
            if($tercero==null){
                return array(
                    "result" => "Incorrecto",
                    "body" => "Auxiliar no existe"
                );
            }

            $contabilidades = Contabilidades::where('id_empresa','=',Session::get('id_empresa'))
                ->where('id_auxiliar','=',$auxiliar->id)
                ->where('tercero','=',$tercero->id)
                ->where('valor_transaccion','=',$request->valor_transaccion)
                ->where('tipo_transaccion','=',$request->tipo_transaccion)
                ->get();
            if(sizeof($contabilidades)>0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "La contabilidades ya existe en la base de datos"
                );
			}
                        
			
			$contabilidad = new Contabilidades();
            $contabilidad->tipo_documento = $request->tipo_documento;
            $contabilidad->id_sucursal = Session::get('sucursal');
            $contabilidad->id_documento = $request->id_documento;
            $contabilidad->numero_documento = 0;
            $contabilidad->prefijo = $request->prefijo;
            $contabilidad->fecha_documento = substr($request->fecha_documento,0,4).'-'.substr($request->fecha_documento,4,2).'-'.substr($request->fecha_documento,6,2);;
            $contabilidad->valor_transaccion = $request->valor_transaccion;
            $contabilidad->tipo_transaccion = $request->tipo_transaccion;
            $contabilidad->tercero = $tercero->id;
            $contabilidad->id_auxiliar = $auxiliar->id;
            $contabilidad->id_empresa = Session::get('id_empresa');
            $contabilidad->save();

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
    
    function searchcode(Request $request){
        $auxiliar = Pucauxiliar::where('id_empresa','=',Session::get('id_empresa'))
                    ->where('codigo','like',$request->codigo.'%')
                    ->take(100)
                    ->get();

        return  array(
            "result"=>"success",
            "body"=>$auxiliar);
    }

    function cierrecontablestore(Request $request){
        try{
            
            $saldos = Contabilidades::select([DB::raw('SUM(valor_transaccion) as total'), 
                'id_auxiliar', 'tercero', 'tipo_transaccion'])
                ->where('id_empresa','=',Session::get('id_empresa'))
                ->where('fecha_documento','<=',$request->fecha)
                ->groupBy('id_auxiliar', 'tercero', 'tipo_transaccion')
                ->get();
            foreach($saldos as $saldo){
                $obj = new Cierrecontables();
                $obj->id_auxiliar = $saldo->id_auxiliar;
                $obj->id_tercero = $saldo->tercero;
                $obj->fecha = $request->fecha;
                $obj->saldo = $saldo->total;
                $obj->estado = $saldo->tipo_transaccion;
                $obj->id_empresa = Session::get('id_empresa');
                $obj->save();
            }

            $saldosSubcuentas = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total'), 
                'pucsubcuentas.id', 'contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->where('contabilidades.fecha_documento','<=',$request->fecha)
                ->groupBy('pucsubcuentas.id', 'contabilidades.tipo_transaccion')
                ->get();
            foreach($saldosSubcuentas as $saldo){
                $obj = new Cierresubcuentas();
                $obj->id_subcuenta = $saldo->id;
                $obj->fecha = $request->fecha;
                $obj->saldo = $saldo->total;
                $obj->estado = $saldo->tipo_transaccion;
                $obj->id_empresa = Session::get('id_empresa');
                $obj->save();
            }

            $saldosCuentas = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total'), 
                'puccuentas.id', 'contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->where('contabilidades.fecha_documento','<=',$request->fecha)
                ->groupBy('puccuentas.id', 'contabilidades.tipo_transaccion')
                ->get();
            foreach($saldosCuentas as $saldo){
                $obj = new Cierrecuentas();
                $obj->id_cuenta = $saldo->id;
                $obj->fecha = $request->fecha;
                $obj->saldo = $saldo->total;
                $obj->estado = $saldo->tipo_transaccion;
                $obj->id_empresa = Session::get('id_empresa');
                $obj->save();
            }
                
            $saldosGrupos = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total'), 
                'pucgrupos.id', 'contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->join('pucgrupos','pucgrupos.id','=','puccuentas.id_pucgrupos')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->where('contabilidades.fecha_documento','<=',$request->fecha)
                ->groupBy('pucgrupos.id', 'contabilidades.tipo_transaccion')
                ->get();
            foreach($saldosGrupos as $saldo){
                $obj = new Cierregrupos();
                $obj->id_grupo = $saldo->id;
                $obj->fecha = $request->fecha;
                $obj->saldo = $saldo->total;
                $obj->estado = $saldo->tipo_transaccion;
                $obj->id_empresa = Session::get('id_empresa');
                $obj->save();
            }

            $saldosClases = Contabilidades::select([DB::raw('SUM(contabilidades.valor_transaccion) as total'), 
                'pucclases.id', 'contabilidades.tipo_transaccion'])
                ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                ->join('pucsubcuentas','pucsubcuentas.id','=','pucauxiliars.id_pucsubcuentas')
                ->join('puccuentas','puccuentas.id','=','pucsubcuentas.id_puccuentas')
                ->join('pucgrupos','pucgrupos.id','=','puccuentas.id_pucgrupos')
                ->join('pucclases','pucclases.id','=','pucgrupos.id_pucclases')
                ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                ->where('contabilidades.fecha_documento','<=',$request->fecha)
                ->groupBy('pucclases.id', 'contabilidades.tipo_transaccion')
                ->get();
            foreach($saldosClases as $saldo){
                $obj = new Cierreclases();
                $obj->id_clase = $saldo->id;
                $obj->fecha = $request->fecha;
                $obj->saldo = $saldo->total;
                $obj->estado = $saldo->tipo_transaccion;
                $obj->id_empresa = Session::get('id_empresa');
                $obj->save();
            }
            
            
			
			$cierres = Cierrecontables::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
				->get();
			return view('contabilidad.cierrecontable',[
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

    public function balanceprueba(Request $request){
        $cierres = Cierrecontables::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
                ->get();
                
        //verificar cada una de las opciones
        //hoja de trabajo
            //con terceros
        /*$contabilidades = Contabilidades::select('contabilidades.id_auxiliar','contabilidades.tercero',
            DB::raw('SUM(contabilidades.valor_transaccion) as movimiento'),'contabilidades.tipo_transaccion')
            ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
            ->groupBy(['contabilidades.id_auxiliar',
            'contabilidades.tercero','contabilidades.tipo_transaccion'])
            ->get();
        */
            //sin terceros
        $contabilidades = Contabilidades::select('contabilidades.id_auxiliar',
            DB::raw('SUM(contabilidades.valor_transaccion) as movimiento'),'contabilidades.tipo_transaccion')
            ->where('contabilidades.id_empresa','=',Session::get('id_empresa'))
            ->groupBy(['contabilidades.id_auxiliar','contabilidades.tipo_transaccion'])
            ->get();
        $cierrecontable = Cierrecontables::select('cierrecontables.id_auxiliar',
            DB::raw('SUM(cierrecontables.saldo) as movimiento'),'cierrecontables.estado as tipo_transaccion')
            ->where('cierrecontables.id_empresa','=',Session::get('id_empresa'))
            ->groupBy(['cierrecontables.id_auxiliar','cierrecontables.estado'])
            ->get();

        
        //recorrer
        $balance = [];
        foreach($contabilidades as $con){
            $obj['id_auxiliar'] = $con['id_auxiliar'];
            
            if($con['tipo_transaccion'] == "D"){
                $obj['movimientoDebito'] = $con['movimiento'];
                $obj['movimientoCredito'] = 0;
            }
            else{
                $obj['movimientoCredito'] = $con['movimiento'];
                $obj['movimientoDebito'] = 0;
            }
            //buscar el saldo
            $cierre = Cierrecontables::select('cierrecontables.id_auxiliar',
                    DB::raw('SUM(cierrecontables.saldo) as movimiento'),
                    'cierrecontables.estado as tipo_transaccion')
                    ->where('estado','=',$con['tipo_transaccion'])
                    //->where('fecha')
                    ->groupBy(['cierrecontables.id_auxiliar','cierrecontables.estado'])
                    ->first();
            if($cierre['tipo_transaccion'] == "D"){
                $obj['saldoDebito'] = $cierre['movimiento'];
                $obj['saldoCredito'] = 0;
            }
            else{
                $obj['saldoCredito'] = $cierre['movimiento'];
                $obj['saldoDebito'] = 0;
            }
            $obj['nuevoSaldoDebito'] = $obj['saldoDebito'] + $obj['movimientoDebito'];
            $obj['nuevoSaldoCredito'] = $obj['saldoCredito'] + $obj['movimientoCredito'];
            array_push($balance,$obj);
        }


        dd($balance);
        return view('contabilidad.balanceprueba',[
            "cierres"=>$cierres,
            "contabilidades"=>$balance
        ]);
    }

    public function cierrecontable(){
        try{
			$cierres = Cierrecontables::select('fecha',DB::raw('count(*) as count'))
				->orderBy('fecha', 'desc')
				->groupBy('fecha')
				->get();
			return view('contabilidad.cierrecontable',[
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
