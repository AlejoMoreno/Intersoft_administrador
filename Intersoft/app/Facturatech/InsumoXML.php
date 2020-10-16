<?php

namespace App\Facturatech;

use Illuminate\Database\Eloquent\Model;

class InsumoXML extends Model
{
    protected $fillable = ['id_factura',
    'id_sucursal',
    'id_empresa',
    'id_cliente',
    'enviado'];
}
