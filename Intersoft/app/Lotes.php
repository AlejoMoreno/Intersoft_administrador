<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotes extends Model
{
    //
    protected $fillable = ['id_referencia','numero_lote','fecha_vence_lote','ubicacion','serial','cantidad'];
}
