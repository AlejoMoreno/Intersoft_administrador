<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trakingmaps extends Model
{
    protected $fillable = ['id_vendedor','longitud','latitud','accuracy'];
}
