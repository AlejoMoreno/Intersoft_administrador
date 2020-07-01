<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonasusuarios extends Model
{
    //
    protected $fillable = ['id_usuario','id_tercero','zona','id_empresa','estado'];
}
