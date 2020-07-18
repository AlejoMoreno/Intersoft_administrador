<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directoriomaps extends Model
{
    protected $fillable = ['id_cliente','direccion','longitud','latitud','accuracy'];
}
