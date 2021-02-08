<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pucauxiliar extends Model
{
    protected $fillable = ['tipo','naturaleza','clase','codigo','descripcion','homologo','id_empresa','exogena','na'];
}
