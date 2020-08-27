<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    //
    protected $fillable = ['nombre','signo','ubicacion','prefijo','num_max','num_min','num_presente','documento_contable','resolucion','usuario','password','id_empresa','fecha_inicio','fecha_fin'];
}
