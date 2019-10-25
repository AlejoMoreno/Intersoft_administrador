<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichatecnicas extends Model
{
    //
    protected $fillable = ['id_referencia','id_sucursal','id_empresa','nombre','orden','cantidad','estado'];
}
