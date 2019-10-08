<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Directorios;
use App\Retefuentes;
use App\Ciudades;
use App\Regimenes;
use App\Usuarios;
use App\Directorio_tipos;
use App\Directorio_clases;
use App\Directorio_tipo_terceros;

use Session;

class DirectoriosController extends Controller
{
    public function create(Request $request){
        $directorios = new Directorios();
        $directorios->nit       = $request->nit;
        $directorios->digito    = $request->digito;
        $directorios->razon_social= $request->razon_social;
        $directorios->direccion = $request->direccion;
        $directorios->correo    = $request->correo;
        $directorios->telefono  = $request->telefono;
        $directorios->telefono1 = $request->telefono1;
        $directorios->telefono2 = $request->telefono2;
        $directorios->financiacion= $request->financiacion;
        $directorios->descuento = $request->descuento;
        $directorios->cupo_financiero= $request->cupo_financiero;
        $directorios->rete_ica  = $request->rete_ica;
        $directorios->porcentaje_rete_iva= $request->porcentaje_rete_iva;
        $directorios->actividad_economica= $request->actividad_economica;
        $directorios->calificacion= $request->calificacion;
        $directorios->nivel     = $request->nivel;
        $directorios->zona_venta= $request->zona_venta;
        $directorios->transporte= $request->transporte;
        $directorios->estado    = $request->estado;
        $directorios->id_retefuente= $request->id_retefuente;
        $directorios->id_ciudad = $request->id_ciudad;
        $directorios->id_regimen= $request->id_regimen;
        $directorios->id_usuario= $request->id_usuario;
        $directorios->id_directorio_tipo= $request->id_directorio_tipo;
        $directorios->id_directorio_clase= $request->id_directorio_clase;
        $directorios->id_directorio_tipo_tercero= $request->id_directorio_tipo_tercero;
        $directorios->id_empresa	 	= Session::get('id_empresa');
        $directorios->save();
        return redirect('/administrador/directorios');
    }

    public function update(Request $request){
        $directorios = Directorios::where('id',$request->id)->first();
        $directorios->nit       = $request->nit;
        $directorios->digito    = $request->digito;
        $directorios->razon_social= $request->razon_social;
        $directorios->direccion = $request->direccion;
        $directorios->correo    = $request->correo;
        $directorios->telefono  = $request->telefono;
        $directorios->telefono1 = $request->telefono1;
        $directorios->telefono2 = $request->telefono2;
        $directorios->financiacion= $request->financiacion;
        $directorios->descuento = $request->descuento;
        $directorios->cupo_financiero= $request->cupo_financiero;
        $directorios->rete_ica  = $request->rete_ica;
        $directorios->porcentaje_rete_iva= $request->porcentaje_rete_iva;
        $directorios->actividad_economica= $request->actividad_economica;
        $directorios->calificacion= $request->calificacion;
        $directorios->nivel     = $request->nivel;
        $directorios->zona_venta= $request->zona_venta;
        $directorios->transporte= $request->transporte;
        $directorios->estado    = $request->estado;
        $directorios->id_retefuente= $request->id_retefuente;
        $directorios->id_ciudad = $request->id_ciudad;
        $directorios->id_regimen= $request->id_regimen;
        $directorios->id_usuario= $request->id_usuario;
        $directorios->id_directorio_tipo= $request->id_directorio_tipo;
        $directorios->id_directorio_clase= $request->id_directorio_clase;
        $directorios->id_directorio_tipo_tercero= $request->id_directorio_tipo_tercero;
        $directorios->id_empresa	 	= Session::get('id_empresa');
        $directorios->save();
        //regresar a la vista
        return $directorios;
    }

    public function showupdate($id){
        $directorios = Directorios::find($id);
        return view('administrador.directorios-update', ['directorios' => $directorios]);
    }

    public function showone($id){
        $directorios = Directorios::find($id);
        return  array(
            "result"=>"success",
            "body"=>$directorios);
    }

    public function delete($id){
        $directorios = Directorios::find($id);
        $directorios->delete();
        return redirect('/administrador/directorios');
    }

    public function all(){
        $directorios = Directorios::all();
        return  array(
            "result"=>"success",
            "body"=>$directorios);
    }

    public function index(){
        $retefuentes = Retefuentes::all();
        $ciudades = Ciudades::all();
        $regimenes = Regimenes::all();
        $usuarios = Usuarios::all();
        $directorio_tipos = Directorio_tipos::all();
        $directorio_clases = Directorio_clases::all();
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return view('administrador.directorios', [
            //'directorios' => $directorios,
            'retefuentes' => $retefuentes,
            'ciudades' => $ciudades,
            'regimenes' => $regimenes,
            'usuarios' => $usuarios,
            'directorio_tipos' => $directorio_tipos,
            'directorio_clases' => $directorio_clases,
            'directorio_tipo_terceros' => $directorio_tipo_terceros]);
    }

    public function calificacion($calificacion){ //este es para castigar el cupo de endeudamiento
        if($calificacion==0){
            return 'MALO';
        }
        if($calificacion==1){
            return 'REGULAR';
        }
        if($calificacion==2){
            return 'BUENO';
        }
    }
    //buscar por cualquier input y retornar las listas de ellos
    public function search(Request $request){
        if($request->nit != ''){
            $directorios = Directorios::where('nit','=',$request->nit)
            ->get();
        }
        else if($request->razon_social != ''){
            $directorios = Directorios::where('razon_social','LIKE','%'.$request->razon_social.'%')
            ->get();
        }
        else if($request->correo != ''){
            $directorios = Directorios::where('correo','LIKE','%'.$request->correo.'%')
            ->get();
        }
        else{
            $directorios = Directorios::where('nit','>','0')
            ->get();
        }
        foreach ($directorios as $directorio) {
            $directorio->id_regimen = Regimenes::find($directorio->id_regimen);
            $directorio->id_directorio_tipo_tercero = Directorio_tipo_terceros::find($directorio->id_directorio_tipo_tercero);
        }
        return  array(
            "result"=>"success",
            "body"=>$directorios);
    }

    public function addTercero(Request $request){
        $directorios = new Directorios();
        $directorios->nit       = $request->nit;
        $directorios->id_ciudad = $request->id_ciudad;
        $directorios->razon_social= $request->razon_social;
        $directorios->direccion = $request->direccion;
        $directorios->correo    = $request->correo;
        $directorios->telefono  = $request->telefono;
        $directorios->telefono1 = $request->telefono;
        $directorios->telefono2 = $request->telefono;
        $directorios->digito    = "0";
        $directorios->financiacion= "0";
        $directorios->descuento = "0";
        $directorios->cupo_financiero= "0";
        $directorios->rete_ica  = "0";
        $directorios->porcentaje_rete_iva= "0";
        $directorios->actividad_economica= "0";
        $directorios->calificacion= "2";
        $directorios->nivel     = "NACIONAL";
        $directorios->zona_venta= "0";
        $directorios->transporte= "NO";
        $directorios->estado    = "1";
        $directorios->id_retefuente= "1";
        $directorios->id_regimen= "1";
        $directorios->id_usuario= "1";
        $directorios->id_directorio_tipo= "1";
        $directorios->id_directorio_clase= "1";
        $directorios->id_directorio_tipo_tercero= "3";
        $directorios->id_empresa	 	= Session::get('id_empresa');
        $directorios->save();

        return array(
            "result"=>"success",
            "body"=>$directorios
        );
    }
}
