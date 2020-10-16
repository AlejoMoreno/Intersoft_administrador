<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignaciones extends Model
{
    protected $fillable = ['consecutivo',
		'concepto',
		'valor',
		'id_tipo_pago',
		'total',
        'fecha_consignacion',
        'id_banco',
		'id_empresa'];
}
