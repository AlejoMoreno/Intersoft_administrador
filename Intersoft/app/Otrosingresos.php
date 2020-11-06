<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otrosingresos extends Model
{
    protected $fillable = ['id_sucursal','prefijo','numero','fecha','id_tercero',
        'concepto','valor','id_auxiliar','id_tercero_cuenta','valor_auxiliar',
        'naturaleza','id_empresa'];
}
