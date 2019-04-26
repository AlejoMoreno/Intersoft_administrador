<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    //
    protected $fillable = ['nombre','signo','ubicacion','prefijo','num_max','num_min','num_presente','cuenta_contable_partida','cuenta_contable_contrapartida'];
}
