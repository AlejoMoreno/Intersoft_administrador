<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resoluciones extends Model
{
    protected $fillable = ['prefijo', 'fecha', 'numero_presente',
        'rango_inicio', 'rango_final', 'usuario_dian', 'password_dian',
        'id_documento', 'id_empresa'];
}
