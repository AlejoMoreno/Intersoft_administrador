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
use App\Documentos;

use App\Empresas;
use App\Contabilidades;

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

    public function librosauxiliaresIndex(){
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
        return view('contabilidad.librosauxiliares', ['data' => $data]);
    }

    public function getDocumentos($id, Request $request){
        $obj = DB::select("SELECT 
            count(id) as cantidad,
            contabilidades.id_empresa,
            (select nombre from sucursales where id = contabilidades.id_sucursal) as id_sucursal,
            contabilidades.tipo_documento,
            contabilidades.numero_documento,
            contabilidades.fecha_documento,
            (select nit from directorios where id = contabilidades.tercero) as id_tercero,
            (select razon_social from directorios where id = contabilidades.tercero) as tercero
            FROM `contabilidades` 
            WHERE contabilidades.tipo_documento = ".$id.
            " AND contabilidades.id_empresa = ".Session::get("id_empresa").
            " AND contabilidades.fecha_documento BETWEEN '".$request->desde."' AND '".$request->hasta."'".
            " GROUP BY id_empresa,id_sucursal,tipo_documento,numero_documento,fecha_documento,id_tercero,tercero"
        );
        $data= json_decode( json_encode($obj), true);

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
            'data' => (object)$data,
            'nombre_tipo_documento' => $nombre,
            'documentos'=>$documentos,
            'auxiliares'=>$auxiliares
        ]);
    }

    public function viewComprobantes(Request $request){
        
        $contabilidades = Contabilidades::where('contabilidades.id_empresa','=',Session::get('id_empresa'))
                        ->where('numero_documento','=',$request->numero_documento)
                        ->join('pucauxiliars','pucauxiliars.id','=','contabilidades.id_auxiliar')
                        ->join('directorios','directorios.id','=','contabilidades.tercero')
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
     *  CREACION DE COMPROBANTES CONTABLES A PARTIR DE CADA UNO DE LOS DOCUMENTOS.
     */
    public function generarfactura($doc){

        $respuesta = "";
        //primero traer los datos de la factura
        $factura = Facturas::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$doc)
                        ->first();
        //segundo traer los datos del kardex de los productos
        $kardex = Kardex::where('kardexes.id_empresa','=',Session::get('id_empresa'))
                        ->join('referencias','kardexes.id_referencia','=','referencias.id')
                        ->join('lineas','referencias.codigo_linea','=','lineas.id')
                        ->join('directorios','kardexes.id_cliente','=','directorios.id')
                        ->where('kardexes.id_factura','=',$factura->id)
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
        }
        //asignar el tipo de documento contable
        
        
        //agrupar tambien por tipo de producto (materia prima, mercancia, etc).
        //agrupar las lineas con los totales sin iva
        //verificar impuestos y demas 
        //verificar saldo de la factura si es igual a 0 se debe realizar la contabilidad del recibo
            //buscar el recibo generado
            //hacer la contabilidad del recibo
            

        return array(
            "respuesta"=>$respuesta,
            "factura"=>$factura,
            "kardex"=>$kardex
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

}
