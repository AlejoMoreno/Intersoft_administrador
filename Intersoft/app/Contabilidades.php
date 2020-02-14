<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contabilidades extends Model
{
    protected $fillable = [
        'tipo_documento',
        'id_sucursal',
        'id_documento',
        'numero_documento',
        'prefijo',
        'fecha_documento',
        'valor_transaccion',
        'tipo_transaccion',
        'tercero',
        'id_auxiliar',
        'id_empresa'];
}
