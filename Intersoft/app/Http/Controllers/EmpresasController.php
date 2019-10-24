<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresas;
use App\Sucursales;
use App\Usuarios;
use App\Pucauxiliar;
use App\Documentos;
use App\Tipo_presentaciones;
use App\Lineas;
use App\Marcas;
use App\Directorios;
use App\Clasificaciones;
use App\Contrato_laborals;


class EmpresasController extends Controller
{
    public function create(Request $request){
       $empresa = new Empresas();
       $empresa->razon_social   = $request->razon_social;
       $empresa->direccion      = $request->direccion;
       $empresa->actividad      = $request->actividad;
       $empresa->correo       = $request->correo;
       $empresa->nit_empresa    = $request->nit_empresa;
       $empresa->nombre         = $request->nombre;
       $empresa->telefono       = $request->telefono;
       $empresa->telefono1      = $request->telefono1;
       $empresa->telefono2      = $request->telefono2;
       $empresa->ciudad         = $request->ciudad;
       $empresa->id_regimen     = $request->id_regimen;
       $empresa->save();
       //return $request->razon_social;
       return view('/login');

    }

    public function search(Request $request){
        $empresa = Empresas::where('nit_empresa','=',$request->nit)->first();
        try{
            $sucursales = Sucursales::where('id_empresa','=',$empresa->id)->get();
            return  array(
                "result"=>"Success",
                "body"=>$empresa,
                "sucursales"=>$sucursales);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
        
    }

    public function register(Request $request){
        try{
            //guardar la empresa
            $empresa = new Empresas();
            $empresa->razon_social   = $request->razon_social;
            $empresa->direccion      = $request->direccion;
            $empresa->actividad      = $request->actividad;
            $empresa->correo       = $request->correo;
            $empresa->nit_empresa    = $request->nit_empresa;
            $empresa->nombre         = $request->nombre;
            $empresa->telefono       = $request->telefono;
            $empresa->telefono1      = $request->telefono1;
            $empresa->telefono2      = $request->telefono2;
            $empresa->ciudad         = $request->ciudad_empresa;
            $empresa->id_regimen     = $request->id_regimen;
            $empresa->save();

            $contrato_laborales = new Contrato_laborals();
            $contrato_laborales->tipo_contrato  = "FIJO";
            $contrato_laborales->descripcion    = "Contrato fijo";
            $contrato_laborales->consecutivo    = "01";
            $contrato_laborales->fecha_inicial  = "2019/01/01";
            $contrato_laborales->fecha_final    = "2019/12/01";
            $contrato_laborales->id_empresa    = $empresa->id;
            $contrato_laborales->save();

            $usuario = new Usuarios();
            $usuario->ncedula             = $request->userncedula;
            $usuario->nombre              = $request->usernombre;
            $usuario->apellido            = $request->userapellido;
            $usuario->cargo               = $request->usercargo;
            $usuario->telefono            = $request->usertelefono;
            $usuario->password            = $request->userpassword;
            $usuario->correo              = $request->usercorreo;
            $usuario->estado              = "ACTIVO";
            $usuario->token               = "12345679";
            $usuario->arl                 = "NINGUNA";
            $usuario->eps                 = "NINGUNA";
            $usuario->cesantias           = "NINGUNA";
            $usuario->pension             = "NINGUNA";
            $usuario->caja_compensacion   = "NINGUNA";
            $usuario->id_contrato         = $contrato_laborales->id;
            $usuario->referencia_personal = "NINGUNA";
            $usuario->telefono_referencia = "NINGUNA";
            $usuario->id_empresa          = $empresa->id;
            $usuario->save();

            $sucursales = new Sucursales();
            $sucursales->nombre     = $request->sucnombre;
            $sucursales->codigo     = $request->succodigo;
            $sucursales->direccion  = $request->sucdireccion;
            $sucursales->encargado  = $request->sucencargado;
            $sucursales->telefono   = $request->suctelefono;
            $sucursales->correo     = $request->succorreo;
            $sucursales->ciudad     = $request->succiudad;
            $sucursales->id_empresa = $empresa->id;
            $sucursales->save();

            $auxiliar = new Pucauxiliar();
            $auxiliar->id_pucsubcuentas    = 1;
            $auxiliar->codigo              = "11050501";
            $auxiliar->descripcion         = "CAJA " . $sucursales->nombre;
            $auxiliar->homologo            = "11050501";
            $auxiliar->id_empresa          = $empresa->id;
            $auxiliar->save();

            $documento = new Documentos();
            $documento->nombre     	  = "MAYORISTA";
            $documento->signo   	  = "-";
            $documento->ubicacion     = "SALIDA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "MOSTRADOR";
            $documento->signo   	  = "-";
            $documento->ubicacion     = "SALIDA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "REMISIONES";
            $documento->signo   	  = "-";
            $documento->ubicacion     = "SALIDA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "PEDIDOS";
            $documento->signo   	  = "-";
            $documento->ubicacion     = "SALIDA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "COTIZACION";
            $documento->signo   	  = "=";
            $documento->ubicacion     = "SALIDA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "COMPRAS";
            $documento->signo   	  = "+";
            $documento->ubicacion     = "ENTRADA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "AJUSTE ENTRADAS";
            $documento->signo   	  = "+";
            $documento->ubicacion     = "ENTRADA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();
            $documento = new Documentos();
            $documento->nombre     	  = "AJUSTE SALIDA";
            $documento->signo   	  = "-";
            $documento->ubicacion     = "ENTRADA";
            $documento->prefijo       = "";
            $documento->num_max       = "1";
            $documento->num_min       = "100";
            $documento->num_presente  = "1";
            $documento->cuenta_contable_partida  		= $auxiliar->codigo;
            $documento->cuenta_contable_contrapartida= $auxiliar->codigo;
            $documento->id_empresa  = $empresa->id;
            $documento->save();

            $obj = new Tipo_presentaciones();
            $obj->nombre     	= "UND";
            $obj->descripcion   = "UNIDAD";
            $obj->id_empresa   = $empresa->id;
            $obj->save();

            $obj = new Lineas();
            $obj->nombre     	= "GENERICA";
            $obj->descripcion   = "GENERICA SIN LINEA";
            $obj->codigo_interno= "01";
            $obj->codigo_alterno= "01";
            $obj->id_empresa    = $empresa->id;
            $obj->save();

            $obj = new Marcas();
            $obj->nombre     	= "GENERICA";
            $obj->descripcion   = "GENERICA SIN MARCA";
            $obj->logo  		= "SIN LOGO";
            $obj->codigo_interno= "01";
            $obj->codigo_alterno= "01";
            $obj->id_empresa    = $empresa->id;
            $obj->save();

            $obj = new Clasificaciones();
            $obj->nombre     	= "MATERIA PRIMA";
            $obj->descripcion   = "MATERIA PRIMA";
            $obj->codigo_interno= "01";
            $obj->id_empresa     = $empresa->id;
            $obj->save();
            $obj = new Clasificaciones();
            $obj->nombre     	= "MERCANCIA NACIONAL";
            $obj->descripcion   = "MERCANCIA NACIONAL";
            $obj->codigo_interno= "02";
            $obj->id_empresa     = $empresa->id;
            $obj->save();
            $obj = new Clasificaciones();
            $obj->nombre     	= "MERCANCIA INTERNACIONAL";
            $obj->descripcion   = "MERCANCIA INTERNACIONAL";
            $obj->codigo_interno= "03";
            $obj->id_empresa     = $empresa->id;
            $obj->save();
            $obj = new Clasificaciones();
            $obj->nombre     	= "SERVICIOS";
            $obj->descripcion   = "SERVICIOS";
            $obj->codigo_interno= "04";
            $obj->id_empresa     = $empresa->id;
            $obj->save();

            $directorios = new Directorios();
            $directorios->nit       = "222222222";
            $directorios->digito    = "0";
            $directorios->razon_social= "MENORES CUANTIAS PROVEEDOR";
            $directorios->direccion = $empresa->direccion;
            $directorios->correo    = $empresa->correo;
            $directorios->telefono  = $empresa->telefono;
            $directorios->telefono1 = $empresa->telefono;
            $directorios->telefono2 = $empresa->telefono;
            $directorios->financiacion= "0";
            $directorios->descuento = "0";
            $directorios->cupo_financiero= "0";
            $directorios->rete_ica  = "0";
            $directorios->porcentaje_rete_iva= "0";
            $directorios->actividad_economica= "0";
            $directorios->calificacion= "0";
            $directorios->nivel     = "0";
            $directorios->zona_venta= "0";
            $directorios->transporte= "0";
            $directorios->estado    = "ACTIVO";
            $directorios->id_retefuente= "1";
            $directorios->id_ciudad = "1";
            $directorios->id_regimen= "1";
            $directorios->id_usuario= $usuario->id;
            $directorios->id_directorio_tipo= "1";
            $directorios->id_directorio_clase= "1";
            $directorios->id_directorio_tipo_tercero= "1"; //proveedor
            $directorios->id_empresa	 	= $empresa->id;
            $directorios->save();
            $directorios = new Directorios();
            $directorios->nit       = "222222222";
            $directorios->digito    = "0";
            $directorios->razon_social= "MENORES CUANTIAS CLIENTE";
            $directorios->direccion = $empresa->direccion;
            $directorios->correo    = $empresa->correo;
            $directorios->telefono  = $empresa->telefono;
            $directorios->telefono1 = $empresa->telefono;
            $directorios->telefono2 = $empresa->telefono;
            $directorios->financiacion= "0";
            $directorios->descuento = "0";
            $directorios->cupo_financiero= "0";
            $directorios->rete_ica  = "0";
            $directorios->porcentaje_rete_iva= "0";
            $directorios->actividad_economica= "0";
            $directorios->calificacion= "0";
            $directorios->nivel     = "0";
            $directorios->zona_venta= "0";
            $directorios->transporte= "0";
            $directorios->estado    = "ACTIVO";
            $directorios->id_retefuente= "1";
            $directorios->id_ciudad = "1";
            $directorios->id_regimen= "1";
            $directorios->id_usuario= $usuario->id;
            $directorios->id_directorio_tipo= "1";
            $directorios->id_directorio_clase= "1";
            $directorios->id_directorio_tipo_tercero= "2"; //cliente
            $directorios->id_empresa	 	= $empresa->id;
            $directorios->save();
            $directorios = new Directorios();
            $directorios->nit       = "222222222";
            $directorios->digito    = "0";
            $directorios->razon_social= "MENORES CUANTIAS TERCERO";
            $directorios->direccion = $empresa->direccion;
            $directorios->correo    = $empresa->correo;
            $directorios->telefono  = $empresa->telefono;
            $directorios->telefono1 = $empresa->telefono;
            $directorios->telefono2 = $empresa->telefono;
            $directorios->financiacion= "0";
            $directorios->descuento = "0";
            $directorios->cupo_financiero= "0";
            $directorios->rete_ica  = "0";
            $directorios->porcentaje_rete_iva= "0";
            $directorios->actividad_economica= "0";
            $directorios->calificacion= "0";
            $directorios->nivel     = "0";
            $directorios->zona_venta= "0";
            $directorios->transporte= "0";
            $directorios->estado    = "ACTIVO";
            $directorios->id_retefuente= "1";
            $directorios->id_ciudad = "1";
            $directorios->id_regimen= "1";
            $directorios->id_usuario= $usuario->id;
            $directorios->id_directorio_tipo= "1";
            $directorios->id_directorio_clase= "1";
            $directorios->id_directorio_tipo_tercero= "3"; //tercero
            $directorios->id_empresa	 	= $empresa->id;
            $directorios->save();
            
            return redirect('/');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
        
    }
}
