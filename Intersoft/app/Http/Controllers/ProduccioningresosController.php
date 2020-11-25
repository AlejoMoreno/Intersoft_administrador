<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursales;
use App\Directorios;
use App\Usuarios;
use App\Fichatecnicas;
use App\Referencias;
use App\Produccioningresos;

use App\Clasificaciones;
use App\Lotes;
use App\Kardex;


use App\Http\Controllers\KardexController;

use DB;
use Session;

class ProduccioningresosController extends Controller
{
    public function index(Request $request){
        try{
            $produccioningresos = Produccioningresos::where('id_empresa',Session::get('id_empresa'))->orderBy('orden_produccion',"dsc")->get();
            if(sizeof($produccioningresos)!=0){
                foreach($produccioningresos as $obj){
                    $obj->id_sucursal = Sucursales::where('id',$obj->id_sucursal)->first();
                    $obj->id_cliente = Directorios::where('id',$obj->id_cliente)->first();
                    $obj->operario = Usuarios::where('id',$obj->operario)->first();
                    $obj->id_ficha_tecnica = Fichatecnicas::where('id',$obj->id_ficha_tecnica)->first();
                    $obj->id_referencia = Referencias::where('id',$obj->id_referencia)->first();
                }
            }
            else{
                $produccioningresos = new Produccioningresos();
            }
            $sucursal = Sucursales::where('id_empresa',Session::get('id_empresa'))->get();
            $clientes = Directorios::where('id_directorio_tipo_tercero', '=', '2')->
                    where('id_empresa','=',Session::get('id_empresa'))->
                    orWhere('id_directorio_tipo_tercero', '=', '3')->get();
            $operario = Usuarios::where('id_empresa',Session::get('id_empresa'))->get();
            $ficha_tecnica = DB::table('fichatecnicas')
                 ->select('nombre', DB::raw('count(*) as total'))
                 ->where('id_empresa',Session::get('id_empresa'))
                 ->groupBy('nombre')
                 ->get();
                 
            //$ficha_tecnica = Fichatecnicas::where('id_empresa',Session::get('id_empresa'))->get();
            $clasificacion = Clasificaciones::where('id_empresa',Session::get('id_empresa'))->
                                              where('nombre','=','PRODUCTO TERMINADO')->first();
            $referencia = Referencias::where('id_empresa',Session::get('id_empresa'))->
                                       where('id_clasificacion',$clasificacion->id)->get();
            return view('inventario.ordenesdeproduccion',[
                "sucursal"=>$sucursal,
                "operario"=>$operario,
                "ficha_tecnica"=>$ficha_tecnica,
                "referencia"=>$referencia,
                "produccioningresos"=>$produccioningresos,
                "clientes"=>$clientes
            ]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function createOrden(Request $request){
        try{
            if($request->id != null){ //si llega el ID se debe eliminar
                $produccioningresos = Produccioningresos::where('id_empresa','=',Session::get('id_empresa'))->
                                       where('id','=',$request->id)->first();
                $produccioningresos->delete();
            }
            else if($request->Guardar == "Guardar"){
                if($request->orden_produccion == 0){
                    $ultima = Produccioningresos::where('id_empresa','=',Session::get('id_empresa'))
                                ->orderBy('orden_produccion','DESC')->first();
                    if(count($ultima)==0){
                        $request->orden_produccion = $request->orden_produccion + 1;
                    }
                    else{
                        $request->orden_produccion = $ultima->orden_produccion + 1;
                    }
                }
                //saber el id de la ficha
                $ficha = Fichatecnicas::where('id_empresa',Session::get('id_empresa'))->
                        where('nombre','like',$request->id_ficha_tecnica )->first();
                //guardar a orden
                $obj = new Produccioningresos();
                $obj->id_cliente = $request->id_cliente;
                $obj->id_ficha_tecnica = $ficha->id;
                $obj->id_sucursal = $request->id_sucursal;
                $obj->id_empresa = $request->id_empresa;
                $obj->id_turno = $request->id_turno;
                $obj->orden_produccion = $request->orden_produccion;
                $obj->fecha = $request->fecha;
                $obj->operario = $request->operario;
                $obj->id_referencia = $request->id_referencia;
                $obj->lote = $request->lote;
                $obj->etapa = $request->etapa;
                $obj->unidades = $request->unidades;
                $obj->save(); 
            }
            //para la vista
            return redirect('/inventario/ordenesdeproduccion');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    function ingresoporproduccion(){
        $produccioningresos_1 = DB::table('produccioningresos')
                 ->select('orden_produccion','etapa','id_cliente', DB::raw('count(*) as total'))
                 ->where('id_empresa',Session::get('id_empresa'))
                 ->groupBy('orden_produccion','etapa','id_cliente')
                 ->orderBy('orden_produccion','etapa','DESC')
                 ->get();
        foreach($produccioningresos_1 as $obj){
            $obj->id_cliente = Directorios::where('id',$obj->id_cliente)->first();
        }

        $produccioningresos = Produccioningresos::where('id_empresa',Session::get('id_empresa'))
                ->orderBy('orden_produccion','DESC')
                ->get();
        return view('/inventario/ingresoporproduccion',[
            "produccioningresos"=>$produccioningresos,
            "produccioningresos1"=>$produccioningresos_1
        ]);
    }

    function update(Request $request){
        $produccioningresos = Produccioningresos::where('id_empresa',Session::get('id_empresa'))
                ->where('orden_produccion','=',$request->orden_produccion)
                ->orderBy('id','DESC')
                ->get();
        foreach($produccioningresos as $obj){
            $obj->id_ficha_tecnica = Fichatecnicas::where('id',$obj->id_ficha_tecnica)->first();
            $obj->fichas = Fichatecnicas::where('orden',$obj->id_ficha_tecnica->orden)->get();
            foreach($obj->fichas as $objs){
                $objs->id_referencia = Referencias::where('id',$objs->id_referencia)->first();
            }
        }
        
        return [
            "produccioningresos"=>$produccioningresos
        ];
    }

    function convertir(Request $request){
        $produccioningresos = $request->data;
        //dd($request);
        if($request->etapa == 10){ //Cancelar la orden
            foreach( $produccioningresos as $produccioningreso ){
                $objs = Produccioningresos::where('id',$produccioningreso['id'])->first();
                $objs->etapa = $request->etapa;
                $objs->save();
                //dd($obj);
            }
            return $produccioningresos;
        }
        else if($request->etapa == 11) { //Finalizar y convertir producto
            foreach( $produccioningresos as $produccioningreso ){
                $objs = Produccioningresos::where('id',$produccioningreso['id'])->first();
                $objs->etapa = $request->etapa;
                $objs->save();
                //dd($produccioningreso['id_ficha_tecnica']);
                //hacer que el producto tenga influencia en el kardex

                foreach($produccioningreso['fichas'] as $ficha){
                    $referencia = Referencias::where('id',$ficha['id_referencia'])->first();
                    $referencia->saldo = $referencia->saldo - ($ficha['cantidad'] * $produccioningreso['unidades']);
                    $referencia->save();
                    
                    $lote = Lotes::where('id_referencia','=',$referencia->id)->
                        where('id_empresa','=',Session::get('id_empresa'))->first();
                    //dd(($ficha['cantidad'] * $produccioningreso['unidades']));
                    $lote->cantidad = intval($lote->cantidad) - intval(($ficha['cantidad'] * $produccioningreso['unidades']));
                    $lote->save();

                    $obj = new Kardex();
                    $obj->id_sucursal	= Session::get('sucursal');
                    $obj->numero 		= intval($produccioningreso['orden_produccion']);
                    $obj->prefijo 		= "NA";
                    $obj->id_cliente 	= intval($produccioningreso['id_cliente']);
                    $obj->id_factura 	= 0;
                    $obj->id_vendedor 	= Session::get('user_id');
                    $obj->fecha 		= date("Y-m-d");
                    $obj->id_referencia = $ficha['id_referencia']['id'];
                    $obj->lote 			= $lote->numero_lote;
                    $obj->serial 		= $lote->serial;
                    $obj->fecha_vencimiento = $lote->fecha_vence_lote;
                    $obj->cantidad 		= $ficha['cantidad'];
                    $obj->precio 		= 0;
                    $obj->costo 		= 0; //aca
                    $obj->id_documento 	= 100;
                    $obj->signo 		= "-";
                    $obj->subtotal 		= 0;
                    $obj->iva 			= 0;
                    $obj->impoconsumo 	= 0;
                    $obj->otro_impuesto = 0;
                    $obj->otro_impuesto1 = 0;
                    $obj->descuento 	= 0;
                    $obj->fletes 		= 0;
                    $obj->retefuente 	= 0;
                    $obj->total 		= 0; //aca
                    $obj->observaciones = "Producto gastado en materia prima para la orden numero ".$produccioningreso['orden_produccion'];
                    $obj->id_modificado = Session::get('user_id');;
                    $obj->kardex_anterior = $produccioningreso['orden_produccion'];
                    $obj->id_empresa	= Session::get('id_empresa');
                    $obj->estado 		= "ACTIVO";
                    $obj->save();
                }
                
                //crear / actualizar el lote 
                $lote = Lotes::where('id_referencia','=',$produccioningreso['id_referencia'])->
						where('numero_lote','=',$produccioningreso['lote'])->
                        where('id_empresa','=',Session::get('id_empresa'))->first();
                if(sizeof($lote) == 0 ){
                    $lotes = new Lotes();
                    $lotes->id_referencia     	= $produccioningreso['id_referencia'];
                    $lotes->numero_lote   		= $produccioningreso['lote'];
                    $lotes->fecha_vence_lote  	= $produccioningreso['fecha'];
                    $lotes->ubicacion   		= 'NINGUNA';
                    $lotes->serial            	= "";
                    $lotes->cantidad          	= $produccioningreso['unidades'];
                    $lotes->id_empresa	        = Session::get('id_empresa');
                    $lotes->id_sucursal	        = Session::get('sucursal');
                    $lotes->save();
                }
                else{
                    $lote->cantidad          	= $lote->cantidad + $produccioningreso['unidades'];
                    $lote->save();
                }
                

                $obj = new Kardex();
                $obj->id_sucursal	= Session::get('sucursal');
                $obj->numero 		= intval($produccioningreso['orden_produccion']);
                $obj->prefijo 		= "NA";
                $obj->id_cliente 	= intval($produccioningreso['id_cliente']);
                $obj->id_factura 	= 0;
                $obj->id_vendedor 	= Session::get('user_id');
                $obj->fecha 		= date("Y-m-d");
                $obj->id_referencia = $produccioningreso['id_referencia'];
                $obj->lote 			= $produccioningreso['lote'];
                $obj->serial 		= "NA";
                $obj->fecha_vencimiento = $produccioningreso['fecha'];
                $obj->cantidad 		= $produccioningreso['unidades'];
                $obj->precio 		= 0;
                $obj->costo 		= 0; //aca
                $obj->id_documento 	= 100;
                $obj->signo 		= "+";
                $obj->subtotal 		= 0;
                $obj->iva 			= 0;
                $obj->impoconsumo 	= 0;
                $obj->otro_impuesto = 0;
                $obj->otro_impuesto1 = 0;
                $obj->descuento 	= 0;
                $obj->fletes 		= 0;
                $obj->retefuente 	= 0;
                $obj->total 		= 0; //aca
                $obj->observaciones = "Producto fabricado orden numero ".$produccioningreso['orden_produccion'];
                $obj->id_modificado = Session::get('user_id');;
                $obj->kardex_anterior = $produccioningreso['orden_produccion'];
                $obj->id_empresa	= Session::get('id_empresa');
                $obj->estado 		= "ACTIVO";
                $obj->save();

                $referencia = Referencias::where('id',$produccioningreso['id_referencia'])->first();
                $referencia->saldo = $referencia->saldo + $produccioningreso['unidades'];
                $referencia->save();
                
            }
            return $produccioningresos;
        } 
        else{ //cambiar etapa
            
            foreach( $produccioningresos as $produccioningreso ){
                $objs = Produccioningresos::where('id',$produccioningreso['id'])->first();
                $objs->etapa = $request->etapa;
                $objs->save();
                //dd($obj);
            }
            return $produccioningresos;

        }
        
    }

    public function reempaqueStore(Request $request){
        
        $fichas_tecnicas = Fichatecnicas::where('id_empresa','=',Session::get('id_empresa'))
            ->where('orden','=',$request->ficha)
            ->get();
        //referencia nueva
        $referencia = Referencias::where('id','=',$request->producto)->first();
        $referencia->saldo = $referencia->saldo + $request->cantidad;
        $referencia->save();
        $obj = new Kardex();
        $obj->id_sucursal	= Session::get('sucursal');
        $obj->numero 		= 0;
        $obj->prefijo 		= "ORDEN";
        $obj->id_cliente 	= 0;
        $obj->id_factura 	= 0;
        $obj->id_vendedor 	= 0;
        $obj->fecha 		= $request->fecha;
        $obj->id_referencia = $referencia->id;
        $obj->lote 			= 0;
        $obj->serial 		= 0;
        $obj->fecha_vencimiento = $request->fecha;
        $obj->cantidad 		= $request->cantidad;
        $obj->precio 		= 0;
        $obj->costo 		= 0;
        $obj->id_documento 	= 0;
        $obj->signo 		= "+";
        $obj->subtotal 		= 0;
        $obj->iva 			= 0;
        $obj->impoconsumo 	= 0;
        $obj->otro_impuesto = 0;
        $obj->otro_impuesto1 = 0;
        $obj->descuento 	= 0;
        $obj->fletes 		= 0;
        $obj->retefuente 	= 0;
        $obj->total 		= 0;
        $obj->observaciones = "ORDEN";
        $obj->id_modificado = 0;
        $obj->kardex_anterior = 0;
        $obj->id_empresa	= Session::get('id_empresa');
        $obj->estado 		= "ACTIVO";
        $obj->save();
        //recorrer materias primas
        foreach($fichas_tecnicas as $ficha){
            $referencia = Referencias::where('id','=',$ficha->id_referencia)->first();
            $total = $ficha->cantidad * $request->cantidad;
            $referencia->saldo = $referencia->saldo - $total;
            $referencia->save();

            $obj = new Kardex();
            $obj->id_sucursal	= Session::get('sucursal');
            $obj->numero 		= $ficha->orden;
            $obj->prefijo 		= "ORDEN";
            $obj->id_cliente 	= 0;
            $obj->id_factura 	= 0;
            $obj->id_vendedor 	= 0;
            $obj->fecha 		= $request->fecha;
            $obj->id_referencia = $referencia->id;
            $obj->lote 			= 0;
            $obj->serial 		= 0;
            $obj->fecha_vencimiento = $request->fecha;
            $obj->cantidad 		= $total;
            $obj->precio 		= 0;
            $obj->costo 		= 0;
            $obj->id_documento 	= 0;
            $obj->signo 		= "-";
            $obj->subtotal 		= 0;
            $obj->iva 			= 0;
            $obj->impoconsumo 	= 0;
            $obj->otro_impuesto = 0;
            $obj->otro_impuesto1 = 0;
            $obj->descuento 	= 0;
            $obj->fletes 		= 0;
            $obj->retefuente 	= 0;
            $obj->total 		= 0;
            $obj->observaciones = "ORDEN";
            $obj->id_modificado = 0;
            $obj->kardex_anterior = 0;
            $obj->id_empresa	= Session::get('id_empresa');
            $obj->estado 		= "ACTIVO";
            $obj->save();
        }

        $referencias = Referencias::where('id_empresa','=',Session::get('id_empresa'))->get();
        $fichas = Fichatecnicas::select(['nombre'])
            ->where('id_empresa','=',Session::get('id_empresa'))
            ->groupBy('nombre')->get();
        return view('/inventario/reempaque',[
            "referencias"=>$referencias,
            "fichas"=>$fichas
        ]);
    }

    public function reempaque(Request $request){
        $referencias = Referencias::select(['referencias.*','clasificaciones.nombre'])
            ->where('referencias.id_empresa','=',Session::get('id_empresa'))
            ->join('clasificaciones','referencias.id_clasificacion','=','clasificaciones.id')
            ->where('clasificaciones.nombre','=','PRODUCTO TERMINADO')->get();
        $fichas = Fichatecnicas::select(['nombre','orden'])
            ->where('id_empresa','=',Session::get('id_empresa'))
            ->groupBy(['nombre','orden'])->get();
        return view('/inventario/reempaque',[
            "referencias"=>$referencias,
            "fichas"=>$fichas
        ]);
    }
}
