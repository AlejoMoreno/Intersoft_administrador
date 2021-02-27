<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directorios extends Model
{
    protected $fillable = [
    'nit',
    'digito',
    'razon_social',
    'direccion',
    'correo',
    'telefono',
    'telefono1',
    'telefono2',
    'financiacion',
    'descuento',
    'cupo_financiero',
    'rete_ica',
    'porcentaje_rete_iva',
    'actividad_economica',
    'calificacion',
    'nivel',
    'zona_venta',
    'transporte',
    'estado',
    'id_retefuente',
    'id_ciudad',
    'id_regimen',
    'id_usuario',
    'id_directorio_tipo',
    'id_directorio_clase',
    'id_directorio_tipo_tercero'];

    public function directorioTipos(){
        return $this->hasOne('App\Directorio_tipos','id_directorio_tipo','id');
    }

    public function directorioTipoTerceros(){
        return $this->hasOne('App\Directorio_tipo_terceros','id_directorio_tipo_tercero','id');
    }

    public function directorioClases(){
        return $this->hasOne('App\Directorio_clases','id_directorio_clase','id');
    }

    public function usuarios(){
        return $this->hasOne('App\Usuarios','id_usuario','id');
    }

    public function regimenes(){
        return $this->hasOne('App\Regimenes','id_regimen','id');
    }

    public function ciudades(){
        return $this->hasOne('App\Ciudades','id_ciudad','id');
    }

    public function retefuentes(){
        return $this->hasOne('App\Retefuentes','id_retefuente','id');
    }
}
