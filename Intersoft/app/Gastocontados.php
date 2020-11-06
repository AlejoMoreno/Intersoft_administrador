<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastocontados extends Model
{
    protected $fillable = ['id_sucursal','prefijo','numero','consecutivo',
        'fecha_egreso','centro_costo','id_tercero','id_auxiliar','valor',
        'naturaleza','detalle','id_empresa'];
}
