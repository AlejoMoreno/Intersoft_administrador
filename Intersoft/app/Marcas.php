<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    //
    protected $fillable = ['nombre','descripcion','logo','codigo_interno','codigo_alterno'];
}
