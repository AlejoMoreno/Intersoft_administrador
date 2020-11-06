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
use App\Lineas;
use App\Clasificaciones;

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
     * GENERAR EL SAVE DE LA CONTABILIDAD
     * */ 
    public static function savefactura($factura,$tipo_documento_contable){
        $contabilidad = new Contabilidades();
        $contabilidad->tipo_documento = $tipo_documento_contable;
        $contabilidad->id_sucursal = Session::get('sucursal');
        $contabilidad->id_documento = $factura->id_factura;
        $contabilidad->numero_documento = $factura->numero;
        $contabilidad->prefijo = $factura->prefijo;
        $contabilidad->fecha_documento = $factura->fecha;
        $contabilidad->tercero = $factura->id_cliente;
        $contabilidad->id_empresa = Session::get('id_empresa');
        return $contabilidad;
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

        //segundo traer los datos del kardex de los productos
        $kardex = Kardex::where('kardexes.id_empresa','=',Session::get('id_empresa'))
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
        if($factura->signo){
            $nombre = "FACTURAS DE VENTA";
            $tipo_documento_contable = 3;
            //registrar la primera cuenta contable preguntando si es caja o credito
            if($factura->saldo == 0){ //si el saldo es 0 es credito
                $cuentaPorCobrarCliente = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','13050501')
                        ->first();
                $valorCuentaPorCobrarCliente = $factura->total;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valorCuentaPorCobrarCliente;
                $contabilidad->tipo_transaccion = $cuentaPorCobrarCliente->naturaleza;
                $contabilidad->id_auxiliar = $cuentaPorCobrarCliente->id;
                $contabilidad->save();
                
            }
            else{ //es caja
                $cuentaPorCobrarCliente = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','11050501')
                        ->first();
                $valorCuentaPorCobrarCliente = $factura->total;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valorCuentaPorCobrarCliente;
                $contabilidad->tipo_transaccion = $cuentaPorCobrarCliente->naturaleza;
                $contabilidad->id_auxiliar = $cuentaPorCobrarCliente->id;
                $contabilidad->save();
            }
            //dd($kardex);
            //recorrer AQUI AQUI AQUI AQUI
            foreach($kardex as $kar){
                $obj = Lineas::where('id','=',$kar->codigo_linea)->first();
                $clasificaciones = Clasificaciones::where('id','=',$kar->id_clasificacion)->first();
                //retencion en la fuente preguntar si el cliente se retiene o no
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_retefuente)
                        ->first();
                $valor = $kar->retefuente;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                //reteiva
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_reteiva)
                        ->first();
                $valor = $kar->otro_impuesto;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                //reteica
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_reteica)
                        ->first();
                $valor = $kar->otro_impuesto1;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                //iva generado SI EL IVA ES DEL 19% SE DIVIDE EL PRECIO EN 1.19 EL RESULTADO ES EL VALOR DEL PRODUCTO Y LA DIFERENCIA ES EL IVA.
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->v_puc_iva)
                        ->first();
                $valor = intval( floatval($kar->precio * $kar->cantidad) - floatval(($kar->precio * $kar->cantidad)/1.19)) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                //Venta de insumos por tipo de clasificacion del producto
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$clasificaciones->cuenta_contable)
                        ->first();
                $valor = intval( floatval(($kar->precio * $kar->cantidad)/1.19)) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                //ventas gracadas con IVA
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$obj->c_puc_iva)
                        ->first();
                $valor = intval( floatval($kar->precio * $kar->cantidad) - floatval(($kar->precio * $kar->cantidad)/1.19)) ;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor>0){$contabilidad->save();};

                //COMPRAS EXENTAS 
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('codigo','=','14350501')
                        ->first();
                $valor = (floatval($kar->costo_promedio) * floatval($kar->cantidad));
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = "C";
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor){$contabilidad->save();};

                //COSTO INSUMOS por clasificacion de producto
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$clasificaciones->cuenta_contrapartida)
                        ->first();
                $valor = (floatval($kar->costo_promedio) * floatval($kar->cantidad));
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                if($valor){$contabilidad->save();};
                
            }
            //recorrer AQUI AQUI AQUI
            /*foreach($clasificaciones as $clasificacion){
                $cuenta = Pucauxiliar::
                        where('id_empresa','=',Session::get('id_empresa'))
                        ->where('id','=',$clasificacion->id_clasificacion)
                        ->first();
                $valor = $cuenta->total;
                $contabilidad = ContabilidadesController::savefactura($factura,$tipo_documento_contable);
                $contabilidad->valor_transaccion = $valor;
                $contabilidad->tipo_transaccion = $cuenta->naturaleza;
                $contabilidad->id_auxiliar = $cuenta->id;
                $contabilidad->save();
            }*/

            //Recorrer los que se necesitan
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

            
        }
        else if($factura->signo == "+"){
            $nombre = "FACTURAS DE COMPRA";
            $tipo_documento_contable = 4;
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

}
