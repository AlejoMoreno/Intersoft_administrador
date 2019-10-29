<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contabilidades extends Model
{
    protected $fillable = ['numero_consecutivo', 
        'id_auxiliar',
        'debito',
        'credito',
        'tipo_documento',
        'id_documento',
        'id_sucursal',
        'id_empresa'];
}
