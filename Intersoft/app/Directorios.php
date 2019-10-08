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
}
