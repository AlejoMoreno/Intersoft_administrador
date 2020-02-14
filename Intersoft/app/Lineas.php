<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lineas extends Model
{
    //
    protected $fillable = [
        'nombre',
        'descripcion',
        'retefuente_porcentaje',
        'v_puc_retefuente',
        'c_puc_retefuente',
        'reteiva_porcentaje',
        'v_puc_reteiva',
        'c_puc_reteiva',
        'reteica_porcentaje',
        'v_puc_reteica',
        'c_puc_reteica',
        'iva_porcentaje',
        'v_puc_iva',
        'c_puc_iva',
        'puc_compra',
        'puc_venta',
        'codigo_interno',
        'codigo_alterno',
        'id_empresa'
    ];
}
