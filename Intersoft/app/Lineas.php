<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lineas extends Model
{
    //
    protected $fillable = ['nombre','descripcion','codigo_interno','codigo_alterno'];
}
