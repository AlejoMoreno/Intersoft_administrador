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

    public function getDocumentos($id){
        $obj = DB::select("SELECT 
            count(id) as cantidad,
            contabilidades.id_empresa,
            (select nombre from sucursales where id = contabilidades.id_sucursal) as id_sucursal,
            contabilidades.tipo_documento,
            contabilidades.numero_documento,
            contabilidades.fecha_documento
            FROM `contabilidades` 
            WHERE contabilidades.tipo_documento = ".$id."
            and contabilidades.id_empresa = ".Session::get("id_empresa").
            " GROUP BY id_empresa,id_sucursal,tipo_documento,numero_documento,fecha_documento"
        );
        $data= json_decode( json_encode($obj), true);

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
            'nombre_tipo_documento' => $nombre
        ]);
    }

    public function viewComprobantes(Request $request){
        
        $contabilidades = Contabilidades::where('id_empresa','=',Session::get('id_empresa'))->
                                          where('numero_documento','=',$request->numero_documento)->get();
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
        $contabilidad->id_sucursal = $request->id_sucursal;
        $contabilidad->id_documento = $request->id_documento;
        $contabilidad->numero_documento = $request->numero_documento;
        $contabilidad->prefijo = $request->prefijo;
        $contabilidad->fecha_documento = $request->fecha_documento;
        $contabilidad->valor_transaccion = $request->valor_transaccion;
        $contabilidad->tipo_transaccion = $request->tipo_transaccion;
        $contabilidad->tercero = $request->tercero;
        $contabilidad->id_auxiliar = Session::get('sucursal');
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
}
