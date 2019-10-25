<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produccioningresos extends Model
{
    //
    protected $fillable = ['id_ficha_tecnica','id_sucursal','id_empresa','id_turno','orden_produccion','fecha','operario','id_referencia','lote','etapa','unidades'];
}
