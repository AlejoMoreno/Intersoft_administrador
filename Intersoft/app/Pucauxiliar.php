<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pucauxiliar extends Model
{
    protected $fillable = ['id_pucsubcuentas','codigo','descripcion','homologo','id_empresa'];
}
