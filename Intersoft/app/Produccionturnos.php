<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produccionturnos extends Model
{
    //
    protected $fillable = ['id_empresa','id_sucursal','nombre_etapa','duracion','precioobra','estado'];
}
