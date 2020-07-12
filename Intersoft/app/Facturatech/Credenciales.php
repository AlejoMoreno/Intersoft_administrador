<?php

namespace App\Facturatech;

use Illuminate\Database\Eloquent\Model;

class Credenciales extends Model
{
    protected $fillable = ['usuario',
    'passwordWsIntegrador',
    'numeroResolucion',
    'fechaInicio',
    'fechaFinal',
    'prefijo',
    'numeroDesde',
    'numeroHasta',
    'tipoCredencial',
    'estado',
    'referenciaPago',
    'idEmpresa'];
        
}
