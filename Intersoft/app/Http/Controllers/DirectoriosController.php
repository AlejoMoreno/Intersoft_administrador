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
        $directorios->save();
        //regresar a la vista
        return DirectoriosController::index();
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
        $directorios->save();
        //regresar a la vista
        return DirectoriosController::index();
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
        //regresar a la vista
        return DirectoriosController::index();
    }

    public function all(){
        $directorios = Directorios::all();
        return  array(
            "result"=>"success",
            "body"=>$directorios);
    }

    public function index(){
        $directorios = Directorios::all();
        foreach ($directorios as $directorio) {
            $directorio->id_retefuente = Retefuentes::find($directorio->id_retefuente);
            $directorio->id_ciudad = Ciudades::find($directorio->id_ciudad);
            $directorio->id_regimen = Regimenes::find($directorio->id_regimen);
            $directorio->id_usuario = Usuarios::find($directorio->id_usuario);
            $directorio->id_directorio_tipo = Directorio_tipos::find($directorio->id_directorio_tipo);
            $directorio->id_directorio_clase = Directorio_clases::find($directorio->id_directorio_clase);
            $directorio->id_directorio_tipo_tercero = Directorio_tipo_terceros::find($directorio->id_directorio_tipo_tercero);
            $directorio->calificacion = DirectoriosController::calificacion($directorio->calificacion);
        }
        $retefuentes = Retefuentes::all();
        $ciudades = Ciudades::all();
        $regimenes = Regimenes::all();
        $usuarios = Usuarios::all();
        $directorio_tipos = Directorio_tipos::all();
        $directorio_clases = Directorio_clases::all();
        $directorio_tipo_terceros = Directorio_tipo_terceros::all();
        return view('administrador.directorios', [
            'directorios' => $directorios,
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
}
