<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Causaciones extends Model
{
    protected $fillable = ['id_sucursal','prefijo','numero','consecutivo',
        'fecha','id_tercero','factura','neto_pagar','fecha_vencimiento',
        'centro_costo','detalle','id_auxiliar','id_tercero_auxiliar',
        'valor_auxiliar','naturaleza','id_empresa'];
}
